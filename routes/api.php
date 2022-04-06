<?php


use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\AuthController;
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


//Public routes
//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/login', [AuthController::class, 'login']);
//Route::get('/produtos', [ProdutosController::class, 'index']);

//Protect routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/produtos', [ProdutosController::class, 'store']);
    Route::put('/produtos/{id}', [ProdutosController::class, 'update']);
    Route::delete('/produtos/{id}', [ProdutosController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();
    $user = Auth::user();
    return response()->json($user, 200);
});
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Login routes
Route::post('/login', function(Request $request){

    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        $user = Auth::user();
        $token = $user->createToken('JWT');
        return response()->json($token->plainTextToken, 200);
    }
     return response()->json('nao-autenticado', 401);
});

/*
Route::get('/produtos', [ProdutosController::class, 'index']);
Route::get('/produtos/{id}', [ProdutosController::class, 'show']);
Route::get('/produtos/search/{name}', [ProdutosController::class, 'search']);
*/

//Testes realizados
//Route::resource('produtos', ProdutosController::class);
//Route::get('/teste', function(){return ['status' => true];});
//Route::post('/produtos', [ProdutosController::class, 'store']);
//Route::post('/produtos', [ProdutosController::class, 'show']);