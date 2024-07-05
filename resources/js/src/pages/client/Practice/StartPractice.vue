<template>
    <div class="container mt-3">
        <div class="row">
            <div class="col-8">
                <h4>{{ exam.title }}</h4>
                <!-- <el-alert :title="`Thời gian làm bài ${exam.duration} phút`" type="warning" show-icon /> -->
                <div v-if="startExam" class="row">
                    <div class="col-8">
                        <div class="wrap-question">
                            <div v-for="question, index in questions" class="question">
                                <div class="header-question">
                                    <span>Câu hỏi: {{ question.question }}</span>
                                    <slot></slot>
                                </div>
                                <!-- <el-input class="mt-2" v-model="question.question" placeholder="Please input"
                            :value="question.question" /> -->
                                <a-radio-group :disabled="mark != null" class="question-option" v-model:value="answers[index].option_id">
                                    <a-radio :class="{
                                        correct: mark != null && question.correct_option == question.option[0].id
                                    }" :value="question.option[0].id">
                                        {{ question.option[0].option_text }}
                                    </a-radio>
                                    <a-radio :class="{
                                        correct: mark != null && question.correct_option == question.option[1].id
                                    }" :value="question.option[1].id">{{ question.option[1].option_text }}</a-radio>
                                    <a-radio :class="{
                                        correct: mark != null && question.correct_option == question.option[2].id
                                    }" :value="question.option[2].id">{{ question.option[2].option_text }}</a-radio>
                                    <a-radio :class="{
                                        correct: mark != null && question.correct_option == question.option[3].id
                                    }" :value="question.option[3].id">{{ question.option[3].option_text }}</a-radio>
                                </a-radio-group>
                            </div>

                        </div>
                        <el-button v-if="!mark" @click="submitExam" class="mt-3" type="primary">
                            Nộp bài
                        </el-button>

                    </div>
                </div>
            </div>
            <div v-if="startExam" class="col-4">
                <div>
                    <h3>Thời gian</h3>
                    <p>Bài làm này không có thời gian</p>
                </div>
                <div v-if="mark" class="wrap-mark">
                    <div class="mark-header">
                        Điểm của bạn
                    </div>
                    <div class="mark-body">
                        {{ mark }} điểm
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-8">
                <el-button v-if="!startExam" @click="confirmStartExam" type="primary">
                    Bắt đầu kiểm tra
                    <el-icon class="ml-1">
                        <AlarmClock />
                    </el-icon>
                </el-button>
                <router-link v-if="mark" class="ml-2" :to="{ name: 'quizz.index' }">
                    <el-button type="warning">
                        Quay lại
                    </el-button>
                </router-link>


            </div>
        </div>

    </div>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import confirmBox from "../../../utils/MessageBox";
export default {
    setup() {
        const exam = ref({});
        const questions = ref([]);
        const route = useRoute();
        const answers = ref([]);
        const initialAnswer = ref([]);
        const timer = ref(null);
        const startExam = ref(false);
        const result = ref([]);
        const mark = ref(null);
        let practice_id = route.params.practice_id;
        onMounted(() => {
            axios.get('/api/exam/join/' + practice_id)
                .then(res => {
                    exam.value = res.data.exam;
                    questions.value = res.data.questions;
                    answers.value = questions.value.map(val => {
                        return {
                            question_id: val.question_id,
                            option_id: ''
                        }
                    })
                    calculatorTimeExam(res.data.end_time);

                })
                .catch(err => {
                })
        })
        const submitExam = () => {
            if (mark.value != null) {
                return;
            }

            confirmBox('Bạn có chắc chắn muốn nộp bài ?', 'Warning')
                .then(() => {
                    return axios.post('/api/exam/getMark', {
                        answers: answers.value,
                        type_id: practice_id,
                        type_log: 'log_practice'
                    })
                })
                .then(res => {
                    mark.value = res.data.total

                })
                .catch(err => {
                })
        }

        const reExam = () => {
            mark.value = null;
            result.value = [];
            answers.value = initialAnswer.value;
        }

        const endTime = () => {
            axios.post('/api/exam/getMark', {
                answers: answers.value,
                type_id: practice_id,
                type_log: 'log_practice'
            })
                .then(res => {
                    mark.value = res.data.total;
                    timer.value = 0;
                })

        }

        const calculatorTimeExam = (end_time) => {
            let currentTime = new Date();
            let endDate = new Date(end_time);
            // Tính hiệu thời gian giữa hai thời điểm
            let timeDiff = endDate.getTime() - currentTime.getTime();
            // Lấy tổng thời gian trong mili giây
            timer.value = timeDiff;
        }
        const confirmStartExam = () => {
            confirmBox('Đây là phần luyện tập sẽ không tính giờ !', 'Warning')
                .then(() => {
                    startExam.value = true;
                })
                .catch(function () {
                    console.log('not err');
                })
        }

        return { endTime, timer, exam, questions, answers, submitExam, result, mark, reExam, startExam, confirmStartExam }
    }
}
</script>

<style scoped>
.question-option {
    display: flex;
    flex-direction: column;
}

.question-option label {
    font-size: 16px;
    color: black;
}

.correct {
    background-color: green;
    background-color: #29ff29;
    padding: 3px;
    border-radius: 6px;
}

.wrap-mark {
    height: 82px;
    background-color: white;
    border: 1px solid #e2e2e2;
    border-radius: 6px;
    margin-top: 20px;
    width: 50%;
}

.mark-header {
    height: 30px;
    background-color: #01bd33;
    border-radius: 6px 6px 0 0;
    text-align: center;
    padding: 2px 0px;
    color: whitesmoke;
}

.mark-body {
    display: flex;
    height: 100%;
    justify-content: center;
    margin-top: 9px;
}
</style>
