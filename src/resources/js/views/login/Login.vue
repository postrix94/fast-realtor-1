<template>
    <div class="col-10 col-md-6 col-lg-4 col-xl-3">
        <h5 class="text-center mb-4">Вхід</h5>
        <form action="" method="POST">

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">+380</span>
                <input type="text" class="form-control" placeholder="введіть номер" aria-label="phone"
                       aria-describedby="phone"
                       :value="phone"
                       @input="changePhone($event)"
                >
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Пароль" aria-label="password"
                       aria-describedby="password"
                       :value="password"
                       ref="inputPassword"
                >
            </div>

            <DefaultButton @click.prevent="onClickBtn" text="Увійти"/>

        </form>
    </div>
</template>

<script>
import DefaultButton from "../../components/buttons/DefaultButton.vue";
import iziToast from "izitoast";

export default {
    name: "Login",
    components: {DefaultButton,},
    props: {
        url: {
            type: String,
            default: "",
        }
    },
    mounted() {
        iziToast.settings({
            position: "topCenter",
        });
    },
    data() {
        return {
            phone: "",
            password: "",
            length_phone_number: 9,
            min_length_password: 5,
        }
    },

    watch: {
        phone() {
            this.checkLengthPhone();
        }
    },

    methods: {
        changePhone(event) {
            this.phone = event.target.value.trim();
        },

        checkLengthPhone() {
            if (this.phone.trim().length > this.length_phone_number) {
                this.phone = this.phone.slice(0, this.length_phone_number).trim();
            }
        },

        validatePhone() {
            const regex = new RegExp("^\\d{9}$");
            return regex.test(this.phone);
        },

        isValidPassword() {
            this.password = this.$refs.inputPassword.value.trim();
            return !(this.password.length < this.min_length_password);
        },

        onClickBtn() {
            if (!this.validatePhone()) {
                this.$errorNotify("Номер введено невірно");
                return;
            }

            if (!this.isValidPassword()) {
                this.$errorNotify("Мінімальна довжина паролю 5 символів");
                return;
            }

            const data = {"phone": this.phone, "password": this.password};

            axios.post(this.url, data)
                .then(this.successResponse)
                .catch(this.errorResponse);
        },

        successResponse(response) {
            if(response.data.message === 'success') {
                window.location = response.data.url;
            }
        },
        errorResponse(error) {
            this.$errorNotify(error.response.data.message);
        },
    }


}
</script>

<style scoped>

</style>
