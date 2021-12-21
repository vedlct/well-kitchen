@extends('layouts.layout')
@section('title', @$page->pageTitle)
@section('meta_keywords', @$page->meta_keywords)
@section('meta_description', @$page->meta_description)
@section('container')
<div class="welcome-area pt-100 pb-95">
    <div class="container">
        <div class="welcome-content text-center">

            <p>{!! $page->details !!}</p>
        </div>
    </div>
</div>

@endsection
