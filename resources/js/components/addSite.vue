<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h1>Új telephely rögzítése</h1></div>
                    <div class="card-body">

                        <!--@if ($errors->any())-->
                        <!--<div class="alert alert-danger">-->
                            <!--<ul>-->
                                <!--@foreach ($errors->all() as $error)-->
                                <!--<li>{{ $error }}</li>-->
                                <!--@endforeach-->
                            <!--</ul>-->
                        <!--</div>-->
                        <!--@endif-->

                        <form id="myForm" name="myForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <!--Képet külön appenddel kell hozzáadni-->
                            <div v-if="!url">
                                <h5>Select an image</h5>
                                <input type="file" @change="onFileChange" id="file" name="file"/>
                            </div>
                            <div v-else>
                                <img :src="url"/>
                                <button @click="removeImage">Remove image</button>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number">
                            </div>
                            <!--<p><i>(leader hozzáadásánál győződjön meg arról, hogy van olyan felhasználó akinek 'Leader' jogot állított be)</i></p>-->
                            <!--<div class="form-group">-->
                                <!--<label for="leader_id">Leader</label>-->
                                <!--<select title="leader_id" id="leader_id" name="leader_id" >-->

                                    <!--<option disabled value="">Please select one</option>-->
                                    <!--<option v-for="p in leaders" :value="p.id">-->
                                        <!--<span >{{p.name}} </span>-->
                                    <!--</option>-->

                                <!--</select>-->
                            <!--</div>-->

                            <div class="btn btn-primary" @click.prevent="createSite()">
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
        name: "addSite",
        data: function () {

            return {
                image: '',
                url: null,
                sites: [],
                people: [],
                leaders: [],
            }
        },
        mounted() {

            // axios.get('/people')
            //     .then(response => {
            //         this.people = response.data;
            //     })
            //     .catch(function (error) {
            //         alert("Hiba történt a vezetői adatok betöltése során!");
            //         console.log(error);
            //     });
            axios.get('/leaders')
                .then(response => {
                    this.leaders = response.data;
                    console.log(response.data);
                })
                .catch(function (error) {
                    alert("Hiba történt a dolgozói adatok betöltése során!");
                    console.log(error);
                });
        },

        methods: {
            createSite(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;


                //Formdata használatánál a template-nél kell a form
                let myForm = document.getElementById('myForm');

                const formData = new FormData(myForm);
                if (this.image !== '') {
                    formData.append('image', (new Blob([this.image])));
                }
                let leader_id='2';
                formData.append('leader_id',leader_id);

                axios.post('/sites', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {
                        console.log('Sikerült a telephelyet hozzáadni !');
                        showNotification(response.data.notification, response.data.notificationType);
                    }
                ).catch(function (error) {
                        alert("Nem sikerült a telephelyet hozzáadni !");
                        showNotification('Nem sikerült a telephelyet hozzáadni!', 'alert-error')
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