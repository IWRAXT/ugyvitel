<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <h1>Beszállítók listája</h1></div>

                <div id="app">

                    <v-client-table :data="suppliers" :columns="columns" :options="options">

                        <template slot="buttons" slot-scope="props">
                            <div class="table-button-container">
                                <!--Edit-->
                                <button class="btn btn-xs btn-secondary btn-sm"
                                        @click="props.row.showModal_edit = true">
                                    Edit
                                </button>

                                <modal v-if="props.row.showModal_edit"
                                       @close=" props.row.showModal_edit = false; init()">

                                    <h3 slot="header">Edit <b> {{props.row.name }} </b>
                                    </h3>
                                    <p slot="body">
                                        <edit_supplier :id="props.row.id"></edit_supplier>
                                    </p>

                                </modal>

                                <!--Delete-->
                                <button class="edit-modal btn btn-danger btn-sm"
                                        @click.prevent="deleteSupplier(props.row)">
                                    Delete
                                </button>

                            </div>
                        </template>

                    </v-client-table>


                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Suppliers",
        data: function () {
            return {
                suppliers: [],
                hasError: true,

                columns: ['name','fiscal_number','address','webpage_address','contact_name','contact_title','contact_email','contact_phone_number','buttons'],

                options: {
                    filterByColumn: true,
                    filterable: ['name','fiscal_number','address','webpage_address','contact_name','contact_title','contact_email','contact_phone_number'],
                    columnsDropdown: true,
                },


            }

        },

        mounted() {
            this.init()
        }
        ,
        methods: {
            init() {
                console.log("Inicializálás...");
                axios.get('/suppliers')
                    .then(response => {
                        let suppliers = response.data;
                        suppliers.map(supplier => {

                            supplier.showModal_edit = false
                            return supplier
                        });
                        this.suppliers =suppliers;
                        console.log(suppliers);
                    })
                    .catch(function (error) {
                        alert("Hiba történt az oldal betöltése során!");
                        console.log(error);
                    });

            }
            ,

            deleteSupplier(supplier) {

                let conf = confirm("Tényleg törli a beszállítót?");
                if (conf === true) {
                    console.log("supplier id: " + supplier.id);

                    axios.post('/suppliers/' + supplier.id) //SupplierControllerbe küldi
                        .then(response => {
                            showNotification(response.data.notification, response.data.notificationType);

                            console.log(this.suppliers);
                            this.init();

                        })

                        .catch(function (error) {
                                // alert("Nem sikerült törölni!");
                                showNotification('Nem sikerült a beszállítót törölni!', 'alert-error');
                                console.log(error);

                            }
                        );

                }
            },

        }

    }


</script>

<style scoped>


</style>