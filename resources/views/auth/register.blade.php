<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('styles/bootstrap-3.1.1/css/bootstrap.min.css') }}">
</head>
<body>

    <div class="container">
        <div class="row" style="margin-top: 45px">
            <div class="col-md-4 col-md-offset-4">
                <h4>User Register</h4>
                <hr>
                <form action="{{ route('auth.create') }}" method="post">
                    @csrf
                     <!-- contrele de alerta de sucesso-->
                    <div class="results">
                        @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                            <!-- contrele de alerta de error-->
                         @if(Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                            @endif
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name') }}">
                        <!-- validacao com controle-->
                        <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                    </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email"  value="{{ old('email') }}">
                          <!-- validacao com controle-->
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
                     <div class="form-group">
                        <label for="">Password</label>
                        <input type="Password" class="form-control" name="password" placeholder="Enter password">
                          <!-- validacao com controle-->
                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Register</button>
                    </div>
                    <br>
                    <a href="/">I already have account!</a>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>