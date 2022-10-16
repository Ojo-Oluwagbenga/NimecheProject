<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Event as ModelEvent;
use App\Models\Ticket as ModelTicket;
use App\Models\User as ModelUser;
use Illuminate\Support\Facades\DB;


use App\Hash\JSymbols\JSymbol;

class ApiController extends Controller{

    public function manager(Request $request, $class_name, $func_name){
        $managedclasses = [
            'User' => (new User),
            'Event' => (new Event),
            'Ticket' => (new Ticket),
        ];

        try{
            $tokenfromclient = $request->header('X-CSRF-TOKEN', 'default');
            $tokenfromserver = csrf_token();
            if ($tokenfromclient === $tokenfromserver){
                                
                $response = ($managedclasses[ucfirst($class_name)])->$func_name($request);
                
                return $response;
            }else{
                $ret = [
                    'response' => 'failed',
                    'reason' => 'Invalid Token',
                    'data' => '',
                ];
                return json_encode($ret);
            }


        } catch (\Throwable $th) {
            $ret = [
                'response' => 'failed',
                'reason' => $th->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }

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
        $Res = 'ZgBoFklNOaJKLM5XYh12pqr6wQRSTdefijAPbcU4mnVW0stuv78xyzGCDE3HI9';
        if ($type == 'int'){
            $Res = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
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
 
class User{

    private $valset =  [
        'name' => ['required', 'min:4', 'max:25', 'string'],
        'email' => ['required', 'email'],
        'password' => ['required', 'min:5', 'max:25'],
        'code' => ['required'],
        'gender' => ['required'],
        'institution' => ['required'],
        'role' => ['required'],
        'description' => ['min:10', 'max:255'],
        'ticketstate' => [],
        'ticketsharer' => [],
    ];

    // private secrethash($txt){
        
    //     // Store the cipher method
    //     $ciphering = "AES-128-CTR";
        
    //     // Use OpenSSl Encryption method
    //     $iv_length = openssl_cipher_iv_length($ciphering);

    //     $options = 0;
        
    //     // Non-NULL Initialization Vector for encryption
    //     $encryption_iv = '1234567891011121';
        
    //     // Store the encryption key
    //     $encryption_key = "GeeksforGeeks";
        
    //     // Use openssl_encrypt() function to encrypt the data
    //     $encryption = openssl_encrypt($simple_string, $ciphering,
    //     $encryption_key, $options, $encryption_iv);
    // }
    public function loadaccepts_token(){
        $ret = [];
        // for ($i=1912; $i < 12000; $i+=67) { 
        //     array_push($ret, Util::Encode($i, 4, 'int'));
        // }

        $j = new JSymbol();

        return json_encode($ret);
    }
    private function getIdByCode($code){
        $idcode = end(explode("/", $code));
        return Util::Decode($idcode, 4, 'int');
    }
    
    public function getall_userabout($request){
        $data = $request->all();


        $model = ModelUser::select(['description', 'name'])->where('description', '!=','')->get();

        if (count($model) === 0){
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => 'No Entry',
            ];
        }

        $ret = [
            'response' => 'passed',
            'reason' => '',
            'data' => $model,
        ];

        return json_encode($ret);
                
    }

    

    public function addnew($request){
        $data = $request->all();

        $userallowed = ['2FD5', 'SH45'];
        $admin = ['admin'];

        $data['ticketsharer'] = '1';
        $data['ticketstate'] = '0';

        if (!in_array($data['code'], $userallowed)){
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => [
                    'code'=>['Code does not exist']
                ],
            ];
            return json_encode($ret);
        }

        $validator = Validator::make($data, [
            'name' => ['required', 'min:4', 'max:25', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'max:25'],
            'code' => ['required'],
            'gender' => ['required'],
            'institution' => ['required'],
            'role' => ['required'],
            'ticketstate' => [],
            'ticketsharer' => [],
        ]); 
        if ($validator->fails()) {
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => json_encode($validator->errors()->get('*')),
            ];
            return json_encode($ret);
        }
        
        
        try{
            $user = ModelUser::where(['code' => $data['code']])->orWhere(['email' => $data['email']])->get();
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }
        
        if (count($user) !== 0){
            $ret = [
                'response' => 'failed',
                'reason' => 'User already exists',
                'data' => '',
            ];
            return json_encode($ret);
        }

        $usersinroom = ModelUser::select('roomid', 'roomcount')->where(  [ ['institution', $data['institution']] , ['gender' => $data['gender']] ]  )->get();

        
        $uroom = $this->getRoom($usersinroom, $data['gender']);
        
        $user = new ModelUser;
        $uid = (int) getIdByCode($data['code']);


        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->code = $data['code'];
        $user->gender = $data['gender'];
        $user->institution = $data['institution'];       
        $user->description = isset($data['description']) ? $data['description']: '';       
        $user->roomid = $uroom[0]; 
        $user->bunknumber = $uroom[1]+1;
        $user->roomcount = $uroom[2]+1;
        $user->role = isset($data['role']) ? $data['role']: 'member';
        $user->ticketstate = '0';
        $user->ticketsharer = (string) ($uid%4 + 1);
        
        try{
            $user->save();
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }
        
        
        if (isset($data['redir'])){
            $this->startsession($request, $data['code'], $data['name']);
        }

        $type = 'Admin';
        // if code is in user allowed type will  be Member
        $ret = [
            'response' => 'passed',
            'data' => [
                'user' =>  $data['code'],
                'type' => $type
            ],
        ];
        return json_encode($ret);
        
    }

    public function update($request){
        $data = $request->all();


        $updset = ($data['updset']);
        $updpair = ($data['updpair']);

        unset($updset['code']);
        unset($updset['email']);
        unset($updset['institution']);
        unset($updset['gender']);

        
        $updvaller = [];

        foreach($updset as $key => $val){
            if (isset($this->valset[$key])){
                $updvaller[$key] = $this->valset[$key];
            }else{
                unset($updset[$key]);
            }
        }

        $validator = Validator::make($updset, $updvaller);
        if ($validator->fails()) {
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => json_encode($validator->errors()->get('*')),
            ];
            return json_encode($ret);
        }

        
        
        
        try{
            $user = ModelUser::where([$updpair[0] => $updpair[1]])->get(['code']);
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }

        
        
        if (count($user) === 0){
            $ret = [
                'response' => 'failed',
                'reason' => 'valerrorpop',
                'data' => 'User not found',
            ];
            return json_encode($ret);
        }

        $user = ModelUser::where([$updpair[0] => $updpair[1]])->first();

        

        foreach($updset as $key => $val){
            $user->$key = $val;
        }
        
        try{
            $user->save();
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }

        $ret = [
            'response' => 'passed',
            'data' => [
                'user' =>   $user->code
            ],
        ];
        return json_encode($ret);
        
    }

