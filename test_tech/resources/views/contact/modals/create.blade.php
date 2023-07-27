{{-- le modal qui va affécher pour ajouter un contact --}}
<div class="row">
    <div class="modal fade" id="ajouterContact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un contact</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body detail-contact">
            <form action="{{route('contacts.store')}}" method="POST">
                @csrf
                <div class="nom-contact">
                    <div class="mb-3 prenom">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" name="prenom"
                        value="{{old('prenom')}}">
                    </div>
                    <div class="mb-3 nom">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom"
                        value="{{old('nom')}}">
                    </div>
                </div>
                <div class="nom-contact">
                    @error('prenom')
                    <div class="mb-3 alert alert-danger  error-prenom">
                       {{$message}}
                    </div>
                    @enderror
                    @error('nom')
                    <div class="mb-3 alert alert-danger error-nom">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email"  name="email"
                    value="{{old('email')}}">
                </div>
                @error('email')
                    <div class="mb-3 alert alert-danger">
                       {{$message}}
                    </div>
                @enderror
                <div class="mb-3">
                    <label for="organisation" class="form-label">Entreprise</label>
                    <input type="text" class="form-control" id="organisation" name="organisation"
                    value="{{old('organisation')}}" >
                </div>
                @error('organisation')
                    <div class="mb-3 alert alert-danger">
                       {{$message}}
                    </div>
                @enderror
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <textarea class="form-control" id="adresse" rows="3" name="adresse"
                    >{{old('adresse')}}</textarea>
                </div>
                <div class="code-postal">
                    <div class="mb-3 code">
                        <label for="codePostal" class="form-label ">Code postal</label>
                        <input type="number" class="form-control" id="codePostal" name="codePostal"
                        value="{{old('codePostal')}}" >
                    </div>
                    <div class="mb-3 ville">
                        <label for="codePostal" class="form-label ">Ville</label>
                        <input type="text" class="form-control" id="ville" name="ville"
                        value="{{old('ville')}}">
                    </div>
                </div>
                <div class="code-postal">
                    @error('codePostal')
                    <div class="mb-3 alert alert-danger code">
                       {{$message}}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="statut" class="form-label">Statut</label>
                    <select class="form-select" aria-label="Default select example" id="statut" name="statut">
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

