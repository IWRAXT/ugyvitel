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
                        <template slot="permission.sites" slot-scope="props">
                            <span v-if="props.row.permission.sites=='1'" >Listázhatja a telephelyeket</span>
                            <span v-else>Csak a saját telephelyét</span>
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

                                <h3 slot="header">Edit <b> {{props.row.name }} </b>
                                </h3>
                                <p slot="body">
                                <edit_user :id="props.row.id"></edit_user>

                                </p>

                                </modal>

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

                columns: ['id', 'name', 'email', 'permission_id', 'permission.sites', 'buttons'],

                options: {
                    filterByColumn: true,
                    filterable: ['name', 'email','permission_id'],
                    columnsDropdown: true,
                    clientMultiSorting: true,
                    columnsDisplay: {},
                    headings: {
                        name: 'Name',
                        id: '#',
                        permission_id: 'Permission',
                        'permission.sites': 'Permission to site handle'
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

                let conf = confirm("Tényleg törli a usert?");
                if (conf === true) {

                    axios.post('/users/' + user.id)
                        .then(function (response) {
                            console.log('Sikerült a usert törölni !');
                            this.users = response.data.users;
                            showNotification(response.data.notification, response.data.notificationType);
                        })

                        .catch(function (error) {
                                alert("Nem sikerült törölni!");
                                showNotification('Nem sikerült a usert törölni!', 'alert-error');
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