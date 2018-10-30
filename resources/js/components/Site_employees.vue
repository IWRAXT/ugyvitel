<template>
    <div>

        <div v-if="employees==''">

            <p>Nincs dolgozó hozzárendelve!</p>
        </div>
        <div v-else>
            <v-client-table :data="employees" :columns="columns" :options="options" :show-sort-icons="true">
                <template slot="name" slot-scope="props">
                    {{props.row.last_name}} {{props.row.first_name}}
                </template>
                <template slot="image" slot-scope="props">
                    <div><img :src="'/storage/images/'+props.row.image">
                    </div>
                </template>
            </v-client-table>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Site_employees",
        props: {
            siteid: Number,
        },
        data() {
            return {
                employees: [],
                columns: ['id', 'image', 'name', 'email', 'phone_number', 'job'],

                options: {
                    filterByColumn: true,
                    filterable: ['id','name', 'email', 'phone_number', 'job'],

                }

            }

        },
        mounted() {

            axios.get('/getAuthUserSiteId')
                .then(response => {
                    let id = response.data;
                    console.log(this.siteid);
                    if (this.siteid !== null) {
                        id = this.siteid;
                    }
                    axios.get('/getEmployees/' + id)
                        .then(response => {
                            this.employees = response.data;
                        })
                        .catch(function (error) {
                            alert("Hiba történt a dolgozók kiiratásában!");
                            console.log(error);
                        });


                })
                .catch(function (error) {
                    alert("Hiba történt a siteid beolvasásában!");
                    console.log(error);
                });

        }


    }
</script>

<style scoped>
    img {
        width: 50px;
        height: 50px;
        float: left;
        border-radius: 50%;
        margin-right: 10px;
    }

</style>