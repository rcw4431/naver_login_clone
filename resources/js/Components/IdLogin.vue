<template>
    <div>
        <form @submit.prevent="submit">
            <div class="login-inputs">
                <div
                    class="email-input"
                    :style="{
                        borderColor: idClicked ? 'rgb(9, 170, 92)' : '',
                        borderWidth: idClicked ? '2px' : '1px',
                        borderBottomWidth: idClicked ? '2px' : '0.5px',
                    }"
                >
                    <span
                        class="email-input-text drag-disable"
                        :style="{
                            transform:
                                idClicked || form.email
                                    ? 'translateY(-15px) translateX(-20px) scale(0.73)'
                                    : '',
                        }"
                    >
                        아이디 또는 전화번호
                    </span>
                    <div
                        class="clear-email cursor-pointer"
                        @click="clearEmail"
                        :style="{
                            visibility: form.email ? '' : 'hidden',
                        }"
                    >
                        <span id="clear-email-label"> X </span>
                        <label
                            class="clear-email-label cursor-pointer"
                            for="clear-email-label"
                        ></label>
                    </div>
                    <input
                        class="email-input2 cursor-pointer border-color1"
                        type="email"
                        v-model="form.email"
                        required
                        @focus="idClickHandle"
                    />
                </div>
                <div
                    class="password-input"
                    :style="{
                        borderColor: pwClicked ? 'rgb(9, 170, 92)' : '',
                        borderWidth: pwClicked ? '2px' : '1px',
                        borderTopWidth: pwClicked ? '2px' : '0.5px',
                    }"
                >
                    <span
                        class="password-input-text drag-disable"
                        :style="{
                            transform:
                                pwClicked || form.password
                                    ? 'translateY(-15px) translateX(-10px) scale(0.73)'
                                    : '',
                        }"
                    >
                        비밀번호
                    </span>
                    <div
                        class="clear-password cursor-pointer"
                        @click="clearPassword"
                        :style="{
                            visibility: form.password ? '' : 'hidden',
                        }"
                    >
                        <span id="clear-password-label"> X </span>
                        <label
                            class="clear-password-label cursor-pointer"
                            for="clear-password-label"
                        ></label>
                    </div>
                    <input
                        class="password-input2 cursor-pointer border-color2"
                        :type="pwShow ? 'text' : 'password'"
                        v-model="form.password"
                        required
                        :style="{
                            borderColor: pwClicked ? 'rgb(9, 170, 92)' : '',
                        }"
                        @focus="pwClickHandle"
                    />
                    <!-- 패스워드 보이게 -->
                    <div
                        class="show-password cursor-pointer"
                        @click="changePwState"
                        :style="{
                            display:
                                form.password && pwShow === true ? '' : 'none',
                        }"
                    >
                        <img src="/img/pwShow.png" />
                    </div>
                    <!-- 패스워드 안보이게 -->
                    <div
                        class="hide-password cursor-pointer"
                        @click="changePwState"
                        :style="{
                            display:
                                form.password && pwShow === false ? '' : 'none',
                        }"
                    >
                        <img src="/img/pwHide.png" />
                    </div>
                </div>
            </div>
            <div class="checkbox">
                <!-- 체크박스 디자인 변경 -->
                <input type="checkbox" id="a" class="hidden cursor-pointer" />
                <label for="a" class="check-icon cursor-pointer"></label>
                <label for="a" class="remember-me cursor-pointer"
                    >로그인 상태 유지</label
                >

                <!-- 함수로 팝업창 띄우기 -->
                <!-- <button @click="openPopup" class="">IP보안</button> -->

                <!-- onclick으로 팝업창 띄우기 -->
                <button
                    class="ip-security-text"
                    type="button"
                    onclick="window.open('http://127.0.0.1:8000/popup','_blank','width=530, height=750, top=0, left=0')"
                >
                    IP보안
                </button>

                <!--  토글버튼 -->
                <input type="checkbox" id="toggle" class="hidden" />
                <label for="toggle" class="toggleSwitch">
                    <span class="toggleSwitch2">ON</span>
                    <span class="toggleButton"></span>
                    <span class="toggleSwitch3">OFF</span>
                </label>
            </div>
            <div class="error-message">
                <InputError :message="form.errors.email" />
            </div>
            <button
                type="submit"
                class="login-button"
                :style="{
                    top: form.errors.email ? '-158px' : '',
                }"
            >
                로그인
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    email: "",
    password: "",
});

