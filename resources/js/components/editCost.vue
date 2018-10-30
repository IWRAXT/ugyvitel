<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <form id="editForm" name="editForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="date">Dátum: </label>
                        <input type="date" class="form-control" id="date" name="date" :value=cost.date>
                    </div>
                    <div class="form-group">
                        <label for="account_number">Számlaszám: </label>
                        <input type="text" class="form-control" id="account_number" name="account_number" :value=cost.account_number>
                    </div>

                    <div class="form-group">
                        <label for="sum">Összeg: </label>
                        <input type="number" class="form-control" id="sum" name="sum" :value=cost.sum>
                        <p>Ft</p>
                    </div>

                    <div class="form-group">
                        <label for="site_id">Telephely: </label>
                        <select title="site_id" id="site_id" name="site_id" v-model="cost.site_id">

                            <option disabled value="">Please select one</option>
                            <option v-for="s in sites" :value="s.id">
                                <span>{{s.name}} </span>
                            </option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Beszállító: </label>
                        <select title="supplier_id" id="supplier_id" name="supplier_id" v-model="cost.supplier_id">

                            <option disabled value="">Please select one</option>
                            <option v-for="s in suppliers" :value="s.id">
                                <span>{{s.name}} </span>
                            </option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cost_type_id">Kiadás típus: </label>
                        <select title="cost_type_id" id="cost_type_id" name="cost_type_id" v-model="cost.cost_type_id">

                            <option disabled value="">Please select one</option>
                            <option v-for="c in cost_types" :value="c.id">
                                <span>{{c.name}} </span>
                            </option>

                        </select>
                        <button class="btn btn-primary">
                            <a href="/cost_types/create"></a>
                            <span class="glyphicon glyphicon-plus"></span> New
                        </button>
                    </div>
                    <div class="form-group">
                        <label for="comment">Egyéb: </label>
                        <input type="text" class="form-control" id="comment" name="comment" :value="cost.comment">
                    </div>

                    <div class="btn btn-primary" @click.prevent="editCost()">
                        <button type="submit" class="btn btn-primary">Rögzít</button>
                    </div>

                    <button class="btn btn-primary">
                        <a href="/costs/create"></a>
                        <span class="glyphicon glyphicon-plus"></span> New
                    </button>


                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "editCost",
        props: {
            id: Number, //linkel küldött {id}

        },
        data: function () {

            return {
                sites: [],
                cost: [],
                suppliers: [],
                cost_types: [],
                site_id:'',
                supplier_id:'',
                cost_type_id:'',
            }
        },
        mounted() {

            axios.get('/costs/'+ this.id + '/edit')
                .then(response => {
                    this.cost = response.data;
                })
                .catch(function (error) {
                    alert("Hiba történt a számla betöltése során!");
                    console.log(error);
                });
            axios.get('/sites')
                .then(response => {
                    this.sites = response.data;
                    console.log(response.data);
                })
                .catch(function (error) {
                    alert("Hiba történt a telephelyek betöltése során!");
                    console.log(error);
                });
            axios.get('/suppliers')
                .then(response => {
                    this.suppliers = response.data;
                    console.log(response.data);
                })
                .catch(function (error) {
                    alert("Hiba történt a beszállítók betöltése során!");
                    console.log(error);
                });
            axios.get('/cost_types')
                .then(response => {
                    this.cost_types = response.data;
                })
                .catch(function (error) {
                    alert("Hiba történt a kiadás típusok betöltése során!");
                    console.log(error);
                });

        },

        methods: {
            editCost(e) {

                // let input = this.newEmployee;
                // let id = this.id;
                // if (input['permission'] === '' || input['site'] === ''|| input['password'] === '' ) {
                //     this.hasError = true;
                // } else {
                //     this.hasError = false;

                let editForm = document.getElementById('editForm');

                const formData = new FormData(editForm);

                axios.post('/costs/' + this.id + '/update', formData,

                    {headers: {'Content-Type': 'multipart/form-data'}}
                ).then(function (response) {
                        console.log('Sikerült a számlát hozzáadni !');
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
    /*img {*/
    /*width: 30%;*/
    /*margin: auto;*/
    /*display: block;*/
    /*margin-bottom: 10px;*/
    /*}*/
</style>