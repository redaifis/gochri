<template>
  <div>
    <pageclientimage />
    <div class="systemlivraison">
      <checkoutstep :step="2" />
      <div>
        <img src="@/assets/truck.svg" />
        <label>Service de livraison</label>
      </div>
      <label>Votre mode de livraison :</label>
      <div class="shipping">

          <div class="methods" v-for="(method,index) in shippingMethods" :key="method.id">
                <img class="truckicon" src="@/assets/truck2icon.svg" />
                <div>

                    <label><input type="radio" name="standard" :value="method" v-model="shipping" :checked="index === 0"> {{method.name}}</label>
                </div>
                <div class="moreinfo">
                <label @click="showfirst=!showfirst">?</label>
                <div :class="{show:showfirst}">
                    <img src="@/assets/moreinfolefto.svg" />
                    <p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.</p>
                </div>
                </div>
          </div>

      </div>

      <div>
          <h5 style="font-size:18px;margin: 40px 0 5px 0">Veuilliez remplier les champs suivant:</h5>


        <input type="email" placeholder="Email" v-model="shipping.email" style="width: 100%;border: 1px solid orange;border-radius: 10px;background-color: #F2F2F2;margin-top:20px;padding: 15px;font-size: 13pt;box-sizing: border-box;outline: none;">
        <input type="tel" placeholder="Numéro téléphone" v-model="shipping.phone" style="width: 100%;border: 1px solid orange;border-radius: 10px;background-color: #F2F2F2;margin-top:20px;padding: 15px;font-size: 13pt;box-sizing: border-box;outline: none;">
        <input type="text" placeholder="Pays" v-model="shipping.country" style="width: 100%;border: 1px solid orange;border-radius: 10px;background-color: #F2F2F2;margin-top:20px;padding: 15px;font-size: 13pt;box-sizing: border-box;outline: none;">
        <input type="text" placeholder="Ville" v-model="shipping.city" style="width: 100%;border: 1px solid orange;border-radius: 10px;background-color: #F2F2F2;margin-top:20px;padding: 15px;font-size: 13pt;box-sizing: border-box;outline: none;">
        <textarea rows="3" placeholder="Inserer votre adresse... " v-model="shipping.address" style="margin-top:20px;"></textarea>
        <textarea rows="3" placeholder="Votre Note (Optionnelle)" v-model="shipping.note"></textarea>
      </div>
      <div>
          <p style="color:red" v-show="errors.length > 0">{{errors[0]}}</p>
      <button @click.prevent="$emit('goBack')">Précédent</button>
      <button @click.prevent="checkForm()" >Suivant</button>

      </div>
      <P>
        En cliquant sur payer maintenant, vous reconnaissez
        avoir lu et accepté nos
        <a
          href="policypage"
        >CONDITIONS GÉNÉRALES DE VENTE</a>. Vous
        acceptez par ailleurs que la fourniture du contenu
        numérique commandé commence immédiatement
        après l'envoi de notre mail de confirmation d'achat et
        renoncez donc à votre droit de rétractation.
      </P>
    </div>
  </div>
</template>

