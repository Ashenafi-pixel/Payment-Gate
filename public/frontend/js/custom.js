$(document).ready(function () {
    // Function for scroll on sidebar with modal's on FE
    let _classes = '.onboard-modal .onboard-slider-container';
    if ($(_classes).length) {
        $(_classes).slick({
            dots: true,
            infinite: false,
            adaptiveHeight: true,
            slidesToShow: 1,
            slidesToScroll: 1
        });
        $('.onboard-modal').on('shown.bs.modal', function (e) {
            $(_classes).slick('setPosition');
        });
    }
    setTimeout(firstVisit, 1000);
})
$(window).on("load",function () {
    AOS.init();
})
function firstVisit() {

    let is_modal_show = localStorage.getItem('alreadyShow');
    if (is_modal_show != 'already shown') {
        $('.onboard-modal.show-on-load').modal( 'show');
        localStorage.setItem('alreadyShow', 'already shown');
    }
}
//Function for password strength
  const togglePassword = document.querySelector('#togglePassword');
  const password       = document.querySelector('#psw');
  const text           = document.querySelector('.material-symbols-outlined')
  if(togglePassword){
  togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    if(type == 'password')
    text.innerHTML = 'visibility';
    else
    text.innerHTML = 'visibility_off';
});}
function isGood(password) {
    let password_strength = document.getElementById("password-text");

    if (password.length == 0) {
      password_strength.innerHTML = "";
      return;
    }
    let regex = [];
    regex.push("[A-Z]");
    regex.push("[a-z]");
    regex.push("[0-9]");
    regex.push("[$@$!%*#?&]");

    let passed = 0;
    for (let i = 0; i < regex.length; i++) {
      if (new RegExp(regex[i]).test(password)) {
        passed++;
      }
    }

    let strength = "";
    switch (passed) {
      case 0:
      case 1:
      case 2:
        strength = "<small class='progress-bar bg-danger rounded mt-1 ' style='width: 40%; font-size:9px'>Weak</small>";
        break;
      case 3:
        strength = "<small class='progress-bar bg-warning rounded mt-1' style='width: 60%; font-size:9px'>Medium</small>";
        break;
      case 4:
        strength = "<small class='progress-bar bg-success rounded mt-1' style='width: 100%; font-size:9px'>Strong</small>";
        break;
    }
    password_strength.innerHTML = strength;
  }
  //Function for OTP page
  let digitValidate = function(ele) {
    ele.value = ele.value.replace(/[^0-9]/g, '');
}

let tabChange = function(val) {
    let ele = document.querySelectorAll('.otp');
    if (ele[val - 1].value != '') {
        ele[val].focus()
    } else if (ele[val - 1].value == '') {
        ele[val - 2].focus()
    }

}
