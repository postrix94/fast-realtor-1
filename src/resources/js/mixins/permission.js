const permissions = ["save images"];

// объявляем объект примеси
const permissionsMixin = {
    methods: {
        saveImages() {
            if (!this.user) return false;
            return this.user.permissions.some(permission => permissions.includes(permission));
        },
    }
}

export {permissionsMixin}
