<template>
<div class="justify-content-center">
    <form class="w-100 row pb-5" @submit.prevent="addProduct" @keydown="product.onKeydown($event)">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="name">Nom de produit</label>
                        <input v-model="product.name" type="text" name="name" id="name" class="form-control" placeholder="Name" aria-describedby="helpId" :class="{ 'is-invalid': product.errors.has('name') }" required>
                        <has-error :form="product" field="name"></has-error>
                    </div>

                    <div class="form-group mb-4">
                        <label for="description">Description</label>
                        <textarea v-model="product.description" class="form-control" name="description" id="description" rows="8" placeholder="Description" :class="{ 'is-invalid': product.errors.has('description') }" required></textarea>
                        <has-error :form="product" field="description"></has-error>
                    </div>

                    <div class="form-group mb-4">
                        <label for="image">Media</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" @change="uploadImage" name="image" id="image" :class="{ 'is-invalid': product.errors.has('image') }" placeholder="Image" aria-describedby="fileHelpId">
                            <label for="image" class="custom-file-label">Télécharger une image</label>
                            <has-error :form="product" field="image"></has-error>
                        </div>
                    </div>

                        <div class="row my-3">
                            <div class="form-group col-md-6 col-12">
                                <div class="input-group">
                                    <label class="w-100" for="price">Prix</label>
                                    <input v-model="product.price" type="number" name="price" id="price" step="0.01" class="form-control" placeholder="price" :class="{ 'is-invalid': product.errors.has('price') }" required>
                                    <div class="input-group-append d-block">
                                        <span class="input-group-text">Dh</span>
                                    </div>
                                    <has-error :form="product" field="price"></has-error>
                                </div>
                            </div>

                            <div class="form-group col-md-6 col-12">
                                <div class="input-group">
                                    <label class="w-100" for="discount">Promotion</label>
                                    <input v-model="product.discount" type="number" name="discount" id="discount" class="form-control" placeholder="Promo" aria-describedby="helpId" :class="{ 'is-invalid': product.errors.has('discount') }">
                                    <div class="input-group-append d-block">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <has-error :form="product" field="discount"></has-error>
                                </div>
                            </div>
                        </div>
                    

                    <div class="form-group mb-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input v-model="product.status" type="checkbox" class="form-check-input" name="status" id="status" :class="{ 'is-invalid': product.errors.has('status') }" checked>
                                Publié
                            </label>
                        </div>
                        <has-error :form="product" field="status"></has-error>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-12 col-md-4">
            <div class="row">

                <div class="card col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="subcategory">Sous-catégorie</label>
                            <select v-model="product.subcategory" class="form-control" name="subcategory" id="subcategory" :class="{ 'is-invalid': product.errors.has('subcategory') }">
                                <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">{{subcategory.name}}</option>
                            </select>
                            <has-error :form="product" field="subcategory"></has-error>
                        </div>
                    </div>
                </div>

                <div class="card col-12">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="vendor">Fournisseur</label>
                            <input v-model="product.vendor" class="form-control" type="text" name="vendor" id="vendor" :class="{ 'is-invalid': product.errors.has('vendor') }">
                            <has-error :form="product" field="vendor"></has-error>
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
                            <input v-model="product.stock" type="number" name="stock" id="stock" min="1" class="form-control" placeholder="Quantité" aria-label="stock" aria-describedby="basic-addon1" :class="{ 'is-invalid': product.errors.has('stock') }" required>
                            <has-error :form="product" field="stock"></has-error>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3">
            <button :disabled="product.busy" type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>
</template>

<script>
import Vue from 'vue'
import {
    Form,
    HasError,
    AlertError
} from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const objectToFormData = window.objectToFormData

export default {
    data() {
        return {
            subcategories: [],
            product: new Form({
                name: '',
                description: '',
                subcategory: '',
                price: '',
                image: null,
                discount: '',
                vendor: '',
                stock: '',
                status: false,
            })
        }
    },
    methods: {
        getSubcategories() {
            axios.get('/api/admin/subcategories')
                .then(res => this.subcategories = res.data.subcategories)
                .catch(err => console.log(err))
        },
        uploadImage(e) {
            console.log(e.target.files[0])
            this.product.image = e.target.files[0]
        },
        addProduct() {
            this.product.status = this.product.status === true ? 1 : 0
            this.product.post('/api/admin/products', {
              // Transform form data to FormData
              transformRequest: [function (data, headers) {
                return objectToFormData(data)
              }]
            })
            .then( res => this.$swal('Succés!',`${res.data.success}`,'success').then(() => window.location.href = '/admin/products'))
            .catch( err => console.log(err))
        }
    },
    async mounted() {
        await this.getSubcategories()
    }
}
</script>

<style>

</style>
