<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-md-11 col-lg-9">
                <div class="wrapper">
                    <div class="title">
                        <h4>{{ ads.title }}</h4>
                        <p class="d-flex justify-content-between align-items-center" style="margin-top: 20px;">
                            <small><b>{{ ads.created_at }}</b></small>
                            <a v-if="(ads.user.is_auth && ads.is_owner)" target="_blank" :href="url"
                               class="btn-sm btn btn-outline-light">EDIT</a>
                        </p>
                    </div>

                    <div class="body">
                        <el-text class="mx-1" size="large" style="color: white;">{{ ads.body }}</el-text>
                    </div>

                    <div class="mt-4">
                        <span class="information tag-information" v-for="tag in this.splitTextInformation()">
                            <el-tag type="primary" effect="dark" size="small">
                                <strong>{{ tag }}</strong>
                            </el-tag>
                        </span>
                    </div>

                    <div class="information mt-3">
                        <el-tag type="success" effect="dark" size="small"><strong>Ціна {{ ads.price }}</strong>
                        </el-tag>
                    </div>

                    <div class="contact">
                        <el-tag type="success" effect="dark" size="small">
                            <a class="contact" :href="'tel:' + ads.user.phone">
                                <strong>{{ ads.user.phone }} - {{ ads.user.name }}</strong>
                            </a>
                        </el-tag>
                    </div>

                    <div class="images">
                        <div v-for="image in ads.images" class="image">
                            <img class="img-fluid" :src="image.link"/>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a v-if="(ads.user.is_auth && ads.is_owner)" target="_blank" :href="url"
                           class="btn-sm btn btn-outline-light">EDIT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Ads",
    props: {
        ads: {
            required: true,
            type: Object,
        },
        url: {
            required: true,
            type: String,
        }
    },

    methods: {
        splitTextInformation() {
            return this.ads.information.split("|");
        }
    }
}
</script>

<style scoped>

.wrapper {
    padding: 15px;
}

.title {
    text-align: center;
}

.information {
    margin-top: 2%;
}

.contact {
    margin-top: 2%;
}

.contact a {
    text-decoration: none;
}

.images {
    margin-top: 20px;
}

.image {
    display: flex;
    justify-content: center;
    margin-bottom: 4%;
}

.tag-information {
    display: inline-block;
    margin-right: 8px;
    margin-top: 10px;
}

.contact {
    color: white;
    font-size: 15px;
    text-decoration-line: underline;
}
</style>
