<template>
  <div>
    
    <!-- <Header></Header> -->

    <div id="content">

    </div>

    

  </div>
</template>

<script>
import Header from '../partials/Header'
export default {
    components: {Header},
    data(){
      return{
        users: []
      }
    },
    mounted(){
      axios.get(`/api/users`)
      .then(res => this.users = res.data.users)
      .catch(err => console.log(err))
    }
}
</script>

<style>

</style>