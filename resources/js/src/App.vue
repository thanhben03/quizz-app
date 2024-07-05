<template>
    <!-- <DefaultLayout /> -->
    <router-view></router-view>
</template>

<script>
import { authenStore } from "./store/authenStore";
import { onMounted } from "vue";
import DestroyAuth from "./utils/DestroyAuth";

export default {
    name: 'App',
    setup() {
        const auth = authenStore();
        // axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
        axios.interceptors.response.use(response => {
            return response;
        }, error => {
            if (error.response.status === 401) {
                DestroyAuth();

            }
            return Promise.reject(error);


        })
        onMounted(async () => {
            console.log('aa');
            if (auth.authenticated) {
                try {
                    const res = await axios.get('/api/auth/user');
                    const user = res.data;
                    auth.onSetUser(user);
                } catch (error) {

                }

            }
        })
    }
}
</script>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

a {
    text-decoration: none !important;
    color: inherit;
}
</style>
