(function() { 
    window.addEventListener("DOMContentLoaded", function() {

        var formSelectGenre = document.getElementById("form-genres-library");
        var genre = document.getElementById("genre");
        var blocCardBook = document.getElementsByClassName("bloc-card-book");
        var allGenres = document.getElementById("all-genres");
        var pageCover = document.getElementsByClassName("page-cover");
        var srcCover = document.getElementsByClassName("src-cover");

            genre.addEventListener("change", (e) => {
                e.stopPropagation();
                e.preventDefault();
                e.target.blur();

                /*var httpRequest = new XMLHttpRequest();

                httpRequest.open("post", formSelectGenre.action);
                httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                
                httpRequest.onreadystatechange = () => {*/

                    //console.log(httpRequest.responseText)

                    for (let i = 0; i < srcCover.length; i++) {
                        if (e.target.value !== "all-genres") {
                            
                            if (pageCover[i].attributes[0].nodeValue === e.target.value+'-'+i && blocCardBook[i].attributes[0].nodeValue === e.target.value+'-'+i) {
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
            
       // httpRequest.send('genre='+encodeURIComponent(e.target.value));

        //})

    });   

})() 