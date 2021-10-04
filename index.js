(function(){  

    window.addEventListener("DOMContentLoaded", function() {
        
        var links = document.getElementsByTagName("a"); 

        var navBarToggler = document.getElementById("navbar-toggler");
        var navBarNav = document.getElementsByTagName("li");
        var navBarResponsiv = document.getElementById("navbarResponsive");

        navBarResponsiv.style.height = "0";
        document.body.style.marginTop = "90px";

            for (let i = 0; i < links.length; i++) {
                links[i].addEventListener("click", (e) => {
                    e.target.blur();
                    this.blur(); 
                })
            }


            navBarToggler.addEventListener("click", (e) => {
                e.stopPropagation();
                    navBarResponsiv.style.transitionProperty = "height";

                    if (navBarResponsiv.offsetHeight < 1) {
                        navBarResponsiv.style.height = "375px";
                        navBarResponsiv.style.transitionDelay = "0.1s";
                        navBarResponsiv.style.transitionDuration = "0.3s";
                        document.getElementsByClassName("navbar-nav")[0].style.display = "inherit";
                        document.getElementsByClassName("navbar-nav")[1].style.display = "inherit";
                        for (let i = 0; i < navBarNav.length; i++) {
                            navBarNav[i].style.display = "block";
                        }
                    } else {
                        navBarResponsiv.style.height = 0;
                        navBarResponsiv.style.transitionDelay = "0.1s";
                        navBarResponsiv.style.transitionDuration = "0.3s";
                        for (let i = 0; i < navBarNav.length; i++) {
                            navBarNav[i].style.display = "none";
                        }
                    }
            })


            window.addEventListener("resize", () => {
                if (window.document.body.offsetWidth > 991) {
                    for (let i = 0; i < navBarNav.length; i++) {
                        navBarNav[i].style.display = "block";
                    }
                } else {
                    for (let i = 0; i < navBarNav.length; i++) {
                        navBarNav[i].style.display = "none";
                    }
                }
            })

    });   

})()