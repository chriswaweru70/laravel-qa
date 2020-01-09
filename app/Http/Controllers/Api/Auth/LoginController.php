<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $request->request->add([
          'grant_type' => 'password',
          'client_id' => 2,
          'client_secret' => 'bApxfVp2c8Rtc4e2pUft1vp9vS8IPUHklEAngoKf',
          'username' => $request->username,
          'password' => $request->password,
        ]);

        //Request::create('http://localhost:8000/oauth/token')
        //how to make it work in production/development
        $tokenRequest = Request::create(env('APP_URL') . '/oauth/token', 'post');
        $response = Route::dispatch($tokenRequest);
        return $response;
    }
    public function destroy(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->noContent();
    }
}
