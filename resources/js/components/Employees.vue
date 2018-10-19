<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">

                    <h1>Dolgozók listája</h1></div>


                <div id="people">
                    <v-client-table :data="people" :columns="columns" :options="options" :show-sort-icons="true">
                        <template slot="image" slot-scope="props">
                            <div><img :src="'/storage/images/'+props.row.image">
                            </div>
                        </template>
                        <template slot="name" slot-scope="props">
                            {{props.row.last_name}} {{props.row.first_name}}
                        </template>
                        <template slot="principal name" slot-scope="props">
                            {{props.row.principal.last_name}} {{props.row.principal.first_name}}
                        </template>
                        <template slot="definite_employment" slot-scope="props">
                            <i v-if="props.row.definite_employment=='true'" class="fa fa-check"></i>
                            <i v-else="props.row.definite_employment=='false'" class="fa fa-close"></i>
                        </template>
                        <!--<template  slot="user.permission.name" slot-scope="props">-->
                        <!--<span v-if="props.row.user_id=='null'" > - </span>-->
                        <!--<span v-else > {{props.row.permission.name}} </span>-->

                        <!--</template>-->

                        <template slot="buttons" slot-scope="props">
                            <div class="table-button-container">
                                <!--Edit-->
                                <button class="btn btn-xs btn-secondary btn-sm"
                                        @click="props.row.showModal_edit = true">
                                    Edit
                                </button>

                                <modal v-if="props.row.showModal_edit"
                                       @close=" props.row.showModal_edit = false; init()">

                                    <h3 slot="header">Edit <b>{{ props.row.last_name }} {{props.row.first_name }} </b>
                                    </h3>
                                    <p slot="body">
                                        <edit_employee :id="props.row.id"></edit_employee>
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
                                                       <!--:site_id="props.row.site_id"-->



                                    </p>

                                </modal>

                                <!--Directs - Át kell írni lastname firstname-re-->
                                <button @click="props.row.showModal_directs = true"
                                        class="edit-modal btn btn-outline-secondary btn-sm">Directs
                                </button>


                                <modal v-if="props.row.showModal_directs"
                                       @close="props.row.showModal_directs = false">

                                    <h3 slot="header">{{props.row.last_name}} {{props.row.first_name}}
                                        beosztottjai:</h3>
                                    <p slot="body">
                                        <directsList :id="props.row.id"
                                                     :last_name="props.row.last_name"></directsList>
                                    </p>

                                </modal>

                                <!--Delete-->
                                <button class="edit-modal btn btn-danger btn-sm"
                                        @click.prevent="deletePerson(props.row)">
                                    Delete
                                </button>
                                <!--Add Users Permission-->
                                <button v-if="props.row.user===null"
                                        @click="props.row.showModal_users = true"
                                        class="edit-modal btn btn-outline-secondary btn-sm">Add User
                                </button>


                                <modal v-if="props.row.showModal_users"
                                       @close=" props.row.showModal_users = false; init()  ">

                                    <h3 slot="header">Add User permission to <b>{{ props.row.last_name }}
                                        {{props.row.first_name }}</b></h3>
                                    <p slot="body">
                                        <addUser :last_name="props.row.last_name"
                                                 :first_name="props.row.first_name"
                                                 :email="props.row.email"
                                                 :id="props.row.id"
                                        ></addUser>

                                    </p>

                                </modal>

                            </div>
                        </template>

                    </v-client-table>


                </div>


                <!--<div class="table-responsive">-->
                <!--<table id="table_id" class="table table-responsive table-hover ">-->

                <!--<thead class="thead-dark">-->
                <!--<tr>-->
                <!--<th width="5">#</th>-->
                <!--<th width="150">Image</th>-->
                <!--<th>Name</th>-->
                <!--<th>Born</th>-->
                <!--<th>E-mail</th>-->
                <!--<th>Address</th>-->
                <!--<th>Phone</th>-->
                <!--<th>Salary</th>-->
                <!--<th>Definite employment?</th>-->
                <!--<th>Recruitment date</th>-->
                <!--<th>Job</th>-->
                <!--<th>Comment</th>-->
                <!--<th>Principal</th>-->
                <!--<th>Permission name</th>-->
                <!--<th width="240"></th>-->
                <!--</tr>-->
                <!--</thead>-->
                <!--<tbody>-->
                <!--<tr v-for="person in people">-->
                <!--<td>{{person.id}}</td>-->
                <!--<td><img :src="'/storage/images/'+person.image"></td>-->
                <!--<td>{{ person.last_name }} {{ person.first_name }}</td>-->
                <!--<td>{{ person.born }}</td>-->
                <!--<td>{{ person.email}}</td>-->
                <!--<td>{{ person.address }}</td>-->
                <!--<td>{{ person.phone_number }}</td>-->
                <!--<td>{{ person.month_salary }}</td>-->
                <!--<td>{{ person.definite_employment }}</td>-->
                <!--<td>{{ person.recruitment_date }}</td>-->
                <!--<td>{{ person.job}}</td>-->
                <!--<td>{{ person.comment }}</td>-->
                <!--<td>{{ person.principal.last_name}} {{person.principal.first_name}}</td>-->

                <!--<td v-if="person.user_id !== null"> {{person.user.permission.name}}</td>-->
                <!--<td v-else> - Null -</td>-->

                <!--<td>-->
                <!--&lt;!&ndash;Directs - Át kell írni lastname firstname-re&ndash;&gt;-->
                <!--<button id="show-modal2" @click="person.showModal_directs = true"-->
                <!--class="edit-modal btn btn-outline-secondary btn-sm">Directs-->
                <!--</button>-->


                <!--<modal v-if="person.showModal_directs"-->
                <!--@close="person.showModal_directs = false">-->

                <!--<h3 slot="header">{{person.last_name}} {{person.first_name}} beosztottjai:</h3>-->
                <!--<p slot="body">-->
                <!--<directsList :id="person.id"-->
                <!--:last_name="person.last_name"></directsList>-->
                <!--</p>-->

                <!--</modal>-->
                <!--&lt;!&ndash;Edit&ndash;&gt;-->
                <!--<button class="btn btn-xs btn-secondary btn-sm"-->
                <!--@click="person.showModal_edit = true">-->
                <!--Edit-->
                <!--</button>-->

                <!--<modal v-if="person.showModal_edit"-->
                <!--@close=" person.showModal_edit = false; init()">-->

                <!--<h3 slot="header">Edit <b>{{ person.last_name }} {{person.first_name-->
                <!--}} </b>-->
                <!--</h3>-->
                <!--<p slot="body">-->
                <!--<edit_employee :id="person.id"-->
                <!--:image="person.image"-->
                <!--:last_name="person.last_name"-->
                <!--:first_name="person.first_name"-->
                <!--:born="person.born"-->
                <!--:email="person.email"-->
                <!--:address="person.address"-->
                <!--:phone_number="person.phone_number"-->
                <!--:month_salary="person.month_salary"-->
                <!--:definite_employment="person.definite_employment"-->
                <!--:recruitment_date="person.recruitment_date"-->
                <!--:job="person.job"-->
                <!--:comment="person.comment"-->
                <!--:principal="person.principal_id"-->
                <!--&gt;</edit_employee>-->

                <!--</p>-->

                <!--</modal>-->
                <!--&lt;!&ndash;Delete&ndash;&gt;-->
                <!--<button class="edit-modal btn btn-danger" btn-sm-->
                <!--@click.prevent="deletePerson(person)">-->
                <!--Delete-->
                <!--</button>-->
                <!--&lt;!&ndash;Add Users Permission&ndash;&gt;-->
                <!--<button v-if="person.user===null" id="show-modal"-->
                <!--@click="person.showModal_users = true"-->
                <!--class="edit-modal btn btn-outline-secondary btn-sm">Add User-->
                <!--</button>-->


                <!--<modal v-if="person.showModal_users"-->
                <!--@close=" person.showModal_users = false; init()  ">-->

                <!--<h3 slot="header">Add User permission to <b>{{ person.last_name }}-->
                <!--{{person.first_name }}</b></h3>-->
                <!--<p slot="body">-->
                <!--<addUser :last_name="person.last_name"-->
                <!--:first_name="person.first_name"-->
                <!--:email="person.email"-->
                <!--:id="person.id"-->
                <!--&gt;</addUser>-->

                <!--</p>-->

                <!--</modal>-->
                <!--</td>-->
                <!--</tr>-->
                <!--</tbody>-->
                <!--</table>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</template>

