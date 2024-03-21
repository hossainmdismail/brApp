@extends('frontend.layouts.app')

@section('content')
@livewire('frontend.categoryproduct',['slugs' => $slugs])
@endsection
