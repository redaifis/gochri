<template>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    
                    <div class="card-header">
                        <h3 class="card-title">View all subcategories</h3>
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
                                    <th>Catégorie</th>
                                    <th>Nombre de produits</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="subcategory in pageOfsubcategories" :key="subcategory.id">
                                    <td style="vertical-align: middle;">{{subcategory.id}}</td>
                                    <td style="vertical-align: middle;">{{subcategory.name}}</td>
                                    <td style="vertical-align: middle;">{{subcategory.slug}}</td>
                                    <td style="vertical-align: middle;">{{subcategory.category.name}}</td>
                                    <td style="vertical-align: middle;">{{subcategory.products_count}}</td>
                                    <td style="vertical-align: middle;">
                                        <a href="#" class="btn btn-sm border" @click="editSubcategory(subcategory.name,subcategory.id,subcategory.category.id)"><i class="fas fa-pen"></i> Modifier</a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <form :id="'delete-subcategory'+subcategory.id">
                                            <button class="btn btn-danger btn-sm" type="submit" @click.prevent="deleteSubcategory(subcategory.id)"><i class="fas fa-trash"></i> Supprimer</button>
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
            search: '',
            subcategories: [],
            pageOfsubcategories: []
        }
    },
    methods: {
        onChangePage(pageOfsubcategories) {
            // update page of subcategories
            this.pageOfsubcategories = pageOfsubcategories;
        },
        getSubcategories(){
            axios.get('/api/admin/subcategories')
            .then(res => this.subcategories = res.data.subcategories)
            .catch(err => console.log(err))
        },
        editSubcategory(subcategory,id){
                this.$swal({
                title: 'Modifié la sous-catégorie',
                input: 'text',
                inputValue: subcategory,
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Appliquer',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Le nom de sous-catègorie est obligatoire!'
                    }
                },
                preConfirm: (editedSubcategory) => {
                    this.$swal.showLoading()
                    return axios.put('/api/admin/subcategories/'+id, {editedSubcategory: editedSubcategory})
                    .then(response => {
                        this.$swal(
                            'Succés',
                            'La sous-catègorie a été modifié avec succés!',
                            'success')
                        this.getSubcategories()
                    })
                    .catch(err => {
                        this.$swal(
                            'Erreur!',
                            `${err.response.data.errors.editedSubcategory[0]}`,
                            'error'
                        )
                    })
                },
            })
        },
        deleteSubcategory(id){
            this.$swal({
                title: 'êtes vous sûr de supprimer cette sous-categorie?',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annuler',
                preConfirm: () => {
                    this.$swal.showLoading()
                    return axios.delete(`/api/admin/subcategories/${id}`)
                    .then(res => {
                        this.$swal({
                        titleText: 'La sous-catégorie a été supprimé avec succés!',
                        icon:'success',
                        })
                        this.getSubcategories()
                    })
                    .catch(err => {
                        this.$swal(
                            'Erreur!',
                            `${err}`,
                            'error'
                        )
                    })
                }
            })
        }
    },
    computed: {
        filteredList() {
            return this.subcategories.filter(subcategory => {
                return subcategory.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    },
    mounted(){
        this.getSubcategories()
    }
}
</script>

<style>

</style>