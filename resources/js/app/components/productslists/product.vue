<template>
  <div class="product">
    <div>
      <label v-if="product.discount">{{product.discount + '%'}}</label>
      <button>
        <div>
                <i class="fas fa-heart heart-icon" @click="toggleWishlist()" v-show="userWishlist.includes(product.id)"></i>
                <i class="far fa-heart heart-icon" @click="toggleWishlist()" v-show="!userWishlist.includes(product.id)"></i>
            </div>
      </button>
    </div>
    <img :src="'/storage/images/products/'+product.image" />
    <div>
      <label><a style="text-decoration:none;color: #2c3e50;" :href="'/products/' + product.slug">{{product.name.length > 50 ? product.name.slice(0,50) : product.name}}</a></label>
      <!-- <label>{{product.discount ? product.discount + '%' : ''}}</label> -->
    </div>

    <div>
      <label>
        {{product.price}}
        <span>Dh</span>
      </label>
      <button @click.prevent="addToCart()">
        <img src="@/assets/panier3.svg" />
      </button>
    </div>
  </div>
</template>

<script>
const userWishlist = window.wishlist;

export default {
  props: ['product'],
  data(){
      return{
          userWishlist: userWishlist ? userWishlist : []
      }
  },
  methods:{
      addToCart(){
          axios.post('/cart', this.product).then(res => {
              this.$root.$emit('retrieve cart items');
          })
          .catch(err => console.log(err))
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
    }
  },
  mounted(){
      this.$root.$on('deleted wishlist', (id) => this.userWishlist = this.userWishlist.filter(el => el != id))
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
.product {
  background-color: white;
  border: 1px solid orange;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  width: 250px;
  padding: 30px;
  margin: 10px;

  &>img {
    height: 200px;
    object-fit: contain;
    width: 100%;
  }

  div:first-child {
    display: grid;
    grid-template-columns: auto max-content;

    label {
      background-color: orange;
      color: white;
      border-radius: 10px;
      width: fit-content;
      padding: 5px 10px;
      font-size: 15pt;
      margin-bottom: 20px;
    }

    button {
      border: none;
      outline: none;
      background-color: inherit;
      align-self: flex-start;
      width : fit-content;
      margin-left: auto;
      transition: transform 0.5s;
        cursor: pointer;
      &:hover {
        transform: scale(1.2);
      }

      img {
        width: 30px;
      }
    }
  }

  div:nth-child(3) {
    display: flex;
    flex-direction: column;
    text-align: left;
    font-size: 15pt;

    label:nth-child(2) {
      color: orange;
      font-size: 13pt;
      margin-top: 10px;
    }
  }

  div:nth-child(4) {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;

    label {
      color: orange;
      font-size: 20pt;
      font-weight: bold;
    }

    span {
      font-size: 17pt;
    }

    button {
      border: none;
      outline: none;
      background-color: orange;
      border-radius: 10px;
      padding: 5px 10px;
      transition: transform 0.5s;



      img {
        width: 35px;
      }
    }
  }
}
</style>
