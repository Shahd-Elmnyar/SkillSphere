@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p class="mb-0">{{$error}}</p>
        @endforeach
    </div>
@endif

