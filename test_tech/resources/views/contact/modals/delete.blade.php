    {{-- modal de supprimer contact --}}
    <div class="modal fade" id="supprimer-contact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <span class="material-symbols-outlined supprime-icon">
                    warning
                </span>
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                Supprimer le contact
              </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body supprime-content">
              <p>
                Etre-vous sûr de vous vouloir supprimer le contact?
              </p>
              <p>
                Cette opération est irreversible.
              </p>
              <form action="{{route('contacts.destroy')}}" method="POST">
                @csrf
                <input type="hidden" id="id_deleted" name="contact">
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-Light annuler" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-danger valide">Confirme</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    