<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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

Route::get('/', function () {
    return view('auth/login');
});

// Auth::routes();
Auth::routes(['register' => false]);

Route::middleware(['auth', 'has.role'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::middleware('permission:create post')->group(function () {
        Route::view('posts/create', 'posts.create');
        Route::view('posts/table', 'posts.table');
    });

    Route::prefix('master')->namespace('Admin')->middleware('permission:create user')->group(function () {
        Route::get('/users/index', 'UserController@index')->name('users.index');
        Route::get('/users/create', 'UserController@create')->name('users.create');
        Route::post('/users/create', 'UserController@store');
        Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
        Route::put('/users/{id}/edit', 'UserController@update');
    });

    // ROOM A / Room 1
    Route::prefix('letter')->namespace('Admin\Room\A')->middleware('permission:assign permission')->group(function () {
        Route::get('/categories/index', 'LetterCategoriesController@index')->name('letters.categories.index');
        Route::get('/categories/create', 'LetterCategoriesController@create')->name('letters.categories.create');
        Route::post('/categories/create', 'LetterCategoriesController@store');
        Route::get('/categories/{id}/edit', 'LetterCategoriesController@edit')->name('letters.categories.edit');
        Route::put('/categories/{id}/edit', 'LetterCategoriesController@update');

        Route::get('/letters/index', 'LetterController@index')->name('letters.letters.index');
        Route::get('/letters/create', 'LetterController@create')->name('letters.letters.create');
        Route::post('/letters/create', 'LetterController@store');
        Route::get('/letters/{id}/edit', 'LetterController@edit')->name('letters.letters.edit');
        Route::put('/letters/{id}/edit', 'LetterController@update');

        Route::get('/courses/index', 'LetterCourseController@index')->name('letters.courses.index');
        Route::get('/courses/create', 'LetterCourseController@create')->name('letters.courses.create');
        Route::post('/courses/create', 'LetterCourseController@store');
        Route::get('/courses/{id}/edit', 'LetterCourseController@edit')->name('letters.courses.edit');
        Route::put('/courses/{id}/edit', 'LetterCourseController@update');

        Route::get('/questions/index', 'LetterCourseQuestionController@index')->name('letters.questions.index');
        Route::get('/questions/create', 'LetterCourseQuestionController@create')->name('letters.questions.create');
        Route::post('/questions/create', 'LetterCourseQuestionController@store');
        Route::get('/questions/{id}/edit', 'LetterCourseQuestionController@edit')->name('letters.questions.edit');
        Route::put('/questions/{id}/edit', 'LetterCourseQuestionController@update');
    });

    // ROOM B / Room 2
    Route::prefix('verb')->namespace('Admin\Room\B')->middleware('permission:assign permission')->group(function () {
        Route::get('/levels/index', 'MasterVerbLevelController@index')->name('verbs.levels.index');
        Route::get('/levels/create', 'MasterVerbLevelController@create')->name('verbs.levels.create');
        Route::post('/levels/create', 'MasterVerbLevelController@store');
        Route::get('/levels/{id}/edit', 'MasterVerbLevelController@edit')->name('verbs.levels.edit');
        Route::put('/levels/{id}/edit', 'MasterVerbLevelController@update');

        Route::get('/groups/index', 'MasterVerbGroupController@index')->name('verbs.groups.index');
        Route::get('/groups/create', 'MasterVerbGroupController@create')->name('verbs.groups.create');
        Route::post('/groups/create', 'MasterVerbGroupController@store');
        Route::get('/groups/{id}/edit', 'MasterVerbGroupController@edit')->name('verbs.groups.edit');
        Route::put('/groups/{id}/edit', 'MasterVerbGroupController@update');

        Route::get('/words/index', 'MasterVerbWordController@index')->name('verbs.words.index');
        Route::get('/words/create', 'MasterVerbWordController@create')->name('verbs.words.create');
        Route::post('/words/create', 'MasterVerbWordController@store');
        Route::get('/words/{id}/edit', 'MasterVerbWordController@edit')->name('verbs.words.edit');
        Route::put('/words/{id}/edit', 'MasterVerbWordController@update');

        Route::get('/changes/index', 'VerbChangeController@index')->name('verbs.changes.index');
        Route::get('/changes/create', 'VerbChangeController@create')->name('verbs.changes.create');
        Route::post('/changes/create', 'VerbChangeController@store');
        Route::get('/changes/{id}/edit', 'VerbChangeController@edit')->name('verbs.changes.edit');
        Route::put('/changes/{id}/edit', 'VerbChangeController@update');

        Route::get('/sentences/index', 'MasterVerbSentenceController@index')->name('verbs.sentences.index');
        Route::get('/sentences/create', 'MasterVerbSentenceController@create')->name('verbs.sentences.create');
        Route::post('/sentences/create', 'MasterVerbSentenceController@store');
        Route::get('/sentences/{id}/edit', 'MasterVerbSentenceController@edit')->name('verbs.sentences.edit');
        Route::put('/sentences/{id}/edit', 'MasterVerbSentenceController@update');

        Route::get('/courses/index', 'VerbCourseController@index')->name('verbs.courses.index');
        Route::get('/courses/create', 'VerbCourseController@create')->name('verbs.courses.create');
        Route::post('/courses/create', 'VerbCourseController@store');
        Route::get('/courses/{id}/edit', 'VerbCourseController@edit')->name('verbs.courses.edit');
        Route::put('/courses/{id}/edit', 'VerbCourseController@update');

        Route::get('/questions/index', 'VerbCourseQuestionController@index')->name('verbs.questions.index');
        Route::get('/questions/create', 'VerbCourseQuestionController@create')->name('verbs.questions.create');
        Route::post('/questions/create', 'VerbCourseQuestionController@store');
        Route::get('/questions/{id}/edit', 'VerbCourseQuestionController@edit')->name('verbs.questions.edit');
        Route::put('/questions/{id}/edit', 'VerbCourseQuestionController@update');
    });

    // ROOM C / Room 3
    Route::prefix('particle')->namespace('Admin\Room\C')->middleware('permission:assign permission')->group(function () {
        Route::get('/educations/index', 'ParticleEducationController@index')->name('particles.educations.index');
        Route::get('/educations/create', 'ParticleEducationController@create')->name('particles.educations.create');
        Route::post('/educations/create', 'ParticleEducationController@store');
        Route::get('/educations/{id}/edit', 'ParticleEducationController@edit')->name('particles.educations.edit');
        Route::put('/educations/{id}/edit', 'ParticleEducationController@update');

        Route::get('/educations/details/index', 'ParticleEducationDetailController@index')->name('particles.educations.details.index');
        Route::get('/educations/details/create', 'ParticleEducationDetailController@create')->name('particles.educations.details.create');
        Route::post('/educations/details/create', 'ParticleEducationDetailController@store');
        Route::get('/educations/details/{id}/edit', 'ParticleEducationDetailController@edit')->name('particles.educations.details.edit');
        Route::put('/educations/details/{id}/edit', 'ParticleEducationDetailController@update');

        Route::get('/courses/index', 'ParticleCourseController@index')->name('particles.courses.index');
        Route::get('/courses/create', 'ParticleCourseController@create')->name('particles.courses.create');
        Route::post('/courses/create', 'ParticleCourseController@store');
        Route::get('/courses/{id}/edit', 'ParticleCourseController@edit')->name('particles.courses.edit');
        Route::put('/courses/{id}/edit', 'ParticleCourseController@update');

        Route::get('/questions/index', 'ParticleCourseQuestionController@index')->name('particles.questions.index');
        Route::get('/questions/create', 'ParticleCourseQuestionController@create')->name('particles.questions.create');
        Route::post('/questions/create', 'ParticleCourseQuestionController@store');
        Route::get('/questions/{id}/edit', 'ParticleCourseQuestionController@edit')->name('particles.questions.edit');
        Route::put('/questions/{id}/edit', 'ParticleCourseQuestionController@update');
    });

    // ROOM D / Room 4
    Route::prefix('pattern')->namespace('Admin\Room\D')->middleware('permission:assign permission')->group(function () {
        Route::get('/chapters/index', 'PatternChapterController@index')->name('patterns.chapters.index');
        Route::get('/chapters/create', 'PatternChapterController@create')->name('patterns.chapters.create');
        Route::post('/chapters/create', 'PatternChapterController@store');
        Route::get('/chapters/{id}/edit', 'PatternChapterController@edit')->name('patterns.chapters.edit');
        Route::put('/chapters/{id}/edit', 'PatternChapterController@update');

        Route::get('/lessons/index', 'PatternLessonController@index')->name('patterns.lessons.index');
        Route::get('/lessons/create', 'PatternLessonController@create')->name('patterns.lessons.create');
        Route::post('/lessons/create', 'PatternLessonController@store');
        Route::get('/lessons/{id}/edit', 'PatternLessonController@edit')->name('patterns.lessons.edit');
        Route::put('/lessons/{id}/edit', 'PatternLessonController@update');

        Route::get('/courses/index', 'PatternCourseController@index')->name('patterns.courses.index');
        Route::get('/courses/create', 'PatternCourseController@create')->name('patterns.courses.create');
        Route::post('/courses/create', 'PatternCourseController@store');
        Route::get('/courses/{id}/edit', 'PatternCourseController@edit')->name('patterns.courses.edit');
        Route::put('/courses/{id}/edit', 'PatternCourseController@update');

        Route::get('/questions/index', 'PatternCourseQuestionController@index')->name('patterns.questions.index');
        Route::get('/questions/create', 'PatternCourseQuestionController@create')->name('patterns.questions.create');
        Route::post('/questions/create', 'PatternCourseQuestionController@store');
        Route::get('/questions/{id}/edit', 'PatternCourseQuestionController@edit')->name('patterns.questions.edit');
        Route::put('/questions/{id}/edit', 'PatternCourseQuestionController@update');
    });

    Route::prefix('role-and-permission')->namespace('Permissions')->middleware('permission:assign permission')->group(function () {
        Route::get('assignable', 'AssignController@create')->name('assign.create');
        Route::post('assignable', 'AssignController@store');
        Route::get('assignable/{role}/edit', 'AssignController@edit')->name('assign.edit');
        Route::put('assignable/{role}/edit', 'AssignController@update');

        // User
        Route::get('assign/user', 'UserController@create')->name('assign.user.create');
        Route::post('assign/user', 'UserController@store');
        Route::get('assign/{user}/user', 'UserController@edit')->name('assign.user.edit');
        Route::put('assign/{user}/user', 'UserController@update');

        Route::prefix('roles')->group(function () {
            Route::get('', 'RoleController@index')->name('roles.index');
            Route::post('create', 'RoleController@store')->name('roles.create');
            Route::get('{role}/edit', 'RoleController@edit')->name('roles.edit');
            Route::put('{role}/edit', 'RoleController@update');
        });
        Route::prefix('permissions')->group(function () {
            Route::get('', 'PermissionController@index')->name('permissions.index');
            Route::post('create', 'PermissionController@store')->name('permissions.create');
            Route::get('{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
            Route::put('{permission}/edit', 'PermissionController@update');
        });
    });

    Route::prefix('navigation')->middleware('permission:create navigation')->group(function () {
        Route::get('create', 'NavigationController@create')->name('navigation.create');
        Route::post('create', 'NavigationController@store');
        Route::get('table', 'NavigationController@table')->name('navigation.table');
        Route::get('{navigation}/edit', 'NavigationController@edit')->name('navigation.edit');
        Route::put('{navigation}/edit', 'NavigationController@update');
        Route::delete('{navigation}/delete', 'NavigationController@destroy')->name('navigation.delete');
    });
});

Route::get('/home', 'HomeController@index')->name('home');
