<template>
    <div class="menu-wrapper">
        <el-menu
            class="el-menu-demo"
            mode="horizontal"
            :ellipsis="false"
            @select="handleSelect"
            background-color="#545c64"
            text-color="#fff"
            active-text-color="#ffd04b"
        >
            <el-menu-item index="0">
                <a :href="this.menu.home" class="d-flex">
                    <img
                        style="width: 40px"
                        src="../../../images/logo/logo.webp"
                        alt="Element logo"
                    />
                </a>
            </el-menu-item>
            <el-menu-item index="1">
                <a :href="this.menu.my_ads">Мої оголошення</a>
            </el-menu-item>
            <el-sub-menu index="2">
                <template #title>Налаштування</template>
                <el-menu-item index="2-1">item one</el-menu-item>
                <el-menu-item index="2-2">item two</el-menu-item>
                <el-menu-item index="2-3" class="d-flex justify-content-center">
                    <el-button @click="logout" type="danger" size="small" plain>Вийти</el-button>
                </el-menu-item>

            </el-sub-menu>
        </el-menu>
    </div>
</template>

<script>


export default {
    name: "Menu",
    data() {
        return {
            menu: {},
        }
    },

    beforeMount() {
        axios.post("/menu")
            .then(res => this.menu = res.data.menu)
    },

    methods: {
        handleSelect(key, keyPath) {
        },

        logout() {
            axios.post(this.menu.logout)
                .then(this.successLogout);
        },

        successLogout(response) {
            window.location.href = response.data.redirect
        }

    }
}
</script>

<style scoped>
.menu-wrapper {
    position: fixed;
    left: 0;
    right: 0;
    z-index: 999;
}

.el-menu--horizontal > .el-menu-item:nth-child(1) {
    margin-right: auto;
}
</style>
