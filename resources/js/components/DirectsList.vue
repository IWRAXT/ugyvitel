<template>
    <div>
        <p v-if="directs!=0">
            <directs :name="name" :directs="directs"></directs>
        </p>
        <h5 v-else>Nincs beosztottja!</h5>
    </div>
</template>

<script>
    export default {
        name: "DirectsList",
        props: {
            id: Number,
            name: String,
        },
        data() {
            return {
                directs: {},
            };
        },
        mounted() {
            axios.get('/getDirects/' + this.id)
                .then(response => this.directs = response.data)
                .catch(function (error) {
                    alert("Hiba történt a beosztottak kiiratásában!");
                    console.log(error);
                });
        }
    }
</script>

<style scoped>

</style>