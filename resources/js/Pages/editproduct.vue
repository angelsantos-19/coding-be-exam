<script setup>
import Navbar from '../components/navbar.vue';
import {useForm} from '@inertiajs/vue3'
import {router} from '@inertiajs/vue3'

const props = defineProps({errors:Object, product:Array});
const form = useForm({
    name:props.product.name,
    category:props.product.category,
    description:props.product.description,
    datetime:props.product.datetime,
    image:props.product.image,
});

function submit(){
    router.put('/productlist/'+ props.product.id,form)
}

</script>


<template>
<Navbar>
<template #main>
<div class="card col-6 offset-3 mb-5">
  <div class="card-header">
    Edit Current Product
  </div>
  <div class="card-body">
    <form @submit.prevent="submit" enctype="multipart/form-data">
        <div class="mb-5 row">
            <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="name" id="name" v-model="form.name" class="form-control">
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            <div class="text-danger text-xs" v-if="errors.name">{{ errors.name }}</div>
            </div>
        </div>

        <div class="mb-5 row">
            <label for="exampleInputEmail1" class="col-sm-2 col-form-label-label">Category</label>
            <div class="col-sm-10">
                <select class="form-select" id="category" v-model="form.category" aria-label="Default select example">
                <option disabled selected>Select Category</option>
                <option value="Category 1">Category 1</option>
                <option value="Category 2">Category 2</option>
                <option value="Category 3">Category 3</option>
                <option value="Category 4">Category 4</option>
                <option value="Category 5">Category 5</option>
                </select>
            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            <div class="text-danger text-xs" v-if="errors.category">{{ errors.category }}</div>
         </div>

        </div>

        <div class="mb-5 row">
            <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="description" v-model="form.description" >
            <div class="text-danger text-xs" v-if="errors.description">{{ errors.description }}</div>
            </div>

        </div>

        <div class="mb-5 row">
            <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Image</label>
            <div class="col-sm-10">
            <input class="form-control" type="file" id="image"  name="image" @change="form">
            </div>

        </div>
        <div class="mb-5 row">
            <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Date and Time</label>
            <div class="col-sm-10">
               <input type='datetime-local' class="form-control" id="datetime" v-model="form.datetime" />
            <div class="text-danger text-xs" v-if="errors.datetime">{{ errors.datetime }}</div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Edit Product</button>
    </form>
  </div>
</div>
</template>
</Navbar>
</template>
