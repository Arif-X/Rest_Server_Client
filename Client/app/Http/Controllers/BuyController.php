<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    private $client;
    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->client = new Client(['base_uri' => 'http://localhost:8000/']);
            $this->user = session()->get('user');
            return $next($request);
        });
    }

    public function index()
    {
        $data = $this->client->request('GET', 'api/buy', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->user['access_token']}"
            ]
        ]);
        $body = $data->getBody()->getContents();
        $data = json_decode($body, true)['data'];

        return view('buy.index', compact('data'));
    }
}
