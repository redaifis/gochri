<template>
<div class="justify-content-center">
    <form class="w-100 row pb-5" @keydown="editedProduct.onKeydown($event)">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-4">
                        <label for="name">Nom de produit</label>
                        <input v-model="editedProduct.name" type="text" name="name" id="name" class="form-control" placeholder="Name" aria-describedby="helpId" :class="{ 'is-invalid': editedProduct.errors.has('name') }" required>
                        <has-error :form="editedProduct" field="name"></has-error>
                    </div>

                    <div class="form-group my-4">
                        <label for="description">Description</label>
                        <textarea v-model="editedProduct.description" class="form-control" name="description" id="description" rows="8" placeholder="Description" :class="{ 'is-invalid': editedProduct.errors.has('description') }" required></textarea>
                        <has-error :form="editedProduct" field="description"></has-error>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="vendor">Fournisseur</label>
                                <input v-model="editedProduct.vendor" class="form-control" type="text" name="vendor" id="vendor" :class="{ 'is-invalid': editedProduct.errors.has('vendor') }">
                                <has-error :form="editedProduct" field="vendor"></has-error>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div>
                                <label class="text-bold">Réserve</label>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-sm" id="basic-addon1">Quantité</span>
                                </div>
                                <input v-model="editedProduct.stock" type="number" name="stock" id="stock" min="1" class="form-control" placeholder="Quantité" aria-label="stock" aria-describedby="basic-addon1" :class="{ 'is-invalid': editedProduct.errors.has('stock') }" required>
                                <has-error :form="editedProduct" field="stock"></has-error>
                            </div>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="form-group col-md-6 col-12">
                            <div class="input-group">
                                <label class="w-100" for="price">Prix</label>
                                <input v-model="editedProduct.price" type="number" name="price" id="price" step="0.01" class="form-control" placeholder="price" :class="{ 'is-invalid': editedProduct.errors.has('price') }" required>
                                <div class="input-group-append d-block">
                                    <span class="input-group-text">Dh</span>
                                </div>
                                <has-error :form="editedProduct" field="price"></has-error>
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-12">
                            <div class="input-group">
                                <label class="w-100" for="discount">Promotion</label>
                                <input v-model="editedProduct.discount" type="number" name="discount" id="discount" class="form-control" placeholder="Promo" aria-describedby="helpId" :class="{ 'is-invalid': editedProduct.errors.has('discount') }">
                                <div class="input-group-append d-block">
                                    <span class="input-group-text">%</span>
                                </div>
                                <has-error :form="editedProduct" field="discount"></has-error>
                            </div>
                        </div>
                    </div>

                    <div class="form-group my-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input v-model="editedProduct.status" :value="product.status" type="checkbox" class="form-check-input" name="status" id="status" :class="{ 'is-invalid': editedProduct.errors.has('status') }" checked>
                                Publié
                            </label>
                        </div>
                        <has-error :form="editedProduct" field="status"></has-error>
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
                            <select v-model="editedProduct.subcategory.id" class="form-control" name="subcategory" id="subcategory" :class="{ 'is-invalid': editedProduct.errors.has('subcategory') }">
                                <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">{{subcategory.name}}</option>
                            </select>
                            <has-error :form="editedProduct" field="subcategory"></has-error>
                        </div>
                    </div>
                </div>

                <div class="card col-12">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img :src="'/storage/images/products/'+editedProduct.image" alt="Product image" class="rounded-circle border shadow-sm my-3 w-50 h-50">

                        <div class="form-group py-3">
                            <label for="image">Media</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" @change="getImage" id="image">
                                <label class="custom-file-label" for="image">Choisir une image...</label>
                            </div>
                            <button class="btn btn-success btn-sm my-3" @click.prevent="uploadImage">Changer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-3">
            <button :disabled="editedProduct.busy" type="submit" class="btn btn-primary" @click.prevent="editProduct">Ajouter</button>
        </div>
    </form>
</div>
</template>

<script>
import {
    Form,
    HasError,
    AlertError
} from 'vform'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const objectToFormData = window.objectToFormData

export default {
    props: ['product'],
    data() {
        return {
            subcategories: [],
            image: null,
            editedProduct: new Form({...this.product,_method:'put'})
        }
    },
    methods: {
        getSubcategories() {
            axios.get('/api/admin/subcategories')
                .then(res => this.subcategories = res.data.subcategories)
                .catch(err => console.log(err))
        },
        getImage(e){
            this.image = e.target.files[0]
        },
        uploadImage() {
            const data = new FormData();
            data.append('image', this.image);
            data.append('_method', 'put');
            
            this.$swal({
                title: 'Changer l\'image',
                text: 'Vous êtes entrain de change l\'image',
                showCancelButton: true,
                preConfirm: () => {
                    axios.post('/api/admin/products/'+this.product.id+'/image', data)
                    .then(res => {
                        this.editedProduct.image = res.data.image
                        this.$swal('Succés',`${res.data.success}`,'success')
                    }).catch(err => console.log(err))
                }
            })
        },
        editProduct() {
            this.editedProduct.busy = true;
            this.editedProduct.status = this.editedProduct.status === true ? 1 : 0
            this.editedProduct.post(`/api/admin/products/${this.editedProduct.id}`,{
              // Transform form data to FormData
              transformRequest: [function (data, headers) {
                return objectToFormData(data)
              }]
            })
                .then(res => this.$swal('Succés!',`${res.data.success}`,'success').then(() => window.location.href = '/admin/products'))
                .catch(err => console.log(err))
        }
    },
    async created() {
        await this.getSubcategories()
    },
    mounted() {
    }
}
</script>

<style>

</style>
