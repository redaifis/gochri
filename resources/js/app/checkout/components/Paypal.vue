<template>
<div>
      <pageclientimage />
      <div class="paypal">
        <checkoutstep :step="4" />
        <div id="paypal-button-container" ref="paypal"></div>

        <button class="btn" @click="() => this.$emit('goBack')">Précédent</button>
      </div>


</div>
</template>

<script>
import checkoutstep from "@/components/checkoutstep.vue";
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
    props:['total','shipping','payment','cartItems'],
    components: {
    pageclientimage,
    checkoutstep
  },
    data() {
        return {

        }
    },
    mounted() {

        this.setLoaded()
    },
    methods: {
        setLoaded() {
            let value = (this.total * 0.092).toFixed(2).toString()
            let order = {amount: this.total,...this.shipping,payment_method: this.payment,cartItems: this.cartItems}
            console.log(order)
            window.paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                currency_code: 'EUR',
                                value: value
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        alert('Paiement a été effectué avec succés par: ' + details.payer.name.given_name);
                        axios.post('/api/customer/orders', order)
                        .then(res => {
                            axios.delete('/cart/items/destroy')
                            .then(res => console.log(res))
                            .catch(err => console.log(err))
                            window.location.href = "/thank-you"
                        }).catch(err => console.log(err))

                    });
                }
            }).render('#paypal-button-container'); // Display payment options on your web page

        }
    }
}
</script>

<style lang="stylus" scoped>
for_xs()
  @media screen and (max-width: 600px)
    {block}
for_s()
  @media screen and (max-width: 768px)
    {block}
for_m()
  @media screen and (max-width: 992px)
    {block}
for_l()
  @media screen and (max-width: 1200px)
    {block}

.paypal {
  background-image: url('~@/assets/arriereplanicon.svg');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: auto 77%;
  margin: 30px;
  position: relative;
  background-color: rgba(255, 255, 255, 0.89);
  border: 1px solid orange;
  border-radius: 10px;
  width: 1000px;
  padding: 40px 100px;
  margin: auto;
  margin-top: -45px;
  margin-bottom: 30px;
  box-sizing: border-box;

  +for_m() {
    width: calc(100% - 20px);
    padding: 10px;
    margin-left: 10px;
    margin-right: 10px;
    box-sizing: border-box;
  }

  &>div:nth-child(2) {
    display: flex;
    flex-direction: column;
    align-items: center;

    +for_s() {
      margin-top: 10px;
    }

    &>label {
      font-size: 20pt;
      font-weight: bold;
      margin-bottom: 35px;

      +for_s() {
        font-size: 15pt;
      }
    }

    img {
      width: 65px;
      margin-bottom: 10px;

      +for_s() {
        width: 40px;
      }
    }
  }



}

.btn{
    color: white;
    border-radius: 4px;
    background-color: orange;
    padding: 8px 16px;
    margin: 20px 0;
    border: none;
    font-size: 18px
}

#paypal-button-container{
    width: 320px
    margin: 50px auto 10px auto
}
</style>
