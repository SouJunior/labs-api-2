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
use App\Http\Controllers\Member\EditMemberController;
use App\Http\Controllers\Member\ListMemberController;
use App\Http\Controllers\Member\ShowMemberController;
use App\Http\Controllers\User\PermissionUserController;
use App\Http\Controllers\Member\CreateMemberController;
use App\Http\Controllers\Member\DeleteMemberController;
use App\Http\Controllers\Product\EditProductController;
use App\Http\Controllers\Product\ListProductController;
use App\Http\Controllers\Product\ShowProductController;
use App\Http\Controllers\Product\ActiveProductController;
use App\Http\Controllers\Product\CreateProductController;
use App\Http\Controllers\Product\DeleteProductController;

Route::match(['get', 'post', 'head', 'options'], '/', [IndexController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [ListUserController::class, '__invoke'])
        ->name('api.users.list');

    Route::get('/products/{userUuid}', [ListProductController::class, '__invoke'])
        ->whereUuid('userUuid')
        ->name('api.products.list');

    Route::get('/squads/{productUuid}', [ListSquadController::class, '__invoke'])
        ->whereUuid('productUuid')
        ->name('api.squad.list');

    Route::get('/squads/', [ListSquadController::class, '__invoke'])
        ->name('api.squads.list');

    Route::get('/squad/{uuid}/members', [ListMemberController::class, '__invoke'])
        ->whereUuid('uuid')
        ->name('api.members.list');

    Route::get('/login', function (Request $request) {
        return $request->user();
    });

    Route::prefix('user')->group(function () {

        Route::post('/permission/{uuid}', [PermissionUserController::class, '__invoke'])
            ->whereUuid('uuid')
            ->name('api.user.permission');

        Route::put('/{uuid}', [EditUserController::class, '__invoke'])
            ->whereUuid('uuid')
            ->name('apr.user.edit');

        Route::delete('/{uuid}', [DeleteUserController::class, '__invoke'])
            ->whereUuid('uuid')
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

Route::get('/products', [ListProductController::class, '__invoke'])
    ->name('api.products.list');

Route::post('/login', [AuthController::class, 'login'])
    ->name('api.login');

Route::prefix('user')->group(function () {
    Route::post('/', [CreateUserController::class, '__invoke'])
        ->name('api.user.create');
});