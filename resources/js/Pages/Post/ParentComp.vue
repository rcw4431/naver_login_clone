<template>
    <div>
        <ChildComp title="hello" />
    </div>
</template>

<script setup>
import ChildComp from './test/ChildComp.vue';
console.log(ChildComp);
</script>
