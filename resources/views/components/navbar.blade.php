<div>
<nav id="nav">
                <ul class="main-menu nav navbar-nav navbar-right">

                <li><a href="index.html">@lang('web.home')</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('web.categories') <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach($categories as $category)

                            <li><a href="{{url('categories/show/{$category->id}')}}">
                                    {{$category->name()}}
                                </a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="contact.html">@lang('web.contact')</a></li>
                    <li><a href="login.html">@lang('web.sign in')</a></li>
                    <li><a href="register.html">@lang('web.sign up')</a></li>
                    @if(App::getLocale()=='ar')
                    <li><a href="{{url('lang/set/en')}}">En</a></li>
                    @else
                    <li><a href="{{url('lang/set/ar')}}">ع</a></li>
                    @endif
                </ul>
            </nav>
    <!-- You must be the change you wish to see in the world. - Mahatma Gandhi -->
</div>
