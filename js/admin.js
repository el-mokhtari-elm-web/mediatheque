(function(){  

    window.addEventListener("DOMContentLoaded", function() {

        var rowUser = document.getElementsByClassName("row-user"); 
        var inputsFiles = document.getElementsByName("book_img[]"); 
        var infosDownload = document.getElementById("infos-download"); 
        var deleteByAdmin = document.getElementsByClassName("delete-by-admin");
        var msgStatus = document.getElementById("msg-status");

        msgStatus.style.display = "none";

        if (msgStatus.attributes.class.value !== undefined) {
            msgStatus.style.display = "block";

            msgStatus.style.fontSize = "13px";
            msgStatus.style.textAlign = "left";
            msgStatus.style.fontWeight = "bold";

            (msgStatus.classList.value === "success-insertion-book" || msgStatus.classList.value === "success-insertion-user" ? msgStatus.style.color = "green" : msgStatus.style.color = "red");

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


        for (var i = 0; i < deleteByAdmin.length; i++) {
                if (deleteByAdmin[i].parentNode.id.length > 0) {
                    console.log(deleteByAdmin[i].parentNode.id);
                    deleteByAdmin[i].style.backgroundImage = "url('../assets/svg/delete.svg')";
                } else {
                    console.log("rien");
                    deleteByAdmin[i].style.backgroundImage = "url('../assets/svg/not-available.svg')";
                }
        }


        // for activation the row in array user by input checkbox in admin to update or delete one user 
        // on default all rows is desactivates.
        for (var r = 0; r < rowUser.length; r++) {
            rowUser[r].addEventListener("click", (e) => {
                e.stopPropagation();

                if (e.target.name === "selected-row") {
                    let statutSelected = e.target.parentNode.parentNode.getElementsByClassName("statut-selected")[0];
                    let statutInjected = e.target.parentNode.parentNode.getElementsByClassName("statut-injected")[0];

                    let typeSelected = e.target.parentNode.parentNode.getElementsByClassName("type-selected")[0];
                    let typeInjected = e.target.parentNode.parentNode.getElementsByClassName("type-injected")[0];

                    if (e.target.checked === true) {
                        e.target.parentNode.parentNode.getElementsByClassName("update-by-admin")[0].disabled = false;
                        if (e.target.parentNode.parentNode.getElementsByClassName("delete-by-admin")[0] != undefined) {
                            let checkForDelete = e.target.parentNode.parentNode.getElementsByClassName("delete-by-admin")[0];
                            checkForDelete.disabled = false; 
                        } 

                        statutSelected.addEventListener("change", (e) => {
                            e.stopPropagation();
                            statutSelected.value = e.target.value;
                            statutInjected.value = statutSelected.value;
                        })
                        statutInjected.value = statutSelected.value;

                        typeSelected.addEventListener("change", (e) => {
                            e.stopPropagation();
                            typeSelected.value = e.target.value;
                            typeInjected.value = typeSelected.value;
                        })
                        typeInjected.value = typeSelected.value;

                    } else {
                        e.target.parentNode.parentNode.getElementsByClassName("update-by-admin")[0].disabled = true;
                        if (e.target.parentNode.parentNode.getElementsByClassName("delete-by-admin")[0] != undefined) {
                            let checkForDelete = e.target.parentNode.parentNode.getElementsByClassName("delete-by-admin")[0];
                            checkForDelete.disabled = false; 
                        } 
                    }
                }
            })
        }


        for (var s = 0; s < inputsFiles.length; s++) {
                inputsFiles[s].addEventListener('change',function(e) {
                    e.stopPropagation();
                    let filesName = e.target.files; 

                if (e.target.files.length > 0) { 
                    infosDownload.innerText = "";
                    for (let m = 0; m < filesName.length; m++) {
                        infosDownload.innerText += e.target.files[m].name + "\n";
                    }
                }
            })
        }
        

    });   

})()            