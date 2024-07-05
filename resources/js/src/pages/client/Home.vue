<template>
    <div class="container my-4">
        <h3>Danh Sách Các Bài</h3>
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
                            <el-button size="small" type="primary" @click="joinPractice(scope.$index, scope.row)">Tham
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
import { authenStore } from "../../store/authenStore";


export default {
    components: {
    },
    setup() {
        const message = ref('');
        const auth = authenStore();
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
            const res = await axios.get('/api/exam/practice/')
            console.log(res);
            examsData.value = res.data.map(val => {
                return {
                    ...val.exam,
                    practice_id: val.id
                }
            });
        }
        exams();

        const joinPractice = (index, row) => {
            router.push({name: 'quizz.practice.join', params: {practice_id: row.practice_id}})
        }
        return { message, auth, examsTableData, search, joinPractice }
    }
}
</script>
<style scoped>
@import url('https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css');
</style>
