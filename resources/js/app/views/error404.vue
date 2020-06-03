<template>
  <div class="error404">
    <label>404</label>
    <div>
      <label>PAGE INTROUVABLE !</label>
      <label>Désolé, la page que vous cherchez est introuvable.</label>
      <a href="/">Retour à la page d'acceuil</a>
    </div>
  </div>
</template>

<script>
export default {};
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



.error404 {
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;

  &>label:first-child {
    font-size: 270pt;
    color: #f295373d;
    margin-bottom: 10px;

    +for_s() {
      font-size: 200pt;
    }
  }

  div {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;

    label:first-child {
      font-size: 25pt;
      margin-bottom: 10px;
      font-weight: bold;

      +for_s() {
        font-size: 20pt;
      }
    }

    label:nth-child(2) {
      font-size: 17pt;
      margin-bottom: 10px;

      +for_s() {
        font-size: 15pt;
      }
    }

    a {
      border: 1px solid orange;
      border-radius: 10px;
      text-decoration: none;
      color: white;
      padding: 5px 15px;
      margin-top: 10px;
      background-color: orange;

      +for_s() {
        font-size: 10pt;
      }
    }
  }
}
</style>
