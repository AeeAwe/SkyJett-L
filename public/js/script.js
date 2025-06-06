"use strict";

window.addEventListener("DOMContentLoaded", () => {
    const burger = document.querySelector(".header-burger");
    const actions = document.querySelector(".header-actions")
    burger.addEventListener("click", (e) => {
        if (e.target.closest(".header-burger")) {
            actions.classList.toggle("active")
            burger.classList.toggle("active");
        }
    })

    

    const checkLocate = () => {
        const loc = location.pathname;
        const links = document.querySelectorAll("nav a");
        links.forEach(link => {
            const href = link.getAttribute("href");
            const path = href.replace(/https?:\/\/[^\/]+(\/\S*)?/g, (m, p = "") => {
                return p || "/";
            });
            if (path == loc){
                link.classList.add("active-link");
            }else if (path.includes("#")){
                link.classList.add("disabled-link");
            };
        });
    };
    checkLocate();
});
