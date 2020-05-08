<template>
  <div class="container">
  <div class="row justify-content-center">
      <div class="col-8">

          <input id="card-holder-name" type="text" v-model="cardHolderName">

          <!-- Stripe Elements Placeholder -->
          <div id="card-element" class="border"></div>

          <button id="card-button" @click="charge">
              Process Payment
          </button>
      </div>
  </div>
</div>
</template>

<script>

const stripe = Stripe('pk_test_3CYrTJYbUoNb4lg6ir2XuKvq00G6kIutil');

const elements = stripe.elements();
const cardElement = elements.create('card');

const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');
            
export default {
    data(){
        return{
            cardHolderName: '',
            stripe: stripe,
            cardElement: cardElement,
        }
    },
    mounted(){
        cardElement.mount('#card-element');

    },
    methods:{
        charge(){
            const paymentMethod = this.stripe.createPaymentMethod(
                'card', this.cardElement, {
                    billing_details: { name: this.cardHolderName }
                }
            ).then(res => {
                // The card has been verified successfully...
                console.log(res)
                axios.post('/charge', res.paymentMethod)
                .then(result => console.log(result))
                .catch(err => console.log(err))
            }).catch(err => console.log(err))
        }
    }
}
</script>

<style>

</style>