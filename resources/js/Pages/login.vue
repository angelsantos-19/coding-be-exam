<script setup>
import Navbar from '../components/navbar.vue';
import {useForm} from '@inertiajs/vue3'
import {router} from '@inertiajs/vue3'

defineProps({
    errors:Object
});

const form = useForm({
    email:null,
    password:null,
});

function submit(){
    router.post('/login/authenticate',form)
}

// export default{
//     data(){
//         return{
//             secrets: [],
//             formData:{
//                 email:'',
//                 password:''
//             }
//         }
//     },
//     methods: {
//     handleLogin(){
//         axios.get('sanctum/csrf-cookie').then(response =>{
//             console.log(response);
//         });
//     }
// }
// }
</script>
<template>
<Navbar>
<template #main>
    <br>

<div class="card col-5 offset-3 mt-5">
  <div class="card-header">
    Input Login Credentials
  </div>
  <div class="card-body">
    <form @submit.prevent="submit">
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Username/Email</label>
            <input type="name" id="email" v-model="form.email" class="form-control" >
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            <div class="text-danger text-xs" v-if="errors.email">{{ errors.email }}</div>
        </div>

        <div class="mb-2">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" v-model="form.password" >
            <div class="text-danger text-xs" v-if="errors.password">{{ errors.password }}</div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>
<br>
</template>
</Navbar>
</template>