const emit = defineEmits(["changeErrorState"]);

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });

    emit("changeErrorState", true);
};

const clearEmail = () => [(form.email = "")];

const clearPassword = () => [(form.password = "")];

const showPassword = () => [(form.password = "")];
// 클릭하면 아이디, 비밀번호 입력 창 테두리 색 변경
const idClicked = ref(false);

const pwClicked = ref(false);

const idClickHandle = () => {
    idClicked.value = true;
    pwClicked.value = false;
};

const pwClickHandle = () => {
    pwClicked.value = true;
    idClicked.value = false;
};

const pwShow = ref(false);

const changePwState = () => {
    if (pwShow.value === false) {
        pwShow.value = true;
    } else {
        pwShow.value = false;
    }
};

// 마우스로 다른곳을 누른 순간 false
document.addEventListener("mousedown", (event) => {
    if (!event.target.closest(".border-color1")) {
        idClicked.value = false;
    }
    if (!event.target.closest(".border-color2")) {
        pwClicked.value = false;
    }
});

// 마우스를 누른 순간 true
document.addEventListener("mousedown", (event) => {
    if (event.target.closest(".border-color1")) {
        idClicked.value = true;
    }
    if (event.target.closest(".border-color2")) {
        pwClicked.value = true;
    }
});
</script>

<style scoped>
.clear-email {
    display: inline-block;
    position: absolute;
    font-size: 11px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    top: 21px;
    left: 377px;
    text-align: center;
    background-color: rgba(137, 144, 167);
    color: white;
    z-index: 100;
}

.clear-email-label {
    display: inline-block;
    position: absolute;
    width: 40px;
    height: 40px;
    top: -12px;
    left: -13px;
    background-color: rgb(137, 144, 167, 0);
    color: white;
    z-index: 100;
}

.clear-password {
    display: inline-block;
    position: absolute;
    font-size: 11px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    top: 81px;
    left: 377px;
    text-align: center;
    background-color: rgb(137, 144, 167);
    color: white;
    z-index: 100;
}

.clear-password-label {
    display: inline-block;
    position: absolute;
    width: 40px;
    height: 40px;
    top: -12px;
    left: -13px;
    background-color: rgb(137, 144, 167, 0);
    color: white;
    z-index: 100;
}
.hide-password {
    display: inline-block;
    position: absolute;
    width: 20px;
    height: 20px;
    top: 81px;
    left: 342px;
    text-align: center;
    z-index: 100;
}

.show-password {
    display: inline-block;
    position: absolute;
    width: 20px;
    height: 20px;
    top: 82px;
    left: 342px;
    text-align: center;
    z-index: 100;
}

