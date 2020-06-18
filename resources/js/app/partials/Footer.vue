<template>
    <div>
        <div class="up-footer">
      <div class="socialmedia">
        <label>Suivez-nous sur :</label>
        <a href="#">
          <img src="@/assets/facebook.svg" />
        </a>
        <a href="#">
          <img src="@/assets/instagram.svg" />
        </a>
        <a href="#">
          <img src="@/assets/youtube.svg" />
        </a>
        <a href="#">
          <img src="@/assets/whatsapp.svg" />
        </a>
      </div>
    </div>


    <div class="footer">
      <img class="logo" src="@/assets/logo.svg" />
      <div>
        <a href="/">Acceuil</a>
        <a href="#">Les nouveautés</a>
        <a href="#">Les promotions</a>
      </div>
      <div>
        <a href="#">Nos services</a>
        <a href="#">Livraison standard</a>
        <a href="#">Livraison express</a>
        <a href="#">Paiement</a>

      </div>
      <div>
        <label>Liens utiles</label>
        <a href="/privacy-policy">Politique de confidentialité</a>
        <a href="#">Service client</a>
        <a href="#">FAQ</a>
      </div>
      <div>
        <label>SERVICE CLIENT</label>
        <label>Du Lundi au Samedi de 8H00 à 22H00</label>
        <div class="contact_num">
          <img src="@/assets/tel.svg" />
          <label>06 25 36 21 25</label>
          <label>Appel non surtaxé</label>
        </div>
      </div>
    </div>


    <label
      class="credit"
    >Design par OUMAIMA BEN JADI et FATIMA BOUTOUMAT Développé par ATIKA AGLILI, REDA IFIS et ABDELKARIM CHAFAI</label>
    <a class="footerpolicy" href="policypage">Politique de confidentialité</a>
    </div>
</template>

<script>
export default {

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

.footer {
  background-color: #333333;
  color: orange;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 20px 40px;

  +for_m() {
    padding: 20px 20px;
  }

  .logo {
    width: 116px;
  }

  &> div {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  a {
    color: orange;
    text-decoration: none;
    margin-bottom: 5px;
  }

  &> div:last-child {
    color: white;
    width: 300px;
    text-align: center;

    +for_m() {
      width: 185px;
    }
  }

  & label:first-child, & a:first-child {
    font-weight: bold;
    font-size: 14pt;
    color: orange;
    margin-bottom: 5px;
  }

  +for_s() {
    flex-direction: column;
    align-items: center;

    &>div {
      display: none;
    }

    &>div:last-child {
      display: flex;
      align-items: center;
      margin: 20px 10px;
      max-width: 100%;

      .newsletter {
        flex-direction: column;
        align-items: center;

        button {
          margin-top: 10px;
        }
      }
    }
  }

  .contact_num {
    background-color: #000000b5;
    border-radius: 50px;
    display: grid;
    grid-template-columns: max-content max-content;
    align-items: center;
    padding: 15px;
    color: white;
    justify-content: center;
    box-sizing: border-box;
    font-size: 16pt;
    margin-top: 20px;
    width: 100%;

    &:hover img {
      transform: rotate(45deg);
    }

    +for_m() {
      width: auto;
    }

    label:last-child {
      grid-column: span 2;
      font-size: 8pt;
      margin-top: 5px;
      color: grey;
    }

    img {
      transition: transform 0.5s;
      margin-right: 10px;
      width: 28px;
      transform: rotate(135deg);
    }
  }

  +for_s() {
    flex-direction: column-reverse;
    align-items: center;

    .contact_num {
      margin-bottom: 20px;
      width: 215px;
    }
  }
}

.newsletter {
  display: flex;
  flex-direction: row;
  margin-top: 10px;

  input {
    border: 1px solid orange;
    border-radius: 10px;
    padding: 5px 10px;
    color: grey;
    width: 274px;
    font-size: 10pt;
    box-sizing: border-box;
    outline: none;
  }

  button {
    background-color: orange;
    color: white;
    border-radius: 10px;
    border: none;
    padding: 5px 15px;
    margin-left: 10px;
  }
}

.up-footer {
  background-color: orange;
  display: flex;
  color: #333333;
  justify-content: flex-start;
  font-size: 20pt;
  padding: 30px 40px;
  font-weight: bold;

  +for_s() {
    padding: 30px 0px;
  }

  label {
    margin-right: 10px;
  }

  .socialmedia {
    display: flex;
    align-items: center;

    // margin: auto;(a TEST)
    a {
      margin: 10px;
      transition: transform 0.3s;

      &:hover {
        transform: rotate(-10deg) scale(1.3);
      }

      img {
        width: 40px;
      }
    }

    +for_s() {
      display: grid;
      grid-template-columns: repeat(4, max-content);
      margin: auto;

      & :first-child {
        grid-column: span 4;
        font-size: 13pt;
        margin-bottom: 10px;
        margin-right: 0px;
      }

      a {
        margin: 10px 10px 0px 10px;

        img {
          margin: 0px;
          display: block;
        }
      }
    }
  }
}

.credit {
  font-size: 8pt;
  background-color: #333333;
  color: grey;
  display: block;
  padding: 30px 0px 10px 0px;

  +for_s() {
    padding: 30px 20px;
  }
}



.footerpolicy {
  background-color: #333;
  display: block;
  color: #808080;
  text-decoration: none;
  font-size: 12pt;
  padding-bottom: 20px;

  &:hover {
    color: orange;
  }
}
</style>
