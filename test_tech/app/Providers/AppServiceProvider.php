<?php

namespace App\Providers;

use App\Models\Contact;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        View::share('allContacts',Contact::rightJoin('organisation','contact.organisation_id','=','organisation.id')
        ->selectRaw('contact.id AS contactId, contact.nom AS nom, contact.prenom AS prenom,
        contact.e_mail AS email, organisation.id AS organisationId,
        organisation.nom AS organisationNom, organisation.adresse AS adresse,
        organisation.code_postal AS codePostal, organisation.ville AS ville,
        organisation.statut AS statut')
    ->get());
    }
}
