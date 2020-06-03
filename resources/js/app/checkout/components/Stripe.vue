<template>
  <div>
      <pageclientimage />
      <div class="stripe">
        <checkoutstep :step="4" />
        <div style="width:360px;margin:auto">
            <!-- <label>Votre Nom et prénom sur la carte</label>
            <br> -->
            <input id="card-holder-name" type="text" placeholder="Votre nom sur la carte" v-model="cardHolderName">
            <!-- <br> -->
            <!-- <label>Votre Numéro de téléphone</label>
            <br>
            <input id="card-holder-name" type="text" placeholder="Numéro de téléphone" v-model="phone"> -->
            <!-- Stripe Elements Placeholder -->


            <div id="card-element" class="form-control border"></div>

            <div>

                <button class="btn" @click="$emit('goBack')">Précédent</button>

                <button class="btn" id="card-button" @click="charge">
                    <i class="fas fa-check    "></i>
                    Payé
                </button>
            </div>

        </div>



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
    data(){
        return{
            cardHolderName: '',
            stripe: null,
            cardElement: null,
        }
    },
    mounted(){

        const stripe = Stripe('pk_test_3CYrTJYbUoNb4lg6ir2XuKvq00G6kIutil');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        this.stripe = stripe
        this.cardElement = cardElement

        cardElement.mount('#card-element');

    },
    methods:{
        charge(){
            let order = {amount: this.total,...this.shipping,payment_method: this.payment,cartItems: this.cartItems}

            const paymentMethod = this.stripe.createPaymentMethod(
                'card', this.cardElement, {
                    billing_details: { name: this.cardHolderName, email: this.shipping.email, phone: this.shipping.phone, address: { city: this.shipping.city, country: 'MA', line1: this.shipping.address}}
                }
            ).then(res => {
                // The card has been verified successfully...
                console.log(res)
                axios.post('/charge', {...res.paymentMethod,total: this.total})
                .then(result => {
                    console.log(result)
                    axios.post('/api/customer/orders', order)
                        .then(res => {
                            axios.delete('/cart/items/destroy')
                            .then(res => console.log(res))
                            .catch(err => console.log(err))
                            window.location.href = "/thank-you"
                        }).catch(err => console.log(err))
                })
                .catch(err => console.log(err))
            }).catch(err => console.log(err))
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

.stripe {
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

// button {
//     display: block;
//     background-color: orange;
//     border: 1px solid orange;
//     padding: 10px;
//     color: white;
//     border-radius: 10px;
//     font-size: 13pt;
//     margin-top: 40px;
//     margin: auto;

//     +for_xs() {
//     margin: auto;
//     margin-top: 20px;
//     }
// }

label{
    color: orange;
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

.form-control, input{
  border: 2px solid #ffa500;
    border-radius: 4px;
    outline: 0;
    font-size: 15px;
    padding: 7px 5px;
    transition: border-color 0.2s;
    width: 100%;
    margin: 13px auto;
    background-color: #fff;
}
</style>
