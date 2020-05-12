<template>
  <div>
    
    <Header></Header>

    <div id="content" class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="email" id="email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="password" id="password">
                                </div>
                                <button @click.prevent="login"  id="submit" class="btn btn-primary" type="button">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

  </div>
</template>

<script>
import Header from '../partials/Header'

export default {
    components: {Header},
    data(){
        return{
        }
    },
    methods: {
        login(){
            let email = document.getElementById('email').value
            let password = document.getElementById('password').value
            axios.post('/api/auth/login', { 
                email: email,
                password: password
            }).then(res => console.log(res))
            .catch(err => console.log(err))
        }
    }
}   
</script>

<style>

</style>