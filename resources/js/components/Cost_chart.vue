<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h1>Dashboard</h1></div>
                    <div class="card-body">
                        <apexcharts width="500" type="bar" :options="chartoptions" :series="series"></apexcharts>




                        <div class="btn-group" v-for="s in sites">

                            <button class="btn btn-primary" type="button" data-toggle="collapse"
                                    data-target="#cartcollapse"  aria-controls="cartcollapse" @click="piemount(s.id)">
                                {{s.name}}
                            </button>

                        </div>
                        <div class="collapse" id="cartcollapse">
                            <div class="card card-body">

                                <!--<p>{{s.name}}</p>-->
                                <apexcharts width="400" height="200" type="donut" :options="piechartoptions"
                                            :series="pieseries" ></apexcharts>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import VueApexCharts from 'vue-apexcharts'

    export default {
        name: "Cost_chart",
        components: {
            apexcharts: VueApexCharts,
        },
        data: function () {
            return {
                sites: [],

                chartoptions: {

                    yaxis: {
                        labels: {
                            show: true,
                            formatter: function (val) {
                                return val + " Ft";
                            }
                        }

                    },
                    // hasábok tetején az értékek + formázása
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                position: 'top', // top, center, bottom
                            },
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) {
                            return val + " Ft";
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '12px',
                            colors: ["#304758"]
                        }
                    },
                    title: {
                        text: 'Kölség összesítő telephelyenként',
                        floating: true,
                        offsetY: 320,
                        align: 'center',
                        style: {
                            color: '#444'
                        }
                    },
                    chart: {
                        id: 'vuechart-example',
                    },
                },
                series: [{
                    name: 'Költség',
                    data: [{
                        x: [],
                        y: [{}]
                    }]
                }],


                pieseries: [],
                piechartoptions: {
                    chart: {
                        id: 'vuechart-example-pie',

                    },
                    dataLabels: {

                    },
                    plotOptions: {
                        xaxis: {
                            categories: []
                        },
                    },
                    labels: [],


                },


            }
        },
        methods: {
            piemount(id){
                axios.get('/sites/statistic_data/'+id)
                    .then(response => {
                        this.pieseries=response.data.values;
                        this.piechartoptions={labels: response.data.types};
                    })
                    .catch(function (error) {
                        alert("Hiba történt a statisztikai adatok betöltése során!");
                        console.log(error);
                    });




            },
        },
        mounted() {
            axios.get('/sites')
                .then(response => {
                    this.sites = response.data;
                    console.log(this.sites)
                })
                .catch(function (error) {
                    alert("Hiba történt a sites típusok betöltése során!");
                    console.log(error);
                });
            axios.get('/sites/statistic_data')
                .then(response => {
                    console.log(response.data.statistic);
                    this.series = [{data: response.data.statistic}];
                    // this.chartoptions.xaxis ={categories: response.data.sites};
                    // this.series = [{data: response.data.costs}];

                    // this.chartoptions.label = response.data.sites;
                    // this.series = response.data.costs;

                })
                .catch(function (error) {

                    alert("Hiba történt a statisztikai adatok betöltése során!");
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


    }
</script>

<style scoped>

</style>