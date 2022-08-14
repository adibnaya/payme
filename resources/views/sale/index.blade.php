@extends('layouts.app')

@section('title','Sales')

@section('content')
    <div>
        <a href="{{url('/sale')}}" class="btn btn-info">Add new sale</a>
        <h1>List of Sales</h1>
    </div>
    <table class="table">
        <tr>
            <th>'Sale number'</th>
            <th>'Description'</th>
            <th>'Amount'</th>
            <th>'Currency'</th>
            <th>'Payment link'</th>
        </tr>

        @foreach($sales as $sale)
            <tr>
                <td>{{$sale->sale_number}}</td>
                <td>{{$sale->description}}</td>
                <td>{{ number_format($sale->amount/100, 2) }}</td>
                <td>{{$sale->currency}}</td>
                <td><iframe src="{{$sale->payment_link}}" width="350px" height="200px"></iframe></td>
{{--                <td><a href="{{$sale->payment_link}}">{{$sale->payment_link}}</a></td>--}}
            </tr>

        @endforeach
    </table>
    {{$sales->links()}}
@endsection
