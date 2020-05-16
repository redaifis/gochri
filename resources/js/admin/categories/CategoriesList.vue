<template>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="card-title">View all categories</h3>
                        <button class="btn btn-primary btn-sm ml-3 mr-auto" @click="addCategory()">+ Ajouter</button>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Nom..." v-model="search">
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Slug</th>
                                    <th>Sous-catégories</th>
                                    <th>Nombre de produits</th>
                                    <th colspan="3">actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in pageOfCategories" :key="category.id">
                                    <td style="vertical-align: middle;">{{category.id}}</td>
                                    <td style="vertical-align: middle;">{{category.name}}</td>
                                    <td style="vertical-align: middle;">{{category.slug}}</td>
                                    <td style="vertical-align: middle;">{{category.subcategories_count}}</td>
                                    <td style="vertical-align: middle;">{{category.products_count}}</td>
                                    <td style="vertical-align: middle;"><a href="#" class="btn btn-sm border" @click="editCategory(category.name,category.id)"><i class="fas fa-pen    "></i> Modifier</a></td>
                                    <td style="vertical-align: middle;">
                                        <form :id="'delete-category'+category.id">
                                            <button class="btn btn-danger btn-sm" type="submit" @click.prevent="deleteCategory(category.id)"><i class="fas fa-trash"></i> Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer pb-0 pt-3 text-center">
                        <jw-pagination :items="filteredList" @changePage="onChangePage"></jw-pagination>
                    </div>
                    
                </div>
            </div>
        </div>
</template>

<script>
export default {
    data(){
        return{
            categories: [],
            search: '',
            pageOfCategories: [],
        }
    },
    methods: {
        onChangePage(pageOfCategories) {
            // update page of categories
            this.pageOfCategories = pageOfCategories;
        },
        getCategories(){
            axios.get('/api/admin/categories')
            .then(res => this.categories = res.data.categories)
            .catch(err => console.log(err))
        },
        addCategory(){
            this.$swal({
                title: 'Ajouter une catégorie',
                input: 'text',
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Ajouter',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Le nom de catégorie est obligatoire!'
                    }
                },
                preConfirm: (category) => {
                    this.$swal.showLoading()
                    return axios.post('/api/admin/categories', {category: category})
                    .then(response => {
                        this.$swal(
                            'Succés',
                            'La catégorie a été ajouté avec succés!',
                            'success')
                        this.getCategories()
                    })
                    .catch(err => {
                        this.$swal(
                        'Erreur!',
                        `${err.response.data.errors.category[0]}`,
                        'error'
                        )
                    })
                },
            })
        },
        editCategory(category,id){
                this.$swal({
                title: 'Modifié la catégorie',
                input: 'text',
                inputValue: category,
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Appliquer',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Le nom de catégorie est obligatoire!'
                    }
                },
                preConfirm: (editedCategory) => {
                    this.$swal.showLoading()
                    return axios.put('/api/admin/categories/'+id, {editedCategory: editedCategory})
                    .then(response => {
                        this.$swal(
                            'Succés',
                            'La categorie a été modifié avec succés!',
                            'success')
                        this.getCategories()
                    })
                    .catch(error => {
                        this.$swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })
                },
            })
        },
        deleteCategory(id){
            this.$swal({
                title: 'êtes vous sûr de supprimer cette categorie?',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annuler',
                preConfirm: () => {
                    this.$swal.showLoading()
                    return axios.delete(`/api/admin/categories/${id}`)
                    .then(res => {
                        this.$swal({
                        title: 'Succés!',
                        description: 'La catégorie a été supprimé avec succés!',
                        icon:'success',
                        })
                        this.getCategories()
                    })
                    .catch(error => {
                        this.$swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })
                }
            })
        }
    },
    computed: {
        filteredList() {
            return this.categories.filter(category => {
                return category.name.toLowerCase().includes(this.search.toLowerCase())
            })            
        }
    },
    mounted(){
        this.getCategories()
    }
}
</script>