<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col d-flex">
                <h3>Quản lý đề thi</h3>
                <router-link :to="{ name: 'admin.exam.create' }">
                <el-button class="ml-2" type="success">
                    <el-icon>
                        <Plus />
                    </el-icon>
                        Tạo mới
                    </el-button>
                </router-link>


            </div>
        </div>
        <div class="row">
            <div class="col">
                <!-- {{ examsData }} -->
                <el-table :data="examsTableData" style="width: 100%">

                    <el-table-column label="Tiêu đề" prop="title" />
                    <el-table-column label="Mô tả" prop="desc" />
                    <el-table-column label="Thời gian" prop="duration" />
                    <el-table-column label="Số điểm" prop="point" />
                    <el-table-column align="right">
                        <template #header>
                            <el-input v-model="search" size="small" placeholder="Type to search" />
                        </template>
                        <template #default="scope">
                            <el-button size="small" @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
                            <el-button size="small" type="danger"
                                @click="handleDeleteExam(scope.$index, scope.row)">Delete</el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
        </div>
    </div>
</template>


<script>
import axios from 'axios';
import { ElMessage } from 'element-plus';
import { computed, ref } from 'vue'
import { useRouter } from 'vue-router';
import confirmBox from '../../../utils/MessageBox';

export default {
    setup() {
        const router = useRouter();
        const search = ref('');
        const examsData = ref([]);
        const examsTableData = computed(() =>
            examsData.value.filter(
                (data) =>
                    !search.value ||
                    data.title.toLowerCase().includes(search.value.toLowerCase())
            )
        )

        const exams = async () => {
            const res = await axios.get('/api/exam/')
            // examsData.value = res.data.map(val => {
            //     return val.exam
            // });
            examsData.value = res.data
        }

        const handleEdit = (index, row) => {
            router.push({ name: 'admin.exam.edit', params: { exam_id: row.id } })
        }

        const handleDeleteExam = async (index, row) => {
            confirmBox('Bạn có chắc chắn muốn xóa !', 'Warning')
            .then(() => {
                return axios.delete(`/api/exam/${row.id}`);

                // resolve('call api success'); // Giải quyết Promise thành công
            })
            .then(res => {
                    examsData.value.splice(index,1);
                })
                .catch(() => {
                    ElMessage({
                        type: 'info',
                        message: 'Delete canceled',
                    });
                    // reject('call api error'); // Từ chối Promise
                });

        }
        exams();

        return {
            search, examsTableData, examsData,
            handleEdit, handleDeleteExam
        }
    }
}
</script>
