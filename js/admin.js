(function(){  

    window.addEventListener("DOMContentLoaded", function() {

        var rowUser = document.getElementsByClassName("row-user"); 

        var inputsFiles = document.getElementsByName("img_books[]"); 
        var infosDownload = document.getElementById("infos-download"); 

        var deleteByAdmin = document.getElementsByClassName("delete-by-admin");
        //deleteByAdmin.style.backgroundImage = "url('../assets/svg/not-available.svg')";

        for (var i = 0; i < deleteByAdmin.length; i++) {
            //rowUser[i].addEventListener("click", (e) => {
                //e.stopPropagation();


                if (deleteByAdmin[i].parentNode.id.length > 0) {
                    console.log(deleteByAdmin[i].parentNode.id);
                    deleteByAdmin[i].style.backgroundImage = "url('../assets/svg/delete.svg')";
                } else {
                    console.log("rien");
                    deleteByAdmin[i].style.backgroundImage = "url('../assets/svg/not-available.svg')";
                }

                //console.log(deleteByAdmin[i].value);
            //})
        }


        for (var i = 0; i < rowUser.length; i++) {
            
            rowUser[i].addEventListener("change", (e) => {
                e.stopPropagation();
                
                if (e.target.name === "types_users") {
                    let formsUpdateAndDelete = e.target.parentNode.parentNode.getElementsByTagName("form");
                    console.log(formsUpdateAndDelete);
                    console.log(formsUpdateAndDelete[0].name);
                    for (let d = 0; d < formsUpdateAndDelete.length; d++) {
                        if (formsUpdateAndDelete[d].name === "form-update") {
                            console.log(formsUpdateAndDelete[d].name);
                            e.target.parentNode.nextElementSibling.childNodes[1].childNodes[0].value = e.target.value;
                        } else {
                            return;
                        }
                    }
                }

            })
        }


        // for activation the row in array user by input checkbox in admin to update or delete one user 
        // on default all rows is desactivates.
        for (var r = 0; r < rowUser.length; r++) {
            rowUser[r].addEventListener("click", (e) => {
                e.stopPropagation();

                //registrationDate = e.target.parentNode.parentNode.getElementsByClassName("delete-by-admin")[0].value;
                //registrationDate = registrationDate;

                if (e.target.name === "selected-row") {
                    let statutSelected = e.target.parentNode.parentNode.getElementsByClassName("statut-selected")[0];
                    let statutInjected = e.target.parentNode.parentNode.getElementsByClassName("statut-injected")[0];

                    if (e.target.checked === true) {
                        e.target.parentNode.parentNode.getElementsByClassName("update-by-admin")[0].disabled = false;
                        e.target.parentNode.parentNode.getElementsByClassName("delete-by-admin")[0].disabled = false;

                        statutSelected.addEventListener("change", (e) => {
                            e.stopPropagation();
                            statutSelected.value = e.target.value;
                            statutInjected.value = statutSelected.value;
                        })
                        statutInjected.value = statutSelected.value;

                    } else {
                        e.target.parentNode.parentNode.getElementsByClassName("update-by-admin")[0].disabled = true;
                        e.target.parentNode.parentNode.getElementsByClassName("delete-by-admin")[0].disabled = true;
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