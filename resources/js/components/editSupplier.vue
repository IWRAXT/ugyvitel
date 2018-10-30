<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <form id="editForm" name="editForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Név: </label>
                        <input type="text" class="form-control" id="name" name="name" :value=supplier.name>
                    </div>
                    <div class="form-group">
                        <label for="fiscal_number">Adószám: </label>
                        <input type="text" class="form-control" id="fiscal_number" name="fiscal_number" :value=supplier.fiscal_number>
                    </div>
                    <div class="form-group">
                        <label for="address">Cím: </label>
                        <input type="text" class="form-control" id="address" name="address" :value=supplier.address>
                    </div>
                    <div class="form-group">
                        <label for="webpage_address">Weblap cím: </label>
                        <input type="text" class="form-control" id="webpage_address" name="webpage_address" :value=supplier.webpage_address>
                    </div>
                    <div class="form-group">

                        <label for="contact_title">Kapcsolattartó titulusa: </label>
                        <input type="text" class="form-control" id="contact_title" name="contact_title" :value=supplier.contact_title>

                        <label for="contact_name">Kapcsolattartó neve: </label>
                        <input type="text" class="form-control" id="contact_name" name="contact_name" :value=supplier.contact_name>


                    </div>
                    <div class="form-group">
                        <label for="contact_email">Kapcsolattartó email címe: </label>
                        <input type="text" class="form-control" id="contact_email" name="contact_email" :value=supplier.contact_email>
                    </div>
                    <div class="form-group">
                        <label for="contact_phone_number">Kapcsolattartó telefon száma: </label>
                        <input type="number" class="form-control" id="contact_phone_number" name="contact_phone_number" :value=supplier.contact_phone_number>
                    </div>

                    <div class="btn btn-primary" @click.prevent="editSupplier()">
                        <button type="submit" class="btn btn-primary">Rögzít</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "editSupplier",
        props: {
            id: Number, //linkel küldött {id}

        },
        data: function () {

            return {
                supplier: [],
            }
        },
        mounted() {

            axios.get('/supplier/'+ this.id + '/edit')
                .then(response => {
                    this.supplier = response.data;
                })
                .catch(function (error) {
                    alert("Hiba történt a beszállítói adatok betöltése során!");
                    console.log(error);
                });


        },

        methods: {
            editSupplier(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;

                let editForm = document.getElementById('editForm');

                const formData = new FormData(editForm);

                axios.post('/supplier/' + this.id + '/update', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {
                        console.log('Sikerült a beszállítót frissíteni !');
                        showNotification(response.data.notification, response.data.notificationType);
                    }
                ).catch(function (error) {
                        alert("Nem sikerült a számlát hozzáadni !");
                        showNotification('Nem sikerült a számlát hozzáadni!', 'alert-error')
                        console.log(error);

                    }
                );

            },

        }

    }
</script>

<style scoped>

</style>