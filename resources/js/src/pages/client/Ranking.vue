<template>
    <div class="container">
        <div class="row mt-3">
            <h2>Bảng xếp hạng cá nhân</h2>
        </div>
        <div class="row">
            <div class="col table-operations text-end">
                <a-button :class="{ active: chooseFilter == 'filter_day' }" @click="change_filter('filter_day')">Theo
                    Ngày</a-button>
                <a-button :class="{ active: chooseFilter == 'filter_month' }" @click="change_filter('filter_month')">Theo
                    Tháng</a-button>
                <a-button :class="{ active: chooseFilter == 'filter_year' }" @click="change_filter('filter_year')">Theo
                    Năm</a-button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a-table :columns="columns" :data-source="data">
                    <template #bodyCell="{ column, text }">
                        <template v-if="column.dataIndex === 'avatar'">
                            <img class="avatar" :src="text" alt="">
                        </template>
                    </template>
                </a-table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';

export default {
    setup() {
        const data = ref(null);
        const chooseFilter = ref('filter_year');
        const columns = [
            {
                title: 'Hạng',
                dataIndex: 'key',
                key: 'key',
                width: 1
            },
            {
                title: 'Avatar',
                dataIndex: 'avatar',
                key: 'avatar',
                width: 1
            },
            {
                title: 'Họ tên',
                dataIndex: 'fullname',
                key: 'fullname',
            },
            {
                title: 'Điểm',
                dataIndex: 'point',
                key: 'point',
            },
            {
                title: 'Lớp',
                dataIndex: 'class_name',
                key: 'class',
            },
        ]


        onMounted(() => {
            rank(chooseFilter.value);
        })
        const rank = (filter_type) => {
            if (filter_type) {
                chooseFilter.value = filter_type
            }
            axios.get('/api/user/rank/' + chooseFilter.value)
                .then(res => {
                    data.value = res.data.map((val, index) => {
                        return {
                            key: index + 1,
                            fullname: val.fullname,
                            avatar: val.avatar,
                            point: val.point,
                            class_name: val.class_name
                        }
                    })

                    // dataSort.value = data.value.sort((firstItem, secondItem) => secondItem.point - firstItem.point);

                })
                .catch(err => {
                })
        }

        const change_filter = (filter_type) => {
            chooseFilter.value = filter_type;
            rank(filter_type)

        }

        return { columns, data, change_filter, chooseFilter }

    }
}
</script>
<style scoped>
.table-operations {
    margin-bottom: 16px;
}

.table-operations>button {
    margin-right: 1px;
}

.avatar {
    width: 30px;
}

.active {
    background-color: #277eff;
    color: white;
}</style>
