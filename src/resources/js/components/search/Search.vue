<template>
    <div class="search mb-3">
        <el-input @change="adsSearch" v-model="search" size="small" placeholder="Пошук"/>
    </div>
</template>

<script>
export default {
    name: "Search",
    data() {
        return {
            search: null,
        }
    },
    emits: ["search"],
    methods: {
      adsSearch() {
          const search = {
              "title": this.search,
          }

          this.$emit("search", search);
      }
    },
}
</script>

<style scoped>
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
