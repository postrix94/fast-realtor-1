<template>
    <Menu/>

    <div class="mt-100 mb-5">
        <div class="search mb-3">
            <el-input v-model="search" size="small" placeholder="Пошук"/>
        </div>

        <el-table :data="tableData" stripe style="max-width: 100%">

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

                        <el-button size="small" type="danger">Delete</el-button>

                    </span>
                    </div>
                </template>
            </el-table-column>

        </el-table>

        <div class="d-flex justify-content-center mt-5">
            <el-pagination
                :page-sizes="pageSizes"
                :default-page-size="pageSize"
                layout="sizes, prev, pager, next"
                :total="tableData.length"
                :small="true"
                @current-change="handleCurrentChange"
                @size-change="handlePageSize"
                @next-click="nextClick"
            />
        </div>
    </div>


</template>

<script>
import Menu from "../../components/navigation/Menu.vue";


export default {
    name: "AdsAll",
    components: {Menu},

    props: {
        ads: {
            required: true,
            type: Object,
        }
    },

    data() {
        return {
            tableData: this.ads,
            search: null,
            background: true,
            pageSize: 2,
            pageSizes: [1, 2, 3, 4, 15, 30, 50, 100],
            currentPage: 1,
        }
    },

    methods: {
        handleCurrentChange(page)
        {
            this.currenPage = page;
        },
        handlePageSize(number) {
            this.pageSize = number;
        },

        nextClick(page) {
            this.currentPage = page;
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