/* 에러메시지 */
.error-message * {
    width: 370px;
    height: 200px;
    font-size: 11.5px;
    font-weight: 600;
    position: relative;
    top: 0px;
    left: 12px;
    color: rgb(255, 24, 24);
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

.login-inputs {
    position: relative;
    margin: 22px 0px 0px 25px;
}

.email-input {
    width: 410px;
    height: 59.5px;
    border-width: 1px 1px 0.5px 1px;
    border-radius: 8px 8px 0px 0px;
    border-color: rgb(197, 204, 210);
    margin: -25px 0px 0px 0px;
}

.email-input:focus {
    box-shadow: 0px 0px 0px 1px rgb(9, 170, 92);
}

.email-input2 {
    position: absolute;
    width: 377px;
    height: 23px;
    top: 25px;
    left: 15px;
    background-color: rgba(0, 0, 0, 0);
    border: 0px;
    padding: 0px;
}

.email-input2:focus {
    box-shadow: none;
}

input:focus {
    outline: none;
}

.email-input-text {
    position: absolute;
    top: 20px;
    left: 18px;
    color: rgb(158, 158, 158);
    transition: transform 0.25s;
    display: inline-block;
}

.password-input {
    width: 410px;
    height: 59.5px;
    border-width: 0.5px 1px 1px 1px;
    border-radius: 0px 0px 8px 8px;
    border-color: rgb(197, 204, 210);
    display: inline-block;
}

.password-input:focus {
    box-shadow: 0px 0px 0px 1px rgb(9, 170, 92);
}

.password-input2 {
    position: absolute;
    width: 377px;
    height: 23px;
    top: 87px;
    left: 15px;
    background-color: rgba(0, 0, 0, 0);
    border: 0px;
    padding: 0px;
}

.password-input2:focus {
    box-shadow: none;
}

.password-input-text {
    position: absolute;
    top: 78px;
    left: 18px;
    color: rgb(158, 158, 158);
    display: inline-block;
    transition: transform 0.25s;
}

.remember-me {
    color: rgb(136, 136, 136);
    position: relative;
    left: 25px;
}

.ip-security-text {
    position: relative;
    margin-left: 227px;
    top: 1px;
    left: 6px;
}

.checkbox {
    display: flex;
    align-items: center;
    margin: 3px 0px 0px 24px;
    position: relative;
    top: -5px;
    font-size: 14px;
}

/* 체크박스 모양 변경 */
.check-icon {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #fff;
    border: 1px solid gray;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    border-width: 1.5px;
}
.check-icon::before {
    content: "";
    position: absolute;
    box-sizing: border-box;
    width: 5px;
    height: 8px;
    left: 9px;
    top: 9px;
    transform: translateX(-50%) translateY(-70%) rotateZ(40deg);
    border-right: 1.5px solid gray;
    border-bottom: 1.5px solid rgb(128, 128, 128);
}

[type="checkbox"]:checked + .check-icon {
    border-color: rgb(9, 170, 92);
    background-color: rgb(9, 170, 92);
}
[type="checkbox"]:checked + .check-icon::before {
    border-color: #fff;
}

/* 토글버튼 만들기 */
.toggleSwitch {
    width: 45px;
    height: 20px;
    display: block;
    position: relative;
    border-radius: 30px;
    cursor: pointer;
    margin: 10px;
}

.toggleSwitch2 {
    position: relative;

    cursor: pointer;
    margin: 10px;
}

.toggleSwitch3 {
    position: relative;

    cursor: pointer;
    margin: 10px;
}

.toggleSwitch .toggleButton {
    width: 16px;
    height: 16px;
    position: absolute;
    top: 50%;
    right: 27px;
    transform: translateY(-50%);
    border-radius: 50%;
    background: #fff;
}

/* 토글 ON일때 배경 색 */
#toggle:checked ~ .toggleSwitch {
    background: rgb(9, 170, 92);
}

/* 토글 OFF일때 배경 색 */
#toggle:not(:checked) ~ .toggleSwitch {
    background-color: rgb(165, 173, 184);
}

/* 토글 ON일때 ON글자 속성 */
#toggle:checked ~ .toggleSwitch .toggleSwitch2 {
    color: white;
    font-size: 12px;
    font-weight: 1000;
    left: -5px;
    top: -1px;
}

/* 토글 ON일때 OFF글자 속성 */
#toggle:checked ~ .toggleSwitch .toggleSwitch3 {
    display: none;
}

/* 토글 OFF일때 ON글자 속성 */
#toggle:not(:checked) ~ .toggleSwitch .toggleSwitch2 {
    display: none;
}

/* 토글 OFF일때 OFF글자 속성 */
#toggle:not(:checked) ~ .toggleSwitch .toggleSwitch3 {
    color: white;
    font-size: 11.5px;
    font-weight: 1000;
    left: 8px;
    top: -1px;
}

#toggle:checked ~ .toggleSwitch .toggleButton {
    right: calc(100% - 43px);
    background: #fff;
}

.toggleSwitch,
.toggleButton {
    transition: 0.2s ease-in;
}

.hidden {
    display: none;
}
</style>
