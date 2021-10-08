(function(){  
    window.addEventListener("DOMContentLoaded", function() {

        var msgStatus = document.getElementById("msg-status");

        if (msgStatus.attributes.class.value !== undefined) {

            msgStatus.style.fontSize = "13px";
            msgStatus.style.textAlign = "left";
            msgStatus.style.fontWeight = "bold";

            (msgStatus.classList.value === "succes-registration" ? msgStatus.style.color = "green" : msgStatus.style.color = "red");

            setTimeout(() => {
            msgStatus.style.color = "transparent";
            msgStatus.style.transitionProperty = "color";
            msgStatus.style.transitionDelay = "0";
            msgStatus.style.transitionDuration = "4s";
                msgStatus.addEventListener("transitionend", function() {
                    msgStatus.style.display = "none";
                });
            }, 4500);
        }
    });   
})()
