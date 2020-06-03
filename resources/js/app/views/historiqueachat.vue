<template>
  <div>
    <pageclientimage />
    <div class="panier">
      <div >
        <img src="@/assets/historiquedesachatsicon.svg" />
        <label>Historique des achats</label>
      </div>
      <div>
        <button onClick="window.location.href = '/customer/orders'">
          <img src="@/assets/rightarrowicon.svg" />
          <label>Liste des commandes</label>
        </button>

        <div class="info_commande">
          <label>Numéro de commande: {{order.id}}</label>
          <label>{{order.created_at | moment('MMMM Do YYYY, h:mm:ss a')}}</label>
        </div>

        <div>
          <product
            v-for="(item,index) in order.products"
            :key="item.id"
            :product="item"

          />
        </div>
        <div>
          <span></span>
          <label>{{order.shipping.name}}: {{order.shipping.price}} Dh</label>
          <label>
            <span>TOTAL:</span> {{order.amount}} Dh
          </label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import product from "@/components/historiquedesachats/product.vue";
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
    props:['order'],
  components: {
    pageclientimage,
    product
  },
  data: function() {
    return {
      items: [
        {
          id: 1,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g",
          price: 150,
          nbr: 1
        },
        {
          id: 2,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g",
          price: 150,
          nbr: 3
        },
        {
          id: 3,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g",
          price: 150,
          nbr: 3
        },
        {
          id: 4,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g",
          price: 150,
          nbr: 3
        },
        {
          id: 5,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g",
          price: 150,
          nbr: 3
        },
        {
          id: 6,
          img: "img/bettrave.png",
          title: "Betteraves rouges cuites bio CARREFOUR BIO",
          unit: "le paquet de 500 g",
          price: 150,
          nbr: 3
        }
      ]
    };
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

.panier {
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

  &>div:first-child {
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

  &>div:nth-child(2) {
    display: flex;
    flex-direction: column;

    .info_commande {
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      font-size: 18pt;
      align-items: center;
      margin: 20px;
      margin-top: 40px;
      flex-wrap: wrap;

      +for_s() {
        flex-direction: column-reverse;
        margin: 10px;
        margin-top: 30px;

        label {
          font-size: 14pt;
          margin: 5px;
        }
      }
    }

    button {
      background-color: orange;
      display: flex;
      align-items: center;
      color: white;
      align-self: flex-end;
      border: none;
      border-radius: 10px;
      padding: 8px 10px;

      img {
        margin-right: 10px;
        width: 15px;

        +for_s() {
          width: 10px;
        }
      }

      label {
        font-size: 13pt;

        +for_s() {
          font-size: 11pt;
        }
      }
    }

    &>button:nth-of-type(2) {
      margin-top: 20px;
      font-size: 13pt;
      margin-bottom: 10px;

      +for_s() {
        font-size: 11pt;
      }
    }

    &>div:last-child {
      display: grid;
      grid-template-columns: 1fr max-content;
      grid-column-gap: 20px;
      margin-top: 20px;

      +for_s() {
        margin: 0px;
        grid-column-gap: 10px;
      }

      &>span {
        grid-row: span 2;
        border-bottom: 2px solid orange;
        transform: translateY(-9px);
      }

      label:nth-of-type(1) {
        font-size: 16pt;
        text-align: left;
      }

      label:nth-of-type(2) {
        font-size: 24pt;
        text-align: left;

        span {
          font-size: 16pt;
          font-weight: bold;
        }
      }
    }
  }
}
</style>
