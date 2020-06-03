<template>
  <div class="rechercheavancer">
    <div class="search">
      <input type="text" v-on:keyup.enter="goToSearch" placeholder="Recherche..." v-model="searchText" @keyup="search($event)" @focus="visible=true" @blur="visible=false" :class="searchText.length != '' ? 'hoveredSearch' : ''"/>
      <div class="loadingspinner" v-if="isLoading" style="right: 10px;position: absolute;"></div>
      <a :href="'/search/product/' + searchText"><img src="@/assets/loupe.svg" v-if="!isLoading"/></a>
    </div>
    <div class="menuitems" v-if="searchedProducts.length>0 && visible">
      <a v-for="item in searchedProducts" :href="'/products/'+item.slug" :key="item.id">{{item.name.length > 40 ? item.name.slice(0,40) : item.name}}</a>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
        searchedProducts: [],
        searchText: '',
        isLoading: false,
    }
  },
  methods: {
      async search(e){
            this.isLoading = true
            console.log(e.target.value)
            await axios.post(`/api/search`, {search: e.target.value})
            .then(res => {
                this.searchedProducts = res.data.products
                })
            .catch(err => console.log(err))
            this.isLoading = false

      },
      goToSearch(){
          window.location.href = '/search/product/' + this.searchText
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

.rechercheavancer {
  display: flex;
  flex-direction: column;
  max-width: 500px;
  position: relative;

  .menuitems {
    width: calc(100% - 20px);
    display: flex;
    flex-direction: column;
    position: absolute;
    z-index: 2;
    background-color: white;
    border-radius: 0px 0px 10px 10px;
    border: 2px solid orange;
    box-sizing: border-box;
    top: 44px;
    border-width: 0px 2px 2px 2px;

    +for_m() {
      top: 33px;
    }

    a {
      font-size: 13pt;
      color: #2c3e50;
      display: block;
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
      text-align: left;
      display: block;
      text-decoration: none;

      +for_m() {
        font-size: 10pt;
      }

      &:hover {
        background-color: #0000000d;
        color: #e69500;
      }
    }
  }

  .search {
    position: relative;
    width: calc(100% - 20px);
    margin: auto;

    // input:focus {
    //   border-width: 2px 2px 0px 2px;border-radius: 10px 10px 0px 0px;
    // }

    input {
      +for_m() {
        font-size: 10pt;
        padding: 8px;
      }

      border: 2px solid orange;
      border-radius: 10px;
      width: 100%;
      font-size: 14pt;
      color: grey;
      outline: none;
      padding: 10px;
    }

    img {
      height: 100%;
      padding: 10px;
      top: 0px;
      right: 0px;
      position: absolute;
      box-sizing: border-box;
    }

  }
}

.hoveredSearch{
border-width: 2px 2px 0px 2px!important;
border-radius: 10px 10px 0px 0px!important;
}
</style>
