<template>
    <div class="container content">
        <div class="tabs d-flex justify-content-between">
            <h3>Tài khoản của tôi</h3>

        </div>

        <div class="container row">
            <div v-if="student" class="col-lg-4 border mt-3">
                <img class="p-2" style="width: 200px;" :src="avatar" alt="">
                <div class="list-left p-2">
                    <div class="item">
                        <b>Email: </b>
                        <span>{{ student.email }}</span>
                    </div>
                    <div class="item">
                        <b>Số bài đã giải:</b>
                        <span>{{ student.log_practice_count }}</span>
                    </div>
                    <div class="item">
                        <b>Tổng điểm:</b>
                        <span>{{ student.log_practice_sum_point }}</span>
                    </div>
                    <div class="item">
                        <a class="text-info" href="#">Xem các bài nộp</a>
                    </div>
                </div>

            </div>
            <div class="col-lg-8 mt-3">
                <div>
                    <p class="shadow-sm p-3 mb-3 bg-white rounded border">Bạn chưa cung cấp tiểu sử về bản thân</p>
                </div>
                <div>
                    <el-card class="box-card">
                        <template #header>
                            <div class="card-header">
                                <span>Huy hiệu</span>
                            </div>
                        </template>
                        <div>Người dùng này chưa có huy hiệu nào</div>
                    </el-card>
                </div>
                <div class="mt-2">
                    <el-card class="box-card">
                        <template #header>
                            <div class="card-header">
                                <span>Chức năng</span>
                            </div>
                        </template>
                        <div class="feature-list row">
                            <!-- Thay mật khẩu -->

                            <div class="col-4">
                                <div class="d-flex flex-row align-items-baseline">
                                    <div class="feature-icon mr-2">
                                        <el-icon>
                                            <Postcard />
                                        </el-icon>
                                    </div>
                                    <div class="feature-button">
                                        <el-button @click="modalChangePass = true">
                                            Đổi mật khẩu
                                        </el-button>
                                    </div>

                                    <!-- Modal -->
                                    <el-dialog v-model="modalChangePass" :show-close="false">
                                        <template #header="{ close, titleId, titleClass }">
                                            <div class="my-header">
                                                <h4 :id="titleId" :class="titleClass">Thay đổi mật khẩu</h4>

                                            </div>
                                        </template>
                                        <!-- Content Modal -->
                                        <div class="">
                                            <div class="">
                                                <span>Mật khẩu cũ:</span>
                                                <el-input type="password" v-model="oldPassword" placeholder="Mật khẩu hiện tại">
                                                </el-input>

                                            </div>
                                            <div class="">
                                                <span>Mật khẩu mới:</span>
                                                <el-input type="password" v-model="newPassword" placeholder="Nhập mật khẩu mới">
                                                </el-input>
                                            </div>
                                        </div>
                                        <!-- footer -->

                                        <template #footer>
                                            <span class="dialog-footer">
                                                <el-button @click="modalChangePass = false">Cancel</el-button>
                                                <el-button type="primary" @click="changePass">
                                                    Confirm
                                                </el-button>
                                            </span>
                                        </template>
                                    </el-dialog>
                                </div>

                                <!-- Thay đổi avatar -->
                                <div class="d-flex flex-row align-items-baseline mt-2">
                                    <div class="feature-icon mr-2">
                                        <el-icon>
                                            <Avatar />
                                        </el-icon>
                                    </div>

                                    <div class="feature-button">
                                        <el-button @click="modalChangeAvatar = true">
                                            Đổi avatar
                                        </el-button>
                                    </div>

                                    <!-- Modal -->
                                    <el-dialog v-model="modalChangeAvatar" :show-close="false">
                                        <template #header="{ close, titleId, titleClass }">
                                            <div class="my-header">
                                                <h4 :id="titleId" :class="titleClass">Thay đổi avatar</h4>
                                            </div>
                                        </template>
                                        <!-- Content Modal -->
                                        <div class="">

                                            <div class="my-container">
                                                <div v-if="isLoading" class="loading d-flex">
                                                    <el-alert title="Đang tải lên ảnh của bạn !" type="warning" />
                                                    <img width="30" src="/images/spin.gif" alt="">
                                                </div>

                                                <div class="avatar-upload">
                                                    <div class="avatar-edit">
                                                        <input @change="onFileChange" type='file' id="imageUpload"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <label for="imageUpload"></label>
                                                    </div>
                                                    <div class="avatar-preview">
                                                        <img style="width: 100%;" v-if="url" :src="url" />
                                                        <img style="width: 100%;" v-else :src="avatar" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- footer -->
                                        <template #footer>
                                            <span class="dialog-footer">
                                                <el-button @click="modalChangeAvatar = false">Cancel</el-button>
                                                <el-button @click="changeAvatar" type="primary">
                                                    Confirm
                                                </el-button>
                                            </span>
                                        </template>
                                    </el-dialog>
                                </div>

                                <!-- Thay đổi lớp -->
                                <div class="d-flex flex-row align-items-baseline mt-2">
                                    <div class="feature-icon mr-2">
                                        <el-icon>
                                            <House />
                                        </el-icon>
                                    </div>

                                    <div class="feature-button">
                                        <el-button @click="onChangeClass">
                                            Đổi lớp
                                        </el-button>
                                    </div>

                                    <!-- Modal -->
                                    <el-dialog v-model="modalChangeClass" :show-close="false">
                                        <template #header="{ close, titleId, titleClass }">
                                            <div class="my-header">
                                                <h4 :id="titleId" :class="titleClass">Chọn lớp: </h4>
                                            </div>
                                        </template>
                                        <!-- Content Modal -->
                                        <el-select-v2 v-model="choose" :options="options_class" placeholder="Please select"
                                            size="large" />
                                        <!-- footer -->
                                        <template #footer>
                                            <span class="dialog-footer">
                                                <el-button @click="modalChangeClass = false">Cancel</el-button>
                                                <el-button @click="updateClass" type="primary">
                                                    Confirm
                                                </el-button>
                                            </span>
                                        </template>
                                    </el-dialog>
                                </div>
                            </div>
                            <!-- <div class="col-8">
                                <router-link to="/">
                                    <el-button type="danger" plain>Quản trị</el-button>
                                </router-link>
                            </div> -->

                        </div>

                    </el-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, reactive, ref, toRefs, computed } from 'vue';
