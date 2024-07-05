<template>
    <header class="p-2 bg-dark text-white">
        <div class="container-fluid">
            <div class="d-flex flex-wrap align-items-center justify-content-around">
                <router-link :to="{ name: 'quizz.index' }"
                    class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <img width="100" height="50" src="https://dmoj.ctu.edu.vn/static/icons/logo.svg" alt>
                </router-link>

                <ul class="nav col-12 col-lg-auto me-lg-auto mx-5 justify-content-center mb-md-0">
                    <li><router-link :to="{name: 'quizz.index'}" class="nav-link px-2 text-secondary">Luyện tập</router-link></li>
                    <li><router-link :to="{name: 'quizz.rank'}" class="nav-link px-2 text-white">Bảng xếp hạng</router-link></li>
                    <li><router-link :to="{name: 'quizz.contest.index'}" class="nav-link px-2 text-white">Các Kỳ
                            Thi</router-link></li>
                    <li>
                        <el-dropdown class="mt-1" v-if="user.role">
                            <el-button type="primary">
                                Công cụ<el-icon class="el-icon--right"><arrow-down /></el-icon>
                            </el-button>
                            <template #dropdown>
                                <el-dropdown-menu>
                                    <el-dropdown-item><router-link :to="{name: 'admin.exam'}">Quản lý đề thi</router-link></el-dropdown-item>
                                    <el-dropdown-item><router-link :to="{name: 'admin.student'}">Quản lý học sinh</router-link></el-dropdown-item>
                                </el-dropdown-menu>
                            </template>
                        </el-dropdown>
                    </li>
                </ul>

                <span id="user-links">
                    <a href="#" style="margin-right: 5px; padding-top: 10px;">
                        <i class="fa fa-exclamation-triangle" style="color: yellow;"></i>
                    </a>
                    <a id="flag_vi" href="#" onclick="submmit_language('vi')" style="margin-right: 5px; margin-top: 4px;">
                        <img src="https://cdn-icons-png.flaticon.com/128/555/555515.png" alt="VI" height="24">
                    </a>
                    <a id="flag_en" href="#" onclick="submmit_language('en')" style="margin-right: 5px; margin-top: 4px;">
                        <img src="https://cdn-icons-png.flaticon.com/128/555/555417.png" alt="EN" height="24">
                    </a>
                    <span class="anon" v-if="!auth">
                        <router-link :to="{ name: 'quizz.auth.login' }" class="text-decoration-none text-white">
                            <b>Đăng nhập</b>
                        </router-link>
                        &nbsp;hoặc&nbsp;
                        <router-link :to="{ name: 'quizz.auth.register' }" class="text-decoration-none text-white"><b>Đăng
                                ký</b></router-link>
                    </span>
                    <span class="anon" v-else>
                        <span v-if="user && user.fullname" class="mr-2">Xin chào,
                            <router-link :to="{ name: 'quizz.user.view', params: { username: user.username } }">{{
                                user.fullname
                            }}</router-link>
                        </span>

                        <router-link @click="logout" :to="{ name: 'quizz.auth.login' }"
                            class="text-decoration-none text-white">
                            <b>Đăng xuất</b>
                        </router-link>

                    </span>
                </span>
            </div>
        </div>
        <!-- {{ auth }} -->
    </header>
</template>

<script>
import { authenStore } from "../store/authenStore";
import { computed } from "vue";
import DestroyAuth from "../utils/DestroyAuth";
import { message } from "ant-design-vue";
export default {
    setup() {
        const store = authenStore();
        const auth = computed(() => store.authenticated)
        const user = computed(() => store.user)

        const logout = async () => {
            await axios.get('/api/auth/logout')
                .then(res => {
                    message.success('Đăng xuất thành công !');
                    DestroyAuth();
                })
        }
        return { auth, logout, user }
    }
}
</script>
