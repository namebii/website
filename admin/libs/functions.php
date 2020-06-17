<?php
session_start();

function d($data){
    if(is_null($data)){
        $str = "<i>NULL</i>";
    }elseif($data == ""){
        $str = "<i>Empty</i>";
    }elseif(is_array($data)){
        if(count($data) == 0){
            $str = "<i>Empty array.</i>";
        }else{
            $str = "<table style=\"margin-left:600px; width: 300px; border-bottom:0px solid #000;\" cellpadding=\"0\" cellspacing=\"0\">";
            foreach ($data as $key => $value) {
                $str .= "<tr><td style=\"background-color:#008B8B; color:#FFF;border:1px solid #000;\">" . $key . "</td><td style=\"border:1px solid #000;\">" . d($value) . "</td></tr>";
            }
            $str .= "</table>";
        }
    }elseif(is_resource($data)){
        while($arr = mysql_fetch_array($data)){
            $data_array[] = $arr;
        }
        $str = d($data_array);
    }elseif(is_object($data)){
        $str = d(get_object_vars($data));
    }elseif(is_bool($data)){
        $str = "<i>" . ($data ? "True" : "False") . "</i>";
    }else{
        $str = $data;
        $str = preg_replace("/\n/", "<br>\n", $str);
    }
    return $str;
}

function dnl($data){
    echo d($data) . "<br>\n";
}

function dd($data){
    echo dnl($data);
    exit;
}

function ddt($message = ""){
    echo "[" . date("Y/m/d H:i:s") . "]" . $message . "<br>\n";
}

/* Hàm xem mảng */
function xemmang($array)
{
    echo '<pre>',print_r($array),'</pre>';
}
/* Hàm thông báo lỗi lên màn hình */
function alert($message) {
    echo "<script>alert('$message');</script>"; 
}   
// Gọi hàm
// alert("Welcome to Geeks for Geeks"); 

/* Hàm kiểm tra đăng nhập */
function islogin()
{
    if(isset($_SESSION['login']) && $_SESSION['login'])
    {
       return true;
    }
    return false;
}

/* Hàm cắt nội dung */
function catnoidung($len, $string)
{   
    $string = trim($string);
    $total_len = trim($string);
    if ($len < $total_len) {
        $string_cut = substr($string, 0, $len);
        return substr($string_cut, 0, strrpos($string_cut, ' ')) . '[...]';
    } else {
        return $string;
    }
}
// $result_catnoidung=catnoidung($_GET['len'],$_GET['string']);
// echo $result_catnoidung;

/* Hàm tìm tất cả vị trí */
function timvitri($string, $find)
{   
    $kq='';
    $string = trim($string);
    $find = trim($find);
    $location_find = 0;
    do{
        $pos = strpos($string,$find,$location_find);
        if($pos!==false)
        { 
            $location_find = $pos+1;
            $kq .=$pos.',';
        }
    }
    while($pos!==false);
    return trim($kq,',');
}
// $result_timvitri=timvitri($_GET['string'],$_GET['find']);
// echo $result_timvitri;

/* Random */
function random_txt($n){
    $string='ABCDEFGHIJKLMNOPQRSTUVXYZabcdefghijklmnopqrstuvxyz0123456789';
    $result_random='';
    $len=strlen($string);
    for($i=1;$i<=$n;$i++){
        $start=rand(0,$len-1);
        $result_random.=substr($string,$start,1);
    }
    return $result_random;
}
// echo random_txt(10);
// echo rand($_GET['min'],$_GET['max']);

/* Tính khoảng cách giữa 2 ngày */
function khoangcach2ngay($batdau,$ketthuc){
    $batdau=strtotime($batdau);
    $ketthuc=strtotime($ketthuc);
    $khoangcach=abs(($ketthuc-$batdau)/86400);
    return $khoangcach;
    
}
// $result_khoangcach2ngay=khoangcach2ngay($_GET['batdau'],$_GET['ketthuc']);
// echo $result_khoangcach2ngay;

/* Tính ngày sinh nhật */
function birthday($birthday){
    $time_hientai=time();
    $khoangcach=($time_hientai-strtotime($birthday))/86400;
    return abs(round($khoangcach));
}
// $result_sinhnhat=birthday($_GET['birthday']);
// $result_sinhnhat=birthday(06-18-2020);
// echo $result_sinhnhat;

/* Giải PT bậc 1 */
// ax + b = 0
function ptbac1($a,$b){
    $nghiem='';
    if($a==0){
        if($b==0){
            $nghiem='Vô số nghiệm';
        }else{
            $nghiem='Vô nghiệm';
        }
    }else{
        $nghiem=-$b/$a;
    }
    return $nghiem;
}
// $result_ptbac1=ptbac1($_GET['a'],$_GET['b']);
// $result_ptbac1=ptbac1(1,3);
// echo $result_ptbac1;

/* Giải PT bậc 2 */
// ax2 + bx + c = 0
function ptbac2($a,$b,$c){
    if($a==0){
        return ptbac1($b,$c);
    }else{
        $delta=pow($b,2)-(4*$a*$c);
        if($delta>0){
            $x1=(-$b-sqrt($delta))/(2*$a);
            $x2=(-$b+sqrt($delta))/(2*$a);
            return 'x1= '.$x1.', x2= '.$x2;
        }elseif($delta==0){
            return -$b/(2*$a);
        }else{
            return 'Phương trình vô nghiệm';
        }
    }
}
// $result_ptbac2=ptbac2($_GET['a'],$_GET['b'],$_GET['c']);
// $result_ptbac2=ptbac2(1,-5,6);
// echo $result_ptbac2;

/* Giải PT bậc 2 nhiều ô */
// ax2 + bx + c = 0
function ptbac2nhieuo($a,$b,$c,&$x1,&$x2){
    if($a==0){
        $x1=$x2 = ptbac1($b,$c);
    }else{
        $delta=pow($b,2)-(4*$a*$c);
        if($delta>0){
            $x1=(-$b-sqrt($delta))/(2*$a);
            $x2=(-$b+sqrt($delta))/(2*$a);
        }elseif($delta==0){
            $x1 = $x2 = -$b/(2*$a);
        }else{
            $x1 = $x2 = 'Phương trình vô nghiệm';
        }
    }
}
// $x1=$x2='';
// $result_ptbac2nhieuo = ptbac2nhieuo(1,-5,6,$x1,$x2);
// echo 'x1= '.$x1.'<br>';
// echo 'x2= '.$x2;

?>