<script setup>
import Navbar from '../components/navbar.vue';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import {router} from '@inertiajs/vue3'

const props = defineProps({errors:Object, products:Array, users:Array, categoryCounts:Array});


const getResults = async (page) => {
    console.log('Calling getResults with page:', page);

  try {
    const response = await axios.get(`/productlist?page=${page}`);
    console.log('API Response:', response.data);
    categoryCounts.value = response.data;
    emit('update:categoryCounts', categoryCounts.value);

    emit('update:products', response.data);

  } catch (error) {
    console.error('Error fetching product data:', error);
  }
};

// Fetch initial data when the component is mounted
onMounted(() => {
  getResults(1); // You can specify the initial page here
});

</script>

<template>
<Navbar>
    <template #main>
        <h1>Dashboard</h1>
    <div class="row">
    <div class="col-6">
        <div class="card w-80 mb-3">
        <div class="card-body">
            <h5 class="card-title">Product information in Database</h5>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Date Created</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products.data" :key="product.id">
                <th scope="row">{{ product.id }}</th>
                <td>{{ product.name }}</td>
                <td>{{ product.category }}</td>
                <td>{{ product.datetime }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card w-80 mb-3">
        <div class="card-body">
            <h5 class="card-title">Product Category Count</h5>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">Category</th>
                <th scope="col">Category Count</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="categoryCount in categoryCounts" :key="categoryCount.category">
                <th scope="row">{{ categoryCount.category }} </th>
                <td>{{ categoryCount.count }}</td>
                </tr>

            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>

    <div class="card w-80 mb-3">
        <div class="card-body">
            <h5 class="card-title">Users information in Database</h5>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.created_at }}</td>

                </tr>
            </tbody>
            </table>
        </div>
        </div>
    <br>
    <br>
    </template>

</Navbar>
</template>
