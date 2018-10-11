<template>
    <div>
        <p v-if="directs!=0">
            <directs :last_name="last_name" :directs="directs"></directs>
        </p>
        <p v-else>Nincs beosztottja!</p>
    </div>
</template>

<script>
    export default {
        name: "DirectsList",
        props: {
            id: Number,
            last_name: String,
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