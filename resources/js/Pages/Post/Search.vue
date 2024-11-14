<template>
    <div>
        <a class="text-large" href="/posts">게시판</a>
        <table>
            <colgroup>
                <col width="10%"/>
                <col width="30%"/>
                <col width="10%"/>
                <col width="10%"/>
                <col width="10%"/>
            </colgroup>
            <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>조회수</th>
                <th>작성시간</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(post, index) in posts" :key="post.id">
                <td>{{ meta.current_page * meta.per_page - (meta.per_page - (index + 1)) }}</td>
                <td class="contents1">
                    <a :href="`/posts/${post.id}/show`">{{ post.title }}</a>
                </td>
                <td>{{ post.view_count }}</td>
                <td>{{ post.created_at.slice(0, 10) }}</td>
                <td>
                    <a :href="`posts/${post.id}/edit`">수정</a>
                    <span>/</span>
                    <button @click="delete_post(post.id)">삭제</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button @click="previousPage" :disabled="!meta.links.prev">이전</button>
            <template v-for="page in meta.last_page" :key="page">
                <a :href="`/posts/${props.search}/search?page=${page}`">
                    &nbsp;{{ page }}&nbsp;
                </a>
            </template>
            <button @click="nextPage" :disabled="!meta.links.next">다음</button>
            <a class="create" href="/posts/create">글쓰기</a>
        </div>

        <form class="search1" @submit.prevent="search(inputValue)">
            <input class="search2" type="text" v-model="inputValue" />
            <button type="submit">게시글 검색</button>
        </form>
    </div>
</template>

<script setup>
import {useForm, router} from "@inertiajs/vue3";
import {defineProps, computed, ref} from "vue";
import { Inertia } from '@inertiajs/inertia';

const inputValue = ref("");
const delete_form = useForm({});

const props = defineProps({
    posts: {
        type: Array,
        default: () => [],
    },
    meta: {
        type: Object,
        default: () => ({
            current_page: 1,
            last_page: 5,
            per_page: 5,
            total: 50,
            links: []
        })
    },
    search: {
        type: String,
        default: "default",
    },
});
const search = (Value) => {
    if(Value === ""){
        alert("검색할 내용을 입력해주세요");
    }
    else{
        Inertia.get(`/posts/${inputValue.value}/search`);
    }
};
const delete_post = (id) => {
    delete_form.delete(`posts/${id}/delete`);
};

const previousPage = () => {
    const prevUrl = meta.value.links.prev;
    if (prevUrl) {
        router.visit(prevUrl);
    }
};

const nextPage = () => {
    const nextUrl = meta.value.links.next;
    if (nextUrl) {
        router.visit(nextUrl);
    }
};

const meta = computed(() => props.meta);
console.log(meta);
</script>

<style scoped>
.text-medium{
    font-size: 20px;
    margin: 30px 30px 30px 30px;
}

.text-large{
    font-size: 30px;
    margin: 30px 30px 30px 30px;
}

.pagination{
    display:inline;
    margin: 0px 0px 0px 35%;
}

.search1{
    margin: 30px 0px 0px 35%;
}

.search2{
    height: 24px;
    margin: 0px 2px 0px 0px;
}

.create{
    display:inline;
    margin: 0px 0px 0px 10%;
}

table{
    text-align:center;
    border-collapse: collapse;
    margin-bottom: 10px;
}

th, td{
    text-align:center;
    border-bottom: 1px solid gray;
    vertical-align: center;
    height: 35px;
}

.contents1{
    border-bottom: 1px solid gray;
    text-align:left;
    vertical-align: center;
    height: 35px;
}

tr:hover{
    background-color: #F5F5F5;
}

.text-large{
    font-size: 30px;
    margin: 30px 30px 30px 30px;
}

.ml-1{
    margin: 0px 0px 0px 30px;
}

.mbl-1{
    margin: 0px 0px 13px 30px;
}

.mbl-2{
    margin: 0px 0px 13px 210px;
}

.my-1{
    margin: 0px 0px 13px 30px;
}

.input-medium{
    height: 25px;
    width: 250px;
}

.align-r{
    text-align:left;
}

/*tr:nth-child(even){*/
/*    background-color: #F3F3F3;*/
/*}*/

</style>
