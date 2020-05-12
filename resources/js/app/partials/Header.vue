<template>
<div>
    <nav class="navbar bg-white shadow-sm flex-nowrap">

        <div class="links d-flex mr-2">
            <a href="#" @click="() => {categories = !categories; categorieId = null}" class="mr-3 px-3 mt-1 toggler rounded" :style="categories ? 'color:#333333;' : ''"><i class="fas fa-bars"></i></a>
            <a href="#" id="logo"><img src="/storage/images/logo/logo.svg" alt="logo"></a>
        </div>

        <transition name="fade">
            <div class="card shadow-sm menu border-0" v-show="categories" style="width:auto">
                <div class="card-body m-0 p-0">
                    <div class="row py-2">
                        <div class="col-12 col-sm-6">
                            <div class="d-flex flex-column categories">
                                <a href="#" class="m-2 py-2 px-4 rounded d-flex justify-content-between align-items-center" v-for="categorie in items" :key="categorie.id" @click="categorieId = categorie.id" :style="categorieId === categorie.id ? 'color:#333333;' : ''">{{categorie.name}} <i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                        <transition name="slide-fade">
                        <div class="col-12 col-sm-6 subcategories-container" v-if="categorieId !== null">
                            <div class="d-flex flex-column subcategories">
                                <a href="#" class="m-2 py-2 px-4 rounded active" v-for="subcategorie in filteredCategorie[0].subcategories" :key="subcategorie.id">{{subcategorie.name}}</a>
                            </div>
                        </div>
                        </transition>
                    </div>
                    
                    <div class="row d-sm-block d-md-none">
                        <div class="col-12">
                            <div class="links-inside d-flex flex-wrap">
                                <a href="#" class="mx-3 my-3 d-flex flex-column align-items-center justify-content-center" ><i class="fas fa-user"></i><span>Compte</span> </a>
                                <a href="#" class="mx-3 my-3 d-flex flex-column align-items-center"><i class="fas fa-heart"></i><span>Liste</span> </a>
                                <a href="#" class="mx-3 my-3 d-flex flex-column align-items-center"><i class="fas fa-shopping-basket"></i><span>Panier</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </transition>


        <div class="search mx-3">
            <input type="text" class="form-control" placeholder="Recherche">
            <div>
                <i class="fas fa-search"></i>
            </div>

        </div>
        <div class="d-none d-md-block">

            <div class="links customer-links d-flex ">
                <a href="#" class="px-3 d-flex flex-column align-items-center"><i class="fas fa-user"></i><span>Compte</span> </a>
                <a href="#" class="px-3 d-flex flex-column  align-items-center"><i class="fas fa-heart"></i><span>Wishlist</span> </a>
                <a href="#" class="px-3 d-flex flex-column  align-items-center"><i class="fas fa-shopping-basket"></i><span>Panier</span></a>
            </div>
        </div>

    </nav>
</div>
</template>

<script>
export default {
    data() {
        return {
            categories: false,
            categorieId: null,
            items: [
                {
                    id: 1,
                    name: 'Fruits Et Légumes',
                    subcategories: [
                        {
                            id: 1,
                            name: 'Fruits'
                        },
                        {
                            id: 2,
                            name: 'Légumes'
                        }
                    ],
                },
                {
                    id: 2,
                    name: 'Crémerie Et Fromages',
                    subcategories: [
                        {
                            id: 1,
                            name: 'Crèmes fraîches'
                        },
                        {
                            id: 2,
                            name: 'Laits'
                        },
                        {
                            id: 3,
                            name: 'Yaourts et desserts'
                        }
                    ],
                },
                {
                    id: 3,
                    name: 'Epicerie Sucrée',
                    subcategories: [
                        {
                            id: 1,
                            name: 'Biscuits'
                        },
                        {
                            id: 2,
                            name: 'Chocolate'
                        }
                    ],
                },
                {
                    id: 4,
                    name: 'Pains Et Pâtisseries',
                    subcategories: [
                        {
                            id: 1,
                            name: 'Pains'
                        },
                        {
                            id: 2,
                            name: 'Gâteaux'
                        }
                    ],
                }
            ]
            
        }
    },
    computed: {
        filteredCategorie(){
            return this.items.filter(element => element.id === this.categorieId)
        }
    }
}
</script>

<style scoped>
.menu {
    position: absolute;
    top: 70px;
    transition: 700ms all ease;
    z-index: 999;
}


.categories a,
.subcategories a {
    text-decoration: none;
    color: #F4A95B;
    transition: 300ms ease;
    width: 225px;
}

.categories a:hover,
.subcategories a:hover {
    color: #DA872F;
}

.links-inside a{
    color: #F4A95B;
    font-size: 14px;
    text-decoration: none;
    width: 50px;
}

.subcategories-container{
    transition: 300ms ease;
}

.links a {
    color: #F4A95B;
    font-size: 22px;
    text-decoration: none;
    transition: 300ms ease;
}

.links a:hover {
    color: #DA872F;
}

.links a span {
    font-size: 13px;
}

.links #logo {
    width: 70px;
}

.toggler {
    margin-top: 0.15rem !important
}

.form-control {
    border: 1px solid #F4A95B;
    height: calc(1.2em + 0.75rem + 2px);
    width: 100%
}

.search {
    position: relative;
    width: 300px;
}

.search div {
    position: absolute;
    top: 2px;
    font-size: 18px;
    right: 10px;
    color: #f4a95b;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity .5s;
}

.fade-enter,
.fade-leave-to{
    opacity: 0;
}

.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .8s ease;
}
.slide-fade-enter, .slide-fade-leave-to {
  transform: translateX(-20px);
  opacity: 0;
}

@media only screen and (max-width: 590px) {
    .menu {
        max-width:300px;
    }
    .subcategories {
        border-top: 1px solid rgb(255, 231, 206);
        padding: 20px 0;
        /* width: 80%; */
        overflow: hidden;
    }
    .categories{
        padding: 0 0 20px 0;
    }
}
</style>
