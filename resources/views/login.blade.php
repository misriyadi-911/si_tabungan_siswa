<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('bootstrap')}}/css/bootstrap.css">
  <link rel="stylesheet" href="{{asset('bootstrap')}}/style.css">
  <link rel="stylesheet" href="https://fonts.googl.com/css?family?=Poppins:600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('font')}}/css/all.min.css">
  <!-- <title>Form Login</title> -->
</head>
<body>
  <img class="wave" src="{{asset('img')}}/misri.jpg" alt="">
  <div class="container">
    <div class="img">
      <img  src="{{asset('img')}}/itachi.jpg" alt="">
    </div>
    <div class="login-container">
      <form action="{{url('/postLogin')}}" method="POST">
        @csrf
        <img class="avatar" src="{{asset('img')}}/itachi.jpg" alt="">
        <h2>Welcome</h2>
        
        <!-- form input username -->
        <div class="input-div one">
          <div class="i">
            <i class="fas fa-user">
              
            </i>
          </div>
          <div>
            <h5>Username</h5>
            <input type="text" class="input" name="username">
          </div>
        </div>
        <!-- form input password -->
        <div class="input-div two">
          <div class="i">
            <i class="fas fa-lock">
              
            </i>
          </div>
          <div>
            <h5>Password</h5>
            <input type="password" class="input" name="password">
          </div>
        </div>

        <input type="submit" class="btn" value="Login">
      </form>
    </div>
  </div>
  <script type="text/javascript" src="{{asset('bootstrap')}}/js/bootstrap.js"></script>
  <script type="text/javascript" src="{{asset('bootstrap')}}/js/main.js"></script>
  <script src="{{asset('sweetAlert')}}/dist/sweetalert2.all.min.js"></script>
  <script>
    @if(Session::has('login_gagal'))
        Swal.fire({
                      position: 'top-end',
                      icon: 'error',
                      title: 'Username atau Password salah',
                      showConfirmButton: false,
                      timer: 1500
        })
        @endif
  </script>
</body>
</html>