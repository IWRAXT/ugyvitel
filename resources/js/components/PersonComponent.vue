<template>
    <div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="panel panel-default">

                <h1>Dolgozók listája</h1>
                <div class="panel-body">
                    <table id="table_id" class="table-responsive table-bordered table-striped ">
                        <thead>
                        <tr>
                            <th width="5%">#</th>
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
                            <td>{{ // person.principal_id }}</td>

                            <td v-if="person.user_id !== null" > {{person.user.permission.name}}</td>
                            <td v-else > - Null - </td>

                            <td>
                                <!--<button id="show-modal" @click="person.showModal = true"-->
                                        <!--class="edit-modal btn btn-outline-secondary">Directs-->
                                <!--</button>-->


                                <!--<modal v-if="person.showModal" @close="person.showModal = false">-->

                                    <!--<h3 slot="header">{{person.name}} beosztottjai:</h3>-->
                                    <!--<p slot="body">-->
                                        <!--<directsList :id="person.id" :name="person.name"></directsList>-->
                                    <!--</p>-->

                                <!--</modal>-->

                                <a :href="'/people/'+person.id+'/edit'" class="btn btn-xs btn-secondary">Edit</a>

                                <button class="edit-modal btn btn-danger" @click.prevent="deletePerson(person)">Delete</button>

                                <button v-if="person.user===null" id="show-modal" @click="person.showModal = true"
                                        class="edit-modal btn btn-outline-secondary">Add User</button>


                                <modal v-if="person.showModal" @close="person.showModal = false">

                                    <h3 slot="header">Add User permission to <b>{{ person.last_name }} {{ person.first_name }}</b> </h3>
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

        <!--<b-row>-->
            <!--<b-col md="6" class="my-1">-->
                <!--<b-form-group horizontal label="Search" class="mb-0">-->
                    <!--<b-input-group>-->
                        <!--<b-form-input v-model="filter" placeholder="Type to Search" />-->
                        <!--<b-input-group-append>-->
                            <!--<b-btn :disabled="!filter" @click="filter = ''">Clear</b-btn>-->
                        <!--</b-input-group-append>-->
                    <!--</b-input-group>-->
                <!--</b-form-group>-->
            <!--</b-col>-->
        <!--</b-row>-->

        <!--<b-table responsive-->
                 <!--striped hove-->
                 <!--:sort-by.sync="sortBy"-->
                 <!--:items="people"-->
                 <!--:fields="fields"-->
                 <!--:sort-desc.sync="sortDesc"-->
                 <!--@filtered="onFiltered"-->
                 <!--footClone-->
                 <!--:filter="filter">-->

            <!--&lt;!&ndash;:sort-direction="sortDirection"&ndash;&gt;-->


            <!--&lt;!&ndash;<template slot="row-details" slot-scope="data">&ndash;&gt;-->
                <!--&lt;!&ndash;<row v-for="(person, id) in data.people" :key="id"  >&ndash;&gt;-->

                    <!--&lt;!&ndash;<template slot="name" slot-scope="people">&ndash;&gt;-->
                        <!--&lt;!&ndash;{{people.value.last_name}} {{people.value.first_name}}&ndash;&gt;-->
                    <!--&lt;!&ndash;</template>&ndash;&gt;-->

                     <!--<template slot="img" slot-scope="people">-->
                         <!--<div class="img-circle img-circle&#45;&#45;size" v-bind:style="{backgroundImage: `url(${people.image})`, backgroundSize: 'cover', backgroundPosition: 'center' }"></div>-->
                        <!--&lt;!&ndash;<b-img :src="'/storage/images/default.jpg'"/>&ndash;&gt;-->
                    <!--</template>-->


                <!--&lt;!&ndash;</row>&ndash;&gt;-->

            <!--&lt;!&ndash;</template>&ndash;&gt;-->

        <!--</b-table>-->
    </div>


</template>


<script>
export default {
        data: function() {
            return {
                people: [],
                hasError: true,
                sortBy: 'email',
                sortDesc: false,
                filter: null,
                fields: [
                    {label: 'Name', key: 'name',  variant: 'danger' }, //sortable: true,
                    {label: 'Birth', key:'born', sortable: true},
                    {label: 'E-mail', key:'email', sortable: true},
                    {label: 'Img', key:'img'},

                ],
            }
        },
        computed: {
            // sortOptions () {
            //     // Create an options list from our fields
            //     return this.fields
            //         .filter(f => f.sortable)
            //         .map(f => { return { text: f.label, value: f.key } })
            // },
            onFiltered (filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length;
                this.currentPage = 1;
            }
        },

        mounted() {
            // let app=this;
            axios.get('/people')
                .then(response => {
                    let people = response.data;
                    people.map(person => {
                        person.showModal = false
                        return person
                    });
                     this.people = people;
                    console.log(people);
                    // app.people=response.data;
                })


                .catch(function (error) {
                    alert("Hiba történt az oldal betöltése során!");
                    console.log(error);
                });
        },
        methods: {
            deletePerson: function (person) {

                let conf = confirm("Tényleg törli a dolgozót?");
                if (conf === true) {

                     axios.post('/people/' + person.id)
                       .then(response => this.people = response.data)

                        .catch(function (error) {
                                alert("Nem sikerült törölni!");
                                console.log(error);

                            }
                        )
                    ;
                }
            },



        }

    }

</script>
<style scoped>
    img {
        width: 150px;
        height: 150px;
        float: left;
        border-radius: 50%;
        margin-right: 25px;
    }

    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #838383;
        color: white;
    }

    td {

        /*vertical-align: center;*/
    }
</style>