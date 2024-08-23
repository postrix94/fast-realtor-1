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
        },

        urlOlxAdsPrefix: {
            required: true,
            type: String,
        }
    },
    emits: ['deleteAds'],
    methods: {
        deleleAds(ads) {
            if (!confirm(`Видалити оголошення ${ads.title} ?`)) return;
            const url = `${this.urlOlxAdsPrefix}/${ads.slug}/delete`;

            axios.post(url)
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
