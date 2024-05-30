<template>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <h1>Test Component</h1>
</template>

<script>
import iziToast from "izitoast";

export default {
    name: "Test",

    mounted() {
        iziToast.show({
            title: 'Hey',
            message: 'What would you like to add?'
        });
    }
}
</script>

<style scoped>

</style>
