<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $response = $client->request('POST', 'api/auth/login', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($data)
        ]);
        $body = $response->getBody();
        $body = json_decode($body->getContents(), true);
        $user = $this->getUser($body)['data'];
        $data = [
            'user' => $user,
            'access_token' => $body['access_token']
        ];
        session()->put('user', $data);

        return redirect()->route('home');
        // return $this->guard()->attempt(
        //     $this->credentials($request),
        //     $request->filled('remember')
        // );
    }

    public function getUser($req)
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);
        $response = $client->request('GET', 'api/auth/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$req['access_token']}"
            ]
        ]);

        $body = $response->getBody();
        $body = $body->getContents();
        return json_decode($body, true);
    }

    public function logout(Request $request)
    {
        session()->flush();

        return redirect('/login');
    }
}
