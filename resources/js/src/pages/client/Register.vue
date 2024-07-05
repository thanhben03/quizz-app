<template>
    <div class="container p-3">
        <h2 class="text-center">Đăng ký</h2>
        <div class="d-flex justify-content-center">
            <form @submit.prevent="register" id="registerForm" class="w-50" method="post" action>
                <div class="form-group mb-2">
                    <label class="font-weight-bold" for="fullname">Họ và tên:</label>
                    <input type="text" v-model="fullname" class="form-control" id="fullname" name="fullname">
                </div>
                <div class="form-group mb-2">
                    <label class="font-weight-bold" for="username">Tên đăng nhập:</label>
                    <input type="text" v-model="username" class="form-control" id="username" name="username">
                </div>
                <div class="form-group mb-2">
                    <label class="font-weight-bold" for="email">Email:</label>
                    <input type="email" v-model="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group mb-2">
                    <label class="font-weight-bold" for="password">Mật khẩu:</label>
                    <input type="password" v-model="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group mb-2">
                    <label class="font-weight-bold" for="confirmPassword">Xác nhận mật khẩu:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                </div>
                <div class="form-group mb-2">
                    <label class="font-weight-bold" for="organization">Tổ chức đại diện:</label>
                    <input type="text" class="form-control" id="organization" name="organization">
                </div>
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { reactive, toRefs } from 'vue';
import { message } from "ant-design-vue";
import { useRouter } from 'vue-router';

export default {
    setup() {
        const formData = reactive({
            fullname: '',
            username: '',
            email: '',
            password: '',
        })
        const router = useRouter();
        const register = async () => {
            try {
                const res = await axios.post('/api/auth/register', {
                    ...formData
                })
                message.success('Đăng ký thành công !')
                router.push({name: 'quizz.auth.login'});
            } catch (error) {
                message.error('Đăng ký thất bại !')
            }
        }

        return { ...toRefs(formData), register }
    }

}
</script>

<style>
.error {
    border: 1px solid red;
}

.error-message {
    color: red;
    margin-top: 5px;
}

.success {
    border: 1px solid green;
}
</style>
