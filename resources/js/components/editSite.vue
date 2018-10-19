<template>
    <div><p>EditSite</p>
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <form id="editForm" name="editForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" :value=site.name>
                    </div>

                    <div class="form-group">
                        <label for="image">Mostani képe: </label>
                        <img :src="url" id="image" name="image">
                        <input type="file" @change="onFileChange" class="form-control-file" id="file" name="file">
                        <button @click="removeImage">Remove image</button>

                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" :value="site.address">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                               :value="site.phone_number">
                    </div>
                    <div class="form-group">
                        <label for="leader">Leader</label>
                        <input type="text" class="form-control" id="leader" name="leader"
                               :value="site.leader">
                    </div>

                    <div class="btn btn-primary" @click.prevent="updateSite()">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "editSite",
        props: {
            id: Number, //linkel küldött {id}

        },
        data: function () {

            return {
                url: '',
                image:'',
                site: {},
                delete: false,
            }
        },
        mounted() {


            axios.get('/sites/' + this.id + '/edit')
                .then(response => {
                    console.log(response.data);
                    this.site = response.data;
                    this.image=this.site.image;
                    this.url = "/storage/images/" + this.site.image;
                })
                .catch(function (error) {
                    alert("Hiba történt a telephely adatok betöltése során!");
                    console.log(error);
                });


        },
        methods: {
            updateSite: function createSite(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;


                //Formdata használatánál a template-nél kell a form
                let editForm = document.getElementById('editForm');
                console.log(editForm);
                const formData = new FormData(editForm);
                if (this.image !== '') {
                    formData.append('image', (new Blob([this.image])));
                } else {
                    formData.append('delete', this.delete);
                }

                axios.post('/sites/' + this.id + '/update', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {

                        // Todo: employees,users,sites listázásnál, ne propsok legyenek hanem axios hívás, akkor nem kell majd az init()fg-se

                        showNotification(response.data.notification, response.data.notificationType);
                        console.log('Telephely adatai frissítve! !');
                    }
                ).catch(function (error) {
                        alert("Telephely adatok frissítése sikertelen volt!");
                        showNotification('Telephely adatok frissítése sikertelen volt!', 'alert-error');
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
                this.url = "/storage/images/default-site.jpg";
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