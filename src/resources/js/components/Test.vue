<template>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <h1>Test Component</h1>

    <el-input v-model="input" style="width: 240px" placeholder="Please input"/>

</template>

<script>

import { ref } from 'vue'
const input = ref('')
export default {
    name: "Test",

    mounted() {
        this.$errorNotify("Terst")
    }
}
</script>

<style scoped>

</style>
