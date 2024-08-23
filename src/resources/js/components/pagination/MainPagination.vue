<template>
    <div v-if="pagination.show" class="d-flex justify-content-center mt-5">
        <el-pagination
            :page-sizes="pagination.pageSizes"
            :default-page-size="pagination.pageSize"
            layout="sizes, prev, pager, next,total"
            :total="totalRecords"
            :small="true"
            @current-change="handleCurrentChange"
            @size-change="handlePageSize"
            @next-click="nextClick"
            @prev-click="prevClick"
        />
    </div>
</template>

<script>
export default {
    name: "MainPagination",
    props: {
        pagination: {
            required: true,
            type: Object,
        },

        totalRecords: {
            required: true,
            type: Number,
        }
    },
    data() {
      return {
          background: true,
      }
    },
    emits: ["getRecords"],
    methods: {
        handleCurrentChange(page) {
            this.pagination.currentPage = page;
            this.pagination.offset = this.pagination.pageSize * (page -1)
            this.$emit("getRecords");
        },
        handlePageSize(number) {
            this.pagination.pageSize = number;
            this.pagination.limit = number;
            this.$emit("getRecords");
        },

        nextClick(page) {
            this.pagination.offset = this.pagination.pageSize * (page -1);
            this.$emit("getRecords");
        },

        prevClick(page) {
            this.pagination.offset = this.pagination.pageSize * (page -1);
            this.$emit("getRecords");
        },
    }
}
</script>

<style scoped>

</style>
