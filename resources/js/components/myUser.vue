<template>
    <div id="app">
        <div class="card">
            <div class="card-header">
                <h5> {{person.last_name }} {{person.first_name }} </h5>{{ person.job }} adatlapja
                <!--({{ person.user.permission.name }})-->

            </div>

            <div class="card-body">

                <img :src="'/storage/images/'+person.image" style="min-width: 120px " alt="User Image">
                <table class=" table table-striped">
                    <tbody>
                    <tr>
                        <td><span><i class="fa fa-address-book"></i> Email:</span></td>
                        <td>{{person.email }}</td>
                    </tr>
                    <tr>
                        <td><span><i class="fa fa-home"></i> Address:</span></td>
                        <td>{{person.address }}</td>
                    </tr>
                    <tr>
                        <td><span><i class="fa fa-birthday-cake"></i> Birth:</span></td>
                        <td>{{person.birth }}</td>
                    </tr>
                    <tr>
                        <td><span><i class="fa fa-phone"></i> Phone</span></td>
                        <td>{{person.phone_number }}</td>
                    </tr>
                    <tr>
                        <td><span><i class="fa fa-bank"></i> Telephely</span></td>
                        <td>{{person.site.name }}</td>
                    </tr>
                    <tr v-if="person.site.name!=='Igazgatóság'">

                        <td><span><i class="fa fa-tree"></i> Felettes</span></td>
                        <td v-if="person.site.leader_id != person.id">{{person.site.leader.last_name }} {{person.site.leader.first_name }}</td>
                        <td v-else> Igazgatóság főnöke</td>
                    </tr>

                    </tbody>
                </table>
                <!--@if (session('status'))-->
                <!--<div class="alert alert-success" role="alert">-->
                <!--{{ session('status') }}-->
                <!--</div>-->
                <!--@endif-->

                <!--<div id="app">-->
                <!--<edit_user-->
                <!--id="{{ Auth::user()->employee->id }}"-->
                <!--image="{{ Auth::user()->employee->image }}"-->
                <!--last_name="{{ Auth::user()->employee->last_name }}"-->
                <!--first_name="{{ Auth::user()->employee->first_name }}"-->
                <!--born="{{ Auth::user()->employee->born }}"-->
                <!--email="{{ Auth::user()->employee->email }}"-->
                <!--address="{{ Auth::user()->employee->address }}"-->
                <!--phone_number="{{ Auth::user()->employee->phone_number }}"-->
                <!--month_salary="{{ Auth::user()->employee->month_salary }}"-->
                <!--definite_employment="{{ Auth::user()->employee->definite_employment }}"-->
                <!--recruitment_date="{{ Auth::user()->employee->recruitment_date }}"-->
                <!--job="{{ Auth::user()->employee->job}}"-->
                <!--comment="{{ Auth::user()->employee->comment }}"-->
                <!--principal="{{ Auth::user()->employee->princilap_id }}"-->
                <!--&gt;</edit_user>-->


                <!--</div>-->
                <button @click="edit=true">Személyes adatok módosítása</button>
            </div>

        </div>

        <div v-if="edit" class="row justify-content-center">
            <div class="col-lg-9">
                <!--Employee data change-->
                <form id="editEmployeeForm" name="editEmployeeForm" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="image">Mostani profilképe: </label>
                        <img :src="url" id="image" name="image">
                        <input type="file" @change="onFileChange" class="form-control-file" id="file" name="file">
                        <button @click.prevent="removeImage">Remove image</button>

                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" class="form-control" id="email" name="email" :value="person.email">
                    </div>
                    <!--todo: vagy legyen 1 email vagy mind2 helyen frissüljön, ahogy a név is-->

                    <div class="form-group">
                        <label for="phone_number">Phone: </label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                               :value="person.phone_number">
                    </div>

                    <div class="btn btn-primary" @click.prevent="updateEmployee()">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                <!--User data change-->
                <form id="editUserForm" name="editUserForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="password">New Password: </label>
                        <input type="password" class="form-control" id="password" name="password"
                               :value="person.user.password"
                               required placeholder="****">
                    </div>

                    <div class="btn btn-primary" @click.prevent="updateUser() ">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "myUser",

        data: function () {

            return {
                url: '',
                image: '',
                person: [],
                delete: false, //kép törlése
                edit: false,
                id: '',
            }
        },
        mounted() {
            this.init();


        },
        methods: {
            init() {
                axios.get('/people/edit_mount')
                    .then(response => {
                        this.person = response.data;
                        console.log(response.data);
                        this.image = this.person.image;
                        this.url = "/storage/images/" + this.person.image;
                    })
                    .catch(function (error) {
                        alert("Hiba történt a user adatok betöltése során!");
                        console.log(error);
                    });
            },
            updateEmployee(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;

                this.edit = false;
                //Formdata használatánál a template-nél kell a form
                let editEmployeeForm = document.getElementById('editEmployeeForm');
                console.log(editEmployeeForm);
                const formData = new FormData(editEmployeeForm);
                formData.append('last_name', this.person.last_name);
                formData.append('first_name', this.person.first_name);
                formData.append('birth', this.person.birth);
                formData.append('address', this.person.address);
                formData.append('month_salary', this.person.month_salary);
                formData.append('definite_employment', this.person.definite_employment);
                formData.append('recruitment_date', this.person.recruitment_date);
                formData.append('job', this.person.job);
                formData.append('comment', this.person.comment);
                // formData.append('principal_id', this.person.principal_id);
                formData.append('site_id', this.person.site_id);


                if (this.image !== '') {
                    formData.append('image', (new Blob([this.image])));
                } else {
                    formData.append('delete', this.delete);
                }

                axios.post('/people/' + this.person.id + '/update', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {
                        // this.person=response.data.person;

                        showNotification(response.data.notification, response.data.notificationType);

                    }
                ).catch(function (error) {
                        alert("User adatok frissítése sikertelen!!");
                        console.log(error);
                    }
                );
                this.init();


            },
            updateUser(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;

                this.edit = false;

                let editUserForm = document.getElementById('editUserForm');
                console.log(editUserForm);
                const formData = new FormData(editUserForm);
                formData.append('name', this.person.user.email);
                formData.append('permission_id', this.person.user.permission_id);


                axios.post('/users/' + this.person.user.id + '/update', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {
                        // this.person=response.data.person;
                        showNotification(response.data.notification, response.data.notificationType);

                    }
                ).catch(function (error) {
                        alert("User adatok frissítése sikertelen!!");
                        console.log(error);
                    }
                );
                this.init();

            },
            onFileChange(e) {
                //Image prev
                this.image = e.target.files[0];
                this.url = URL.createObjectURL(this.image);
            },
            removeImage: function (e) {
                this.url = "/storage/images/default.jpg";
                this.image = '';
                this.delete = true;
            }
        }

    }
</script>

<style scoped>
    img {
        max-width: 220px;
        margin: auto;
        display: block;
        margin-bottom: 10px;
    }

</style>