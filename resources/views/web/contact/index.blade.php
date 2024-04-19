@extends('web.layout')
@section('title')
{{__('web.contact')}}
@endsection
@section('content')
		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
            <div class="bg-image bg-parallax overlay" style="background-image:url('web/img/cta.jpg')"></div>

			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.html">{{__('web.home')}}</a></li>
							<li>{{__('web.contact')}}</li>
						</ul>
						<h1 class="white-text">{{__('web.contactDesc')}}</h1>

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

					<!-- contact form -->
					<div class="col-md-6">
						<div class="contact-form">
							<h4>{{__('web.SendAMessage')}}</h4>
                            @include('web.inc.message')
							<form method="POST" action="{{url('contact/message/send')}}">
								@csrf
								<input class="input" type="text" name="name" placeholder="{{__('web.name')}}">
								<input class="input" type="email" name="email" placeholder="{{__('web.email')}}">
								<input class="input" type="text" name="subject" placeholder="{{__('web.subject')}}">
								<textarea class="input" name="body" placeholder="{{__('web.EnterYourMessage')}}"></textarea>
								<button type= "submit" class="main-button icon-button pull-right">{{__('web.Send')}}</button>
							</form>
						</div>
					</div>
					<!-- /contact form -->

					<!-- contact information -->
					<div class="col-md-5 col-md-offset-1">
						<h4>{{__('web.contactInformation')}}</h4>
						<ul class="contact-details">
							<li><i class="fa fa-envelope"></i> {{$setting->email}}</li>
							<li><i class="fa fa-phone"></i>{{$setting->phone}}</li>
						</ul>

					</div>
					<!-- contact information -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->
@endsection