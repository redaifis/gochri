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
                                <tr v-for="subcategorie in pageOfsubcategories" :key="subcategorie.id">
                                    <td style="vertical-align: middle;">{{subcategorie.id}}</td>
                                    <td style="vertical-align: middle;">{{subcategorie.name}}</td>
                                    <td style="vertical-align: middle;">{{subcategorie.slug}}</td>
                                    <td style="vertical-align: middle;">{{subcategorie.categorie.name}}</td>
                                    <td style="vertical-align: middle;">{{subcategorie.products_count}}</td>
                                    <td style="vertical-align: middle;"><a href="#" class="btn btn-sm border" @click="editSubcategorie(subcategorie.name,subcategorie.id,subcategorie.categorie.id)"><i class="fas fa-pen    "></i> Modifier</a></td>
                                    <td style="vertical-align: middle;">
                                        <form :action="'/admin/subcategories/'+subcategorie.id" method="post" :id="'delete-subcategorie'+subcategorie.id">
                                            <input type="hidden" name="_token" :value="csrf">
                                            <input type="hidden" name="_method" value="delete">
                                            <button class="btn btn-danger btn-sm" type="submit" @click.prevent="deleteSubcategorie(subcategorie.id)"><i class="fas fa-trash    "></i> Supprimer</button>
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
    
    props:['subcategories','csrf','errors','success'],
    data(){
        return{
            images: null,
            search: '',
            pageOfsubcategories: []
        }
    },
    methods: {
        onChangePage(pageOfsubcategories) {
            // update page of subcategories
            this.pageOfsubcategories = pageOfsubcategories;
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
        editSubcategorie(subcategorie,id,categorie_id){
                this.$swal({
                title: 'Modifié la sous-catégorie',
                input: 'text',
                inputValue: subcategorie,
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Appliquer',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Le nom de sous-catégorie est obligatoire!'
                    }
                },
                preConfirm: (editedsubcategorie) => {
                    return axios.put('/admin/subcategories/'+id, {editedSubcategorie: editedsubcategorie,categorie_id: categorie_id})
                    .then(response => { location.reload() })
                    .catch(error => {
                        this.$swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    })
                },
            })
        },
        deleteSubcategorie(id){
            this.$swal({
                title: 'êtes vous sûr de supprimer cette categorie?',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Annuler',
                preConfirm: () => {
                    document.getElementById('delete-subcategorie'+id).submit()
                }
            })
        }
    },
    computed: {
        filteredList() {
            
            return this.subcategories.filter(subcategorie => {
                return subcategorie.name.toLowerCase().includes(this.search.toLowerCase())
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