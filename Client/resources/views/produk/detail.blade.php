@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('message')
                <form action="{{route('public.produk.buy', $produk['id'])}}" method="POST">
                @csrf
                <input type="hidden" name="price" value="{{$produk['price']}}">
                <div class="card-body">
                    <h4 class="card-title">{{$produk['name']}}</h4>
                    <p class="card-text">{{$produk['description']}}</p>
                    <p class="card-text">Harga  : Rp. <b>{{number_format($produk['price'])}}</b></p>
                    <hr>
                    <div class="form-group row">
                        <label for="" class="col-2">Jumlah Barang</label>
                        <input type="number" name="total_count" class="form-control col-3" min="1">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Beli sekarang</button>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
