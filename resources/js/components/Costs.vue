<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <h1>Költségek listája</h1></div>

                <div id="app">

                    <div @click="seen = !seen" class="control">
                        <button>Költség típusok listája</button>
                    </div>

                    <div v-if="seen" id="hide">
                        <cost_types></cost_types>
                    </div>
                    <v-client-table :data="costs" :columns="columns" :options="options">

                        <template slot="buttons" slot-scope="props">
                            <div class="table-button-container">
                                <!--Edit-->
                                <button class="btn btn-xs btn-secondary btn-sm"
                                        @click="props.row.showModal_edit = true">
                                    Edit
                                </button>

                                <modal v-if="props.row.showModal_edit"
                                       @close=" props.row.showModal_edit = false; init()">

                                    <h3 slot="header">Edit <b> {{props.row.account_number }} </b>
                                    </h3>
                                    <p slot="body">
                                        <edit_cost :id="props.row.id"
                                        ></edit_cost>

                                    </p>

                                </modal>

                                <!--Delete-->
                                <button class="edit-modal btn btn-danger btn-sm"
                                        @click.prevent="deleteCost(props.row)">
                                    Delete
                                </button>

                            </div>
                        </template>

                    </v-client-table>
                    <div>
                        <p>Összses kiadás: {{this.sum}} Ft</p>
                    </div>

                </div>
                </div>
            </div>
        </div>

</template>

<script>
    export default {
        name: "Costs",
        data: function () {
            return {
                costs: [],
                seen: false,
                sum: '',
                hasError: true,

                columns: ['id', 'date', 'account_number', 'comment', 'sum', 'cost_type.name', 'supplier.name','site.name','buttons'],

                options: {
                    filterByColumn: true,
                    filterable: ['date', 'account_number', 'comment', 'sum', 'cost_type.name', 'supplier.name','site.name'],
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
                axios.get('/costs')
                    .then(response => {
                        let costs = response.data;
                        costs.map(cost => {

                            cost.showModal_edit = false
                            return cost
                        });
                        this.costs = costs;
                        console.log(costs);
                    })
                    .catch(function (error) {
                        alert("Hiba történt az oldal betöltése során!");
                        console.log(error);
                    });

                axios.get('/costs/sum')
                    .then(response => this.sum = response.data)

                    .catch(function (error) {
                        alert("Hiba történt az összrg betöltése során!");
                        console.log(error);
                    });
            }
            ,

            deleteCost(cost) {

                let conf = confirm("Tényleg törli a számlát?");
                if (conf === true) {
                    console.log("cost id: " + cost.id);

                    axios.post('/costs/' + cost.id) //CostControllerbe küldi
                        .then(response => {


                            showNotification(response.data.notification, response.data.notificationType);
                            // this.users=response.data.users;
                            console.log(this.costs);
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
            // summ(){
            //     let summary =0;
            //     console.log (this.costs);
            //    // for( const c in this.costs ){
            //    //
            //    //      // let s=c.sum;
            //    //      // summary=summary+s*1;
            //    //      console.log(c.id)
            //    //  }
            //
            //     for (let i=0;i<count(this.costs);i++){
            //         summary=summary+this.costs[i].sum;
            //     }
            //     // console.log(summary);
            //     return summary;
            // }
            // ,
        }

    }


</script>

<style scoped>


</style>