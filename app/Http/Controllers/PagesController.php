<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Event as ModelEvent;
use App\Models\Ticket as ModelTicket;
use App\Models\User as ModelUser;

class PagesController extends Controller{
    public function test(){
        return view('test');
    }

    //     35th International Conference & Annual General Meeting

    // The Nigerian Institution of Mechanical Engineers
    // ( A division of The Nigerian Society of Engineers)
    // National Students' Forum

    // Old English Text
    
    
    public function manager($pagename){
        // return Util::Encode("vrbH", 4, 'int');

        $ignore = ['eventdetail'];

        if (in_array($pagename, $ignore)){
            return 'Go Back Home!';
        }
        
        $v = '';

        try {
            $v = view('templates.welcome_temp.'.$pagename);
        } catch (\Throwable $th) {
            $v = view('templates.welcome_temp.dashboard');
        }
        return $v;
    }

    public function welcome(){
        return view('templates.welcome_temp.welcome');        
    }

    public function myaccount(Request $request){
        // v78R
        if (!$request->session()->has('user')){
            return redirect('/login');   
        }

        $code = $request->session()->get('user');

        try{
            $model = ModelUser::where(['code'=>$code])->first();
            // ["host","blkd","room","10"]
            $rmid = explode(":", $model->roomid);
            $model->hostel = $rmid[0];
            $model->block = $rmid[1];
            $model->room = $rmid[2];
            $model->bunk = $rmid[3];

            if ($model->gender == 'f'){
                $model->gender = 'Female';
            }else{
                $model->gender = 'Male';
            }
            
            // return  $model;
        }catch(\Illuminate\Database\QueryException $ex){ 
            return $ex;
        }

        return view('templates.welcome_temp.myaccount')->with('data',$model);   
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/welcome');   
    }
    public function eventdetails($code){
        // v78R
        try{
            $id = (int) Util::Decode($code, 4, 'str');
            $model = ModelEvent::where(['id'=>$id])->first();
            $model->code = $code;
        }catch(\Illuminate\Database\QueryException $ex){ 
            return $ex;
        }

        return view('templates.welcome_temp.eventdetail')->with('data',$model);        
    }
        

}

class Util{
    public static function Encode($code, $encNum, $type){
        $join = '';
        for ($i = 0; $i < $encNum - strlen($code); $i++) {
            $join .= '0';
        }
        $code = $join . $code;

        $Res = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        if ($type == 'str'){
            $Res = 'ZgBoFklNOaJKLM5XYh12pqr6wQRSTdefijAPbcU4mnVW0stuv78xyzGCDE3HI9';
        }        
        $tlenght = strlen($Res);
        $rtl = '';
        for ($i = 0; $i < strlen($code); $i++) {
            $el = $code[$i];
            $k = (strpos($Res, $el) + $encNum + $i) % $tlenght;
            $rtl .=  substr($Res, $k, 1);
        }
        return $rtl;
    }
    public static function Decode($code, $encNum, $type){
        $Res = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        if ($type == 'str'){
            $Res = 'ZgBoFklNOaJKLM5XYh12pqr6wQRSTdefijAPbcU4mnVW0stuv78xyzGCDE3HI9';
        }  
        $tlenght = strlen($Res);
        $rtl = '';
        for ($i = 0; $i < strlen($code); $i++) {
            $el = $code[$i];
            $k = (strpos($Res, $el) - $encNum - $i + $tlenght) % $tlenght;
            $rtl .=  substr($Res, $k, 1);
        }
        return $rtl;
    }
}
 