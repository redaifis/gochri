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
    props:['shipping_methods'],
    methods:{
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
               axios.post('/admin/settings/shipping', {
                   name: data.value[0],
                   price: data.value[1],
                   time: data.value[2]
               }).then(res => {
                    this.$swal({
                        title: 'Succés',
                        icon: 'success'
                    }).then(() => window.location.reload())
                })
                .catch(err => {
                    this.$swal({
                        title: 'Erreur!',
                        icon: 'warning'
                    })
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
                    axios.delete('/admin/settings/shipping/'+id)
                    .then(res => {
                        this.$swal({
                            title: 'Succés',
                            icon: 'success'
                        }).then(() => window.location.reload())
                    })
                    .catch(err => {
                        this.$swal({
                            title: 'Erreur!',
                            icon: 'warning'
                        })
                    })
                }
            })
        },

    }
}
</script>

<style>

</style>