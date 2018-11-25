<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card ">
                    <div class="card-header">
                        <h1>Költségtípusok összesítése (telephelyenként)</h1></div>
                    <div class="card-body">
                        <div>
                            <div class="alert alert-dark ">
                                <h4>Összes kiadás: {{summary}} Ft</h4>
                            </div>
                            <div class="col-md-4" v-for="site in sites">
                                <table class="table table-responsive table-hover">
                                    <tbody>
                                    <tr></tr>
                                    <tr>
                                        <th>{{ site.name}} költségtípusai:</th>
                                        <td></td>
                                    </tr>
                                    <tr v-for="t in site.types">
                                        <th rowspan="count(site.types)"></th>
                                        <td>{{t.type}}:</td>
                                        <td> {{t.sum}} Ft</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">

                                            <div class="alert alert-secondary ">
                                                {{ site.name}}
                                                Ʃ: {{site.cost}} Ft
                                            </div>
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "reportCost",
        data: function () {
            return {
                sites: [],
                summary: '',
            }
        },
        mounted() {
            axios.get('/sites')
                .then(response => {
                    this.sites = response.data;
                    console.log(this.sites)
                })
                .catch(function (error) {
                    alert("Hiba történt a telephelyek betöltése során!");
                    console.log(error);
                });
            axios.get('/costs/sum')
                .then(response => {
                    this.summary = response.data;
                })
                .catch(function (error) {
                    alert("Hiba történt a végösszeg betöltése során!");
                    console.log(error);
                });
        }
    }
</script>

<style scoped>
    tbody{
        font-size: 14px;
    }
</style>