(function(){  

    window.addEventListener("DOMContentLoaded", function() {

        var links = document.getElementsByTagName("a"); 
        var navBarToggler = document.getElementById("navbar-toggler");
        var navBarNav = document.getElementById("nav-height").getElementsByTagName("li");
        var navBarResponsiv = document.getElementById("navbarResponsive");
        var hide = document.getElementById("hide");

        const navHamburger = (a, b) => {

            navBarToggler.addEventListener("click", (e) => {
                e.stopPropagation();
                    a.style.transitionProperty = "height";

                    if (a.offsetHeight < 1) {
                        a.style.height = "350px";
                        a.style.transitionDelay = "0.1s";
                        a.style.transitionDuration = "0.3s";
                        
                            setTimeout(() => {
                                for (let i = 0; i < b.length; i++) {
                                    b[i].style.display = "block";
                                }
                            }, 300);
                            
                    } else {
                        a.style.height = 0;
                        a.style.transitionDelay = "0.1s";
                        a.style.transitionDuration = "0.3s";
                        for (let i = 0; i < navBarNav.length; i++) {
                            b[i].style.display = "none";
                        }
                    }
            })
        }

        $('#myModal').modal('show');
        $('#hide').modal('hide');

        if (hide !== null || hide == true) {
            hide.addEventListener("click", () => {
                $('#myModal').modal('hide');
            })
        }
        

        if (navBarResponsiv !== "undefined") {
            navBarResponsiv.style.height = 0;
        }

        if (links !== "undefined") {
            for (let i = 0; i < links.length; i++) {
                links[i].addEventListener("click", (e) => {
                    e.target.blur();
                    this.blur(); 
                })
            }
        }

        navHamburger(navBarResponsiv, navBarNav);

        window.addEventListener("resize", () => {
            if (window.document.body.offsetWidth > 991) {
                for (let i = 0; i < navBarNav.length; i++) {
                    navBarNav[i].style.display = "block";
                }
            } else {
                for (let i = 0; i < navBarNav.length; i++) {
                    navBarNav[i].style.display = "none";
                    navBarResponsiv.style.height = 0;
                }
            }
        })

    });   

})()