<template>
<div class="justify-content-center">
    <!-- <div v-if="errors.length>0">{{showErrors(errors)}}</div> -->
    <form class="w-100 row pb-5" :action="'/admin/products/'+product.id" method="post" enctype="multipart/form-data">
        
        <input type="hidden" name="_token" :value="csrf">
        <input type="hidden" name="_method" value="put">

        <div class="col-12 col-md-8">

            <div class="card">
                <div class="card-body">

                    <div class="form-group mb-4">
                        <label for="name">Nom de produit</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" aria-describedby="helpId" v-model="product.name" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="8" placeholder="Description"  v-model="product.description" required></textarea>
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
                                <input type="number" name="price" step="0.01" id="price" class="form-control" placeholder="price"  v-model="product.price" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">Dh</span>
                                </div>
                            </div>
                            <div class="input-group col-md-6 col-12">

                                <label class="w-100" for="discount">Promotion</label>
                                <input type="number" name="discount" id="discount" class="form-control" placeholder="Promo" aria-describedby="helpId"  v-model="product.discount">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="status" id="status" value="1" checked  v-model="product.status">
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
                                <option v-for="subcategorie in subcategories" :key="subcategorie.id" :value="subcategorie.id" :selected="product.subcategorie.id == subcategorie.id">{{subcategorie.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="vendor">Fournisseur</label>
                            <input class="form-control" type="text" name="vendor" id="vendor" v-model="product.vendor">
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
                            <input type="number" name="stock" id="stock" class="form-control" placeholder="Quantité" aria-label="stock" aria-describedby="basic-addon1" v-model="product.stock" required>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <button class="btn btn-danger float-right" @click.prevent="deleteProduct">Supprimer</button>
        </div>

    </form>

</div>
</template>

<script>

export default {
    components: {
        
    },
    props: ['product','subcategories','csrf','errors'],
    data() {
        return {
            discount: this.product.discount !== null ? true : false,
        }
    },
    mounted(){
        this.discount = this.product.discount != null ? true : false
    },
    methods: {
        showErrors(errors){
            this.$swal(
                {
                icon: 'error',
                title: 'Les données sont incorrectes!',
                text: this.errors[0],
                confirmButtonText: 'Ok',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-warning text-white mr-2',
                },
                },
            );
        },
        deleteProduct(){
            this.$swal({
                title: 'Supprimé ce produit?',
                showCancelButton: true,
                confirmButtonText: "Oui",
                cancelButtonText: "Annuler",
                
            }).then((result) => {
            if (result.value) {

                axios.delete("/admin/products/"+this.product.id)
                .then(res => console.log(res))
                .catch(err => console.log(err))

                this.$swal({
                    title: 'Le produit a été supprimé avec succés!',
                    }).then(() => window.location.href = '/admin/products')
                }
            })
            
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
