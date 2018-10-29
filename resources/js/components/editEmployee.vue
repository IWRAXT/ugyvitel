<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">


                <!--<form method="POST" action="/people/{{ $person->id }}/update" enctype="multipart/form-data">-->
                <form id="editForm" name="editForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="last_name">Lastname</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" :value=person.last_name>
                    </div>
                    <div class="form-group">
                        <label for="first_name">Firstname</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" :value=person.first_name>
                    </div>
                    <div class="form-group">
                        <label for="birth">Birth</label>
                        <input type="date" class="form-control" id="birth" name="birth" :value="person.birth">
                    </div>

                    <div class="form-group">
                        <label for="image">Mostani profilképe: </label>
                        <img :src="url" id="image" name="image">
                        <input type="file" @change="onFileChange" class="form-control-file" id="file" name="file">
                        <button @click.prevent="removeImage">Remove image</button>

                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" :value="person.email">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" :value="person.address">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                               :value="person.phone_number">
                    </div>
                    <div class="form-group">
                        <label for="month_salary">Salary</label>
                        <input type="number" class="form-control" id="month_salary" name="month_salary"
                               :value="person.month_salary">
                    </div>
                    <div class="checkbox">
                        <label for="definite_employment">Definite employment</label>
                        <input type="checkbox" id="definite_employment" name="definite_employment"
                               :value="person.definite_employment">
                    </div>
                    <div class="form-group">
                        <label for="recruitment_date">Recruitment date</label>
                        <input type="date" class="form-control" id="recruitment_date" name="recruitment_date"
                               :value="person.recruitment_date">
                    </div>
                    <div class="form-group">
                        <label for="job">Job</label>
                        <input type="text" class="form-control" id="job" name="job" :value="person.job">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <input type="text" class="form-control" id="comment" name="comment" :value="person.comment">
                    </div>
                    <!--<div class="form-group">-->
                        <!--<label for="principal_id">Felettes: </label>-->
                        <!--<select title="principal_id" id="principal_id" name="principal_id">-->

                            <!--<option disabled value="">Please select one</option>-->
                            <!--<option v-for="p in people" :value="p.id">-->
                                <!--<span v-if="p.principal_id!==null && p.id!==person.id">{{p.last_name}} {{p.first_name}}</span>-->
                            <!--</option>-->

                        <!--</select>-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="site_id">Telephely</label>
                        <select title="site_id" id="site_id" name="site_id" >

                            <option disabled value="">Please select one</option>
                            <option v-for="s in sites" :value="person.site_id=s.id">
                                <span v-if="s.site_id!==null">{{s.name}}</span>
                            </option>

                        </select>
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
        name: "editEmployee",
        props: {
            id: Number, //linkel küldött {id}
            // image: String,  //képneve
            // last_name: String,
            // first_name: String,
            // born: String, //Date
            // email: String,
            // address: String,
            // phone_number: String,
            // month_salary: String,//Number
            // definite_employment: String,//Boolean
            // recruitment_date: String,//Date
            // job: String,
            // comment: String,
            // principal_id: Number,
            // site_id: String,
        },
        data: function () {

            return {
                url: '',
                image:'',
                people: [],
                person:[],
                sites: [],
                delete: false,
            }
        },
        mounted() {

            axios.get('/people')
                .then(response => {
                    this.people = response.data;
                })
                .catch(function (error) {
                    alert("Hiba történt a dolgozói adatok betöltése során!");
                    console.log(error);
                });
            axios.get('/sites')
                .then(response => {
                    this.sites = response.data;
                })
                .catch(function (error) {
                    alert("Hiba történt a telephelyek betöltése során!");
                    console.log(error);
                });

            axios.get('/people/' + this.id + '/edit')
                .then(response => {
                    console.log(response.data);
                    this.person = response.data;
                    this.image=this.person.image;
                    this.url = "/storage/images/" + this.person.image;
                })
                .catch(function (error) {
                    alert("Hiba történt a user adatok betöltése során!");
                    console.log(error);
                });


        },
        methods: {
            updateEmployee(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;
                console.log('principal_id: '+this.person.principal_id);
                console.log('Site_id: '+this.person.site_id);

                //Formdata használatánál a template-nél kell a form
                let editForm = document.getElementById('editForm');
                console.log(editForm);
                const formData = new FormData(editForm);
                if (this.image !== '') {
                    formData.append('image', (new Blob([this.image])));
                } else {
                    formData.append('delete', this.delete);
                }

                axios.post('/people/' + this.id + '/update', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {
                        // this.person = response.data.person;

                        showNotification(response.data.notification, response.data.notificationType);
                        console.log('Dolgozó adatai frissítve! !');
                    }
                ).catch(function (error) {
                        alert("Dolgozó adatok frissítése sikertelen volt!");
                        showNotification('Dolgozó adatok frissítése sikertelen volt!', 'alert-error');
                        console.log(error);
                    }
                );

            },
            onFileChange(e) {
                //Image prev
                this.image = e.target.files[0];
                this.url = URL.createObjectURL(this.image);
            },
            removeImage: function () {
                this.url = '/storage/images/default.jpg';
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