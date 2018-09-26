<?php
ini_set('display_errors', '0');
//把下面的资料改成您的

//网站名字
$siteName='pluswen520Tube';

//youtube API V3 KEY:

$key='AIzaSyDM-Ax3d5M2dYdipB4vRRQUuimebHDGke4';


//其他地方不用改。

//若不懂,请勿修改下面的代码以免造成程序出错
$header='
<html>
    <head>
        <title>'.$siteName.'</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="'.Root_part().'w3.css">'.
"<style >
                     *,html,body {
                font-family: arial,'pingfang sc',stheiti,\"microsoft yahei\",sans-serif !important;
                font-size: 16px;
            }
            input::-moz-focus-inner {
                border: 0;
                padding: 0;
                margin-top:-2px;
                margin-bottom: -2px;
            }
            .logo {
                max-width:400px;
                padding-top: 90px;
                padding-bottom: 50px;
            }
            .wrap {
                max-width: 720px;
                margin: auto;
                padding-bottom:50px;
            }
            .wrap .search {
                width: 100%;
                position: relative
            }
            .wrap .searchTerm {
                width: calc(100% - 50px);
                border: 3px solid #f44336;
                padding: 10px 10px 10px 15px;
                height: 20px;
                border-radius: 5px;
                outline: none;
                color: #464646;
            }
            .wrap .searchTerm:focus {
                color: #000;
            }
            .wrap .searchButton {
                position: absolute;
                right: -1px;
                width: 50px;
                height:45px;
                border: 1px solid #f44336;
                background: #f44336;
                text-align: center;
                color: #fff;
                cursor: pointer;
                font-size: 20px;
                border-top-right-radius: 5px;
                border-bottom-right-radius: 5px;
            }
            .Media {
                margin: auto;
                border-bottom: 1px solid #dedede;
                padding: 10px 0px;
            }
            .Media-figure {
                margin-left: 1em;
            }
            .Media .Image {
                width:28%;
                vertical-align: top;
            }
            .Media-body {
                display: inline-block;
                width: 65%;
                text-align: left;
                vertical-align: top;
            }
            .Media-title {
                font-size: 23px;
                line-height: 29px;
                color: #222;
                overflow: hidden;
                text-overflow: ellipsis;
                margin: 0px;
                height: 58px;
                word-wrap: break-word;
                word-break: break-all;
            }
            .Media--center {
                align-items: center;
            }
            .tj {
                max-width: 720px;
                margin: auto;
            }
            .textsty{
                font-size: 12px;
                color: #bbb;
                margin: 0;
                width: 100%;
                position: absolute;
                bottom: 13px;
                left: 0;
                box-sizing: border-box;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
                word-wrap: normal;
                padding-right: 100px;
            }
            .bfq{
                width: 640px;
                height: 359px;
                padding: 0;margin: auto;
            }
            
            @media only screen and (max-width: 759px) and (min-width: 320px) {
                .wrap {
                    width:100%;
                }
                .logo {
                    width: 60%;
                    padding-top: 65px;
                    padding-bottom: 25px;
                }
                .wrap .searchButton {
                }
                .Media-title {
                font-size: 17px;
                line-height: 23px;
                color: #222;
                overflow: hidden;
                text-overflow: ellipsis;
                margin: 0px;
                height: 46px;
            }
            .bfq{
                width: 100%;
                height: 100%;
            }
            }
        </style>
".'<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    </head>
     <body style="background-color: #f8f8f8;">
        <div class="w3-container w3-red w3-center" style="height:55px">
           <img src="'.Root_part().'2.png" alt="logo" style="height:35px;margin: 10px 0" />
        </div>';
$footer='<footer class="w3-container w3-red w3-center" style="width: 100%;bottom: 0px;">
            <p>©Development by <a href="https://2tube.js.org/" target="_blank">YOU2PHP</a></p>
        </footer>
        </body>
</html>';



switch (@$_SERVER['PATH_INFO']) {
    case '/watch':
       echo $header;
       echo '<div class="w3-container w3-center tj"><div class="w3-panel w3-pale-yellow w3-topbar w3-bottombar w3-border-yellow">
    <p>不能观看请刷新,多试几次，若页面一直处于加载状态，可手动停止！</p>
  </div></div>';
       echo '<div class="w3-container w3-center bfq">
            <iframe width="100%" height="100%" src="../Proxy.php?https://www.youtube.com/embed/'.trim($_SERVER[QUERY_STRING]).'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>'; 
        echo $footer;
        break;
        
        
        
        
    case '/searchdata':
        $data='';
        $videodata=get_search_video(urlencode($_GET['q']),$key,'video','relevance','tw',$_GET['pid']);
       foreach ($videodata["items"] as $v) {
            $data.='<a href="'.Root_part().'index.php/watch?'.$v["id"]["videoId"].'" ><div class="Media"><div class="Media-body"><h3 class="Media-title">'.$v["snippet"]["title"].'</h3></div><img class="Media-figure Image" src="'.Root_part().'Proxy.php?img.youtube.com/vi/'.$v["id"]["videoId"].'/mqdefault.jpg"></div></a>';
        }
        if(!array_key_exists("nextPageToken",$videodata) && array_key_exists("prevPageToken",$videodata)){
            $pid='null';
        }else{
            $pid=$videodata["nextPageToken"];
        }
        $jsonData =["pid" => $pid, "content" => $data];                                                                    
        echo json_encode($jsonData);
        break;
        
        
        
    case '/search':
        if(isset($_GET['q'])){
    if(stripos($_GET['q'],'youtu.be')!==false || stripos($_GET['q'],'watch?v=')!==false ){
     preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $_GET['q'], $matches);
    $str='../index.php/watch?'.$matches[1];
     header("Location:$str");
     exit();}}
        echo $header;
         $q=urlencode($_GET['q']);
         echo '<div class="w3-container w3-center tj" style="min-height:600px;">
         <h4><b class="w3-opacity">'.$_GET['q'].'</b> 搜索结果</h4>
               <div id="load_data"></div>
               <div id="load_data_message"></div>
               <div id="ajax-load" style="display:none">
                 <p><img src="../loader.gif">加载中....</p>
               </div>
        </div>';
       

