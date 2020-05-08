<template>
<div class="row justify-content-center">

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="/admin/subcategories" method="post">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="form-group">
                        <button class="btn btn-success btn-sm" @click.prevent="subcategories++">+ Ajouter</button>
                        <button class="btn btn-danger btn-sm ml-2" @click.prevent="subcategories > 1 ? subcategories-- : subcategories">- Supprimer</button>
                    </div>

                    <div class="form-group" v-for="subcategorie in subcategories" :key="subcategorie">
                        <label for="subcategories">Sous-catégorie {{subcategorie}}</label>
                        <input type="text" name="subcategories[]" id="subcategories" class="form-control" placeholder="Nom" aria-describedby="helpId" required>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="categorie">Catégorie principal</label>
                        <select class="form-control" name="categorie" id="categorie">
                          <option v-for='(categorie,index) in categories' :key="index" :value="categorie.id">{{categorie.name}}</option>
                        </select>
                    </div>
                    
                    <button class="btn btn-primary mt-4">Créer</button>
                </form>
            </div>

        </div>

    </div>

</div>
</template>


<script>

export default {
    props:['categories', 'csrf', 'errors'],
    data() {
        return {
            subcategories: 1
        }
    },
    methods: {
        showErrors(){
            this.$swal(
                {
                icon: 'error',
                title: 'Les données sont incorrectes!',
                text: this.errors[0],
                confirmButtonText: 'Ok',
                },
            );
        }
    },
    mounted(){
        if(this.errors.length>0){
            this.showErrors()
        }
    }
}
</script>

<style>

</style>

