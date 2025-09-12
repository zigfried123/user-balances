<script setup>
import {ref, onMounted, watch} from 'vue'
import {useUserStore} from '@/stores/user'
import {useRoute, useRouter} from 'vue-router'
import axios from "axios";

const store = useUserStore();
const route = useRoute();
const router = useRouter();

const history = ref([]);
const filterHistory = ref([]);
const type = ref(null);

let orderByAsc = true;


onMounted(async () => {
    if (!store.token) {
        router.push('/login');
    }

    try {
        const response = await axios.get(`${store.host}/api/user/history`, {'headers': {'Authorization': `Bearer ${store.token}`}});

        history.value = await response.data;

        filterHistory.value = Object.assign([], history.value);

    } catch (error) {
        console.log(error);
    }
});

watch(type, async (newVal, oldVal) => {
    if(newVal) {
        let filterObjs = filterHistory.value.filter(x => {
            return x.type.includes(newVal)
        });

        history.value = [];

        if(filterObjs.length) {
            history.value = filterObjs
        }
    }
});

function sort(col) {

    orderByAsc = !orderByAsc

    if (col === 'created_at') {
        if (orderByAsc) {
            history.value.sort((a, b) => new Date(a[col]) - new Date(b[col]));
        } else {
            history.value.sort((a, b) => new Date(b[col]) - new Date(a[col]));
        }
    }
    router.push(`?${col}`);
}

</script>

<template>

    <div>
        <table class="mx-auto">
            <th>ID</th>
            <th>Тип операции<br><input type="text" v-model="type"></th>
            <th>Сумма</th>
            <th><a @click="sort('created_at')">Дата создания<b-icon-arrow-up v-if="!orderByAsc"></b-icon-arrow-up><b-icon-arrow-down v-if="orderByAsc"></b-icon-arrow-down></a></th>

            <tr v-for="operation in history">

                <td>{{ operation.id }}</td>
                <td>{{ operation.type }}</td>
                <td>{{ operation.sum }}</td>
                <td>{{ operation.created_at }}</td>
            </tr>

        </table>
    </div>

</template>


<style scoped>
table {
    border-collapse: separate; /* Обязательно для border-spacing */
    border-spacing: 15px; /* Одинаковый отступ между ячейками по горизонтали и вертикали */
}
</style>
