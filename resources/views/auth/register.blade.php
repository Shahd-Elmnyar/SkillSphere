@extends('web.layout')
@section('title')
{{__('web.sign up')}}
@endsection
@section('content')

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
            <div class="bg-image bg-parallax overlay" style="background-image:url('web/img/auth.jpg')"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.html">{{__('web.home')}}</a></li>
							<li>{{__('web.sign up')}}</li>
						</ul>
						<h1 class="white-text">{{__('web.signUpDesc')}}</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- login form -->
					<div class="col-md-6 col-md-offset-3">
						<div class="contact-form">
							<h4>{{__('web.sign up')}}</h4>
                            @include('web.inc.message')
							<form method="POST" action="{{ url('/register') }}">
								@csrf
								<input class="input" type="text" name="name" placeholder="{{__('web.name')}}">
								<input class="input" type="email" name="email" placeholder="{{__('web.email')}}">
								<input class="input" type="password" name="password" placeholder="{{__('web.password')}}">
								<input class="input" type="password" name="password_confirmation" placeholder="{{__('web.confirmPassword')}}">
								<button type="submit" class="main-button icon-button pull-right">{{__('web.signUpBtn')}}</button>
							</form>
						</div>
					</div>
					<!-- /login form -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->
@endsection