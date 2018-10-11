<template>
    <div>
        <p>{{ last_name }}</p>
        <ul>
            <li v-for="(value, index) in directs">
                <directs :last_name="index" :directs="value"></directs>
            </li>
        </ul>
    </div>
</template>

<script>

    export default {
        name: "Directs",
        props: {
            last_name: String,
            directs: Object
        }
    }
</script>

<style scoped>

</style>