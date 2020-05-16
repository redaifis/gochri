<template>
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                  <h6 class="float-left m-0 py-1">Les methodes de livraison</h6>
                  <a href="#" class="btn btn-primary btn-sm float-right" @click="addMethod">Ajouter une méthode</a>
              </div>
              <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Méthode</th>
                            <th>Prix</th>
                            <th>Temps de livraison</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="method in shipping_methods" :key="method.id">
                            <td>{{method.id}}</td>
                            <td>{{method.name}}</td>
                            <td>{{method.price === null ? 'Gratuit' : method.price + ' Dh'}}</td>
                            <td>{{method.delivery_time}} Heure(s)</td>
                            <td><a href="#" class="btn btn-danger btn-sm" @click="deleteMethod(method.id)"><i class="fas fa-trash    "></i> Supprimer</a></td>
                        </tr>
                    </tbody>
                </table>
              </div>
              
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            shipping_methods: []
        }
    },
    methods: {
        getMethods(){
            axios.get('/api/admin/settings/shipping')
            .then(res => this.shipping_methods = res.data.shipping_methods)
            .catch(err => console.log(err))
        },
        addMethod(){
            this.$swal({
                title: 'Ajouter une méthode de livraison',
                html:   '<div class="form-group mt-3"><input type="text" id="name" class="form-control w-100 mb-3" placeholder="Nom de méthode">' +
                        '<input type="number" id="price" class="form-control w-100 mb-3" placeholder="Prix de méthode">' +
                        '<input type="number" id="time" class="form-control w-100" placeholder="Temps de livraison en Heure"></div>',
                focusConfirm: false,
                confirmButtonText: 'Ajouter',
                preConfirm: () => {
                    return [
                        document.getElementById('name').value,
                        document.getElementById('price').value,
                        document.getElementById('time').value
                    ]
                }
           }).then(data => {
               axios.post('/api/admin/settings/shipping', {
                   name: data.value[0],
                   price: data.value[1],
                   time: data.value[2]
               }).then(res => {
                   console.log(res)
                   this.getMethods()
                   this.$swal('Succés!',`${res.data.success}`,'success')
               }).catch(err => {
                   console.log(err)
                   this.$swal('Succés!',null,'error')
                })
           })
        },
        deleteMethod(id){
            this.$swal({
                title: 'Êtes vous sûr de supprimer cette méthode?',
                text: 'Assurez-vous qu\'aucune commande n\'utilise cette méthode avant de la supprimer.',
                showCancelButton: true,
                confirmButtonText: 'Confirmer',
                cancelButtonText: 'Annuler',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    axios.delete('/api/admin/settings/shipping/'+id)
                    .then(res => {
                        this.getMethods()
                        this.$swal('Succés',`${res.data.success}`,'success')
                    })
                    .catch(err => {
                        console.log(err)
                        this.$swal('Succés',null,'success')
                    })
                }
            })
        }
    },
    mounted(){
        this.getMethods()
    }
}
</script>

<style>

</style>