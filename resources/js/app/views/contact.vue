<template>
  <div>
    <pageclientimage />
    <div class="contact">
      <div>
        <img src="@/assets/contact.svg" />
        <label>Contact</label>
      </div>
      <div>
        <div>
          <label>Besoin d'aide ?</label>
          <p>
            Question ? une information ? remplissez vos information suivi de votre message
            pour qu’ont puissent vous aider.
          </p>
        </div>
        <div>
          <label>Nos information !</label>
          <img src="@/assets/gpsincon.svg" />
          <label>Adresse : N°5 Rue Mohamed V Agadir</label>
          <img src="@/assets/phoneicon.svg" />
          <label>Téléphone : 06 25 36 21 25</label>
          <img src="@/assets/gmailicon.svg" />
          <label>Email : Contact@gochri.com</label>
        </div>
        <div>
          <input type="text" placeholder="Email" />
          <input type="text" placeholder="Nom et prénom" />
          <textarea name id cols="30" rows="10" placeholder="Votre message..."></textarea>
          <button>Envoyer</button>
        </div>

        <div>
          <iframe
            width="350"
            height="350"
            src="https://maps.google.com/maps?q=ewa%20agadir&t=&z=13&ie=UTF8&iwloc=&output=embed"
            frameborder="0"
            scrolling="no"
            marginheight="0"
            marginwidth="0"
            left="0"
          ></iframe>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import pageclientimage from "@/components/Pageclientimage.vue";
export default {
  name: "contact",
  components: {
    pageclientimage
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


.contact {
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
  padding: 20px 100px;
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
      font-size: 30px;
      font-weight: bold;
      margin-bottom: 45px;

      +for_s() {
        font-size: 20pt;
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

  div:nth-child(2) {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 70px;

    +for_m() {
      grid-gap: 40px;
    }

    +for_s() {
      grid-gap: 30px;
    }

    +for_s() {
      grid-template-columns: repeat(1, 1fr);

      div:first-child {
        order: 1;
      }

      div:nth-child(2) {
        order: 3;
        width: fit-content;
        margin: auto;
      }

      div:nth-child(3) {
        order: 2;
      }

      div:nth-child(4) {
        order: 4;
      }
    }

    div:first-child {
      display: flex;
      flex-direction: column;
      align-items: flex-start;

      label {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 20px;

        +for_s() {
          font-size: 18pt;
        }
      }

      p {
        text-align: left;

        +for_s() {
          font-size: 11pt;
        }
      }
    }

    div:nth-child(2) {
      display: grid;
      grid-template-columns: 30px auto;
      grid-gap: 10px;
      align-items: center;
      text-align: left;

      label:first-child {
        grid-column: span 2;
        font-size: 20pt;
        font-weight: bold;
        margin-bottom: 20px;

        +for_s() {
          font-size: 18pt;
        }
      }

      img {
        width: 30px;
        height: 30px;
        object-fit: contain;

        +for_s() {
          width: 20px;
          height: 20px;
        }
      }
    }

    div:nth-child(3) {
      display: flex;
      flex-direction: column;

      input, textarea {
        border: 1px solid #f29537;
        border-radius: 10px;
        background-color: #f2f2f2;
        padding: 15px;
        margin-bottom: 20px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        font-size: 13pt;

        +for_s() {
          font-size: 11pt;
        }
      }

      button {
        background-color: #f29537;
        border: none;
        border-radius: 10px;
        color: #fff;
        padding: 10px 30px;
        font-size: 18pt;
        margin-bottom: 20px;
        align-self: center;

        +for_s() {
          font-size: 12pt;
        }
      }
    }
  }
}
</style>
