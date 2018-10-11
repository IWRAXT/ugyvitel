<template>
    <div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">

                <h1>Jogosultságok listája</h1>
                <div class="panel-body">
                    <table id="table_id" class="table-responsive table-bordered table-striped ">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="permission in permissions">
                            <td>{{permission.id}}</td>
                            <td>{{ permission.name }}</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "addPermission",
        data: function() {
            return {
                permissions: [],
            }},
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