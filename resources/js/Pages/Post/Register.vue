<template>
    <a class="text-medium">회원가입</a>
    <div>
        <form @submit.prevent="submit(form.name, form.email, form.password, form.passwordConfirm)">
            <br>
            <label class="name ml-1" for="id">이름</label>
            <br>
            <input class="input-name mbl-1 input-medium" type="text" id="id" v-model="form.name">
            <br>
            <label class="ml-1" for="mail">메일</label>
            <br>
            <input class="mbl-1 input-medium" type="email" id="mail" v-model="form.email">
            <br>
            <label class="ml-1" for="password">비밀번호</label>
            <br>
            <input class="mbl-1 input-medium" type="password" id="password" v-model="form.password">
            <br>
            <label class="ml-1" for="passwordConfirm">비밀번호 확인</label>
            <br>
            <input class="mbl-1 input-medium" type="password" id="passwordConfirm" v-model="form.passwordConfirm">
            <br>
            <button class="mbl-2" type="submit">가입</button>
            <span>/</span>
            <a href="/">취소</a>
        </form>
    </div>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";

    const props = defineProps({
        users: {
            type: Array,
            default: () => [],
        }
    })

    const submit = (name, email, password, passwordConfirm) => {
        var emailCheck = true;
        if(name === "" || email === "" || password === "" || passwordConfirm === ""){
            alert("모든 항목을 입력해주세요."); 
        }
        else if(password !== passwordConfirm){
            alert("입력한 비밀번호가 다릅니다.");
        }
        else{
            for(var i = 0; i < props.users.length; i++){
                if(email === props.users[i].email){
                    emailCheck = false;
                }
            }
            // 컨트롤러에서 메일 중복 확인할때
            // if(emailCheck){
            //     form.post("/posts/addUser", {
            //         email: form.email
            //     });
            // }
            if(emailCheck){
                form.post("/addUser", {
                    email: form.email
                });
            }
            else{
                alert("등록된 이메일입니다.");
            }
        }


    }


    const form = useForm({
        name: "",
        email: "",
        password: "",
        passwordConfirm: "",
    });
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