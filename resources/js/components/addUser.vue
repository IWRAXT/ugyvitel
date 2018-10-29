<template>
    <div>
        <!--<p class="text-center alert alert-danger"-->
        <!--v-bind:class="{ hidden: hasError }">Please fill all fields!</p>-->

        <label for="permission">Permission: </label>
        <select v-model="newUser.permission" id="permission">
            <option disabled value="">Please select one</option>
            <option v-for="p in permissions" :value="p.id">
                {{p.name}} {{p.sites}}
            </option>

        </select>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password"
                   v-model="newUser.password"
                   required placeholder="****"/>
        </div>


        <button class="btn btn-primary" @click.prevent="createUser()">
            <span class="glyphicon glyphicon-plus"></span> ADD
        </button>
    </div>
</template>

<script>
    export default {
        name: "addUser",

        props: {
            last_name: String,
            first_name: String,
            email: String,
            password: String,
            permission: Number,
            id: Number,
        },

        data: function () {
            return {
                permissions: [],

                //nem kell formdata mert nem küldünk filet!
                newUser: {
                    'name': this.last_name + ' ' + this.first_name,
                    'email': this.email,
                    'password': '',
                    'permission': ''
                }
            }
        },
        mounted() {

            axios.get('/permission')
                .then(response => {
                    let permissions = response.data;
                    this.permissions = permissions;
                    console.log(permissions);
                })
                .catch(function (error) {
                    // alert("Hiba történt a jogosultságok betöltése során!");
                    showNotification('Hiba történt a jogosultságok betöltése során!', 'alert-error');
                    console.log(error);
                });
        },
        methods: {
            createUser() {
                // var _this = this;
                // let input = this.newUser;


                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;

                let id=this.id;

                axios.post('/user', this.newUser).then(function (response) { //UserControllerbe küldi
                    let user_id=response.data.user.id;
                    console.log("User_id: "+user_id);
                    // showNotification(response.data.notification, response.data.notificationType);
                        axios.post('/userid/' + id, {userID: user_id}).then(function (response) { //EmployeeControllerbe küldi

                                console.log("Sikerült hozzáadni a UserId-t!!!");
                                showNotification(response.data.notification, response.data.notificationType);


                            }
                        ).catch(function (error) {
                                showNotification('Nem sikerült a userId-t hozzáadni !', 'alert-error');
                                alert("Nem sikerült a userId-t hozzáadni !");
                                console.log(error);
                            }
                        );
                    }
                ).catch(function (error) {
                        showNotification('Nem sikerült a jogosultságot hozzáadni ', 'alert-error');
                        alert("Nem sikerült a jogosultságot hozzáadni !");
                        console.log(error);
                    }
                );

            }
        }

    }
</script>

<style scoped>

</style>