<template>

    <Menu/>

    <div class="mt-100 mb-5">
        <div class="search mb-3">
            <el-input v-model="search" size="small" placeholder="Пошук"/>
        </div>

        <el-table v-loading="loading" :data="this.tableData" stripe style="max-width: 100%">

            <el-table-column label="Оголошення" align="center">
                <template #default="scope">
                    <div>
                        <small><strong>{{ scope.row.created }} - {{ scope.row.price }}</strong></small>
                    </div>

                    <a :href="scope.row.public_url_ads">
                        {{ scope.row.title }}
                    </a>

                    <div class="mt-3 d-flex justify-content-center">
                    <span class="d-flex justify-content-between w-50">

                         <el-tag type="success" size="default">
                             <a :href="scope.row.edit_url_ads"><strong>edit</strong></a>
                        </el-tag>

                          <el-tag type="info" size="default">
                             <a :href="scope.row.olx" target="_blank"><strong>olx</strong></a>
                        </el-tag>

                        <DeleteAdsButton @deleteAds="removeAds" :ads="scope.row"/>
                    </span>
                    </div>
                </template>
            </el-table-column>
        </el-table>

        <MainPagination @getRecords="getAds" :pagination="pagination" :totalRecords="totalRecords"/>
    </div>
</template>

<script>
import Menu from "../../components/navigation/Menu.vue";
import DeleteAdsButton from "../../components/buttons/DeleteAdsButton.vue";
import MainPagination from "../../components/pagination/MainPagination.vue";


export default {
    name: "AdsAll",
    components: {MainPagination, DeleteAdsButton, Menu},
    props: {
        url: {
            require: true,
            type: String,
        }
    },
    data() {
        return {
            loading: true,
            tableData: [],
            totalRecords: 0,
            search: null,
            pagination: {
                pageSize: 15,
                pageSizes: [10, 15, 30, 50, 100],
                currentPage: 1,
                limit: 15,
                offset: 0,
            },
        }
    },

    mounted() {
        this.getAds();
    },

    methods: {
        getAds() {
            this.loading = true;

            axios.post(this.url, {limit: this.pagination.limit, offset: this.pagination.offset})
                .then(this.successResponse)
                .catch(this.errorResponse)
                .finally(() => this.loading = false);
        },

        removeAds(id) {
            this.tableData.forEach((ads, index) => {
                if (ads.id === id) {
                    this.tableData.splice(index, 1);
                }
            });
        },

        successResponse(response) {
            this.tableData = response.data.ads.ads;
            this.totalRecords = response.data.ads.totalRecords
        },

        errorResponse(error) {
            const message = error.response ? error.response.data.message : "Помилка";
            this.$errorNotify(message);
        }
    }
}
</script>

<style scoped>
.mt-100 {
    margin-top: 100px;
}

.search {
    width: 100%;
    margin-left: auto;
}

@media (min-width: 776px) {
    /* Стили для экранов шириной 776 пикселей и больше */
    .search {
        width: 25%;
    }
}

</style>
