(function(){  
    window.addEventListener("DOMContentLoaded", function() {

        var msgStatus = document.getElementById("msg-status");

        if (msgStatus.attributes.class.value.value != undefined) {
            (msgStatus.classList.value === "succes-registration" ? msgStatus.style.color = "green" : msgStatus.style.color = "red");

            setTimeout(() => {
            msgStatus.style.color = "transparent";
            msgStatus.style.transitionProperty = "color";
            msgStatus.style.transitionDelay = "0";
            msgStatus.style.transitionDuration = "3.25s";
                msgStatus.addEventListener("transitionend", function() {
                    msgStatus.style.display = "none";
                });
            }, 3500);
        }
    });   
})()
