<template>
    <div v-if="type == 'create'">
        <div class="header-question">
            <span>Câu hỏi: </span>
            <slot></slot>
        </div>
        <el-input class="mt-2" v-model="question.question" placeholder="Please input" :value="question.question" />
        <!-- <input type="text" :value="question.question"> -->

        <span>Câu trả lời: </span>
        <el-input class="mt-2" placeholder="Please input" v-model="question.option[0]" :value="question.option[0]" />
        <el-input class="mt-2" placeholder="Please input" v-model="question.option[1]" :value="question.option[1]" />
        <el-input class="mt-2" placeholder="Please input" v-model="question.option[2]" :value="question.option[2]" />
        <el-input class="mt-2" placeholder="Please input" v-model="question.option[3]" :value="question.option[3]" />
    </div>
    <div v-else>
        <div class="header-question">
            <span>Câu hỏi: </span>
            <slot></slot>
        </div>
        <el-input class="mt-2" v-model="question.question" placeholder="Please input" :value="question.question" />
        <!-- <input type="text" :value="question.question"> -->

        <span>Câu trả lời: </span>
        <el-input class="mt-2" placeholder="Please input" v-model="question.option[0].option_text"
            :value="question.option[0].option_text" />
        <el-input class="mt-2" placeholder="Please input" v-model="question.option[1].option_text"
            :value="question.option[1].option_text" />
        <el-input class="mt-2" placeholder="Please input" v-model="question.option[2].option_text"
            :value="question.option[2].option_text" />
        <el-input class="mt-2" placeholder="Please input" v-model="question.option[3].option_text"
            :value="question.option[3].option_text" />
        <div>Đáp án đúng: </div>
        <el-select v-model="question.correct_option" class="mt-2" placeholder="Đáp án đúng" size="large">
            <el-option v-for="item in question.option" :key="item.value" :label="item.option_text" :value="item.id" />
        </el-select>
    </div>
    <hr>
</template>

<script>

export default {
    props: ['question', 'type'],
    setup(props) {
    }
}
</script>
<style scoped>
.header-question {
    display: flex;
    align-items: center;
    margin: 6px 0;
}
</style>
