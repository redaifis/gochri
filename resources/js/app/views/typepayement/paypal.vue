<template>
  <div>
    <pageclientimage />
    <div class="paypal">
      <div>
        <img src="@/assets/Carte.svg" />
        <label>Service de payement</label>
      </div>
      <img src="@/assets/paypalicon.svg" />
      <label>Paiement par paypal</label>
      <p>
        Le paiement doit être effectué sur la page de notre partenaire. Cliquez sur le
        bouton ci-dessous pour ouvrir une nouvelle fenêtre et poursuivre la transaction.
      </p>
      <!-- <button>PAYER</button> -->
      <p>
        Utiliser un moyen de paiement à l'insu de son propriétaire ou contester indûment un paiement sont des
        délits sanctionnés dans le monde entier. Gochri et ses représentants se réservent le droit de poursuivre
        tout contrevenant.
      </p>
    </div>
  </div>
</template>

<script>
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  name: "paypal",
  components: {
    pageclientimage
  }
};
</script>

<style lang="stylus" scoped>
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
  width: 700px;
  padding: 20px 100px;
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

  &>div:first-child {
    font-size: 15pt;
    display: flex;
    align-items: center;
    font-weight: bold;
    margin-bottom: 10px;
    width: max-content;
    margin: auto;
    margin-bottom: 40px;
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

  label {
    font-size: 16pt;

    +for_s() {
      font-size: 15pt;
    }
  }

  img {
    width: 60px;
    margin-bottom: 10px;

    +for_s() {
      width: 50px;
      height: 50px;
    }
  }

  p {
    text-align: left;
    margin: 30px 0px;

    +for_s() {
      font-size: 12pt;
    }
  }

  button {
    background-color: #03a9f4;
    box-shadow: 3px 3px #283593;
    border: none;
    border-radius: 10px;
    color: white;
    padding: 8px 20px;
    font-size: 15pt;
    margin-bottom: 20px;
    margin-top: 15px;
    outline: none;

    +for_s() {
      font-size: 13pt;
    }
  }

  p:last-child {
    font-size: 10pt;

    +for_s() {
      font-size: 9pt;
    }
  }
}
</style>