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

class HashControl{
    static function generateRandomNum($length = 10) {
        $characters = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    static function generateCode($num = 400){
        $codes = [];

        for ($i=0; $i < $num; $i) { 
            $str = self::generateRandomNum(10);
            if (!in_array($str, $codes)){
                array_push($codes, $str);
                $i++;
            }            
        }

        return $codes;
    }
}
 
class User{

    private $valset =  [
        'name' => ['required', 'min:4', 'max:35', 'string'],
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

    
    public function loadaccepts_token(){
        $ret = HashControl::generateCode(400);
        
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
        
       

        $userallowed = ["test1","test2","test3", "test4","test5", "W3WNU8AO63","3JH7FUKPRO","AUDY6XS0KI","SYD31KXHHO","XV82MA02C3","KOIKY2IJTL","WEXCCWXYSQ","ZYP5XZQ1LK","9FWSE07UL4","7QT47U4U3Z","ZE4G1BJ5V9","0XHEZYU7I4","TR561BXJ9O","CY5PLVHGQ4","6CTLTGL9PP","WG91KK8J0I","X7NIDWAN7F","XQW5R33IG3","6E9OSJ41BR","2QO4HPRGNX","0RZ2KVUGQZ","T3JPO817N0","WG1U5TIJGG","UDEDYLCSFY","MJBFQ5NKZN","HH2KFTQQPR","NG399G1H9R","3TIAHKFGDL","APAH6750YJ","7ITMSEDPW2","H4QXEMQ1VZ","R88HEMKJAE","8TZ8NXP3OW","2YZHHHMRNE","STOEO9MIUO","EO1OR649EB","533932KQVN","LWOCBTAKAW","VMASF0QMW3","9J5K32JM1Y","64U8579R4H","AA30QCNX31","Y6TDSP6UCA","0IGMEIC5KK","UH76B6NVLF","WCUA1UYIB7","5HCH4P9B57","H1508EPYTY","V6B0V9MGW0","BMH11NR5HD","OULFTENTJX","Z4IQC9FDNC","RHTXSVK573","62KI1XDSYZ","LJVGI220RW","A0MT6CJD4Y","OB17DT27Q8","O6JYLFTXIA","1870BBO27S","2MN61EXSWW","BK3A5M411L","UC0858TUHX","P9Y7OVNNV3","H691OY9VW3","WTIOQXPQS6","NPHXZ8F4JR","GRR2N0194E","OULGRUVXCP","ZSKA4G2O3H","7T9MG4U71Q","KGZYWIVPI4","CKVREJ7GG8","V08OVR5JKO","MQFTXZ68CR","A0D933P9O5","4TEITE3VPH","JU4VOO52AO","211ERKKBM5","GA41SADGBG","CPVVLPQX5N","UX2173KFGD","80847S4M1F","FHG7LDRDS6","YN6O0S3BGF","4V5KPSHA1F","BIG89ZREOZ","40AHVRXXPU","8I2C1WJV9C","4R8U13DDOV","7SVRYPSFSI","3EKDL62WGL","HKLPXJHAII","WAIHFCMYT1","M0USG71IXZ","LFAN5W9VQW","UODHWR3OPT","WBZLFGRHNR","KOCYNGOQWT","YD4KOM3A0N","XH28ETC20Y","N65A8IYJO0","MP5JS3JIAV","Z8J72IS4EZ","PLA152RDF3","WAEBF8MPWH","CD6MY3IQ2B","6UJWXCYMC7","4E1PAR0C4G","49W0N35PG0","KP3CTSJRGJ","HK9LNNA6UI","E56BR4GE0C","W44YUOUTWT","GXXBY50TCH","XYANBH8KDI","F97YYFJSMU","HKUM0TYLCZ","TSXHC9Y0WM","X6L478NWFM","ND6M61HEVI","1407FDA7G3","PR4HTFT52A","TVSI8DK6N2","7FB3XZ0G3N","Y26QRMV426","CQ8MD5DCZT","506YH6XHA2","G6U1GNQ95V","TX193XXUFW","0W2VGZ0FBU","RQ2NXEHWS5","UE6K653MR4","SOHZDS6A77","U32NRHFSQU","I69YQNYDH4","M17CR55M9D","8E9XV0GIE2","3ZBWJ9U02P","FL64SUE23Y","AFJHJ28UH6","A2BGJGRQ9L","FTXOJN4CLD","MO4IZA9CN7","5IHLOH02DB","4PFZZYIN66","T6D1CH9ZV1","OT6JPCAZQ6","E4CVQSNI9C","D3X3FBNV97","59IU0XKTN4","H030DHM0O0","9OCKCJAKZW","0KD7Q6BHQ4","6JBVCME8T6","CP1A2PMHJI","BPRZOX140O","M0X1ZIUYLU","TR9IIUN2P0","2KPW8CWTRQ","RCLF9RWIG6","UMDEH8NL3Y","HEINZF2UVG","89DHPHFT34","56YZH3VHUM","ONGIYZOG8V","V9BHJ3W3F8","3HQFZSYH46","T663XVG3QM","BWP2K1N5EP","JWGNC7X03L","OJBFUEAC9T","SVJ5F1AYJQ","UAS14OF8CJ","0T524INVS9","0JJG3WAOWC","YC7W57OO5G","W5T32YXJZ7","KVSQORUO1X","H733J66MWX","MKKCPW8C2D","4LI294X97H","Y0ZXB3WNKI","XLZBCQ052A","LK18DF7TP2","KEJPMCZYD1","RLIVRP93L5","7R1FVNJWMF","5ILIQZ3LFD","0KWYWM1NZN","EXVUX04KW3","88TX8PEYNL","NEVBLIV09B","H8IYTSDQZB","NYBPT1THWB","1WN8Z8OJWP","MUPLZHE3AG","79G9R07UQH","KDFC8E7CEE","625LXE9BH8","WPABDPJI5T","9M65MU6Q59","OJ0A9UPG19","M0KT68KSQZ","YAQ6FFDCXD","OZ5UC9B2GJ","8CHLOZ12AJ","4PZOV4D7U8","R1G5YW2F56","Y847K3K2LX","YUXC6PN3CJ","JUXTOETDT5","FD7QVI79S9","0HGK33B5XI","OQ8RLWL8V5","N1ZHQYRBN2","D6IDTC1IBX","3WSF23N7ZG","RVPI1U13M6","DH2S0IT8KL","195X832UL8","R84TCZGH2R","7NBZ9ZIP26","06X6XTILUD","Q9OWS9WVDW","1KA622D4OV","80OFM75WFD","VMXEHRCEJO","VDJEB5JKEP","WSHGER4QAM","QA3QJQGJQD","T72WIJAIYF","W1QEU7NQ99","TPFU4RRRA2","VZSJKU16CR","K9P258HMTT","1Z3KN0VZ7P","3AR9B7E450","KIXUJ2DDB6","JFUPLV21EG","1FGC9TMCAN","MO7OISNHEU","O20HWLB6MN","IYYDNB1F5U","5FSE95NTNY","TZC3FP4YE6","39U1C5QLCY","S69ZIJEM5N","4ZIAI5UCQ7","NM1YXPOZ0U","LEPWYOEZ4E","15EVSOD6VA","KTCZV1P1P8","SWUIP7B3NQ","M7YR1ZYBZR","DJQT5PMALK","TIV2IQKDI7","0H5VWWKED1","QOFJM4643V","TK77BZ5IWA","QUTRKG579R","4AZDY0NTWO","E7JXHYZ8IA","FOBOY462CP","LT65WFWOK6","QQ2QJPODWW","Q0D8KWLQFK","NTBNFM3JGV","DHH7AE6LAX","4DTHEX936S","VT3E7GF6PZ","HSGH5D0NT4","1UZ6TD0QJ5","9HTWSKEQRR","VK68VHVC5V","HJKYR6OPK9","1U038BG41M","BA1JQ76U0Y","8AZGEKNEUL","B7BAVJORT2","VR50DKDLLH","ZORIKYR1FW","TZLIHM9UZV","W804TGLGWJ","QL33KFN1OF","672ZU3WUXE","QI9LUTCZPX","6K82S1TYXR","121H6PJAAA","32PXYQMOGG","V4ZQNE0SGS","HO7VRKWC31","3GWZEZFM2I","PSI9AJX1X7","QFTW20UXZX","CVJOXJXQ55","BHWPZCTPEU","UW5R00T0JZ","S0U0CSJ8O5","LZVMRKB2ST","76RQ37WNZD","Z4GQN4ZZ4L","07SFNKQYNO","XHT6YYPS1K","MK2GC962KN","AM7ZPBZ3G2","WM8U7ZUUIP","Y6UJVOOUEH","MI23N6GLH3","Q84ES77YTC","0SQA4480R6","TGD14ZQ7FY","0A502ABZUW","T7Q2LPKSC1","2UJA7EE7ZC","NGCHVVF9MS","5UJW4WNADP","NZN5QZPPZ8","MWBC4VORA1","OZS306Y7UG","SO5ECV0LK0","1AN0G9FEJ6","1Z64XE0SSZ","PRRJP5GHNK","WALN2S43MH","XNGIPHNY77","EVZCWGD3L6","7GDV09GGMA","P1OXYNUWHK","Q9FV7GE75K","5HVOKM42TN","78XQRBFP3M","GL8WSGAKVG","1A1CJ5BPJ7","S7IAS8UV1X","5D5ECNX1L4","AT5Q4ZAGBX","5BVOV98KPF","ET13KJCS4Z","3NRL6RY0B9","VBL3E476RB","IUEDYSEV1Q","MFC8IXEXQS","9HGVX6OYRB","36115NRG3S","1QAM8EN39V","NYIPF0S66N","3FSLWGZGYG","XB9S81RAAE","ZW5XH3TEF0","C6RU1GUP2J","PXWCA2534P","C0IUUMBCJ8","UDEG1GB001","CJF9C71AR4","9F8B7R017X","HZ4ER6SZHQ","2PEYY3DDZY","JD7AC4SYEE","QWQX0O5L51","24O4JQAU8J","7IIXU8CVFN","1W3JHL3BKK","35HIBKL82E","YOL3VFWFYX","G0EZNILD5K","QRWW1G7VAW","YA0P88DVKT","IWWCJZ53B1","R4H10FJVP9","CKOQKCBCF0","G7MY7L63TW","9L7PVB5U43","QUASNRWWXE","OCVT4MLU0D","I7KG7789VS","DXYWEVUQAR","WRBZTUCMQC","CJT882LY4C","D6JA03F8R8","KOPGDF92AT","H356Q9DIRZ","5REUG2QULX","NY6LE2QX7U","7OOMF7PZ3G","9B2OIXDFPL","C2F01CSITQ","YEKJTFFRHF","0RYEZFSTI9","AONMYVX3EJ","TPWNC5GJC2","703UO2KFPD","Q9BXNWT3IJ","H26GAPQHZI","QAAPI8TS4J","ZXYO0LUA1X","HCY6TT0LLJ","SEYGUVN9ZY","22AQ89X08R","RM7QY21KBK","HFE4GT6Z4G"];
        $admin = ['admin'];
        

        $data['ticketsharer'] = '1';
        $data['ticketstate'] = '0';

        $validator = Validator::make($data, [
            'name' => ['required', 'min:4', 'max:35', 'string'],
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
                'data' => 'A wall met, see admin.',
            ];
            return json_encode($ret);
        }
        

        if (!in_array($data['code'], $userallowed)){
            $ret = [
                'response' => 'failed',
                'reason' => 'valerror',
                'data' => json_encode([
                    'code'=> 'Token does not exist'
                ]),
            ];
            return json_encode($ret);
        }
        

        $user_index = array_search($data['code'], $userallowed);
        $data['code'] = 'NC/2022/' . Util::Encode($user_index, 4, 'int');
        
        
        $user = [''];
        try{
            $user = ModelUser::where('code', $data['code'])->orWhere('email', $data['email'])->get();
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
       
        

        
        try {
            $usersinroom = ModelUser::select('roomid', 'roomcount')->where([
                ['institution', $data['institution']],
                ['gender', $data['gender']] 
               ] )->get();
        } catch (\Throwable $th) {
            $ret = [
                'response' => 'failed',
                'reason' => 'Error occurred, see admin',
                'data' => '',
            ];
            return json_encode($ret);
        }

       

        
        
        $uroom = $this->getRoom($usersinroom, $data['gender']);
        
        $user = new ModelUser;
        $uid = $user_index;


        
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
        $user->ticketsharer = (string) ($uid%3 + 1);

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
            $user = ModelUser::where($updpair[0] , $updpair[1])->get(['code']);
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
        $ret = ['host:blkd:room:10', 1, 1];
        $accodet = explode(":",$ret[0]);
        $hostel = $accodet[0];
        $block = $accodet[1];
        $room = $accodet[2];
        $bunk = (int)$ret[2] + 1;

        $roomid = $hostel.":".$block.":".$room.":".$bunk;

        $ret[0] = $roomid;

        return $ret;
        



        
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
                //Adds 1 to the number of same uni in the room $roomid
                $consid_room[$roomid][0] += 1;
                $consid_room[$roomid][1] = $roomcount;
            }
            
        }

        $minroom = $consid_room[$firstrm];
        $ret = [$firstrm, $minroom[0], $minroom[1]];

        //Puts in the room with minimum same uni folk and minimum number of members
        foreach ($consid_room as $roomid => $room) {
            if ($room[0] < $minroom[0]){
                // If the number of same uni people in this room is lesser than the former minimum, put user here
                $minroom = $room;
                $ret = [$roomid, $minroom[0], $minroom[1]];

            }elseif($room[0] == $minroom[0]){ //If equal number of same uni, it puts in the room with the minimum entries
                if ($room[1] < $minroom[1]){
                    $minroom = $room;
                    $ret = [$roomid, $minroom[0], $minroom[1]];
                }
            }
        }

        $accodet = explode(":",$ret[0]);
        $hostel = $accodet[0];
        $block = $accodet[1];
        $room = $accodet[2];
        $bunk = (int)$ret[2] + 1;

        $roomid = $hostel.":".$block.":".$room.":".$bunk;

        $ret[0] = $roomid;

        return $ret;
    }

