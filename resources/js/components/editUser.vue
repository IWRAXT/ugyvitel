<template>
    <div>
        <!--<form id="editForm" name="editForm" enctype="multipart/form-data">-->

        <div class="form-group">
            <label for="permission_id">Permission: </label>
            <select title="permission_id" id="permission_id" name="permission_id" v-model="user.permission_id">
                <option disabled value="">Please select one</option>
                <option v-for="p in permissions" :value="p.id">
                    {{p.name}}
                </option>

            </select>
        </div>

        <div class="form-group">
            <label for="password">New password:</label>
            <input type="password" class="form-control" id="password" name="password"
                   v-model="user.password"
                   required placeholder="****"/>
        </div>


        <button class="btn btn-primary" @click="updateUser()">
            Rögzít
        </button>
        <!--</form>-->
    </div>
</template>

<script>
    export default {
        name: "editUser",
        props: {
            id: Number, //user id
            // permission_id: String,
        },
        data: function () {
            return {
                permissions: [],
                user: [],
            }
        },

        mounted() {
            axios.get('/users/' + this.id + '/edit')
                .then(response => {
                    this.user = response.data;
                    console.log('User permission: '+response.data.permission.name);

                })
                .catch(function (error) {
                    alert("Hiba történt a user adatok betöltése során!");
                    console.log(error);
                });
            axios.get('/permission')
                .then(response => {
                    this.permissions = response.data;
                    console.log('Permissions: '+response.data);
                })
                .catch(function (error) {
                    alert("Hiba történt a jogosultságok betöltése során!");
                    // showNotification('Hiba történt a jogosultságok betöltése során!', 'alert-error');
                    console.log(error);
                });
        },
        methods: {
            updateUser() {
                // var _this = this;


                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;


                // let editForm = document.getElementById('editForm');
                // const formData = new FormData(editForm);

                let input= this.user;

                axios.post('/users/' + this.id + '/update', input).then(function (response) {

                        // this.user = response.data.user;
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

</style>