<template>
    <a class="text-large m-1" href="/posts">게시판</a>
    <br>
    <label class="title1" for="title">제목</label>
    <input class="title2" type="text" id="title" v-model="form.title" />
    <br>
    <input class="contents1" type="text" id="content" v-model="form.content" />
    <br>
    <a class="m-1" href="/posts">목록으로</a>
    <br>
    <table>
        <tr>
            <td>
                <Link class="" :href="`/posts/${post.id}/like`">좋아요</Link>
            </td>
            <td>
                <p>{{ post.like_count }}</p>
            </td>
            <td>
                <Link :href="`/posts/${post.id}/dislike`">싫어요</Link>
            </td>
        </tr>
    </table>
</template>

<script setup>
    import { onMounted } from "vue";
    import { useForm,Link } from "@inertiajs/vue3";

    const form = useForm({
        title: "",
        content: "",
    })
    const props = defineProps({
        post: {
            type: Object,
            default: null,
        },
    });
    onMounted( () => {
        form.title=props.post.title;
        form.content=props.post.content;
    })


</script>

<style scoped>
    .text-large{
    font-size: 30px;
}

.title1{
    border-top: 1px solid black;
    border-bottom: 1px solid black;
    border-left: 1px solid black;
    background-color: rgba(128, 128, 128, 0.19);
    width: 100px;
    margin: 50px 0px 0px 20px;
}

.title2{
    height: 21px;
    width: 300px;
}

.m-1{
    margin: 30px;
}



.contents1{
    margin: 0px 30px 30px 20px;
    height: 500px;
    width: 329px;
    text-align: center;

}

</style>
