<template>
    <span>{{ 70 - desc.length }}</span>
</template>

<script>
    export default {
        mounted() {
            console.log('Description Counter mounted.')
        },

        props: ['desc']
    }
</script>
