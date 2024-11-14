<template>
    <a class="text-large m-l" href="/posts">게시판</a>
    <form @submit.prevent="submit(form.title, form.content)">
        <label class="title1" for="title">제목</label>
        <input class="title2" type="text" id="title" v-model="form.title" />
        <br />
        <input
            class="contents1"
            type="text"
            id="content"
            v-model="form.content"
        />
        <br />
        <button class="m-l" type="submit">글쓰기</button>
        <span>/</span>
        <a href="/posts">취소</a>
    </form>
</template>

<script setup>
import { onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    post: {
        type: Object,
        default: null,
    },
    isUpdating: {
        type: Boolean,
        default: false,
    },
});

const form = useForm({
    title: "",
    content: "",
});

const submit = (value1, value2) => {
    if (value1 === "" || value2 === "") {
        alert("제목과 내용을 모두 입력해주세요");
    } else {
        props.isUpdating ? update_post() : add_post();
    }
};
const add_post = () => {
    form.post("/posts/add");
};
const update_post = () => {
    form.put(`/posts/${props.post.id}/update`);
};

onMounted(() => {
    form.title = props.post.title;
    form.content = props.post.content;
});
</script>

<style scoped>
.text-large {
    font-size: 30px;
}

.title1 {
    border-top: 1px solid black;
    border-bottom: 1px solid black;
    border-left: 1px solid black;
    height: 21px;
    width: 300px;
    margin: 50px 0px 0px 20px;
}

.title2 {
    height: 21px;
    width: 300px;
}

.m-1 {
    margin: 30px;
}

.m-l {
    margin: 0px 0px 0px 30px;
}

.contents1 {
    margin: 0px 30px 30px 20px;
    height: 500px;
    width: 329px;
    text-align: center;
}
</style>
