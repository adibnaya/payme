@extends('layouts.app')

@section('title','Create new Sale')

@section('content')

    <h1>Create Sale</h1>
    <form method="post" action="{{action('SaleController@store')}}">
        @csrf
        <div class="form-group">
            <label for="description">Product name</label>
            <input type="text" class="form-control" name="description">
        </div>
        <div class="form-group">
            <label for="amount">Price</label>
            <input type="number" class="form-control" name="amount">
        </div>
        <div class="form-group">
            <label for="currency">Currency</label>
            <select class="form-control" name="currency">
                @foreach($currencies as $currency)
                    <option value="{{$currency}}">{{$currency}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <input type="submit" name="submit" value="Insert payment details">
        </div>
    </form>
@endsection
