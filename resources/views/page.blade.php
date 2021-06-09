@extends('layouts.layout')
@section('container')
<div class="welcome-area pt-100 pb-95">
    <div class="container">
        <div class="welcome-content text-center">
            
            <p>{!! $page->details !!}</p>
        </div>
    </div>
</div>

@endsection