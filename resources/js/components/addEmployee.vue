<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h1>Új alkalmazott rögzítése</h1></div>
                    <div class="card-body">
                        <form id="myForm" name="myForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="last_name">Lastname</label>
                                <input type="text" class="form-control" id="last_name" name="last_name">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Firstname</label>
                                <input type="text" class="form-control" id="first_name" name="first_name">
                            </div>
                            <div class="form-group">
                                <label for="born">Born</label>
                                <input type="date" class="form-control" id="born" name="born">
                            </div>

                            <!--Képet külön appenddel kell hozzáadni-->
                            <div v-if="!url">
                                <h5>Select an image</h5>
                                <input type="file"  @change="onFileChange" id="file" name="file"/>
                            </div>
                            <div v-else>
                                <img :src="url"/>
                                <button @click="removeImage">Remove image</button>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number">
                            </div>
                            <div class="form-group">
                                <label for="month_salary">Salary</label>
                                <input type="number" class="form-control" id="month_salary" name="month_salary">
                            </div>
                            <div class="checkbox">
                                <label for="definite_employment">Definite employment</label>
                                <input type="checkbox" id="definite_employment" name="definite_employment" >
                            </div>
                            <div class="form-group">
                                <label for="recruitment_date">Recruitment date</label>
                                <input type="date" class="form-control" id="recruitment_date" name="recruitment_date">
                            </div>
                            <div class="form-group">
                                <label for="job">Job</label>
                                <input type="text" class="form-control" id="job" name="job">
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <input type="text" class="form-control" id="comment" name="comment">
                            </div>
                            <div class="form-group">
                                <label for="principal_id">Felettes</label>
                                <select title="Felettes" id="principal_id" name="principal_id">

                                    <option disabled value="">Please select one</option>
                                    <option v-for="p in people" :value="p.id">
                                        {{p.last_name}} {{p.first_name}}
                                    </option>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="site_id">Telephely</label>
                                <select title="Telephely" id="site_id" name="site_id">

                                    <option disabled value="">Please select one</option>
                                    <option v-for="p in people" :value="p.site_id">
                                        {{p.site.name}}
                                    </option>

                                </select>
                            </div>

                            <div class="btn btn-primary" @click.prevent="createEmployee()">
                                <button type="submit" class="btn btn-primary">Rögzít</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "addEmployee",
        data: function () {

            return {
                image: '',
                url: null,
                people: [],
              }
        },
        mounted() {

            axios.get('/people')
                .then(response => {
                    this.people = response.data;

                })
                .catch(function (error) {
                    alert("Hiba történt a dolgozók betöltése során!");
                    console.log(error);
                });
        },
        methods: {
            createEmployee: function createEmployee(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;


                //Formdata használatánál a template-nél kell a form
                let myForm = document.getElementById('myForm');

                const formData = new FormData(myForm);
                if(this.image!==''){
                    formData.append('image', (new Blob([this.image])));
                }

                axios.post('/people', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {
                        console.log('Sikerült a dolgozót hozzáadni !');
                    }
                ).catch(function (error) {
                        alert("Nem sikerült a dolgozót hozzáadni !");
                        console.log(error);
                    }
                );
                // axios.get('/people/index').then().catch(function (error) {
                //     alert("Hiba történt a dolgozók betöltése során!");
                //     console.log(error);
                // });
            },
            onFileChange(e) {
                //Image prev
                this.image = e.target.files[0];
                this.url = URL.createObjectURL(this.image);
            },
            removeImage: function (e) {
                this.url = null;
                this.image = '';
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