    public function fetch($request){
        $data = $request->all();

        $fetchset =  $data['fetchset'];
        $querypair =  $data['querypair'];
        
        try{
            $model = ModelUser::select($fetchset)->where($querypair)->get();
            return json_encode($model);
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }
                
    }
    
    public function validate($request){
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'emailorcode' => ['required'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => json_encode($validator->errors()->get('*')),
            ];
            return json_encode($ret); 
        }        

        
        
        try{
            $user = ModelUser::select(['code', 'name'])->where([
                                                ['code', $data['emailorcode']], 
                                                ['password', $data['password']] 
                                            ])->orWhere([ 
                                                ['email', $data['emailorcode']],
                                                ['password', $data['password']] 
                                            ])->first();

        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }
        

        if (!isset($user)){
            $ret = [
                'response' => 'failed',
                'reason' => 'valerrorpop',
                'data' => 'User not found',
            ];
            return json_encode($ret);
        }
        
        if (isset($data['redir'])){
            $this->startsession($request, $user['code'], $user['name']);
        }

        $ret = [
            'response' => 'passed',
            'data' => [
                'user' =>  $user['code']
            ],
        ];
        return json_encode($ret);
        
    }

    private function getRoom($usersinroom, $gender){
        $m = ['host:blkd:room:10','akin:blkf:112:10','akin:blkd:r102:10'];
        $f = ['host:blkd:roomb:10','akin:blkf:112b:10','akin:blkd:r102b:10'];
        
        $consid_room = [];
        $firstrm = $$gender[0];
        foreach ($$gender as $room ) {
            $consid_room[$room] = [0, 0]; //['sameunicount', 'total'] in a room
        }

        foreach ($usersinroom as $uroom) {

            $roomid = $uroom['roomid'];
            $roomcount = $uroom['roomcount'];

            $max = (int) end(explode(":",$roomid));
            if ($max < $roomcount){
                $consid_room[$roomid][0] += 1;
                $consid_room[$roomid][1] = $roomcount;
            }
            
        }

        $minroom = $consid_room[$firstrm];
        $ret = [$firstrm, $minroom[0], $minroom[1]];

        foreach ($consid_room as $roomid => $room) {
            if ($room[0] < $minroom[0]){
                $minroom = $room;
                $ret = [$roomid, $minroom[0], $minroom[1]];
            }elseif($room[0] == $minroom[0]){
                if ($room[1] < $minroom[1]){
                    $minroom = $room;
                    $ret = [$roomid, $minroom[0], $minroom[1]];
                }
            }
        }

        return $ret;
    }

    public function startsession($request, $ucode, $name){
        $request->session()->flush();
        $request->session()->put('user', $ucode);
        $request->session()->put('name', $name);

        if ($ucode == 'admincode'){
            $request->session()->put('access', 'admin');
        }
                
    }
    
    public function destroysession($request){
        $request->session()->flush();
    }
    
}

