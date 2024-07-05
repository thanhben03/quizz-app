<template>
    <div v-if="student.length > 0" class="container mt-3 ">
        <div class="row">
            <h3>Chỉnh sửa hồ sơ</h3>
        </div>
        <div class="row">
            <div class="col-4">
                <el-input v-model="student[0].fullname" :value="student[0].fullname" placeholder="Please input">
                    <template #prepend>Họ tên: </template>
                </el-input>

            </div>
            <div class="col-4">
                <el-input v-model="student[0].class_name" :value="student[0].class_name" disabled
                    placeholder="Please input">
                    <template #prepend>Lớp: </template>
                </el-input>
            </div>

        </div>
        <div class="row mt-3">
            <div class="col-4">
                <el-input v-model="student[0].email" :value="student[0].email" placeholder="Please input">
                    <template #prepend>Email: </template>
                </el-input>
            </div>
            <div class="col-4">
                <el-input v-model="student[0].username" :value="student[0].username" placeholder="Please input">
                    <template #prepend>Username: </template>
                </el-input>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
                <h3 for="">Avatar</h3><br>
                <img width="100" :src="student[0].avatar" alt="">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <el-button class="mr-2" type="primary" @click="updateStudent" plain>Cập nhật</el-button>
                <router-link :to="{ name: 'admin.student' }">
                    <el-button type="warning">
                        Quay lại
                    </el-button>
                </router-link>
            </div>
        </div>
    </div>
    <!-- {{ student }} -->
</template>

<script>
import { studentStore } from '../../../store/studentStore';
import { computed, onMounted, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import { message } from 'ant-design-vue';

export default {
    setup() {
        const route = useRoute();
        const store = studentStore();
        const student = ref([]);
        watch(() => store.students, (students) => {
            student.value = students
        })
        onMounted(() => {
            if (store.students.length > 0) {
                student.value = store.students.filter(ele => {
                    return ele.id == route.params.student_id
                });
            } else {
                axios.get(`/student/${route.params.student_id}`);
            }
            console.log(student.value);
        })

        const updateStudent = () => {
            axios.put(`/api/teacher/${route.params.student_id}/updateStudent`, {
                ...student.value[0]
            })
                .then(res => {
                    message.success(res.data);
                })
                .catch(err => {
                    message.error(err.response.data)
                })
        }
        return { student, updateStudent }
    }
}
</script>
