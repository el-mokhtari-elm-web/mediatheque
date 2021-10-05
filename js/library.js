(function(){  

    window.addEventListener("DOMContentLoaded", function() {

        const navHamburger = (a, b) => {
                navBarToggler.addEventListener("click", (e) => {
                    e.stopPropagation();
                        a.style.transitionProperty = "height";

                        if (a.offsetHeight < 1) {
                            a.style.height = "350px";
                            a.style.transitionDelay = "0.1s";
                            a.style.transitionDuration = "0.3s";
                            //document.getElementsByClassName("navbar-nav")[0].style.display = "inherit";
                            //document.getElementsByClassName("navbar-nav")[1].style.display = "inherit";
                            
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

    });   

})()