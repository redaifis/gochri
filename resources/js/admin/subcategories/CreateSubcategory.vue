<template>
<form action="/admin/subcategories" method="post">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" @click.prevent="subcategories_count++">+ Ajouter</button>
                        <button class="btn btn-danger btn-sm ml-2" @click.prevent="subcategories_count > 1 ? subcategories_count-- : subcategories_count">- Supprimer</button>
                    </div>

                    <div class="form-group" v-for="subcategory in subcategories_count" :key="subcategory">
                        <label for="subcategories">Sous-catégorie {{subcategory}}</label>
                        <input type="text" name="subcategories[]" class="form-control" placeholder="Nom" aria-describedby="helpId" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="categorie">Catégorie principal</label>
                        <select class="form-control" name="category">
                            <option v-for='(category,index) in categories' :key="index" :value="category.id">{{category.name}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
        <button type="submit" class="btn btn-primary my-3">Créer</button>
        </div>
    </div>
</form>
</template>

<script>
export default {
    props: ['csrf','errors'],
    data() {
        return {
            subcategories_count: 1,
            categories: []
        }
    },
    methods: {
        showError(){
            this.$swal('Erreur!',`${this.errors[0]}`,'error')
        },
        getCategories() {
            axios.get('/api/admin/categories')
                .then(res => this.categories = res.data.categories)
                .catch(err => console.log(err))
        },
    },
    mounted() {
        this.getCategories()

        if(this.errors.length>0){
            this.showError()
        }
    }
}
</script>

<style>

</style>
