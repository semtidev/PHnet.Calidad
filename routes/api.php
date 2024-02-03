<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// LOCKED SCREEN
Route::post('/unlocked', 'AppController@unlocked')->name('Unlocked');

// CONFIGURATION
Route::get('departments', 'ConfigController@getDepartments')->name('Get Departments');
Route::get('specialities/{department}', 'ConfigController@getSpecialities')->name('Get Specialities');
Route::get('works/{appmodule}', 'ConfigController@getWorks')->name('Get Works');
Route::get('worksabbr', 'ConfigController@getWorksAbbr')->name('Get Works Abbr');
Route::post('updateStateModuleWork', 'ConfigController@updateStateModuleWork')->name('Update Work Module State');
Route::post('deleteWork', 'ConfigController@delWorks')->name('Delete Work');
Route::post('updateWork', 'ConfigController@updWork')->name('Update Work');
Route::post('metrotypes/upd', 'ConfigController@updMetrotype')->name('Update Metrology Type');
Route::post('user/store', 'ConfigController@storeUser')->name('User Store');
Route::post('user/profile', 'ConfigController@profileUser')->name('User Profile');
Route::post('user/notify', 'ConfigController@notifyUser')->name('User Notify');
Route::post('user/password', 'AppController@changePassword')->name('User Change Pass');

// METROLOGY
Route::get('metrology/{type}/{work}/{state}', 'MetrologyController@getMetrology')->name('Get Metrology');
Route::get('metrology/{type}/{work}/{state}/{show_inactive}', 'MetrologyController@getMetrology')->name('Get Metrology');
Route::get('metrology/pdf/current', 'MetrologyController@exportCurrent')->name('Export Current Project Metrology');
Route::get('metrology/pdf/all', 'MetrologyController@exportAll')->name('Export All Project Metrology');
Route::get('metrology/pdf/book', 'MetrologyController@exportBook')->name('Export Book Metrology');
Route::get('metrotypes', 'MetrologyController@getMetrotypes')->name('Get Metrology Types');
Route::post('metrology/add', 'MetrologyController@addEquipment')->name('Add Equipment Metrology');
Route::post('metrology/upd', 'MetrologyController@updEquipment')->name('Update Equipment Metrology');
Route::post('metrology/del', 'MetrologyController@delEquipment')->name('Delete Equipment Metrology');
Route::post('metrology/activate', 'MetrologyController@Activate')->name('Clic Equipment Metrology Active');
Route::post('metrology/optstate', 'MetrologyController@optState')->name('Clic Equipment Metrology State');
Route::post('metrology/setphoto', 'MetrologyController@setPhoto')->name('Set Metrology Photo');
Route::post('metrology/delphoto', 'MetrologyController@delPhoto')->name('Delete Metrology Photo');
Route::post('metrology/move', 'MetrologyController@metroMove')->name('Move Instrument to Project');
Route::post('metrology/search', 'MetrologyController@metroSearch')->name('Search tool');
Route::get('metrology/history/{tool}', 'MetrologyController@getMetrohistory')->name('Get Tool History');
Route::get('metro/planproject/{work}/{year}', 'MetrologyController@getPlanningProject')->name('Get Project Calibration Planning');
Route::get('metro/planubph/{year}', 'MetrologyController@getPlanningUbph')->name('Get UBPH Calibration Planning');
Route::get('metro/planning/project/pdf', 'MetrologyController@ExpPlanningProject')->name('Export Planning Project');
Route::get('metro/planning/ubph/pdf', 'MetrologyController@ExpPlanningUbph')->name('Export Planning UBPH');
Route::get('metrology/syncplanning/{user}', 'MetrologyController@syncMetroPlanning')->name('Sync Planning');

// SATISFACTION
Route::get('poll/feed/{work}/{month}/{year}', 'PollController@getPollFeed')->name('Get Feed Polls');
Route::get('poll/host/{work}/{month}/{year}', 'PollController@getPollHost')->name('Get Host Polls');
Route::get('poll/equip/{work}/{month}/{year}', 'PollController@getPollEquip')->name('Get Equip Polls');
Route::get('poll/brigades/{work}/{month}/{year}', 'PollController@getPollBrigades')->name('Get Brigades Polls');
Route::get('poll/personaltransp/{work}/{month}/{year}', 'PollController@getPollPersonaltransp')->name('Get Personal Transp Polls');
Route::get('poll/freightransp/{work}/{month}/{year}', 'PollController@getPollFreightransp')->name('Get Freight Transp Polls');
Route::post('poll/add', 'PollController@createPoll')->name('Create Poll');
Route::post('poll/upd', 'PollController@updatePoll')->name('Update Poll');
Route::post('poll/del', 'PollController@deletePoll')->name('Delete Poll');
Route::get('poll/comments/{type}/{work}/{month}/{year}', 'PollController@getServiceComments')->name('Get Service Comments');
Route::post('poll/comment/add', 'PollController@createComment')->name('Create Service Comment');
Route::post('poll/comment/upd', 'PollController@updateComment')->name('Update Service Comment');
Route::post('poll/comment/del', 'PollController@deleteComment')->name('Delete Service Comment');
Route::get('poll/issues/{type}', 'PollController@getIssueDesc')->name('Get Issue Descriptions');
Route::get('intpoll/pdf/current', 'PollController@intpollExpCurrent')->name('Export IntPoll Current Project');
Route::get('intpoll/pdf/all', 'PollController@intpollExpAll')->name('Export IntPoll All Projects');
Route::get('extpolls/{work}/{month}/{year}', 'ExtpollController@getExtPoll')->name('Get ExtPolls');
Route::post('extpoll/activity/add', 'ExtpollController@createActivity')->name('Create ExtPoll Act.');
Route::post('extpoll/activity/upd', 'ExtpollController@updateActivity')->name('Update ExtPoll Act.');
Route::post('extpoll/activity/del', 'ExtpollController@deleteActivity')->name('Delete ExtPoll Act.');
Route::post('extpoll/loadForm', 'ExtpollController@loadForm')->name('Load Form ExtPoll');
Route::get('extpoll/pdf/analityc', 'ExtpollController@ExpAnalityc')->name('Analityc ExtPoll');
Route::get('extpoll/pdf/certification', 'ExtpollController@ExpCertification')->name('Certification ExtPoll');
Route::get('extpoll/pdf/pollmodel', 'ExtpollController@ExpModel')->name('Poll Model ExtPoll');
Route::post('extpoll/activity/import', 'ExtpollController@ImportActivities')->name('Import ExtPoll Activity');
Route::post('extpoll/activities/alldel', 'ExtpollController@AllDeleteActivities')->name('All Delete ExtPoll Activities');