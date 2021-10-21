(function() { 
    window.addEventListener("DOMContentLoaded", function() {

        var genre = document.getElementById("genre");
        var blocCardBook = document.getElementsByClassName("bloc-card-book");
        var allGenres = document.getElementById("all-genres");
        var pageCover = document.getElementsByClassName("page-cover");
        var msgStatus = document.getElementById("msg-status");


        var progressbar = document.getElementsByClassName("progress-bar");

        for (let i = 0; i < progressbar.length; i++) {


            const outerFunction = () => {
                if (progressbar[i].ariaValueNow !== "undefined") {  // cette fonction sera enfermé dans une closure pour que chaque bouquins ai ça propre gestion du temps dans son espace hétérogène

                    var dateStart = new Date(progressbar[i].ariaValueNow);
                    dateStart = dateStart.getTime() + (3600000); // 3600000 car décallage horaire Maroc php renvoi le fuseau france mais javascript renvoi le fuseau maroc +1h
                    var dateNow = Date.now();

                    if (dateStart > dateNow) { dateStart = (dateStart-(dateStart-dateNow)) }
                    else if (dateNow > dateStart) { dateNow = (dateNow -  (dateNow-dateStart)) } // remise des pendules à l'heure du timestamp car entre la reponse mysql et javascript il y à apparemment un fossé de quelques milisecondes
                    
                    var dateFinish = dateStart+ 6000; // Ici 6 secondes pour testez la fonctionnalité mais pour avoir 3 jours il faut mettre à la place de 6000 (72*24*60*60*1000)

                    var timeLimit = 3;
                    $currentTimeLimit = 100/3;
                    
                    progressbar[i].style.width = `${$currentTimeLimit}%`;
                    progressbar[i].textContent = "jour-"+timeLimit;
        
                        if (dateFinish > Date.now()) {
                        
                            const displayTimer = setInterval(() => {

                                timeLimit-=1;
                                console.log("ok");
                                    $currentTimeLimit = 100/timeLimit;
                                    progressbar[i].style.width = `${$currentTimeLimit}%`;

                                    if (timeLimit === 0) {
                                        progressbar[i].textContent = "délai passé";  
                                            return clearInterval(displayTimer);

                                    } else {
                                        progressbar[i].textContent = "jour-"+timeLimit;
                                    }

                            }, 2000);

                        }   else {
                                progressbar[i].style.width = `${100}%`;
                                progressbar[i].textContent = "délai passé"; 
                                return;
                            }
                } else {
                    progressbar[i].style.width = `${0}%`;
                    progressbar[i].textContent = ""; 
                    return;
                }
            }

            const innerFunction = () => {
                return outerFunction;
            }

            var retrunOuterFunction = outerFunction(); // Pointeur vers la fonction outer pour les raisons expliqué en début de cette fonctions ligne 17
        }

                    
        msgStatus.style.display = "none";

            if (msgStatus.attributes.class.value !== undefined) {
                msgStatus.style.display = "block";
                msgStatus.style.margin = "0";
                msgStatus.style.fontSize = "12px";
                msgStatus.style.lineHeight = "27px";
                msgStatus.style.textAlign = "center";
                msgStatus.style.fontWeight = "bold";
                msgStatus.style.borderRadius = "5px";

                (msgStatus.classList.value === "rent-success" ? msgStatus.style.backgroundColor = "#B0F2B6" : msgStatus.style.backgroundColor = "pink");

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


            genre.addEventListener("change", (e) => {
                e.stopPropagation();
                e.preventDefault();
                e.target.blur();

                    for (let i = 0; i < pageCover.length; i++) {
                        if (e.target.value !== "all-genres") {
                            console.log(pageCover[i].attributes[0].nodeValue+'-'+i, e.target.value+'-'+i)
                            
                            if (pageCover[i].attributes[0].nodeValue === e.target.value+'-'+i) {
                                blocCardBook[i].style.display = "block";
                            } else {
                                blocCardBook[i].style.display = "none";
                            } 
                        } else {
                            console.log(allGenres.id);
                            blocCardBook[i].style.display = "block";
                        }
                    }
            })

    });   

})() 