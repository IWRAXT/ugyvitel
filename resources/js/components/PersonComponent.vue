<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <h1>Dolgozók listája</h1></div>


            <div class="table-responsive">
                <table id="table_id" class="table table-responsive table-hover ">

                    <thead class="thead-dark">
                    <tr>
                        <th width="5">#</th>
                        <th width="150">Image</th>
                        <th>Name</th>
                        <th>Born</th>
                        <th>E-mail</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>Definite employment?</th>
                        <th>Recruitment date</th>
                        <th>Job</th>
                        <th>Comment</th>
                        <!--<th>Principal</th>-->
                        <th>Permission name</th>
                        <th width="240"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="person in people">
                        <td>{{person.id}}</td>
                        <td><img :src="'/storage/images/'+person.image"></td>
                        <td>{{ person.last_name }} {{ person.first_name }}</td>
                        <td>{{ person.born }}</td>
                        <td>{{ person.email}}</td>
                        <td>{{ person.address }}</td>
                        <td>{{ person.phone_number }}</td>
                        <td>{{ person.month_salary }}</td>
                        <td>{{ person.definite_employment }}</td>
                        <td>{{ person.recruitment_date }}</td>
                        <td>{{person.job}}</td>
                        <td>{{ person.comment }}</td>
                        <!--<td>{{  person.principal.last_name }} {{  person.principal.first_name }}</td>-->

                        <td v-if="person.user_id !== null"> {{person.user.permission.name}}</td>
                        <td v-else> - Null -</td>

                        <td>
                            <!--Directs - Át kell írni lastname firstname-re-->
                            <button id="show-modal2" @click="person.showModal_directs = true; init()"
                                    class="edit-modal btn btn-outline-secondary">Directs
                            </button>


                            <modal v-if="person.showModal_directs"
                                   @close="person.showModal_directs = false">

                                <h3 slot="header">{{person.last_name}} {{person.first_name}}
                                    beosztottjai:</h3>
                                <p slot="body">
                                    <directsList :id="person.id"
                                                 :name="person.last_name+' '+person.first_name"></directsList>
                                </p>

                            </modal>
                            <!--Edit-->
                            <button class="btn btn-xs btn-secondary"
                                    @click="person.showModal_edit = true">
                                Edit
                            </button>

                            <modal v-if="person.showModal_edit"
                                   @close=" person.showModal_edit = false; init()">

                                <h3 slot="header">Edit <b>{{ person.last_name }} {{person.first_name
                                    }} </b>
                                </h3>
                                <p slot="body">
                                    <edit_employee :id="person.id"
                                                   :image="person.image"
                                                   :last_name="person.last_name"
                                                   :first_name="person.first_name"
                                                   :born="person.born"
                                                   :email="person.email"
                                                   :address="person.address"
                                                   :phone_number="person.phone_number"
                                                   :month_salary="person.month_salary"
                                                   :definite_employment="person.definite_employment"
                                                   :recruitment_date="person.recruitment_date"
                                                   :job="person.job"
                                                   :comment="person.comment"
                                                   :principal="person.principal_id"
                                    ></edit_employee>

                                </p>

                            </modal>
                            <!--Delete-->
                            <button class="edit-modal btn btn-danger"
                                    @click.prevent="deletePerson(person)">
                                Delete
                            </button>
                            <!--Add Users Permission-->
                            <button v-if="person.user===null" id="show-modal"
                                    @click="person.showModal_users = true"
                                    class="edit-modal btn btn-outline-secondary">Add User
                            </button>


                            <modal v-if="person.showModal_users"
                                   @close=" person.showModal_users = false; init()  ">

                                <h3 slot="header">Add User permission to <b>{{ person.last_name }}
                                    {{person.first_name }}</b></h3>
                                <p slot="body">
                                    <addUser :last_name="person.last_name"
                                             :first_name="person.first_name"
                                             :email="person.email"
                                             :id="person.id"
                                    ></addUser>

                                </p>

                            </modal>
                        </td>
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
        data: function () {
            return {
                people: [],
                hasError: true,


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
                        .then(response => this.people = response.data)

                        .catch(function (error) {
                                alert("Nem sikerült törölni!");
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