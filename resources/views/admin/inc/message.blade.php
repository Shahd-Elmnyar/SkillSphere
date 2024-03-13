@if(session('msg'))
    <div class="alert alert-success">
        {{session('msg')}}
    </div>
@endif
<!-- @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p class="mb-0">{{$error}}</p>
        @endforeach
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif -->

