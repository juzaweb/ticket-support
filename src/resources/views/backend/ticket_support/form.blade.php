@extends('cms::layouts.backend')

@section('content')
    @if($model->id)
        @include('jwts::backend.ticket_support.components.view-form')
    @else
        @include('jwts::backend.ticket_support.components.create-form')
    @endif
@endsection
