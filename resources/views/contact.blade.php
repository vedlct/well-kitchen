@extends('layouts.layout')
@section('container')
<div class="contact-area pt-100 pb-100">
    <div class="container">
        <div class="custom-row-2">
            <div class="col-lg-4 col-md-5">
                <div class="contact-info-wrap">
                    <div class="single-contact-info">
                        <div class="contact-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="contact-info-dec">
                            <p>{{$setting->phone}}</p>
                        </div>
                    </div>
                    <div class="single-contact-info">
                        <div class="contact-icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="contact-info-dec">
                            <p><a href="#">{{$setting->email}}</a></p>
                        </div>
                    </div>
                    <div class="single-contact-info">
                        <div class="contact-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="contact-info-dec">
                            <p>{{$setting->address}}</p>
                        </div>
                    </div>
                    <div class="contact-social text-center">
                        <h3>Follow Us</h3>
                        <ul>
                            <li><a href=" {{$setting->facebook}} "><i class="fa fa-facebook"></i></a></li>
                            <li><a href=" {{$setting->twitter}} "><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="contact-form">
                    <div class="contact-title mb-30">
                        <h2>Get In Touch</h2>
                    </div>
                    <form class="contact-form-style" id="contact-form" action=" {{route('contact.submit')}} " method="POST" >
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input name="name" placeholder="Name*" type="text">
                                @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <input name="email" placeholder="Email*" type="email">
                                @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <input name="subject" placeholder="Subject*" type="text">
                                @error('subject')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <textarea name="message" placeholder="Your Message*"></textarea>
                                @error('message')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button class="submit" type="submit">SEND</button>
                            </div>
                        </div>
                    </form>
                    <p class="form-messege"></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection