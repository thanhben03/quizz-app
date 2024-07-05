<template>
    <div class="container my-4">
        <h3>Danh Sách Kỳ Thi</h3>
        <div class="row">
            <div class="col">
                <!-- {{ examsData }} -->
                <el-table :data="examsTableData" style="width: 100%">
                    <el-table-column label="Tiêu đề" prop="title" />
                    <el-table-column label="Mô tả" prop="desc" />
                    <el-table-column label="Thời gian(phút)" prop="duration" />
                    <el-table-column label="Số điểm" prop="point" />
                    <el-table-column align="right">
                        <template #header>
                            <el-input v-model="search" size="small" placeholder="Type to search" />
                        </template>
                        <template #default="scope">
                            <el-button size="small" type="primary" @click="joinExam(scope.$index, scope.row)">Tham
                                gia</el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import { computed, ref } from "vue";
import { useRouter } from "vue-router";
import { ElMessageBox, ElMessage } from "element-plus";

export default {
    components: {
    },
    setup() {
        const message = ref('');
        const router = useRouter();
        const search = ref('')
        const examsData = ref([]);
        const examsTableData = computed(() =>
            examsData.value.filter(
                (data) =>
                    !search.value ||
                    data.title.toLowerCase().includes(search.value.toLowerCase())

            )
        )

        const exams = async () => {
            const res = await axios.get('/api/contest/')
            examsData.value = res.data.map(val => {
                return {
                    ...val.exam,
                    contest_id: val.id
                }
            });
        }
        exams();

        const joinExam = (index, row) => {
            if (row.password) {
                ElMessageBox.prompt('Vui lòng xác nhận mật khẩu !', 'Password', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel'
                })
                    .then(({ value }) => {
                        return axios.post('/api/exam/check_pass', {
                            password: value,
                            exam_id: row.id
                        })
                    })
                    .then(res => {
                        // console.log(res);
                        router.push({ name: 'quizz.contest.join', params: { contest_id: row.contest_id } })
                    })
                    .catch((err) => {
                        ElMessage({
                            type: 'warning',
                            message: 'Sai password',
                        })
                    })
                // return;
            }
        }
        return { message, examsTableData, search, joinExam }
    }
}
</script>
