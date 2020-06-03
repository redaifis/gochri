<template>
  <form @submit.prevent="login" >
    <pageclientimage />
    <div class="connection">
      <div>
        <label>Bienvenu sur</label>
        <img class="logo" src="@/assets/logo.svg" />
      </div>
      <div>
        <label>Connection</label>
        <input type="email" name="email" id="email" placeholder="Adresse e-mail" v-model="user.email" :class="{ 'is-invalid': user.error != '' }" required/>
        <input type="password" name="password" id="password" placeholder="Mot de passe" v-model="user.password" :class="{ 'is-invalid': user.error != '' }" required/>
        <small v-show="user.error != ''" style="color:red">{{user.error}}</small>
        <div class="social">
          <label>Se Connecter avec :</label>
          <div>
                <a href="/redirect/facebook"><img src="@/assets/facebook1.png" /></a>
                <a href="/redirect/google"><img src="@/assets/google.png" /></a>
          </div>
        </div>
        <div>
          <a href="/register">Créer un compte ?</a>
          <a href="#">Mot de passe oublier !</a>
        </div>
      </div>
      <button :disabled="user.busy === true" type="submit">Se connecter</button>
    </div>
  </form>
</template>

<script>
import pageclientimage from "@/components/Pageclientimage.vue";

export default {
  name: "login",
  components: {
    pageclientimage
  },
  data(){
      return{
          user: {
              email: '',
              password: '',
              error: '',
              busy: false
          }


      }
  },
  methods:{
       login(){
          this.user.busy = true
         axios.post('/login', this.user)
        .then(res => window.location.href = '/customer/dashboard')
        .catch(err => {
            console.log(err.response.data.error)
            this.user.error = err.response.data.error
            this.user.busy = false
            })

      }
  }
}
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


.connection {
  background-image: url('~@/assets/arriereplanicon.svg');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: auto 77%;
  margin: 30px;
  position: relative;
  background-color: rgba(255, 255, 255, 0.89);
  border: 1px solid orange;
  border-radius: 10px;
  width: max-content;
  padding: 20px 100px;
  margin: auto;
  margin-top: -45px;
  margin-bottom: 30px;

  +for_s() {
    width: calc(100% - 20px);
    padding: 10px;
    margin-left: 10px;
    margin-right: 10px;
    box-sizing: border-box;
  }

  div:first-child {
    font-size: 15pt;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-weight: bold;
    margin-bottom: 10px;

    +for_s() {
      margin-top: 10px;
    }

    .logo {
      width: 110px;
      margin-top: 10px;
    }
  }

  div:nth-child(2) {
    display: flex;
    flex-direction: column;
    align-items: center;

    label {
      display: flex;
      align-self: flex-start;
      font-weight: bold;
      font-size: 13pt;
      margin-bottom: 10px;
      margin-top: 30px;
    }

    input {
      border: 1px solid orange;
      border-radius: 10px;
      padding: 10px;
      margin: 10px 0px;
      width: 400px;
      outline: none;

      +for_s() {
        width: 100%;
        box-sizing: border-box;
      }
    }

    &>div:last-child {
      display: flex;
      width: max-content;
      margin-top: 30px;

      a:hover {
        color: orange;
      }

      +for_s() {
        margin-top: 30px;
      }

      a {
        color: #909090;
        font-size: 10pt;
        text-decoration: none;
        margin-bottom: 10px;

        &:nth-child(1) {
          margin-right: 20px;
        }
      }
    }
  }

  .social {
    display: flex;
    align-content: center;
    flex-direction: column;

    div {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;

      img {
        width: 30px;
        height: 30px;
        object-fit: contain;
        margin: 5px;
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
    margin-bottom: 20px;
    margin-top: 10px;

    +for_s() {
      font-size: 13px;
    }
  }
}

.is-invalid{
    border: 1px solid red!important
}
</style>
