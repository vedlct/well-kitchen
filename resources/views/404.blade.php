@extends('layouts.layout')
@section('container')

<div class="breadcrumb-area pt-35 pb-35 bg-gray-3">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li class="active">404 Page </li>
            </ul>
        </div>
    </div>
</div>
<div class="error-area pt-40 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 text-center">
                <div class="error">
                    <h1>404</h1>
                    <h2>OPPS! PAGE NOT BE FOUND</h2>
                    <p>Sorry but the page you are looking for does not exist, have been removed, name changed or is temporarity unavailable.</p>
                    <form action="#" class="searchform mb-50">
                        <input type="text" name="search" id="error_search" placeholder="Search..." class="searchform__input">
                        <button type="submit" class="searchform__submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                    <a href="index.html" class="error-btn">Back to home page</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection