<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h1>Új költség típus rögzítése</h1></div>
                    <div class="card-body">

                        <form id="addForm" name="addForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Név: </label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="group">Csoport: </label>
                                <select title="group" id="group" name="group">

                                    <option disabled value="">Please select one</option>
                                    <option>Anyagköltség</option>
                                    <option>Útiköltség</option>
                                    <option>Szolgáltatás</option>

                                </select>

                            </div>
                            <div class="btn btn-primary" @click.prevent="addCost_type()">
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
        name: "addCost_type",
        props: {},
        data: function () {

            return {}
        },
        mounted() {


        },

        methods: {
            addCost_type(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;

                let addForm = document.getElementById('addForm');

                const formData = new FormData(addForm);

                axios.post('/cost_type', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {
                        console.log('Sikerült a kiadás típust hozzáadni !');
                        showNotification(response.data.notification, response.data.notificationType);
                    }
                ).catch(function (error) {
                        // alert("Nem sikerült a kiadás típust hozzáadni !");
                        showNotification('Nem sikerült a kiadás típust hozzáadni!', 'alert-error')
                        console.log(error);

                    }
                );

            },

        }

    }
</script>

<style scoped>

</style>