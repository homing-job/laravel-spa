<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['admin']], function () {
    // 画面表示用
    Route::get('/', [Controllers\Admin\AdminController::class, 'index'])->name('admin');

    // spa ルーティング用
    Route::get('/spa/{any}', function () {
        return view('admin');
    })->where('any', '.*');

    // api用
    Route::group(['prefix' => 'api'], function () {
        // ログイン系
        Route::group(['prefix' => 'auth'], function () {
            Route::get('/user', function () {
                return Auth::user();
            });
            Route::get('/logout', function () {
                return Auth::logout();
            });
        });

        // 仕事マスタ
        Route::group(['prefix' => 'jobs'], function () {
            Route::get('/', [Controllers\Admin\Master\JobController::class, 'index']);
            Route::post('/', [Controllers\Admin\Master\JobController::class, 'create'])->middleware('job.save.request');
            Route::get('/{id}', [Controllers\Admin\Master\JobController::class, 'find']);
            Route::put('/{id}', [Controllers\Admin\Master\JobController::class, 'update'])->middleware('job.save.request');
            Route::delete('/{id}', [Controllers\Admin\Master\JobController::class, 'destroy']);
            Route::get('/files/excel', [Controllers\Admin\Master\JobController::class, 'excel']);
        });

        // 仕事カテゴリ マスタ
        Route::group(['prefix' => 'job_categories'], function () {
            Route::get('/', [Controllers\Admin\Master\JobCategoryController::class, 'index']);
            Route::post('/', [Controllers\Admin\Master\JobCategoryController::class, 'create'])->middleware('job.category.save.request');
            Route::get('/{id}', [Controllers\Admin\Master\JobCategoryController::class, 'find']);
            Route::put('/{id}', [Controllers\Admin\Master\JobCategoryController::class, 'update'])->middleware('job.category.save.request');
            Route::delete('/{id}', [Controllers\Admin\Master\JobCategoryController::class, 'destroy']);
            Route::get('/files/excel', [Controllers\Admin\Master\JobCategoryController::class, 'excel']);
        });

        // 選考一覧
        Route::group(['prefix' => 'entries'], function () {
            Route::get('/', [Controllers\Admin\EntryController::class, 'index']);
        });
    });
});
