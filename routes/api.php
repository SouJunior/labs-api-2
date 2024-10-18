<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\User\EditUserController;
use App\Http\Controllers\User\ListUserController;
use App\Http\Controllers\Squad\EditSquadController;
use App\Http\Controllers\Squad\ListSquadController;
use App\Http\Controllers\Squad\ShowSquadController;
use App\Http\Controllers\User\CreateUserController;
use App\Http\Controllers\User\DeleteUserController;
use App\Http\Controllers\Squad\CreateSquadController;
use App\Http\Controllers\Squad\DeleteSquadController;
use App\Http\Controllers\Members\EditMemberController;
use App\Http\Controllers\Members\ListMemberController;
use App\Http\Controllers\Members\ShowMemberController;
use App\Http\Controllers\User\PermissionUserController;
use App\Http\Controllers\Members\CreateMemberController;
use App\Http\Controllers\Members\DeleteMemberController;
use App\Http\Controllers\Products\EditProductController;
use App\Http\Controllers\Products\ListProductController;
use App\Http\Controllers\Products\ShowProductController;
use App\Http\Controllers\Products\ActiveProductController;
use App\Http\Controllers\Products\CreateProductController;
use App\Http\Controllers\Products\DeleteProductController;



Route::match(['get', 'post', 'head', 'options'], '/', [IndexController::class, 'index']);


Route::prefix('api')->group(function () {

    Route::get('/login', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('api.login');

    Route::get('/users', [ListUserController::class, '__invoke'])
        ->name('api.users.list');

    Route::get('/products/{userUuid}', [ListProductController::class, '__invoke'])
        ->whereUuid('userUuid')
        ->name('api.products.list');

    Route::get('/squads/{productUuid}', [ListSquadController::class, '__invoke'])
        ->whereUuid('productUuid')
        ->name('api.squad.list');

    Route::get('/squad/{uuid}/members', [ListMemberController::class, '__invoke'])
        ->whereUuid('uuid')
        ->name('api.members.list');


    Route::prefix('user')->group(function () {

        Route::post('/', [CreateUserController::class, '__invoke'])
            ->name('api.user.create');

        Route::post('/permission/{uuid}', [PermissionUserController::class, '__invoke'])
            ->whereUuid('uuid')
            ->name('api.user.permission');

        Route::put('/{id}', [EditUserController::class, '__invoke'])
            ->where('id', '[0-9]+')
            ->name('apr.user.edit');

        Route::delete('/{id}', [DeleteUserController::class, '__invoke'])
            ->where('id', '[0-9]+')
            ->name('api.user.del');

        // Route::patch('/alterPermissions/{uuid}', [UserController::class, 'alterUserPermission']);
        // Route::patch('/type/{id}', [UserController::class, 'updateUserType']);

    });

    Route::prefix('product')->group(function () {

        Route::get('/{uuid}', [ShowProductController::class, '__invoke'])
            ->whereUuid('uuid')
            ->name('api.product.show');

        Route::post('/', [CreateProductController::class, '__invoke'])
            ->name('api.product.create');

        Route::post('/active/{uuid}', [ActiveProductController::class, '__invoke'])
            ->whereUuid('uuid')
            ->name('api.product.active');

        Route::put('/{uuid}', [EditProductController::class, '__invoke'])
            ->whereUuid('uuid')
            ->name('api.product.edit');

        Route::delete('/{uuid}', [DeleteProductController::class, '__invoke'])
            ->whereUuid('uuid')
            ->name('api.product.del');

    });

    Route::prefix('squad')->group(function () {

        Route::get('/{uuid}', action: [ShowSquadController::class, '__invoke'])
            ->whereUuid('uuid')
            ->name('api.squad.show');

        Route::post('/', [CreateSquadController::class, '__invoke'])
            ->name('api.squad.create');

        Route::put('/{uuid}', [EditSquadController::class, '__invoke'])
            ->whereUuid('uuid')
            ->name('api.squad.edit');

        Route::delete('/{uuid}', [DeleteSquadController::class, '__invoke'])
            ->whereUuid('uuid')
            ->name('api.squad.del');

        Route::prefix('{uuid}/member')->group(function () {

            Route::get('/{memberUuid}', [ShowMemberController::class, '__invoke'])
                ->whereUuid('memberUuid')
                ->name('api.member.show');

            Route::post('/', [CreateMemberController::class, '__invoke'])
                ->name('api.member.create');

            Route::put('/{memberUuid}', [EditMemberController::class, '__invoke'])
                ->whereUuid('memberUuid')
                ->name('api.member.edit');

            Route::delete('/{memberUuid}', [DeleteMemberController::class, '__invoke'])
                ->whereUuid('memberUuid')
                ->name('api.member.del');

        });
    });
});
