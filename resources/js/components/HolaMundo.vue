<template>
    <p>{{message}}</p> 
</template>

<script>
    export default {
        props: {message: String},
        mounted() {
            console.log("Funciona bien");
        }
    } 
</script>  