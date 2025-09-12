<script setup>
import {ref, onMounted} from 'vue'
import {useUserStore} from '@/stores/user'
import {useRoute, useRouter} from 'vue-router'
import axios from "axios";

const store = useUserStore();
const route = useRoute();
const router = useRouter();

const balances = ref([]);
const operations = ref([]);

onMounted(async () => {
    if (!store.token) {
        router.push('/login');
    }

    async function requestData() {

        try {
            const response = await axios.get(`${store.host}/api/user/dashboard`, {'headers': {'Authorization': `Bearer ${store.token}`}});
            operations.value = [];
            balances.value = [];

            balances.value = response.data.balances;
            operations.value = response.data.operations;


        } catch (error) {
            console.log(error);

        }
    }

    await requestData();

    setInterval(await requestData, 5000);
})
</script>

<template>


    Балансы
    <div v-for="balance in balances">
        {{ balance.user_id }} {{ balance.total }} {{ balance.currency }}
    </div><br>

    <div v-for="operation in operations">
        {{ operation.id }}
        {{ operation.type }}
        {{ operation.sum }}
        {{ operation.created_at }}
    </div>


</template>


<style scoped>

</style>
