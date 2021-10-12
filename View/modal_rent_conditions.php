<!-- Modal -->
<div class="modal fade" id="modal-rent-conditions" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Conditions d'emprunt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span id="close-all" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p>
                    En empruntant ce livre vous acceptez les conditions d'emprunt,
                    a savoir que vous avez 3 jours pour récuperer le livre, au dela il 
                    sera de nouveau disponible à la location.
                </p>
                <p class="text-warning text-center font-weight-bold">Une fois le livre réceptionner vous ne pouvez le garder que durant 3 jours.</p>
                <p class="small font-weight-bold text-center">La médiathèque vous remercie pour votre compréhension et participation à la bonne tenue de ces services.</p>
            </div>


            <div class="modal-footer">
                <button type="button" id="close-modal" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                            
                <form method="post" name="form-modal-rent">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['userId']; ?>">
                    <input type="hidden" name="book_id" value="<?php /*echo $bookId['book_id'];*/ ?>">
                    <input type="submit" class="btn btn-primary" value="Accepter">
                </form>
            </div>
        </div>
    </div>
</div>