<script>
import checkoutstep from "@/components/checkoutstep.vue";
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  name: "systemlivraison",
  components: {
    pageclientimage,
    checkoutstep
  },
  data: function() {
    return {
      showfirst: false,
      showsecond: false,
      errors: [],
      shipping: {
          address: null,
          country: null,
          city: null,
          phone: null,
          email: null,
      },
      shippingMethods: []
    };
  },
  methods:{
      getShippingMethods(){
          axios.get('/api/shipping-methods')
          .then(res => {
              this.shippingMethods = res.data.shipping_methods
              this.shipping = res.data.shipping_methods[0]

            })
          .catch(err => console.log(err))
      },
    validEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    validTel(tel) {
      var re = /^\d{10}$/;
      return re.test(tel);
    },
    checkForm() {
      this.errors = [];

        if (!this.shipping.id) {
        this.errors.push("Veuillez choisir un mode de livraison.");
      }

      if (!this.shipping.email) {
        this.errors.push('Email est obligatoire.');
      } else if (!this.validEmail(this.shipping.email)) {
        this.errors.push('Email est incorrecte.');
      }

      if (!this.shipping.phone) {
        this.errors.push("N° téléphone est obligatoire.");
      }else if (!this.validTel(this.shipping.phone)) {
        this.errors.push('Numero de téléphone est incorrecte.');
      }

        if (!this.shipping.country) {
        this.errors.push("Pays est obligatoire.");
      }
      if (!this.shipping.city) {
        this.errors.push("Ville est obligatoire.");
      }
      if (!this.shipping.address) {
        this.errors.push("L'adresse est obligatoire.");
      }

      if (!this.errors.length) {
        this.$emit('makeStep')
      }
    },
  },
  watch: {
      shipping(){
          this.$emit('getShipping',this.shipping)
      },

  },
  async mounted(){
      this.getShippingMethods()
          this.$emit('getShipping',this.shipping)


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

.systemlivraison {
  background-image: url('~@/assets/arriereplanicon.svg');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: auto 77%;
  margin: 30px;
  position: relative;
  background-color: rgba(255, 255, 255, 0.89);
  border: 1px solid orange;
  border-radius: 10px;
  width: 700px;
  padding: 40px 100px;
  margin: auto;
  margin-top: -45px;
  margin-bottom: 30px;
  box-sizing: border-box;
  display: flex;
  flex-direction: column;
  align-items: flex-start;

  +for_s() {
    width: calc(100% - 20px);
    padding: 10px;
    margin-left: 10px;
    margin-right: 10px;
    box-sizing: border-box;
  }

  &>div:nth-child(2) {
    font-size: 15pt;
    display: flex;
    align-items: center;
    font-weight: bold;
    margin-bottom: 10px;
    width: max-content;
    margin: auto;
    margin-bottom: 40px;
    margin-top: 20px;

    img {
      width: 60px;
      margin-right: 20px;

      +for_s() {
        width: 40px;
      }
    }

    label {
      font-size: 30px;

      +for_s() {
        font-size: 20px;
      }
    }
  }

  &>label {
    font-size: 16pt;
    margin-bottom: 30px;
    align-self: center;

    +for_s() {
      font-size: 15pt;
    }
  }



  div:nth-child(5) {
    width: 100%;

    // label {
    //   display: flex;
    //   flex-direction: column;
    //   align-items: flex-start;
    //   margin-top: 30px;
    //   margin-bottom: 10px;
    // }

    textarea {
      width: 100%;
      border: 1px solid orange;
      border-radius: 10px;
      background-color: #F2F2F2;
      padding: 15px;
      margin-bottom: 10px;
      box-sizing: border-box;
      font-size: 13pt;
      outline: none;

      +for_s() {
        font-size: 11pt;
      }
    }
  }

  button {
    background-color: orange;
    border: none;
    border-radius: 10px;
    color: white;
    padding: 8px 20px;
    font-size: 15pt;
    margin-bottom: 30px;
    margin-top: 15px;
    outline: none;
    align-self: center;

    +for_s() {
      font-size: 11pt;
    }
  }

  p {
    font-size: 10pt;
    text-align: left;

    a {
      text-decoration: none;
    }

    +for_s() {
      font-size: 9pt;
    }
  }
}

.shipping .methods{
    display: grid;
    grid-template-columns: 80px auto max-content;
    grid-gap: 10px;
    align-items: center;
    width: max-content;
    text-align: left;

    .truckicon {
      transition: transform 0.25s;

      &:hover {
        transform: translateX(10px);
      }
    }

    +for_s() {
      align-self: center;
    }

    .moreinfo {
      display: flex;
      align-items: center;

      label {
        background-color: orange;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        line-height: 20px;
        text-align: center;
        color: white;
        display: block;

        &:hover + div {
          display: flex;
        }
      }

      div {
        align-items: center;
        display: none;
        position: absolute;
        margin-left: 15px;

        +for_s() {
          &.show {
            display: flex;
          }
        }

        +for_s() {
          left: 0px;
          flex-direction: row-reverse;
        }

        p {
          max-width: 250px;
          background-color: #ffffffcc;
          border: 1px solid orange;
          border-radius: 5px;
          padding: 10px;
        }
      }

      img {
        width: 10px;
        margin-left: 5px;

        +for_s() {
          transform: rotate(180deg);
          margin-left: 0;
        }
      }
    }

    img {
      width: 60px;
      height: 60px;
      object-fit: contain;

      +for_s() {
        width: 50px;
        height: 50px;
      }
    }

    label {
      font-size: 14pt;

      +for_s() {
        font-size: 12pt;
      }
    }
  }
</style>
