<template>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View all categories</h3>

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
                                <tr v-for="categorie in pageOfcategories" :key="categorie.id">
                                    <td style="vertical-align: middle;">{{categorie.id}}</td>
                                    <td style="vertical-align: middle;">{{categorie.name}}</td>
                                    <td style="vertical-align: middle;">{{categorie.slug}}</td>
                                    <td style="vertical-align: middle;">{{categorie.subcategories_count}}</td>
                                    <td style="vertical-align: middle;">{{categorie.products_count}}</td>
                                    <td style="vertical-align: middle;"><a href="#" class="btn btn-sm border" @click="editCategorie(categorie.name,categorie.id)"><i class="fas fa-pen    "></i> Modifier</a></td>
                                    <td style="vertical-align: middle;">
                                        <form :action="'/admin/categories/'+categorie.id" method="post" :id="'delete-categorie'+categorie.id">
                                            <input type="hidden" name="_token" :value="csrf">
                                            <input type="hidden" name="_method" value="delete">
                                            <button class="btn btn-danger btn-sm" type="submit" @click.prevent="deleteCategorie(categorie.id)"><i class="fas fa-trash"></i> Supprimer</button>
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
    props:['categories','csrf','errors','success'],
    data(){
        return{
            images: null,
            search: '',
            pageOfcategories: [],
        }
    },
    methods: {
        onChangePage(pageOfcategories) {
            // update page of categories
            this.pageOfcategories = pageOfcategories;
        },
        showSuccess() {
            // Show success message if exist
            this.$swal({
                icon: 'success',
                title: this.success,
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    container: 'mb-5 ml-4',
                },
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', this.$swal.stopTimer)
                    toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                }
            })
        },
        editCategorie(categorie,id){
                this.$swal({
                title: 'Modifié la catégorie',
                input: 'text',
                inputValue: categorie,
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Appliquer',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Le nom de catégorie est obligatoire!'
                    }
                },
                preConfirm: (editedCategorie) => {
                    return axios.put('/admin/categories/'+id, {editedCategorie: editedCategorie})
                    .then(response => { location.reload() })
                    .catch(error => {
                        this.$swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })
                },
            })
        },
        deleteCategorie(id){
            this.$swal({
                title: 'êtes vous sûr de supprimer cette categorie?',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annuler',
                preConfirm: () => {
                    document.getElementById('delete-categorie'+id).submit()
                }
            })
        }
    },
    computed: {
        filteredList() {
            return this.categories.filter(categorie => {
                return categorie.name.toLowerCase().includes(this.search.toLowerCase())
            })            
        }
    },
    mounted(){
        if(this.success != null){
            this.showSuccess()
        }
    }
    
}
</script>

<style>

</style>