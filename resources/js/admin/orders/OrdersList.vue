<template>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <div class="card-tools row" style="float:none">
                            <div class="col-12 col-md-6 py-2">
                                <h3 class="card-title flex-start">Tous les commandes</h3>
                            </div>
                            <div class="input-group input-group-sm col-12 col-md-2 py-2">
                                <select class="form-control float-right" id="etat" v-model="shipping_status">
                                    <option value="">Êtat</option>
                                    <option value="0">En attente</option>
                                    <option value="1">Livraisé</option>

                                </select>
                            </div>
                            <div class="input-group input-group-sm col-12 col-md-2 py-2">
                                <select class="form-control float-right" id="etat" v-model="payment_status">
                                    <option value="">Êtat</option>
                                    <option value="0">Non payé</option>
                                    <option value="1">Payé</option>

                                </select>
                            </div>
                            <div class="input-group input-group-sm col-12 col-md-2 py-2">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Nom de client.." v-model="search">

                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Paiement</th>
                                    <th>Livraison</th>
                                    <!-- <th>Paiement</th> -->
                                    <th>Montant</th>
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="order in pageOforders" :key="order.id">
                                    <td style="vertical-align: middle;">{{order.reference}}</td>
                                    <td style="vertical-align: middle;">{{order.created_at | moment('MMMM Do YYYY, h:mm:ss a')}}</td>
                                    <td style="vertical-align: middle;">{{order.user.name}}</td>
                                    <td style="vertical-align: middle;"><span :class="order.payment_status == 0 ? 'badge badge-warning' : 'badge badge-success' ">{{order.payment_status == 0 ? 'Non payé' : 'Payé'}}</span></td>
                                    <td style="vertical-align: middle;"><span :class="order.shipping_status == 0 ? 'badge badge-warning' : 'badge badge-success' ">{{order.shipping_status == 0 ? 'En attente' : 'Livraisé'}}</span></td>
                                    <!-- <td style="vertical-align: middle;"><span :class="['badge', order.status == 'En attente' ? 'badge-warning' : ((order.status == 'Livraisé') ? 'badge-info' : ((order.status == 'Arrivé') ? 'badge-success' : 'badge-danger'))]">{{order.status}}</span></td> -->
                                    <!-- <td style="vertical-align: middle;"><span class="badge badge-success">Payé</span></td> -->

                                    <td style="vertical-align: middle;">{{order.amount}} Dh</td>

                                    <td style="vertical-align: middle;text-align: center;">
                                        <a :href="'/admin/orders/'+order.id" class="btn btn-default btn-sm border"><i class="fas fa-eye"></i> Aperçu</a>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer pb-0 pt-3 text-center">
                        <jw-pagination :items="searched" @changePage="onChangePage"></jw-pagination>
                    </div>

                </div>
            </div>
        </div>
</template>

<script>
export default {
    data(){
        return{
            images: null,
            search: '',
            payment_status: '',
            shipping_status: '',
            // payment: '',
            orders: [],
            pageOforders: []
        }
    },
    methods: {
        onChangePage(pageOforders) {
            // update page of orders
            this.pageOforders = pageOforders;
        },
    },
    computed: {
        searched(){
            return this.orders.filter(order => {
                return order.user.name.toLowerCase().includes(this.search.toLowerCase())
                && (order.payment_status == this.payment_status || this.payment_status == '')
                && (order.shipping_status == this.shipping_status || this.shipping_status == '')
            })
        }
    },
    mounted(){
        axios.get(`/api/admin/orders`)
        .then(res => this.orders = res.data.orders)
        .catch(err => console.log(err))
    },
}
</script>

<style>

</style>
