

<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col d-flex">
                <h3>Quản lý học sinh</h3>
                <!-- <el-button class="ml-2" type="success">
                    <el-icon>
                        <Plus />
                    </el-icon>
                    <router-link style="color: white;" :to="{ name: 'admin.student.create' }">
                        Tạo mới
                    </router-link>
                </el-button> -->
            </div>
        </div>
        <div class="row">
            <div class="col">
                <!-- {{ examsData }} -->
                <el-table v-if="studentsTableData" :data="studentsTableData" style="width: 100%">

                    <el-table-column label="Họ tên" prop="fullname" />
                    <el-table-column label="Username" prop="username" />
                    <el-table-column label="Email" prop="email" />
                    <el-table-column label="Lớp" prop="class_name" />
                    <el-table-column align="right">
                        <template #header>
                            <el-input v-model="search" size="small" placeholder="Type to search" />
                        </template>
                        <template #default="scope">
                            <el-button size="small" @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
                            <el-button size="small" type="danger"
                                @click="handleDeleteStudent(scope.$index, scope.row)">Delete</el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <router-link :to="{ name: 'quizz.index' }">
                        <el-button type="warning">
                            Quay lại
                        </el-button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import { studentStore } from "../../../store/studentStore";
import confirmBox from '../../../utils/MessageBox';

export default {
    setup() {
        const search = ref('');
        const studentsData = ref([]);
        const store = studentStore();
        const router = useRouter();
        const componentKey = ref(1);

        const studentsTableData = computed(() =>
            studentsData.value.filter(
                (data) =>
                    !search.value ||
                    data.username.toLowerCase().includes(search.value.toLowerCase())
            )
        )
        onMounted(() => {
            axios.get('/api/teacher/getStudentsOfTeacher')
                .then(res => {
                    store.onSetStudent(res.data);
                    studentsData.value = res.data;
                })
                .catch(err => {
                })

        })


        const handleDeleteStudent = async (index, row) => {
            confirmBox('Bạn có chắc chắn muốn xóa !', 'Warning')
                .then(() => {
                    return axios.delete('/api/student/' + row.id)
                })
                .then(res => {
                    store.students.splice(index, 1);

                })
                .catch(err => {
                })
        }
        const handleEdit = (index, row) => {
            router.push({ name: 'admin.student.edit', params: { student_id: row.id } })
        }

        return { studentsTableData, search, handleEdit, handleDeleteStudent, componentKey }
    }
}
</script>
