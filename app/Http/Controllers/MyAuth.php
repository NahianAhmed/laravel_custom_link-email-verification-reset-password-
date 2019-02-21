<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Mail;
use Hash;
use App\UserTable;
use App\MyAuth_Token;

class MyAuth extends Controller
{
    public function ShowLogin(){

            return view('MyAuth.login');

    }
    public function SentAuthLink(Request $request){
        $this->validation($request);
        $email=strtolower($request->email);
        //Delete token if Request Again
        if($user = MyAuth_Token::where('email',$email)->first()){
        $user = MyAuth_Token::find($user->id);
        $user->delete();
        }
        if($user = UserTable::where('email',$email)->first()){
            return back()->with('msg','Email already used');
            }
        //
        //adding to token table
        $token=rand(100000, 999999);
        $data=new MyAuth_Token();
        $data->name=$request->name;
        $data->email=$email;
        $data->mobile=$request->mobile;
        $data->birthdate=$request->birthdate;
        $data->password=bcrypt($request->password);
        $data->token=$token;
        $data->save();
        //putting in seasion
        Session::put('name',$data->name);
        Session::put('token',$token);

        //mail
        $maildata=$request->toArray();
        Mail::send('MyAuth.AuthMail',$maildata,function($massage) use ($maildata)
        {
        $massage->to($maildata['email']);
        $massage->subject('Email Verification Link');

        });
        //end mail

        return back()->with('msg','We sent you a link Plz Check email');

   }

   public function VerifyLink($name,$token){
       if( $data=MyAuth_Token::where('name',$name)->first()){

        if($data->token==$token){

        $user=new UserTable();
        $user->name=$data->name;
        $user->email=$data->email;
        $user->mobile=$data->mobile;
        $user->birthdate=$data->birthdate;
        $user->user_type='user';
        $user->password=$data->password;
        $user->save();
        return redirect('/login')->with('msg',"Your Account is ready Plz login");
    }

       }
       return redirect('/login')->with('msg',"link Unauthorized");

   }

   public function validation($request){
    return  $this->Validate($request, [
          'name' => 'required|max:100|min:6',
          'email' => 'required|email|max:50',
          'mobile' => 'required|max:14|min:11',
          'birthdate' => 'required|max:25',
          'password' => 'required|confirmed|max:55|min:6',

      ]);
  }

public function VerifyLogin(Request $request){
    if($data = UserTable::where('email',$request->email)->first())
    {
        if($data->email == $request->email && Hash::check($request->password,$data->password)){
            $user_type=$data->user_type;
            Session::put('UserSession',$data->name);
            Session::put('User_email',$data->email);
            Session::put('UserType',$user_type);

                if($user_type=='admin'){

                    return redirect('/Admin-Dashbord');

                }
                elseif($user_type=='user'){

                    return redirect('/User-Dashbord');
                }

        }
        else{
            return redirect('/login')->with('msg','Password Wrong');
        }


    }
     else{
        return redirect('/login')->with('msg','You Aren\'t Sign up Yet!');
     }

  }





}