class Event{

    private $valset =  [
        'name' => ['required', 'min:4', 'max:25', 'string'],
        'description' => ['required', 'min:4', 'max:511'],
        'resources' => ['required'],
        'location' => ['required'],
        'date' => ['required'],
        'time' => ['required'],
        'duration' => ['required'],
        'anchor' => ['required'],
        'thoughts' => [],
        'state' => [],
    ];

    public function addnew($request){
        $data = $request->all();
        
        $createset = (array) json_decode($data['createset']);    

        $createset['state'] = '0';
        
        foreach($createset as $key => $val){
            if (!isset($this->valset[$key])){
                unset($createset[$key]);
            } 
        }

        $validator = Validator::make($createset, $this->valset);
        if ($validator->fails()) {
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => json_encode($validator->errors()->get('*')),
            ];
            return json_encode($ret);
        }

        // File Check
        $updcount = $data['upldcount'];
        $fileVal = [];
        for ($i=0; $i < $updcount ; $i++) { 
            $fileVal['file-' . ($i + 1)] = 'required|mimes:csv,txt,pdf|max:2048';
        }

        $validator = Validator::make($request->all(), $fileVal);
        if ($validator->fails()) {

            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => json_encode($validator->errors()->get('*')),
            ];
            return json_encode($ret);
        }
        
       
        
        $model = new ModelEvent;

        foreach($createset as $key => $val){
            $model->$key = $val;
        }
        
        try{

            $model->save();
            $mid = $model->id;
            
            for ($i=0; $i < $updcount; $i++) {
                $file = $request->file('file-'. ($i+1));

                if($file) {

                    $filename = ($i+1) . "-" . $file->getClientOriginalName();
        
                    // File extension
                    $extension = $file->getClientOriginalExtension();
        
                    // File upload location
                    $location = 'eventfiles/event_'.Util::Encode($mid, 4, 'str');
         
                    // Upload file
                    $file->move($location,$filename);
                    
                }else{
                    // Response
                    $ret = [
                        'response' => 'failed',
                        'reason' => 'file-'. ($i+1) . 'not uploaded.',
                        'data' => '',
                    ];
                    return json_encode($ret);
                }
            }
            
            
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }

        $ret = [
            'response' => 'passed',
            'data' => [
                'id' => $model->id
            ],
        ];
        return json_encode($ret);
        
    }

    public function update($request){
        $data = $request->all();


        $updset = ($data['updset']);
        //This is in form {
        //     "name":'new name',
        // }
        $updpair = ($data['updpair']);
        //This is in form {
        //     ["code",'ogbre'],
        // }

        if ($updpair[0] == 'code'){

            $updpair[1] = Util::Decode($updpair[1], 4, 'str');
            $updpair[0] = 'id';   
        }

        unset($updset['id']);

        $updvaller = [];

        foreach($updset as $key => $val){
            if (isset($this->valset[$key])){
                $updvaller[$key] = $this->valset[$key];
            }
        }

        $validator = Validator::make($updset, $updvaller);
        if ($validator->fails()) {
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => json_encode($validator->errors()->get('*')),
            ];
            return json_encode($ret);
        }


        try{
            $model = ModelEvent::where([$updpair[0] => $updpair[1]])->get(['id']);
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }

        
        
        if (count($model) === 0){
            $ret = [
                'response' => 'failed',
                'reason' => 'Event not found',
                'data' => '',
            ];
            return json_encode($ret);
        }

        $model = ModelEvent::where([$updpair[0] => $updpair[1]])->first();

        foreach($updset as $key => $val){
            $model->$key = $val;
        }
        
        try{
            $model->save();
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }

        $ret = [
            'response' => 'passed',
            'data' => [
                'code' => Util::Encode($model->id, 4, 'str')
            ],
        ];
        return json_encode($ret);
        
    }

    public function addcomment($request){
        $data = $request->all();

        $eventcode = $data['eventcode'];
        $parentcode = $data['parentcode'];
        $comment = $data['comment'];

        if (strlen($comment) === 0){
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => 'Comment cannot be empty',
            ];
            return json_encode($ret);
        }

        $eid = Util::Decode($eventcode, 4, 'str');

        if ($parentcode !== ''){
            $parentcode = Util::Decode($parentcode, 4, 'str');
        }
        

        try{
            $model = ModelEvent::where(['id' => $eid])->first();
            $thoughts = (array) json_decode($model['thoughts']);
            $newcode = '';

            date_default_timezone_set("Africa/Lagos");
            $commentObj = [
                'poster'=>$request->session()->get('user'),
                'created'=>date('H:i'),
                'text'=>$comment,
                'replies'=>array()
            ];

            if ($parentcode === ''){
                $tc = count($thoughts);
                $newcode = Util::Encode($tc, strlen($tc), 'str');;
                $commentObj['cid'] = $newcode;

                $thoughts[$tc + 1] = $commentObj;
            }else{
                $branch = explode("-", $parentcode); //Branh in 0-2-3-1

                $node = &$thoughts;  
                $i = 0;
                while ($i < count($branch) - 1) {
                    // update array pointer based on current key
                    $node = &$node[$branch[$i++]];
                }
                $inicount = count($node[$branch[$i]]['replies'])+1;

                $newcode = $parentcode."-".$inicount;
                $newcode = Util::Encode($newcode, strlen($newcode), 'str');
                $commentObj['cid'] =  $newcode;
                $node[$branch[$i]]['replies'][$inicount] = $commentObj;
            }

            $model->thoughts = (json_encode($thoughts));
            $model->save();

            $ret = [
                'response' => 'posted',
                'reason' => '',
                'data' => $newcode,
            ];
            return json_encode($ret);
            
        }catch(\Illuminate\Database\QueryException $ex){
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => 'Invalid insert code',
            ];
            return json_encode($ret);
        }

    }

    public function fetch($request){
        $data = $request->all();

        $fetchset =  $data['fetchset'];
        $querypair =  $data['querypair'];
        
        try{
            if ($fetchset == '*'){
                $model = ModelEvent::all();
                foreach ($model as $ent) {
                    $ent['code'] = Util::Encode($ent['id'], 4, 'str');
                    unset($ent['id']);
                }
            }else{
                $model = ModelEvent::select($fetchset)->where($querypair)->get();                
            }
            
            return json_encode($model);
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }
                
    }
    
}

