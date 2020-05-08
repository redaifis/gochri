<template>
<div class="row">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header font-weight-bold">
                Les produits
            </div>
            <div class="card-body">
                <div class="row align-items-center my-2" v-for="product in order.products" :key="product.id">
                    <div class="col-2">
                        <img :src="'/storage/images/products/'+product.image" alt="product" class="rounded-circle border" style="width:50px;height:50px">
                    </div>
                    <div class="col-6 ">
                        <span>{{product.name.length > 30 ? product.name.slice(0,30) + ' ..' : product.name}}</span>
                    </div>
                    <div class="col-2">
                        <span>{{product.price + ' x ' + product.pivot.quantity}}</span>
                    </div>
                    <div class="col-2">
                        <span>{{product.price * product.pivot.quantity}} Dh</span>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-6 align-items-center justify-content-start">
                            <button v-if="order.status === 'En attente'" class="btn btn-success btn-sm mr-2" @click="ship()">Livraisé</button>
                            <button v-if="order.status === 'En attente' || order.status === 'Livraisé' || order.status === 'Arrivé'" class="btn btn-danger btn-sm mr-2" @click="refund()">Remboursé</button>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-end">
                        <span v-if="order.status === 'Livraisé'" class="font-weight-bold text-info">Livraisé</span>
                        <span v-if="order.status === 'Remboursé'" class="font-weight-bold text-danger">Remboursé</span>
                        <span v-if="order.status === 'Arrivé'" class="font-weight-bold text-success">Arrivé</span>
                    </div>
                </div>

            </div>

        </div>

        <div class="card">
            <div class="card-header font-weight-bold">
                Paiement
            </div>
            <div class="card-body ">
                <div class="row mb-2">
                    <div class="col-3">
                        <span>Sous-total</span>
                    </div>
                    <div class="col-3">
                        <span>{{order.products.length}} éléments</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <span>{{total}} Dh</span>
                    </div>
                </div>
                <div class="row" v-if="order.shipping !== null">
                    <div class="col-6">
                        <span>{{order.shipping.name === null ? 'non défini' : order.shipping.name}}</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <span>{{order.shipping.price === null ? 0 : order.shipping.price}} Dh</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <span class="font-weight-bold">Montant</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <span class="font-weight-bold">{{total}} Dh</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header font-weight-bold">
                Remarque
            </div>
            <div class="card-body">
                <p>{{order.note === null ? 'Aucune remarque du client.' : order.note}}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-3 font-weight-bold">Client</h6>
                <p class="card-text">{{order.user.name}}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h6 class="mb-3 font-weight-bold">Informations de contact</h6>
                <p class="card-text">{{order.user.phone == null ? 'Pas de numero du téléphone.' : order.user.phone}}</p>
                <p class="card-text">{{order.user.email}}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h6 class="mb-3 font-weight-bold">Addresse de livraison</h6>
                <p class="card-text">{{order.country}}</p>
                <p class="card-text">{{order.city}}</p>
                <p class="card-text">{{order.address}}</p>
                <p class="card-text">{{order.code_postal}}</p>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['order'],
    data() {
        return {

        }
    },
    computed: {
        total() {
            let subtotal = 0;
            this.order.products.forEach(product => {
                subtotal = subtotal + (product.price * product.pivot.quantity)
            });
            return subtotal.toFixed(2)
        }
    },
    mounted() {

    },
    methods: {
        ship() {
            this.$swal({
                title: 'Voulez-vous marquer cette commande comme livraisé?',
                // text: "Rendre cette commande livraisé.",
                showCancelButton: true,
                confirmButtonText: "Oui",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.value) {

                    axios.put('/admin/orders/' + this.order.id + '/ship')
                        .then(res => console.log(res))
                        .catch(err => console.log(err))

                    this.$swal({
                        title: 'Succés!',
                        text: 'La commande a été marquer comme livraisé.',
                        icon: 'success'
                    }).then(() => window.location.reload())
                }
            })
        },
        refund() {
            this.$swal({
                title: 'Voulez-vous marquer cette commande comme remboursé?',
                // text: "Rendre cette commande remboursé.",
                showCancelButton: true,
                confirmButtonText: "Oui",
                cancelButtonText: "Annuler"
            }).then((result) => {
                if (result.value) {

                    axios.put('/admin/orders/' + this.order.id + '/refund')
                        .then(res => console.log(res))
                        .catch(err => console.log(err))

                    this.$swal({
                        title: 'Succés!',
                        text: 'La commande a été marquer comme livraisé.',
                        icon: 'success'
                    }).then(() => window.location.reload())
                }
            })
        }

    }
}
</script>

<style>

</style>
