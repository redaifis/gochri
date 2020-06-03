<template>
  <form @submit.prevent="register" @keydown="form.onKeydown($event)">
    <pageclientimage />
    <div class="inscription">
      <div>
        <img src="@/assets/compteclient.svg" />
        <label>Inscription</label>
        <label>Créer mon compte</label>
      </div>
      <div>
        <label>Veuillez inseret vos informations</label>
        <input type="text" placeholder="Nom et prénom" v-model="form.name" name="name"
         :class="{ 'is-invalid': form.errors.has('name') }" />
         <has-error :form="form" field="name" style="display:block!important;color:red;text-align: left;"></has-error>
        <input type="text" placeholder="Email" v-model="form.email" name="email"
         :class="{ 'is-invalid': form.errors.has('email') }" />
         <has-error :form="form" field="email" style="display:block!important;color:red;text-align: left;"></has-error>
        <input type="password" placeholder="Mot de passe" v-model="form.password" name="password"
         :class="{ 'is-invalid': form.errors.has('password') }" />
         <has-error :form="form" field="password" style="display:block!important;color:red;text-align: left;"></has-error>
        <input type="password" placeholder="Re-inserer votre mot de passe" v-model="form.password_confirmation" name="password_confirmation"
         :class="{ 'is-invalid': form.errors.has('password_confirmation') }" />
        <!-- <input type="text" placeholder="Numéro de téléphone" />
        <label>Votre date de naissance</label>
        <div>
          <select>
            <Option value="Jour">Jour</Option>
            <Option value="1">1</Option>
          </select>
          <select>
            <option value="Mois">Mois</option>
            <option value="Janvier">Janvier</option>
            <option value="Février">Février</option>
          </select>
          <select>
            <Option value="Année">Année</Option>
            <Option value="1949">1949</Option>
          </select>
        </div>
        <textarea cols="30" rows="10" placeholder="Adresse"></textarea> -->
      </div>
      <button type="submit" :disabled="form.busy">Inscrit</button>
    </div>
  </form>
</template>

<script>

import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  name: "inscription",
  components: {
    pageclientimage
  },
  data(){
      return{
          form: new Form({
                name: '',
                email: '',
                password: '',
          })
      }
  },
  methods:{
      register() {
        // Submit the form via a POST request
        this.form.post('/register')
            .then(() => window.location.href = '/login')
            .catch( err => console.log(err))
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


.inscription {
  border: 1px solid orange;
  border-radius: 10px;
  width: max-content;
  padding: 20px 100px;
  margin: auto;
  margin-top: -45px;
  position: relative;
  background-color: rgba(255, 255, 255, 0.89);
  margin-bottom: 40px;

  div:first-child {
    display: flex;
    flex-direction: column;
    align-items: center;

    label {
      font-size: 30px;
      font-weight: bold;
      margin-bottom: 20px;

      +for_s() {
        font-size: 20pt;
      }
    }

    img {
      width: 65px;
      margin-bottom: 10px;
    }
  }

  div:nth-child(2) {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin: auto;

    label {
      font-size: 15pt;
      font-weight: bold;
      margin-bottom: 20px;

      +for_s() {
        font-size: 13pt;
      }
    }

    input, select, textarea {
      border: 1px solid orange;
      border-radius: 10px;
      background-color: #F2F2F2;
      padding: 15px;
      width: 480px;
      margin-top: 20px;
      box-sizing: border-box;
      font-size: 13pt;

      +for_s() {
        font-size: 11pt;
        width: 100%;
      }
    }

    div {
      width: 480px;
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 20px;

      +for_s() {
        width: 100%;
        grid-gap: 10px;
      }

      select {
        width: 100%;
        outline: none;
      }

      option {
        font-size: 13pt;

        +for_s() {
          font-size: 11pt;
        }
      }
    }
  }

  button {
    background-color: orange;
    border: none;
    border-radius: 10px;
    color: white;
    padding: 10px 30px;
    font-size: 18pt;
    margin-top: 20px;

    +for_s() {
      font-size: 11pt;
    }
  }

  +for_s() {
    width: calc(100% - 20px);
    padding: 10px;
    margin-left: 10px;
    margin-right: 10px;
    box-sizing: border-box;
  }
}
</style>
