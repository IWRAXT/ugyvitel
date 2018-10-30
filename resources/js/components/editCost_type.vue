<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <form id="editForm" name="editForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Név: </label>
                        <input type="text" class="form-control" id="name" name="name" :value=cost_type.name>
                    </div>
                    <div class="form-group">
                        <label for="group">Csoport: </label>
                        <select title="group" id="group" name="group" v-model="cost_type.group">

                            <option disabled value="">Please select one</option>
                            <option>Anyagköltség</option>
                            <option>Útiköltség</option>
                            <option>Szolgáltatás</option>

                        </select>

                    </div>
                    <div class="btn btn-primary" @click.prevent="editCost_type()">
                        <button type="submit" class="btn btn-primary">Rögzít</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "editCost_type",
        props: {
            id: Number, //linkel küldött {id}

        },
        data: function () {

            return {
                cost_type: [],
            }
        },
        mounted() {

            axios.get('/cost_types/'+ this.id + '/edit')
                .then(response => {
                    this.cost_type = response.data;
                })
                .catch(function (error) {
                    alert("Hiba történt a számla betöltése során!");
                    console.log(error);
                });


        },

        methods: {
            editCost_type(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;

                let editForm = document.getElementById('editForm');

                const formData = new FormData(editForm);

                axios.post('/cost_types/' + this.id + '/update', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {
                        console.log('Sikerült a költségtípust frissíteni !');
                        showNotification(response.data.notification, response.data.notificationType);
                    }
                ).catch(function (error) {
                        alert("Nem sikerült a költségtípust hozzáadni !");
                        showNotification('Nem sikerült a költségtípust frissíteni!', 'alert-error')
                        console.log(error);

                    }
                );

            },

        }

    }
</script>

<style scoped>
    /*img {*/
    /*width: 30%;*/
    /*margin: auto;*/
    /*display: block;*/
    /*margin-bottom: 10px;*/
    /*}*/
</style>