<template>
  <div>
    <pageclientimage />
    <div class="mastercard">
      <div>
        <img src="@/assets/Carte.svg" />
        <label>Service de payement</label>
      </div>
      <div>
        <img src="@/assets/mastercardicon.svg" />
        <label>Paiement par carte banquaire</label>
        <div>
          <input type="text" placeholder="Nom et prénom" />
          <input type="text" placeholder="MM/YY" />
          <input type="text" placeholder="CVC" />
          <input type="text" placeholder="Code de la carte banquaire" />
        </div>
      </div>
      <button>VALIDER</button>
      <P>
        Utiliser un moyen de paiement à l'insu de son propriétaire ou contester indûment un paiement sont
        des délits sanctionnés dans le monde entier. Gochri et ses représentants se réservent le droit de
        poursuivre tout contrevenant
      </P>
    </div>
  </div>
</template>

<script>
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  name: "mastercard",
  components: {
    pageclientimage
  }
};
</script>
<style lang="stylus" scoped>
.mastercard {
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

  div:nth-child(2) {
    display: flex;
    flex-direction: column;
    align-items: center;

    img {
      width: 60px;
      margin-bottom: 10px;

      +for_s() {
        width: 40px;
      }
    }

    label {
      font-size: 16pt;
      margin-bottom: 30px;

      +for_s() {
        font-size: 15px;
      }
    }
  }

  div:nth-child(3) {
    display: grid;
    grid-template-columns: repeat(4, 130px);
    grid-gap: 10px;
    width: max-content;

    +for_s() {
      width: 100%;
      grid-template-columns: repeat(4, 1fr);
    }

    input {
      border: 1px solid orange;
      border-radius: 10px;
      background-color: #F2F2F2;
      padding: 15px;
      box-sizing: border-box;
      outline: none;

      +for_s() {
        width: 100%;
        grid-column: span 2;
      }

      &:first-child {
        grid-column: span 4;
      }

      &:nth-child(4) {
        grid-column: span 2;

        +for_s() {
          grid-column: span 4;
        }
      }
    }
  }

  button {
    background-color: orange;
    border: none;
    border-radius: 10px;
    color: white;
    padding: 8px 20px;
    font-size: 15pt;
    margin-bottom: 50px;
    margin-top: 30px;
    outline: none;

    +for_s() {
      font-size: 11pt;
    }
  }

  p {
    font-size: 10pt;
    text-align: left;
  }
}
</style>