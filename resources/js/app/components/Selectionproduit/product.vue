<template>
  <a :href="'/products/'+product.slug">
    <img v-bind:src="'/storage/images/products/'+ product.image" />
    <label class="titreproduct">{{product.name.length > 20 ? product.name.slice(0,20)+".." : product.name}}</label>


    <button @click.prevent="addToCart()">
      <img  src="@/assets/panier2.svg" />

    </button>
    <div class="prices">
      <label class="pricebefore" v-if="product.discount !== null">{{(product.price * (1 + (product.discount/100) )).toFixed(2)}}Dh</label>
      <label class="priceafter">{{product.price}} Dh</label>
    </div>
    </a>
</template>

<script>
export default {
  props: ['product'],
  methods:{
      addToCart(){
          axios.post('/cart', this.product).then(res => {
              this.$root.$emit('retrieve cart items');
          })
          .catch(err => console.log(err))
      }
  }
};
</script>

<style lang="stylus" scoped>
a{
  text-decoration: none;
  display: block;
  width: 300px;
  background-color: white;
  border: 1px solid grey;
  border-radius: 10px;
  position: relative;
  height: 200px;
  box-shadow: 1px 2px 5px #0000002b;
  transition: transform 0.5s;

  &:hover {
    transform: scale(1.03);
    border: 1px solid orange;
  }

  &> img {
    position: absolute;
    top: 20px;
    left: 10px;
    width: 100px;
    height: 100px;
    object-fit: contain;
  }

  .prices {
    position: absolute;
    bottom: 20px;
    right: 20px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
  }

  .titreproduct {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 15pt;
    max-width: 150px;
    text-align: left;
  }

  .pricebefore {
    color: orange;
    text-decoration: line-through;
    font-size: 13pt;
  }

  .priceafter {
    color: orange;
    font-size: 18pt;
  }

  label {
    color: black;
  }

  button {
    border: none;
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: none;
    outline: none;
    transition: transform 0.5s;
        cursor: pointer;

    &:hover {
      transform: scale(1.4);
    }

    img {
      width: 30px;
    }
  }
}
</style>
