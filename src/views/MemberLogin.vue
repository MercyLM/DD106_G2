<template>
  <div class="login">
    <div class="welcome">
      <div class="movebox">
        <div class="signup nodisplay">
          <img class="signuptitle" src="@/assets/memberlogin/Group 362.png" alt />
          <form class="less-padding" autocomplete="off">
            <div class="formarea">
              <div class="formtext">
                <label>帳號:</label>
                <br />
                <label>密碼:</label>
                <br />
                <label>再次輸入密碼:</label>
                <br />
                <label>e-mail:</label>
              </div>
              <form class="forminputbox">
                <input type="text" v-model="form.name" />
                <input type="text" v-model="form.nick" />
                <div class="from_gender">
                  男
                  <input type="radio" name="gender" v-model="form.gender" value="1" /> 女
                  <input type="radio" name="gender" v-model="form.gender" value="2" />
                  其他
                  <input
                    type="radio"
                    name="gender"
                    v-model="form.gender"
                    value="0"
                  />
                </div>

                <input type="text" v-model="form.acc" />
                <input id="signupPsw" type="password" v-model="form.psw" @blur="checkPsw" />
                <input id="signupRePsw" type="password" v-model="form.rePsw" @blur="checkPsw" />
                <input type="text" v-model="form.email" />
                <input type="text" v-model="form.phone" />
              </form>
            </div>

            <div class="signupsubmit">
              <p>註冊</p>
            </div>
          </form>
        </div>
        <div class="signin">
          <img class="logintitle" src="@/assets/memberlogin/Group 363.png" alt />
          <form class="more-padding" autocomplete="off">
            <span>帳號:</span>
            <input type="text" placeholder="請輸入帳號" v-model="member.acc" />
            <br />
            <label>密碼:</label>
            <input type="password" placeholder="請輸入密碼" v-model="member.psw" />
            <br />
            <div class="signinsubmit" @click="login">
              <p>登入</p>
            </div>
          </form>
        </div>
      </div>
      <div class="leftbox">
        <h1>已經是果粉了?</h1>
        <img class="loginbutton" id="signin" src="@/assets/login.png" @click="changeSignin" alt />
      </div>
      <div class="rightbox">
        <h1>還不是果粉嗎?</h1>
        <img class="signupbutton" id="signup" src="@/assets/signup.png" alt />
      </div>
    </div>
  </div>
</template>

<style>
</style>

<script>
import $ from "jquery";
export default {
  mounted() {
    $("#signup").click(function() {
      $(".movebox").css("transform", "translateX(80%)");
      $(".signin").toggleClass("nodisplay");
      $(".signup").removeClass("nodisplay");
    });

    $("#signin").click(function() {
      $(".movebox").css("transform", "translateX(-10%)");
      $(".signup").addClass("nodisplay");
      $(".signin").removeClass("nodisplay");
    });
  },
  data() {
    return {
      member: {
        acc: "",
        psw: ""
      },
      form: {
        name: "",
        nick: "",
        acc: "",
        psw: "",
        rePsw: "",
        email: "",
        phone: "",
        gender: ""
      }
    };
  },
  methods: {
    login: function() {
      const login = "/api/api_memberLogin.php";

      this.$http
        .post(api, JSON.stringify(this.member))
        .then(res => {
          const data = res.data;

          if (data == "") {
            alert("痾喔，帳號或密碼輸入錯誤。請重新再試一次！");
          } else {
            alert(data.nick + " 您好，歡迎回來！");

            // 1. 傳遞登入狀態到父層
            this.$emit("loginStatus", true);

            // 清除表單
            this.member = { acc: "", psw: "" };

            // 頁面跳轉
            this.$router.push("/main/member/information");

            console.log(this.prevRoute.path);
            
          }
        })
        // eslint-disable-next-line no-console
        .catch(err => console.log(err));
    },
    changeSignin: function() {
      this.form = {
        name: "",
        nick: "",
        acc: "",
        psw: "",
        rePsw: "",
        email: "",
        phone: "",
        gender: ""
      };
    },
    signup: function() {
      const api = "/api/api_memberSignup.php";

      for (let i in this.form) {
        if (this.form[i] == "") {
          alert("請檢查是否所有欄位都有輸入資料");
          return;
        }
      }
      
      this.$http
        .post(api, JSON.stringify(this.form))
        .then(res => {
          const data = res.data;

          if(data.error){

            // eslint-disable-next-line no-console
            console.log(data.error);
          }

          if (data == 0) {
            alert("註冊完成！");

            this.form = {
              name: "",
              nick: "",
              acc: "",
              psw: "",
              rePsw: "",
              email: "",
              phone: "",
              gender: ""
            };

            $(".movebox").css("transform", "translateX(-10%)");
            $(".signup").addClass("nodisplay");
            $(".signin").removeClass("nodisplay");
          } else if (data == 1) {
            alert("此帳號已經被註冊過！");
          }
        });
    },
    checkPsw: function() {
      const form = this.form;

      if (form.rePsw != form.psw) {
        document.getElementById("signupPsw").style.backgroundColor = "red";
        document.getElementById("signupRePsw").style.backgroundColor = "red";
      } else {
        document.getElementById("signupPsw").style.backgroundColor = "";
        document.getElementById("signupRePsw").style.backgroundColor = "";
      }
    }
  }
};
</script>