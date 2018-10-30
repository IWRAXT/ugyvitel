<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h1>Új beszállító rögzítése</h1></div>
                    <div class="card-body">

                        <form id="addForm" name="addForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Név: </label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="fiscal_number">Adószám: </label>
                                <input type="text" class="form-control" id="fiscal_number" name="fiscal_number">
                            </div>
                            <div class="form-group">
                                <label for="address">Cím: </label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="form-group">
                                <label for="webpage_address">Weblap cím: </label>
                                <input type="text" class="form-control" id="webpage_address" name="webpage_address">
                            </div>
                            <div class="form-group">
                                <label for="contact_title">Kapcsolattartó titulusa: </label>
                                <input type="text" class="form-control" id="contact_title" name="contact_title">

                                <label for="contact_name">Kapcsolattartó neve: </label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name">

                            </div>
                            <div class="form-group">
                                <label for="contact_email">Kapcsolattartó email címe: </label>
                                <input type="text" class="form-control" id="contact_email" name="contact_email">
                            </div>
                            <div class="form-group">
                                <label for="contact_phone_number">Kapcsolattartó telefon száma: </label>
                                <input type="number" class="form-control" id="contact_phone_number" name="contact_phone_number">
                            </div>

                            <div class="btn btn-primary" @click.prevent="addSupplier()">
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
        name: "addSupplier",
        props: {},
        data: function () {

            return {}
        },
        mounted() {


        },

        methods: {
            addSupplier(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;m
                // } else {
                //     this.hasError = false;

                let addForm = document.getElementById('addForm');

                const formData = new FormData(addForm);

                axios.post('/supplier', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {
                        console.log('Sikerült a beszállítót hozzáadni !');
                        showNotification(response.data.notification, response.data.notificationType);
                    }
                ).catch(function (error) {

                        showNotification('Nem sikerült beszállítót hozzáadni!', 'alert-error')
                        console.log(error);

                    }
                );

            },

        }

    }
</script>

<style scoped>

</style>