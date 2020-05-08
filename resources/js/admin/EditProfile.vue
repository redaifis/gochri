<template>
<form class="w-100" :action="'/admin/profile/'+profile.id" method="post" enctype="multipart/form-data">
    <div class="row justify-content-center">

        <div class="col-8">
            <div class="card">
                <div class="card-body">

                    <input type="hidden" name="_token" v-model="csrf">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="name" aria-describedby="helpId" v-model="profile.name" required>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="country">Pays</label>
                                <input type="text" name="country" id="country" class="form-control" placeholder="country" aria-describedby="helpId" v-model="profile.country" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="city">Ville</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="city" aria-describedby="helpId" v-model="profile.city" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Adresse</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="address" aria-describedby="helpId" v-model="profile.address" required>
                    </div>

                    <div class="form-group mb-5">
                        <label for="phone">Téléphone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="phone" aria-describedby="helpId" v-model="profile.phone" required>
                    </div>

                    <button class="btn btn-primary">Appliquer</button>

                    <a class="btn btn-info float-right" href="#" @click="changePassword()">Changer mot de passe</a>

                </div>

            </div>

        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="d-flex justify-content-center mb-4">
                            <img class="shadow-sm" :src="'/storage/images/profiles/'+profile.image" alt="Profil picture" style="width:80px;height:80px;border-radius:100%">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="image">Photo</span>
                            </div>
                            <div class="custom-file">
                                <input id="image" type="file" name="image" class="custom-file-input" aria-describedby="image">
                                <label class="custom-file-label" for="image">Choiser l'image</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
</template>

<script>
export default {
    props: ['profile', 'csrf', 'errors'],
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
                customClass: {
                    confirmButton: 'btn btn-default',
                },
                confirmButtonText: 'Ok',
                buttonsStyling: false,
            }, );
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
                    this.$swal({
                        icon: 'warning',
                        title: 'Mots de passe incorrectes!',
                    })
                } else {
                    axios.put('/admin/profile/password/' + this.profile.id, {
                            password: res.value[0]
                        })
                        .then(result => {
                            this.$swal({
                                icon: 'success',
                                title: 'Mot de passe a été modifié!',

                            }).then(() => document.getElementById('logout-form').submit())
                        })
                    // .catch(err => console.log(err))
                }
            })

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
