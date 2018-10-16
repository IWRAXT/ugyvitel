<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <h1>Userek listája</h1></div>

                <div id="users">
                    <v-client-table :data="users" :columns="columns" :options="options">
                        <!--<template slot="employee.image" slot-scope="props">-->
                            <!--<div><img :src="'/storage/images/'+props.row.image">-->
                            <!--</div>-->
                        <!--</template>-->
                        <template slot="permission_id" slot-scope="props">
                            {{props.row.permission.name}}
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

                                <!--Delete-->
                                <button class="edit-modal btn btn-danger btn-sm" @click.prevent="deleteUser(props.row)">
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
        name: "Users",
        data: function () {
            return {
                users: [],
                hasError: true,
                columns: ['id','name', 'email', 'password', 'permission_id', 'buttons'],

                options: {
                    filterByColumn: true,
                    headings: {
                        name: 'Name',
                        id: '#',
                        permission_id: 'Permission'
                    },
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
                axios.get('/users')
                    .then(response => {
                        let users = response.data;
                        users.map(user => {

                            user.showModal_edit = false
                            return user
                        });
                        this.users = users;
                        console.log(users);
                    })


                    .catch(function (error) {
                        alert("Hiba történt az oldal betöltése során!");
                        console.log(error);
                    });


            }
            ,

            deleteUser: function (user) {

                let conf = confirm("Tényleg törli a telephelyet?");
                if (conf === true) {

                    axios.post('/users/' + user.id)
                        .then(response => this.users = response.data)

                        .catch(function (error) {
                                alert("Nem sikerült törölni!");
                                console.log(error);

                            }
                        );
                }
            }
            ,


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