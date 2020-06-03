<template>
  <div>
    <pageclientimage />
    <div class="panier">
        <checkoutstep :step="1" />
      <div>
        <img src="@/assets/panier2.svg" />
        <label>Panier</label>
      </div>
      <div>
        <button>
          <img src="@/assets/rightarrowicon.svg" />
          <label onClick="window.location.href = '/search'">Continuez mes achats</label>
        </button>

        <div>
          <product
            v-for="item in cartItems"
            :key="item.id"
            :item="item"
          />
        </div>
        <div>
          <label>TOTAL :</label>
          <label>{{subtotal}} Dh</label>
        </div>
        <p style="color:red" v-show="Object.keys(user) < 1">Veuillez connecter pour continuer</p>
        <button @click="() => this.$emit('makeStep')" :disabled="cartItems.length < 1 || Object.keys(user) < 1">Suivant</button>
      </div>
    </div>
  </div>
</template>

<script>
import checkoutstep from "@/components/checkoutstep.vue";
import product from "@/components/Panier/product.vue";
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  components: {
    pageclientimage,
    product,
    checkoutstep
  },
  props:['cartItems','total','subtotal'],
  data: function() {
    return {
        user: window.user || {}
    };
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

  },
  mounted(){

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

.panier {
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
      margin-bottom: 45px;

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

  &>div:nth-child(3) {
    display: flex;
    flex-direction: column;

    button {
      background-color: orange;
      display: flex;
      align-items: center;
      color: white;
      align-self: flex-end;
      border: none;
      border-radius: 10px;
      padding: 8px 10px;

      img {
        margin-right: 10px;
        width: 15px;

        +for_s() {
          width: 10px;
        }
      }

      label {
        font-size: 13pt;

        +for_s() {
          font-size: 11pt;
        }
      }
    }

    &>button:nth-of-type(2) {
      margin-top: 20px;
      font-size: 13pt;
      margin-bottom: 10px;

      +for_s() {
        font-size: 11pt;
      }
    }

    &>div:nth-child(3) {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
      align-items: center;
      border-top: 2px solid orange;
      margin-top: 30px;
      padding-top: 20px;

      label:first-child {
        font-size: 15pt;

        +for_s() {
          font-size: 11pt;
        }
      }

      label:nth-child(2) {
        font-size: 20pt;

        +for_s() {
          font-size: 11pt;
        }
      }
    }
  }
}
</style>
