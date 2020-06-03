<template>
  <div class="productdetails">
    <div>
      <!-- <div class="category-nav">
        <img src="@/assets/rightwhiteicon.svg" />
        <label>Acceuil</label>
        <div v-for="item in data.categorypath" :key="item">
          <img src="@/assets/rightwhitesmall.svg" />
          <label>{{item}}</label>
        </div>
      </div> -->
    </div>
    <div>
      <img :src="'/storage/images/products/'+product.image" />
      <div class="tooltip">
        <div>
          <div>
            <label>{{product.name}}</label>
            <!-- <label>{{product.quantity}}</label> -->

          </div>
            <div>
                <i class="fas fa-heart heart-icon" @click="toggleWishlist()" v-show="userWishlist.includes(product.id)"></i>
                <i class="far fa-heart heart-icon" @click="toggleWishlist()" v-show="!userWishlist.includes(product.id)"></i>
            </div>
          <!-- <img src="@/assets/heart.svg" v-if="!data.fav" @click="data.fav=true" /> -->
          <!-- <img src="@/assets/fullheart.png" v-if="data.fav" @click="data.fav=false" /> -->
        </div>
        <label>{{product.discount ? (product.price * ((product.discount / 100) + 1)).toFixed(2) + 'Dh' : ''}}</label>
        <label>{{product.price}}Dh</label>

        <div>
          <div>
            <button @click.prevent="quantity > 1 ? quantity-- : quantity">
              <img src="@/assets/moinsicon.svg" />
            </button>
            <label>{{quantity}}</label>
            <button @click.prevent="quantity++">
              <img src="@/assets/plusicon.svg" />
            </button>
          </div>
          <button @click.prevent="addToCart()">
            <img src="@/assets/panier3.svg" />
            <label>Ajouter au panier</label>
          </button>
        </div>
      </div>
    </div>
    <description :product="product" />
    <suggestions :product="product" />
  </div>
</template>

<script>
import suggestions from "@/components/productdetails/suggestions.vue";
import description from "@/components/productdetails/description.vue";
// const userWishlist = window.userWishlist;
export default {
    props:['product'],
  components: {
    description,
    suggestions
  },
  data: function() {
    return {
        quantity: 1,
        userWishlist: []
    };
  },
  methods: {
      getProduct(){

      },
      addToCart(){
          this.product.quantity = this.quantity
          axios.post('/cart', this.product).then(res => {
              this.$root.$emit('retrieve cart items');
          })
          .catch(err => console.log(err))
      },
    // decreaseNbr: function() {
    //   if (this.data.nbr > 1) this.data.nbr--;
    // },
    // increaseNbr: function() {
    //   if (this.data.nbr < 99) this.data.nbr++;
    // }
    getWishlist(){
          axios.get('/api/customer/wishlist')
          .then(res => this.userWishlist = res.data.wishlist.map(function (value, index, array) {

   return value.id;

}))
          .catch(err => console.log(err))
          console.log('hi')
      },
    toggleWishlist(){
        axios.put('/api/customer/wishlist/' + this.product.id)
        .then(() => {
          if(this.userWishlist.includes(this.product.id)){
              this.userWishlist = this.userWishlist.filter(el => el != this.product.id)
              this.$root.$emit('retrieve wishlist')
          }else{
              this.userWishlist.push(this.product.id)
              this.$root.$emit('retrieve wishlist')
          }
        })
        .catch(err => console.log(err))
    },

  },
  mounted(){
        this.getWishlist()
    }

};
</script>

<style lang="stylus" scoped>
orange = #F29537;

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
.productdetails {
  padding: 60px;

  +for_s() {
    padding: 10px;
  }

  .category-nav {
    display: flex;
    align-items: center;
    margin: 30px 0px 15px 0px;
    background-color: orange;
    border-radius: 10px;
    color: white;
    padding: 5px 50px;
    flex-wrap: wrap;
    text-align: left;

    +for_s() {
      padding: 5px 20px;
    }

    div {
      display: flex;
      align-items: center;
    }

    img {
      width: 20px;

      +for_s() {
        width: 10px;
      }
    }

    label {
      margin: 0px 15px;
      font-size: 15pt;

      +for_s() {
        font-size: 10pt;
        margin: 5px 10px;
      }
    }
  }

  &>div:nth-child(2) {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 60px;
    align-items: flex-start;
    margin-top: 50px;

    +for_s() {
      grid-template-columns: repeat(1, 1fr);
    }

    &>img {
      padding: 20px;
      width: 100%;
      background-color: white;
      box-shadow: 8px 8px 20px 1px rgba(230, 230, 230, 1);
      border: 1px solid orange;
      border-radius: 15px;
      box-sizing: border-box;

      +for_s() {
        max-width: 500px;
        margin: auto;
      }
    }

    &>div {
      padding: 40px;
      background-color: white;
      box-shadow: 8px 8px 20px 1px rgba(230, 230, 230, 1);
      border: 1px solid orange;
      border-radius: 15px;
      box-sizing: border-box;

      div:first-child {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;

        div {
          display: flex;
          flex-direction: column;
          align-items: flex-start;

          label:first-child {
            font-size: 17pt;
            margin-bottom: 5px;
          }

          label:nth-child(2) {
            font-size: 16pt;
            color: orange;
            margin-bottom: 10px;
          }
        }

        img {
          width: 40px;
          transition: transform 0.5s;

          &:hover {
            transform: scale(1.2);
          }
        }
      }

      &>label:nth-child(2) {
        display: block;
        color: orange;
        text-decoration: line-through;
        font-size: 20pt;
        text-align: left;
        margin-top: 10px;
        margin-bottom: 5px;
      }

      &>label:nth-child(3) {
        color: orange;
        font-size: 30pt;
        display: block;
        text-align: left;
        font-weight: bold;
        margin-bottom: 20px;
      }
    }

    div:nth-child(4) {
      display: flex;
      justify-content: space-between;
      align-items: center;

      div {
        button {
          background-color: orange;
          color: white;
          padding: 10px;
          border: none;
          outline: none;

          &:first-child {
            border-radius: 20px 0px 0px 20px;
          }

          &:nth-child(3) {
            border-radius: 0px 20px 20px 0px;
          }

          img {
            width: 15px;
            height: 15px;
            object-fit: contain;
            display: block;
          }
        }

        &>label {
          display: block;
          width: 50px;
          height: 35px;
          font-size: 17pt;
          color: orange;
          border: 1px solid orange;
          border-width: 1px 0px;
          line-height: 35px;
          box-sizing: border-box;
        }
      }

      &>button {
        background-color: orange;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        font-size: 13pt;

        img {
          width: 30px;
          margin-right: 10px;
        }
      }
    }
  }
}

.tooltip {
 position: sticky;
 top:0px;
 right:0px;
}
</style>
