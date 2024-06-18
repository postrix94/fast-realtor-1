<template>
    <div class="mt-5 d-flex justify-content-center">
        <div class="col-12 col-md-8">
            <el-input
                v-model="olx"
                size="large"
                placeholder="Вставте посилання з OLX"
                class="w-100"
            />

            <el-button @click.prevent="onClickBtnOlx" type="primary" size="default" class="w-100">Отримати</el-button>

            <div v-if="this.saveImages()" class="mt-3">
                <el-checkbox v-model="isSaveImages" label="Зберегти фото" size="large" style="color: #ffffff"/>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Home",
    props: {
        user: {
            required: true,
            type: Object,
        },

        olx_parser_route: {
            required: true,
            type: String,
        }
    },
    data() {
        return {
            olx: "",
            isSaveImages: false,
            regexpOlxLink: new RegExp("^https?://(www|m).olx.ua[\\w\\W]+"),
        }
    },

    methods: {
        onClickBtnOlx() {
            // if (!this.isLinkOlx(this.olx.trim())) {
            //     this.$warningNotify("Вставте посилання з OLX")
            //     return null;
            // }

            axios.post(this.olx_parser_route, {olx_link:this.olx.trim()})

        },

        isLinkOlx(link) {
            return this.regexpOlxLink.test(link);
        },

        successResponse(response) {

        },

        errorResponse(error) {

        },


    }


}
</script>

<style scoped>

</style>
