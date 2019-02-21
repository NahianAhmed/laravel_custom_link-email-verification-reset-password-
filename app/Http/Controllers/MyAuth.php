<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Mail;
use Hash;
use App\MyAuth_Token;

class MyAuth extends Controller
{
    public function ShowLogin(){

            return view('MyAuth.login');

    }
    public function SentAuthLink(Request $request){
        //Delete token if Request Again
        if($user = MyAuth_Token::where('email',$request->email)->first()){
        $user = MyAuth_Token::find($user->id);
        $user->delete();
        }
        //
        //adding to token table
        $data=new MyAuth_Token();
        $data->name=$request->name;
        $data->email=$request->email;
        $token=bcrypt($request->email);;
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
          if(Hash::check($data->email,$token)){

               return "Link Verified";

           }

       }
       return "link Unauthorized";

   }

}
