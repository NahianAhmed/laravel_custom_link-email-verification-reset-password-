<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login/Sign-In</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="public/login-page-asset/css/style.css">
     <link rel="stylesheet" type="text/css" href="public/asset/css/bootstrap.min.css" />

</head>

<body >
  <div class="logmod" >
  <div class="logmod__wrapper" >
    <span class="logmod__close">Close</span>
    <div class="logmod__container" >
      <ul class="logmod__tabs">
                @if(session('msg'))

               <p class="alert alert-danger">{{session('msg')}}</p>

                @endif


        <li data-tabtar="lgm-2"><a href="#">Login</a></li>
        <li data-tabtar="lgm-1"><a href="#">Verification for Sign Up</a></li>
      </ul>
      <div class="logmod__tab-wrapper" >
      <div class="logmod__tab lgm-1"  >
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Enter your personal details <strong>to create an acount</strong></span>
        </div>
        <div class="logmod__form">




          <form accept-charset="utf-8" action="{{url('/Authlink')}}" method="POST" class="simform">
          @csrf
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Name*</label>
                <input class="string optional" maxlength="255" name="name" placeholder="Your Name" type="text" size="50"  required />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" name="email" placeholder="Email" type="email" size="50" required />
              </div>
            </div>


            <div class="simform__actions">
              <input class="sumbit" name="" type="submit" value="Verify me" />
              <span class="simform__actions-sidetext">By creating an account you agree to our <a class="special" href="#" target="_blank" role="link">Terms & Privacy</a></span>
            </div>
          </form>
        </div>

      </div>
      <div class="logmod__tab lgm-2">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Enter your email and password <strong>to sign in</strong></span>
        </div>
        <div class="logmod__form">
          <form accept-charset="utf-8" action="{{url('/loginVerify')}}" method="POST" class="simform">
          @csrf
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" id="user-email" name="email" placeholder="Email" type="email" size="50"  required />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" id="user-pw" placeholder="Password" name="password" type="password" size="50"   required/>
                						<span class="hide-password">Show</span>
              </div>
            </div>

            <div class="simform__actions">
              <input class="sumbit" name="commit" type="submit" value="Log In" />
              <span class="simform__actions-sidetext"><a class="special" role="link" href="{{url('forget_password')}}">Forgot your password?<br>Click here</a></span>
            </div>
        </div>

          </form>


          </div>
      </div>
    </div>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="public/login-page-asset/js/index2.js"></script>

</body>
</html>
