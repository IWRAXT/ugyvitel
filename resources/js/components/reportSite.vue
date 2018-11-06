<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h1>Költségtípusok összesítése telephelyenként</h1></div>
                    <div class="card-body">
                        <table id="table_id" class="table table-responsive table-hover ">
                            <tbody v-for="site in sites">
                            <tr></tr>
                            <tr>
                                <th>{{ site.name}} költségtípusai:</th>
                                <td></td>
                            </tr>
                            <tr v-for="t in site.types">
                                <th rowspan="count(site.types)"></th>
                                <td>{{t.type}}:</td>
                                <td>   {{t.sum}} Ft</td>
                            </tr>
                            <tr>
                                <th>{{ site.name}} </th>
                                <td></td>
                                <td>Ʃ: {{site.cost}} Ft</td>
                            </tr>
                            </tbody>
                        </table>
                        <h5>Összes kiadás: {{summary}} Ft</h5>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h1>Telephelyi összesítés</h1></div>
                    <div class="card-body">
                        <table id="table2_id" class="table table-responsive table-hover ">
                            <tbody v-for="site in sites">
                            <tr></tr>
                            <tr>
                                <th>{{ site.name}} </th>
                                <td>Ʃ: {{site.cost}} Ft</td>
                            </tr>

                            </tbody>
                        </table>
                        <h5>Összes kiadás: {{summary}} Ft</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "reportSite",
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

</style>