<template>
    <div>
        <div class="login-guide">
            <span>
                네이버앱의
                <span class="login-guide2">
                    메뉴 > 설정<img class="gear-img" src="/img/gear.png" />
                    > 로그인 아이디 관리 >
                    <br />
                    더보기<img class="kebab-img" src="/img/kebab.png" /> >
                    일회용 로그인 번호</span
                >에 보이는 번호를 입력해 주세요.
            </span>
            <!-- 함수로 팝업창 띄우기 -->
            <!-- <button @click="openPopup" class="margin-left">IP보안</button> -->

            <!-- onclick으로 팝업창 띄우기 -->
            <button
                class="popup"
                type="button"
                onclick="window.open('http://127.0.0.1:8000/popup','_blank','width=530, height=750, top=0, left=0')"
            >
                <div>?</div>
            </button>
        </div>

        <form @submit.prevent="submit">
            <div class="number-input-position">
                <div
                    class="number-input-border"
                    :style="{
                        borderColor: numberClicked ? 'rgb(9, 170, 92)' : '',
                        borderWidth: numberClicked ? '2px' : '1px',
                    }"
                >
                    <input
                        class="number-input cursor-pointer number-border-color"
                        type="text"
                        placeholder="번호를 입력하세요."
                        v-model="form.number"
                        required
                        :style="{
                            borderColor: numberClicked ? 'rgb(9, 170, 92)' : '',
                        }"
                        @focus="numberClickHandle"
                    />
                    <div
                        class="number-clear-button"
                        @click="clearNumber"
                        :style="{
                            visibility: form.number ? '' : 'hidden',
                        }"
                    >
                        <span id="number-clear-label"> X </span>
                        <label
                            class="number-clear-label cursor-pointer"
                            for="number-clear-label"
                        ></label>
                    </div>
                </div>
            </div>

            <button
                type="submit"
                class="login-button"
                :style="{
                    top: form.errors.number ? '-158px' : '',
                }"
            >
                로그인
            </button>
        </form>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { useForm } from "@inertiajs/vue3";

// 팝업창 함수
// const openPopup = () => {
//   var popupURL = "http://127.0.0.1:8000/popup";
//   var popupProperties = "width=600,height=400";
//   window.open(popupURL, "Popup", popupProperties);
// }
const clearNumber = () => {
    form.number = "";
};

const form = useForm({
    number: "",
});

onMounted(() => {
    // 마우스로 다른곳을 누른 순간 false
    document.addEventListener("mousedown", (event) => {
        if (!event.target.closest(".number-border-color")) {
            numberClicked.value = false;
        }
    });

    // 마우스를 누른 순간 true
    document.addEventListener("mousedown", (event) => {
        if (event.target.closest(".number-border-color")) {
            numberClicked.value = true;
        }
    });
});

// 클릭하면 아이디, 비밀번호 입력 창 테두리 색 변경
const numberClicked = ref(false);

const numberClickHandle = () => {
    numberClicked.value = true;
};

// 로그인 함수
const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
// css 적용 순서 id > class > tag
</script>

<style scoped>
.number-clear-button {
    position: relative;
    text-align: center;
    top: 16px;
    left: 376px;
    width: 14px;
    height: 14px;
    font-size: 11px;
    border-radius: 50%;
    background-color: rgba(137, 144, 167);
    color: white;
}

.number-clear-label {
    display: inline-block;
    position: absolute;
    width: 35px;
    height: 35px;
    top: -10px;
    left: -10px;
    z-index: 100;
    background-color: rgba(0, 0, 0, 0);
}

/* 기어, 케밥 이미지 */
.gear-img {
    display: inline;
    position: relative;
    width: 17px;
    height: 17px;
    top: -3px;
    left: 2px;
}

.kebab-img {
    display: inline;
    position: relative;
    width: 5px;
    height: 16px;
    top: -2px;
    left: 2px;
}

/* 로그인 과정 설명 */
.login-guide {
    text-align: center;
    position: relative;
    top: 00px;
    font-size: 15px;
    font-weight: 500;
    margin-top: 15px;
}

.login-guide2 {
    color: rgb(9, 170, 92);
    font-weight: 600;
}

/* 드래그 방지 */
.drag-disable {
    -webkit-user-select: none; /* Webkit 브라우저에서 텍스트 선택 방지 */
    -moz-user-select: none; /* Firefox에서 텍스트 선택 방지 */
    -ms-user-select: none; /* IE/Edge에서 텍스트 선택 방지 */
    user-select: none; /* 표준화된 텍스트 선택 방지 */
}

.cursor-pointer {
    cursor: pointer;
}

.login-button {
    position: relative;
    width: 410px;
    height: 50px;
    background-color: rgb(9, 170, 92);
    border-radius: 8px;
    margin: 9px 0px 0px 24px;
    font-weight: 900;
    font-size: 17px;
    color: white;
    text-align: center;
}

.number-input-position {
    position: relative;
    margin: 00px 0px 0px 25px;
}

.number-input-border {
    width: 410px;
    height: 50px;
    border-width: 1px;
    border-radius: 8px 8px 8px 8px;
    border-color: rgb(197, 204, 210);
    margin: 0px 0px 0px 0px;
}

.number-input-border:focus {
    box-shadow: 0px 0px 0px 1px rgb(9, 170, 92);
}

.number-input {
    position: absolute;
    text-align: center;
    width: 377px;
    height: 17px;
    top: 17px;
    left: 10px;
    background-color: rgba(0, 0, 0, 0);
    border: 0px;
    padding: 0px;
    font-size: 16px;
    font-weight: 500;
}

.number-input:focus {
    box-shadow: none;
}

input:focus {
    outline: none;
}

.remember-me {
    color: rgb(136, 136, 136);
    position: relative;
    left: 25px;
}

.auth-links {
    color: rgb(138, 138, 140);
    margin: 18px 0px 0px 0px;
    font-size: 14px;
}

.login-options1 {
    place-items: center;
    margin: 0px 430px 0px 0px;
}

.login-options2 {
    position: relative;
    display: flex;
    text-align: center;
    align-items: center;
    margin: 87px 0px 0px 432px;
}

.popup {
    position: relative;
    margin-left: 370px;
    border-radius: 50%;
    width: 11px;
    height: 11px;
    background-color: rgb(109, 116, 133);
    font-size: 9px;
    color: white;
    top: -24px;
    left: 0px;
}

.hidden {
    display: none;
}
</style>
