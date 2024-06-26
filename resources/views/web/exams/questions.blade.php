@extends('web.layout')
@section('title')
Questions - {{$exam->name()}}
@endsection
@section('styles')
<link href="{{asset('web/css/TimeCircles.css')}}" rel="stylesheet">
@endsection
@section('content')

<!-- Hero-area -->
<div class="hero-area section">
    <!-- Background Image -->
    <!-- Simplified Example -->
<div class="bg-image bg-parallax overlay" style="background-image:url('/web/img/home-background.jpg')"></div>

    <!-- /Background Image -->

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.html">{{__('web.home')}}</a></li>
                    <li><a href="{{url("categories/show/{$exam->skill->categorie->id}")}}">{{$exam->skill->categorie->name()}}</a></li>
                    <li><a href="{{url("skills/show/{$exam->skill->id}")}}">{{$exam->skill->name()}}</a></li>
                    <li>{{$exam->name()}}</li>
                </ul>
                <h1 class="white-text">{{$exam->name()}}</h1>
                <ul class="blog-post-meta">
                    <li>{{Carbon\Carbon::parse($exam->created_at)->format("d M, Y")}}</li>
                    <li class="blog-meta-comments"><a href="#"><i class="fa fa-users"></i> {{$exam->users()->count()}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Hero-area -->

<!-- Blog -->
<div id="blog" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- main blog -->
            <div id="main" class="col-md-9">
                <form id="exam-submit-form" method="POST" action="{{url("exams/submit/{$exam->id}")}}">@csrf</form>
                <!-- blog post -->
                <div class="blog-post mb-5">
                    <p>
                        @foreach($exam->questions as $index => $question)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{$index+1}}- {{$question->title }}</h3>
                        </div>
                        <div class="panel-body">
                            @for ($i=1; $i <= 4; $i++) <div class="radio">
                                <label>
                                    <input type="radio" name="answers[{{$question->id}}]" id="optionsRadios1" value="{{$i}}" form="exam-submit-form">
                                    {{$question->{'option_'.$i} }}
                                </label>
                        </div>
                        @endfor
                    </div>
                </div>
                @endforeach
                </p>
            </div>
            <div>
                <button type="submit" form="exam-submit-form" class="main-button icon-button pull-left">Submit</button>
                <button class="main-button icon-button btn-danger pull-left ml-sm">Cancel</button>
            </div>
            <!-- /blog post -->
        </div>
        <!-- /main blog -->

        <!-- aside blog -->
        <div id="aside" class="col-md-3">
            <!-- exam details widget -->
            <ul class="list-group">
                <li class="list-group-item">Skill: {{$exam->skill->categorie->name()}}</li>
                <li class="list-group-item">Questions: {{$exam->questions_number}}</li>
                <li class="list-group-item">Duration: {{$exam->duration_mins}} mins</li>
                <li class="list-group-item">Difficulty:
                    @for ($i=1; $i <= $exam->difficulty ; $i++)
                        <i class="fa fa-star"></i>
                        @endfor
                        @for ($i=1; $i <= 5-$exam->difficulty ; $i++)
                            <i class="fa fa-star-o"></i>
                            @endfor
                </li>
            </ul>
            <!-- /exam details widget -->
            <div class="duration-countdown" data-timer="{{$exam->duration_mins*60}}"></div>
        </div>
        <!-- /aside blog -->

    </div>
    <!-- row -->

</div>
<!-- container -->

</div>
<!-- /Blog -->

@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('web/js/TimeCircles.js')}}"></script>
<script>
    $(".duration-countdown").TimeCircles({
        time: {
            Days: {
                show: false,
            }
        },
        count_past_zero: false,
    }).addListener(function(unit,value,total){
        if(total <= 0){
            $('exam-submit-form').submit()
        }
    });
</script>
@endsection