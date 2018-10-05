<template>
    <div>
    <!--<p class="text-center alert alert-danger"-->
       <!--v-bind:class="{ hidden: hasError }">Please fill all fields!</p>-->



        <select v-model="newUser.permission">
            <option disabled value="">Please select one</option>
            <option v-for="p in permissions" :value="p.id">
                {{p.name}}
            </option>

        </select>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password"
                   v-model="newUser.password"
                   required  placeholder="****"/>
        </div>

    <button class="btn btn-primary" @click.prevent="createUser()" >
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
            id : Number,
        },

        data: function () {
            return{
                permissions: [],
                newUser:{
                    'name':  this.last_name+' '+this.first_name,
                    'email': this.email,
                    'password':'',
                    'permission':'',
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
                    alert("Hiba történt a jogosultságok betöltése során!");
                    console.log(error);
                });
        },
        methods:{
                createUser: function createUser() {
                    // var _this = this;
                    let input = this.newUser;
                    let id = this.id;

                    // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                    //     this.hasError = true;
                    // } else {
                    //     this.hasError = false;
                    console.log("user name: "+input.name);
                    console.log("user email: "+input.email);
                    console.log("user pass: "+input.password);
                    console.log("user permission: "+input.permission);

                    axios.post('/user', input).then(function (response) {
                        var userid = response.data.id;
                        console.log('User sorszáma: '+response.data.id);
                        console.log('employee id: '+id);
                        axios.post('/userid/' + id, {userID: userid}).then(function (response) {

                                console.log("Sikerült hozzáadni a UserId-t!!!");
                            }
                        ).catch(function (error) {
                                alert("Nem sikerült a userId-t hozzáadni !");
                                console.log(error);

                            }
                        );
                        }
                    ).catch(function (error) {
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