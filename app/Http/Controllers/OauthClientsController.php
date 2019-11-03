<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OauthClientsController extends Controller
{
    public function redirect(){
        $query = http_build_query([
            'client_id' => 6, // Replace with Client ID
            'redirect_uri' => 'http://127.0.0.1:8001/auth/callback',//https://dss.borobudur.kemdikbud.go.id/auth/callback
            'response_type' => 'code',
            'scope' => ''
        ]);

        return redirect('http://127.0.0.1:8000/oauth/authorize?'.$query);
    }

    public function callback(){
        $response = (new GuzzleHttp\Client)->post('http://127.0.0.1:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => 6, // Replace with Client ID
                'client_secret' => '6EZX7h5nVy1Xi1VzKnsBz8Ca97ioQNtiVwk29GgO', // Replace with client secret
                'redirect_uri' => 'http://127.0.0.1:8001/auth/callback',
                'code' => $request->code,
            ]
        ]);
    
        session()->put('token', json_decode((string) $response->getBody(), true));
        return redirect('/home');
    }

    public function getUser(){
        $response = (new GuzzleHttp\Client)->get('http://127.0.0.1:8000/api/user/get', [
            'headers' => [
                'Authorization' => 'Bearer '.session()->get('token.access_token'),
                'accept' => 'application/json'
            ]
        ]);
        // $resp = json_decode((string) $response->getBody(), true);
        session()->put('user', json_decode((string) $response->getBody(), true));
        return view('welcome');
    }
}
