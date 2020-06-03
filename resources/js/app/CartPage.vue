<template>
  <div id="app">


    <Header></Header>

    <!-- Content -->
    <Cart :cartItems="cartItems" :subtotal="subtotal" @makeStep="step++" v-if="step === 1"></Cart>
    <Shipping @getShipping="getShipping" @makeStep="step++" @goBack="step--" v-show="step === 2"></Shipping>
    <Payment @getPayment="getPayment" @makeStep="step++" @goBack="step--" v-show="step === 3"></Payment>
    <Confirmation :cartItems="cartItems" :subtotal="subtotal" :total="total" :shipping="shipping" :payment="payment" @goBack="step--" @makeStep="checkPayment" v-if="step === 4"></Confirmation>

    <!-- Checkout -->
    <Paypal :cartItems="cartItems" :total="total" :shipping="shipping" :payment="payment"  @goBack="step--" @paid="step++" v-if="step === 5 && payment === 'paypal'"></Paypal>
    <Stripe :cartItems="cartItems" :total="total" :shipping="shipping" :payment="payment"  @goBack="step--" @paid="step++" v-if="step === 5 && payment === 'credit card'"></Stripe>

    <Footer></Footer>

  </div>
</template>
<script>
import Header from '@/partials/Header.vue'
import Footer from '@/partials/Footer.vue'
import Cart from '@/views/panier.vue'
import Shipping from '@/views/systemlivraison.vue'
import Payment from '@/views/servicepayement.vue'
import Confirmation from '@/views/confirmation.vue'
import Paypal from '@/checkout/components/Paypal.vue'
import Stripe from '@/checkout/components/Stripe.vue'
export default{
    // props:['product'],
    components: {
        Header,
        Footer,
        Cart,
        Shipping,
        Payment,
        Confirmation,
        Paypal,
        Stripe,

    },
    data(){
        return{
            step: 1,
            cartItems: [],
            subtotal: null,
            shipping: null,
            payment: null,
        }
    },
    methods: {
        getCartItems(){
        axios.get('/cart/all')
        .then(res => {
            this.cartItems = res.data.items
            this.total = res.data.total
            this.subtotal = res.data.subtotal
        })
        .catch(err => console.log(err))
        },
        getPayment(payment){
            this.payment = payment
        },
        getShipping(shipping){
            this.shipping = shipping
        },
        checkPayment(){
            let order = {amount: this.total,...this.shipping,payment_method: this.payment,cartItems: this.cartItems}
            if(this.payment == 'cash on delivery'){
                axios.post('/api/customer/orders', order)
                .then(res => {
                    axios.delete('/cart/items/destroy')
                    .then(res => console.log(res))
                    .catch(err => console.log(err))
                    window.location.href = "/thank-you"
                }).catch(err => console.log(err))
            }else{
                this.step++
            }
        }
    },
    mounted(){
        this.getCartItems()

      this.$root.$on('retrieve cart items', () => {
          this.getCartItems()
      });
    },
    computed:{
      total(){
          return parseFloat(this.shipping.price) ? parseFloat(this.subtotal) + parseFloat(this.shipping.price) : parseFloat(this.subtotal)

      }
  },
}
</script>
<style lang="stylus">

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

@import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap');

* {
  font-family: 'Source Sans Pro', sans-serif;
}

.navlinks {
  +for_l() {
    background-color: green;
  }

  +for_m() {
    background-color: yellow;
  }

  +for_s() {
    background-color: orange;
  }

  +for_xs() {
    background-color: red;
  }
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

body {
  margin: 0;
}
</style>
