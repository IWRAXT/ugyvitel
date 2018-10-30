<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12"></div>


                    <div id="app">
                        <v-client-table :data="cost_types" :columns="columns" :options="options">

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
                                            <edit_cost_type :id="props.row.id"
                                            ></edit_cost_type>

                                        </p>

                                    </modal>

                                    <!--Delete-->
                                    <button class="edit-modal btn btn-danger btn-sm"
                                            @click.prevent="deleteCost_type(props.row)">
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
        name: "Cost_types",
        data: function () {
            return {
                cost_types: [],
                hasError: true,

                columns: ['name', 'group','buttons'],

                options: {
                    filterByColumn: true,
                    filterable: ['name', 'group'],
                    columnsDropdown: true,
                    // clientMultiSorting: true,
                    // columnsDisplay: {},
                    // headings: {
                    //     name: 'Name',
                    //     id: '#',
                    //     permission_id: 'Permission',
                    //     'permission.sites': 'Permission to site handle'
                    // },
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
                axios.get('/cost_types')
                    .then(response => {
                        let cost_types = response.data;
                        cost_types.map(cost_type => {

                            cost_type.showModal_edit = false
                            return cost_type
                        });
                        this.cost_types = cost_types;
                        console.log(cost_types);
                    })
                    .catch(function (error) {
                        alert("Hiba történt az oldal betöltése során!");
                        console.log(error);
                    });

            }
            ,

            deleteCost_type(cost_type) {

                let conf = confirm("Tényleg törli a kiadás típust?");
                if (conf === true) {
                    console.log("cost_type id: " + cost_type.id);

                    axios.post('/cost_types/' + cost_type.id) //CostTypeControllerbe küldi
                        .then(response => {


                            showNotification(response.data.notification, response.data.notificationType);
                            // this.users=response.data.users;
                            console.log(this.cost_types);
                            this.init();

                        })

                        .catch(function (error) {
                                alert("Nem sikerült törölni!");
                                // showNotification('Nem sikerült a usert törölni!', 'alert-error');
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