<template>
  <div>
    <pageclientimage />
    <div class="wishlist">
      <div>
        <img src="@/assets/heart.svg" />
        <label>Wishlist</label>
      </div>
      <div>
        <div>
          <product
            v-for="item in wishlist"
            :key="item.id"
            :item="item"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import product from "@/components/wishlist/product.vue";
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  components: {
    pageclientimage,
    product
  },
  data: function() {
    return {
        wishlist: [],
      items: [
        {
          id: 1,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g"
        },
        {
          id: 2,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g"
        },
        {
          id: 3,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g"
        },
        {
          id: 4,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g"
        },
        {
          id: 5,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g"
        },
        {
          id: 6,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g"
        }
      ]
    };
  },
  methods:{
      getWishlist(){
          axios.get('/api/customer/wishlist')
          .then(res => this.wishlist = res.data.wishlist)
          .catch(err => console.log(err))
      }
  },
  mounted(){
      this.getWishlist()
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

.wishlist {
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

  &>div:first-child {
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
        font-size: 20pt;
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

  &>div:nth-child(2) {
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
      }

      label {
        font-size: 13pt;
      }
    }

    &>button:nth-of-type(2) {
      margin-top: 20px;
      font-size: 13pt;
      margin-bottom: 10px;
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
      }

      label:nth-child(2) {
        font-size: 20pt;
      }
    }
  }
}
</style>
