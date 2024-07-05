<template>
    <div class="container p-3 ">
        <h2 class="text-center pb-4">Đăng Nhập</h2>
        <div class="d-flex justify-content-center">
            <form id="loginForm" class="w-25" method="post" @submit.prevent="login">
                <div class="form-group mb-2">
                    <label class="font-weight-bold" for="email">Email: </label>
                    <input v-model="email" type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group mb-2">
                    <label class="font-weight-bold" for="password">Nhập Mật khẩu: </label>
                    <input v-model="password" type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                <br>
                <a class="text-decoration-none pt-2" href="#">
                    <span>Quên Mật Khẩu?</span>
                </a>
            </form>

        </div>
    </div>
</template>


<script>
import { reactive, toRefs } from "vue";
import { useRouter } from "vue-router";
import { authenStore } from "../../store/authenStore";
import { message } from "ant-design-vue";
export default {
    setup() {
        const data = reactive({
            email: '',
            password: ''
        })
        const router = useRouter();
        const auth = authenStore();
        const login = async () => {
            try {
                const res = await axios.post('/api/auth/login', {
                    ...data
                }, {
                    headers: { 'Content-Type': 'application/json' },
                    withCredentials: true
                })
                window.localStorage.setItem('user', JSON.stringify(res.data.user));
                // window.localStorage.setItem('user', );
                auth.onSetAuthenticated(true);
                auth.onSetUser(res.data.user);
                router.push({ name: "quizz.index" })
            } catch (error) {
                message.error('Sai tên tài khoản hoặc mật khẩu !')
            }

        }
        return { ...toRefs(data), login }
    }
}
</script>
