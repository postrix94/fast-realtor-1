<template>
    <Navigation/>

    <div v-loading="loading" element-loading-background="rgba(122, 122, 122, 0.9)" class="mt-100 d-flex justify-content-center">
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

            <div v-if="isShowLink" class="d-flex justify-content-center">
                <el-tag  type="info"><a target="_blank" :href="publicLink">{{publicLink}}</a></el-tag>
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
        },

    },
    data() {
        return {
            olx: "https://www.olx.ua/d/uk/obyavlenie/2-k-kvartira-v-zhk-parus-z-meblyami-ta-o-za-vul-mazepi-IDRzrqc.html",
            isSaveImages: false,
            regexpOlxLink: new RegExp("^https?://(www|m).olx.ua[\\w\\W]+"),
            isShowLink: false,
            loading: false,
            publicLink: "",
        }
    },

    methods: {
        onClickBtnOlx() {
            if (!this.isLinkOlx(this.olx.trim())) {
                this.$warningNotify("Вставте посилання з OLX")
                return null;
            }

            this.loading = !this.loading;

            axios.post(this.olx_parser_route, {olx_link: this.olx.trim()})
                .then(this.successResponse)
                .catch(this.errorResponse)
                .finally(() => {
                    this.olx = "";
                    this.loading = !this.loading;
                });

        },

        isLinkOlx(link) {
            return this.regexpOlxLink.test(link);
        },

        successResponse(response) {
            this.isShowLink = !this.isShowLink
            this.publicLink = response.data.link
        },

        errorResponse(error) {
            try {
                this.$errorNotify(error.response.data.message);
            } catch (e) {
                this.$errorNotify("Помилка");
            }
        },


    }


}
</script>

<style scoped>
    a {
        text-decoration: none;
    }

    .mt-100 {
        margin-top: 100px;
    }

</style>
