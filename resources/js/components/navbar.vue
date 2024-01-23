<script setup>
import {ref, onMounted} from 'vue';
import axios from 'axios';
import {useForm} from '@inertiajs/vue3'
import {router} from '@inertiajs/vue3'
const user = ref();

const props = defineProps({loginsucces: Boolean});

</script>
<template>
<nav class="navbar bg-primary fixed-top">
  <div class="container-fluid">

    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>



    <nav aria-label="breadcrumb">
    <div v-if="loginsucces =='true'">
        <!-- Content for authenticated users -->
        Welcome, authenticated user!
    </div>
    <div v-else>
        <a class="navbar-brand " href="#">Welcome</a>
        <a class="navbar-brand " href="/login">Login</a>
    </div>

    </nav>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Sidebar Contents</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/productlist">Products Listing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/addproduct">Add Products</a>
          </li>
        </ul>
        <form action="/productlist" class="d-flex mt-3" role="search">
          <input class="form-control me-2" type="search" name="search" placeholder="Type to search Product.." aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
<main style="background-color: #f0f0f0; display: flex; flex-direction: column; min-height: 100vh;">
    <br>
    <br>
    <br>
<div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible">
    {{ $page.props.flash.message }}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<slot name="main">
</slot>
</main>

<footer class="master-footer">
<nav class="navbar bg-primary opacity-50 ">
    <div class="container-fluid">
    <span class="navbar-text">
        Internship Exam - Angel Santos
      </span>
    </div>
</nav>
</footer>

</template>
