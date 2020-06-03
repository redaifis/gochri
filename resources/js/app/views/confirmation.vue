<template>
  <div>
    <pageclientimage />
    <div class="confirmation">
      <checkoutstep :step="4" />
      <div>
        <img src="@/assets/flago.png" />
        <label>Confirmation</label>
      </div>
      <div class="info_confirmation">
        <span class="line"></span>
        <label class="title">Panier :</label>
        <div class="panier">
          <template v-for="item in cartItems">
            <label :key="item.id">{{item.name}}</label>
            <label :key="item.id">x{{item.qty}}</label>
          </template>

          <label>
            Prix TTC :
            <span>{{subtotal}}Dhs</span>
          </label>
        </div>
        <span class="line"></span>
        <label class="title">Livraison :</label>
        <div class="livraison">
          <label>Type de livraion :</label>
          <label>{{shipping.name}}</label>
          <label>Pays :</label>
          <label>{{shipping.country}}</label>
          <label>Ville :</label>
          <label>{{shipping.city}}</label>
          <label>Adresse :</label>
          <label>{{shipping.address}}</label>
          <label>N° Téléphone :</label>
          <label>{{shipping.phone}}</label>
          <label>
            Prix de livraison :
            <span>{{shipping.price || "0"}}Dhs</span>
          </label>
        </div>
        <span class="line"></span>
        <label class="title">Paiement :</label>
        <div class="paiement">
          <label>Type de paiement :</label>
          <label>{{payment}}</label>
          <!-- <label>Nom et prénom :</label>
          <label>{{paiement.nomcomplet}}</label> -->
          <label>
            Total de la commande:
            <span>{{total}} Dhs</span>
          </label>
        </div>
        <span class="line"></span>
        <div class="btn">

            <button @click="() => this.$emit('goBack')">Précédent</button>
            <button @click="() => this.$emit('makeStep')">Confirmé ma commande</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import checkoutstep from "@/components/checkoutstep.vue";
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
    props:['cartItems','shipping','payment','subtotal', 'total'],
  components: {
    pageclientimage,
    checkoutstep
  },

  methods: {
    decreasenbr: function(index) {
      if (this.items[index].nbr > 1) {
        this.items[index].nbr--;
      }
    },
    increasenbr: function(index) {
      if (this.items[index].nbr < 99) {
        this.items[index].nbr++;
      }
    },
    test: function(id) {
      console.log(id);
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

.confirmation {
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

  .info_confirmation {
    text-align: left;

    .line {
      border-bottom: 1px solid orange;
      display: block;
      margin-top: 10px;
    }

    .title {
      color: orange;
      font-weight: bold;
      font-size: 18pt;
      text-align: left;
      width: 100%;
      display: block;
      margin: 10px 0px;
    }

    .panier {
      display: grid;
      grid-template-columns: 1fr max-content;
      grid-row-gap: 10px;
      grid-column-gap: 15px;

      label {
        text-align: left;
        font-size: 15pt;
      }
    }

    .livraison {
      display: grid;
      grid-template-columns: max-content 1fr;
      grid-column-gap: 20px;
      grid-row-gap: 10px;

      label {
        font-size: 15pt;
      }
    }

    .paiement {
      display: grid;
      grid-template-columns: max-content 1fr;
      grid-column-gap: 20px;
      grid-row-gap: 10px;

      label {
        font-size: 15pt;
      }
    }

    .panier, .livraison, .paiement {
      label:last-child {
        font-size: 18pt;
        font-weight: bold;
        margin-top: 20px;
        text-align: right;
        grid-column: span 2;

        span {
          color: orange;
          text-align: right;
        }
      }
    }

    button {
    //   display: block;
      background-color: orange;
      border: 1px solid orange;
      padding: 10px;
      color: white;
      border-radius: 10px;
      font-size: 13pt;
      margin-top: 40px;

      +for_xs() {
        margin: auto;
        margin-top: 20px;
      }
    }
  }
}

.btn{
      text-align: right!important;

}
</style>
