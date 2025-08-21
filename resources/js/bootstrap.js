import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


document.addEventListener("DOMContentLoaded", function () {
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
    const bsCollapse = new bootstrap.Collapse(document.getElementById("navbarNav"), {
        toggle: false
    });

    navLinks.forEach(link => {
        link.addEventListener("click", () => {
            if (window.innerWidth < 992) {
                bsCollapse.hide();
            }
        });
    });

    navbarToggler.addEventListener("click", () => {
        setTimeout(() => {
            if (!document.getElementById("navbarNav").classList.contains("show")) {
                navbarToggler.classList.add("collapsed");
            }
        }, 200);
    });
});