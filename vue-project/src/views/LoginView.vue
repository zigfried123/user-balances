<script setup>
import { useUserStore } from '@/stores/user'
import { useRoute, useRouter } from 'vue-router'
import { ref, reactive} from 'vue';
import axios from 'axios'

const store = useUserStore();
const route = useRoute();
const router = useRouter();

const user = reactive({'email':null, 'password': null});
const errors = reactive({'email':null, 'password': null});

async function login(){

    errors.email = null;
    errors.password = null;

    try {
        const response = await axios.post(`${store.host}/api/user/login`, {email: user.email, password: user.password});
        store.token = response.data.token;
        router.push('/');
    } catch (error) {

        error = error.response.data;
        if(error.errors) {
            errors.email = error.errors.email;
            errors.password = error.errors.password;
        }else if(error.message){
            console.log(error.message);
            errors.email = [error.message];
        }
    }
}

</script>

<template>
    <form @submit.prevent="login" class="container login-form-container">

        <div class="row justify-content-center">
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" v-model="user.email" class="form-control" id="email" >
                <div class="red-text" align="right" v-for="error in errors.email">{{error}}</div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <label for="password" class="form-label">Пароль</label>
                <input type="text" v-model="user.password" class="form-control" id="password" >
                <div class="red-text" align="right" v-for="error in errors.password">{{error}}</div>
            </div>
        </div>

        <div class="row justify-content-right mt-3" style="text-align:right">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Войти</button>
            </div>
        </div>
    </form>
</template>

<style scoped>
.login-form-container{
    width: 500px;
}
</style>
