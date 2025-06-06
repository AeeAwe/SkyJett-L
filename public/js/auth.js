"use strict";

window.addEventListener("DOMContentLoaded", () => {  
    const container = document.querySelector(".auth-container");
    const register = document.querySelector(".register");
    const login = document.querySelector(".login");
    const auth__switch_box = document.querySelector(".auth-toggle");

    auth__switch_box.addEventListener("click", e => {
        const target = e.target;
        if (target.classList.contains("sign-up")){
            if (target.classList.contains("active")){
                null;
            } else {
                target.classList.add("active");
                target.previousElementSibling.classList.remove("active");
                login.style.display = "none";
                register.style.display = "flex";
                if (container.lastElementChild.tagName == "UL"){
                    container.lastElementChild.remove();
                }
            }
        } else if (target.classList.contains("sign-in")){
            if (target.classList.contains("active")){
                null;
            } else {
                target.classList.add("active");
                target.nextElementSibling.classList.remove("active");
                login.style.display = "flex";
                register.style.display = "none";
                if (container.lastElementChild.tagName == "UL"){
                    container.lastElementChild.remove();
                }
            }
        };
    });

    const mask = event => {
        const {target, keyCode, type} = event;
        const pos = target.selectionStart;
        if (pos < 3) event.preventDefault();
        const matrix = '+7 (___) ___-__-__';
        let i = 0;
        const def = matrix.replace(/\D/g, '');
        const val = target.value.replace(/\D/g, '');
        let newValue = matrix.replace(/[_\d]/g, a => (i < val.length ? val[i++] || def[i] : a));
        i = newValue.indexOf('_');
        if (i !== -1){
            i < 5 && (i = 3);
            newValue = newValue.slice(0, i);
        };
        let reg = matrix.substring(0, target.value.length).replace(/_+/g, a => `\\d{1,${a.length}}`).replace(/[+()]/g, '\\$&');
        reg = new RegExp(`^${reg}$`);
        if (!reg.test(target.value) || target.value.length < 5 || keyCode > 47 && keyCode < 58){
            target.value = newValue;
        };
        if (type === 'blur' && target.value.length < 5) target.value = '';
    };

    const phone_input = document.querySelector(".auth-form input[id='register-phone']");
    phone_input.addEventListener('input', mask);
    phone_input.addEventListener('focus', mask);
    phone_input.addEventListener('blur', mask);
    phone_input.addEventListener('keydown', mask);
});