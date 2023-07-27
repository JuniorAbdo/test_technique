
<div class="row">
    <div class="modal fade" id="edit-contact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifer  contact</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body detail-contact">
            <form action="#" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="idEdite"  name="idEdite" value="">
                <div class="nom-contact">
                    <div class="mb-3 prenom">
                        <label for="prenomEdit" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenomEdit" name="prenomEdit"
                        value="{{old('prenomEdit')}}">
                    </div>
                    <div class="mb-3 nom">
                        <label for="nomEdit" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nomEdit" name="nomEdit"
                        value="{{old('nomEdit')}}">
                    </div>
                </div>
                <div class="nom-contact">
                    @error('prenomEdit')
                    <div class="mb-3 alert alert-danger  error-prenom">
                       {{$message}}
                    </div>
                    @enderror
                    @error('nomEdit')
                    <div class="mb-3 alert alert-danger error-nom">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="emailEdit" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="emailEdit"  name="emailEdit"
                    value="{{old('emailEdit')}}">
                </div>
                @error('emailEdit')
                    <div class="mb-3 alert alert-danger">
                       {{$message}}
                    </div>
                @enderror
                <div class="mb-3">
                    <label for="organisationEdit" class="form-label">Entreprise</label>
                    <input type="text" class="form-control" id="organisationEdit" name="organisationEdit"
                    value="{{old('organisationEdit')}}" >
                </div>
                @error('organisationEdit')
                    <div class="mb-3 alert alert-danger">
                       {{$message}}
                    </div>
                @enderror
                <div class="mb-3">
                    <label for="adresseEdit" class="form-label">Adresse</label>
                    <textarea class="form-control" id="adresseEdit" rows="3" name="adresseEdit">
                        {{old('adresseEdit')}}
                    </textarea>
                </div>
                <div class="code-postal">
                    <div class="mb-3 code">
                        <label for="codePostalEdit" class="form-label ">Code postal</label>
                        <input type="number" class="form-control" id="codePostalEdit" name="codePostalEdit"
                        value="{{old('codePostalEdit')}}" >
                    </div>
                    <div class="mb-3 ville">
                        <label for="villeEdit" class="form-label ">Ville</label>
                        <input type="text" class="form-control" id="villeEdit" name="villeEdit"
                        value="{{old('villeEdit')}}">
                    </div>
                </div>
                <div class="code-postal">
                    @error('codePostalEdit')
                    <div class="mb-3 alert alert-danger code">
                       {{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="statutEdit" class="form-label">Statut</label>
                    <select class="form-select" aria-label="Default select example" id="statutEdit" name="statutEdit">
                        <option value="LEAD">LEAD</option>
                        <option value="CLIENT">CLIENT</option>
                        <option value="PROSPECT">PROSPECT</option>
                      </select>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary annuler" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary valide">Valide</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>