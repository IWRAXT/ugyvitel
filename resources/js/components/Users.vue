<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <h1>Userek listája</h1>
                </div>


                <div id="users">

                    <div @click="seen = !seen" class="control">
                        <button>Jogosultság típusok</button>
                    </div>

                    <div v-if="seen" id="hide">
                        <permission></permission>
                    </div>

                    <v-client-table :data="users" :columns="columns" :options="options">
                        <!--<template slot="employee.image" slot-scope="props">-->
                        <!--<div><img :src="'/storage/images/'+props.row.image">-->
                        <!--</div>-->
                        <!--</template>-->
                        <template slot="permission_id" slot-scope="props">
                            {{props.row.permission.name}}
                        </template>
                        <template slot="permission.sites" slot-scope="props">
                            <span v-if="props.row.permission.sites=='1'">Listázhatja az összes telephelyet</span>
                            <span v-else>Csak a saját telephelyét listázhatja</span>
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
                                        <edit_user :id="props.row.id"
                                                   :permission_id="props.row.permission_id"></edit_user>

                                    </p>

                                </modal>

                                <!--Delete-->
                                <button class="edit-modal btn btn-danger btn-sm"
                                        @click.prevent="deleteUser(props.row)">
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
                seen: false,

                columns: ['id', 'name', 'email', 'permission_id', 'permission.sites', 'buttons'],

                options: {
                    filterByColumn: true,
                    filterable: ['name', 'email', 'permission_id'],
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

            deleteUser(user) {

                let conf = confirm("Tényleg törli a usert?");
                if (conf === true) {
                    console.log("A User id: " + user.id);

                    axios.post('/users/' + user.id) //UserControllerbe küldi
                        .then(response => {


                            showNotification(response.data.notification, response.data.notificationType);
                            // this.users=response.data.users;
                            console.log(this.users);
                            this.init();

                        })

                        .catch(function (error) {
                                alert("Nem sikerült törölni!");
                                // showNotification('Nem sikerült a usert törölni!', 'alert-error');
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