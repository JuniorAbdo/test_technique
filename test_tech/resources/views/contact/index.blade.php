@extends('layouts.template')
@section('title','Liste de constact')
@section('content')
<div class="container-fluid" id="monConteneur">
    <div class="row">
        <div class="col main-head" >
            <h1>Liste contact</h1>
        </div>
    </div>
    <div class="row ">
        {{-- zone de recherche --}}
        <div class="col search-section">
            <div class="form">
                <form action="{{route('contacts.search')}}" method="POST">
                    @csrf
                    <input class="form-control" type="text" placeholder="Search..." id="search" name="search">
                    <button type="submit" class="btn-search">
                        <span class="material-symbols-outlined">
                            search
                        </span>
                    </button>
                </form>
            </div>
            <div>
            {{-- button pour ajouter un nouveau contcat --}}
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajouterContact">
                    + Ajouter
                  </button>
            </div>
        </div>
    </div>
    <div class="row table-conteent" id="resultDiv">
      {{-- fétcher le data dans une table --}}
        <table class="table">
            <thead class="table-head">
                <tr>
                  <th scope="col">NOM DU CONTACT</th>
                  <th scope="col">SOCIÉTÉ</th>
                  <th scope="col">STATUT</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
               @forelse ($contacts as $contact)
                <tr>
                    
                    <td>
                        <div>
                            {{$contact->nom_contact.' '.$contact->prenom}}</td>
                        </div>
                    <td>
                        <div>
                            {{$contact->nom_organisation}}</td>
                        </div>
                            
                    <td >
                        <div class="statut">
                            {{$contact->statut}}</td>
                        </div>
                    <td>
                        <div class="actions">
                            <div class="visible">
                                <button value="{{$contact->id}}" type="button" class="show_contact">
                                    <span class="material-symbols-outlined">
                                        visibility
                                    </span>
                                </button>
                               
                            </div>
                            <div class="edit">
                               
                                <button value="{{$contact->id}}" type="button" class="edit_contact">
                                    <span class="material-symbols-outlined">
                                        edit
                                    </span>
                                </button>
                               
                            </div>
                            <div class="delete">
                                <button value="{{$contact->id}}" type="button" class="delete_contact">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
               @empty
                   <tr>
                        <td colspan="4" class="empty">
                            aucun contact trouvé
                        </td>
                    </tr>
               @endforelse
                
               
              </tbody>
          </table>
        </div>
    
    {{-- Modal  ajouter contact --}}
        @include('contact.modals.create')

    {{-- modal de supprimer contact --}}
        @include('contact.modals.delete')

    {{-- modal de modifaction d'un  contact  --}}
        @include('contact.modals.edit')
    {{-- la fin du modal de modification contact --}}
   
    {{-- modal afficher le conatact --}}
    @include('contact.modals.show')

    {{-- modal contact doublon --}}
    @include('contact.modals.doublon')

    {{-- modal organisation doublon --}}
    @include('contact.modals.organisationDoublon')
    {{-- pagination links --}}
    <div>
        {{$contacts->links()}}
    </div>
</div>

@endsection
{{-- ce script s'écrié ici car ila une relation enter le data qui on dans
cette vue $contacts --}}
@section('script')
 <script type="module">
    $(document).ready(function() {
        //extraction les donner que on a besoin
    let allContcats = @json($allContacts);
    //exit variable pour afficher le modal contact  doublon
    let exist=@json(session('contact_exist'));
    //organisationExit de méme pour afficher le modal oraganisation
    //doublon
    let organisationExist = @json(session('organisation_exist'));
    //au cas de fails la validation des données pour réafficher
    //le modal d'ajoute avec des errors et des ancienne données
    let ajouterFails = @json(session('ajouter-fails'));
    //la meme au cas de fails de modifaction
    let modiferFails = @json(session('update-fails'));
    //extraction l'id de contact qui on va modifer
    let idEdite=@json(session('idEdite'));
    //affichege des modals
    if(exist){
        $('#contact-doublon').modal('show');
    }
    if(organisationExist){
        $('#organisation-doublon').modal('show');
    }
    if(ajouterFails){
        $('#ajouterContact').modal('show');
    }
    if(modiferFails){
        $('#editForm').attr('action','/contacts/'+idEdite+'/update');
        $('#idEdite').val(idEdite);
        $('#edit-contact').modal('show');
    }
    //avant afficcher le modal il faut remplire les champ par l'ancienne données
    $('.edit_contact').on('click',function(e){
        e.preventDefault();
        let contact_id=$(this).val();
        let ContactEdit = allContcats.find(contact=>contact.contactId==contact_id);
        $('#nomEdit').val(ContactEdit.nom);
        $('#prenomEdit').val(ContactEdit.prenom);
        $('#villeEdit').val(ContactEdit.ville);
        $('#emailEdit').val(ContactEdit.email);
        $('#organisationEdit').val(ContactEdit.organisationNom);
        $('#codePostalEdit').val(ContactEdit.codePostal);
        $('#adresseEdit').val(ContactEdit.adresse);
        $('#statutEdit').val(ContactEdit.statut);
        $('#idEdite').val(ContactEdit.contactId);
        $('#editForm').attr('action','/contacts/'+ContactEdit.contactId+'/update')
        $('#edit-contact').modal('show');

    });
    //afficher le modal qui va contient les données de contact
    $('.show_contact').on('click',function(e){
        e.preventDefault();
        let contact_id=$(this).val();
        let ContactEdit = allContcats.find(contact=>contact.contactId==contact_id);
        console.log(ContactEdit);
        $('#showNom').text(ContactEdit.nom);
        $('#showPrenom').text(ContactEdit.prenom);
        $('#showVille').text(ContactEdit.ville);
        $('#showEmail').text(ContactEdit.email);
        $('#showOrganisation').text(ContactEdit.organisationNom);
        $('#showCode').text(ContactEdit.codePostal);
        $('#showAdresse').text(ContactEdit.adresse);
        $('#showStatut').text(ContactEdit.statut);
        $('#show-contact').modal('show');
    });
});
 </script>


@endsection
