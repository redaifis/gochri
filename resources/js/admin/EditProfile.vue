<template>
<div class="row justify-content-center">

    <div class="col-8">
        <div class="card">
            <form class="w-100" @submit.prevent="editProfile" @keydown="profile.onKeydown($event)">
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" name="name" id="name" :class="['form-control',{ 'is-invalid': profile.errors.has('name') }]" placeholder="name" aria-describedby="helpId" v-model="profile.name" required>
                        <has-error :form="profile" field="name"></has-error>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="country">Pays</label>
                                <input type="text" name="country" id="country" :class="['form-control',{ 'is-invalid': profile.errors.has('country') }]" placeholder="country" aria-describedby="helpId" v-model="profile.country" required>
                                <has-error :form="profile" field="country"></has-error>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="city">Ville</label>
                                <input type="text" name="city" id="city" :class="['form-control',{ 'is-invalid': profile.errors.has('city') }]" placeholder="city" aria-describedby="helpId" v-model="profile.city" required>
                                <has-error :form="profile" field="city"></has-error>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <input type="text" name="address" id="address" :class="['form-control',{ 'is-invalid': profile.errors.has('address') }]" placeholder="address" aria-describedby="helpId" v-model="profile.address" required>
                        <has-error :form="profile" field="address"></has-error>
                    </div>

                    <div class="form-group mb-5">
                        <label for="phone">Téléphone</label>
                        <input type="text" name="phone" id="phone" :class="['form-control',{ 'is-invalid': profile.errors.has('phone') }]" placeholder="phone" aria-describedby="helpId" v-model="profile.phone" required>
                        <has-error :form="profile" field="phone"></has-error>
                    </div>

                    <button class="btn btn-primary" type="submit" :disabled="profile.busy">Appliquer</button>

                    <button class="btn btn-info float-right" @click.prevent="changePassword()">Changer mot de passe</button>

                </div>
            </form>
        </div>

    </div>

    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <div class="d-flex justify-content-center mb-4">
                        <img class="shadow-sm" :src="'/storage/images/profiles/'+(profile.image || 'default_profile.jpg')" alt="Profil picture" style="width:80px;height:80px;border-radius:100%">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="image">Photo</span>
                        </div>
                        <div class="custom-file">
                            <input id="image" type="file" name="image" @change="getImage" class="custom-file-input" aria-describedby="image">
                            <label class="custom-file-label" for="image">Choisir l'image</label>
                        </div>

                    </div>
                    <button href="" class="btn btn-success btn-sm" @click.prevent="uploadImage">Changer</button>
                </div>
            </div>
        </div>

    </div>
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

export default {
    data() {
        return {
            profile: [],
            imgToUpload: null
        }
    },
    methods: {
        getProfile() {
            axios.get(`/api/admin/profile/me`)
                .then(res => this.profile = new Form({
                    ...res.data.profile,
                    _method: 'put'
                }))
                .catch(err => console.log(err))
        },
        getImage(e) {
            this.imgToUpload = e.target.files[0]
            console.log(this.imgToUpload)
        },
        uploadImage() {
            let data = new FormData
            data.append('image', this.imgToUpload)
            data.append('_method', "put")

            this.$swal({
                title: 'Voulez-vous changer la photo de profil?',
                showCancelButton: true,
                preConfirm: () => {
                    axios.post(`/api/admin/profile/image/update`, data)
                        .then(res => {
                            this.profile.image = res.data.image
                            this.$swal('Succés', `${res.data.success}`, 'success')
                        })
                        .catch(err => console.log(err))
                }
            })
        },
        editProfile() {
            this.profile.put(`/api/admin/profile/update`)
                .then(res => this.$swal('Succés', `${res.data.success}`, 'success'))
                .catch(err => console.log(err))
        },
        changePassword() {
            const { value: formValues } = this.$swal({
                title: 'Changer le mot de passe',
                html: '<div class="form-group"><input type="password" id="swal-input1" class="form-control my-3" placeholder="Mots de passe">' +
                    '<input type="password" id="swal-input2" class="form-control" placeholder="Confirmer le mots de passe"></div>',
                focusConfirm: false,
                confirmButtonText: 'Changer',
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                preConfirm: () => {
                    return [
                        document.getElementById('swal-input1').value,
                        document.getElementById('swal-input2').value
                    ]
                }
            }).then(res => {
                if (res.value[0] !== res.value[1] || res.value[0].length < 8) {
                    this.$swal('Erreur!','Le mots de passe est incorrectes!','error')
                } else {
                    axios.put('/api/admin/profile/password/update', { password: res.value[0] })
                    .then(result => {
                        this.$swal('Succés!',`${result.data.success}`,'success').then(() => document.getElementById('logout-form').submit())
                    })
                }
            })
        }
    },
    mounted() {
        this.getProfile()
    }
}
</script>

<style>

</style>
