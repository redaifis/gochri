<template>
<div class="justify-content-center">
    <!-- <div v-if="errors.length>0">{{showErrors(errors)}}</div> -->
    <form class="w-100 row pb-5" action="/admin/products" method="post" enctype="multipart/form-data">
        <div class="col-12 col-md-8">

            <div class="card">
                <div class="card-body">

                    <input type="hidden" name="_token" :value="csrf">

                    <div class="form-group mb-4">
                        <label for="name">Nom de produit</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" aria-describedby="helpId" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="8" placeholder="Description" required></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label for="image">Media</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image" placeholder="Image" aria-describedby="fileHelpId">
                            <label for="image" class="custom-file-label">Télécharger une image</label>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="row">
                            <div class="input-group col-md-6 col-12">
                                <label class="w-100" for="price">Prix</label>
                                <input type="number" name="price" id="price" step="0.01" class="form-control" placeholder="price" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">Dh</span>
                                </div>
                            </div>
                            <div class="input-group col-md-6 col-12">

                                <label class="w-100" for="discount">Promotion</label>
                                <input type="number" name="discount" id="discount" class="form-control" placeholder="Promo" aria-describedby="helpId">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="status" id="status" value="1" checked>
                                Publié
                            </label>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-12 col-md-4">
            <div class="row">

                <div class="card col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="subcategorie">Sous-catégorie</label>
                            <select class="form-control" name="subcategorie" id="subcategorie">
                                <option v-for="subcategorie in subcategories" :key="subcategorie.id" :value="subcategorie.id">{{subcategorie.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="vendor">Fournisseur</label>
                            <input class="form-control" type="text" name="vendor" id="vendor">
                        </div>

                    </div>
                </div>

                <div class="card col-12">
                    <div class="card-body">
                        <div>
                            <p class="text-bold">Réserve</p>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text text-sm" id="basic-addon1">Quantité</span>
                            </div>
                            <input type="number" name="stock" id="stock" min="1" class="form-control" placeholder="Quantité" aria-label="stock" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>

    </form>

</div>
</template>

<script>
export default {
    props: ['subcategories', 'csrf', 'errors'],
    data() {
        return {
            
            
        }
    },
    methods: {
        showErrors() {
            this.$swal({
                icon: 'error',
                title: 'Les données sont incorrectes!',
                text: this.errors[0],
                confirmButtonText: 'Ok',
                
            }, );
        }
    },
    mounted() {
        if (this.errors.length > 0) {
            this.showErrors()
        }
    }
}
</script>

<style>

</style>
