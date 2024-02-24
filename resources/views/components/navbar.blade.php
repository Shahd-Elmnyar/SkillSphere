<div>
<nav id="nav">
                <form id="logout-form" method="POST" action="{{url('logout')}}" style="display: none;">
                        @csrf
                </form>
                <ul class="main-menu nav navbar-nav navbar-right">

                <li><a href="{{url('/')}}">@lang('web.home')</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('web.categories') <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $category)

                            <li><a href="{{url('categories/show/'.$category->id)}}">
                                    {{$category->name()}}
                                </a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{url('contact')}}">{{__('web.contact')}}</a></li>
                    @guest
                    <li><a href="{{url('login')}}">{{__('web.sign in')}}</a></li>
                    <li><a href="{{url('register')}}">{{__('web.sign up')}}</a></li>
                    @endguest
                    @auth
                    <!-- <input type="submit" value="{{__('web.logout')}}"> -->
                    <li><a id="logout-link" href="#">{{__('web.logout')}}</a></li>
                    @endauth
                    @if(App::getLocale()=='ar')
                    <li><a href="{{url('lang/set/en')}}">En</a></li>
                    @else
                    <li><a href="{{url('lang/set/ar')}}">ع</a></li>
                    @endif
                </ul>
            </nav>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
</div>