    public function startsession($request, $ucode, $name){
        $admin = 'NC/2022/DEFG';
        $allowed_sharers = ['NC/2022/DEF8', 'NC/2022/DEF9', 'NC/2022/DEF0'];


        $request->session()->flush();
        $request->session()->put('user', $ucode);
        $request->session()->put('name', $name); 

        if ($ucode == $admin){
            $request->session()->put('access', 'admin');
        }
        if (in_array($ucode, $allowed_sharers)){
            $request->session()->put('foodaccess', 'true');
            $request->session()->put('sharer', (array_search($ucode, $allowed_sharers) + 1));
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

    public static function deleteDir($dirPath) {
        if (is_dir($dirPath)) {
            if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
                $dirPath .= '/';
            }
            $files = glob($dirPath . '*', GLOB_MARK);
            foreach ($files as $file) {
                if (is_dir($file)) {
                    self::deleteDir($file);
                } else {
                    unlink($file);
                }
            }
            rmdir($dirPath);
        }        
    }

    public function hot_update($request){
        $data = $request->all();
        
        $createset = (array) json_decode($data['createset']);    

        $createset['state'] = $data['state'];
        $data['id'] = (int) Util::Decode($data['code'], 4, 'str');        

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
        
       
        $model = ModelEvent::where("id", $data['id'])->first();

        foreach($createset as $key => $val){
            $model->$key = $val;
        }
        
        try{
            $model->save();
            $mid = $model->id;

            $location = 'eventfiles/event_'.Util::Encode($mid, 4, 'str');
            self::deleteDir($location);

            for ($i=0; $i < $updcount; $i++) {
                $file = $request->file('file-'. ($i+1));

                if($file) {

                    $filename = ($i+1) . "-" . $file->getClientOriginalName();
        
                    // File extension
                    $extension = $file->getClientOriginalExtension();
        
                    // Upload file
                    sleep(0.3);
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

        for ($i=0; $i < count($querypair); $i++) { 
            if ($querypair[$i][0] == 'code'){
                $querypair[$i][0] = 'id';
                $querypair[$i][1] = Util::Decode($querypair[$i][1], 4, 'str');
            }
        }
        
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
        $tickid = Util::Decode($data['ticketcode'], 4, 'str');
        $model = ModelTicket::where([
                                ['id',  $tickid],
                                ['status', 1]
                            ])->first();

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

        $users = ModelUser::where('ticketsharer', $sharer)->where('code', $user)->first();

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


