<template>
  <div id="app">


    <Header :categories="ressources.categories"></Header>

    <!-- Content -->
    <ProductSearch :ressources="ressources" :searchedProducts='searchedproducts' :searchText='searchtext'></ProductSearch>

    <Footer></Footer>

  </div>
</template>
<script>
import Header from '@/partials/Header.vue'
import Footer from '@/partials/Footer.vue'
import ProductSearch from '@/views/productslists.vue'
export default {
    props: ['searchtext','searchedproducts'],
    components: {
        Header,
        Footer,
        ProductSearch
    },
    data(){
        return{
            ressources: {

            }

        }
    },
    // methods: {
    //     getRessources(){
    //         axios.get(`/api/mainpage`)
    //         .then(res => this.ressources = res.data)
    //         .catch(err => console.log(err))
    //     },
    // },
    mounted(){
        // this.getRessources()
    }
}
</script>
<style lang="stylus">
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


</style>
