<template>
    <div class="row">
        
        <div class="col-12 col-md-6">
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="card-body row">
                    
                    <div class="col-12 col-md-8">
                        <p class="display-4">{{user.name}}</p>
                        <p><span class="font-weight-bold">Rôle:</span> {{user.role}}</p>
                        <p><span class="font-weight-bold">Email:</span> {{user.email}}</p>
                        <p><span class="font-weight-bold">Téléphone:</span> {{user.phone != null ? user.phone : 'N/A'}}</p>
                        <p><span class="font-weight-bold">Pays:</span> {{user.country != null ? user.country : 'N/A'}}</p>
                        <p><span class="font-weight-bold">Ville:</span> {{user.city != null ? user.city : 'N/A'}}</p>
                        <span class="font-weight-bold">Adresse:</span><p> {{user.address != null ? user.address : 'N/A'}}</p>
                        <p><span class="font-weight-bold">Commandes:</span> {{user.orders_count}}</p>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <div class="row justify-content-center">
                            <img class="img-circle elevation-2" :src="'/storage/images/profiles/'+user.image" alt="User Avatar" style="width:80%">
                        </div>
                        <div class="row justify-content-center">
                            <button class="btn btn-primary border mt-4">Contacter</button>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Les dernières commandes</h3>

                <!-- <div class="card-tools">
                  <a href="#" class="text-info">Voir tous les commandes</a>
                </div> -->
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
                  <tbody v-if="user.orders.length>0">
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
    props:['user','errors','csrf'],
    data(){
        return{

        }
    },
    methods: {
        showErrors(){
            this.$swal(
                {
                icon: 'error',
                title: 'Les données sont incorrectes!',
                text: this.errors[0],
                customClass: {
                    confirmButton: 'btn btn-default',
                },
                confirmButtonText: 'Ok',
                buttonsStyling: false,
                },
            );
        }
    },
    created(){
        this.user.orders.splice(5)

    },
    mounted(){
        if(this.errors.length>0){
            this.showErrors()
        }
    }
}
</script>

<style scoped>
span{
    display: inline-block;
    width:100px
}
</style>
