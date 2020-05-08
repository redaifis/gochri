<template>
<div class="row justify-content-center">

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="/admin/categories" method="post">
                <input type="hidden" name="_token" :value="csrf">
                    <div class="form-group">
                        
                        <button class="btn btn-sm btn-success" @click.prevent="categories++">+ Ajouter</button>
                        <button class="btn btn-sm btn-danger ml-2" @click.prevent="categories > 1 ? categories-- : categories">- Supprimer</button>
                    </div>
                    <div class="form-group" v-for="categorie in categories" :key="categorie">
                        <label for="name">Catégorie {{categorie}}</label>
                        <input type="text" name="categories[]" id="name" class="form-control" placeholder="Nom" aria-describedby="helpId" required>
                        <!-- <small id="helpId" class="text-muted">Help text</small> -->
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
    props: ['errors','csrf'],
    data() {
        return {
            categories: 1,
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
