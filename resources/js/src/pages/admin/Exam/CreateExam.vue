<template>
    <div class="container">
        <h3>Tạo mới đề thi</h3>
        <div class="row">
            <div class="col">
                <span>Upload</span>
                <el-upload ref="file" class="upload-demo"
                    action="https://run.mocky.io/v3/9d059bf9-4660-45f2-925d-ce80ad6c4d15" :limit="1"
                    :on-exceed="handleExceed" :on-change="handleChange" :auto-upload="false">
                    <template #trigger>
                        <el-button type="primary">Chọn file</el-button>
                    </template>
                    <template #tip>
                        <div class="el-upload__tip text-red">
                            Giới hạn 1 file/lần
                        </div>
                    </template>
                </el-upload>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col">
                    <el-button class="ml-3" type="success" @click="scanExam">
                        Scan đề thi
                    </el-button>
                    <el-button class="ml-3" type="danger" @click="createExam">
                        Tạo đề
                    </el-button>
                    <el-button class="ml-3" type="danger" @click="modalCreateQuestion = true">
                        Tạo câu hỏi
                    </el-button>
                </div>
            </div>
        </div>
        <el-input v-model="title" :value="title" placeholder="VD: Kiểm tra 1t 2022-2023">
            <template #prepend>Tiêu đề:</template>
        </el-input>
        <div class="row mt-2">
            <div class="col-8">
                <el-input v-model="desc" :rows="2" type="textarea" placeholder="Mô tả">
                </el-input>
            </div>
            <div class="col-4">
                <el-input disabled placeholder="= Số câu hỏi" v-model="point" :value="point">
                    <template #prepend>Điểm:</template>
                </el-input>

            </div>
        </div>
        <div class="row mt-2 d-flex align-items-center">
            <div class="col-4">
                <el-input v-model="password" placeholder="Có thể bỏ trống">
                    <template #prepend>Password:</template>
                </el-input>
            </div>
            <div class="col-4">
                <el-input v-model="duration" :value="duration" placeholder="Đơn vị tính = phút">
                    <template #prepend>Time:</template>
                </el-input>

            </div>
            <div class="col-4">
                <el-select v-model="status" class="m-2" placeholder="Select">

                    <el-option v-for="item in statusOptions" :key="item.value" :label="item.label" :value="item.value" />
                </el-select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <router-link :to="{ name: 'admin.exam' }">
                    <el-button class="ml-3" type="warning">
                        Quay lại
                    </el-button>
                </router-link>
            </div>
        </div>

        <!-- Modal create question -->
        <el-dialog v-model="modalCreateQuestion" :show-close="false">
            <template #header="{ close, titleId, titleClass }">
                <div class="my-header">
                    <h4 class="">Tạo câu hỏi</h4>
                </div>
            </template>
            <!-- Content Modal -->
            <div class="row">
                <div class="col">
                    <el-input v-model="question" placeholder="Câu hỏi" />

                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <el-input v-model="option[0]" placeholder="Đáp án A" />

                </div>
                <div class="col-6">
                    <el-input v-model="option[1]" placeholder="Đáp án B" />

                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <el-input v-model="option[2]" placeholder="Đáp án C" />

                </div>
                <div class="col-6">
                    <el-input v-model="option[3]" placeholder="Đáp án D" />

                </div>
            </div>
            <div class="row">
                <div class="col">
                </div>
            </div>
            <!-- footer -->
            <template #footer>
                <span class="dialog-footer">
                    <el-button @click="modalCreateQuestion = false">Cancel</el-button>
                    <el-button @click="createQuestion" type="primary">
                        Confirm
                    </el-button>
                </span>
            </template>
        </el-dialog>
        <QuestionComponent :question="question" type="create" v-if="questions.length > 0"
            v-for="question, index in questions">
            <el-button @click="deleteQuestion(index)" type="danger" size="small" :icon="Delete" circle />
        </QuestionComponent>

    </div>
</template>

<script>
import axios from 'axios';
import { ElMessage } from 'element-plus';
import { ref, onMounted, reactive, toRefs } from 'vue'
import QuestionComponent from "../../../components/Exam/QuestionComponent.vue";
import {
    Delete,

} from '@element-plus/icons-vue'
import { message } from 'ant-design-vue';
export default {
    components: {
        QuestionComponent
    },
    setup() {
        let file = ''; // file anh de thi
        const questions = ref([]);
        const modalCreateQuestion = ref(false);
        const newQuestion = reactive({
            question: '',
            option: []
        })

        // mat khau de thi
        const password = ref('');
        // tong thoi gian thi
        const duration = ref('');
        // tieu de de thi
        const title = ref('');
        // mo ta de thi
        const desc = ref('');
        // diem cua de thi
        const point = ref('');
        // trang thai de thi
        const status = ref(1);
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

        const handleExceed = (files, uploadFiles) => {
            ElMessage.warning(
                `The limit is 3, you selected ${files.length} files this time, add up to ${files.length + uploadFiles.length
                } totally`
            )
        }

        const beforeRemove = (uploadFile, uploadFiles) => {
            return ElMessageBox.confirm(
                `Cancel the transfer of ${uploadFile.name} ?`
            ).then(
                () => true,
                () => false
            )
        }

        const handleChange = (uploadFile, uploadFiles) => {
            file = uploadFile;
            ElMessage.success('Chọn file thành công !');
        }

        const scanExam = () => {
            axios.post('/api/exam/scanQuestion', {
                uploadFile: file
            }, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(res => {
                    questions.value = res.data;
                    point.value = questions.value.length
                })
                .catch(err => {
                })
        }
        const deleteQuestion = (index) => {
            questions.value.splice(index, 1);
        }

        const createExam = () => {
            axios.post('/api/exam/create', {
                title: title.value,
                desc: desc.value,
                duration: duration.value,
                password: password.value,
                status: status.value,
                point: point.value,
                questions: questions.value
            })
                .then(res => {
                    message.success('Tạo đề thi thành công !')
                })
                .catch(err => {
                    message.error('Đã xảy ra lỗi !')

                })
        }

        const createQuestion = () => {
            questions.value.push(newQuestion);
            modalCreateQuestion.value = false;
        }

        return {
            questions,
            scanExam,
            beforeRemove,
            handleExceed,
            handleChange,
            deleteQuestion,
            Delete,
            status,
            statusOptions,
            desc, duration,
            point, password, title,
            createExam,
            modalCreateQuestion,
            createQuestion,
            ...toRefs(newQuestion)
        }
    }
}
</script>
