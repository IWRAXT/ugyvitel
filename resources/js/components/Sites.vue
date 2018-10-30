<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <h1>Telephelyek listája</h1></div>


                <div id="sites">
                    <v-client-table :data="sites" :columns="columns" :options="options">
                        <template slot="image" slot-scope="props">
                            <div><img :src="'/storage/images/'+props.row.image">
                            </div>
                        </template>
                        <template slot="leader" slot-scope="props">
                            <span v-if="props.row.leader_id==null"> - </span>
                            <span v-else>{{props.row.leader.last_name}} {{props.row.leader.first_name}}</span>
                        </template>
                        <template slot="buttons" slot-scope="props">
                            <div class="table-button-container">
                                <!--Edit-->
                                <button class="btn btn-xs btn-secondary btn-sm"
                                        @click="props.row.showModal_edit = true">
                                    Edit
                                </button>

                                <modal v-if="props.row.showModal_edit"
                                       @close=" props.row.showModal_edit = false; init()">

                                    <h3 slot="header">Edit <b>{{ props.row.name }} </b>
                                    </h3>
                                    <p slot="body">
                                        <edit_site :id="props.row.id"></edit_site>

                                    </p>

                                </modal>

                                <button @click="props.row.showModal_employees = true"
                                        class="edit-modal btn btn-outline-secondary btn-sm">Dolgozók
                                </button>


                                <modal v-if="props.row.showModal_employees"
                                       @close="props.row.showModal_employees = false">

                                    <h3 slot="header">{{props.row.name}} dolgozói:</h3>
                                    <p slot="body">
                                        <site_employees :siteid="props.row.id"></site_employees>
                                    </p>

                                </modal>

                                <!--Delete-->
                                <button class="edit-modal btn btn-danger btn-sm" @click.prevent="deleteSite(props.row)">
                                   Site Delete
                                </button>
                                <button class="edit-modal btn btn-danger btn-sm" >
                                     Delete Site's employees
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
        data: function () {
            return {
                sites: [],
                hasError: true,
                columns: ['id', 'image', 'name', 'address', 'phone_number', 'leader', 'buttons'],

                options: {
                    filterByColumn: true,
                    listColumns: {
                        name: [],
                    },
                    filterable: ['name', 'address', 'phone_number', 'leader'],
                    columnsDropdown: true,
                    clientMultiSorting: true,
                    columnsDisplay: {},
                    footerHeadings: true,
                    // datepickerPerColumnOptions:{},

                    // dateFormat: 'YYYY-MM-DD',
                    datepickerOptions: {
                        showDropdowns: true,
                    },
                    headings: {
                        name: 'Name',
                        id: '#',
                    },

                }

            }
        },

        mounted() {
            this.init()
        },
        methods: {
            init() {
                console.log("Inicializálás...");
                axios.get('/sites')
                    .then(response => {
                        let sites = response.data;
                        sites.map(site => {
                            site.showModal_employees = false
                            site.showModal_edit = false
                            return site
                        });
                        this.sites = sites;
                        console.log(sites);
                    })


                    .catch(function (error) {
                        alert("Hiba történt az oldal betöltése során!");
                        console.log(error);
                    });


            },

            deleteSite: function (site) {

                let conf = confirm("Tényleg törli a telephelyet?");
                if (conf === true) {

                    axios.post('/sites/' + site.id)
                        .then(response => {
                                if (response.data) {
                                    this.sites = response.data.sites;
                                }

                                showNotification(response.data.notification, response.data.notificationType);
                            }
                        )

                        .catch(function (error) {
                                alert("Nem sikerült törölni!");
                                console.log(error);

                            }
                        );
                }
            },


        }

    }


</script>

<style scoped>
    img {
        width: 80px;
        height: 80px;
        float: left;
        border-radius: 50%;
        margin-right: 10px;
    }


</style>