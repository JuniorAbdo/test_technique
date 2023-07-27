{{-- le modal afficher le contcat --}}
  <div class="modal fade" id="show-contact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Détail Contact</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body detail-contact">
          <div class="show-detail">
            <div class="libel">Nom</div>
            <div id="showNom" class="detail-content"></div>
          </div>
          <div class="show-detail">
            <div class="libel">Prénom</div>
            <div id="showPrenom" class="detail-content"></div>
          </div>
          <div class="show-detail">
            <div class="libel">Email</div>
            <div id="showEmail" class="detail-content"></div>
          </div>
          <div class="show-detail">
            <div class="libel">Entreprise</div>
            <div id="showOrganisation" class="detail-content"></div>
          </div>
          <div class="show-detail">
            <div class="libel">Code Postal</div>
            <div id="showCode" class="detail-content"> </div>
          </div>
          <div class="show-detail">
            <div class="libel">Ville</div>
            <div id='showVille' class="detail-content"></div>
          </div>
          <div class="show-detail">
            <div class="libel">Adresse</div>
            <div id="showAdresse" class="detail-content"></div>
          </div>
          <div class="show-detail">
            <div class="libel">Statut</div>
            <div id="showStatut" class="detail-content"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary annuler" data-bs-dismiss="modal">Fermer</button>
          
        </div>
      </div>
    </div>
  </div>