<template>
    <button type="button" class="btn btn-sm d-block m-auto" :class="this.typeButton">{{this.text}}</button>
</template>

<script>
export default {
    name: "DefaultButton",
    props: {
        text: {
            type: String,
            required: true,
        },
        typeButton: {
            type: String,
            required: false,
            default: "btn-success",
        },
    },
}
</script>

<style scoped>

</style>
