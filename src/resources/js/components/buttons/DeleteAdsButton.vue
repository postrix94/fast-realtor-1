<template>
    <el-button @click="deleleAds(ads)" size="small" type="danger">Delete</el-button>
</template>

<script>
export default {
    name: "DeleteAdsButton",
    props: {
      ads: {
          required: true,
          type: Object,
      }
    },
    emits: ['deleteAds'],
    methods: {
        deleleAds(ads) {
            if (!confirm(`Видалити оголошення ${ads.title} ?`)) return;

            if(!ads.delete_url_ads) return;

            axios.post(ads.delete_url_ads)
                .then(this.successDeleteAds)
                .catch(this.errorResponse);
        },

        successDeleteAds(response) {
            this.$emit("deleteAds", response.data.id);
        },

        errorResponse(error) {
            const message = error.response ? error.response.data.message : "Помилка";
            this.$errorNotify(message);
        }
    }
}
</script>

<style scoped>

</style>
