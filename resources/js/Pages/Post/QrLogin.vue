<template>
    <div
        :style="{
            display: TimerCounter === 0 ? 'none' : '',
        }"
    >
        <img class="qr-img drag-disable" :src="`/img/qrcode${qrRand}.png`" />
        <div class="timer">
            <span class="timer-font1">남은 시간</span>
            <br />
            <span class="timer-font2">{{ TimerStr }}</span>
        </div>
        <div class="qr-login-guide">
            <div>
                공용 네트워크, 공용 PC라면 안전을 위해
                <br />
                QR코드로 로그인 해주세요.
            </div>
            <div class="qr-login-guide2">
                네이버 앱<img class="app-img drag-disable" src="/img/app.png" />
                > 렌즈<img
                    class="lens-img drag-disable"
                    src="/img/lens.png"
                />를 눌러 QR코드를 스캔하여 <br />
                보이는 숫자 중
                <div class="random-number">
                    <span class="random-number2">
                        {{ numberRand }}
                    </span>
                </div>
                를 선택하면 로그인 됩니다.
            </div>
        </div>
        <!-- 함수로 팝업창 띄우기 -->
        <!-- <button @click="openPopup" class="">IP보안</button> -->

        <!-- onclick으로 팝업창 띄우기 -->
        <button
            class="popup"
            type="button"
            onclick="window.open('http://127.0.0.1:8000/popup','_blank','width=530, height=750, top=0, left=0')"
        >
            <div>?</div>
        </button>
    </div>
    <div
        :style="{
            display: TimerCounter === 0 ? '' : 'none',
        }"
    >
        <img class="time-over-img1 drag-disable" src="/img/time-over1.png" />
        <label for="restart" class="cursor-pointer">
            <img
                class="time-over-img2 drag-disable"
                src="/img/time-over2.png"
            />
        </label>

        <div class="time-over">
            해당 QR코드의 유효시간이 지났습니다.
            <br />
            다시 로그인을 시도하시겠습니까?
        </div>
        <button
            id="restart"
            class="restart-button"
            type="button"
            @click="restart"
        >
            재시도
        </button>
    </div>

    <form @submit.prevent="submit"></form>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";

// 랜덤 함수
const qrRand = Math.floor(Math.random() * 10); // 0부터 9까지 랜덤 숫자 생성

const numberRand = Math.floor(Math.random() * 100);

// 팝업창 함수
// const openPopup = () => {
//   var popupURL = "http://127.0.0.1:8000/popup";
//   var popupProperties = "width=600,height=400";
//   window.open(popupURL, "Popup", popupProperties);
// }

//타이머

const Timer = ref(null);
const TimerCounter = ref();
const TimerStr = ref("00분 05초");

const restart = () => {
    TimerCounter.value = 5;
    TimerStr.value = "00분 05초";
    timerStart();
};

const timerStart = () => {
    TimerCounter.value = 5;
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

onMounted(() => {
    if (Timer.value != null) {
        timerStop(Timer.value);
        Timer.value = null;
    }
    Timer.value = timerStart();
});

onBeforeUnmount(() => {
    if (Timer.value) {
        timerStop(Timer.value);
    }
});
</script>

<style scoped>
.time-over {
    text-align: center;
    position: relative;
    font-size: 12.5px;
    font-weight: 700;
    top: 50px;
    color: rgb(142, 142, 142);
    padding: 0px;
}

.time-over-img1 {
    position: relative;
    display: inline;
    width: 52px;
    height: 52px;
    top: 36px;
    left: 203px;
}

.time-over-img2 {
    position: relative;
    display: inline;
    width: 23px;
    height: 21px;
    top: 135.5px;
    left: 144px;
}

.restart-button {
    position: relative;
    top: 59px;
    left: 223px;
    font-size: 15px;
    color: rgb(9, 170, 92);
    font-weight: 700;
}

.timer {
    position: relative;
    top: -233px;
    left: 290px;
}

.timer-font1 {
    display: flex;
    font-size: 12.5px;
    font-weight: 600;
    position: relative;
    top: 205px;
}

.timer-font2 {
    display: flex;
    color: rgb(9, 170, 92);
    font-weight: 700;
    font-size: 16px;
    position: relative;
    top: 180.5px;
}

.random-number {
    display: inline-block;
    position: relative;
    background-color: black;
    color: white;
    width: 27px;
    height: 16px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 900;
    top: 3px;
    margin-top: -3px;
}

.random-number2 {
    margin: 0px;
    padding: 0px;
    position: relative;
    top: -2px;
}

.qr-img {
    display: inline;
    width: 96px;
    height: 96px;
    position: relative;
    top: 11px;
    left: 181px;
}

.app-img {
    display: inline;
    position: relative;
    width: 14px;
    height: 16px;
    top: -2px;
}

.lens-img {
    display: inline;
    position: relative;
    width: 16px;
    height: 16px;
    top: -2px;
}

/* 로그인 가이드 */
.qr-login-guide {
    text-align: center;
    position: relative;
    font-weight: 600;
    font-size: 13.7px;
    top: -28px;
}

.qr-login-guide2 {
    position: relative;
    font-weight: 400;
    font-size: 12px;
    top: 0px;
}

/* 팝업 */
.popup {
    position: relative;
    margin-left: 370px;
    border-radius: 50%;
    width: 11px;
    height: 11px;
    background-color: rgb(109, 116, 133);
    font-size: 9px;
    color: white;
    top: -31px;
    left: -20px;
}

/* 드래그 방지 */
.drag-disable {
    -webkit-user-select: none; /* Webkit 브라우저에서 텍스트 선택 방지 */
    -moz-user-select: none; /* Firefox에서 텍스트 선택 방지 */
    -ms-user-select: none; /* IE/Edge에서 텍스트 선택 방지 */
    user-select: none; /* 표준화된 텍스트 선택방지 */
}

.qr-login-text {
    position: relative;
    top: -4px;
    left: 13px;
    font-weight: 600;
}

.cursor-pointer {
    cursor: pointer;
}

.hidden {
    display: none;
}
</style>
