<template>
  <div id="popuppanieritem">
    <a :href="'/products/' + item.options.slug"><img :src="'/storage/images/products/' + item.options.image" style="max-width: 50px"/></a>
    <div>
      <a :href="'/products/' + item.options.slug"><label>{{item.name.length > 30 ? item.name.slice(0,30) + ".." : item.name}}</label></a>
      <label>x {{item.qty}}</label>
    </div>
    <i class="fas fa-times close-icon" @click="removeItem()"></i>
  </div>
</template>

<script>
export default {
  props: ['item'],
    methods:{
        removeItem(){
            axios.delete('/cart/' + this.item.rowId)
            .then(res => {
                this.$root.$emit('retrieve cart items');
                console.log(res)})
            .catch(err => console.log(err))
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

#popuppanieritem {
  display: grid;
  grid-template-columns: auto 70% auto;
  grid-gap: 20px;
    // align-items: center;
    // justify-content: center;
  +for_s() {
    grid-template-columns: max-content 1fr max-content;
    grid-gap: 10px;
  }

//   +for_xs() {
//     border: 1px solid orange;
//     border-radius: 5px;
//     background-color: white;
//     padding: 10px 5px;
//   }

  button {
    width: 30px;
    height: 30px;
    margin: 0px;
    color: white;
  }

  div {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    // align-items: center;
    // justify-content: center;

    label:nth-child(2) {
      color: orange;
    }

    +for_s() {
      label {
        font-size: 10pt;
        text-align: left;
      }
    }
  }
}

a{
    text-decoration: none
    color: #333333
}
</style>
