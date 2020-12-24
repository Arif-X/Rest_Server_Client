<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->model = Produk::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->model::with('city')->paginate(10);

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $data = $this->model::create($input);

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model::with('city')->find($id);

        if (empty($data)) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->model::find($id);

        if (empty($data)) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'data' => []
            ], 404);
        }

        $input = $request->all();

        $data = $data->update($input);

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->model::find($id);

        if (empty($data)) {
            return response()->json([
                'status' => 404,
                'success' => false,
                'data' => []
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => true
        ], 200);
    }
}
