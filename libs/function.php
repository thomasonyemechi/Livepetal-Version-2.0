<?php

function win_hashs($length)
{
    return substr(str_shuffle(str_repeat('123456789abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);
}
function win_hash($length)
{
    return substr(str_shuffle(str_repeat('123456789', $length)), 0, $length);
}



function sqL($table)
{
    global $db;
    $sql = $db->query("SELECT * FROM $table") or die(mysqli_error());
    return mysqli_num_rows($sql);
}
function sqL1($table, $col, $val)
{
    global $db;
    $sql = $db->query("SELECT * FROM $table WHERE $col='$val' ") or die(mysqli_error());
    return mysqli_num_rows($sql);
}

function sqL2($table, $col, $val, $col2, $val2)
{
    global $db;
    $sql = $db->query("SELECT * FROM $table WHERE $col='$val' AND $col2='$val2' ") or die(mysqli_error());
    return mysqli_num_rows($sql);
}
function sqL3($table, $col, $val, $col2, $val2, $col3, $val3)
{
    global $db;
    $sql = $db->query("SELECT * FROM $table WHERE $col='$val' AND $col2='$val2' AND $col3='$val3' ") or die(mysqli_error());
    return mysqli_num_rows($sql);
}
function sqLx($table, $col, $val, $item)
{
    global $db;
    $sql = $db->query("SELECT * FROM $table WHERE $col='$val' ") or die(mysqli_error());
    $row = mysqli_fetch_assoc($sql);
    return $row[$item] ?? '';
}
function sqLx2($table, $col, $val, $col2, $val2, $item)
{
    global $db;
    $sql = $db->query("SELECT * FROM $table WHERE $col='$val' AND $col2='$val2' ") or die(mysqli_error());
    $row = mysqli_fetch_assoc($sql);
    return $row[$item];
}

function countMessage($id)
{
    global $db;

    $sql = $db->query("SELECT * FROM msg WHERE senderid='$id' AND active='1'");

    return $sql->num_rows;
}
function readMessage($uid)
{
    global $db;

    $sql = $db->query("UPDATE msg SET active=0 WHERE receiverid='$uid'");
}
function incentive1($uid, $stage, $level)
{
    global $db;

    $sql = $db->query("SELECT * FROM incentive WHERE id='$uid' AND stage='$stage' AND level='$level'");
    $row = $sql->fetch_assoc();
    if ($sql->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
function incentive($uid, $stage, $level)
{
    global $db;

    $sql = $db->query("SELECT * FROM incentive WHERE id='$uid' AND stage='$stage' AND level='$level'");
    $row = $sql->fetch_assoc();

    return $row['status'];
}
function bcrypt($pass)
{
    return password_hash($pass, PASSWORD_BCRYPT);
}
function receivedTransfer($uid)
{
    global $db;

    $sql = $db->query("SELECT SUM(amount) AS sum FROM transfer WHERE id2='$uid'");
    $row = $sql->fetch_assoc();

    return $row['sum'];
}
function shaToKey($sn, $col = 'sn')
{
    global $db;

    $sql = $db->query("SELECT * FROM user WHERE sha1(sn) = '$sn' LIMIT 1");
    $row = $sql->fetch_assoc();
    $val = $row[$col];
    return $val;
}
function get_time_ago($time)
{
    $time_difference = time() - $time;
    if ($time_difference < 1) {
        return "less than 1 second ago";
    }
    $condition = array(
        12 * 30 * 24 * 60 * 60 => 'Year',
        30 * 24 * 60 * 60 => 'Month',
        24 * 60 * 60 => 'Day',
        60 * 60 => 'Hour',
        60 => 'Second'
    );
    foreach ($condition as $secs => $str) {
        $d = $time_difference / $secs;
        if ($d >= 1) {
            $t = round($d);
            return $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
        }
    }
}
function totalTransfer($uid)
{
    global $db;

    $sql = $db->query("SELECT SUM(amount) AS sum FROM transfer WHERE id='$uid'");
    $row = $sql->fetch_assoc();

    return $row['sum'];
}
function totalWithdraw($uid)
{
    global $db;

    $sql = $db->query("SELECT SUM(amount) AS sum FROM withdraw WHERE id='$uid'");
    $row = $sql->fetch_assoc();

    return $row['sum'];
}
function IdToSn($id)
{
    global $db;

    $sql = $db->query("SELECT * FROM user WHERE id='$id' LIMIT 1");
    $row = $sql->fetch_assoc();
    $val = $row['sn'];
    return $val;
}
function snToName($sn, $col = '')
{
    global $db;

    $sql = $db->query("SELECT * FROM user WHERE sn='$sn' LIMIT 1");
    $row = $sql->fetch_assoc();
    $val = ($col == '') ? $row['firstname'] . ' ' . $row['lastname'] : $row[$col];
    return $val;
}
function userName($id, $col = '')
{
    global $db;

    $sql = $db->query("SELECT * FROM user WHERE id='$id'");
    $row = $sql->fetch_assoc();
    $val = ($col == '') ? $row['firstname'] . ' ' . $row['lastname'] : $row[$col];
    return $val;
}



function userNameMat($id, $col = '')
{
    global $db;

    $sql = $db->query("SELECT * FROM matuser WHERE id='$id'");
    $row = $sql->fetch_assoc();
    $val = ($col == '') ? $row['sn'] : $row[$col];
    return $val;
}



function sqL1x($table, $col1, $val1, $level = 1)
{
    global $db;
    $sql = $db->query("select * from $table where $col1='$val1' ") or die(mysqli_error());
    if ($level == 1) {
        return $sql;
    } elseif ($level == 2) {
        return mysqli_fetch_assoc($sql);
    } else {
        return mysqli_num_rows($sql);
    }
}
function snToId($sn)
{
    global $db;

    $sql = $db->query("SELECT * FROM user WHERE sn='$sn' LIMIT 1");
    $row = $sql->fetch_assoc();

    return $row['id'];
}
function stageNo($stage, $level)
{
    global $db;

    $sql = $db->query("SELECT * FROM levels WHERE stg='$stage' AND level='$level' LIMIT 1");
    $row = $sql->fetch_assoc();

    return $row['sn'];
}


function sqL33($table, $col1, $val1, $col2, $val2, $col3, $val3, $level = 1)
{
    global $db;
    $sql = $db->query("select * from $table where $col1='$val1' and $col2='$val2' and $col3='$val3' ") or die(mysqli_error());
    if ($level == 1) {
        return $sql;
    } elseif ($level == 2) {
        return mysqli_fetch_assoc($sql);
    } else {
        return mysqli_num_rows($sql);
    }
}


function sqL4($table, $col1, $val1, $col2, $val2, $col3, $val3, $col4, $val4, $level = 1)
{
    global $db;
    $sql = $db->query("select * from $table where $col1='$val1' and $col2='$val2' and $col3='$val3' and $col4='$val4' ") or die(mysqli_error());
    if ($level == 1) {
        return $sql;
    } elseif ($level == 2) {
        return mysqli_fetch_assoc($sql);
    } else {
        return mysqli_num_rows($sql);
    }
}

function sqL5($table, $col1, $val1, $col2, $val2, $col3, $val3, $col4, $val4, $col5, $val5, $level = 1)
{
    global $db;
    $sql = $db->query("select * from $table where $col1='$val1' and $col2='$val2' and $col3='$val3' and $col4='$val4' and $col5='$val5' ") or die(mysqli_error());
    if ($level == 1) {
        return $sql;
    } elseif ($level == 2) {
        return mysqli_fetch_assoc($sql);
    } else {
        return mysqli_num_rows($sql);
    }
}




function colSum($table, $col, $format = 1)
{
    global $db;
    $sql = $db->query("SELECT SUM($col) AS value_sum FROM $table where sid = SID ");
    $row = mysqli_fetch_assoc($sql);
    if ($format == 1) {
        return number_format($row['value_sum']);
    } else {
        return $row['value_sum'];
    }
}



function colSum1($table, $col, $cola, $vala, $format = 1)
{
    global $db;
    $sql = $db->query("SELECT SUM($col) AS value_sum FROM $table WHERE $cola = '$vala' ");
    $row = mysqli_fetch_assoc($sql);
    if ($format == 1) {
        return number_format($row['value_sum']);
    } else {
        return $row['value_sum'];
    }
}




function colSum2($table, $col, $cola, $vala, $colb, $valb, $format = 1)
{
    global $db;
    $sql = $db->query("SELECT SUM($col) AS value_sum FROM $table WHERE $cola = '$vala' AND $colb = '$valb' ");
    $row = mysqli_fetch_assoc($sql);
    if ($format == 1) {
        return number_format($row['value_sum']);
    } else {
        return $row['value_sum'];
    }
}



function colSum3($table, $col, $cola, $vala, $colb, $valb, $colc, $valc, $format = 1)
{
    global $db;
    $sql = $db->query("SELECT SUM($col) AS value_sum FROM $table WHERE $cola = '$vala' AND $colb = '$valb' AND $colc = '$valc' ");
    $row = mysqli_fetch_assoc($sql);
    if ($format == 1) {
        return number_format($row['value_sum']);
    } else {
        return $row['value_sum'];
    }
}


function rangeSum($table, $col, $start, $end)
{
    global $db;
    $sql = $db->query("SELECT SUM($col) AS value_sum FROM $table WHERE today between '$start' and '$end' ");
    $row = mysqli_fetch_assoc($sql);
    return number_format($row['value_sum']);
}

function userLog()
{
    if ($_SESSION['user'] != 'admin') {
        header("location: logout.php");
    }
    return;
}




///// TABLES

function Table($field, $value, $dbtable)
{
    //field is an array that needs to be exploaded
    //dbtable is the name of the database table you want to fetch from
    //sumoption make a provision for adding a sum row at the end of the 
    //table and needs to be defined eternally to contain the exact structure of 
    //the table row containing sum of column fields.
    $field = explode(' ', $field);
    $value = explode(' ', $value);
    $n = count($field);
    $a = 0;



    $table .= '<table class="table table-hover" id="dataTables-example">
                    <thead>
                          <tr>';
    while ($a < $n) {
        $b = $a++;
        $table .= '<th>' . strtoupper(str_replace("-", " ", $field[$b])) . '</th>';
    }
    $table .= '   </tr>
                    </thead>
                    <tbody> ';

    //$qu=mysql_query("select * FROM zone ORDER BY zone " )or die(mysql_error());


    while ($row = sqL($dbtable)) {

        $table .= '<tr class="odd gradeX">';
        $a = 0;
        while ($a < $n) {
            $b = $a++;
            $table .= '<td class="center">' . $row->$value[$b] . ' </td>';
        }
        $table .= '</tr>';
    }


    $table .= ' </tbody></table>';

    return $table;
}




function chkLogin()
{
    global $db, $userPhoto, $userLevel;
    if ($_SERVER['SCRIPT_NAME'] == '/profile/login.php') {
    } else {
        if (!isset($_SESSION['admin']) or !isset($_SESSION['rep'])) {
            header('location: ../');
            exit;
        } else {
            $user = $_SESSION['rep'];
            $sql = $db->query("SELECT * FROM user WHERE sn = '$user' ");
            $row = mysqli_fetch_assoc($sql);
            $userPhoto = $row['photo'];
            $userLevel = $row['usertype'];

            if ($userLevel < 1) {
                header('location: ../');
            } elseif ($userLevel > 2) {
                header('location: ../');
            } else {
            }
        }
    }

    return;
}

function adminAccess()
{
    if ($_SESSION['userLevel'] != 2) {
        session_destroy();
    }
    return;
}

function checkExtension($end)
{
    $array = array('jpg', 'jpeg', 'gif', 'png');

    if (in_array($end, $array)) {
        return true;
    } else {
        return false;
    }
}
function checkSize($image_size)
{
    if ($image_size <= 1048576) {
        return true;
    } else {
        return false;
    }
}
function sanitize($str)
{
    global $db;
    return mysqli_real_escape_string($db, $str);
}


function selectBank($json, $code = '')
{
    $code = (string)$code;
    $res = '';
    foreach ($json as $key => $value) {
        if (!is_array($value)) {
            echo $key . '=>' . $value . '<br />';
        } else {
            foreach ($value as $key => $val) {
                if ($key == 'name') {
                    $sel = (string)$value['code'] == $code ? ' selected' : '';
                    $res .= '<option value="' . $value['code'] . '"' . $sel . '>' . $value['name'] . '</option><br />';
                }
            }
        }
    }
    return $res;
}



function dTable($head, $body, $sql, $action = 0)
{
    //$head: array of table head elements
    //$body: array of table row elements
    //$sql: database query
    //$action: additional column for form button
    $action1 = $action;
    $i = 0;
    $x = 0;
    $n = count($head);
    $m = count($body);

    $act = $action == 0 ? '' : '<th>Action</th>';




    $table = '<table id="example1" class="table table-bordered table-striped  table-sm">
                  <thead>
                  <tr>';
    while ($i < $n) {
        $a = $i++;

        $table .= '<th>' . $head[$a] . '</th>';
    }
    $table .= $act . '</tr>
                  </thead>
                  <tbody>';
    while ($row = mysqli_fetch_assoc($sql)) {
        $action = $action1 == 0 ? '' : '<td><form method="POST"><button type="submit" name="' . $action1[0] . '" class="btn btn-xs btn-primary" value="' . $row[$action1[2]] . '">' . $action1[1] . '</button></form></td>';

        $table .= ' <tr>';
        $x = 0;
        while ($x < $m) {
            $y = $x++;
            $b = $row[$body[$y]];
            $table .= '<td>' . $b . '</td>';
        }

        $table .= $action . '</tr>';
    }

    $table .= '</tbody>
                  <tfoot>
                  <tr>';

    $i = 0;
    while ($i < $n) {
        $a = $i++;

        $table .= '<th>' . $head[$a] . '</th>';
    }
    $table .= $act . '</tr>
                  </tfoot>
                </table>';

    return $table;
}

function updateLog()
{
    global $db;
    $ymd = date('ymd');
    $hit = sqLx('msglog', 'ymd', $ymd, 'hit');
    $hits = (int)$hit + 1;
    if (sqL1('msglog', 'ymd', $ymd) == 0) {
        $db->query("INSERT INTO msglog (ymd) VALUES ('$ymd') ");
    }
    $db->query("UPDATE msglog SET hit='$hits' WHERE ymd='$ymd' ");
    return;
}


function sendWhatsapp($phone, $message)
{
    $message = trim($message);
    $data = [
        'phone' => $phone, // Receivers phone
        'body' => $message, // Message
    ];
    $json = json_encode($data); // Encode data to JSON
    // URL for request POST /message
    $token = 'fw9ww74keh0pl7fc';
    $instanceId = '174200';

    $url = 'https://eu172.chat-api.com/instance174200/message?token=' . $token;
    // Make a POST request
    $options = stream_context_create([
        'http' => [
            'method'  => 'POST',
            'header'  => 'Content-type: application/json',
            'content' => $json
        ]
    ]);
    // Send a request

    //$result = $message=='' ? '' : file_get_contents($url, false, $options);
    //updateLog();
    return;
}

function addNotice($id, $title, $note)
{
    global $db;
    $db->query("INSERT INTO notice (id,title,note) VALUES('$id','$title','$note') ");
    return;
}

function getBank($json, $code)
{
    $sel = '';
    $code = (string)$code;
    foreach ($json as $key => $value) {
        if (!is_array($value)) {
            echo $key . '=>' . $value . '<br />';
        } else {
            foreach ($value as $key => $val) {
                if ($key == 'code') {
                    $sel .= (string)$value['code'] == $code ? $value['name'] : '';
                }
            }
        }
    }
    return $sel;
}

// function sendWhatsapp($phone, $message) {

// 	$arr = json_encode(array(
// 		"phone"=>$phone,
// 		"body"=>$message
// 	));

// 	$token = 'zu2zpzlbqoc2xcay';
// 	$instanceId = '167828';
// 	$url = 'https://eu139.chat-api.com/instance'.$instanceId.'/message?token='.$token;
// 	$ch=curl_init();
// 	curl_setopt($ch, CURLOPT_URL, $url);
// 	curl_setopt($ch, CURLOPT_POST, true);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
// 			'Content-type:application/json',
// 			'content-length:'.strlen($arr)
// 	));
// 	$result=curl_exec($ch);
// 	if($result){
// 	curl_close($ch);
// 	echo $result; }else{
// 		echo 'Not sent';
// 	}
// }

$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';

function getOS()
{

    global $user_agent;

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser()
{

    global $user_agent;

    $browser        = "Unknown Browser";

    $browser_array = array(
        '/msie/i'      => 'Internet Explorer',
        '/firefox/i'   => 'Firefox',
        '/safari/i'    => 'Safari',
        '/chrome/i'    => 'Chrome',
        '/edge/i'      => 'Edge',
        '/opera/i'     => 'Opera',
        '/netscape/i'  => 'Netscape',
        '/maxthon/i'   => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i'    => 'Handheld Browser'
    );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}


function newStatus($orderid)
{
    $ch = curl_init();
    $url = 'https://smartrecharge.ng/api/v2/airtime/?api_key=5ee93d81&order_id=' . $orderid . '&task=check_status';

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $resultx = curl_exec($ch);
    curl_close($ch);
    $res = json_decode($resultx, true);
    return $res['text_status'];
}



function reverseTopup($ref)
{
    global $db, $report;
    $trid = sqLx('ewalletx', 'trno', $ref, 'opt');
    $userid = sqLx('ewalletx', 'trno', $ref, 'id');
    $remark = sqLx('ewalletx', 'trno', $ref, 'remark');
    $amount = sqLx('ewalletx', 'trno', $ref, 'cos');
    $phone = userName($userid, 'whatsapp');
    $msg = 'Your transaction with Remark: ' . $remark . ', Amount: NGN' . number_format(abs($amount)) . ', failed and has been reversed. Your wallet has been refunded accordingly';

    $da = explode(',', $trid);
    $order_id = $da[0];
    $sn = sqLx('ewalletx', 'trno', $ref, 'sn');
    $sn2 = $sn + 10;
    // $sn3 = $sn+2;

    $db->query("DELETE FROM ewalletx WHERE sn='$sn' ");
    $db->query("DELETE FROM ewalletx WHERE sn>'$sn' AND sn<'$sn2' AND opt='$order_id' ");
    //$db->query("DELETE FROM ewalletx WHERE sn>'$sn' AND sn<'$sn2' AND opt='$order_id' ");

    addNotice($userid, 'Reversed Transaction', $msg); //sendWhatsapp($phone, $msg);

    $report = 'Operation completed successfully';
}


function notifyPending($ref, $x = 2)
{
    global $db, $report;
    $trid = sqLx('ewalletx', 'trno', $ref, 'opt');
    $userid = sqLx('ewalletx', 'trno', $ref, 'id');
    $remark = sqLx('ewalletx', 'trno', $ref, 'remark');
    $amount = sqLx('ewalletx', 'trno', $ref, 'cos');
    $phone = userName($userid, 'whatsapp');
    if ($x == 1) {
        $title = 'Pending Transaction';
        $msg = 'Your transaction with Remark: ' . $remark . ', Amount: NGN' . number_format(abs($amount)) . ', is still processing. The transaction is being monitored and you will be notified as soon as it is completed';
    } else {
        $title = 'Topup Successful';
        $msg = 'Your transaction with Remark: ' . $remark . ', Amount: NGN' . number_format(abs($amount)) . ', is completed and successfully delivered';
    }

    addNotice($userid, $title, $msg); //sendWhatsapp($phone, $msg);

    $report = 'Operation completed successfully';
}

function notifyTopupSuccess($id, $amount, $remark)
{
    $msg = 'Your transaction with Remark: ' . $remark . ', Amount: NGN' . number_format(abs($amount)) . ', is completed and successfully delivered';

    addNotice($id, 'Topup Successful', $msg); //sendWhatsapp($phone, $msg);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'https://api.paystack.co/bank');
$result = curl_exec($ch);
curl_close($ch);

$res2 = json_decode($result, true);
