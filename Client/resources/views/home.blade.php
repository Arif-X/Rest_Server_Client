@extends('layouts.app')

@section('content')
<div class="container">
    @include('message')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="jumbotron">
                <h4 class="display-4">Daftar Produk PT XX</h4>
                <hr class="my-2">
                <p>Berikut Daftar Produk dari PT XX yang dijual</p>
            </div>
        </div>
        @foreach($data as $item)
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{$item['name']}}</h5>
                    <p class="card-text">{{$item['description']}}</p>
                    <p class="card-text"><small class="text-muted">Lokasi : <b>{{$item['city']['name']}}</b></small></p>
                    <a href="{{route('public.produk.show', $item['id'])}}" class="btn btn-primary btn-block btn-sm">Buy Now!</a>
                </div>
              </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(isset($current_page))
    <?php
        $prev = $current_page - 1;
    ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              @if(($has_next_page == true) && ($has_previous_page == false))
            <li class="page-item"><a class="page-link" href="{{url('home?page='.$next_page)}}">Next</a></li>
        @elseif(($has_next_page == false) && ($has_previous_page == true))
                <li class="page-item"><a class="page-link" href="{{url('home?page='.$prev)}}">Previous</a></li>
        @elseif(($has_next_page == true) && ($has_previous_page == true))
                <li class="page-item"><a class="page-link" href="{{url('home?page='.$prev)}}">Previous</a></li> <li class="page-item"><a class="page-link" href="{{url('home?page='.$next_page)}}">Next</a></li>
        @endif
            </ul>
          </nav>
    @endif
        </div>
    </div>
</div>
@endsection
