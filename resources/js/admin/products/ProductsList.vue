<template>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools row" style="float:none">
                            <div class="col-12 col-md-6 py-2">
                                <h3 class="card-title flex-start">Tous les produits</h3>
                            </div>
                            <div class="input-group input-group-sm py-2 col-12 col-md-2">
                                <select class="form-control float-right" id="searchCategorie" v-model="status">
                                    <option value="">Êtat</option>
                                    <option value="1">Publié</option>
                                    <option value="0">Non publié</option>
                                </select>
                            </div>
                            <div class="input-group input-group-sm py-2 col-12 col-md-2">
                                  <select class="form-control float-right" id="searchCategorie" v-model="categorieSearch">
                                        <option value="">Catégorie</option>
                                        <option v-for="category in categories" :key="category.id">{{category.name}}</option>
                                  </select>
                            </div>
                            <div class="input-group input-group-sm py-2 col-12 col-md-2">
                                <input type="text" class="form-control float-right" placeholder="Nom de produit" v-model="search">
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nom</th>
                                    <th>Prix</th>
                                    <th>Promotion</th>
                                    <th>Catégorie</th>
                                    <th>Êtat</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in pageOfProducts" :key="product.id">
                                    <td style="vertical-align: middle;"><img :src="'/storage/images/products/'+product.image" class="rounded-circle" style="width:50px;height:50px;object-fit:cover;" alt=""></td>
                                    <td style="vertical-align: middle;">{{product.name.length > 40 ? product.name.substring(0,40)+'...' : product.name}}</td>
                                    <td style="vertical-align: middle;">{{product.price}} Dh</td>
                                    <td style="vertical-align: middle;">{{product.discount != null ? product.discount + '%' : 'N/A'}}</td>
                                    <td style="vertical-align: middle;">{{product.category != null ? product.category.name : "N/A"}}</td>
                                    <td style="vertical-align: middle;"><span :class="['badge', product.status == 1 ? 'badge-success' : 'badge-warning']">{{product.status == 1 ? 'Publié' : 'Non Publié'}}</span></td>
                                    <td style="vertical-align: middle;">
                                        <a :href="'/admin/products/'+product.id+'/edit'" class="btn btn-default btn-sm border d-flex flex-row"><i class="fas fa-pen pt-1 pr-1"></i> Modifier</a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <button class="btn btn-danger btn-sm d-flex flex-row" @click="deleteProduct(product.id)"><i class="fas fa-trash pt-1 pr-1"></i> Supprimer</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer pb-0 pt-3 text-center">
                        <jw-pagination :items="searched" @changePage="onChangePage"></jw-pagination>
                    </div>
                    
                </div>
            </div>
        </div>
</template>

<script>

export default {
    data(){
        return{
            search: '',
            categorieSearch: '',
            status: '',
            pageOfProducts: [],
            products: [],
            categories: []
        }
    },
    methods: {
        onChangePage(pageOfProducts) {
            // update page of Products when searching
            this.pageOfProducts = pageOfProducts;
        },
        getProducts(){
            axios.get('/api/admin/products')
            .then(res => this.products = res.data.products)
            .catch(err => console.log(err))
        },
        getCategories(){
            axios.get('/api/admin/categories')
            .then(res => this.categories = res.data.categories)
            .catch(err => console.log(err))
        },
        deleteProduct(id){
            this.$swal({
                title: 'Supprimé ce produit?',
                showCancelButton: true,
                confirmButtonText: "Oui",
                cancelButtonText: "Annuler",
                preConfirm: () => {
                    axios.delete('/api/admin/products/'+id)
                    .then(res => {
                        this.getProducts()
                        this.$swal('Succés!',`${res.data.success}`,'success')
                    }).catch(err => console.log(err))
                }
            })
        }
    },
    computed: {
        searched(){
            return this.products.filter(product => {
                return product.category.name.toLowerCase().includes(this.categorieSearch.toLowerCase()) 
                && product.name.toLowerCase().includes(this.search.toLowerCase())
                && (product.status == this.status || this.status == '')
            })
        }
        
    },
    mounted(){
        this.getProducts()
        this.getCategories()
    }
}
</script>

<style>

</style>