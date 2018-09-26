<template>
    <div>
        <div class="col-lg-12">
            <div class="panel panel-default">

                <h1>Dolgozók listája</h1>
                <div class="panel-body">
                    <table class="table-responsive table-bordered table-striped ">
                        <thead>
                        <tr>
                            <th width="2%">#</th>
                            <th width="150">Image</th>
                            <th>Name</th>
                            <th>Born</th>
                            <!--<th>E-mail</th>-->
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Salary</th>
                            <th>Definite employment?</th>
                            <th>Recruitment date</th>
                            <th>Job</th>
                            <th>Comment</th>
                            <th>Principal</th>
                            <th>userID</th>
                            <!--<th>Permission name</th>-->
                            <th width="240"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="person in people">
                            <td>{{person.id}}</td>
                            <td><img :src="'/images/'+person.image"></td>
                            <td>{{ person.last_name }} {{ person.first_name }}</td>
                            <td>{{ person.born }}</td>
                            <!--<td>{{person.email}}</td>-->
                            <td>{{ person.address }}</td>
                            <td>{{ person.phone_number }}</td>
                            <td>{{ person.month_salary }}</td>
                            <td>{{ person.definite_employment }}</td>
                            <td>{{ person.recruitment_date }}</td>
                            <td>{{person.job}}</td>
                            <td>{{ person.comment }}</td>
                            <td>{{ person.principal_id }}</td>
                            <td>@{{person.user.name}}</td>
                            <!--<td>{{person.user().permission()}}</td>-->

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

                                <button class="edit-modal btn bt n-danger" @click.prevent="deletePerson(person)">Delete
                                </button>

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



    // const axios = require('axios');

    export default {
        data: function() {
            return {
                people: []
            }
        },

        mounted() {
            let app=this;
            axios.get('/people')
                .then(function (response){
                    // response => {
                    // let people = response.data;
                    // people.map(person => {
                    //     person.showModal = false
                    //     return person
                    // })
                    //  this.people = people

                    app.people=response.data;

                    // console.log(people);

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
                        //  then(function () {
                        //      this.people=this.people.splice(person.id,1);}


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