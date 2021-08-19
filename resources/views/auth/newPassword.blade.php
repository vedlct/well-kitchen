@extends('auth.authLayout')
@section('content')
<section class="login-with-phn py-5">
    <div class="container">
        <div class="main-row row justify-content-center align-items-center">
            <div class="col-lg-4 col-md-6 col-10">
                <div class="wrapper">
                    <h5 class="heading">Update password</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('Login.passwordSave')}}" method="POST">
                        @csrf
                        <div class="mobile-no-field input-group mb-4">
                            <input type="password" name="password" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Password*">
                        </div>
                        <div class="mobile-no-field input-group mb-4">
                            <input type="password" name="confirm_password" class="form-control" id="inlineFormInputGroupUsername3" placeholder="Confirm Password*">
                        </div>
                        <input type="submit" class="btn text-uppercase w-100" value="Save"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection