<template>
    <div>

        <label for="user.permission_id">Permission: </label>
        <select title="user.permission_id" id="user.permission_id" name="user.permission_id" v-model="user.permission_id">
            <option disabled value="">Please select one</option>
            <option v-for="p in permissions" value="p.id">
                {{p.name}}{{p.id}}
            </option>

        </select>

        <!--<div class="form-group">-->
            <!--<label for="password">Password:</label>-->
            <!--<input type="password" class="form-control" id="password" name="password"-->
                   <!--:value="user.password"-->
                   <!--required placeholder="****"/>-->
        <!--</div>-->


        <button class="btn btn-primary" @click.prevent="updateUser()">
            <span class="glyphicon glyphicon-plus"></span> ADD
        </button>
    </div>
</template>

<script>
    export default {
        name: "editUser",
        props: {
            id : Number,
        },
        data: function () {
            return {
                permissions: [],
                user:[],
            }
        },

        mounted() {
            axios.get('/users/' + this.id + '/edit')
                .then(response => {
                    this.user = response.data;
                    console.log(response.data);

                })
                .catch(function (error) {
                    alert("Hiba történt a user adatok betöltése során!");
                    console.log(error);
                });
            axios.get('/permission')
                .then(response => {
                    this.permissions  = response.data;
                })
                .catch(function (error) {
                    // alert("Hiba történt a jogosultságok betöltése során!");
                    showNotification('Hiba történt a jogosultságok betöltése során!', 'alert-error');
                    console.log(error);
                });
        },
        methods: {
            updateUser: function updateUser() {
                // var _this = this;


                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;


                // this.user.permission_id=this.permission;
                let input = this.user;
                console.log(input.permission.name);
                axios.post('/users/'+this.id+'/update', input).then(function (response) {
                    console.log('UpdateUser fg-ben...axiosban ');
                        var userid = response.data.user.id;
                        console.log('User sorszáma: '+response.data.user.id);
                        console.log('User permission name: '+response.data.user.permission.name);
                        // this.user=response.data.user;
                        showNotification(response.data.notification, response.data.notificationType);
                    }
                ).catch(function (error) {
                        showNotification('Nem sikerült a jogosultságot hozzáadni ', 'alert-error');
                        alert("Nem sikerült frissíteni a usert !");
                        console.log(error);
                    }
                );

            }
        }

    }
</script>

<style scoped>
    /*Todo: Megírni!*/
</style>