<template>
    <div>

        <div class="card">
            <div class="card-header">
                <b> {{person.last_name }} {{person.first_name }} </b>{{ person.job }}
                <br> Home page
                <!--({{ person.user.permission.name }})-->

            </div>

            <div class="card-body">
                <h5>User adatlap: </h5>
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
                        <td>{{person.born }}</td>
                    </tr>
                    <tr>
                        <td><span><i class="fa fa-phone"></i> Phone</span></td>
                        <td>{{person.phone_number }}</td>
                    </tr>
                    <tr>
                        <td><span><i class="fa fa-euro"></i> Salary</span></td>
                        <td>{{person.month_salary }}</td>
                    </tr>
                    </tbody>
                </table>
                <p>Lehessen a password-ot is váloztatni</p>
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

        <div v-show="edit" class="row justify-content-center">
            <div class="col-lg-9">

                <form id="editForm" name="editForm" enctype="multipart/form-data">


                    <div class="form-group">
                        <label for="image">Mostani profilképe: </label>
                        <img :src="url" id="image" name="image">
                        <input type="file" @change="onFileChange" class="form-control-file" id="file" name="file">
                        <button @click="removeImage">Remove image</button>

                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" :value="person.email">
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                               :value="person.phone_number">
                    </div>


                    <div class="btn btn-primary" @click.prevent="updateEmployee()">
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
        // props: {
        //     id: String, //linkel küldött {id}
        //     image: String,  //képneve
        //     last_name: String,
        //     first_name:String,
        //     born:String, //Date
        //     email:String,
        //     address:String,
        //     phone_number:String,
        //     month_salary:String,//Number
        //     definite_employment: String,//Boolean
        //     recruitment_date:String,//Date
        //     job:String,
        //     comment:String,
        //     principal_id:Number,
        // },
        data: function () {

            return {
                url: '',
                image:'',
                person: [],
                delete: false, //kép törlése
                edit: false,
                id: '',
            }
        },
        mounted() {

            axios.get('/people/edit_mount')
                .then(response => {
                    this.person = response.data;
                    console.log(response.data);
                    // this.image=this.person.image;
                    this.url = "/storage/images/"+this.person.image;
                })
                .catch(function (error) {
                    alert("Hiba történt a user adatok betöltése során!");
                    console.log(error);
                });


        },
        methods: {
            updateEmployee: function createEmployee(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;

                this.edit = false;
                //Formdata használatánál a template-nél kell a form
                let editForm = document.getElementById('editForm');
                console.log(editForm);
                const formData = new FormData(editForm);
                formData.append('last_name', this.person.last_name);
                formData.append('first_name', this.person.first_name);
                formData.append('born', this.person.born);
                formData.append('address', this.person.address);
                formData.append('month_salary', this.person.month_salary);
                formData.append('definite_employment', this.person.definite_employment);
                formData.append('recruitment_date', this.person.recruitment_date);
                formData.append('job', this.person.job);
                formData.append('comment', this.person.comment);
                formData.append('principal_id', this.person.principal_id);


                if (this.image !== '') {
                    formData.append('image', (new Blob([this.image])));
                } else {
                    formData.append('delete', this.delete);
                }

                axios.post('/people/' + this.person.id + '/update', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(response => this.person = response.data
                ).catch(function (error) {
                        alert("User adatok frissítése sikertelen!!");
                        console.log(error);
                    }
                );

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
        width: 30%;
        margin: auto;
        display: block;
        margin-bottom: 10px;
    }

</style>