@extends('web.layout')


@section('title')
    Home page
@endsection

@section('content')
            <!-- Home -->
            <div id="home" class="hero-area">

                <!-- Backgound Image -->
                <div class="bg-image bg-parallax overlay" style="background-image:url('web/img/home-background.jpg')"></div>
                <!-- /Backgound Image -->

                <div class="home-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <h1 class="white-text">@lang('web.heroTitle')</h1>
                                <p class="lead white-text">@lang('web.heroDesc')</p>
                                <a class="main-button icon-button" href="#courses">@lang('web.getStartedBtn')</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /Home -->

            <!-- Courses -->
            <div id="courses" class="section">

                <!-- container -->
                <div class="container">

                    <!-- row -->
                    <div class="row">
                        <div class="section-header text-center">
                            <h2>@lang('web.popularExamTitle')</h2>
                            <p class="lead">@lang('web.popularExamDesc')</p>
                        </div>
                    </div>
                    <!-- /row -->

                    <!-- courses -->
                    <div id="courses-wrapper">

                        <!-- row -->
                        <div class="row">
                        @foreach($PopularExams as $exam)
                                <div class="col-md-3">
                                    <div class="single-blog">
                                        <div class="blog-img">
                                            <a href="{{url("exams/show/{$exam->id}")}}">
                                                <img src="{{ asset("uploads/$exam->img") }}"  alt="">
                                            </a>
                                        </div>
                                        <h4><a href="{{url("exams/show/{$exam->id}")}}">{{ $exam->name() }}</a></h4>
                                        <div class="blog-meta">
                                            <span>{{Carbon\Carbon::parse($exam->created_at)->format("d M, Y")}}</span>
                                            <div class="pull-right">
                                                <span class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> {{$exam->users()->count()}}</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        </div>
                        <!--/row -->
                    </div>
                    <!-- /courses -->



                </div>
                <!-- container -->

            </div>
            <!-- /Courses -->



            <!-- Contact CTA -->
            <div id="contact-cta" class="section">

                <!-- Background Image -->
                <!-- <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/cta.jpg')}})"></div> -->
                <div class="bg-image bg-parallax overlay" style="background-image:url('/web/img/cta.jpg')"></div>

                <!-- Background Image -->

                <!-- container -->
                <div class="container">

                    <!-- row -->
                    <div class="row">

                        <div class="col-md-8 col-md-offset-2 text-center">
                            <h2 class="white-text">@lang('web.contact')</h2>
                            <p class="lead white-text">@lang('web.contactDesc')</p>
                            <a class="main-button icon-button"  href="{{url('contact')}}" >@lang('web.contactBtn')</a>
                        </div>

                    </div>
                    <!-- /row -->

                </div>
                <!-- /container -->

            </div>
            <!-- /Contact CTA -->
@endsection
