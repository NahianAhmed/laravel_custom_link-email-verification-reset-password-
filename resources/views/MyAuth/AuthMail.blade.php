<p>
Hello {{Session('name')}},
</p>
                                                                  <!--  Define your link here  -->
<h4>To create an account in our system click here <a href="http://192.168.0.104/laravel_auth_link/Verify/{{Session('name')}}/{{Session('token')}}">http://192.168.0.104/laravel_auth_link/Verify/{{Session('name')}}/{{Session('token')}}</a></h4>
<p>Please Ignore this If you don't request for Create Account </p>
<p>Sent By Nahian Auth</p>
