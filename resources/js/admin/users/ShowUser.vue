<template>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <img class="img-circle elevation-2" :src="'/storage/images/profiles/'+(user.image || 'default_profile.jpg')" alt="User Avatar" style="max-width:100px">
                        </div>
                        <div class="col-12 text-center my-2">
                            <h2 class="mb-1">{{user.name}}</h2>
                            <p class="m-0">{{user.role}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="mb-4 mt-2">Informations sur l'utilisateur:</h5>
                        </div>
                        <div class="col-6">
                            <p><span class="font-weight-bold">Email:</span> <span :class="user.Email === null ? 'font-italic' : ''">{{user.email}}</span></p>
                        </div>
                        <div class="col-6">
                            <p><span class="font-weight-bold">Téléphone:</span> <span :class="user.phone === null ? 'font-italic' : ''">{{user.phone !== null ? user.phone : 'Non disponible'}}</span></p>
                        </div>
                        <div class="col-6">
                            <p><span class="font-weight-bold">Pays:</span> <span :class="user.country === null ? 'font-italic' : ''">{{user.country !== null ? user.country : 'Non disponible'}}</span></p>
                        </div>
                        <div class="col-6">
                            <p><span class="font-weight-bold">Ville:</span> <span :class="user.city === null ? 'font-italic' : ''">{{user.city !== null ? user.city : 'Non disponible'}}</span></p>
                        </div>
                        <div class="col-12">
                            <p><span class="font-weight-bold">Adresse:</span> <span  :class="user.address === null ? 'font-italic' : ''">{{user.address !== null ? user.address : 'Non disponible'}}</span></p>
                        </div>
                        <div class="col-12">
                            <p><span class="font-weight-bold">Nombre de commandes:</span> <span :class="user.orders_count === null ? 'font-italic' : ''"></span>{{user.orders_count}}</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Les dernières commandes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width: 10px">Id</th>
                      <th>date</th>
                      <th>Montant</th>
                      <th>Êtat</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="order in user.orders" :key="order.id">
                        <td>{{order.id}}</td>
                        <td>{{order.created_at | moment('Do MMMM YYYY, h:mm:ss a')}}</td>
                        <td>{{order.amount}}</td>
                        <td>{{order.status}}</td>
                        <td><a :href="'/admin/orders/'+order.id" class="btn btn-default btn-sm border d-flex flex-row align-items-center"><i class="fas fa-eye mr-1"></i> Aperçu</a></td>
                    </tr>
                    
                  </tbody>
                  
                </table>
                <div class="card-footer text-center">
                      <a href="#" class="text-dark">Voir toutes les commandes</a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        
    </div>

</template>

<script>
export default {
    data(){
        return{
            userId : window.userId,
            user: []
        }
    },
    methods: {
        getUser(){
            axios.get('/api/admin/users/'+this.userId)
            .then(res => this.user = res.data.user)
            .catch(err => console.log(err))
        }
    },
    mounted(){
        this.getUser()
        if(this.user.orders !==  undefined && this.user.orders.length > 0) this.user.orders.splice(5)
    }
}
</script>

<style scoped>

</style>
