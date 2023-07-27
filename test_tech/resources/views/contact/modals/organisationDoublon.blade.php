
    {{-- modal de contact doublon --}}
    <div class="modal fade" id="organisation-doublon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <span class="material-symbols-outlined supprime-icon">
                    warning
                </span>
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                Doublon
              </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body supprime-content">
              <p>
                Une entreprise existe déjà avec le même nom .
              </p>
              <p>
                Être-vous sur de vouloirs ajouté ce contact?
              </p>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-Light annuler" data-bs-dismiss="modal">Annuler</button>
                <a href="{{route('contacts.doublon')}}">
                    <button type="submit" class="btn btn-danger valide">Confirme</button>
                </a>
            </div>
          </div>
        </div>
      </div>
   