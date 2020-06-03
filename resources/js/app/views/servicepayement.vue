<template>
  <div>
    <pageclientimage />
    <div class="servicepayement">
      <checkoutstep :step="3" />
      <div>
        <img src="@/assets/Carte.svg" />
        <label>Service de paiement</label>
      </div>
      <label>Votre mode de paiement :</label>
      <div>
        <img src="@/assets/paypalicon.svg" />
        <label><input type="radio" name="payment" id="payment" value="paypal" v-model="payment"> Paypal</label>

        <img src="@/assets/mastercardicon.svg" />
        <label><input type="radio" name="payment" id="payment" value="credit card" v-model="payment"> Carte Bancaire</label>

        <img src="@/assets/livraisoncashicon.svg" />
        <label><input type="radio" name="payment" id="payment" value="cash on delivery" v-model="payment"> Paiement à livraison</label>
      </div>
      <div>
      <button @click="$emit('goBack')">Précédent</button>
      <button @click="$emit('makeStep')" :disabled="!payment">Suivant</button>

      </div>
      <P>
        En cliquant sur payer maintenant, vous reconnaissez
        avoir lu et accepté nos
        <a
          href="policypage"
        >CONDITIONS GÉNÉRALES DE VENTE</a>. Vous
        acceptez par ailleurs que la fourniture du contenu
        numérique commandé commence immédiatement
        après l'envoi de notre mail de confirmation d'achat et
        renoncez donc à votre droit de rétractation.
      </P>
    </div>
  </div>
</template>

<script>
import checkoutstep from "@/components/checkoutstep.vue";
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  name: "servicepayement",
  components: {
    pageclientimage,
    checkoutstep
  },
  data(){
      return{
          payment: null
      }
  },
  watch:{
      payment(){
          this.$emit('getPayment',this.payment)
      }
  }
};
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

.servicepayement {
  background-image: url('~@/assets/arriereplanicon.svg');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: auto 77%;
  margin: 30px;
  position: relative;
  background-color: rgba(255, 255, 255, 0.89);
  border: 1px solid orange;
  border-radius: 10px;
  width: 700px;
  padding: 40px 100px;
  margin: auto;
  margin-top: -45px;
  margin-bottom: 30px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  align-items: center;

  +for_s() {
    width: calc(100% - 20px);
    padding: 10px;
    margin-left: 10px;
    margin-right: 10px;
    box-sizing: border-box;
  }

  &>div:nth-child(2) {
    font-size: 15pt;
    display: flex;
    align-items: center;
    font-weight: bold;
    // margin-bottom: 10px;
    width: max-content;
    margin: auto;
    margin-bottom: 20px;
    margin-top: 20px;

    img {
      width: 60px;
      margin-right: 20px;

      +for_s() {
        width: 40px;
      }
    }

    label {
      font-size: 30px;

      +for_s() {
        font-size: 20px;
      }
    }
  }

  &>label {
    display: block;
    font-size: 14pt;
    margin-bottom: 20px;

    +for_s() {
      font-size: 15px;
    }
  }

  div:nth-child(4) {
    display: grid;
    grid-template-columns: 60px auto;
    grid-gap: 20px;
    align-items: center;
    width: max-content;
    margin: auto;
    text-align: left;

    img {
      width: 60px;
      height: 60px;
      object-fit: contain;
      transition: transform 0.2s;

      &:hover {
        transform: rotate(-10deg) scale(1.03);
      }

      +for_s() {
        width: 40px;
        height: 40px;
      }
    }

    label {
      font-size: 15pt;

      &:hover {
        color: orange;
      }
    }
  }

  button {
    background-color: orange;
    border: none;
    border-radius: 10px;
    color: white;
    padding: 8px 15px;
    font-size: 13pt;
    margin-bottom: 20px;
    margin-top: 15px;
    align-self: flex-end;

    +for_s() {
      font-size: 12px;
      align-self: center;
      margin-top: 40px;
    }
  }

  p {
    margin-top: 15px;
    font-size: 10pt;
    text-align: left;

    +for_s() {
      font-size: 9px;
    }

    a {
      font-size: 10pt;
      text-decoration: none;

      +for_s() {
        font-size: 9px;
      }
    }
  }
}
</style>
