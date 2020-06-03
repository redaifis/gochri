<template>
  <div class="navbar">
      <div id="nav">
      <div>
        <button class="menu" @click="menuactive=!menuactive">
          <menubarre class="menubarre" :class="{change:menuactive}" />
        </button>
        <a href="/">
          <img class="logo" src="@/assets/logo.svg" />
        </a>
      </div>
      <rechercheavancer class="recherche" />

      <div class="pop_up">
        <div @click="showpopup(1)">
          <img src="@/assets/Compte.svg" />
          <label>Compte</label>
        </div>
        <div @click="showpopup(2)">
          <img src="@/assets/heart.svg" />
          <label>Listes</label>
        </div>
        <div @click="showpopup(3)" style="position:relative">
          <img src="@/assets/panier2.svg" />
          <span class="chip secondary" v-html="cartItemsCount" v-show="Object.keys(cartItems).length > 0">
            </span>
          <label>Panier</label>
        </div>
      </div>
    </div>

    <div id="nav_phone">
      <div>
        <button class="menu" @click="menuactive=!menuactive">
          <menubarre class="menubarre" :class="{change:menuactive}" />
        </button>
        <a href="/">
          <img class="logo" src="@/assets/logo.svg" />
        </a>
      </div>
      <div v-if="menuactive">
        <div class="search">
          <input type="text" v-model="menuVerticalSearchText" placeholder="Recherche..." @keyup.enter="menuVerticalSearch()"/>
          <img src="@/assets/loupe.svg" @click="menuVerticalSearch()"/>
        </div>
        <menuvertical :categories="categories"/>

        <div class="pop_up">
          <div @click="showpopup(1)">
            <img src="@/assets/Compte.svg" />
            <label>Compte</label>
          </div>
          <div @click="showpopup(2)">
            <img src="@/assets/heart.svg" />
            <label>Listes</label>
          </div>
          <div @click="showpopup(3)">
            <img src="@/assets/panier2.svg" />
            <label>Panier</label>
          </div>
        </div>
      </div>
    </div>

    <popupcompte class="popupshow" :active="popupactive==1" v-on:close="closepopup" :user="user"/>
    <popuplist class="popupshow" :active="popupactive==2" v-on:close="closepopup" />
    <popuppanier class="popupshow" :active="popupactive==3" v-on:close="closepopup" :cartItems="cartItems"/>

    <Menu class="menubox" :class="{closed:!menuactive}" :categories="categories" />
  </div>
</template>

<script>
import menubarre from "@/components/menubarre.vue";
import rechercheavancer from "@/components/rechercheavancer.vue";
import menuvertical from "@/components/menuvertical.vue";
import Menu from "@/components/Menu/Menu.vue";
import popupcompte from "@/components/popup/popupcompte.vue";
import popuplist from "@/components/popup/popuplist.vue";
import popuppanier from "@/components/popup/popuppanier.vue";

const user = window.user || []

export default {
  components: {
    popupcompte,
    popuplist,
    popuppanier,
    Menu,
    menuvertical,
    rechercheavancer,
    menubarre
  },
  data: function() {
    return {
        categories: [],
      popupactive: 0,
      menuactive: false,
      cartItems: [],
      user: user,
      menuVerticalSearchText: ''
    };
  },
  methods: {
    showpopup: function(selected) {
      this.popupactive = selected;
    },
    closepopup: function() {
      this.popupactive = 0;
    },
    getCategories(){
        axios.get('/api/categories')
        .then(res => this.categories = res.data.categories)
        .catch(err => console.log(err))
    },
    getCartItems(){
        axios.get('/cart/all')
        .then(res => this.cartItems = res.data.items)
        .catch(err => console.log(err))
    },
    menuVerticalSearch(){
        window.location.href = '/search/product/' + this.menuVerticalSearchText
    }
  },
  computed:{
      cartItemsCount(){
          return Object.keys(this.cartItems).length
      }
  },
  mounted(){
      this.getCategories()
      this.getCartItems()

      this.$root.$on('retrieve cart items', () => {
          this.getCartItems()
      })
  }
};
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
.navbar{
    margin-bottom: 90px;
}
#nav {
  display: flex;
    position: relative;

  justify-content: space-between;
  align-items: center;
