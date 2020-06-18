<template>
  <div>
    <pageclientimage />
    <div class="historiquecommandes">
      <div>
        <img src="@/assets/historiquecommande.svg" />
        <label>Historique des commandes</label>
      </div>
      <div class="search">
        <input type="text" placeholder="Numéro de commande.." v-model="search"/>
        <button>
          <img src="@/assets/loupew.svg" />
        </button>
      </div>
      <div class="commandeliste">
        <label>N°Commande</label>
        <label>Date</label>
        <label>Produits</label>
        <label>Total</label>
        <label>Livraison</label>
        <label>...</label>
        <template v-for="order in searched">
          <label :key="order.id">{{order.reference}}</label>
          <label :key="order.id">{{order.created_at | moment('MMMM Do YYYY, h:mm:ss a')}}</label>
          <label :key="order.id">
            {{order.products_count}}
          </label>
          <label :key="order.id">{{order.amount}} Dh</label>
          <label :key="order.id" class="termine" v-if="order.shipping_status == true">Livraisé</label>
          <label :key="order.id" class="enattente" v-if="order.shipping_status == false">En attente</label>
          <!-- <label :key="order.id" class="annule" v-if="order.status== 'Remboursé'">Remboursé</label>
          <label :key="order.id" class="termine" v-if="order.status== 'Arrivé'">Arrivé</label> -->
          <button :key="order.id" @click="goToOrder(order.id)">Suivre</button>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  components: {
    pageclientimage
  },
  data() {
    return {
      orders: [],
        search: ''
    }
  },
  computed:{
      searched(){
          if(this.search){
            return this.orders.filter(el => el.reference.includes(this.search))
          }else{
              return this.orders
          }
      }
  },
  methods: {
    decreasenbr: function(index) {
      if (this.items[index].nbr > 1) {
        this.items[index].nbr--;
      }
    },
    increasenbr: function(index) {
      if (this.items[index].nbr < 99) {
        this.items[index].nbr++;
      }
    },
    test: function(id) {
      console.log(id);
    },
    getOrders(){
        axios.get('/api/customer/orders')
        .then(res => this.orders = res.data.orders)
    },
    goToOrder(orderId){
        window.location.href = '/customer/orders/' + orderId
    }
  },
  mounted(){
      this.getOrders()
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

.historiquecommandes {
  background-image: url('~@/assets/arriereplanicon.svg');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: auto 77%;
  margin: 30px;
  position: relative;
  background-color: rgba(255, 255, 255, 0.89);
  border: 1px solid orange;
  border-radius: 10px;
  width: 1000px;
  padding: 40px 100px;
  margin: auto;
  margin-top: -45px;
  margin-bottom: 30px;
  box-sizing: border-box;

  +for_m() {
    width: calc(100% - 20px);
    padding: 10px;
    margin-left: 10px;
    margin-right: 10px;
    box-sizing: border-box;
  }

  .search {
    margin-left: auto;
    position: relative;
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    max-width: 300px;

    input {
      border: 2px solid orange;
      border-radius: 30px;
      padding: 10px;
      width: 100%;
      outline: none;
      font-size: 14pt;
    }

    button {
      border: none;
      position: absolute;
      right: 7px;
      background-color: orange;
      border-radius: 30px;
      height: 35px;
      width: 35px;
      outline: none;
      transition: transform 0.5s;

      &:hover {
        transform: scale(1.1);
      }

      img {
        width: 17px;
        display: block;
        transform: translateX(3px);
      }
    }
  }

  &>div:nth-child(1) {
    display: flex;
    flex-direction: column;
    align-items: center;

    +for_s() {
      margin-top: 10px;
    }

    &>label {
      font-size: 20pt;
      font-weight: bold;
      margin-bottom: 45px;

      +for_s() {
        font-size: 15pt;
      }
    }

    img {
      width: 65px;
      margin-bottom: 10px;

      +for_s() {
        width: 40px;
      }
    }
  }

  .commandeliste {
    display: grid;
    grid-template-columns: repeat(6, auto);

    +for_s() {
      grid-template-columns: repeat(2, auto);
    }

    label, button {
      border: 1px solid #f7bf87;
      padding: 10px;
      font-size: 15pt;
    }

    label {
      background-color: #f7f7f7;

      span {
        display: none;

        +for_s() {
          display: inline;
        }
      }

      &.enattente {
        color: grey;
        font-weight: bold;
      }

      &.encours {
        color: #f1871e;
        font-weight: bold;
      }

      &.termine {
        color: green;
        font-weight: bold;
      }

      &.annule {
        color: red;
        font-weight: bold;
      }
    }

    label:nth-child(-n+6) {
      background-color: #f7e5d4;
      font-weight: bold;

      +for_s() {
        display: none;
      }
    }

    button {
      color: white;
      background-color: orange;
    }

    +for_s() {
      &> :nth-child(6n + 1), & :nth-child(6n + 2) {
        border-top: 2px solid #afafafb8;
        margin-top: 10px;
      }

      &> :nth-child(6n + 1), & :nth-child(6n + 3), & :nth-child(6n + 5) {
        border-left: 2px solid #afafafb8;
      }

      &> :nth-child(6n + 2), & :nth-child(6n + 4), & :nth-child(6n + 6) {
        border-right: 2px solid #afafafb8;
      }

      &> :nth-child(6n + 5), & :nth-child(6n + 6) {
        border-bottom: 2px solid #afafafb8;
        margin-bottom: 10px;
      }
    }
  }
}
</style>
