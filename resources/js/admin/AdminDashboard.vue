<template>
<div>
    <div class="row">
        <div class="col-md-3 col-12">
            <!-- small box -->
            <div class="small-box text-white" style="background: #139FC0">
                <div class="inner">
                    <h3>{{data.orders_count}}</h3>

                    <p>Commandes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="/admin/orders" class="small-box-footer">Plus de détails <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-md-3 col-12">
            <!-- small box -->
            <div class="small-box text-white" style="background:#B8B62F">
                <div class="inner">
                    <h3>{{data.revenue.toFixed(2)}}<sup style="font-size: 20px">Dh</sup></h3>

                    <p>Revenu</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Plus de détails <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->

        <div class="col-md-3 col-12">
            <!-- small card -->
            <div class="small-box text-white" style="background:#F34350">
                <div class="inner">
                    <h3>{{data.users_count}}</h3>

                    <p>Utilisateurs</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="/admin/users" class="small-box-footer">
                    Plus de détails <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-md-3 col-12">
            <!-- small box -->
            <div class="small-box text-white" style="background:#F39639">
                <div class="inner">
                    <h3>{{data.products_count}}</h3>

                    <p>Produits</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="/admin/products" class="small-box-footer">Plus de détails <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <!-- CHARTS -->
    <div class="row mb-4 mt-3 py-2">
        <div class="col-12 col-md-6">
            <LineChart v-if="chartRevenue.isLoaded" :chartdata="chartRevenue.chartdata" :options="chartRevenue.options" />
        </div>
        <div class="col-12 col-md-6">
            <BarChart v-if="chartOrders.isLoaded" :chartdata="chartOrders.chartdata" :options="chartOrders.options" />
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8">
            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Les nouvelles commandes</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Êtat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="order in data.orders" :key="order.id">
                                    <td>{{order.id}}</td>
                                    <td>{{order.created_at | moment('Do MMMM, YYYY, h:mm:ss a')}}</td>
                                    <td>{{order.amount}} Dh</td>
                                    <td style="vertical-align: middle;"><span :class="['badge', order.status == 'En attente' ? 'badge-warning' : ((order.status == 'Livraisé') ? 'badge-info' : ((order.status == 'Arrivé') ? 'badge-success' : 'badge-danger'))]">{{order.status}}</span></td>
                                    <td><a class="btn btn-default border btn-sm d-flex align-items-center" style="width: 80px;" :href="'/admin/orders/'+order.id" role="button"><i class="fas fa-eye mr-1"></i> Aperçu</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="/admin/orders" class="btn btn-sm btn-info float-left">Afficher tous</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Produits récemment ajoutés</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        <li v-for="product in data.products" :key="product.id" class="item">
                            <div class="product-img">
                                <img :src="'/storage/images/products/'+product.image" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info text-sm">
                                <a :href="'products/' + product.id + '/edit'" class="product-title">{{product.name.length > 30 ? product.name.substring(0,30)+'...' : product.name}}
                                    <span class="badge badge-warning float-right">{{product.price}} Dh</span></a>
                                <span class="product-description">
                                    {{product.description}}
                                </span>
                            </div>
                        </li>
                        <!-- /.item -->
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="/admin/products" class="btn btn-sm btn-info float-left">Afficher tous</a>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
import LineChart from './components/LineChart'
import BarChart from './components/BarChart'
export default {
    props: ['success'],
    components: {
        LineChart,
        BarChart
    },
    data() {
        return {
            data: {
                orders: [],
                products: [],
                users: [],
                orders_count: null,
                users_count: null,
                products_count: null,
            },
            chartRevenue: {
                isLoaded: false,
                chartdata: {
                    labels: [],
                    datasets: [{
                        label: 'Revenu',
                        backgroundColor: '#B8B62F',
                        pointBackgroundColor: 'white',
                        borderWidth: 1,
                        data: []
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    hover: {
                        mode: 'label'
                    },
                    scales: {

                        yAxes: [{
                            display: true,

                            ticks: {
                                beginAtZero: true,
                                // stepSize: 10,
                                callback: function (label, index, labels) {
                                    return label + ' Dh'
                                }
                            }
                        }]
                    }
                }
            },
            chartOrders: {
                isLoaded: false,
                chartdata: {
                    labels: [],
                    datasets: [{
                        label: 'Commandes',
                        backgroundColor: '#F39639',
                        data: []
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                            }
                        }]
                    }
                },

            }

        }
    },
    methods: {
        getData() {
            this.chartRevenue.isLoaded = false
            this.chartOrders.isLoaded = false

            axios.get('/api/admin/dashboard')
                .then(res => {

                    for (const [key, value] of Object.entries(res.data.chartData).reverse()) {
                        // console.log(key)
                        console.log(value[0])

                        this.chartRevenue.chartdata.labels.push(key)
                        this.chartOrders.chartdata.labels.push(key)

                        this.chartRevenue.chartdata.datasets[0].data.push(value[0] !== undefined ? value[0].map(v => v.amount).reduce((ac, cu) => ac + cu) : 0)
                        this.chartOrders.chartdata.datasets[0].data.push(value[0] !== undefined ? value[0].length : 0)

                    }

                    this.data = res.data

                })
                .catch(err => console.log(err))

            this.chartRevenue.isLoaded = true
            this.chartOrders.isLoaded = true
        },
        showSuccess() {
            // Show success message if exist
            this.$swal({
                icon: 'success',
                title: this.success,
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    container: 'mb-5 ml-4',
                },
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', this.$swal.stopTimer)
                    toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                }
            })
        },
    },
    mounted() {

        this.getData()

        if (this.success !== null) {
            this.showSuccess()
        }
    }
}
</script>
