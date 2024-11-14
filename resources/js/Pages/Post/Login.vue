<template>
    <div>
        <div>
            <select class="cursor-pointer" onchange="location.href=this.value;">
                <option>한국어</option>
                <option value="http://localhost:8000/test">English</option>
                <option value="http://localhost:8000/test">中文</option>
            </select>
        </div>
        <div class="svg-container">
            <svg width="300" height="100" class="title drag-disable">
                <a href="http://127.0.0.1:8000/">
                    <text
                        x="150"
                        y="50"
                        font-family="Roboto"
                        font-size="53"
                        stroke="rgb(3, 199, 90)"
                        stroke-width="4"
                        fill="rgb(3, 199, 90)"
                        text-anchor="middle"
                        dominant-baseline="middle"
                    >
                        NAVER
                    </text>
                </a>
            </svg>
        </div>

        <LoginHeader
            @changeCurrentIndex="changeCurrentIndex"
            @changeErrorState="changeErrorState"
        />

        <div class="login-body1">
            <div
                class="login-body2"
                :style="{
                    height: error ? '330px' : '270px',
                }"
            >
                <div class="banner">
                    <span class="banner-text"
                        >PC방 등 공용PC라면 QR코드 로그인이 더 안전해요.</span
                    >
                    <span
                        class="banner-close-icon cursor-pointer"
                        onclick="this.parentElement.style.visibility='hidden'"
                    >
                        X
                    </span>
                </div>
                <IdLogin
                    @changeErrorState="changeErrorState"
                    v-if="selectedIndex == 0"
                />
                <OtpLogin v-if="selectedIndex == 1" />
                <QrLogin v-if="selectedIndex == 2" />
            </div>
            <div class="auth-links">
                <a href="">비밀번호 찾기</a>
                <span class="auth-links-margin">|</span>
                <a href="">아이디 찾기</a>
                <span class="auth-links-margin">|</span>
                <a href="http://127.0.0.1:8000/register">회원가입</a>
            </div>
            <!-- <div class="gray-background"></div> -->
        </div>
    </div>
</template>

<script setup>
import LoginHeader from "@/Components/LoginHeader.vue";
import OtpLogin from "./OtpLogin.vue";
import IdLogin from "@/Components/IdLogin.vue";
import QrLogin from "./QrLogin.vue";
import { ref } from "vue";

// 팝업창 함수
// const openPopup = () => {
//   var popupURL = "http://127.0.0.1:8000/popup";
//   var popupProperties = "width=600,height=400";
//   window.open(popupURL, "Popup", popupProperties);
// }

const selectedIndex = ref(0);

const changeCurrentIndex = (index) => {
    selectedIndex.value = index;
};

const error = ref();

const changeErrorState = (index) => {
    error.value = index;
};

// const idClicked = ref(false);
// const pwClicked = ref(false);

// const idClickHandle = () => {
//     idClicked.value = true;
//     pwClicked.value = false;
// };

// const pwClickHandle = () => {
//     pwClicked.value = true;
//     idClicked.value = false;
// };

// document.addEventListener("mousedown", (event) => {
//     if (!event.target.closest(".border-color1")) {
//         idClicked.value = false;
//     }
//     if (!event.target.closest(".border-color2")) {
//         pwClicked.value = false;
//     }ㅇㅜ
// });

// document.addEventListener("mousedown", (event) => {
//     if (event.target.closest(".border-color1")) {
//         idClicked.value = true;
//     }
//     if (event.target.closest(".border-color2")) {
//         pwClicked.value = true;
//     }
// });

// 로그인 함수

// css 적용 순서 id > class > tag
</script>

<style scoped>
.gray-background {
    background-color: rgb(245, 246, 247);
    width: 460px;
    height: 300px;
    position: relative;
    border-radius: 13px 13px 0px 0px;
    left: 0px;
    top: -363px;
    z-index: -100;
}

/* 드래그 방지 */
.drag-disable {
    -webkit-user-select: none; /* Webkti 브라우저에서 텍스트 선택 방지 */
    -moz-user-select: none; /* Firefox에서 텍스트 선택 방지 */
    -ms-user-select: none; /* IE/Edge에서 텍스트 선택 방지 */
    user-select: none; /* 표준화된 텍스트 선택 방지 */
}

/* 배너 */
.banner {
    position: relative;
    top: -272px;
    left: 272px;
    width: 224px;
    height: 25px;
    padding: 4px 20px 3px 9px;
    border-radius: 12px;
    border: 1px solid rgb(9, 170, 92);
    background-color: white;
    box-sizing: border-box;
    z-index: 10px;
    font-size: 10px;
    font-weight: 600;
}

.banner-close-icon {
    position: absolute;
    padding: 7px;
    top: -4px;
    left: 200px;
    color: rgb(9, 170, 92);
}

.banner-text {
    position: absolute;
    padding: 0px;
    left: 9px;
    font-size: 9.5px;
}

select {
    margin: 20px 20% 0 71.6%;
    width: 95px;
    height: 30px;
    font-size: 12px;
    padding: 0px 0px 0px 8px;
    border-color: rgb(204, 204, 204);
}

.cursor-pointer {
    cursor: pointer;
}

.svg-container {
    display: flex;
    justify-content: center; /* 수평 중앙 정렬 */
    align-items: center; /* 수직 중앙 정렬 */
    height: 100px; /* SVG 높이에 맞춰 설정 */
}

.title {
    font-weight: 400;
    margin: 41px 0px 0px 0px;
    padding: 0px;
    align-items: center;
}

.login-body1 {
    /*중앙 정렬*/
    place-items: center;
    margin: -40px 0px 0px 0px;
    position: relative;
    z-index: 10;
}

.login-body2 {
    width: 460px;
    height: 270px;
    border-width: 1px;
    border-radius: 12px;
    margin: 38px 0px 0px 0px;
    background-color: white;
}

.auth-links {
    color: rgb(138, 138, 140);
    margin: 18px 0px 0px 0px;
    font-size: 14px;
}

.auth-links-margin {
    margin: 0px 12px 0px;
}
</style>
