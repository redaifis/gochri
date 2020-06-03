<template>
  <div id="popuppanier" v-bind:class="{'hidden':!active}">
    <button v-on:click="$emit('close')" class="close"><i class="fas fa-times"></i></button>
    <label class="titre" style="margin-bottom:30px">Mon Panier</label>
    <popuppanieritem
      v-for="item in cartItems"
      :key="item.id"
      :item="item"
    />
    <button onclick="window.location.href = '/cart'" v-show="Object.keys(cartItems).length > 0">Tout voir</button>
  </div>
</template>
=
<script>
import popuppanieritem from "@/components/popup/popuppanieritem.vue";
export default {
  props: ['active','cartItems'],
  data: function() {
    return {
      items: [
        {
          id: 1,
          name: "Betteraves rouges cuites bio CARREFOUR BIO ",
          unit: "le paquet de 500 g",
          quantity: 3
        },
        {
          id: 2,
          name: "Betteraves rouges cuites bio CARREFOUR BIO ",
          unit: "le paquet de 500 g",
          quantity: 3
        },
        {
          id: 3,
          name: "Betteraves rouges cuites bio CARREFOUR BIO ",
          unit: "le paquet de 500 g",
          quantity: 3
        },
        {
          id: 4,
          name: "Betteraves rouges cuites bio CARREFOUR BIO ",
          unit: "le paquet de 500 g",
          quantity: 3
        }
      ]
    };
  },
  components: {
    popuppanieritem
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

#popuppanier {
  display: flex;
  flex-direction: column;
//   align-items: center;
  position: fixed;
  z-index: 11;
  background-color: white;
  border-radius: 10px;
  padding: 40px;
  top: 100px;
  right: 10px;
  border: 1px solid orange;
  border-width: 0px 1px 1px 1px;
  width: 360px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.25);


  +for_s() {
    padding: 20px;
  }

  &.hidden {
    display: none;
  }

  .titre {
    font-size: 14pt;
    font-weight: bold;
    color: orange;

    +for_s() {
      font-size: 13pt;
    }
  }

  button {
    color: white;
    margin: 0px;
    margin-bottom: 20px;
    align-self: flex-end;
    margin-right: 80px;
    width: 100px;

    +for_s() {
      align-self: center;
      margin: 10px 0px;
    }
  }

  &>* {
    margin-bottom: 20px;
  }

  .close {
    align-self: flex-end;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    margin: 0;
    font-size: 12pt;
  }
}
</style>