echo '<script>
        $(document).ready(function() {
    query = \''.$q.'\';
    Pageid = \'\';
    var action = \'inactive\';
    function load_country_data(q, pid) {
        $.ajax({
            url: "../index.php/searchdata",
            type: "GET",
            data: "q=" + q + "&pid=" + pid,
            dataType: "json",
            async: false,
            success: function(data) {
                $(\'#load_data\').append(data.content);
                Pageid = data.pid;
                if (data.pid == null) {
                 
                     action = \'active\';
                     $(\'#ajax-load\').hide();
                    $(\'#load_data_message\').html(\'<div class="w3-panel w3-yellow"><h3>抱歉！</h3><p>没有找到相关视频</p></div>\');
                } else {
                    action = "inactive";
                    $(\'#ajax-load\').hide();
                }
            }
        });
    }

    if (action == \'inactive\') {

        action = \'active\';
        $(\'#ajax-load\').show();
        load_country_data(query, Pageid);
    }

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == \'inactive\') {
         $(\'#ajax-load\').show();
            action = \'active\';
            setTimeout(function() {
                load_country_data(query, Pageid);
            }, 3800);
        }
    });

});

</script>';



        echo $footer;
        break;
        
        
        
    default:
        echo $header;
        echo '<div class="w3-container w3-center" style="background-color: #fff;">
            <img src="'.Root_part().'1.png" class="logo">
            <div class="wrap">
                <div class="search">
                <form action="./index.php/search">
                    <input type="text" name="q" class="searchTerm" style="box-sizing: initial">
                    <button type="submit" class="searchButton"> <i class="fas fa-arrow-right"></i>
                    </form>
                    </button>
                </div>
            </div>
        </div>
        <div class="w3-container w3-center" style="background-color: #fff;margin-top: 10px;">
        <h3>#时下流行#</h3>
            <div class="tj">';
            $home_data=get_trending($key,'25','','tw');
            
            foreach ($home_data["items"] as $v) {
                echo '
                <a href="'.Root_part().'index.php/watch?'. $v["id"].'" >
                <div class="Media">
                
                        <div class="Media-body">
                        
                            <h3 class="Media-title">'.$v["snippet"]["title"].'</h3>
                            
                        </div>
                    
                        <img class="Media-figure Image" src="'.Root_part().'Proxy.php?img.youtube.com/vi/'. $v["id"].'/mqdefault.jpg">
                    
                </div>
                </a>';
            }
            echo '<script src="twinput1.0.0.js"></script>
        <script>
        $(\'.searchTerm\').tw_input_placeholder({
            speed: 100,
            delay: 2000,
            keywords: [\'想看点啥?\', \'您可以输入一个Youtube视频链接\', \'https://www.youtube.com/watch?v=3qrsX5PIUn4\', \'或者是输入一个关键词搜索\',
                    \'Music\']
        });
        </script></div></div>';
        
       echo $footer;
        break;
    
}


















//CURL
function get_data($url){
    if (!function_exists("curl_init")) {
		$f = file_get_contents($url);
	} else {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt($ch, CURLOPT_REFERER, 'http://www.youtube.com/');
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.91 Safari/534.30");
		$f = curl_exec($ch);
		curl_close($ch);
	}
   return $f;  
}
//获取热门
function get_trending($apikey,$max,$pageToken='',$regionCode='vn'){
    $apilink='https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&chart=mostPopular&regionCode='.$regionCode.'&maxResults='.$max.'&key='.$apikey.'&pageToken='.$pageToken;
     return json_decode(get_data($apilink),true);
}

function Root_part(){
$http=isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$part=rtrim($_SERVER['SCRIPT_NAME'],basename($_SERVER['SCRIPT_NAME']));
$domain=$_SERVER['SERVER_NAME'];
 return "$http"."$domain"."$part";
}
//获取搜索数据
function get_search_video($query,$apikey,$type='video',$order='relevance',$regionCode='VN',$pageToken=''){
   $apilink='https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=15&regionCode='.$regionCode.'&order='.$order.'&type='.$type.'&q='.$query.'&key='.$apikey.'&pageToken='.$pageToken;
   return json_decode(get_data($apilink),true);
}

?>

 
