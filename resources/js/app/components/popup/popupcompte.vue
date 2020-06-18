<template>
<div>
  <form id="popupcompte" v-bind:class="{'hidden':!active}" v-if="user.id == undefined">
    <button v-on:click.prevent="$emit('close')" class="close"><i class="fas fa-times    "></i></button>
    <label class="title">Accéder à votre compte</label>
    <label>
      Connectez-vous pour retrouver
      tous vos services
    </label>
    <p style="color:red" v-if="error">Email ou mots de passe est incorrecte!</p>
    <input type="email" name="email" placeholder="Adresse e-mail" />
    <input type="password" name="password" placeholder="Mot de passe" />

    <div class="social">
      <label>Se Connecter avec :</label>
      <div>
        <a href="/redirect/facebook"><img src="@/assets/facebook1.png" /></a>
        <a href="/redirect/google"><img src="@/assets/google.png" /></a>
      </div>
    </div>

    <button @click.prevent="login" v-if="!isLoading">Me connecter</button>
    <div class="loadingspinner" v-if="isLoading"></div>
    <label class="title">Vous n’avez pas encore un compte ?</label>
    <a href="/register">Créer mon compte</a>
    <a href="/">Mot de passe oublié ?</a>
  </form>
    <form id="popupcompte" v-bind:class="{'hidden':!active}" v-if="user.id  != undefined">
        <button v-on:click.prevent="$emit('close')" class="close"><i class="fas fa-times"></i></button>
        <label class="title" style="margin-top:20px">Vous êtes connecté.</label>
        <p style="margin-top:0">Bienvenue {{user.name}}!</p>
        <div v-if="user.role === 'customer'">
            <img :src="user.image.includes('https://') ? user.image :'/storage/images/profiles/' + user.image" alt="profile image" style="border-radius: 100%;width:80px">
            <p style="margin:10px 0"><a href="/customer/dashboard" style="text-decoration:none">Tableau de bord</a></p>
            <p style="margin:10px 0"><a href="/customer/orders" style="text-decoration:none">Mes commandes</a></p>
            <p style="margin:10px 0"><a href="/customer/wishlist" style="text-decoration:none">Wishlist</a></p>
            <p style="margin:10px 0"><a href="/customer/compte" style="text-decoration:none">Mon compte</a></p>
            <p style="margin:10px 0"><a href="/contact" style="text-decoration:none">Contactez nous</a></p>
            <button @click.prevent="logout()" style="text-decoration:none;margin:10px 0 0 0 " href="/logout" >Déconnecter</button>
        </div>
        <div v-else>
            <img :src="user.image.includes('https://') ? user.image :'/storage/images/profiles/' + user.image" alt="profile image" style="border-radius: 100%;width:80px">
            <p style="margin:10px 0"><a href="/admin/dashboard" style="text-decoration:none">Tableau de bord</a></p>
            <button @click.prevent="logout()" style="text-decoration:none;margin:10px 0 0 0 " href="/logout" >Déconnecter</button>
        </div>

    </form>
</div>
</template>

<script>
export default {
  props: ['active','user'],
  data(){
      return{
          isLoading: false,
          error: false
      }
  },
  methods:{
      async login(){
          this.isLoading = true
          let loginForm = document.getElementById('popupcompte');
          let data = new FormData(loginForm)
          await axios.post(`/login`, data)
          .then(res => location.reload())
          .catch(err => {
              console.log(err)
              this.error = true
            })
          this.isLoading = false
      },
      logout(){
          axios.post('/logout')
          .then(res => window.location.href = '/')
          .catch(err => console.log(err))
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

#popupcompte {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: fixed;
  z-index: 11;
  background-color: white;
  border-radius: 10px;
  padding: 40px;
  top: 100px;
  right: 10px;
  border: 1px solid orange;
  border-width: 0px 1px 1px 1px;
//   width: 360px;
box-shadow: 0 2px 5px rgba(0,0,0,0.25);

  +for_s() {
    padding: 20px;
  }

  &.hidden {
    display: none;
  }

  button, .inscrit {
    width: max-content;
    color: white;
    margin: 0px;
    margin-bottom: 20px;
    font-size: 13pt;
  }

  .social {
    display: flex;
    align-content: center;
    flex-direction: column;

    label {
      font-weight: bold;
      font-size: 13pt;
      margin-bottom: 10px;
      margin-top: 10px;
    }

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

  .signup {
    width: max-content;
    color: white;
    margin: 0px;
    margin-bottom: 20px;
    font-size: 13pt;
  }

  &>* {
    margin-bottom: 20px;

    +for_s() {
      font-size: 11pt;
    }
  }

  .title {
    font-size: 18pt;
    font-weight: bold;

    +for_s() {
      font-size: 13pt;
    }
  }

  input {
    width: 250px;
    border: 2px solid orange;
    border-radius: 10px;
    font-size: 14pt;
    color: grey;
    outline: none;
    padding: 10px;

    +for_s() {
      width: 180px;
      font-size: 11pt;
    }
  }

  .close {
    align-self: flex-end;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    margin: 0;
    font-size: 12pt;

    +for_s() {
      font-size: 10px;
    }
  }

  a {
    margin-bottom: 0px;
    font-weight: bold;
    color: orange;
    font-size: 13pt;
    text-decoration: none;
    margin: 5px 0;
  }
}

</style>
