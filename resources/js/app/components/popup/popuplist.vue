<template>
  <div id="popuplist" v-bind:class="{'hidden':!active}">
    <button v-on:click="$emit('close')" class="close"><i class="fas fa-times"></i></button>
    <label class="titre" style="margin-bottom: 30px">Ma listes</label>
    <popuplistitem v-for="item in wishlist" :key="item.id" :item="item"/>
    <button  onClick="window.location.href = '/customer/wishlist'" v-show="wishlist.length > 0">Tout voir</button>
  </div>
</template>

<script>
import popuplistitem from "@/components/popup/poplistitem.vue";
export default {
  props: {
    active: Boolean
  },
  data: function() {
    return {
        wishlist: [],
    };
  },
  components: {
    popuplistitem
  },
  methods:{
      getWishlist(){
          if(window.user != undefined ){
              axios.get('/api/customer/wishlist')
              .then(res => this.wishlist = res.data.wishlist)
              .catch(err => console.log(err))

          }
      }
  },
  mounted(){
      this.getWishlist()

      this.$root.$on('retrieve wishlist', () => this.getWishlist())
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

#popuplist {
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
  width:360px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.25);
  overflow-y: scroll

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
