<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProdukController extends Controller
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

    public function show($id)
    {
        $produk = $this->client->request('GET', 'api/produk/' . $id, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->user['access_token']}"
            ]
        ]);
        $body = $produk->getBody();
        $body = $body->getContents();
        $produk = json_decode($body, true)['data'];

        return view('produk.detail', compact('produk'));
    }

    public function buy(Request $request, $id)
    {
        $input = $request->all();
        $input['produk_id'] = $id;
        $input['total_price'] = $input['total_count'] * $input['price'];

        $produk = $this->client->request('POST', 'api/buy', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$this->user['access_token']}"
            ],
            'form_params' => $input
        ]);
        $body = $produk->getBody();
        $body = $body->getContents();
        $produk = json_decode($body, true)['data'];

        return redirect()->back()->with('message', 'Produk berhasil dipesan');
    }
}
