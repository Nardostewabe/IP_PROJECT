const menu = document.querySelector('#mobile-menu');
const menuLinks = document.querySelector('.navbar__menu');

menu.addEventListener('click',function(){
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
});

let btn = document.querySelector('#btn');
var sidebar = document.querySelector('.sidebar');
btn.onclick = function() {
    sidebar.classList.toggle("active");
}

var pass = document.getElementById('pass');
    var pass2 = document.getElementById('pass2');
    let msg = document.getElementsByClassName('msg')[0]; // Get first element
    let msg2 = document.getElementsByClassName('msg2')[0]; // Get first element

    function f() {
        if (pass.value.length < 8) {
            msg.innerHTML = "Password must have more than 8 characters";
            msg.style.color = "red";
        } else {
            msg.innerHTML = "";
        }
    }

    function g() {
        if (pass.value !== pass2.value) {
            msg2.innerHTML = "Password does not match";
            msg2.style.color = "red";
        } else {
            msg2.innerHTML = "";
        }
    }






