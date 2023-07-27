<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      
        //récupérer 10 enregistrement dans la table contact
        // on va l'envoyer au vue index situer dans le dossier contact
        $contacts = Contact::selectRaw('contact.nom AS nom_contact, contact.prenom,
                   contact.id As id, organisation.nom AS nom_organisation, statut')
                   ->join('organisation', 'organisation.id', '=', 'contact.organisation_id')
                   ->orderBy('nom_contact', 'asc')
                   ->orderBy('nom_organisation', 'asc')
                   ->orderBy('statut', 'asc')
                   ->paginate(10);
         return view('contact.index', ['contacts'=>$contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation selon le rules donne
        $validator = Validator::make($request->all(),
        [
            'nom'=>'required|regex:/^[A-Za-z\s]+$/',
            'prenom'=>'required|regex:/^[A-Za-z\s]+$/',
            'email'=>'required|email',
            'organisation'=>'required|regex:/^[A-Za-z\d\s]+$/',
            'codePostal'=>'numeric',
        ],
        [
            'required'=>'ce champ est obligatoire',
            'email'=>'email nom valide',
            'alpha'=>'uniquement des lettres',
            'alpha_num'=>'uniquement les lettres et le chiffres',
            'numeric'=>'uniquement les chiffres'
        ]
    );
    if($validator->fails()){
        return redirect('/contacts')
        ->withInput()
        ->withErrors($validator)
        ->with('ajouter-fails','fails');
    }
    //suppression des session suivants car elles sont lier au affichage
    //des modals d'existance de ce contact au bien cette organisation
    $request->session()->forget('contact_exist');
    $request->session()->forget('organisation_exist');

    //verifer si il y a déja un contact avec le méme nom et la
    //méme prénom

    $contact = Contact::where('nom',ucwords($request->nom))
        ->where('prenom',ucwords($request->prenom))->get();
        //créer les ssion au cas d'existe conatct ou bien organistion
        //pour afficher les modal de doublon
        if(count($contact)>0){
            session(['contactDoublon'=>$request->all()]);
            return redirect('/contacts')
            ->with('contact_exist','exist');
        }
        $doubelOrganisation = Organisation::Where('nom',ucwords( $request->organisation))
        ->get();
        if(count($doubelOrganisation)>0){
            session(['contactDoublon'=>$request->all()]);
            return redirect('/contacts')
            ->with('organisation_exist','exist');
        }
        // au cas normal va ajouter le contact et l'organisation
        $organisation = new Organisation();
        $organisation->adresse = $request->adresse;
        $organisation->ville = ucwords($request->ville);
        $organisation->cle = Str::random(32);
        $organisation->nom = ucwords( $request->organisation);
        $organisation->code_postal = $request->codePostal;
        $organisation->statut = $request->statut;
        $organisation->save();
        //ajouter  contact
        $contact = new Contact();
        $contact->nom = ucwords($request->nom);
        $contact->prenom = ucwords($request->prenom);
        $contact->cle = Str::random(32);
        $contact->e_mail = strtolower($request->email);
        // j'ai ajouter c'est champs static car il ne sont pas nullable
        //et nous n'avons pas c'est champs dans le formulaire
        $contact->telephone_fixe="+212 56565766";
        $contact->service = 'gestion';
        $contact->fonction = 'comptable';
        $contact->organisation()->associate($organisation);
        $contact->save();
        return  redirect('/contacts')
        ->with('contcat-ajouter','ajouter');
    }

    //la fonction qui va ajouter les doublon au cas de confirmation
     public function AddDoubon(){
        // au cas de confirmation qui vous voulez ajouter le doublon
        $contactDouble = session('contactDoublon');
        $organisation = new Organisation();
        $organisation->adresse = $contactDouble["adresse"];
        $organisation->ville = ucwords($contactDouble['ville']);
        $organisation->cle = Str::random(32);
        $organisation->nom =ucwords( $contactDouble['organisation']);
        $organisation->code_postal = $contactDouble['codePostal'];
        $organisation->statut = $contactDouble['statut'];
        $organisation->save();
        //ajouter  contact
        $contact = new Contact();
        $contact->nom = ucwords($contactDouble['nom']);
        $contact->prenom = ucwords($contactDouble['prenom']);
        $contact->cle = Str::random(32);
        $contact->e_mail = strtolower($contactDouble['email']);
        // j'ai ajouter c'est champs static car il ne sont pas nullable
        //et nous n'avons pas c'est champs dans le formulaire
        $contact->telephone_fixe="+212 56565766";
        $contact->service = 'gestion';
        $contact->fonction = 'comptable';
        $contact->organisation()->associate($organisation);
        $contact->save();
        return  redirect('/contacts');
        
     }

    

    
    public function update(Request $request, Contact $contact)
    {
                //validation selon les rules
                $validator = Validator::make($request->all(),
                [
                    'nomEdit'=>'required|regex:/^[A-Za-z\s]+$/',
                    'prenomEdit'=>'required|regex:/^[A-Za-z\s]+$/',
                    'emailEdit'=>'required|email',
                    'organisationEdit'=>'required|regex:/^[A-Za-z\d\s]+$/',
                    'codePostalEdit'=>'numeric',
                ],
                [
                    'required'=>'ce champ est obligatoire',
                    'email'=>'email nom valide',
                    'alpha'=>'uniquement des lettres',
                    'alpha_num'=>'uniquement les lettres et le chiffres',
                    'numeric'=>'uniquement les chiffres'
                ]
            );
            if($validator->fails()){
                return redirect('/contacts')
                ->withInput()
                ->withErrors($validator)
                ->with('update-fails','fails')
                ->with('idEdite',$request->idEdite);
            }
            //update contact et organisation
       $contact->nom=ucwords($request->nomEdit);
       $contact->prenom = ucwords($request->prenomEdit);
       $contact->e_mail = strtolower($request->emailEdit);
       $contact->save();
       $oragnisation = $contact->organisation;
       $oragnisation->nom = ucwords($request->organisationEdit);
       $oragnisation->adresse=$request->adresseEdit;
       $oragnisation->ville= ucwords($request->villeEdit);
       $oragnisation->code_postal = $request->codePostalEdit;
       $oragnisation->statut = $request->statutEdit;
       $oragnisation->save();
       return redirect('/contacts');
  
    }

   
    public function destroy(Request $request)
    {
        //car dans le cas d'ajoute un contact on ajoute aussi une
        //organisation danc au cas de suppression il faut supprime
        //aussi l'organisation
        $contact = Contact::find($request->input('contact'));
        $oragnisation = $contact->organisation;
        // soft delete
        //on peut le rendrer au cas de besoin
        $oragnisation->delete();
        $contact->delete();
        return redirect('/contacts');
    }

    public function search(Request $request){
        //function qui va faire notre rechereche et elle donne une resultat ordonné par
        //nom de contact ansi par nom organisatio et enfin par statur
            $contacts = Contact::selectRaw('contact.nom AS nom_contact, contact.prenom,
        contact.id As id, organisation.nom AS nom_organisation, statut')
        ->join('organisation', 'organisation.id', '=', 'contact.organisation_id')
        ->where('contact.nom','like','%'.ucwords($request->search).'%')
        ->orderBy('nom_contact', 'asc')
        ->orderBy('nom_organisation', 'asc')
        ->orderBy('statut', 'asc')
        ->paginate(10);
        return view('contact.index', ['contacts'=>$contacts]);
    }
   
}
