<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">

                            <h4>Jogosultságok listája</h4></div>
                        <div class="card-body">
                            <table id="table_id" class="table  ">
                                <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Name</th>
                                    <th>Sites</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="permission in permissions">
                                    <td>{{permission.id}}</td>
                                    <td>{{ permission.name }}</td>
                                    <td v-if="permission.sites==1" > Listázhatja a telephelyeket</td>
                                    <td v-if="permission.sites==0" >Csak a saját telephelyét</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: "addPermission",
        data: function () {
            return {
                permissions: [],
            }
        },
        mounted() {

            axios.get('/permission')
                .then(response => {
                    let permissions = response.data;
                    this.permissions = permissions;
                    console.log(permissions);
                })
                .catch(function (error) {
                    alert("Hiba történt a jogosultságok betöltése során!");
                    console.log(error);
                });
        },
    }

</script>

<style scoped>

</style>