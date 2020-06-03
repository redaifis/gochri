<template>
  <div class="productslists">
    <section1 :title="'Produits'" :img="'/img/imagefruit.png'" />
    <div>
      <!-- <div class="category-nav">
        <img src="@/assets/rightarrowblack.svg" />
        <label>Acceuil</label>
        <div v-for="item in data.categorypath" :key="item">
          <img src="@/assets/rightarrow_small.svg" />
          <label>{{item}}</label>
        </div>
      </div> -->
      <div class="category-nav2" style="margin-top:30px">
        <!-- <label>Rayons</label> -->
        <a @click.prevent="displayAll()" :style="[selectedSubcategory.length < 1 && selectedCategory.length < 1 ? 'color:#fff;background-color:orange' : '']" style='margin-bottom:10px' href="#">Tous</a>
        <a v-for="category in categories" :key="category.id" @click.prevent="selectCategory(category)" :style="selectedCategory.id == category.id ? 'color:#fff;background-color:orange' : ''" style='margin-bottom:10px' href="#">{{category.name}}</a>
      </div>
      <div class="category-nav2" style="margin-top:30px" v-show="subcategories">
        <!-- <label>Les sous-catégories :</label> -->
        <a v-for="subcategory in subcategories" :key="subcategory.id" @click.prevent="selectedSubcategory = subcategory; search()" :style="selectedSubcategory.id == subcategory.id ? 'color:#fff;background-color:orange' : ''" href="#">{{subcategory.name}}</a>
      </div>
    </div>
    <div class="content" :class="{closed:filterclosed}">
      <div class="barrefiltrage">
        <button @click="filterclosed =!filterclosed">
          <img src="@/assets/filtreicon.svg" />
        </button>
        <h1>Barre de Filtrage</h1>
        <span class="line"></span>
        <label class="title">Recherche par :</label>
        <div class="checkbox-item">
          <!-- <div>
            <input type="checkbox" id="discount" v-model="criteria.withDiscount"/>
            <label>Promotions</label>
            <label>43</label>
          </div> -->
          <div>
            <input type="checkbox" id="new" v-model="criteria.new"/>
            <label>Nouveautés</label>
          </div>
          <!-- <div>
            <input type="checkbox" id="recommanded" v-model="criteria.recommanded"/>
            <label>Recommandé</label>
          </div> -->
          <div>
            <input type="checkbox" id="popular" v-model="criteria.popular"/>
            <label>Populaires</label>
          </div>
        </div>
        <!-- <span class="line"></span>
        <label class="title">Actualités :</label>
        <div class="checkbox-item">
          <div>
            <input type="checkbox" />
            <label>Les nouveautés</label>
            <label>231</label>
          </div>
        </div> -->

        <span class="line"></span>
        <label class="title">Marque :</label>
        <div class="search-marque">
          <img src="@/assets/searchicon2.svg" />
          <input type="text" placeholder="Marque..." id="brand" v-model="criteria.brand"/>
        </div>
        <!-- <div class="checkbox-item">
          <div>
            <input type="checkbox" id="brand" />
            <label>{{item.title}}</label>
            <label>{{item.nbr}}</label>
          </div>
        </div> -->
        <span class="line"></span>
        <label class="title">Prix en Dh</label>
        <DoubleSlider :min="1" :max="1000" v-model="criteria.price" />
        <div class="inputprix">
          <input type="number" v-model="criteria.price.from" />
          <input type="number" v-model="criteria.price.to" />
        </div>
        <span class="line"></span>
        <label class="title">Remise %</label>
        <DoubleSlider :min="0" :max="100" v-model="criteria.discount" />
        <div class="inputremise">
            <input type="number" v-model="criteria.discount.from" />
            <input type="number" v-model="criteria.discount.to" />
        </div>
        <span class="line"></span>
        <button @click.prevent="search">Recherche</button>
      </div>
      <div class="list">
        <product
          v-for="item in pageOfProducts"
          :key="item.id"
          :product="item"
        />
        <div class="footer-pag">
            <jw-pagination :items="searched" :styles="paginationStyles"  :pageSize="6" :maxPages="6" @changePage="onChangePage"></jw-pagination>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import DoubleSlider from "@/components/DoubleSlider.vue";
