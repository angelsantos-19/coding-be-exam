<script setup>
import Navbar from '../components/navbar.vue';
import { Bootstrap5Pagination } from 'laravel-vue-pagination';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import {router} from '@inertiajs/vue3'

const props = defineProps(['products']);


const getResults = async (page) => {
    console.log('Calling getResults with page:', page);

  try {
    // Make an API request to fetch data based on the selected page
    const response = await axios.get(`/productlist?page=${page}`);
    console.log('API Response:', response.data);
    // Update the 'products' prop with the new data
   emit('update:products', response.data);

  } catch (error) {
    console.error('Error fetching product data:', error);
  }
};

// Fetch initial data when the component is mounted
onMounted(() => {
  getResults(1); // You can specify the initial page here
});


function destroy(id){
    router.delete('/productlist/'+id+'/delete');
}

</script>
<style>
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
</style>

<template>

<Navbar>
    <template #main>
<br>
<div class="row mb-3">
    <div class="col-2 mx-auto">
        <form action="/productlist" class="row g-2 mt-2">
        <button type="submit" class="btn btn-primary">Show all Listings</button>
        </form>
    </div>
    <div class="col-2 mx-auto">
        <form action="/addproduct" class="row g-2 mt-2">
        <button type="submit" class="btn btn-primary">Add New Product</button>
        </form>
    </div>
</div>

<form action="/productlist" class="row g-2  mx-5">
<div class="col-md-11">
    <input class="form-control" name="search" placeholder="Type to search...">
</div>
<div class="col-1">
    <button type="submit" class="btn btn-primary">Search</button>
</div>
</form>
<form action="/productlist" class="row g-2 mt-2 mx-5">
    <div class="col-md-11">
    <select class="form-select" name="filter" aria-label="Default select example">
        <option disabled selected>Select Category</option>
        <option value="Category 1">Category 1</option>
        <option value="Category 2">Category 2</option>
        <option value="Category 3">Category 3</option>
        <option value="Category 4">Category 4</option>
        <option value="Category 5">Category 5</option>

    </select>
    </div>
    <div class="col-1">
    <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>

<br>
<div v-if="products.data && products.data.length > 0">
<div class="container text-center">
  <div class="row">
        <div class="col-auto mb-4" v-for="product in products.data" :key="product.id">
            <div class="card" style="width: 22rem; height: 22rem;">
                <div class="card-body">
                    <a class=" nav-link active" href="#" >
                    <img src="https://static-00.iconduck.com/assets.00/no-image-icon-512x512-lfoanl0w.png" alt="Bootstrap" width="105" height="100">
                    </a>
                    <h5 class="card-title mt-3">{{ product.name }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ product.category }}</h6>
                    <p class="card-text">{{ product.description }}</p>
                </div>
                <div class="row">
                        <div class="col">
                            <a :href="'/productlist/' + product.id + '/edit'" class="bi bi-pencil-square"  style="font-size: 2em;"></a>
                        </div>
                        <div class="col">
                                <button type="submit" class="btn" @click="destroy(product.id)">
                                <i class="bi bi-trash" style="font-size: 2em; color: red;"></i>
                                </button>
                        </div>
                    </div>
            </div>
        </div>
  </div>
  <div>
  <Bootstrap5Pagination :data="products" @pagination-change-page="getResults"/>
    </div>
    <br>
</div>
</div>
<div v-else>
    <p>No products available.</p>
</div>
</template>
</Navbar>
</template>
