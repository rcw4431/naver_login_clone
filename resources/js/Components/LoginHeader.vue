<template>
    <div class="login-header">
        <div
            v-bind:class="isId ? 'id-login' : 'id-login-off'"
            @click="changeStyle(0)"
        >
            <img
                class="id-login-img"
                :src="isId ? 'img/id-on.png' : '/img/id-off.png'"
                width="17"
            />
            <span class="id-login-text">ID/전화번호</span>
        </div>
        <div
            v-bind:class="isOTP ? 'otp-login' : 'otp-login-off'"
            @click="
                changeStyle(1);
                changeErrorFalse();
            "
        >
            <img
                class="otp-login-img"
                :src="isOTP ? '/img/otp-on.png' : '/img/otp-off.png'"
                width="17"
            />
            <span class="otp-login-text">일회용 번호</span>
        </div>
        <div
            v-bind:class="isQR ? 'qr-login' : 'qr-login-off'"
            @click="
                changeStyle(2);
                changeErrorFalse();
            "
        >
            <img
                class="qr-login-img"
                :src="isQR ? '/img/qr-on.png' : '/img/qr-off.png'"
                width="17"
            />
            <span class="qr-login-text">QR코드</span>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const isId = ref(true);
const isOTP = ref(false);
const isQR = ref(false);

const emit = defineEmits(["changeCurrentIndex", "changeErrorState"]);

const changeStyle = (index) => {
    if (index == 0) {
        isId.value = true;
        isOTP.value = false;
        isQR.value = false;
    } else if (index == 1) {
        isId.value = false;
        isOTP.value = true;
        isQR.value = false;
    } else {
        isId.value = false;
        isOTP.value = false;
        isQR.value = true;
    }

    emit("changeCurrentIndex", index);
    console.log("선택된 index : ", index);
};

const changeErrorFalse = () => {
    emit("changeErrorState", false);
};
</script>

<style scoped>
.login-header {
    display: flex;
    justify-content: center;
    text-align: center;
    position: relative;
    margin: 37px 0px 0px 0px;
    top: 1px;
    left: 1px;
}

.id-login {
    border-top-width: 1px;
    border-left-width: 1px;
    border-right-width: 1px;
    border-bottom-width: 0px;
    border-radius: 13px 13px 0px 0px;
    width: 154px;
    height: 54px;
    font-size: 16px;
    font-weight: 700;
    justify-content: center;
    align-items: center;
    vertical-align: middle;
    background-color: rgb(255, 255, 255);
    position: relative;
    top: -1px;
    left: 0px;
    z-index: 100;
    cursor: pointer;
}

.id-login-off {
    border-top-width: 0px;
    border-left-width: 0px;
    border-right-width: 0px;
    border-bottom-width: 0px;
    border-radius: 13px 0px 0px 0px;
    width: 154px;
    height: 55px;
    font-size: 16px;
    font-weight: 700;
    justify-content: center;
    align-items: center;
    vertical-align: middle;
    background-color: rgb(245, 246, 247);
    color: rgb(119, 119, 119);
    position: relative;
    cursor: pointer;
    top: -1px;
    left: 0px;
    z-index: 10;
}

.otp-login {
    border-top-width: 1px;
    border-left-width: 1px;
    border-right-width: 1px;
    border-bottom-width: 0px;
    border-radius: 13px 13px 0px 0px;
    width: 154px;
    height: 54px;
    font-size: 16px;
    font-weight: 700;
    justify-content: center;
    align-items: center;
    vertical-align: middle;
    background-color: rgb(255, 255, 255);
    position: relative;
    cursor: pointer;
    top: -1px;
    left: -1.5px;
    z-index: 100;
}

.otp-login-off {
    border-top-width: 0px;
    border-left-width: 1px;
    border-right-width: 1px;
    border-bottom-width: 0px;
    border-radius: 0px 0px 0px 0px;
    width: 154px;
    height: 55px;
    font-size: 16px;
    font-weight: 700;
    justify-content: center;
    align-items: center;
    vertical-align: middle;
    background-color: rgb(245, 246, 247);
    color: rgb(119, 119, 119);
    position: relative;
    cursor: pointer;
    top: -1px;
    left: -1px;
}

.qr-login {
    border-top-width: 1px;
    border-left-width: 1px;
    border-right-width: 1px;
    border-bottom-width: 0px;
    border-radius: 13px 13px 0px 0px;
    width: 154px;
    height: 54px;
    font-size: 16px;
    font-weight: 700;
    justify-content: center;
    align-items: center;
    vertical-align: middle;
    background-color: rgb(255, 255, 255);
    position: relative;
    cursor: pointer;
    top: -1px;
    left: -2px;
    z-index: 100;
}

.qr-login-off {
    border-top-width: 0px;
    border-left-width: 0px;
    border-right-width: 0px;
    border-bottom-width: 0px;
    border-radius: 0px 13px 0px 0px;
    width: 154px;
    height: 55px;
    font-size: 16px;
    font-weight: 700;
    justify-content: center;
    align-items: center;
    vertical-align: middle;
    background-color: rgb(245, 246, 247);
    color: rgb(119, 119, 119);
    position: relative;
    cursor: pointer;
    top: -1px;
    left: -1.5px;
}

/* 로그인 옵션 이미지, 텍스트 */
.id-login-img {
    position: relative;
    top: 18px;
    left: 28px;
}

.id-login-text {
    position: relative;
    top: -2px;
    left: 13px;
    font-weight: 600;
}

.otp-login-img {
    position: relative;
    top: 16px;
    left: 29px;
}

.otp-login-text {
    position: relative;
    top: -4px;
    left: 14px;
    font-weight: 600;
}
.qr-login-img {
    position: relative;
    top: 16px;
    left: 41px;
}

.qr-login-text {
    position: relative;
    top: -4px;
    left: 13px;
    font-weight: 600;
}
</style>
