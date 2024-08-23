<template>

    <Menu/>

    <div class="mt-100 mb-5">

        <search @search="getAds"/>

        <el-checkbox @change="getAds" v-model="dateOrderBy">Самые старые по дате</el-checkbox>

        <el-table v-loading="loading" :data="this.tableData" stripe style="max-width: 100%">
            <el-table-column label="Оголошення" align="center">
                <template #default="scope">
                    <div>
                        <small><strong>{{ scope.row.created }} - {{ scope.row.price }}</strong></small>
                    </div>

                    <a :href="`${urlOlxAdsPrefix}/${scope.row.slug}`">
                        {{ scope.row.title }}
                    </a>

                    <div class="mt-3 d-flex justify-content-center">
                    <span class="d-flex justify-content-between w-50">

                         <el-tag type="success" size="default">
                             <a :href="`${urlOlxAdsPrefix}/${scope.row.slug}/edit`"><strong>edit</strong></a>
                        </el-tag>

                          <el-tag type="info" size="default">
                             <a :href="scope.row.olx" target="_blank"><strong>olx</strong></a>
                        </el-tag>

                        <DeleteAdsButton @deleteAds="removeAds" :urlOlxAdsPrefix="urlOlxAdsPrefix" :ads="scope.row"/>
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
import Search from "../../components/search/Search.vue";


export default {
    name: "AdsAll",
    components: {Search, MainPagination, DeleteAdsButton, Menu},
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
            urlOlxAdsPrefix: null,
            totalRecords: 0,
            dateOrderBy: false,
            pagination: {
                pageSize: 15,
                pageSizes: [10, 15, 30, 50, 100],
                currentPage: 1,
                limit: 15,
                offset: 0,
                show: true,
            },
        }
    },

    mounted() {
        this.getAds();
    },

    methods: {
        getAds(search = null) {
            this.loading = true;
            const data = {
                limit: this.pagination.limit,
                offset: this.pagination.offset,
                dateOrderBy: this.dateOrderBy,
            };

            if(search && search.title) {
                data['search'] = search;
                this.pagination.show = false;
            }else {
                this.pagination.show = true;
            }

            axios.post(this.url, data)
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
            this.urlOlxAdsPrefix = response.data.urlOlxAdsPrefix;
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



</style>
