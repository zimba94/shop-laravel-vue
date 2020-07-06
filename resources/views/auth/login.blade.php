@extends('auth.contenido')

@section('login')


<div class="account">
  <div class="container">
    <h2>Login</h2>
    <div class="account_grid">
        <div class="col-md-6 login-right">   
          <form class="form-horizontal was-validated" method="POST" action="{{ route('login')}}">
            @csrf
                <div class="card-body">
                <h1>Access control</h1>
                <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                  <input type="text" value="{{old('email')}}" name="email" id="email" class="form-control" placeholder="Email">
                  {!!$errors->first('email','<span class="invalid-feedback">:message</span>')!!}
                </div>
                <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                  {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                </div>
                <div class="row">
                  <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                  </div>
                </div>
              </div>
            </form>
        </div>	
        <div class="clearfix"> </div>
      </div>
  </div>
</div>
         
@endsection