//   padding: 0px 30px;
  height: 90px;
  position: fixed;
    width:100%;
  top:0;
    z-index:999;
    background-color:#fff;
    box-shadow: 0 2px 5px rgba(0,0,0,.25);

  +for_s() {
    display: none;
  }

  .recherche {
    width: 100%;
  }

  .menubarre {
    display: block;
        margin: 0 0 0 30px;
  }

  .menu {
    +for_m() {
      padding: 5px 5px 5px 5px;
    }

    +for_s() {
      padding: 11px 10px 10px 10px;
    }
  }

  div {
    display: flex;
    align-items: center;

    .logo {
      margin-right: 10px;
      width: 116px;

      +for_m() {
        width: 90px;
      }
    }
  }

  button {
    background: none;
    border: none;
    border-radius: 10px;
    margin-right: 30px;
    outline: none;
  }

  &>input {
  }

  .pop_up {
    color: Grey;
    display: flex;

    margin: 0 20px 0 0;
    div {
      &:hover label {
        display: block;
      }

      label {
        display: none;
        color: orange;
      }

      +for_m() {
        font-size: 10pt;
      }

      img {
        height: 40px;
        margin: 10px;

        +for_m() {
          height: 22px;
          margin: 5px;
        }
      }
    }

    div {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 5px;
    }
  }
}
.menubox {
  position: absolute;
  width: 100%;
  left: 0;
  z-index: 2;
  border-radius: 0 10px 10px 0;
  transition: transform 1s;

  &.closed {
    transform: translateX(-100%);
  }
}

#nav_phone {
  display: none;

  +for_s() {
    display: block;
  }

  &>div:first-child {
    display: flex;
    justify-content: space-between;
    padding: 20px;

    &>a {
      width: 100%;

      img {
        width: 100px;
      }
    }

    button {
      background: none;
      border: none;
      border-radius: 5px;
      padding: 4px 7px;
      outline: none;

      img {
        width: 30px;
        height: 30px;
        display: block;
      }
    }
  }

  &>div:nth-child(2) {
    padding: 20px;
    background-color: white;
    position: absolute;
    left: 0;
    right: 0;
    z-index: 10;
    border-radius: 10px 10px 10px 10px;
    box-sizing: border-box;
    box-shadow: 2px 1px 2px rgba(0, 0, 0, 0.251);

    .search {
      position: relative;

      input {
        border: 1px solid orange;
        border-radius: 10px;
        padding: 8px;
        font-size: 10pt;
        outline: none;
        width: 100%;
        box-sizing: border-box;
      }

      img {
        position: absolute;
        width: 15px;
        right: 0;
        top: 0;
        align-items: center;
        padding: 9px;
      }
    }

    .pop_up {
      display: flex;
      justify-content: space-around;
      box-sizing: border-box;
      color: orange;

      div {
        display: flex;
        flex-direction: column;
        align-items: center;

        img {
          width: 30px;
          margin-bottom: 10px;
        }
      }
    }
  }
}

#popupcompte, #popuplist, #popuppanier {
  button {
    background-color: orange;
    border: none;
    border-radius: 10px;
    padding: 10px;

    &.close {
      padding: 0;
    }
  }
}

.chip{
    position absolute;
    top: 30px;
    left: 0;
	border-radius: 100%;
    padding: 4px 8px;
	font-weight: 600;
	font-size: 12px;
	box-shadow: 0 2px 5px rgba(0,0,0,.25);
	// margin: 0 10px;
	cursor: pointer;
}
.chip.secondary{
	background: rgba(242, 149, 55, 0.8);
	color: #fff;
}
</style>
