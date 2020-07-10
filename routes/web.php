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

Route::get('/', 'HomeController@index')->name('welcome');


Route::get('/registrar-aposta/{plano}', 'ApostaController@registrarAposta')->name('registrar');
Route::post('/registrar', 'ApostaController@registrarApostaAction')->name('registrarApostaAction');


Route::get('/verificar-aposta', 'ApostaController@verificarAposta')->name('verificar');
Route::post('/verificar-aposta', 'ApostaController@verificarApostaAction')->name('verificarApostaAction');


Route::prefix('admin')->group(function () {
    
    Route::get('/', 'AdminController@index')->name('admin');

    Route::get('/todas-apostas', 'ApostaController@todasApostas')->name('apostas.all');
    Route::get('/apostas-pendentes', 'ApostaController@apostasPendentes')->name('apostas.pendentes');;
    Route::get('/apostas-confirmadas', 'ApostaController@apostasConfirmadas')->name('apostas.confirmadas');;

    Route::get('/apostas/aprovar/{id}', 'ApostaController@aprovar')->name('apostas.aprovar');
    Route::get('/apostas/reprovar/{id}', 'ApostaController@reprovar')->name('apostas.reprovar');

    Route::get('/apostas/search', 'ApostaController@search')->name('apostas.search');
    Route::post('/apostas/search', 'ApostaController@result');

    Route::get('/sorteios/conferir', 'SorteioController@conferir')->name('sorteios.conferir');
    Route::post('/sorteios/conferir', 'SorteioController@conferirAction')->name('sorteios.conferirAction');
    Route::resource('/sorteios', 'SorteioController');

    Route::get('/perfil/edit', 'PerfilController@edit')->name('perfil.edit');
    Route::post('/perfil/edit/{id}', 'PerfilController@update')->name('perfil.editAction');

    Route::get('/perfil/edit/password', 'PerfilController@editSenha')->name('perfil.editSenha');
    Route::post('/perfil/edit/password', 'PerfilController@updateSenha');

    Route::get('/login', 'Auth\LoginController@index')->name('login');
    Route::post('/login', 'Auth\LoginController@authenticate');


    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


    Route::get('/sorteios/delete/{id}', 'SorteioController@delete')->name('sorteios.delete');
    Route::get('/sorteios/encerrar/{id}', 'SorteioController@encerrar')->name('sorteios.encerrar');
    Route::get('/sorteios/iniciar/{id}', 'SorteioController@iniciar')->name('sorteios.iniciar');

    

    Route::get('/depositos', 'DepositoController@index')->name('depositos.index');
    Route::get('/deposito/confirmar/{id}/{search?}', 'DepositoController@confirmar')->name('deposito.confirmar');
    Route::get('/deposito/reprovar/{id}/{search?}', 'DepositoController@reprovar')->name('deposito.reprovar');

    Route::get('/depositos/search', 'DepositoController@search')->name('depositos.search');
    Route::post('/depositos/search', 'DepositoController@result')->name('depositos.result');

    


    Route::get('/depositos/date/{id}', 'DepositoController@date')->name('depositos.date');
    Route::post('/depositos/date/{id}', 'DepositoController@putdate')->name('depositos.putdate');

    Route::get('/depositos/numero/{id}', 'DepositoController@numero')->name('depositos.numero');
    Route::post('/depositos/numero/{id}', 'DepositoController@putnumero')->name('depositos.putnumero');


    Route::get('/planos/vantagens', 'PlanoController@edit')->name('planos.vantagens');
    Route::post('/planos/{id}/vantagens/insert', 'PlanoController@insert')->name('planos.vantagens.insert');
    Route::get('/planos/{id}/vantagens/delete', 'PlanoController@delete')->name('planos.vantagens.delete');
});



// ROTAS DE LOGIN
// Route::get('/login', 'Auth\LoginController@index')->name('login');
// Route::post('/login', 'Auth\LoginController@authenticate')->name('authenticate');
// Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// ROTAS DE REGISTRO
// Route::get('/register', 'Auth\RegisterController@index')->name('register');
// Route::post('/register', 'Auth\RegisterController@register')->name('save');