<script>

    export default {


        data: function () {
            return {
                people: [],
                hasError: true,
                columns: ['id', 'image', 'name', 'born', 'email', 'address', 'phone_number', 'month_salary', 'definite_employment', 'recruitment_date', 'job', 'comment', 'principal name', 'user.permission.name', 'site.name', 'buttons'],

                options: {
                    filterByColumn: true,
                    toMomentFormat: 'born',
                    listColumns: {
                        name: [],
                    },
                    filterable: ['name', 'born', 'email', 'address'],
                    columnsDropdown: true,
                    clientMultiSorting: true,
                    columnsDisplay: {},
                    footerHeadings: true,
                    // datepickerPerColumnOptions:{},

                    // dateColumns: ['born'],
                    // dateFormat: 'YYYY-MM-DD',
                    datepickerOptions: {
                        showDropdowns: true,
                    },
                    headings: {
                        name: 'Name',
                        id: '#',
                        'principal.last_name': 'Principal',
                        'user.permission.name': 'Permission',
                        'site.name': 'Site',
                    },

                },

            }
        },

        mounted() {
            this.init()
        },
        methods: {
            init() {
                console.log("Inicializálás...");
                axios.get('/people')
                    .then(response => {
                        let people = response.data;
                        people.map(person => {
                            person.showModal_users = false
                            person.showModal_directs = false
                            person.showModal_edit = false
                            return person
                        });
                        this.people = people;
                        console.log(people);
                    })


                    .catch(function (error) {
                        alert("Hiba történt az oldal betöltése során!");

                        console.log(error);
                    });


            },

            deletePerson: function (person) {

                let conf = confirm("Tényleg törli a dolgozót?");
                if (conf === true) {

                    axios.post('/people/' + person.id)
                        .then(function (response) {
                            console.log('Sikerült a dolgozót törölni !');
                            this.people = response.data.people;
                            showNotification(response.data.notification, response.data.notificationType);
                        })

                        .catch(function (error) {
                                showNotification('Nem sikerült a dolgozót törölni!', 'alert-error');
                                console.log(error);

                            }
                        );
                }
            },


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

    /*th {*/
    /*padding-top: 12px;*/
    /*padding-bottom: 12px;*/
    /*text-align: left;*/
    /*background-color: #838383;*/
    /*color: white;*/
    /*}*/

    /*td {*/

    /*vertical-align: center;*/
    /*}*/
</style>