import SliderRound from "@/components/SliderRound.vue";
import product from "@/components/productslists/product.vue";
import section1 from "@/components/productslists/section1.vue";
export default {
    props:['searchedProducts','searchText'],
  data: function() {
    return {
        subcategories: [],
        selectedSubcategory: [],
        selectedCategory: [],
        paginationStyles: {
        ul: {
            backgroundColor: '#fff',
            border: '1px solid #ffa500',
            borderRadius: '5px',
            margin: '20px 10px 0 10px',
            padding: 0,
            display: 'inline-block',
        },
        li: {
            listStyle: 'none',
            display: 'inline',
            textAlign: 'center'
        },
        a: {
            color: '#ffa500',
            cursor: 'pointer',
            padding: '10px 20px',
            display: 'block',
            float: 'left'
        }

    },
      filterclosed: true,
      criteria: {
          price: {
              from: 0,
              to: 1000
          },
          discount: {
              from: 0,
              to: 100
          },
        //   withDiscount: false,
        brand: '',
          new: false,
          minPrice: null,
          maxPrice: null,
          popular: false
      },
      products: [],
      pageOfProducts: [],
      searched: [],
      categories: []
    };
  },
  components: {
    section1,
    product,
    DoubleSlider,
    SliderRound
  },
  methods: {
    getCategories(){
        axios.get(`/api/categories`)
        .then(res => this.categories = res.data.categories)
        .catch(err => console.log(err))
    },
    getProducts(){
        axios.get(`/api/products`)
        .then(res => {
            this.products = res.data.products.sort()
        })
        .catch(err => console.log(err))
    },
    onChangePage(pageOfProducts) {
        // update page of items
        this.pageOfProducts = pageOfProducts;
    },
    async search() {
        let today = new Date();
        today.setDate(today.getDate() - 5);
        this.searched =  await this.products.filter(el => {
                return el.price > this.criteria.price.from
                && el.price < this.criteria.price.to
                && el.discount > this.criteria.discount.from
                && el.discount < this.criteria.discount.to
                && el.brand.toLowerCase().includes(this.criteria.brand.toLowerCase())
                && ((el.category.id == this.selectedCategory.id && el.subcategory.id == this.selectedSubcategory.id) || (el.category.id == this.selectedCategory.id && this.selectedSubcategory.id == null) || (this.selectedCategory.id == null && this.selectedSubcategory.id == null))
                // && el.name.toLowerCase().includes(this.searchedText.toLowerCase())
        })

        if(this.criteria.new == true){
            this.sortByDate()
        }

        if(this.criteria.popular == true){
            this.sortBySales()
        }
    },
    sortByDate(){
        this.searched.sort(function(a, b) {
            return new Date(b.created_at) - new Date(a.created_at)
        })
    },
    sortBySales(){
        this.searched.sort(function(a, b) {
            return b.sales - a.sales
        })
    },
    selectCategory(category){
        this.selectedSubcategory = []
        this.selectedCategory = category
        this.subcategories = category.subcategories
        this.search()
    },
    displayAll(){
        this.selectedSubcategory = []
        this.selectedCategory = []
        this.subcategories = []
        this.searched = this.products
    }
  },
   mounted(){
       this.getProducts()
        this.searched = this.searchedProducts.length > 0 ? this.searchedProducts.sort() : []
      this.getCategories()

  }
};
</script>

<style lang="stylus">
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

