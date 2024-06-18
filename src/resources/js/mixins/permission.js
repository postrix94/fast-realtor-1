const permissions = ["save images"];

// объявляем объект примеси
const permissionsMixin = {
    methods: {
        saveImages() {
           if(!this.user || !this.user.permissions) {
               return false;
           }

          return this.user.permissions.some(permission => permissions.includes(permission.name));
        },
    }
}

export {permissionsMixin}
