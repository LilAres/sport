<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index'); 
Route::get('/home', 'HomeController@index'); 
Route::get('/logout', 'SessionsController@destroy');

// Pages pour l'admin
Route::get('/manageTeams', 'AdminController@teams');
Route::post('/manageTeams/{team}/delete', 'AdminController@destroyTeam');
Route::post('/manageTeams/store', 'AdminController@storeTeam');

Route::get('/manageLeagues', 'AdminController@leagues');
Route::post('/manageLeagues/{league}/delete', 'AdminController@destroyLeague');
Route::post('/manageLeagues/store', 'AdminController@storeLeague');

Route::get('/manageMatchs', 'AdminController@matchs');
Route::post('/manageMatchs/{match}/delete', 'AdminController@destroyMatch');
Route::post('/manageMatchs/store', 'AdminController@storeMatch');

Route::get('/manageSeasons', 'AdminController@seasons');
Route::post('/manageSeasons/{season}/delete', 'AdminController@destroySeason');
Route::post('/manageSeasons/store', 'AdminController@storeSeason');

Route::post('/managePlayer/store', 'AdminController@storePlayer');

    // Section pour les matchs
Route::get('/affrontement/{match}', 'AffrontementController@index');
Route::post('/affrontement/{match}/scoreLocal', 'AffrontementController@scoreLocal');
Route::post('/affrontement/{match}/lancerLocal', 'AffrontementController@lancerLocal');
Route::post('/affrontement/{match}/scoreVisitor', 'AffrontementController@scoreVisitor');
Route::post('/affrontement/{match}/lancerVisitor', 'AffrontementController@lancerVisitor');
Route::post('/affrontement/statLocal', 'AffrontementController@statLocal');
Route::post('/affrontement/statVisitor', 'AffrontementController@statVisitor');
Route::post('/affrontement/{match}/endMatch', 'AffrontementController@endMatch');




// Page pour les admin des équipes
Route::get('/manageTeam', 'TeamAdminController@myTeam');
Route::post('/manageTeam/changeName', 'TeamAdminController@changeName');
Route::post('/managePlayer/{player}/delete', 'TeamController@destroyPlayer');

// Page pour les registered
Route::get('/myTeams', 'TeamController@myTeams');
Route::get('/myStats', 'PlayerController@stats');


// Les teams
Route::get('/team/{team}', 'TeamController@showTeam');

Auth::routes();