.productslists {
  background-color: #F2F2F2;
  padding-bottom: 40px;

  .category-nav {
    display: flex;
    align-items: center;
    margin: 30px 0px 15px 0px;

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
        font-size: 9pt;
        margin: 0px 10px;
      }
    }
  }

  .category-nav2 {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    flex-wrap: wrap;

    label {
      font-size: 15pt;
      color: orange;
      font-weight: bold;

      +for_s() {
        font-size: 9pt;
        width: 100%;
        text-align: left;
        margin-bottom: 10px;
      }
    }

    a {
      font-size: 13pt;
      text-decoration: none;
      color: orange;
      background-color: #fff;
      border: 1px solid orange;
      border-radius: 10px;
      padding: 6px 25px;
      margin: 0px 5px;

      &:hover {
        background-color: orange;
        color: white;
      }

      +for_s() {
        font-size: 9pt;
        padding: 3px 15px;

        &:nth-of-type(1) {
          margin-left: 0;
        }
      }
    }
  }

  .barrefiltrage {
    display: flex;
    flex-direction: column;
    border: 1px solid orange;
    border-radius: 10px;
    padding: 30px;
    width: 368px;
    background-color: white;
    margin-top: 10px;
    margin-right: 30px;
    position: relative;

    +for_m() {
      margin-right: 50px;
    }

    button:first-child {
      display: none;
      position: absolute;
      width: 70px;
      height: 70px;
      padding: 0px;
      margin: 0;
      right: -70px;
      top: 10px;
      border-radius: 0px 10px 10px 0px;

      img {
        width: 35px;
      }
    }

    +for_s() {
      button:first-child {
        display: block;
      }
    }

    h1 {
      font-size: 18pt;
      color: orange;
      margin: 0px;
    }

    .line {
      border-bottom: 1px solid orange;
      display: block;
      height: 1px;
      width: 100%;
      margin: 10px 0px;
    }

    .search-marque {
      display: flex;
      align-items: center;
      border: 1px solid orange;
      border-radius: 10px;
      padding: 10px;
      margin: 10px 0px 30px 0px;

      img {
        width: 20px;
      }

      input {
        border: none;
        outline: none;
        font-size: 15pt;
        margin-left: 10px;
        color: #666666;
        background-color: inherit;
      }
    }

    .inputprix, .inputremise {
      display: grid;
      grid-template-columns: repeat(2, 49%);
      grid-gap: 2%;
      margin-bottom: 10px;

      input {
        background-color: #b3b3b3bd;
        color: white;
        border: none;
        font-size: 13pt;
        padding: 5px 10px;
        box-sizing: border-box;
        width: 100%;
      }
    }



    // .inputremise {
    //   background-color: #b3b3b3bd;
    //   color: white;
    //   border: none;
    //   font-size: 13pt;
    //   padding: 5px 10px;
    //   box-sizing: border-box;
    //   width: 100%;
    //   margin-bottom: 10px;
    // }

    .checkbox-item {
      display: flex;
      flex-direction: column;
      margin-bottom: 10px;

      div {
        display: grid;
        grid-template-columns: 20px 1fr 40px;
        grid-gap: 15px;
        align-items: center;
        text-align: left;
        margin: 3px 0px;
        color: #666666;

        // label:last-child {
        //   background-color: #B3B3B3;
        //   color: white;
        //   padding: 2px;
        //   border-radius: 6px;
        //   text-align: center;
        // }
      }
    }

    .title {
      color: orange;
      font-size: 15pt;
      text-align: left;
      margin-bottom: 10px;
    }

    button {
      margin: auto;
      margin-top: 20px;
      margin-bottom: 10px;
      background-color: orange;
      color: white;
      border: none;
      border-radius: 10px;
      padding: 10px 25px;
      width: max-content;
      box-sizing: border-box;
      font-size: 14pt;
    }
  }

  .category-nav, .category-nav2 {
    margin-left: 50px;
  }

  .content {
    display: flex;
    align-items: flex-start;
    margin: 30px 50px;
    transition: transform 1s;

    +for_s() {
      margin: 10px 20px;

      &.closed {
        transform: translateX(-377px);
      }
    }

    .list {
      display: flex;
      flex-wrap: wrap;

      +for_m() {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
      }
    }
  }
}

.active a{
    color: #fff!important;
    background-color: #ffa500;
}

.footer-pag {
    display: block;
    width:100%
}
</style>