import { useRoute } from 'vue-router';
import { ElMessage } from 'element-plus'
import { authenStore } from '../../store/authenStore';


export default {

    setup() {
        const route = useRoute();
        const isLoading = ref(false);
        const auth = authenStore();
        const username = route.params.username;
        const formData = reactive({
            oldPassword: '',
            newPassword: ''
        })
        const classes = reactive({
            choose: '',
            options_class: [
                {
                    value: 1,
                    label: "Lớp 10C1"
                },
                {
                    value: 2,
                    label: "Lớp 10C2"
                },
            ]
        });

        const modalChangePass = ref(false)
        const modalChangeAvatar = ref(false)
        const modalChangeClass = ref(false)
        const err = ref('');
        const url = ref('');
        const fileUpload = ref(null);
        // const student = studentStore();
        const student = ref(null);
        let file = '';

        const avatar = computed(() => auth.user.avatar);

        const changePass = async () => {
            try {
                const res = await axios.post('/api/auth/change-pass', { ...formData });
                ElMessage.success(res.data)
                modalChangePass.value = false;
            } catch (error) {
                ElMessage.error(error.response.data)
            }
        }

        const onFileChange = (e) => {
            file = e.target.files[0];
            url.value = URL.createObjectURL(file);
            // isLoading.value.cla
        }

        const changeAvatar = () => {
            isLoading.value = true;
            axios.post('/api/auth/change-avatar', {
                file
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
                    ElMessage.success(res.data.message);
                    modalChangeAvatar.value = false;
                    auth.user.avatar = res.data.url;
                    // avatar.value = res.data.url;
                    // message.success('Câ')
                })
                .catch(err => {
                    ElMessage.error(res.response.data);
                })
                .finally(() => {
                    isLoading.value = false;
                })
        }

        const onChangeClass = () => {
            modalChangeClass.value = true;
            axios.get('/api/class')
                .then(res => {
                    classes.options_class = res.data.map((ele, index) => {
                        if (ele.id == auth.user.class_id) {
                            classes.choose = ele.id
                        }
                        return {
                            value: ele.id,
                            label: ele.name
                        }
                    })

                })
                .catch(err => {
                })
        }

        const updateClass = () => {
            axios.post('/api/auth/change-class', {
                classId: classes.choose
            })
                .then(res => {
                    modalChangeClass.value = false;
                    ElMessage.success(res.data);
                    auth.user.class_id = classes.choose;
                })
                .catch(err => {
                    ElMessage.error(res.response.data);
                })
        }

        onMounted(() => {
            axios.get('/api/student')
                .then(res => {
                    student.value = res.data;

                })
                .catch(err => {
                })
        })


        return {
            avatar,
            fileUpload, username,
            modalChangePass, modalChangeAvatar, modalChangeClass,
            ...toRefs(formData), changePass, onChangeClass, updateClass,
            changeAvatar, err,
            onFileChange, url,
            ...toRefs(classes),
            student,isLoading
        }

    }
}
</script>
<style scoped>
.info {
    margin-right: 20px;
}

.avatar-upload {
    position: relative;
    max-width: 205px;
    margin: 50px auto;

    .avatar-edit {
        position: absolute;
        z-index: 1;
        bottom: -35px;
        right: -65px;

        input {
            display: none;

            +label {
                display: inline-block;
                width: 34px;
                height: 34px;
                margin-bottom: 0;
                border-radius: 100%;
                background: #FFFFFF;
                border: 1px solid transparent;
                box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
                cursor: pointer;
                font-weight: normal;
                transition: all .2s ease-in-out;

                &:hover {
                    background: #f1f1f1;
                    border-color: #d6d6d6;
                }

                &:after {
                    content: "\f040";
                    font-family: 'FontAwesome';
                    color: #757575;
                    position: absolute;
                    top: 10px;
                    left: 0;
                    right: 0;
                    text-align: center;
                    margin: auto;
                }
            }
        }
    }

    .avatar-preview {
        position: relative;
        border-radius: 50%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);

        >div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    }
}

ul {
    list-style: none;
    margin-top: 10px;
}

li:not(:last-child) {
    margin-right: 4px;
}

span {
    margin: 0 2px;
}

.tabs .tab.active a {
    border-top-color: #2980b9 !important;
}

.col-lg-4 {
    box-shadow: 0 1px 2px 0 rgba(34, 36, 38, .15);
    border: 1px solid rgba(34, 36, 38, .15);
    border-radius: 5px;
}

img {
    border-radius: 60px;
}

.item:not(:last-child) {
    border-bottom: 1px solid #ccc;
}

.table-active {
    background: #F3F4F5;
    padding: 10px;
}

.calendar {
    background: #F3F4F5;

}

ul li a,
a {
    text-decoration: none;
    color: black;
}
</style>
