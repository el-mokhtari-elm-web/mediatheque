(function(){  

    window.addEventListener("DOMContentLoaded", function() {

        var links = document.getElementsByTagName("a"); 

        for (let i = 0; i < links.length; i++) {
            links[i].addEventListener("click", (e) => {
                e.target.blur();
                this.blur();
            })
        }

    });   

})()