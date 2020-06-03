<template>
  <div class="suggestion">
    <label><a :href="'/products/' + suggestion.slug" style="text-decoration:none;color: #2c3e50;">{{suggestion.name}}</a></label>
    <!-- <label>{{suggestion.quantity}}</label> -->
    <img :src="'/storage/images/products/' + suggestion.image" />
    <div>
      <label>{{suggestion.price}}Dh</label>
      <button @click.prevent="addToCart()">
        <img src="@/assets/panier3.svg" />
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ['suggestion'],
  methods:{
      addToCart(){
          axios.post('/cart', this.suggestion).then(res => {
              this.$root.$emit('retrieve cart items');
          })
          .catch(err => console.log(err))
      }
  }
};
</script>

<style lang="stylus" scoped>
.suggestion {
  display: flex;
  flex-direction: column;
  text-align: left;
  width: 200px;
  padding: 35px 25px;
  border: 1px solid orange;
  border-radius: 10px;
  margin: 10px;

  &>label:first-child {
    font-size: 15pt;
  }

  &>label:nth-child(2) {
    font-size: 15pt;
    color: orange;
  }

  &>img {
    margin: 10px 0px;
    object-fit: contain;
    height: 150px;
  }

  div {
    display: flex;
    justify-content: space-between;

    label {
      font-size: 20pt;
      font-weight: bold;
      color: orange;
    }

    button {
      background-color: orange;
      border: none;
      border-radius: 10px;
      padding: 5px;
      align-items: center;
      transition: transform 0.5s;

      &:hover {
        transform: scale(1.1);
        box-shadow: 1px 1px 3px orange;
      }

      img {
        width: 30px;
      }
    }
  }
}
</style>
