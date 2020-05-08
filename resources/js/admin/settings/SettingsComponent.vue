<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row links-container align-items-center font-weight-bold">
                    <div class="col-12 col-md-4 px-5">
                        <a href="settings/shipping" class="d-flex align-items-center justify-content-center links border rounded text-secondary">
                            <i class="fas fa-car-side icons"></i>
                            <span class="ml-2">Livraison</span>
                        </a>
                    </div>
                    <div class="col-12 col-md-4 px-5">
                        <a href="settings/payment" class="d-flex align-items-center justify-content-center links border rounded text-warning">
                            <i class="fas fa-dollar-sign icons"></i>
                            <span class="ml-2">Paiement</span>
                        </a>
                    </div>
                    <div class="col-12 col-md-4 px-5">
                        <a href="settings/other" class="d-flex align-items-center justify-content-center links border rounded text-info">
                            <i class="fas fa-cogs icons"></i>
                            <span class="ml-2">Autre</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            
        }
    },
    methods: {
        
        
    }
}
</script>

<style scoped>
.links-container{
    height: 200px
}
.links{
    height: 100px;
}
.icons{
    font-size: 36px
}
</style>