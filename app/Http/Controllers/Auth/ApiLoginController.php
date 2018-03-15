<?php

namespace App\Http\Controllers\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiLoginController extends Controller
{

    /**
     * Filtros de autenticação para os métodos
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['authenticate'],
        ]);
    }


    /**
     * Autenticação do usuário
     *
     * @param  \Illuminate\Http\Request $request
     * @return JSON token
     */
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // Recovering user authenticated
        $user = auth()->user();

        // all good so return the token
        return response()->json(compact('token', 'user'));
    }


    /**
     * Usuário autenticado pelo token
     *
     * @return Object user
     */
    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }



    /**
     * Atualiza o token
     *
     * @return JSON token
     */
    public function refreshToken()
    {
        if( !$token = JWTAuth::getToken() )
            return response()->json(['error' => 'token_not_send'], 401);
        
        try {
            $token = JWTAuth::refresh($token);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], 401);
        }
        
        return response()->json(compact('token'));
    }
}
