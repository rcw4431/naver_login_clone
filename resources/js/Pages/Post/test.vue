<template>
    <div>
        <p>{{ TimerStr }}</p>
    </div>
    <button type="button" @click="restart">재시작</button>
</template>

<script setup>
import { ref, onMounted } from "vue";

const Timer = ref();
const TimerCounter = ref();
const TimerStr = ref("00분 04초");

const timerStart = () => {
    TimerCounter.value = 4;
    const interval = setInterval(() => {
        TimerCounter.value--;
        TimerStr.value = prettyTime();
        if (TimerCounter.value <= 0) timerStop(interval);
    }, 1000);
    return interval;
};

const timerStop = (Timer) => {
    clearInterval(Timer);
    TimerCounter.value = 0;
};

const prettyTime = () => {
    const time = TimerCounter.value / 60;
    const minutes = Math.floor(time);
    const secondes = TimerCounter.value % 60;
    return (
        minutes.toString().padStart(2, "0") +
        "분 " +
        secondes.toString().padStart(2, "0") +
        "초"
    );
};

const restart = () => {
    TimerStr.value = "00분 04초";

    timerStart();
};

onMounted(() => {
    if (Timer.value != null) {
        timerStop(Timer.value);
        Timer.value = null;
    }
    Timer.value = timerStart();
});
</script>

<style scoped></style>

<!-- <template>

<div>
    <input type="checkbox" id="b" class="">
    <div class="label-box"> 
        <span class="check-icon"></sspan>
        <label class="a" for="b">체크박스</label>
    </div>
</div>

  </template>
  


  <script setup>

  </script>


  
  <style scoped>

.a{
    padding-left: 2.2em;
    position: relative;
}

.label-box {
    position: relative;
}


.check-icon {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background-color: #fff;

    border: 1px solid gray;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}
.check-icon::before {
    content: "";
    position: absolute;
    box-sizing: border-box; 
    width: 30%;
    height: 55%;
    left: 50%;
    top: 50%;
    transform: translateX(-50%) translateY(-70%) rotateZ(40deg);
    border-right: 1.7px solid gray;
    border-bottom: 1.7px solid rgb(128, 128, 128);
}

[type="checkbox"]:checked + .label-box .check-icon {
    border-color:  yellowgreen;
    background-color: yellowgreen;
}
[type="checkbox"]:checked + .label-box .check-icon::before {
    border-color: #fff;
}
  </style> -->

<!-- <template>
    <div>
        <a href="/posts">게시판</a>
        <br>
        <table>
            <colgroup>
                <col width="10%"/>
                <col width="50%"/>
                <col width="20%"/>
                <col width="10%"/>
                <col width="10%"/>
            </colgroup>
            <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>조회수</th>
                <th>작성시간</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(post, index) in posts" :key="post.id">
                <td style="text-align:center">{{ meta.current_page * meta.per_page - (meta.per_page - (index + 1)) }}</td>
                <td>
                    <form @submit.prevent="view_count(post.id)">
                        <a style="text-align: center" :href="`/posts/${post.id}`">
                            {{ post.title }}
                        </a>
                    </form>
                </td>
                <td style="text-align:center">{{ post.view_count }}</td>
                <td style="text-align:center">{{ post.created_at.slice(0, 10) }}</td>
                <td>
                    <a :href="`posts/${post.id}/edit`">수정</a>
                    <span>/</span>
                    <button @click="delete_post(post.id)">삭제</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div>
            <button @click="previousPage" :disabled="!meta.links.prev">이전</button>
            <button @click="nextPage" :disabled="!meta.links.next">다음</button>
        </div>

        <form @submit.prevent="search">
            <input type="text" v-model="search_form.search" />
            <button type="submit">게시글 검색</button>
        </form>
        <a href="posts/create">글쓰기</a>
    </div>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import {defineProps, computed} from "vue";
import {router} from "@inertiajs/vue3";


const search_form = useForm({
    search: "",
});

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
    }
});

const search = () => search_form.get(`/posts/${search_form.search}`);

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
</script> -->

<!-- <template>
    <div>
        <a href="/posts">게시판</a>
        <br>
        <table>
            <colgroup>
                <col width="10%"/>
                <col width="50%"/>
                <col width="20%"/>
                <col width="10%"/>
                <col width="10%"/>
            </colgroup>
            <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>조회수</th>
                <th>작성시간</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(post, index) in posts" :key="post.id">
                <td style="text-align:center">{{ meta.current_page * meta.per_page - (meta.per_page - (index + 1)) }}</td>
                <td>
                    <form @submit.prevent="view_count(post.id)">
                        <a style="text-align: center" :href="`/posts/${post.id}`">
                            {{ post.title }}
                        </a>
                    </form>
                </td>
                <td style="text-align:center">{{ post.view_count }}</td>
                <td style="text-align:center">{{ post.created_at.slice(0, 10) }}</td>
                <td>
                    <a :href="`posts/${post.id}/edit`">수정</a>
                    <span>/</span>
                    <button @click="delete_post(post.id)">삭제</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div>
            <button @click="previousPage" :disabled="!meta.links.prev">이전</button>
            <button @click="nextPage" :disabled="!meta.links.next">다음</button>
        </div>

        <form @submit.prevent="search">
            <input type="text" v-model="search_form.search" />
            <button type="submit">게시글 검색</button>
        </form>
        <a href="posts/create">글쓰기</a>
    </div>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import {defineProps, computed} from "vue";
import {router} from "@inertiajs/vue3";


const search_form = useForm({
    search: "",
});

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
    }
});

const search = () => search_form.get(`/posts/${search_form.search}`);

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
</script> -->
