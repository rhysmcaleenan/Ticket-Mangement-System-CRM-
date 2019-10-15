<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// route to get the login blade
Route::get('/', function () {
    return view('auth.login');
});

//*******************?
Auth::routes();


//********** if user is logged in then allow the routes of the following to be completed
Route::middleware('auth')->group(function () {

//----------------------------------------------------------------------------------
    //shows knowledgebase page
    Route::get('/knowledgebase', 'KnowledgebaseController@index')->name('knowledgebase.index');
    Route::get('/knowledgebase/category/create-category', 'CategoryController@create')->name('knowledgebase.create-ticket');

//    Route::get('/knowledgebase/category/view/{category}')->uses('CategoryController@view')->name('category.view');
//    Route::post('/knowledgebase/category/create-category', 'CategoryController@store')->name('category.store');
//
//    Route::get('/knowledgebase/article/view/{article}')->uses('ArticleController@view')->name('article.view');
//    Route::post('/knowledgebase/category/create-category', 'CategoryController@store')->name('article.store');

    Route::resource('knowledgebase/categories', 'CategoryController');
    Route::resource('knowledgebase/articles', 'ArticleController');

//--------------------------------------------- Dashboard Routes --------------------------------------------------------
//Route to the dashboard index page
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

//----------------------------------------------------------------------------------------------------------------------
////shows the tickets page with the list of tickets
//    Route::get('/tickets', 'TicketController@index')->name('tickets.index');
//
////live search
//    Route::get('/tickets/action', 'TicketController@action')->name('tickets.action');
//
//
////takes you to the add new ticket page
//    Route::get('/tickets/create-ticket', 'TicketController@create')->name('tickets.create-ticket');
//
//    Route::post('/tickets/create-ticket', 'TicketController@store')->name('tickets.store');
//
////takes you the confirm delete page
//    Route::get('/tickets/delete-ticket/{ticket}', 'TicketController@delete')->name('tickets.delete-ticket');
//// deletes the ticket
//    Route::post('/tickets/delete-ticket/{ticket}', 'TicketController@destroy')->name('tickets.destroy-ticket');
//
////takes you to the edit/update page
//    Route::get('/tickets/{ticket}', 'TicketController@show')->name('tickets.show');
////this updates/saves new the info when button clcked
//    Route::post('/tickets/{ticket}', 'TicketController@update')->name('tickets.update');

//--------------------------------------  Client Tab Routes  -------------------------------------------------------------

    //this is the rout to main client blades with table of clients 
    Route::get('/clients', 'ClientController@index')->name('clients.index');
    //route to take you to the add new client page blade
    Route::get('/clients/create-client', 'ClientController@create')->name('clients.create');
//*********************** route to .......?
    Route::post('/clients/create-client', 'ClientController@store')->name('clients.store');
    //route that takes you the confirm delete page blade
    Route::get('/clients/delete-client/{client}', 'ClientController@delete')->name('clients.delete');
//*********************** this is the route to....?
    Route::post('/clients/delete-client/{client}', 'ClientController@destroy')->name('clients.destroy');
    //takes you to the edit/update blade for id of the client selected 
    Route::get('/clients/{client}', 'ClientController@show')->name('clients.show');
//*********************** this updates/saves the information on the form when update button is clicked
    Route::post('/clients/{client}', 'ClientController@update')->name('clients.update');

//--------------------------------------  Users Tab Routes  ---------------------------------------------------------------

//***************** .... ?
    Route::resource('users', 'UserController');
//***************** ....?
    Route::get('/profile', 'UserController@profileEdit')->name('users.profile.index');
//***************** get the info of the user and output it in the small form blade?
    Route::get('/profile/{user}', 'UserController@profileShow')->name('users.profile.show');
//***************** ....? 
    Route::patch('/profile', 'UserController@profileUpdate')->name('users.profile.update');


//--------------------------------------  Knowledge Base Tab Routes  ------------------------------------------------------

//***** what is this doing? 
    Route::resource('categories', 'CategoryController');

//********* ? should this be here
    Route::get('/tickets/delete-ticket/{ticket}', 'TicketController@delete')->name('tickets.delete');

    Route::resource('tickets', 'TicketController');

//--------------------------------------  To Do List Routes  ---------------------------------------------------------------
// ******************?
    Route::resource('tasks', 'TaskController');

//--------------------------------------  Notes on User Profile Route ------------------------------------------------------
// ******************?
    Route::resource('notes', 'NoteController');

//--------------------------------------   Reports Routes  -----------------------------------------------------------------
    // report
    // gets the blade/index of the main reports tab view
    Route::get('/report', 'ReportController@index')->name('report.index');
    // route to the controller for the export function for clients details
    Route::get('/report/export/clients', 'ReportController@exportClients')->name('report.export.clients');
    // route to the controller for the export function for the tickets details
    Route::get('/report/export/tickets', 'ReportController@exportTickets')->name('report.export.tickets');
});
