@extends('app')

@section('content')

@if ($bases->count() > 0)
<h1 align="center" class="color-title my-2">LISTING {{$bases->count()}} DATABASE </h1>
<x-bases-list :bases="$bases"/>
@else
<h1 align="center" class="color-title my-2">No Database to show</h1>

@endif


@endsection
