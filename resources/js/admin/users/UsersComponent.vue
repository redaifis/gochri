<template>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">View all users</h3>

                        <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search Name" v-model="search">

                        </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Nom complet</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date d'incscription</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in pageOfusers" :key="user.id">
                                    <td style="vertical-align: middle;"><img :src="'/storage/images/profiles/'+user.image" alt="Profile picture" class="rounded-circle" style="width:50px;height:50px;object-fit:cover;"></td>
                                    <td style="vertical-align: middle;">{{user.name}}</td>
                                    <td style="vertical-align: middle;">{{user.email}}</td>
                                    <td style="vertical-align: middle;">{{user.role}}</td>
                                    <td style="vertical-align: middle;">{{user.created_at | moment("dddd, MMMM Do YYYY")}}</td>
                                    <td style="vertical-align: middle;"><a :href="'/admin/users/'+user.id" class="btn btn-sm border">Voir Profil</a></td>
                                    <td style="vertical-align: middle;">
                                        <form :action="'/admin/users/'+user.id" method="post">
                                            <input type="hidden" name="_token" :value="csrf">
                                            <input type="hidden" name="_method" value="delete">
                                            <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer pb-0 pt-3 text-center">
                        <jw-pagination :items="filteredList" @changePage="onChangePage"></jw-pagination>
                    </div>
                    
                </div>
            </div>
        </div>
</template>

<script>

export default {
    props:['users','csrf','errors'],
    data(){
        return{
            images: null,
            search: '',
            pageOfusers: []
        }
    },
    mounted(){

    },
    methods: {
        onChangePage(pageOfusers) {
            // update page of users
            this.pageOfusers = pageOfusers;
        }
    },
    computed: {
        filteredList() {
            
            return this.users.filter(user => {
                return user.name.toLowerCase().includes(this.search.toLowerCase())
            })
            
            
        }
    }
}
</script>

<style>

</style>