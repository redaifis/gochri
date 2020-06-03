<template>
  <form @submit.prevent="modifyProfile" @keydown="form.onKeydown($event)">
    <pageclientimage />
    <div id="arriereplan">
      <div>
        <img src="@/assets/compteclient.svg" />
        <label>Compte Client</label>
      </div>
      <div>
        <img src="@/assets/compteetsecuritericon.svg" />
        <label>Compte et sécurité</label>
      </div>
      <div>

        <label>Nom</label>
        <input type="text" placeholder="Pseudoname " v-model="form.name" name="name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"/>
        <has-error :form="form" field="name" style="color:red"></has-error>

        <!-- <label>Email</label>
        <input placeholder="Votre Email " v-model="form.email" type="text" name="email"
        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }"/>
        <has-error :form="form" field="email"></has-error> -->

        <label>Numéro de téléphone</label>
        <input type="text" placeholder="Téléphone " v-model="form.phone" name="phone"
        class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }"/>
        <has-error :form="form" field="phone" style="color:red"></has-error>

        <label>Pays</label>
        <input type="text" placeholder="Pays " v-model="form.country" name="country"
        class="form-control" :class="{ 'is-invalid': form.errors.has('country') }"/>
        <has-error :form="form" field="country" style="color:red"></has-error>

        <label>Ville</label>
        <input type="text" placeholder="Ville " v-model="form.city" name="city"
        class="form-control" :class="{ 'is-invalid': form.errors.has('city') }"/>
        <has-error :form="form" field="city" style="color:red"></has-error>
<!--
        <label>Code postal</label>
        <input type="text" placeholder="Code postal " v-model="form.code_postal" name="code_postal"
        class="form-control" :class="{ 'is-invalid': form.errors.has('code_postal') }"/>
        <has-error :form="form" field="code_postal"></has-error> -->

        <label>Adresse</label>
        <textarea id cols="30" rows="5" placeholder="Adresse" v-model="form.address" name="address"
        class="form-control" :class="{ 'is-invalid': form.errors.has('address') }"></textarea>
        <has-error :form="form" field="address" style="color:red"></has-error>


        <button :disabled="form.busy" type="submit">Modifier / Valider</button>
      </div>
    </div>
  </form>
</template>

<script>
import {
    Form,
    HasError,
    AlertError
} from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  name: "Compteclient",
  components: {
    pageclientimage
  },
  data(){
      return{
          form: new Form({
            name: '',
            email: '',
            phone: '',
            country: '',
            city: '',
            address: '',
          })
      }
  },
  methods:{
      modifyProfile(){
          this.form.put('/api/customer/profile')
            .then(({ data }) => console.log(data))
      },
      getProfile(){
          axios.get('/api/customer/profile')
          .then(res => this.form = new Form(res.data.profile))
          .catch(err => console.log(err))
      }
  },
  mounted(){
      this.getProfile()
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

#arriereplan {
  max-width: 800px;
  padding: 20px 100px;
  box-sizing: border-box;
  margin: auto;
  background-image: url('~@/assets/arriereplanicon.svg');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: auto 77%;
  background-color: #ffffffe3;
  border: 1px solid orange;
  border-radius: 10px;
  margin-top: -45px;
  position: relative;
  margin-bottom: 30px;

  +for_s() {
    width: calc(100% - 20px);
    padding: 10px;
    margin-left: 10px;
    margin-right: 10px;
    box-sizing: border-box;
  }

  div:first-child {
    display: flex;
    flex-direction: column;
    align-items: center;

    label {
      font-size: 30px;
      font-weight: bold;

      +for_s() {
        font-size: 20pt;
      }
    }

    img {
      width: 65px;

      +for_s() {
        width: 40px;
      }
    }
  }

  div:nth-child(2) {
    width: max-content;
    align-self: flex-start;
    margin-top: 20px;

    +for_s() {
      margin-top: 30px;
    }

    label {
      font-size: 18pt;
      font-weight: bold;

      +for_s() {
        font-size: 12pt;
        margin-top: 30px;
      }
    }

    img {
      width: 35px;
      margin-bottom: -4px;
      margin-right: 10px;

      +for_s() {
        width: 20px;
      }
    }
  }

  div:nth-child(3) {
    display: flex;
    flex-direction: column;
    align-items: flex-start;

    label {
      margin-top: 40px;
      font-size: 17pt;

      +for_s() {
        margin-top: 20px;
        font-size: 11pt;
      }
    }

    input {
      width: 100%;
      border: 1px solid orange;
      border-radius: 10px;
      outline: none;
      margin: 10px 0px;
      padding: 10px;
      box-sizing: border-box;
      background-color: #F2F2F2;
      font-size: 15pt;

      +for_s() {
        font-size: 11pt;
      }
    }

    textarea {
      border: 1px solid #f29537;
      border-radius: 10px;
      background-color: #f2f2f2;
      padding: 15px;
      margin-bottom: 20px;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      font-size: 13pt;
      width: 100%;
      margin: 10px 0px;
      box-sizing: border-box;

      +for_s() {
        font-size: 11pt;
      }
    }

    button {
      margin-top: 20px;
      background-color: orange;
      padding: 10px 20px;
      color: white;
      border: none;
      border-radius: 10px;
      align-self: flex-end;
      font-size: 17pt;

      +for_s() {
        font-size: 11pt;
        align-self: center;
      }
    }
  }
}
</style>


