<template>
  <div class="product" v-if="removed === false">
    <img :src="'/storage/images/products/' + item.image" />
    <div>
      <label><a :href="'/products/'+item.slug" style="text-decoration:none;color:#2c3e50">{{item.name.length > 50 ? item.name.slice(0,50) + ".." : item.name}}</a></label>
      <label>'</label>
    </div>
    <button @click="removeItem()"><i class="fas fa-times    "></i></button>
  </div>
</template>

<script>
export default {
  props: ['item'],
  data(){
      return{
          removed: false
      }
  },
  methods:{
      removeItem(){
          axios.put('/api/customer/wishlist/'+this.item.id)
          .then(res => console.log(res))
          .catch(err => console.log(err))
          this.removed = true

          this.$root.$emit('retrieve wishlist')
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

.product {
  display: grid;
  grid-template-columns: 90px auto max-content max-content;
  grid-gap: 10px;
  margin: 10px 0px;

  img {
    width: 100%;
  }

  +for_s() {
    grid-template-columns: 50px auto max-content max-content;
    margin: 30px 10px;
    border: 1px solid orange;
    background-color: #ffffffc9;
    border-radius: 5px;
    padding: 10px;
    grid-gap: 10px;
  }

  +for_xs() {
    grid-template-columns: 50px auto auto 35px;
  }

  div:nth-child(2) {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-end;
    margin-left: 10px;

    +for_s() {
      font-size: 13pt;
      text-align: left;
      grid-column: span 3;
    }

    label:first-child {
      font-size: 15pt;
      margin-bottom: 5px;

      +for_s() {
        font-size: 14pt;
      }
    }

    label:nth-child(2) {
      font-size: 14pt;
      color: orange;

      +for_s() {
        font-size: 13pt;
      }
    }
  }

  div:nth-child(3) {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-end;

    label:first-child {
      font-size: 18pt;

      +for_s() {
        font-size: 13pt;
      }

      span {
        font-size: 13pt;

        +for_s() {
          font-size: 13pt;
        }
      }
    }

    label:nth-child(2) {
      font-size: 15pt;
      color: orange;

      +for_s() {
        font-size: 13pt;
      }
    }
  }

  button {
    align-self: center;
    border: none;
    background-color: orange;
    color: white;
    border-radius: 10px;
    padding: 8px 13px;
    font-size: 13pt;
    outline: none;

    +for_s() {
      font-size: 10pt;
      justify-self: flex-end;
      grid-column-start: 4;
    }
  }
}
</style>