class Ticket{

    private $valset =  [
        'name' => ['required', 'min:4', 'max:25', 'string'],
        'status' => ['required'],
        'user_qeued' => ['required'],
        'user_accepted' => ['required'],
    ];
 
    public function addnew($request){
        $data = $request->all();

        $createset = $data['createset'];

        // return 'calling';
        $createset['user_qeued'] = '{}';
        
        $createset['user_accepted'] = '{}';
        $createset['package'] = '{}';
        $createset['status'] = 1;
        
        $updvaller = [];

        foreach($createset as $key => $val){
            if (!isset($this->valset[$key])){
                unset($createset[$key]);
            }
        }

        $validator = Validator::make($createset, $this->valset);
        if ($validator->fails()) {
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => json_encode($validator->errors()->get('*')),
            ];
            return json_encode($ret);
        }
       
        
        
        try{
            //Activate other user ticket to 0 and deactivate all other tickets 
            ModelUser::query()->update(['ticketstate' => 0]);
            ModelTicket::query()->update(['status' => 2]);
            $model = new ModelTicket;

            foreach($createset as $key => $val){
                $model->$key = $val;
            }

            $model->save();
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }

        $ret = [
            'response' => 'passed',
            'data' => [
                'id' => $model->id
            ],
        ];
        return json_encode($ret);
        
    }

    public function queue_user($request){
        $data = $request->all();

 
        $user = ($data['usercode']);
        $sharer = ($data['sharer']);
        $ticketid = Util::Decode(($data['ticketcode']), 4, 'str');

        // return json_encode($user);
        $usermod = ModelUser::where('code', $user)->first();

       

        
        if ($usermod->ticketstate === '1'){            
            $ret = [
                'response' => 'passed',
                'reason' => 'User is queuing',
                'data' => '',
            ];
            return json_encode($ret);
        }
        if ($usermod->ticketstate === '2'){            
            $ret = [
                'response' => 'passed',
                'reason' => 'User has collected',
                'data' => '',
            ];
            return json_encode($ret);
        }

        // Gets the active ticket
        $model = ModelTicket::where(['id' => $ticketid, 'status'=>1])->first();

        if (!isset($model)){
            $ret = [
                'response' => 'failed',
                'reason' => 'Ticket not found or has expired',
                'data' => '',
            ];
            return json_encode($ret);
        }
        
        $queuser = (array) json_decode($model['user_qeued']);

        $cc = count($queuser);
        $queuser[$cc+1] = [
            'user'=>$user, 
            'sharer'=>$sharer,
        ];
        $model->user_qeued = json_encode($queuser);

        try {
            $usermod->ticketstate = 1;
            $usermod->ticketsharer = $sharer;

            $usermod->save();
            $model->save();            

            $ret = [
                'response' => 'passed',
                'reason' => '',
                'data' => 'User queued on sharer '.$sharer,
            ];
            return json_encode($ret);
        } catch (\Throwable $th) {
            $ret = [
                'response' => 'failed',
                'reason' => $th->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }
        

    }

    public function get_all_req_users($request){
        $data = $request->all();

        $sharer =  $data['sharer'];


        //Get List of all user uner shaerer
        $users = ModelUser::select(['code', 'name', 'ticketstate', 'ticketsharer'])->where('ticketsharer', $sharer)->get();
        
        if (count($users) === 0){
            $ret = [
                'response' => 'failed',
                'reason' => 'empty query',
                'data' => 'No User set for you',
            ];
            return json_encode($ret);
        }

        $ret = [
            'response' => 'passed',
            'reason' => '',
            'data' => $users,
        ];
        return json_encode($ret);
                
    }

    public function grant_req_user($request){
        $data = $request->all();

        $sharer =  $data['sharer'];
        $user =  $data['user'];

        $users = ModelUser::where(['ticketsharer'=>$sharer])->where(['code'=>$user])->first();

        if (!isset($users)){
            $ret = [
                'response' => 'failed',
                'reason' => 'valerrorpop',
                'data' => 'User not found',
            ];
            return json_encode($ret);
        }
        
        $users->ticketstate = '2';
        // return 'hey';

        $users->save();

        $ret = [
            'response' => 'passed',
            'reason' => '',
            'data' => 'User attended to successfully',
        ];
        return json_encode($ret);

    }

    public function load_userticketdata($request){
        $data = $request->all();

        $ucode =  $data['user'];
        
        
        $user = ModelUser::select(['name', 'ticketstate','ticketsharer', 'code'])->where(['code'=>$ucode])->first();

        //Get the name of the active ticket;
        $ticket = ModelTicket::select(['name', 'id'])->where(['status'=>1])->first();
        

       
        if (!isset($ticket) || !isset($user)){
            $ret = [
                'response' => 'failed',
                'reason' => 'empty query',
                'data' => 'No Ticket is available for you',
            ];
            return json_encode($ret);
        }

        $retdata = [
            'ticketname' => $ticket->name,
            'ticketcode' => Util::Encode($ticket->id, 4, 'str'),
            'username' =>$user->name,
            'usercode' =>$user->code,
            'userticketstate' => $user->ticketstate,
            'userticketsharer' =>$user->ticketsharer,
        ];

        $ret = [
            'response' => 'passed',
            'reason' => '',
            'data' => $retdata,
        ];
        return json_encode($ret);
                
    }

    

    public function update($request){
        $data = $request->all();


        $updset = ($data['updset']);
        $updpair = ($data['updpair']);

        unset($updset['id']);

        if ($updpair[0] == 'code'){

            $updpair[1] = Util::Decode($updpair[1], 4, 'str');
            $updpair[0] = 'id';   
        }

        $updvaller = [];

        foreach($updset as $key => $val){
            if (isset($this->valset[$key])){
                $updvaller[$key] = $this->valset[$key];
            }
        }

        $validator = Validator::make($updset, $updvaller);
        if ($validator->fails()) {
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => json_encode($validator->errors()->get('*')),
            ];
            return json_encode($ret);
        }


        try{
            $model = ModelTicket::where([$updpair[0] => $updpair[1]])->get(['id']);
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }

        
        
        if (count($model) === 0){
            $ret = [
                'response' => 'failed',
                'reason' => 'Ticket not found',
                'data' => '',
            ];
            return json_encode($ret);
        }

        $model = ModelTicket::where([$updpair[0] => $updpair[1]])->first();

        foreach($updset as $key => $val){
            $model->$key = $val;
        }
        
        try{
            $model->save();
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }

        $ret = [
            'response' => 'passed',
            'data' => [
                'ticketcode' => Util::Encode($model->id, 4, 'str')
            ],
        ];
        return json_encode($ret);
        
    }

    public function fetch($request){
        $data = $request->all();

        $fetchset =  $data['fetchset'];
        $querypair =  $data['querypair'];
        
        try{
            $model = ModelTicket::select($fetchset)->where($querypair)->get();
            return json_encode($model);
        }catch(\Illuminate\Database\QueryException $ex){ 
            $ret = [
                'response' => 'failed',
                'reason' => $ex->getMessage(),
                'data' => '',
            ];
            return json_encode($ret);
        }
                
    }
    
}


