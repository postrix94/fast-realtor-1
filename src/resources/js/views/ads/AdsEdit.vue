<template>
    <div class="wrapper" v-loading="showLoader" element-loading-background="rgba(122, 122, 122, 0.8)">
        <el-form label-width="auto">
            <el-form-item>
                <el-input v-model="title"/>
            </el-form-item>

            <el-form-item>
                <el-input
                    v-model="body"
                    :autosize="{ minRows: 10, maxRows: 25 }"
                    type="textarea"/>
            </el-form-item>

            <el-form-item>
                <el-input v-model="comment" :rows="3" type="textarea"/>
            </el-form-item>

            <div class="mb-4 d-flex justify-content-between">
                <div>
                    <div class="d-flex mb-2">

                        <div style="margin-right: 10px;">
                            <el-tag type="info">{{ ads.ads_id }}</el-tag>
                        </div>

                        <div>
                            <el-tag type="success">
                                <a :href="ads.olx" target="_blank">olx - {{ ads.owner_name }}</a>
                            </el-tag>
                        </div>

                    </div>
                </div>

                <el-input v-model="price" style="max-width: 140px" size="small" placeholder="Ціна"/>
            </div>


            <div class="d-flex justify-content-between align-items-baseline">
                <div>
                    <strong>
                        <a :href="public_url_ads" class="fs-6"
                           style="cursor: pointer; text-decoration:none; color: lightgray">до
                            оголошення</a>
                    </strong>
                </div>

                <el-form-item>
                    <el-button @click.prevent="onClickBtnEdit" :style="'margin-left: auto'" type="success">редагувати
                    </el-button>
                </el-form-item>
            </div>

            <div class="container">
                <div class="row g-3">
                    <div v-for="image in this.ads.images" :ref="'id' + image.id" class="image col-xs-12 col-xl-4">
                        <div>
                            <div @click="removeImage(image.id)" class="text-center"
                                 style="cursor:pointer;background: #dc3545;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                </svg>
                            </div>
                            <img class="img-fluid" style="max-width:400px;" :src="image.link"/>
                        </div>
                    </div>
                </div>
            </div>

            <el-form-item>
                <el-button @click.prevent="onClickBtnEdit" :style="'margin: auto'" type="success">редагувати</el-button>
            </el-form-item>

        </el-form>
    </div>
</template>

<script>


export default {
    name: "AdsEdit",
    props: {
        url: {
            required: true,
            type: String,
        },
        ads: {
            required: true,
            type: Object,
        },

        public_url_ads: {
            required: true,
            type: String,
        }
    },

    data() {
        return {
            title: "",
            body: "",
            price: "",
            comment: "",
            showLoader: false,
            validation: {
                title: {max_length: 70, min_length: 5},
                body: {max_length: 25000,},
                price: {max_length: 30},
                comment: {max_length: 500},
            }
        }
    },
    mounted() {
        this.title = this.ads.title;
        this.body = this.ads.body;
        this.price = this.ads.price;
        this.comment = this.ads.commentary;
    },
    methods: {
        removeImage(id) {
            const key = "id" + id;
            const imageContainerEl = this.$refs[key].length ? this.$refs[key][0] : null;

            if (!imageContainerEl) return;
            imageContainerEl.remove();

            this.ads.images = this.ads.images.filter((img) => img.id !== id);
        },

        inputsValidation() {
            switch (true) {
                case this.title.length < this.validation.title.min_length:
                    this.$warningNotify(`Заголовок мінімум ${this.validation.title.min_length} символів - зараз ${this.title.length}`);
                    return false;
                case this.title.length > this.validation.title.max_length:
                    this.$warningNotify(`Заголовок максимум ${this.validation.title.max_length} символів - зараз ${this.title.length}`);
                    return false;
                case this.body.length > this.validation.body.max_length:
                    this.$warningNotify(`Опис максимум ${this.validation.body.max_length} символів - зараз ${this.body.length}`);
                    return false;
                case this.price.length > this.validation.price.max_length:
                    this.$warningNotify(`Ціна максимум ${this.validation.price.max_length} символів - зараз ${this.price.length}`);
                    return false;
                case this.comment !== null && this.comment.length > this.validation.comment.max_length:
                    this.$warningNotify(`Коментарій максимум ${this.validation.comment.max_length} символів - зараз ${this.comment.length}`);
                    return false;
            }

            return true;
        },

        onClickBtnEdit() {
            if (!this.inputsValidation()) return;
            this.showLoader = !this.showLoader;

            const data = {
                id: this.ads.id,
                title: this.title,
                body: this.body,
                price: this.price,
                commentary: this.comment,
                images: this.ads.images
            };

            axios.post(this.url, data)
                .then(this.successResponse)
                .catch(this.errorResponse)
                .finally(() => this.showLoader = !this.showLoader);
        },

        successResponse(response) {
            const message = response.data.message;
            this.$successNotify(message);
        },

        errorResponse(error) {
            const message = error.response ? error.response.data.message : "Помилка";
            this.$warningNotify(message);
        },

    }
}
</script>

<style scoped>
.wrapper {
    margin-top: 50px;
}

.images {
    margin-top: 20px;
}

.image {
    display: flex;
    justify-content: center;
    margin-bottom: 4%;

}
</style>
