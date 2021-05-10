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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('test', function () {
    return view('backend.receipt.invoice');
});

Route::get('/login', array(
    'as'    => 'login',
    'uses'  => 'Auth\LoginController@login'
));

Route::post('/post-login', array(
    'as'    => 'postLogin',
    'uses'  => 'Auth\LoginController@postLogin'
));

Auth::routes();

Route::get('/force-logout', array(
    'as'    => 'forceLogout',
    'uses'  => 'Auth\LoginController@forceLogout'
));

// route access permission optional for action if data null true by default
Route::group(['middleware' => 'sentinelAuth','namespace' => 'Admin','prefix' => 'account'], function () {
    Route::get('change-password', 'AccountController@changePassword')->name('account.change_password');
    Route::put('change-password', 'AccountController@postChangePassword')->name('account.post_change_password');
});

// route access permission required for action default is false
Route::group(['middleware' => ['sentinelAuth','checkAccess'],'namespace' => 'Admin','prefix' => 'admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('role', 'RoleController')->except('show');
    Route::resource('permission', 'PermissionController')->only(['index','edit','update']);
    Route::resource('user', 'UserController')->except('show');
    Route::resource('settings', 'SettingController')->only(['index','edit','update']);

    Route::resource('letter-categories', 'A\LetterCategoryController')->except('show');
    Route::resource('letters', 'A\LetterController')->except('show');
    Route::resource('letter-courses', 'A\LetterCourseController')->except('show');
    Route::resource('letter-questions', 'A\LetterCourseQuestionController')->except('show');

    Route::resource('verb-levels', 'B\MasterVerbLevelController')->except('show');
    Route::resource('verb-groups', 'B\MasterVerbGroupController')->except('show');
    Route::resource('verb-words', 'B\MasterVerbWordController')->except('show');
    Route::resource('verb-changes', 'B\VerbChangeController')->except('show');
    Route::resource('verb-sentences', 'B\MasterVerbSentenceController')->except('show');
    Route::resource('verb-courses', 'B\VerbCourseController')->except('show');
    Route::resource('verb-questions', 'B\VerbCourseQuestionController')->except('show');

    Route::resource('particle-educations', 'C\ParticleEducationController')->except('show');
    Route::resource('particle-education-details', 'C\ParticleEducationDetailController')->except('show');
    Route::resource('particle-courses', 'C\ParticleCourseController')->except('show');
    Route::resource('particle-course-questions', 'C\ParticleCourseQuestionController')->except('show');

    Route::resource('pattern-chapters', 'D\PatternChapterController')->except('show');
    Route::resource('pattern-lessons', 'D\PatternLessonController')->except('show');
    Route::resource('pattern-courses', 'D\PatternCourseController')->except('show');
    Route::resource('pattern-course-questions', 'D\PatternCourseQuestionController')->except('show');

    Route::resource('master-groups', 'E\MasterGroupController')->except('show');
    Route::resource('kanji-chapters', 'E\KanjiChapterController')->except('show');
    Route::resource('kanji-educations', 'E\KanjiEducationController')->except('show');
    Route::resource('kanji-samples', 'E\KanjiSampleController')->except('show');


});
