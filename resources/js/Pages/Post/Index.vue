<template>
    <div>
        <!-- <div v-if="$page.props.auth.user">{{ checkLogin() }}</div>
        <div v-else>
            <a href="/login">로그인</a>
            <span>/</span>
            <a href="/register">회원가입</a>
        </div> -->
        <a href="/loginPage">로그인</a>
        <span>/</span>
        <a href="/register">회원가입</a>
    </div>
</template>

<script setup>
// import { Inertia } from '@inertiajs/inertia';
    // const checkLogin = () => {
    //     Inertia.visit('/posts');
    // }
</script>

