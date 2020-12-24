<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $page = $request->get('page');
        $wisata = $this->client->request('GET', "api/produk?page={$page}", [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->user['access_token']}"
            ]
        ]);
        $response = json_decode($wisata->getBody()->getContents(), true);
        $pagination = $response['data'];
        $data = $pagination['data'];
        $numOfpages = $pagination['per_page'];
        $current_page = $pagination['current_page'];
        $has_next_page = empty($pagination['next_page_url']) ? false : true;
        $has_previous_page = empty($pagination['prev_page_url']) ? false : true;
        $next_page = $pagination['current_page'] + 1;
        return view(
            'home',
            compact(
                'data',
                'numOfpages',
                'current_page',
                'has_next_page',
                'has_previous_page',
                'next_page',
            )
        );
    }
}
