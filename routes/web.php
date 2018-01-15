<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group([
  'middleware' => [
    'auth',
    ]
],
  function() {

    Route::get('/', function () {
      return view('admin.dashboard.pages');
    });
    /* Kérdés hozzáadás */
    Route::get('/questions', 'QuestionController@show')->name('admin.questions');
    Route::post('/addquestion', 'QuestionController@store')->name('admin.questionstore');

    /* Kérdés törlése */
    Route::get('/questionDelete', 'QuestionController@showDeletable')->name('admin.questiondeletable');
    Route::post('/questionDelete', 'QuestionController@delete')->name('admin.questiondelete');

    /* Kérdés módosítás */
    Route::get('/modifyquestions', 'QuestionController@showmodify');
    Route::post('/modifyquestions', 'QuestionController@showmodify')->name('admin.choosequestion');
    Route::post('/modifyquestion', 'QuestionController@modify')->name('admin.modifyquestion');

    /* Kérdőív lap hozzáadás */
    Route::get('/addpage', 'PageController@show')->name('admin.pages');
    Route::post('/addpage', 'PageController@store')->name('admin.pagestore');
    Route::get('/deletepage', 'PageController@showDeletable')->name('admin.pagedeletable');
    Route::post('/deletepage', 'PageController@delete')->name('admin.pagedelete');

    /* Kérdőív lap módosítás */
    Route::get('/modifypages', 'PageController@showmodify')->name('admin.modifypage');
    Route::get('/chosePageModify', 'PageController@chosePageModify')->name('admin.choosepage');
    Route::post('/chosePageModifyText', 'PageController@chosePageModifyText')->name('admin.chosePageModifyText');
    Route::post('/chosePageAddQuestion', 'PageController@chosePageAddQuestion')->name('admin.chosePageAddQuestion');
    Route::post('/chosePageDeleteQuestion', 'PageController@chosePageDeleteQuestion')->name('admin.chosePageDeleteQuestion');

    /* Kérdőív módosítás */
    Route::get('/modifyQuestionnaire', 'QuestionnaireController@show')->name('admin.modifyQuestionnaire');
    Route::post('/modifyQuestionnaireAddPage', 'QuestionnaireController@modifyQuestionnaireAddPage')->name('admin.modifyQuestionnaireAddPage');
    Route::post('/modifyQuestionnaireDeletePage', 'QuestionnaireController@modifyQuestionnaireDeletePage')->name('admin.modifyQuestionnaireDeletePage');

    /* Kérdőív publikálás*/

    Route::get('/showEditedQuestionnaire', 'QuestionnaireController@showEdited')->name('admin.showEditedQuestionnaire');
    Route::post('/publishQuestionnaire', 'QuestionnaireController@publish')->name('admin.publishQuestionnaire');

    /* Egyéb konfigurációk beállítása*/
    Route::get('/settings', 'ConfigController@show')->name('admin.settings');
    Route::post('/settingsStoreGreetings', 'ConfigController@StoreGreetings')->name('admin.settingsStoreGreetings');
    Route::post('/settingsStoreRegards', 'ConfigController@StoreRegards')->name('admin.settingsStoreRegards');
    Route::post('/settingsStoreMail', 'ConfigController@StoreMail')->name('admin.settingsStoreMail');
    Route::post('/settingsStoreGooglelink', 'ConfigController@StoreGooglelink')->name('admin.settingsStoreGooglelink');


  });
//Route::get('/home', 'HomeController@index')->name('home');

