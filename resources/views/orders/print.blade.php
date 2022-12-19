@extends('layouts.app')

@section('content-header')
    <h1 class="m-0">Ticket</h1>
@endsection

@section('content')
    <embed src="{{ asset($filePath) }}" style="width: 100%; height: 80vh;" frameborder="0">
@stop
