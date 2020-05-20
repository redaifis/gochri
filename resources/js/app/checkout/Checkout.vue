<template>
  <div class="container">
  <div class="row justify-content-center my-4">
      <div class="col-4">
          <Stripe></Stripe>
      </div>
  </div>

  <div class="row justify-content-center my-4">
      <div class="col-4">
        <Paypal></Paypal>
      </div>
  </div>
</div>
</template>

<script>

import Paypal from './components/Paypal'
import Stripe from './components/Stripe'

            
export default {
    components:{Paypal,Stripe},
    
}
</script>

<style>

</style>