@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-inverse">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Nama produk</th>
                                <th>Jumlah Produk</th>
                                <th>Total bayar</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{$item['produk']['name']}}</td>
                                    <td>{{$item['total_count']}} Barang</td>
                                    <td>Rp. {{number_format($item['total_price'])}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
