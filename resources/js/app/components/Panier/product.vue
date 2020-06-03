<template>
  <div class="product">
    <img :src="'/storage/images/products/' + item.options.image" />
    <div>
      <label><a style="text-decoration:none;color: #2c3e50;" :href="'/products/' + item.options.slug">{{item.name.length > 50 ? item.name.slice(0,50) : item.name}}</a></label>
      <label>'</label>
    </div>
    <div>
      <label>
        {{item.subtotal}}
        <span>Dhs</span>
      </label>
      <div>
          <button  @click="decreaseQty(item)" :class="{hide:item.qty<=1}" :disabled="item.qty<=1">
          <img src="@/assets/arrowqtepanier.svg" />
        </button>

        <label>x{{item.qty}}</label>
        <button @click="increaseQty(item)" :class="{hide:item.qty>=99}" :disabled="item.qty>=99">
          <img src="@/assets/arrowqtepanier.svg" />
        </button>
      </div>
    </div>
    <button  @click="removeItem(item)" >X</button>
  </div>
</template>

<script>
export default {
  props: ['item'],
  methods:{
      async increaseQty(item){
          item.qty++
          await axios.put('/cart/'+ item.rowId,{ quantity: item.qty })
          .then(res => console.log(res))
          .catch(err => console.log(err))

          this.$root.$emit('retrieve cart items');

      },
      async decreaseQty(item){
        item.qty--
          await axios.put('/cart/'+ item.rowId,{ quantity: item.qty })
          .then(res => console.log(res))
          .catch(err => console.log(err))

          this.$root.$emit('retrieve cart items');
      },
      async removeItem(item){
          await axios.delete('/cart/' +item.rowId)
          .then(res => console.log(res))
          .catch(err => console.log(err))

          this.$root.$emit('retrieve cart items');
      }
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

.product {
  display: grid;
  grid-template-columns: 90px auto max-content max-content;
  grid-gap: 10px;
  margin: 10px 10px;

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

  img {
    width: 100%;
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

    &>label:nth-child(2) {
      font-size: 16pt;
      color: orange;

      +for_s() {
        font-size: 13pt;
      }
    }
  }

  div:nth-child(3) {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-end;

    +for_s() {
      grid-column-start: 3;
    }

    label:first-child {
      font-size: 18pt;
      margin-top: 12px;

      +for_s() {
        font-size: 15pt;
        margin-top: 0px;
        margin-bottom: 10px;
      }

      span {
        font-size: 13pt;

        +for_s() {
          font-size: 13pt;
        }
      }
    }

    div:nth-child(2) {
      font-size: 15pt;
      color: orange;
      display: flex;
      align-items: center;
      flex-direction: row;

      button {
        border: none;
        background: none;
        outline: none;

        &.hide {
          opacity: 0.4;
        }

        img {
          width: 20px;
          height: 20px;
          display: block;
        }

        &:nth-child(3) {
          transform: rotate(180deg);
        }
      }

      +for_s() {
        font-size: 13pt;
      }
    }
  }

  &>button {
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
      justify-self: flex-start;
    }
  }
}
</style>
