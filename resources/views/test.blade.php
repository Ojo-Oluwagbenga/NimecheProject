<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Api</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    
    <!-- <div class="init" style="width:100px; height: 40px; background-color: green; border-radius: 5px"></div> -->
    
    <div class="supercont">
        <h2 class="head">NIMechE Token List</h2>

        <div class="listpack" id="listpackid">
            
        </div>
        
    </div>
    
    <style>
        .supercont{
            width: 95vw;
            border: 2px dashed grey;
            border-radius: 10px 0px;
        }
        .supercont .head{
            text-align: center;
            padding: 5px;
        }
        .supercont .listpack{
            display:flex;
        }
        .itempack {
            width: 45%;
            border-radius: 10px;
            background-color: whitesmoke;
            padding: 10px;
            margin: 10px;
        }
        .itempack .itemhead{
            display: flex;
            border-bottom: 1px dashed grey;
            padding: 30px 0px;
        }
        .itempack .itemhead > :nth-child(n){
            text-align:center;
        }
        .itempack .itemhead .token{
            width: 25%
        }
        .itempack .itemhead .useremail{
            width: 75%
        }
        .itempack .itemhead .token{
            border-right: 1px solid grey;
        }
        .itempack .itemhead > div:nth-child(n){
            margin: 10px 0;
        }
    </style>
    <script>
        let list = ["test1","test2","test3", "test4","test5", "W3WNU8AO63","3JH7FUKPRO","AUDY6XS0KI","SYD31KXHHO","XV82MA02C3","KOIKY2IJTL","WEXCCWXYSQ","ZYP5XZQ1LK","9FWSE07UL4","7QT47U4U3Z","ZE4G1BJ5V9","0XHEZYU7I4","TR561BXJ9O","CY5PLVHGQ4","6CTLTGL9PP","WG91KK8J0I","X7NIDWAN7F","XQW5R33IG3","6E9OSJ41BR","2QO4HPRGNX","0RZ2KVUGQZ","T3JPO817N0","WG1U5TIJGG","UDEDYLCSFY","MJBFQ5NKZN","HH2KFTQQPR","NG399G1H9R","3TIAHKFGDL","APAH6750YJ","7ITMSEDPW2","H4QXEMQ1VZ","R88HEMKJAE","8TZ8NXP3OW","2YZHHHMRNE","STOEO9MIUO","EO1OR649EB","533932KQVN","LWOCBTAKAW","VMASF0QMW3","9J5K32JM1Y","64U8579R4H","AA30QCNX31","Y6TDSP6UCA","0IGMEIC5KK","UH76B6NVLF","WCUA1UYIB7","5HCH4P9B57","H1508EPYTY","V6B0V9MGW0","BMH11NR5HD","OULFTENTJX","Z4IQC9FDNC","RHTXSVK573","62KI1XDSYZ","LJVGI220RW","A0MT6CJD4Y","OB17DT27Q8","O6JYLFTXIA","1870BBO27S","2MN61EXSWW","BK3A5M411L","UC0858TUHX","P9Y7OVNNV3","H691OY9VW3","WTIOQXPQS6","NPHXZ8F4JR","GRR2N0194E","OULGRUVXCP","ZSKA4G2O3H","7T9MG4U71Q","KGZYWIVPI4","CKVREJ7GG8","V08OVR5JKO","MQFTXZ68CR","A0D933P9O5","4TEITE3VPH","JU4VOO52AO","211ERKKBM5","GA41SADGBG","CPVVLPQX5N","UX2173KFGD","80847S4M1F","FHG7LDRDS6","YN6O0S3BGF","4V5KPSHA1F","BIG89ZREOZ","40AHVRXXPU","8I2C1WJV9C","4R8U13DDOV","7SVRYPSFSI","3EKDL62WGL","HKLPXJHAII","WAIHFCMYT1","M0USG71IXZ","LFAN5W9VQW","UODHWR3OPT","WBZLFGRHNR","KOCYNGOQWT","YD4KOM3A0N","XH28ETC20Y","N65A8IYJO0","MP5JS3JIAV","Z8J72IS4EZ","PLA152RDF3","WAEBF8MPWH","CD6MY3IQ2B","6UJWXCYMC7","4E1PAR0C4G","49W0N35PG0","KP3CTSJRGJ","HK9LNNA6UI","E56BR4GE0C","W44YUOUTWT","GXXBY50TCH","XYANBH8KDI","F97YYFJSMU","HKUM0TYLCZ","TSXHC9Y0WM","X6L478NWFM","ND6M61HEVI","1407FDA7G3","PR4HTFT52A","TVSI8DK6N2","7FB3XZ0G3N","Y26QRMV426","CQ8MD5DCZT","506YH6XHA2","G6U1GNQ95V","TX193XXUFW","0W2VGZ0FBU","RQ2NXEHWS5","UE6K653MR4","SOHZDS6A77","U32NRHFSQU","I69YQNYDH4","M17CR55M9D","8E9XV0GIE2","3ZBWJ9U02P","FL64SUE23Y","AFJHJ28UH6","A2BGJGRQ9L","FTXOJN4CLD","MO4IZA9CN7","5IHLOH02DB","4PFZZYIN66","T6D1CH9ZV1","OT6JPCAZQ6","E4CVQSNI9C","D3X3FBNV97","59IU0XKTN4","H030DHM0O0","9OCKCJAKZW","0KD7Q6BHQ4","6JBVCME8T6","CP1A2PMHJI","BPRZOX140O","M0X1ZIUYLU","TR9IIUN2P0","2KPW8CWTRQ","RCLF9RWIG6","UMDEH8NL3Y","HEINZF2UVG","89DHPHFT34","56YZH3VHUM","ONGIYZOG8V","V9BHJ3W3F8","3HQFZSYH46","T663XVG3QM","BWP2K1N5EP","JWGNC7X03L","OJBFUEAC9T","SVJ5F1AYJQ","UAS14OF8CJ","0T524INVS9","0JJG3WAOWC","YC7W57OO5G","W5T32YXJZ7","KVSQORUO1X","H733J66MWX","MKKCPW8C2D","4LI294X97H","Y0ZXB3WNKI","XLZBCQ052A","LK18DF7TP2","KEJPMCZYD1","RLIVRP93L5","7R1FVNJWMF","5ILIQZ3LFD","0KWYWM1NZN","EXVUX04KW3","88TX8PEYNL","NEVBLIV09B","H8IYTSDQZB","NYBPT1THWB","1WN8Z8OJWP","MUPLZHE3AG","79G9R07UQH","KDFC8E7CEE","625LXE9BH8","WPABDPJI5T","9M65MU6Q59","OJ0A9UPG19","M0KT68KSQZ","YAQ6FFDCXD","OZ5UC9B2GJ","8CHLOZ12AJ","4PZOV4D7U8","R1G5YW2F56","Y847K3K2LX","YUXC6PN3CJ","JUXTOETDT5","FD7QVI79S9","0HGK33B5XI","OQ8RLWL8V5","N1ZHQYRBN2","D6IDTC1IBX","3WSF23N7ZG","RVPI1U13M6","DH2S0IT8KL","195X832UL8","R84TCZGH2R","7NBZ9ZIP26","06X6XTILUD","Q9OWS9WVDW","1KA622D4OV","80OFM75WFD","VMXEHRCEJO","VDJEB5JKEP","WSHGER4QAM","QA3QJQGJQD","T72WIJAIYF","W1QEU7NQ99","TPFU4RRRA2","VZSJKU16CR","K9P258HMTT","1Z3KN0VZ7P","3AR9B7E450","KIXUJ2DDB6","JFUPLV21EG","1FGC9TMCAN","MO7OISNHEU","O20HWLB6MN","IYYDNB1F5U","5FSE95NTNY","TZC3FP4YE6","39U1C5QLCY","S69ZIJEM5N","4ZIAI5UCQ7","NM1YXPOZ0U","LEPWYOEZ4E","15EVSOD6VA","KTCZV1P1P8","SWUIP7B3NQ","M7YR1ZYBZR","DJQT5PMALK","TIV2IQKDI7","0H5VWWKED1","QOFJM4643V","TK77BZ5IWA","QUTRKG579R","4AZDY0NTWO","E7JXHYZ8IA","FOBOY462CP","LT65WFWOK6","QQ2QJPODWW","Q0D8KWLQFK","NTBNFM3JGV","DHH7AE6LAX","4DTHEX936S","VT3E7GF6PZ","HSGH5D0NT4","1UZ6TD0QJ5","9HTWSKEQRR","VK68VHVC5V","HJKYR6OPK9","1U038BG41M","BA1JQ76U0Y","8AZGEKNEUL","B7BAVJORT2","VR50DKDLLH","ZORIKYR1FW","TZLIHM9UZV","W804TGLGWJ","QL33KFN1OF","672ZU3WUXE","QI9LUTCZPX","6K82S1TYXR","121H6PJAAA","32PXYQMOGG","V4ZQNE0SGS","HO7VRKWC31","3GWZEZFM2I","PSI9AJX1X7","QFTW20UXZX","CVJOXJXQ55","BHWPZCTPEU","UW5R00T0JZ","S0U0CSJ8O5","LZVMRKB2ST","76RQ37WNZD","Z4GQN4ZZ4L","07SFNKQYNO","XHT6YYPS1K","MK2GC962KN","AM7ZPBZ3G2","WM8U7ZUUIP","Y6UJVOOUEH","MI23N6GLH3","Q84ES77YTC","0SQA4480R6","TGD14ZQ7FY","0A502ABZUW","T7Q2LPKSC1","2UJA7EE7ZC","NGCHVVF9MS","5UJW4WNADP","NZN5QZPPZ8","MWBC4VORA1","OZS306Y7UG","SO5ECV0LK0","1AN0G9FEJ6","1Z64XE0SSZ","PRRJP5GHNK","WALN2S43MH","XNGIPHNY77","EVZCWGD3L6","7GDV09GGMA","P1OXYNUWHK","Q9FV7GE75K","5HVOKM42TN","78XQRBFP3M","GL8WSGAKVG","1A1CJ5BPJ7","S7IAS8UV1X","5D5ECNX1L4","AT5Q4ZAGBX","5BVOV98KPF","ET13KJCS4Z","3NRL6RY0B9","VBL3E476RB","IUEDYSEV1Q","MFC8IXEXQS","9HGVX6OYRB","36115NRG3S","1QAM8EN39V","NYIPF0S66N","3FSLWGZGYG","XB9S81RAAE","ZW5XH3TEF0","C6RU1GUP2J","PXWCA2534P","C0IUUMBCJ8","UDEG1GB001","CJF9C71AR4","9F8B7R017X","HZ4ER6SZHQ","2PEYY3DDZY","JD7AC4SYEE","QWQX0O5L51","24O4JQAU8J","7IIXU8CVFN","1W3JHL3BKK","35HIBKL82E","YOL3VFWFYX","G0EZNILD5K","QRWW1G7VAW","YA0P88DVKT","IWWCJZ53B1","R4H10FJVP9","CKOQKCBCF0","G7MY7L63TW","9L7PVB5U43","QUASNRWWXE","OCVT4MLU0D","I7KG7789VS","DXYWEVUQAR","WRBZTUCMQC","CJT882LY4C","D6JA03F8R8","KOPGDF92AT","H356Q9DIRZ","5REUG2QULX","NY6LE2QX7U","7OOMF7PZ3G","9B2OIXDFPL","C2F01CSITQ","YEKJTFFRHF","0RYEZFSTI9","AONMYVX3EJ","TPWNC5GJC2","703UO2KFPD","Q9BXNWT3IJ","H26GAPQHZI","QAAPI8TS4J","ZXYO0LUA1X","HCY6TT0LLJ","SEYGUVN9ZY","22AQ89X08R","RM7QY21KBK","HFE4GT6Z4G"];

        for (let i = 27; i < 30; i++) {
            let el = '<div class="itempack" id="itemhold'+i+'">'+
                        '<div class="itemhead">'+
                            '<h4 class="token">Token No</h4>'+
                            '<h4 class="useremail">Token</h4>'+
                        '</div>'+                            
                    '</div>';

            $("#listpackid").append(el);

            for (let j = 7*i; j < 7*(i+1); j++) {
                let el = '<div class="itemhead">'+
                            '<div class="token">'+(j + 1)+'</div>'+
                            '<div class="useremail"><b>'+list[j+1]+'</b></div>'+
                        '</div>';
                $("#itemhold"+i).append(el)
            };
            
        }
        
        
        $('div.init').click(function(){
            axios({
                method: 'POST',
                url: './api/user/loadaccepts_token',
                headers: {
                    "X-CSRF-TOKEN" : '{{csrf_token()}}'
                },
                data: {
                    querypair:{'id':'1'},
                    fetchset:['name']

                }
            }).then(response => {console.log(response.data)})
                .catch(error => console.error(error))
        })
               
    </script>
    
</body>
</html>