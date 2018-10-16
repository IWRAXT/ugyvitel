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
                        <template slot="buttons" slot-scope="props">
                            <div class="table-button-container">
                                <!--Edit-->
                                <button class="btn btn-xs btn-secondary btn-sm"
                                        @click="props.row.showModal_edit = true">
                                    Edit
                                </button>

                                <!--<modal v-if="props.row.showModal_edit"-->
                                       <!--@close=" props.row.showModal_edit = false; init()">-->

                                    <!--<h3 slot="header">Edit <b>{{ props.row.last_name }} {{props.row.first_name }} </b>-->
                                    <!--</h3>-->
                                    <!--<p slot="body">-->
                                        <!--<edit_employee :id="props.row.id"-->
                                                       <!--:image="props.row.image"-->
                                                       <!--:last_name="props.row.last_name"-->
                                                       <!--:first_name="props.row.first_name"-->
                                                       <!--:born="props.row.born"-->
                                                       <!--:email="props.row.email"-->
                                                       <!--:address="props.row.address"-->
                                                       <!--:phone_number="props.row.phone_number"-->
                                                       <!--:month_salary="props.row.month_salary"-->
                                                       <!--:definite_employment="props.row.definite_employment"-->
                                                       <!--:recruitment_date="props.row.recruitment_date"-->
                                                       <!--:job="props.row.job"-->
                                                       <!--:comment="props.row.comment"-->
                                                       <!--:principal="props.row.principal_id"-->
                                        <!--&gt;</edit_employee>-->

                                    <!--</p>-->

                                <!--</modal>-->

                                <!--Directs - Át kell írni lastname firstname-re-->
                                <button @click="props.row.showModal_employees = true"
                                        class="edit-modal btn btn-outline-secondary btn-sm">Dolgozók
                                </button>


                                <!--<modal v-if="props.row.showModal_directs"-->
                                       <!--@close="props.row.showModal_directs = false">-->

                                    <!--<h3 slot="header">{{props.row.last_name}} {{props.row.first_name}}-->
                                        <!--beosztottjai:</h3>-->
                                    <!--<p slot="body">-->
                                        <!--<directsList :id="props.row.id"-->
                                                     <!--:last_name="props.row.last_name"></directsList>-->
                                    <!--</p>-->

                                <!--</modal>-->

                                <!--Delete-->
                                <button class="edit-modal btn btn-danger btn-sm" @click.prevent="deleteSite(props.row)">
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
        data: function () {
            return {
                sites: [],
                hasError: true,
                columns: ['id', 'image', 'name', 'address', 'phone_number',  'leader', 'buttons'],

                options: {
                    filterByColumn: true,
                    listColumns: {
                        name:[],
                    },
                    filterable: ['name', 'address', 'phone_number',  'leader'],
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
                        .then(response => this.sites = response.data)

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