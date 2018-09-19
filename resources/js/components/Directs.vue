<template>
    <div>
        <p>{{ name }}</p>
        <ul>
            <li v-for="(value, index) in directs">
                <directs :name="index" :directs="value"></directs>
            </li>
        </ul>
    </div>
</template>

<script>

    export default {
        name: "Directs",
        props: {
            name: String,
            directs: Object
        }
    }
</script>

<style scoped>

</style>