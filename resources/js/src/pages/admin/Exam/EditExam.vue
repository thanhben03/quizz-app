<template>
    <div class="container mt-3">
        <h3>Chỉnh sửa: {{ examData.title }}</h3>
        <el-input v-model="examData.title" :value="examData.title">
            <template #prepend>Tiêu đề:</template>
        </el-input>
        <div class="row mt-2">
            <div class="col-8">
                <el-input v-model="examData.desc" :value="examData.desc" :rows="2" type="textarea" placeholder="Mô tả">
                </el-input>
            </div>
            <div class="col-4">
                <el-input v-model="examData.point" :value="examData.point">
                    <template #prepend>Điểm:</template>
                </el-input>

            </div>
        </div>
        <div class="row mt-2 d-flex align-items-center">
            <div class="col-4">
                <el-input v-model="examData.password" placeholder="Có thể bỏ trống">
                    <template #prepend>Password:</template>
                </el-input>
            </div>
            <div class="col-4">
                <el-input v-model="examData.duration" :value="examData.duration" placeholder="Đơn vị tính = phút">
                    <template #prepend>Time:</template>
                </el-input>

            </div>

            <div class="col-4">
                <el-select v-model="examData.status" class="m-2" placeholder="Select">
                    <el-option v-for="item in statusOptions" :key="item.value" :label="item.label" :value="item.value" />
                </el-select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <el-input type="datetime-local" v-model="examData.start_time">
                    <template #prepend>Start:</template>
                </el-input>
            </div>
            <div class="col-6">
                <el-input type="datetime-local" v-model="examData.end_time">
                    <template #prepend>End:</template>
                </el-input>
            </div>
        </div>
        <div class="row mt-2">
            <span>Chế độ:</span>
            <div class="col-6">
                <el-select v-model="examData.type" placeholder="Select">
                    <el-option v-for="item in [
                        { value: 'contests', label: 'Kỳ thi' },
                        { value: 'practices', label: 'Luyện tập' },

                    ]" :key="item.value" :label="item.label" :value="item.value" />
                </el-select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <QuestionComponent :question="question" v-if="questions.length > 0" v-for="question, index in questions">
                    <!-- <el-button @click="deleteQuestion(index)" type="danger" size="small" :icon="Delete" circle /> -->
                </QuestionComponent>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <el-button @click="updateExamAndQuestion" type="primary">Cập nhật</el-button>

            </div>
        </div>

        <!-- {{ questions }} -->
    </div>
</template>

<script>
import { message } from 'ant-design-vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import QuestionComponent from '../../../components/Exam/QuestionComponent.vue';

export default {
    components: {
        QuestionComponent
    },
    setup() {
        const route = useRoute();
        const exam_id = route.params.exam_id;
        const examData = ref('');
        const status = ref(1); // status of exam
        const questions = ref([]);
        const statusOptions = [
            {
                value: 0,
                label: 'Disable',
            },
            {
                value: 1,
                label: 'Enable',
            },
        ]
        onMounted(async () => {
            const res = await axios.get(`/api/exam/${exam_id}/edit`);
            examData.value = res.data.exam;
            questions.value = res.data.questions
        })

        const updateExamAndQuestion = () => {
            axios.post('/api/exam/updateExamAndQuestions', {
                exam: examData.value,
                questions: questions.value
            })
                .then(res => {
                    message.success(res.data);
                })
                .catch(err => {
                    message.error(res.response.data);

                })
        }
        return { exam_id, examData, status, statusOptions, questions, updateExamAndQuestion }
    }
}
</script>
