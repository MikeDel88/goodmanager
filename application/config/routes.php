<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['inscription'] = 'inscription/index';
$route['validation/(:any)'] = 'inscription/validation/$1';

$route['connexion'] = 'connexion/index';
$route['connexion/reset-mdp'] = 'connexion/reset';
$route['reset/(:any)'] = 'connexion/modification/$1';

$route['espace-personnel'] = 'profile/index';
$route['espace-personnel/(:any)'] = 'profile/index/$1';
$route['profil/entreprise'] = 'profile/miseAJourEntreprise';
$route['profil/user'] = 'profile/miseAJourUtilisateur';
$route['profil/delete'] = 'profile/deleteUtilisateur';

$route['tableau-de-bord'] = 'dashboard/index';
$route['tableau-de-bord/api/nouveaux-clients'] = 'dashboard/newClients';
$route['tableau-de-bord/api/nombre-clients-par-an/(:any)'] = 'dashboard/numberClientsByYear/$1';
$route['tableau-de-bord/api/nombre-clients-par-dept'] = 'dashboard/numberClientByDept';
$route['tableau-de-bord/api/sans-tel-sans-email'] = 'dashboard/sansTelNiMail';
$route['tableau-de-bord/api/contact-par-utilisateur'] = 'dashboard/contactParUtilisateur';
$route['tableau-de-bord/api/rdv-par-utilisateur'] = 'dashboard/rendezVousParUtilisateur';

$route['gestion-comptes'] = 'comptes/index';
$route['gestion-comptes/suppression-collaborateur'] = 'comptes/delete';
$route['gestion-comptes/ajouter-un-collaborateur'] = 'comptes/add';

$route['gestion-clients'] = 'gestion/index';
$route['gestion-clients/(:any)'] = 'gestion/index/$1';
$route['gestion/nouveau-client'] = 'gestion/add';
$route['gestion-clients/api/(:any)'] = 'gestion/api/$1';

$route['fiche-client/(:num)/(:any)'] = 'fiche/index/$1/$2';
$route['fiche-client/modification'] = 'fiche/update';
$route['fiche-client/delete'] = 'fiche/delete';

$route['liste-clients'] = 'liste/index';
$route['liste-clients/search'] = 'liste/search';
$route['liste-clients/api/contact'] = 'liste/contact';
$route['liste-clients/api/history/(:num)'] = 'liste/historyContact/$1';

$route['rendez-vous/api/add-rdv'] = 'rendezVous/add';
$route['rendez-vous/api/liste'] = 'rendezVous/getAll';
$route['rendez-vous'] = 'rendezVous/index';
$route['rendez-vous/api/delete-rdv'] = 'rendezVous/delete';
$route['rendez-vous/api/modification-rdv'] = 'rendezVous/modification';


$route['geolocalisation'] = 'geolocalisation/index';
$route['geolocalisation/api/clients/(:any)/(:any)/(:any)'] = 'geolocalisation/geolocalisationClient/$1/$2/$3';


$route['deconnexion'] = 'profile/deconnexion';


$route['default_controller'] = 'accueil/index';
$route['404_override'] = 'errors/error404';
$route['translate_uri_dashes'] = FALSE;
