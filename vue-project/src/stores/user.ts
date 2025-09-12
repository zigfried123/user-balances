import { ref, reactive, computed } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios'
import { useRoute } from 'vue-router'
const route = useRoute();

export const useUserStore = defineStore('userStore', {
    state: () => ({
        host: 'http://localhost:8000',
        token: null,
        history: [{}],
    }),
    persist: true,
    actions: {
        async fetchHistory() {
            try {
                const response = await axios.get(`${this.host}/api/user/history`, {'headers': {'Authorization': `Bearer ${this.token}`}});
                this.history = response.data;

                console.log(history);

            } catch (error) {
                console.log(error);

            }
        },
    },
});
