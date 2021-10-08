(function(){  

    window.addEventListener("DOMContentLoaded", function() {

        var rowUser = document.getElementsByClassName("row-user"); 

        var inputsFiles = document.getElementsByName("img_books[]"); 
        var infosDownload = document.getElementById("infos-download"); 

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

        for (var r = 0; r < rowUser.length; r++) {
            rowUser[r].addEventListener("click", (e) => {
                e.stopPropagation();

                if (e.target.name === "selected-row") {
                    if (e.target.checked === true) {
                        e.target.parentNode.parentNode.getElementsByClassName("update-admin")[0].disabled = false;
                        e.target.parentNode.parentNode.getElementsByClassName("delete-admin")[0].disabled = false;
                    } else {
                        e.target.parentNode.parentNode.getElementsByClassName("update-admin")[0].disabled = true;
                        e.target.parentNode.parentNode.getElementsByClassName("delete-admin")[0].disabled = true;
                    }
                }
            })
        }

        for (var s = 0; s < inputsFiles.length; s++) {
                inputsFiles[s].addEventListener('change',function(e) {
                    e.stopPropagation();
                    let filesName = e.target.files; 

                if (e.target.files.length === 1) { 
                    e.target.nextSibling.nextElementSibling.textContent = filesName[0].name;
                }   else {
                    e.target.nextSibling.nextElementSibling.textContent = "";
                        for (let m = 0; m < filesName.length; m++) {
                            infosDownload.innerText += e.target.files[m].name + "\n";
                        }
                    }
            })
        }

    });   

})()            