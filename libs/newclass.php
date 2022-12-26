<?php

if(!isset($_COOKIE['agent'])){
$agent = substr(str_shuffle(str_repeat('123456789abcdefghijklmnopqrstuvwxyz', 14)), 0, 14);
setcookie('agent', $agent, time() + (86400 * 730), '/'); // 86400 = 1 day
}

$uri = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);

function keepMeLogin(){
  global $uri;
  if(isset($_COOKIE['mpass']) && isset($_COOKIE['muser']) && sqLx('user','email',$_COOKIE['muser'],'keep')==1 && !isset($_SESSION['user_idx'])){
    $_SESSION['user_idx'] = sqLx('user','email',$_COOKIE['muser'],'id');

   if($uri=='login'){ header('location: index.php'); }
  }
  return;
}

function loginAtt($email,$type){
  global $db;
  $agent = $_COOKIE['agent']??'';
  $ymd = date('ymd');
  $ctime = time();
   $db->query("INSERT INTO loginatt (email,type,ctime,ymd,agent) VALUES ('$email','$type','$ctime','$ymd','$agent') ");
return;
}

keepMeLogin();

function logPhone($phone,$code){
  global $db;
  $code = explode('_', $code); $code2=$code[1];
  $code = $code2=='data'?$code[2]:$code[0];
  $user = $_SESSION['user_idx'];
  if(sqL2('phonelog','id',$user,'phone',$phone)==0){
    $db->query("INSERT INTO phonelog (id,phone,code) VALUES ('$user','$phone','$code') ");
  }else{
    $no = sqLx2('phonelog','id',$user,'phone',$phone,'status')+1;
    $db->query("UPDATE phonelog SET status='$no' WHERE id='$user' AND phone='$phone' ");
  }
  return;
}

class Recharge {
            
    /* Class constructor */
   function __construct(){

      return;
      }



      public function airtime($amount,$phone,$productcode) {
       
     $url = AIRTIME.'&product_code='.$productcode.'&phone='.$phone.'&amount='.$amount.'&callback='.CALLBACK;
        //$result = file_get_contents($url, '', NULL);
logPhone($phone,$productcode);
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
   
return json_decode($result,true);
}


     function verifyAirtime($order_id){
        global $report;
        $url = AIRTIME.'&order_id='.$order_id.'&task=check_status';
        $ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);

return json_decode($result,true);
     }

     function verifyElectric($order_id){
        global $report;
        $url = ELECTRIC.'&order_id='.$order_id.'&task=check_status';
        $ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);

return json_decode($result,true);
     }

     function verifyElectricMeter($meter,$productcode){
        global $report;
        $url = ELECTRIC.'&meter_number='.$meter.'&product_code='.$productcode.'&task=verify';
        $ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);

return json_decode($result,true);
     }

     function verifyCable($smartcard,$productcode){
        global $report;
        $url = CABLE.'&smartcard_number='.$smartcard.'&product_code='.$productcode.'&task=verify';
        $ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);

return json_decode($result,true);
     }


public function directData($phone,$productcode) {
           
 $url = DIRECTDATA.'&product_code='.$productcode.'&phone='.$phone.'&callback='.CALLBACK;
 logPhone($phone,$productcode);
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);

return json_decode($result,true);   

}


      public function dataShare($phone,$productcode) {
        
$url = DATASHARE.'&product_code='.$productcode.'&phone='.$phone.'&callback='.CALLBACK;
logPhone($phone,$productcode);
       $ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);

return json_decode($result,true);  
   }



    
          public function electric($amount, $meterno, $productcode) {
        
        $url = ELECTRIC.'&product_code='.$productcode.'&meter_number='.$meterno.'&amount='.$amount.'&callback='.CALLBACK;
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);

return json_decode($result,true);  
   }    


public function cable($cardno, $productcode) {
        
        $url = CABLE.'&product_code='.$productcode.'_&smartcard_number='.$cardno.'&callback='.CALLBACK;
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);

return json_decode($result,true);  
   }        


public function verifyAccountNo($bank, $acno) {
        
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/accounts/resolve",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'account_bank'=>$bank,
    'account_number'=>$acno]),
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
     "Authorization: Bearer FLWSECK-3d1e4cd338418cce46e46f2ae48f607f-X"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return json_decode($response,true);     
}




}

$topup = new Recharge;





//  require_once './vendor/autoload.php';

// use TrenetTopUp\App\TopUp;
class Profile
{

    var $regfee = 5000;  //Registration Fee

    var $minwithdraw = 20000;
    var $maxwithdraw = 2000000;
    var $withdrawcharge = 100;//0.5;
    var $mininvest = 50000;//0.5;




    //User Array Keys 
    /* Class constructor */
    function __construct()
    {
global $report, $count;
if (array_key_exists('InitialSignup', $_POST)) { $this->signupUserIni(); }
elseif (array_key_exists('signupUserMob', $_POST)) { $this->signupUserMob(); } 
elseif (array_key_exists('FindBeneficiary', $_POST)) { $this->FindBeneficiary();  }
elseif (array_key_exists('VerifySponsor', $_POST)) { $this->VerifySponsor(); } 
elseif (array_key_exists('AccountActini', $_POST)) { $this->AccountActini();     }
elseif (array_key_exists('unsetSignup', $_POST)) { unset($_SESSION['signup']); header("location: ?");  } 

elseif (array_key_exists('ProceedToLogin', $_POST)) { session_destroy(); header("location:login.php"); } 
elseif (array_key_exists('LoginUsers', $_POST)) {  $this->LoginUsers(); }  
elseif (array_key_exists('LoginUsersMob', $_POST)) {  $this->LoginUsersMob(); } 
elseif (array_key_exists('LogoutUser', $_POST)) {  $this->LogoutUser(); } 
elseif(array_key_exists('FundWalletIni', $_POST)){ $this->FundWalletIni(); }
elseif(isset($_GET['logout'])) {$this->LogoutUser(); } 
elseif(isset($_GET['txref'])) {$this->processPay($_GET['txref']); }  
elseif(isset($_GET['tx_ref'])) {$this->processPay($_GET['tx_ref']); } 
elseif(isset($_GET['SearchClient'])){ $this->SearchClient(); }
elseif(array_key_exists('SearchClient', $_POST)){ $this->SearchClient(); }
elseif(array_key_exists('SearchUpline', $_POST)){ $this->SearchUpline(); }
elseif(array_key_exists('ActivateRef', $_POST)){ $this->ActivateRef(); }
elseif (array_key_exists('ApproveFundOrder', $_POST)) { $this->ApproveFundOrder();}
elseif (array_key_exists('PinActivation', $_POST)) { $this->PinActivation();}
elseif (array_key_exists('WalletActivation', $_POST)) { $this->WalletActivation();}
elseif (array_key_exists('ActivateReferral', $_POST)) { $this->ActivateReferral();}
elseif (array_key_exists('AddPlanReport', $_POST)) { $this->AddPlanReport();}


elseif (array_key_exists('changeSponsor', $_POST)) { $_SESSION['signup'] = NULL; } 
elseif (array_key_exists('changeLogin', $_POST)) { $_SESSION['signup'] = 2; } 
elseif (array_key_exists('regContinue', $_POST)) {  $_SESSION['signup'] = 5;  $head = $this->win_hash(85);
            header("location: ?user_ref=$head"); } 

elseif (array_key_exists('resetPass', $_POST)) {  $this->resetPass($_POST['emailreset']);   } 

elseif (array_key_exists('updateUserBank', $_POST)) {   $this->updateUserBank();   } 
elseif (array_key_exists('resetPassConfirm', $_POST)) {   $this->resetPassConfirm(); } 
elseif (array_key_exists('signupUserIni', $_POST)) {   $this->signupUserIni();     } 
elseif (isset($_GET['tr_reference'])) {  $this->confirmPayment();   } 
elseif (isset($_GET['form'])) {if($_GET['form']=='reset'){session_destroy(); header('location: signup.php'); } } 
elseif (array_key_exists('changePassword', $_POST)) { $this->changePassword(); }
elseif (array_key_exists('UpdateReward', $_POST)) { $this->UpdateReward($_POST['UpdateReward']); } 
elseif (array_key_exists('changePassword2', $_POST)) { $this->changePassword2(); } 
elseif (array_key_exists('UpdateUser', $_POST)) { $this->UpdateUser(); } 
elseif (array_key_exists('UpdateUser2', $_POST)) { $this->UpdateUser2(); } 
elseif (array_key_exists('SelectItem', $_POST)) { $this->SelectItem(); } 
elseif (array_key_exists('newSalesByUser', $_POST)) { $this->newSalesByUser(); } 
elseif (array_key_exists('newSalesByAdmin', $_POST)) { $this->newSalesByAdmin(); } 

elseif (array_key_exists('updatePhoto', $_POST)) {   $this->updatePhoto();  } 
elseif (array_key_exists('updatePhoto2', $_POST)) { $this->updatePhoto2(); } 
elseif (array_key_exists('EditProfile', $_POST)) {  $this->EditProfile(); } 
elseif (array_key_exists('UploadPicture', $_POST)) { $this->UploadPicture();  } 
elseif (array_key_exists('Uprofile', $_POST)) {$_SESSION['uidd'] = $_POST['Uprofile']; header("Location:searchuser.php?u-ref=");}
elseif (array_key_exists('ViewGeneology', $_POST)) {$_SESSION['uiddx'] = $_POST['ViewGeneology']; header("Location:admingen.php");}
elseif (array_key_exists('ChangeUserPassword', $_POST)) { $this->ChangeUserPassword();  }
elseif (array_key_exists('ChangeUserPasswordAdmin', $_POST)) { $this->ChangeUserPasswordAdmin(); } 
elseif (array_key_exists('MessageSubmit', $_POST)) { $this->MessageSubmit();  } 
elseif (array_key_exists('MessageAdminSubmit', $_POST)) {  $this->MessageAdminSubmit();  } 
elseif (array_key_exists('ReplyMessage', $_POST)){$this->ReplyMessage($_POST['receiver'],$_POST['ReplyMessage']); }
elseif (array_key_exists('DeleteMessage', $_POST)) { $this->DeleteMessage($_POST['DeleteMessage']); } 
elseif (array_key_exists('UploadMaterial', $_POST)) { $this->UploadMaterial(); } 
elseif (array_key_exists('UploadNewsImage', $_POST)) { $this->UploadNewsImage();  } 
elseif (array_key_exists('UpdateNews', $_POST)) { $this->UpdateNews(); }
elseif (array_key_exists('RequestWithdraw', $_POST)) { $this->RequestWithdraw();} 
elseif (array_key_exists('YesInvest', $_POST)) { $this->YesInvest();} 
elseif (array_key_exists('FundTransfer', $_POST)) { $this->FundTransfer();} 
elseif (array_key_exists('InitiateBankTransfer', $_POST)) { $this->InitiateBankTransfer();} 
elseif (array_key_exists('FundTransferMob', $_POST)) { $this->FundTransferMob();} 
elseif (array_key_exists('ApproveWithdrawal', $_POST)) { $this->ApproveWithdrawal();} //
elseif (array_key_exists('FundWallet', $_POST)) { $this->FundWallet();} 
elseif (array_key_exists('RequestTransfer', $_POST)) { $this->RequestTransfer();}
elseif(array_key_exists('AdminFundWalletIni', $_POST)){ $this->AdminFundWalletIni(); }
elseif(array_key_exists('AdminDeductWalletIni', $_POST)){ $this->AdminDeductWalletIni(); }
elseif(array_key_exists('ProcWaFund', $_POST)){ $this->ProcWaFund(); }
elseif(array_key_exists('ProcWithdraw', $_POST)){ $this->ProcWithdraw(); }
if(array_key_exists('ProcFundOrder', $_POST)){ $this->ProcFundOrder(); }
if(array_key_exists('FundWalletOrder', $_POST)){ $this->FundWalletOrder(); }
       
elseif (array_key_exists('ForgertPassword', $_POST)) { $this->ForgertPassword();}
elseif (array_key_exists('ApproveWithdraw', $_POST)) { $this->ApproveWithdraw();}
elseif (array_key_exists('ReturnWithdraw', $_POST)) { $this->ReturnWithdraw();}
elseif (array_key_exists('RequestIncentive1', $_POST)) { $this->RequestIncentive1();}
elseif (array_key_exists('ApproveIncentive1', $_POST)) { $this->ApproveIncentive1();}
elseif (array_key_exists('AddNewPackage', $_POST)) { $this->AddNewPackage();}
elseif (array_key_exists('AddNewOffer', $_POST)) { $this->AddNewOffer();}
elseif (array_key_exists('AddPackDetails', $_POST)) { $this->AddPackDetails();}
// elseif (array_key_exists('PickMembership', $_POST)) { $this->UpgradeMembership();}
elseif (array_key_exists('UpgradeMembership', $_POST)) { $this->UpgradeMembership();}
elseif (array_key_exists('UpgradeTeamMembership', $_POST)) { $this->UpgradeTeamMembership();}
elseif(array_key_exists('SendMail', $_POST)){ $this->SendMail(); }  
elseif(array_key_exists('SendMail2', $_POST)){ $this->SendMail2(); }  
      
elseif (array_key_exists('DownloadMaterial', $_POST)){ $this->DownloadMaterial($_POST['DownloadMaterial']); }
elseif (array_key_exists('DeleteMaterial', $_POST)) {$this->DeleteMaterial($_POST['DeleteMaterial']); }
elseif (array_key_exists('DeleteNews', $_POST)) { $this->DeleteNews($_POST['DeleteNews']); }  
elseif (array_key_exists('transferOrder', $_POST)) {  $this->transferOrder(); }
elseif (array_key_exists('buyEpins', $_POST)) {  $this->buyEpins(); }
elseif (array_key_exists('CalculateRoi', $_POST)) { $_SESSION['invamount']=$_POST['amount']; } 
elseif (array_key_exists('AddService', $_POST)) { $this->AddService(); } 
elseif (array_key_exists('ModifyMallItem', $_POST)) { $this->ModifyMallItem(); } 
elseif (array_key_exists('ModifyEvent', $_POST)) { $this->ModifyEvent(); }
elseif (array_key_exists('ModifyMallItemPhoto', $_POST)) {  $this->ModifyMallItemPhoto(); } 
elseif (array_key_exists('ModifyItemPosition', $_POST)) { $this->ModifyItemPosition();  } 
elseif (array_key_exists('DeleteMallItem', $_POST)) { $this->DeleteMallItem(); } 
elseif (array_key_exists('GenerateUserPin', $_POST)) { $this->GenerateUserPin(); } 
elseif (array_key_exists('SupportTicket', $_POST)) { $this->SupportTicket();}
elseif (array_key_exists('SupportTicket2', $_POST)) {$this->SupportTicket2(); } 
elseif (array_key_exists('AddCategory', $_POST)) { $this->AddCategory(); }
elseif (array_key_exists('AddEvent', $_POST)) { $this->AddEvent(); }
elseif (array_key_exists('AddEbook', $_POST)) { $this->AddEbook(); } 
elseif (array_key_exists('ModifyCategory', $_POST)) { $this->ModifyCategory();  } 
elseif (array_key_exists('ModifyEbook', $_POST)) { $this->ModifyEbook();  } 
elseif (array_key_exists('sendMessage', $_POST)) { $this->sendMessage();  } 
elseif (array_key_exists('sendMessageToAll', $_POST)) { $this->sendMessageToAll(); } 
elseif (array_key_exists('createPin', $_POST)) {   $this->createPin();  } 
elseif (array_key_exists('stg', $_POST)) { $_SESSION['stg'] = $_POST['stg']; } 
elseif (array_key_exists('resetChart', $_POST)) { $this->resetChart(); } 
elseif (array_key_exists('showAwardee', $_POST)) { $this->showAwardee(); } 
elseif (array_key_exists('ApproveAward', $_POST)) {$this->ApproveAward(); } 


elseif (array_key_exists('BuyAirtime', $_POST)) {$this->BuyAirtime(); } 
elseif (array_key_exists('BuyData', $_POST)) {$this->BuyData(); }  
elseif (array_key_exists('BuyElectric', $_POST)) {$this->BuyElectric(); } 
elseif (array_key_exists('BuyCable', $_POST)) {$this->BuyCable(); } 


elseif (array_key_exists('approveIncentiveOrder', $_POST)) { $this->approveIncentiveOrder();} 
elseif (array_key_exists('SearchDownline', $_POST)) { $this->SearchDownline(); } 
elseif (array_key_exists('SendUserMessage', $_POST)) { $this->SendUserMessage(); } 
elseif (array_key_exists('DeactivateUser', $_POST)) { $this->DeactivateUser(); } 
elseif (array_key_exists('UpdatePin', $_POST)) { $this->UpdatePin(); } 
elseif (array_key_exists('CourseUpload', $_POST)) { $this->CourseUpload(); }
elseif (array_key_exists('AddNewAdvert', $_POST)) { $this->AddNewAdvert(); }
elseif (array_key_exists('EditDailyAdvert', $_POST)) { $this->EditDailyAdvert(); } 
elseif (array_key_exists('processPin', $_POST)) {  $_SESSION['processPin'] = $_POST['processPin'];  } 
elseif (array_key_exists('replyMsg', $_POST)) { $this->replyMsg(); } 
elseif (array_key_exists('verifyUser', $_POST)) { $this->verifyUser();   } 
elseif (array_key_exists('updateAward', $_POST)) {  $this->updateAward();  } 
elseif (array_key_exists('UpdateBank', $_POST)) { $this->updateBankAcc(); } 
elseif (array_key_exists('requestEpins', $_POST)) { $this->requestEpins(); } 
elseif (array_key_exists('approvePinRequest', $_POST)) {  $this->approvePinRequest(); } 
elseif (array_key_exists('deletePinRequest', $_POST)) {  $this->deletePinRequest();   } 
elseif (array_key_exists('requestIncentive', $_POST)) { $this->requestIncentive();   } 
elseif (array_key_exists('RestorePin', $_POST)) {  $this->RestorePin();    } 
elseif (array_key_exists('userid', $_POST)) { $this->userid(); } 
elseif (array_key_exists('UpdateUserSponsor', $_POST)) { $this->UpdateRegister(); } 
elseif (array_key_exists('suggestionBox', $_POST)) { $this->suggestionBox(); } 
elseif (array_key_exists('support', $_POST)) { $this->support(); } 
elseif (array_key_exists('staffRole', $_POST)) { $this->staffRole(); } 
elseif (array_key_exists('addStaff', $_POST)) { $this->addStaff(); } 
elseif (array_key_exists('selectWorker', $_POST)) { $this->selectWorker(); } 
elseif (array_key_exists('VerifyResend', $_POST)) { $this->VerifyResend(); } 
elseif (array_key_exists('ServicePortal', $_POST)) { $this->ServicePortal(); } 
elseif (array_key_exists('contact', $_POST)) { $this->contact(); } 
elseif (array_key_exists('plan', $_POST)) { $this->plan(); } 
elseif (array_key_exists('submitpro', $_POST)) { $this->submitpro(); } 
elseif (array_key_exists('updatemyassesment', $_POST)) { $this->editassement(); } 
elseif (array_key_exists('ActivateWhatsapp', $_POST)) { $this->ActivateWhatsapp(); } 
elseif (array_key_exists('WithdrawBonus', $_POST)) { $this->WithdrawBonus(); }  
elseif (array_key_exists('NewAddCategory', $_POST)) { $this->NewAddCategory(); }  
elseif (array_key_exists('UpdateLevel2', $_POST)) { $this->UpdateLevel2(); }  
elseif (array_key_exists('LockFunds', $_POST)) { $this->LockFunds(); } 
elseif (array_key_exists('ReverseTransaction', $_POST)) { $this->ReverseTransaction(); } 



elseif (isset($_GET['tr_referenca'])) { $this->confirmPinPayment(); } 
elseif (isset($_GET['verify'])) { $this->verifyEmail(); } 
elseif (isset($_GET['payment-confirmed']) AND isset($_SESSION['report'])) { $report = $_SESSION['report'];  } 
elseif (isset($_GET['action'])) { if ($_GET['action']=='logout'){session_destroy(); header('location: .');     }   }

        return;
    }

function ReverseTransaction(){
    global $report;
    file('https://livepetal.com/appp/notifystatus.php');
    $report = 'Operation Successful';
    return;
}

function AddPlanReport(){
    global $db,$report,$count;
$uid = $this->Uid();
$ymd = date('ymd');
$day = date('D');
$ctime = time();
$note = $_POST['plannote'];
$new = sqL2('projectreport','pid',$uid,'ymd',$ymd);
if($new==0){$db->query("INSERT INTO projectreport (pid,ymd,ptime,day,plan) VALUES ('$uid','$ymd','$ctime','$day','$note')"); $report='Plan submited successfully'; }
elseif($new==1 AND date('H')>10){$db->query("UPDATE projectreport SET report='$note', rtime='$ctime' WHERE pid='$uid' AND ymd='$ymd' "); 
$report='Report updated successfully'; }

return; 
}

function UpdateLevel2(){
    global $db,$report,$count;
    $address = ucwords(strtolower(addslashes(sanitize($_POST['address']))));
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = ucwords(strtolower(addslashes(sanitize($_POST['city']))));
    $dd = $_POST['dd'];
    $mm = $_POST['mm'];
    $yy = $_POST['yy'];
    $uid = $this->Uid();

    $sql = $db->query("UPDATE user SET address='$address',country='$country',state='$state',city='$city',dd='$dd',mm='$mm',yy='$yy', status=2 WHERE id='$uid' ");
if($sql){  $report = 'Successfully Updated Account Information';
}else{
    $report = 'You have entered an invalid number'; $count=1;
}
     
return;
}


function LockFunds(){
    global $db,$report,$count;

    $amount = $_POST['amount'];
    $tenure = $_POST['tenure'];
    $name = $_POST['name'];
    $uid = $this->Uid();

    $rate = $tenure==12 ? 25 : 20 ;
    $interest = $tenure==12 ? 0.25*$amount : 0.1*$amount ;
    $start = time();
    $stop = $tenure==12 ? $start+86400*365 : $start+86400*182;
    $ref = win_hash(12);
     $bal = $this->wallet($uid);

if($bal<$amount){
  $report = 'You have insufficient account balance to complete this transaction. Fund your wallet and try again';
  $count=1;  
}else{
    $this->walletProcess($uid,$amount,5,4,'Investment Deposit',$ref);
$sql = $db->query("INSERT INTO invacc (id,ref,amount,interest,name,rate,tenure,start,stop,rep) VALUES ('$uid','$ref','$amount','$interest','$name','$rate','$tenure','$start','$stop','$uid') ");
if($sql){  $report = 'Transaction Successfully Completed. Your Prime Vault Account is now active';
}else{
    $report = 'Operation failed. Try again'; $count=1;
}
 }    
return;
}

function updateNok($name,$address,$phone,$email,$rel){
    global $db,$report;
    $uid = $this->Uid();
    if(sqL1('nok','id',$uid)==0){$db->query("INSERT INTO nok(id,name,rel,phone,email,address) VALUES('$uid','$name','$rel','$phone','$email','$address')"); }
        else{
$db->query("UPDATE nok SET id='$uid',name='$name',rel='$rel',phone='$phone',email='$email',address='$address' WHERE id='$uid' ");
        }
      return 'Next-of-Kin information successfully updated';
}

function ActivateWhatsapp(){
    global $db,$report,$count;
    $wa = isset($_POST['whatsapp']) ? trim($_POST['whatsapp']) : $_POST['ActivateWhatsapp'];
    $wa = str_replace(' ', '', $wa);
    $uid = isset($_POST['whatsapp']) ? $this->Uid() : $_SESSION['SearchClient'];

    if(substr($wa, 0,1)=='+'){ $wa = substr($wa, 1,13); }
    if(substr($wa, 0,1)=='0'){ $wa = '234'.substr($wa, 1,10); }
if(strlen($wa)>10){
    $db->query("UPDATE user SET whatsapp='$wa', activewa=1 WHERE id='$uid' ");
        $phone = userName($uid,'whatsapp');
        $msg = '*Welcome '.userName($uid).'!* Thank you for registering with livepetal.com. I am your Livepetal Personal Assistant. I will provide answers to all questions you may have regarding Livepetal. Make sure you save this number on your phone. 
        Livepetal is designed to help you earn daily income to build sustainable cashflow.';

             $msg .= $this->isActive($uid)==TRUE ? ' Your referral link is: https://livepetal.com/home/s/G'.userName($uid,'sn').'. Share it generously and watch out for incredible results' :'';
        
        if(userName($uid,'activewa')==1){sendWhatsapp($phone, $msg);  }

$_SESSION['report'] = 'Whatsapp Personal Assistant Successfully Activated';
if(isset($_POST['whatsapp'])){ header('location: membership.php');}else{ }
}else{
    $report = 'You have entered an invalid number'; $count=1;
}
     
return;
}

function ActivateWhatsappUser($uid){
    global $db,$report,$count;
    $wa = trim(userName($uid,'phone'));
    $wa = str_replace(' ', '', $wa);
   

    if(substr($wa, 0,1)=='+'){ $wa = substr($wa, 1,13); }
    elseif(substr($wa, 0,1)=='0'){ $wa = '234'.substr($wa, 1,10); }
    else{ $wa = '234'.substr($wa, 1,10); }

    $db->query("UPDATE user SET whatsapp='$wa', activewa=1 WHERE id='$uid' ");
        $phone = userName($uid,'whatsapp');
        $msg = '*Welcome '.userName($uid).'!* I am your Livepetal Personal Assistant. I will be sending you personalized transaction alerts and offering you all the support you need to succeed in your Livepetal Business. 
        Feel free to ask any question about Livepetal. I will answer all your questions as soon as possible. Make sure you save this number on your phone. 
        Livepetal is designed to help you earn daily income to build sustainable cashflow. Your overall earning potential is determined by two things: 1. Your activated membership plans and 2. Your active participation in promoting the business and building vibrant teams. I have been mandated to take you through a process that will ensure that you build capacity and achieve worthwhile success in this business within a very short time.';

        $msg2 = 'I really appreciate your interest in livepetal. I certainly want you to get the best out of this life transforming system. We are about to create a massive Technology Revolution accross africa and I actually want you to be a part of this movement so that you can create a niche for yourself, build solid financial capacity and generate constant cashflow for financial freedom. Login to your account at livepetal.com to activate your membership and secure your position to start earning immediately. If you have any question, simply ask me';
        
        if(userName($uid,'activewa')==1){sendWhatsapp($phone, $msg); sendWhatsapp($phone, $msg2); }

$report = 'Whatsapp Personal Assistant Successfully Activated';
     
return;
}

function testChatSend(){
    $data = [
    'phone' => '2348032318588', // Receivers phone
    'body' => 'Dearly beloved, Our YHSF  tomorrow will be a time of prayers for specific needs of our youths.We should also pray for the leadership of the church and our country!', // Message
];
$json = json_encode($data); // Encode data to JSON
// URL for request POST /message
$token = 'fw9ww74keh0pl7fc';
$instanceId = '174200';
//$url = 'https://api.chat-api.com/instance'.$instanceId.'/message?token='.$token;
$url = 'https://eu172.chat-api.com/instance174200/message?token='.$token;
// Make a POST request
$options = stream_context_create(['http' => [
        'method'  => 'POST',
        'header'  => 'Content-type: application/json',
        'content' => $json
    ]
]);
// Send a request
$result = file_get_contents($url, false, $options);
return;
}

function ActivateWhatsappUserAll(){
    global $db;
    $sql = $db->query("SELECT * FROM user WHERE sn>20044 AND activewa=0 ORDER BY sn DESC LIMIT 60 ");
    while ($row=mysqli_fetch_assoc($sql)) {
      if($this->isActive($row['id'])==TRUE){  $this->ActivateWhatsappUser($row['id']); }
    }
}
//send messages
function sendDailyMessages(){
    global $db;
    $ymd = date('ymd');
    $sql = $db->query("SELECT * FROM user WHERE sn>20044 AND ymd<'$ymd' LIMIT 40 ");
    while ($row=mysqli_fetch_assoc($sql)) {
    if($this->isActive($row['id'])==TRUE){  $this->ActivateWhatsappUser($row['id']); /*send user messages*/ }
    }
return;
}


function WithdrawBonus(){
   global $db, $report,$count;
   $uid=$this->Uid();
   $type=$_POST['type'];   
   $report ='Request successfully processed'; 
   $amt=0;
   if($type==1){
    if($this->walletPending($uid,26,26)>0){$amt=$this->walletPending($uid,26,26);
$db->query("UPDATE ewalletx SET status=5 WHERE id='$uid' AND type=26 ");
}else{$report='You currently do not have enough fund in this bonus account'; $count=1;}
    }
   elseif($type==2){
    if($this->walletPending($uid,21,25)>0){ $amt=$this->walletPending($uid,21,25);
$db->query("UPDATE ewalletx SET status=5 WHERE id='$uid' AND type BETWEEN 21 AND 25 ");
}else{$report='You currently do not have enough fund in this bonus account'; $count=1; }
    }
   elseif($type==3){
     if($this->walletPending($uid,21,25)>0){ $amt=$this->walletPending($uid,21,25);
$db->query("UPDATE ewalletx SET status=5 WHERE id='$uid' AND type=28 ");
}else{$report='You currently do not have enough fund in this bonus account'; $count=1; }
    }
    elseif($type==4){
    if($this->walletPending($uid,81,90)>0){ $amt=$this->walletPending($uid,81,90);
$db->query("UPDATE ewalletx SET status=5 WHERE id='$uid' AND type BETWEEN 81 AND 90 ");
}else{$report='You currently do not have enough fund in this bonus account'; $count=1; }
    }
    elseif($type==5){
    if($this->walletPending($uid,91,100)>0){ $amt=$this->walletPending($uid,91,100);
$db->query("UPDATE ewalletx SET status=5 WHERE id='$uid' AND type BETWEEN 91 AND 100 ");
}else{$report='You currently do not have enough fund in this bonus account'; $count=1; }
    }

    if($amt>0){
         $msg=  'You have successfully withdrawn '.NAIRA.number_format($amt,2); 
        $msg .= ' from your bonus to your wallet. Balance: '.NAIRA.number_format($this->wallet($uid),2);
       // $phone = userName($uid,'whatsapp');

        //$title = 'SPV Bonus Withdrawal';
         $this->addNotice($uid,'Bonus Withdrawal',$msg); //Add notification
        //if(userName($uid,'activewa')==1){sendWhatsapp($phone, $msg); }
    }
   
return;
}


    function SearchClient(){
    global $db,$report,$count;
    if(isset($_POST['SearchClient']) || isset($_POST['client'])){
    $Client = isset($_POST['client']) ? $_POST['client'] : $_POST['SearchClient'];
}
    elseif(isset($_GET['SearchClient'])){$Client = $_GET['SearchClient']; }
    $userKey=$this->userToId($Client);
    if($userKey==$this->Uid()){
    $report = 'You cannot validate yourself, please try again'; $count=1;
    }
    elseif(empty($userKey)){
        $report = 'Client not found, please try again'; $count=1;
        if(isset($_SESSION['SearchClient'])){ unset($_SESSION['SearchClient']); }
    }else{
        $_SESSION['SearchClient'] = $userKey;
        $report='Client successfully verified';
    }
return;   
}  

function ActivateRef(){
    global $db,$report,$count;
    $Client = $_POST['ActivateRef'];
    $_SESSION['ActivateRef']=$this->refToId($Client);
    

 //header('location: activatereferral.php');

return;   
}



function VerifyResend(){
global $report;
 $this->emailer($_POST['VerifyResend']);
$report = 'Your E-mail verification link has been sent to '.$_POST['VerifyResend'];
}

 function SearchUpline(){
    global $db,$report,$count;
    $Client = $_POST['client'];
    $userKey=$this->userToKey($Client);
    if($userKey==$this->Uid()){
    $report = 'You cannot validate yourself, please try again'; $count=1;
    }
    elseif(empty($userKey)){
        $report = 'Client not found, please try again'; $count=1;
        if(isset($_SESSION['SearchUpline'])){ unset($_SESSION['SearchUpline']); }
    }  
    elseif($this->userToKey($Client,'active')>2){
        $report = 'Client not eligible, try another'; $count=1;
       
    }else{
        $_SESSION['SearchUpline'] = $userKey;
        $report='Upline successfully verified';
    }

return;   
}



    function FindBeneficiary()
    {
        global $db, $report, $count,$userKey;

        $bene = sanitize(strtolower($_POST['bene']));
       if($this->userToId($_POST['bene']) == $userKey){
            $report = 'You cannot transfer funds to yourself. Please find a Beneficiary';
            $count = 1;} 
            elseif ($this->validateUser($bene) == TRUE) {
            $report = 'Beneficiary successfully verified';

        } else {
            $report = 'You have entered an invalid Beneficiary username. Please Try Again';
            $count = 1;
        }

        return;
    }



    function EditProfile()
    {
        global $db, $report, $count;

        $id = $_POST['id'];
        $surname = sanitize($_POST['surname']);
        $othername = sanitize($_POST['othername']);
        $email = sanitize($_POST['email']);
        $address = sanitize($_POST['address']);
        $phone = sanitize($_POST['phone']);
        $sex = sanitize($_POST['sex']);
        $dob = sanitize($_POST['dob']);
        //$officeaddress = sanitize($_POST['officeaddress']);
        $country = sanitize($_POST['country']);
        //$state = sanitize($_POST['state']);
       
        $sql = $db->query("UPDATE user SET surname='$surname', othername='$othername', email='$email', address='$address', phone='$phone',
            sex='$sex', dob='$dob', country='$country' WHERE id='$id'");
        if ($sql) {
            $report = "Updated Successfully";
        } else {
            $count = 1;
            $report = "Error Updating Profile";
        }

    }

function FundWalletIni(){

$_SESSION['amount'] = $_POST['amount'];
$_SESSION['paytype'] = $_POST['paytype'];
if($_SESSION['paytype']==1){
header("location: fundwalletpay.php");
}
elseif($_SESSION['paytype']==2){
header("location: paytobank.php");  
}
return;
    }



    function UploadPicture()
    {
        global $db, $report, $count;

        $report = '';
        $id = $_POST['id'];
        $surname = $_POST['surname'];
        $image_name = $_FILES['photo']['name'];
        $image_loc = $_FILES['photo']['tmp_name'];
        $image_type = $_FILES['photo']['type'];
        $image_size = $_FILES['photo']['size'];

        $ext = explode('.', $image_name);
        $end = strtolower(end($ext));
        if (checkExtension($end)) {
            if (checkSize($image_size)) {
                $new_name = $surname . time() . '.' . $end;
                $sql = $db->query("UPDATE user SET photo = '$new_name' WHERE id='$id'");
                move_uploaded_file($image_loc, 'photo/' . $new_name);
                $report .= 'Photo Successfully Uploaded';

            } else {
                $count = 1;
                $report .= 'Image Size Must Not Be More than 1MB';
            }
        } else {
            $count = 1;
            $report .= 'Image Must Be In Jpg,Jpeg, or Png Format only';
        }
    }



    function SelectItem(){
        $_SESSION['item']=$_POST['item'];
    }

    function wildSponsored($key)
    {
        global $db, $user;
        $qu = $db->query("SELECT * FROM matuser WHERE b1 = '$key' ") or die(mysqli_error());
        $nu = mysqli_num_rows($qu);
        return $nu;
    }


    function validateUser($username, $info = '')
    {
        global $db, $report, $count;
//$sql=$db->query("SELECT * FROM user WHERE user = '$username' OR email = '$username' " )or die(mysqli_error()); 
        $sql = $db->query("SELECT * FROM user WHERE user = '$username' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        $row = mysqli_fetch_assoc($sql);
        if ($num == 0) {
            $res = FALSE;
        } else {
            $res = TRUE;
        }
        if ($info == 1) {
            $res = $row['surname'] . ' ' . $row['othername'];
        }
        if ($info == 2) {
            $res = $row['sn'];
        }
        return $res;
    }


    function signupUserIni()
    {
        global $db,$report,$count;
       
        $ctime =time();
    
       $firstname = ucwords(strtolower($this->valEmpty($_POST['firstname'], 'Firstname')));
       $lastname = ucwords(strtolower($this->valEmpty($_POST['lastname'], 'Lastname')));
        $phone = $this->valPhone($_POST['phone']);
        $email = strtolower($this->valEmpty(sanitize($_POST['email']), 'E-mail'));

 
        $password  = $this->valPass($_POST['password']);
        $password2 = $_POST['password2'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $state = $_POST['state']=='Abuja Federal Capital Territory' ? 'Abuja' : $_POST['state'];
        $stateuser = strtolower(str_replace(' ', '', $state));
        $statekey = $country=='169' ? sqLx('user','user',$stateuser,'sn') : 20001;
        $user = explode('@', $email);
        $username=$user[0];
        $city = sanitize($_POST['city']);
         $sex = $_POST['sex'];
        $address = sanitize(addslashes($_POST['address']));
        
        if ($password != $password2) {
            $report .= "Password Mismatch";
            $count = 1;
        } elseif ($this->emailExist($email) == TRUE) {
            $report .= "A user with this Email already exist. Try another.";
            $count = 1;
        } elseif (!isset($count)) {

            $id = $this->win_hashs(12);
            $lsk = $this->win_hashs(32);//

            $ref = isset($_COOKIE['ref']) ? $_COOKIE['ref'] : $statekey;

            if(isset($_POST['ref'])){$rid = $this->refToId($_POST['ref']); $ref=$this->matExist($rid) ? $_POST['ref'] : $ref; }
            $media = $_COOKIE['media'];
            $pack = sqLx('packs','sn',1,'ref');

            $pwd = password_hash($password, PASSWORD_BCRYPT);
            $sql = $db->query("INSERT INTO user (id,ref,media,lsk,firstname,lastname,phone,email,sex,country,state,city,address,pass,user,ctime,pack)
VALUES('$id','$ref','$media','$lsk','$firstname','$lastname','$phone','$email','$sex','$country','$state','$city','$address','$pwd','$username','$ctime','$pack')") or die('Cannot Connect to Server');
            $report = "<br>User account successfully created.";
                
              

            if ($this->emailExist($email) == TRUE) {$_SESSION['signup'] = 2; $_SESSION['user_idx'] = $id; 
           $this->emailer($email); 
             $this->activationUplineEmail($id);
         // if(!empty($_POST['whatsapp'])){ $this->ActivateWhatsapp(); }
          if($_SERVER['REQUEST_URI']=='/requestquotation'){}else{ header('location: personalassistant.php'); }

             }
            else{$report = 'Signup not successful, try again'; $count=1;}
         
        }
        return;
    }




    function signupUserMob()
    {
        global $db,$report,$count;
       
        $ctime =time();
    
       $firstname = ucwords(strtolower($this->valEmpty($_POST['firstname'], 'Firstname')));
       $lastname = ucwords(strtolower($this->valEmpty($_POST['lastname'], 'Lastname')));
        $phone = $this->valPhone($_POST['phone']);
        $email = strtolower($this->valEmpty(sanitize($_POST['email']), 'E-mail'));

 
        $password  = $this->valPass($_POST['password']);
        $password2 = $_POST['password2'];
        $gender = $_POST['gender'];
        $country = '';//$_POST['country'];
        $state = '';//$_POST['state']=='Abuja Federal Capital Territory' ? 'Abuja' : $_POST['state'];
        //$stateuser = strtolower(str_replace(' ', '', $state));
       // $statekey = 20001;//$country=='169' ? sqLx('user','user',$stateuser,'sn') : 20001;
        $user = explode('@', $email);
        $username=$user[0];
        $city = '';//sanitize($_POST['city']);
         $sex = $_POST['sex'];
        $address = '';//sanitize(addslashes($_POST['address']));
        
        if ($password != $password2) {
            $report .= "Password Mismatch";
            $count = 1;
        } elseif ($this->emailExist($email) == TRUE) {
            $report .= "A user with this Email already exist. Try another.";
            $count = 1;
        } elseif (!isset($count)) {

            $id = $this->win_hashs(12);
            $lsk = $this->win_hashs(32);//

            $ref = sanitize($_POST['ref']);
           $rid = $this->refToId($_POST['ref']); 
           $ref=$this->matExist($rid) ? $ref : 20001; 

            $media = 'M';
            $pack = sqLx('packs','sn',1,'ref');

            $pwd = password_hash($password, PASSWORD_BCRYPT);
            $sql = $db->query("INSERT INTO user (id,ref,media,lsk,firstname,lastname,phone,email,sex,country,state,city,address,pass,user,ctime,pack)
VALUES('$id','$ref','$media','$lsk','$firstname','$lastname','$phone','$email','$sex','$country','$state','$city','$address','$pwd','$username','$ctime','$pack')") or die('Cannot Connect to Server');
            $report = "User account successfully created.";
                
              

            if ($this->emailExist($email) == TRUE) {
              $_SESSION['user_idx'] = $id; 
           $this->emailer($email); 
             $this->activationUplineEmail($id);
        header('location: index.php'); 
             }
            else{$report = 'Signup not successful, try again'; $count=1;}
             }
        return;
    }




    function valEmpty($field, $fname)
    {
        global $report, $count;
        $field = sanitize(trim($field));
        if ($field == '') {
            $report .= "<br>" . $fname . " field is required! ";
            $count = 1;
            return;
        } elseif (strlen($field) < 3) {
            $report .= "<br>" . $fname . " entered is too short! ";
            $count = 1;
            return;
        } else {
            return $field;
        }
    }

    function valPhone($field)
    {
        global $report, $count;
        $report='';
        $field = sanitize(trim($field));
        if ($field == '') {
            $report .= "<br>Phone Number field is required! ";
            $count = 1;
            return;
        } elseif (strlen($field) < 11) {
            $report .= "<br>Phone Number entered is invalid! ";
            $count = 1;
            return;
        } else {
            return $field;
        }
    }

    function valPass($field)
    {
        global $report, $count;
        if ($field == '') {
            $report .= "<br>Password field is required! ";
            $count = 1;
            return;
        } elseif (strlen($field) < 6) {
            $report .= "<br>Password cannot be less than 6 characters! ";
            $count = 1;
            return;
        } else {
            return sanitize($field);
        }
    }


    function pinValidity($pin)
    {
        global $db, $report, $count;
        $sql = $db->query("SELECT * FROM pin WHERE pin = '$pin' ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        $num = mysqli_num_rows($sql);
        if ($num == 0) {
            $report = 'You have entered an invalid E-PIN, verify your E-PIN and try again';
            $count = 1;
            $valid = FALSE;
        } elseif ($num == 1 AND $row['status'] == 0) {
            $valid = TRUE;
        } else {
            $valid = FALSE;
            $report = 'This E-PIN has already been used by: ' . $this->userName2($row['id']) . ' as at ' . $row['created'];
            $count = 1;
        }
        return $valid;
    }



    function profileSetup(){
        $id = $this->Uid();
$p = sqL2('user2','id',$id,'status',1);
return 20 + $p*20;
    }

    function profileSetup2($type){
        $id = $this->Uid();
$p = sqL3('user2','id',$id,'status',1,'type',$type);
return $p;
    }
    




    function verifySpUp($sponsorkey,$upline){
        global $db;
        $num=0;
         $que = $db->query("SELECT * FROM user WHERE sn = '$sponsorkey' ") or die(mysqli_error());
         $num += mysqli_num_rows($que);
         $que2 = $db->query("SELECT * FROM user WHERE sn = '$upline' ") or die(mysqli_error());
         $num += mysqli_num_rows($que2);

return $num;
    }


    function serviceName($sn,$col='title')
    {
        global $db;
        $que = $db->query("SELECT * FROM product2 WHERE sn = '$sn' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }


    function userName2($user)
    {
        global $db;
        $que = $db->query("SELECT * FROM user WHERE user = '$user' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro['surname'] . ' ' . $ro['othername'];
    }

    function msgStatus($sn,$col='active')
    {
        global $db;
        $que = $db->query("SELECT * FROM msg WHERE sn = '$sn' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }

    function userName4($col = '')
    {
        global $db, $userKey;

        $que = $db->query("SELECT * FROM user WHERE id = '$userKey' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        if (!empty($col)) {
            return $ro[$col];
        } else {
            return htmlspecialchars($ro['surname'] . ' ' . $ro['othername']);
        }
    }

    function userNamex($id,$col = '')
    {
        global $db;

        $que = $db->query("SELECT * FROM user WHERE id = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        if (!empty($col)) {
            return $ro[$col];
        } else {
            return htmlspecialchars($ro['firstname'] . ' ' . $ro['lastname']);
        }
    }    

    function userNamex2($id,$col)
    {
        global $db;

        $que = $db->query("SELECT * FROM matuser WHERE id = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
      
            return $ro[$col];
       
    }


    function userName3($user, $col = 'id')
    {
        global $db;
        $que = $db->query("SELECT * FROM user WHERE user = '$user' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }

    function userToId($user, $col='id')
    {
        global $db;
        $que = $db->query("SELECT * FROM user WHERE email = '$user' OR sn = '$user' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }

    function userToKey($user, $col = 'sn')
    {
        global $db;
        $que = $db->query("SELECT * FROM matuser WHERE user = '$user' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }

    function idToKey($id, $col = 'sn')
    {
        global $db;
        $que = $db->query("SELECT * FROM matuser WHERE id = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }
    function idToUser($id, $col = 'user')
    {
        global $db;
        $que = $db->query("SELECT * FROM user WHERE id = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }

    function invoiceName($ref, $col = 'amount')
    {
        global $db;
        $que = $db->query("SELECT * FROM invoice WHERE ref = '$ref' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }

    function refToId($ref, $col = 'id')
    {
        global $db;
        $que = $db->query("SELECT * FROM user WHERE sn = '$ref' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }    

    function lskToId($lsk, $col = 'id')
    {
        global $db;
        $que = $db->query("SELECT * FROM user WHERE lsk = '$lsk' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }    

    // function userTeam($uidx)
    // {
    //     global $db;
    //     $que = $db->query("SELECT * FROM matuser WHERE b1 = '$uidx' OR b2 = '$uidx' OR b3 = '$uidx' ") or die(mysqli_error());
    //     $num = $uidx>0 ? mysqli_num_rows($que) : 0;
    //     return $num;
    // }


    function stageToTitle($st)
    {
        $t='';
      if($st==1){$t='Team Player'; }
      elseif($st==2){$t='Team Leader'; }
      elseif($st==3){$t='District Manager'; }
      elseif($st==4){$t='Senior Manager'; }
      elseif($st==5){$t='Regional Director'; }
      elseif($st==6){$t='Regional Vice President'; }
      elseif($st==7){$t='Senior Vice President'; }
      return $t;
    }


    function keyToLevel($sn, $col='level')
    {
        global $db;
        $que = $db->query("SELECT * FROM matuser WHERE sn = '$sn' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }

    function keyToId($sn, $col = 'id')
    {
        global $db;
        $que = $db->query("SELECT * FROM matuser WHERE sn = '$sn' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }


    function skeyToId($ssn, $col = 'id')
    {
        global $db;
        $que = $db->query("SELECT * FROM matuser WHERE sha1(sn) = '$ssn' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }

    function findUser($user)
    {
        global $db;
        $sql = $db->query("select * FROM user WHERE sn = '$user' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        if ($num == 0) {
            $res = FALSE;
        } else {
            $res = TRUE;
        }
        return $res;
    }

    function userExist($username)
    {
        global $db, $report, $count;
//$sql=$db->query("SELECT * FROM user WHERE user = '$username' OR email = '$email' " )or die(mysqli_error()); 
        $sql = $db->query("SELECT * FROM user WHERE user = '$username' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        if ($num == 0) {
            $res = FALSE;
        } else {
            $res = TRUE;
        }
        return $res;
    }

    function emailExist($email)
    {
        global $db, $report, $count;
        $sql = $db->query("SELECT * FROM user WHERE email = '$email' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        if ($num == 0) {
            $res = FALSE;
         } else {
            $res = TRUE;
        }
        return $res;
    }

     function userExist2($id)
    {
        global $db, $report, $count;
        $sql = $db->query("SELECT * FROM user WHERE id = '$id' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        if ($num == 1) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }

        function matExist($id)
    {
        global $db;

        $sql = $db->query("SELECT * FROM matuser WHERE id = '$id' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        if ($num == 0) {
            $res = FALSE;
        } else {
            $res = TRUE;
        }
        return $res;
    }


    function Downline($user)
    {
        global $db;
        $sql = $db->query("SELECT * FROM user WHERE a1 = '$user' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        return $num;
    }

        function inactiveReferral($uidy)
    {
        global $db;  
        $num=0;
       $sql = $db->query("SELECT * FROM user WHERE ref='$uidy' "); 
                    while($row = mysqli_fetch_assoc($sql)) {  $id = $row['id'];             
        $num += $this->matExist($id)==FALSE ? 1 : 0; 
        } 

        return $num;
    }        

function campeign($ref,$media){
    global $db;
$sql=$db->query("SELECT * FROM agentlog WHERE ref='$ref' AND media='$media' AND type=0 ")or die(mysqli_error());   
$row = mysqli_num_rows($sql); 

return $row;

}

function Rcampeign($ref,$media){
    global $db;
$sql=$db->query("SELECT * FROM user WHERE ref='$ref' AND media='$media' ")or die(mysqli_error());   
$row = mysqli_num_rows($sql); 

return $row;

}

function Ccampeign($ref,$media){
    global $db;
    $num=0;
$sql=$db->query("SELECT * FROM user WHERE ref='$ref' AND media='$media' ")or die(mysqli_error());   
  while($row = mysqli_fetch_assoc($sql)) {  $id = $row['id'];             
        $num += $this->matExist($id)==TRUE ? 1 : 0; 
        } 

return $num;

}

    function Referral($uidx)
    {
        global $db;
        $sql = $db->query("SELECT * FROM matuser WHERE b1 = '$uidx' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        return $num;
    }

    function activeTeam($uid)
    {
        global $db;
        $uidx = $this->idToKey($uid);
        $sql = $db->query("SELECT * FROM matuser WHERE b1 = '$uidx' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        return $num;
    }

    function inactiveTeam($uid)
    {
        global $db;
        $uidy = $this->idToUser($uid,'sn');
        $sql = $db->query("SELECT * FROM user WHERE ref = '$uidy' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        return $num-$this->activeTeam($uid);
    }

    function ReferralAll()
    {
        global $db;
        $sql = $db->query("SELECT * FROM matuser ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        return $num;
    }
//

    function findUpline($key){
        global $db;

        $sql = $db->query("SELECT * FROM matuser WHERE (sn='$key' OR a1='$key' OR a2='$key' OR a3='$key' OR a4='$key' OR a5='$key' OR a6='$key' OR a7='$key' OR a8='$key' OR a9='$key' OR a10='$key') AND active < 3 ORDER BY a1 ASC, sn ASC LIMIT 1") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        return $row['sn'];
    }

function getUpline($key){
    global $db;
if(sqL1('matuser','a1',$key)<3){ return $key;}

    $i=1;
    while($i<=10){ $e=$i++;    $a = 'a'.$e;
   $sql = $db->query("SELECT * FROM matuser WHERE $a='$key' AND active<3 LIMIT 1 ");
if(mysqli_num_rows($sql)>0){$row = mysqli_fetch_assoc($sql); return $row['sn']; }
    }
   $sql = $db->query("SELECT * FROM matuser WHERE active<3 LIMIT 1 ");   
   $row = mysqli_fetch_assoc($sql); return $row['sn'];
}
  

function newAgent(){
    global $db;
    $agent = $_COOKIE['agent']??'';
$dd = date('ymd');
if(sqL1('agentlog','agent',$agent)==0 AND isset($_COOKIE['agent'])){
$browser = sqL1('agentlog','agent',$agent);
$time = time();  
$ref = $_COOKIE['ref'];
$lpk = $_COOKIE['lpk'];
$media = $_COOKIE['media'];

$db->query("INSERT INTO agentlog (agent,ref,lpk,media,time,dd,type) VALUES('$agent','$ref','$lpk','$media','$time','$dd','$type') "); 
}
return;
}


function assignSponsor($userid){
    global $db;
 $ref = userName($userid,'ref');
 $sponsorid = $this->refToId($ref);

    if($this->matExist($sponsorid)==FALSE){
   $state = userName($userid,'state');
   $state = strtolower(str_replace(' ', '', $state));
   $sql = $db->query("SELECT * FROM user WHERE user='$state' ORDER BY sn ASC LIMIT 1 ");
   $row = mysqli_fetch_assoc($sql);
   $sponsorid = $row['id'];
   if(mysqli_num_rows($sql)==0){
   $sq = $db->query("SELECT * FROM user ORDER BY sn ASC LIMIT 1 ");
   $ro = mysqli_fetch_assoc($sq);
   $sponsorid = $ro['id'];
   }
    }

    return $sponsorid;
}

    function RegisterFromWallet($userid)
    {
        global $db, $report, $count;
        $sponsorid = $this->assignSponsor($userid);

        $b1 = $this->idToKey($sponsorid);
        $b2 = $this->idToKey($sponsorid,'b1');
        $b3 = $this->idToKey($sponsorid,'b2');
        $b4 = $this->idToKey($sponsorid,'b3');
        $b5 = $this->idToKey($sponsorid,'b4');
        $b6 = $this->idToKey($sponsorid,'b5');
        $b7 = $this->idToKey($sponsorid,'b6');
        $b8 = $this->idToKey($sponsorid,'b7');
        $b9 = $this->idToKey($sponsorid,'b8');
        $b10 = $this->idToKey($sponsorid,'b9');
        $user=userName($userid,'user');
       
        $upline = $this->findUpline($b1);
        $que = $db->query("SELECT * FROM matuser WHERE sn = '$upline' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        $a1 = $ro['sn'];
        $a2 = $ro['a1'];
        $a3 = $ro['a2'];
        $a4 = $ro['a3'];
        $a5 = $ro['a4'];
        $a6 = $ro['a5'];
        $a7 = $ro['a6'];
        $a8 = $ro['a7'];
        $a9 = $ro['a8'];
        $a10 = $ro['a9'];

        $ctime = time();

        $reg = $db->query("INSERT INTO matuser (id,user,a1,a2,a3,a4,a5,a6,a7,a8,a9,b1,b2,b3,b4,b5,b6,b7,b8,b9,b10,ctime)
VALUES('$userid','$user','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$b1','$b2','$b3','$b4','$b5','$b6','$b7','$b8','$b9','$b10','$ctime')") or die('Cannot Connect to Server');

        //Update Active and Sponsors//
        $this->updateActiveAndRef($upline,$b1);
        
        //Send Email to Registered User
        $email = $this->idToUser($userid,'email');
        $this->emailer($email);
        //Promote Uplines
        $key = $this->idToKey($userid);
      //$this->stageUpdate($key); 
       
        $_SESSION['report'] = 'Account Activation successful';

         return;//
  }


function leadershipTeam($key){
  global $db;
  $level = $this->keyToLevel($key);
$sql = $db->query("SELECT * FROM matuser WHERE (a1='$key' OR a2='$key' OR a3='$key') AND level='$level' LIMIT 7 ");
  $team1 = mysqli_num_rows($sql); 
  $sql2 = $db->query("SELECT * FROM matuser WHERE  b1='$key' AND level='$level' ");
  $team2 = mysqli_num_rows($sql2);
  $team = $team1+$team2;
return $team;
}

function leadershipTeamLegs($key){
  global $db;
  $leg='';
  $level = $this->keyToLevel($key);
$sql = $db->query("SELECT * FROM matuser WHERE (a1='$key' OR a2='$key' OR a3='$key') AND level='$level' LIMIT 7 ");
  while($r1 = mysqli_fetch_assoc($sql)){$leg .= $r1['sn'].','; } 
  $sql2 = $db->query("SELECT * FROM matuser WHERE b1='$key' AND level='$level' ");
  while($r2 = mysqli_fetch_assoc($sql2)){$leg .= $r2['sn'].','; } 

return $leg;
}

function promoteUser($key){
  global $db;
  $agent = $_COOKIE['agent']??'';
  $ctime =time();
  $id = $this->keyToId($key);
  $level = $this->keyToLevel($key);
  $team = $this->leadershipTeam($key);
  $teamlegs = $this->leadershipTeamLegs($key);
  if($team>9){
$newlevel=$level+1;  $level2 = sqLx('levels','level',$newlevel,'ref');
    $db->query("UPDATE matuser SET level='$level',level2='$level2' WHERE sn='$key' ");
$db->query("INSERT INTO stagelog (id,level,level2,ctime,agent,team) VALUES('$id','$newlevel','$level2','$ctime','$agent','$teamlegs')");

//matrix bonus//
if($newlevel>2){ $this->payLeadershipBonus($id,$newlevel); } //pay leadership bonus if qualified to receive;
}
return;
}


function payLeadershipBonus($id,$newlevel){

//$remark = $this->walletRemark($type);
$type = $newlevel+80;
$bonus = $this->leadershipBonus($newlevel);// sqLx('levels','level',$newlevel,'award') ;
$remark = sqLx('levels','level',$newlevel,'title').' Leadership Bonus';

$no = sqL2('ewalletx','id',$id,'type',$type);
if($bonus>0 AND $no==0){$this->walletProcess($id,$bonus,4,$type,$remark,''); }
return;
}

function leadershipBonus($level){
      if($level==3){$bonus=10000; }
  elseif($level==4){$bonus=50000; }
  elseif($level==5){$bonus=250000; }
  elseif($level==6){$bonus=1000000; }
  elseif($level==7){$bonus=5000000; }
  elseif($level==8){$bonus=20000000; }
  else{$bonus=0; }
  return $bonus;
}


function userUplineId($id){
$ref = userName($id,'ref');
$key = sqLx('user','sn',$ref,'id');
return $ref>0 ? $key : '';
}


  function activationUplineEmail($id){
global $db;

$upid = $id;
$i=1; while($i<=4){$e=$i++; 
$upid = $this->userUplineId($upid);

if($upid != ''){
$subject = 'New Member Joined Your Livepetal Team';
$phone = userName($upid,'whatsapp');
$email = userName($upid,'email');

$m = 'Hello, '.userName($upid,'firstname').'!<br><br>
Your Team is Growing.
We are glad to inform you that a new team member was registered upon your recommendation or recommendation of your Team members.<br>
New client registration data:<br>
 
Name: '.userName($id).'<br>
Phone: '.userName($id,'phone').'<br><br>
Please contact your new team member to help him/her activate membership plans and try to answer questions that he/she may have after
acquaintance with the company. <br><br>Success in your Livepetal business is partly dependent on your ability to help your team members succeed in the business. A new member in your team has the potential to generate massive cashflow for you but it depends on the training you give them to help them achieve real success in the business.<br><br>
Congratulations and wish you good luck in your Livepetal business.<br><br>
Yours faithfully,<br>
Client Relations Department<br>
Livepetal  Systems Ltd';


$msg = 'Hello '.userName($upid,'firstname').'!
Your Team is Growing:
We are glad to inform you that a new member has joined your TEAM.
New member information:
Name: '.userName($id).',
Phone: '.userName($id,'phone').'. 
 
Please contact your new team member immediately to help him/her activate membership plans and try to answer questions that he/she may have after acquaintance with the company.
Your current direct team comprise of '.$this->activeTeam($upid).' active members and '.$this->inactiveTeam($upid).' inactive members';

 $this->emailerAll($email,$m,$subject);
 //if(userName($upid,'activewa')==1){sendWhatsapp($phone, $msg); }
 $this->addNotice($upid,'New Member Joined your Team',$msg);


}

}

return;
 }


 function sendScheduledMessages(){
    global $db;
    $ymd = date('ymd');
$sql = $db->query("SELECT * FROM user WHERE sn=20001 OR sn=20048 "); 
//$sql = $db->query("SELECT * FROM user WHERE ymd<'$ymd' AND sent=0 AND activewa=1 LIMIT 40 ");   
while($row = mysqli_fetch_assoc($sql)){ $id = $row['id']; $phone = $row['whatsapp'];
 $ctime = $this->matExist($id)==FALSE ? $row['ctime'] : $this->idToKey($id,'ctime');
 $days = floor((time()-$ctime)/86400);

if($this->matExist($id)==TRUE){
 $act1=sqLx('messages','sn',$days,'act1');        sendWhatsapp($phone, $act1); 
 $act2=sqLx('messages','sn',$days,'act2');        sendWhatsapp($phone, $act2); 
 $act3=sqLx('messages','sn',$days,'act3');        sendWhatsapp($phone, $act3);
 }else{ 
 $inact1=sqLx('messages','sn',$days,'inact1');    sendWhatsapp($phone, $inact1); 
 $inact2=sqLx('messages','sn',$days,'inact2');    sendWhatsapp($phone, $inact2); 
    }

$expire = $days<8 ? 0 : 1;
 $db->query("UPDATE user SET ymd='$ymd', sent='$expire' WHERE id='$id' ");
}
return;
}






//After email + account number verification
function first7day($id){
$ref = userName($id,'ref');
$refid = sqLx('user','sn',$ref,'id'); 
$expire = $this->idToKey($refid,'ctime') + 60*60*24*7;
if($this->matExist($refid)==TRUE AND $expire>time() AND $this->wallet($refid,24)<10000 AND userName($refid,'sn')>25595){
    $this->walletProcess($refid,100,5,24,'1st 7days welcome offer',$id);
}
return; 
}

function timeLeft7($id){
 $expire = $this->idToKey($id,'ctime') + 60*60*24*7;
 $left = ($expire-time())/(60*60*24); 
 return $left>0 ? number_format($left,2) : 0;  
}

function timeLeft30($id){
 $expire = $this->idToKey($id,'ctime') + 60*60*24*30;
 $left = ($expire-time())/(60*60*24); 
 return $left>0 ? number_format($left,2) : 0;  
}

function verifyEmail(){
    global $db;
    $lsk = $_GET['verify'];
    if(sqL1('user','lsk',$lsk)==1){
$id = sqLx('user','lsk',$lsk,'id'); 
$data = userName($id,'email');
if(sqL1('user2','data',$data)==0){
$newlsk = win_hashs(32);
$db->query("INSERT INTO user2 (id,data,type) VALUES('$id','$data',1) ");
$db->query("UPDATE user SET lsk='$newlsk' WHERE id='$id' ");
  if(time()<strtotime('2020-09-30')){ $this->first7day($id);  }
$_SESSION['report']='Account Email Successfully Verified';
$_SESSION['user_idx'] = $id;  header('location: dashboard.php'); 
}else{$_SESSION['report']='Account Email Already Successfully Verified';}
    }else{
  $_SESSION['report']='Email verification failed. Contact system administrator'; 
  $_SESSION['count']=1;      
    }
return ;
}


function updateActiveAndRef($upline,$b1){
    global $db;
    $down = $db->query("SELECT * FROM matuser WHERE a1 = '$upline' ") or die(mysqli_error());
        $nd = mysqli_num_rows($down);
        $upd = $db->query("UPDATE matuser SET active='$nd' WHERE sn = '$upline' ");

        $sp = $this->wildSponsored($b1);
        $updx = $db->query("UPDATE matuser SET sp='$sp' WHERE sn = '$b1' ");
        return;
}





function getOnePin($uid){
    global $db;
$sql = $db->query("SELECT * FROM pin WHERE tm = 3 AND rep='$uid' AND status=0 ORDER BY sn DESC LIMIT 1 ");   
$row = mysqli_fetch_assoc($sql);
return $row['pin'];
}


   


    function SupportTicket()
    {
        global $db,$userKey,$report;
        $msg = addslashes(sanitize($_POST['msg']));
        $ctime = CTIME;
        $msg = $db->query("INSERT INTO msg (senderid,receiverid,msg,ctime)
VALUES('$userKey','1','$msg','$ctime')") or die(mysqli_error());
$report = 'Message sent Successfully, You will get a response soon';
        return;
    }

    function AddNewPackage()
    {
        global $db,$report;
        $title = $_POST['title'];
        $cost = $_POST['cost'];
        $min = $_POST['min'];
        $max = $_POST['max'];
        $cashback = $_POST['cashback'];
        $code = win_hashs(12);

      $db->query("INSERT INTO packs (title,cost,min,max,cashback,code)
VALUES('$title','$cost','$min','$max','$cashback','$code')") or die(mysqli_error());
$report = 'Package created Successfully';
        return;
    }
 function AddNewOffer()
    {
        global $db,$report;
        $title = $_POST['title'];
        $award = $_POST['award'];
        $level = $_POST['level'];
        $note = $_POST['note'];
        $code = win_hashs(12);

      $db->query("INSERT INTO offers (title,award,level,note,ref)
VALUES('$title','$award','$level','$note','$code')") or die(mysqli_error());
$report = 'Offer Package created Successfully';
        return;
    }


function cashBack($id){

    $packid = userName($id,'pack');
$packs = sqLx('packs','ref',$packid,'cashback')*0.01; 
return $packs; 
}

    function AddPackDetails()
    {
        global $db,$report;
        $sn = $_GET['item']; 
        $ref = sqLx('packs','sn',$sn,'ref');
        $i=1; while ($i <= 6) { $e=$i++;

        $x1 = $_POST['x1'.$e];
        $x2 = $_POST['x2'.$e];
        $x3 = $_POST['x3'.$e];
        
       

      $db->query("INSERT INTO packstages (ref,stage,x1,x2,x3)
VALUES('$ref','$e','$x1','$x2','$x3')") or die(mysqli_error());

  }
$report = 'Package Details created Successfully';
        return;
    }


function userTeam($uidx){

$team=0;

$i=1;
while($i<=10){ $e=$i++;
$b = 'b'.$e; 
$team += sqL1('matuser',$b,$uidx);
}
return $team;
}

function userAllTeam($key){
global $db;

 $sql = $db->query("SELECT * FROM matuser WHERE a1='$key' OR a2='$key' OR a3='$key' OR a4='$key' OR a5='$key' OR b1='$key' OR b2='$key' OR b3='$key' OR b4='$key' OR b5='$key' OR b6='$key' OR b7='$key' OR b8='$key' OR b9='$key' OR b10='$key' ") or die(mysqli_error());
return mysqli_num_rows($sql);
}

function userGenTeam($uidx,$gen){
$b = 'b'.$gen; 
$team = sqL1('matuser',$b,$uidx);
return $team;
}
function userGenTeamPlan($uidx,$gen,$plan){
$b = 'b'.$gen; $pack = $plan+1;
$team = sqL2('matuser',$b,$uidx,'pack',$pack);
return $team;
}

function getNth($e){
  $ends = array('','First','Second','Third','Fourth','Fifth','Sixth','Seventh','Eight','Ninth','Tenth');
  return $ends[$e];
}

function getNthPlan($e){
  $ends = array('','Basic','Standard','Premium','Professional','Ultimate','Elite','Advance','Infinity');
  return $ends[$e];
}

function genPer($gen){
    //if($gen==1){$res=0.15;}elseif($gen==2){$res=0.1;}elseif($gen<=6){$res=0.05;}else{$res=0.02;}
    if($gen==1){$res=0.25;}elseif($gen==2){$res=0.15;}elseif($gen==3 OR $gen==4){$res=0.05;}elseif($gen==5){$res=0.10;}
    return $res;
}

function genUpline($uid){

$key = sqLx('matuser','id',$uid,'b1');
return $key>0 ? $this->keyToId($key) : '';
}

function payUpline($id,$pack){

$uid=$id;
$cost=sqLx('packs','ref',$pack,'cost');
$packtitle=sqLx('packs','ref',$pack,'title'); 
$i=1; $h=1;
while($i<=5){ $e=$i++; 
$p=$this->genPer($e);//
$amount = $p*$cost;

$id = $this->genUpline($id);
$remark = $packtitle.' G'.$e.' Referal Bonus';
$type=40+$e;
if($id != ''){ 
$pay = sqL2('packlog','id',$id,'pack',$pack)>0 ? $this->walletProcessPro($id,$amount,5,$type,$remark,$uid) : $this->lostCredit($id,$amount,$type,$remark,$uid);
}else{$this->lostCredit('',$amount,$type,$remark,$uid); }

}
return;
}

function genSpillover($uidx,$gen=1){
    $a = 'a'.$gen;
    $key = sqLx('matuser','sn',$uidx,$a);
return $this->keyToId($key);
}

function paySpillover($uid,$pack){

$uidx = $this->idToKey($uid);
$cost=sqLx('packs','ref',$pack,'cost');
$packtitle=sqLx('packs','ref',$pack,'title'); 
$i=1;
while($i<=5){ $e=$i++; 
   // $p=(6-$e)/100;
    $p=$e/100;

$amount = $p*$cost;
$id = $this->genSpillover($uidx,$e);//
$remark = $packtitle.' G'.$e.' Spillover Bonus';
$type=50+$e;

$pay = sqL2('packlog','id',$id,'pack',$pack)>0 ? $this->walletProcessPro($id,$amount,5,$type,$remark,$uid) :  $this->lostCredit($id,$amount,$type,$remark,$uid) ;

}
return;
}

function UpgradeMembership()
    {
        global $db,$report,$count;
        $id = $this->Uid();
        $cat1 = $_POST['cat1'];
        if(!empty($_POST['cat1'])){
        $this->membershipUpgrade($id,$cat1);
    }
    return;
    }


function membershipUpgrade($id,$cat1){
        global $db,$report,$count;
        
        $pack = sqLx('packs','sn',$cat1,'ref'); 
        $cost = sqLx('packs','sn',$cat1,'cost');
      
        $packstart = sqLx('packs','sn',$cat1,'level');
        $level = $this->idToKey($id,'level');
        $level2 = sqLx('levels','level',$packstart,'ref');
      
        $ctime = time(); 
        $agent = $_COOKIE['agent']??'';
        $addfund = ceil($cost-$this->wallet($id));
    
if($this->wallet($id)<$cost){$report = 'Insufficient Wallet Balance. Fund your wallet with ₦'.number_format($addfund).' and try again.'; $count=1;}      
elseif(sqL2('packlog','id',$id,'pack',$pack)>0){$report = 'Membership subscription Successfully updated'; }
else{
    if($this->matExist($id)==FALSE){ $this->RegisterFromWallet($id); }
     $remark = 'Membership Upgrade to '.sqLx('packs','sn',$cat1,'title');
          
$this->walletProcess($id,$cost,5,6,$remark,$cat1);//Debit member
$this->payUpline($id,$pack);//Pay referral bonuses
$this->paySpillover($id,$pack);//pay spillover bonuses
$key = $this->idToKey($id);
$this->stageUpdate($key);
$this->packUpdate($id,$pack,$cat1);

$_SESSION['report'] = 'Membership subscription Successfully updated ';

$msg = 'You have just unlocked a new earning stream and improved your potential for higher Sales Commission and Referral Bonuses.
You have taken a new step ('.$remark.') towards building sustainable cashflow and lasting happiness. With a little more effort you will experience astonishing results in the days and weeks ahead. You are absolutely unstopable.
<b>Thank you for scaling up</b>';
//$phone = userName($id,'whatsapp'); //
//if(userName($id,'activewa')==1){sendWhatsapp($phone, $msg); }
$this->addNotice($id,'Congratulations!!!',$msg);
}
return;
}

function packUpdate($id,$pack,$cat1){
global $db;
$ctime = time(); 
$agent = $_COOKIE['agent']??'';
$db->query("INSERT INTO packlog (id,pack,ctime,agent) VALUES('$id','$pack','$ctime','$agent')"); 
$db->query("UPDATE matuser SET pack='$cat1',pack2='$pack' WHERE id='$id' "); 
return;
}


    function UpgradeTeamMembership()
    {
        global $db,$report,$count;
        $id=$_SESSION['ActivateRef'];
        $rep = $this->Uid();
        $cat1 = $_POST['cat1'];
        $cost = sqLx('packs','sn',$cat1,'cost');    
if($cost<5000){
    $report = 'Operation Failed, Try again.'; $count=1;
    }      
elseif($this->wallet($rep)<$cost){
    $report = 'Insufficient Wallet Balance. Fund your wallet and try again.'; $count=1;
    }
else{
    $this->walletProcess($rep,$cost,5,2,'Funds Transfer to '.userName($id),$id);//Transfer Funds
    $this->walletProcess($id,$cost,5,19,'Funds Received from '.userName($rep),$rep);//Receive Funds
    $this->membershipUpgrade($id,$cat1);
    }
 return;
}




function unsetReport(){

    if(isset($_SESSION['rpt'])){ unset($_SESSION['report']);  unset($_SESSION['count']); }
    if(isset($_SESSION['rpt'])){ unset($_SESSION['rpt']); }
    if(isset($_SESSION['report'])){ $_SESSION['rpt']=1; }
    return;
}
    function calcSpv($uid)
    {
return ceil($this->walletRange($uid,21,30)/1000);
    }

    function calcRpv($uid)
    {
return ceil($this->walletPv($uid)/1000);
    }


    function SupportTicket2()
    {
        global $db,$report;
$id=$this->userToId($_GET['user']);
        $msg = addslashes(sanitize($_POST['msg']));
        $ctime = CTIME;
        $msg = $db->query("INSERT INTO msg (senderid,receiverid,msg,ctime)
VALUES('1','$id','$msg','$ctime')") or die(mysqli_error());
$report = 'Message sent Successfully';
        return;
    } 



     function AddService(){
        global $db, $report, $count;

        $service = $_POST['service'];
        $description = sanitize($_POST['description']);
         $price = sanitize($_POST['price']);
         $duration = sanitize($_POST['duration']);
         $ctime = time();
        $rep = $this->Uid();
    $sql = $db->query("INSERT INTO ourservices (service,description,price,rep,ctime,duration) VALUES ('$service','$description','$price','$rep','$ctime','$duration') ") or die('Server Error');;

                    $report = "services Successfully submitted";
return;
    }   




    function ModifyEvent(){
        global $db, $report, $count,$userKey;

        $id = $_GET['event'];
 $title = addslashes(sanitize($_POST['title']));
        $des = addslashes(sanitize($_POST['des']));
        $date = addslashes(sanitize($_POST['date']));
        $time = addslashes(sanitize($_POST['time']));
        $venue = addslashes(sanitize($_POST['venue']));
        $status = $_POST['status'];
       
                    
$sql = $db->query("UPDATE event SET title='$title',des='$des',date='$date',time='$time',venue='$venue',status='$status' WHERE id='$id' ");
    $report = "Event Updated Successfully";
            return;
    } 



 function AddEvent()
    {
        global $db,$userKey,$report,$count;
        $title = addslashes(sanitize($_POST['title']));
        $des = addslashes(sanitize($_POST['des']));
        $date = addslashes(sanitize($_POST['date']));
        $time = addslashes(sanitize($_POST['time']));
        $venue = addslashes(sanitize($_POST['venue']));
       

        $photo = $_FILES['image']['name'];
        $loc = $_FILES['image']['tmp_name'];
        $ctime = time();
        $trno = $this->win_hash(8);

        $ext = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
        $array = array('jpg', 'jpeg', 'png');
        if (in_array($ext, $array)) {

                $photo = $this->win_hashs(8).".".$ext;
             move_uploaded_file($loc, '../gstore/event/' . $photo);
        $id = $this->win_hashs(45);
        $msg = $db->query("INSERT INTO event (title,des,date,time,venue,rep,id,photo) VALUES('$title','$des','$date','$time','$venue','$userKey','$id','$photo')") or die(mysqli_error());
$report = 'Event Created Successfully';
}else{$report = 'Invalid image format'; $count=1; }
        return;
    }


    function eventName($id,$col='title'){
        global $db;
        $que = $db->query("SELECT * FROM event WHERE id = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return stripslashes($ro[$col]);
    }    

  

    function win_hash($length)
    {
        return substr(str_shuffle(str_repeat('123456789', $length)), 0, $length);
    }

    function win_hashs($length)
    {
        return substr(str_shuffle(str_repeat('123456789abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);
    }

    function resetPass($email)
    {
        global $db, $report, $count;
       // $email = strtolower(trim(sanitize($_POST['emailreset'])));
        $sql = $db->query("SELECT * FROM user WHERE email = '$email' ") or die('Could not initiate password reset');
        $row = mysqli_fetch_array($sql);
        $id = $row['id'];

        $reset_order = $this->win_hashs(41);
        $find = mysqli_num_rows($sql);
        if ($find == 0) {
            $report = 'This email does not exist in our system, check and try again ';
            $count = 1;
        } elseif ($find == 1) {
            $sql = $db->query("UPDATE user SET code='$reset_order' WHERE email = '$email' ") or die('Could not initiate password reset');
            $message = '<h3>Account Password Reset</h3>You have requested for a password reset. Click on the button below to reset your password:<br>';
            $message .= '<br><center><a style="font-size: 16px; height: 32px; padding: 10px 20px; border-radius:12px;  background: #273fb1; border-color: #273fb1; color: #FFFFFF; font-size:16px;" href="https://www.livepetal.com/accountreset.php?reset-order='.$reset_order.'">RESET PASSWORD</a></center> <br><br>If you did not initiate this operation, quickly report it to your Personal Assistant for investigation';
            $subject = 'Livepetal Password Recovery';
            $this->emailerAll($email, $message, $subject);
            $report = 'We have sent you an e-mail containing your password reset link. Follow the link to reset your password ';
            //if($row['activewa']==1){sendWhatsapp($phone, $report);  }
            $this->addNotice($id,'Password Reset',$report);
        }
        else{
            $report = 'Something is wrong with this account. Contact System Admin ';
            $count = 1;
        }

        return;
    }



 function updateUserBank()
    {
        global $db, $report, $count;
        $id=$this->Uid();
       
        $bank = ucwords(strtolower($this->valEmpty($_POST['bank'], 'Bank')));
        $accountno = $this->valEmpty($_POST['accountno'], 'Account Number');
        $accname = $this->valEmpty($_POST['accname'], 'Account Name');

        $db->query("UPDATE user SET bank='$bank', accountno='$accountno', accname='$accname' WHERE id = '$id' ");
        $report = 'User Account Information Successfully Updated!';
        return;
    }


  

    function resetPassOrder()
    {
        global $db;
        $order = isset($_GET['reset-order']) ? $_GET['reset-order'] : '';
        $sql = $db->query("SELECT * FROM user WHERE code = '$order' ");
        $find = mysqli_num_rows($sql);
        if ($find == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function resetPassConfirm()
    {
        global $db, $report, $count, $reset;
        $pwd1 = $_POST['password'];
        $pwd2 = $_POST['password2'];
        $code = $_GET['reset-order'];
        $reset_order = $this->win_hashs(41);
        if($this->resetPassOrder()==FALSE){
            $report = 'You have followed an invalid or incorrect password reset link. You can initiate a new password reset';
            $count = 1;
        }
        elseif ($pwd1 == $pwd2) {
              $password = bcrypt($pwd1);
            $db->query("UPDATE user SET pass='$password', code='$reset_order' WHERE code = '$code' ");
            $report = 'User Password Successfully Changed! You can now login to your account';
//header('location: ./login.php'); 
            $reset = 2;
        } else {
            $report = 'New Password Mismatch, Try Again';
            $count = 1;
        }


        return;
    }


    function Alert()
    {
        global $report, $count;
        if ($count > 0) {

            echo '<div class="alert alert-danger alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:100000">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-ban"></i>   &nbsp;&nbsp;<b>' . $report . ' </b>&nbsp;&nbsp;&nbsp;
              </div>';


        } else {
            echo '<div class="alert alert-success alert-dismissible" style="position:fixed; top:10px; right:10px; z-index:100000">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-check"></i>  &nbsp;&nbsp;<b>' . $report . '</b>&nbsp;&nbsp;&nbsp;&nbsp;
              </div>';
        }

//if(isset($report)){   unset($_SESSION['report']);  }
        return;
    }


    function AlertMobile()
    {
        global $report, $count;
        if ($count > 0) {

     echo '<div class="modal fade dialogbox" id="AlertMobile" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-icon text-danger">
                        <ion-icon name="close-circle"></ion-icon>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Error</h5>
                    </div>
                    <div class="modal-body">
                     '.$report.'
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        } else {



            echo '        <div class="modal fade dialogbox" id="AlertMobile" data-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-icon text-success">
                        <ion-icon name="checkmark-circle"></ion-icon>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Success</h5>
                    </div>
                    <div class="modal-body">'.$report.'
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

       
        }


        return;
    }


    function emailerAll($email, $message, $subject)
    {
        global $surname;
        $headers = 'From: LIVEPETAL <admin@livepetal.com>' . "\r\n";
        $headers .= 'Reply-To: admin@livepetal.com' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = '<div style="font-family: "Poppins", sans-serif; background-color: #D9E5EC; font-size:16px; padding:10px;"><center><img src="https://livepetal.com/appp/assets/img/livepetal2.png"></center><br>'.$message.'</div>';

        $send = mail($email, $subject, $message, $headers);
        return;
    }


    function emailer($email)
    {
    
        $headers = 'From: LIVEPETAL <support@livepetal.com>' . "\r\n";
        $headers .= 'Reply-To: support@livepetal.com' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


        $subject = 'WELCOME TO LIVEPETAL';
        $mailmessage = "<p>Welcome " . ucwords(sqLx('user','email',$email,'firstname')) . '<br>Your registration with LIVEPETAL is successful! We appreciate your interest in LIVEPETAL and we hope to have a fruitful business colaboration with you. </p>
<p>We intend to make Livepetal.com your prefered digital marketplace. Our mission is to make customizable  digital technology solutions affordable and available to individuals and businesses in a way that exactly meets the need at hand.  </p>

    <p>We have experts in virtually all fields of digital technology who are equiped to deliver cutting edge solution to the marketplace.</p>

  
<p><br><h3>Verify Email</h3>  
Follow the link below to verify and activate your livepetal account <br> 
<a href="https://livepetal.com/verifyemail.php?verify='.sqLx('user','email',$email,'lsk').'" >https://livepetal.com/verifyemail.php?verify='.sqLx('user','email',$email,'lsk').'</a>
</p>
 <p><br>Thank you for joining livepetal.com<br> <br> <br> <br> </p>';


        $send = mail($email, $subject, $mailmessage, $headers);
        return;
    }


    function replyMsg()
    {
        global $db, $report, $count;
        $mid = $_GET['reply'];
        $reply = addslashes($_POST['replyMsg']);
        if (strlen($reply) > 5) {
            $msg = $db->query("INSERT INTO replymsg (mid,reply) VALUES('$mid','$reply')") or die(mysqli_error());
            $report = 'Reply sent successfully';
        } else {
            $report = 'Message too short';
            $count = 1;
        }
        return;
    }


    function verifyUser()
    {
        global $db, $report, $count;
        $username = $_POST['user'];

        $sql = $db->query("SELECT * FROM user WHERE user = '$username' ") or die(mysqli_error());
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $_SESSION['recKey'] = $row['id'];
            $report = 'Beneficiary successfully verified';
        } else {
            $report = 'Invalid Beneficiary, try again';
            $count = 1;
        }
        return;
    }


    function SendUserMessage()
    {
        global $report;
        $rec = $_POST['SendUserMessage'];

        $message = addslashes($_POST['msg']);
        $subject = addslashes($_POST['subject']);

        $this->message($rec, 'Admin', $message, $subject);
        $report = 'Your message was successfully sent';
        return;
    }


function notifyLogin($uid){
$phone = userName($uid,'whatsapp');
        $msg = 'A successful login operation occured on your account on '.date('D jS M, Y h:i A').'. If you did not initiate this operation, quickly report it to your personal assistant for investigation';
    //if(userName($uid,'activewa')==1){sendWhatsapp($phone, $msg);  }
        $this->addNotice($uid,'Login Successful!',$msg);
}

function notifyFailedLogin($uid){
$phone = userName($uid,'whatsapp');
        $msg = 'A failed login attempt occured on your account on '.date('D jS M, Y h:i A').'. If you did not initiate this operation, quickly report it to your Personal Assistant for investigation';
    //if(userName($uid,'activewa')==1){sendWhatsapp($phone, $msg);  }
        $this->addNotice($uid,'Failed Login Attempt!',$msg);
}
    
    function LoginUsers()
    {
        global $db, $report, $count;
        $email = strtolower(sanitize(trim($_POST['email'])));
        $email = str_replace(' ', '', $email);
        $password = $_POST['password'];
        $sql = $db->query("SELECT * FROM user WHERE email='$email' ");

        if (mysqli_num_rows($sql) == 1) {
            $row = mysqli_fetch_array($sql);
            $status = $row['status'];

            if (password_verify($password, $row['pass'])) {

                if ($status > 0) {
                  $this->notifyLogin($row['id']);
                    $_SESSION['user_idx'] = $row['id'];
                    $_SESSION['lpk'] = $row['sn'];
                    setcookie('lpk', $row['sn'], time() + COOKIE_EXPIRE, "/");
                      loginAtt($email,1);
     if($_SERVER['REQUEST_URI']=='/requestquotation'){}else{ header('location: dashboard.php'); }
                } else {loginAtt($email,2);
                    $report = 'Your user account has been deactivated, contact the system administrator ';
                    $count = 1;
                    
                }
            } else {loginAtt($email,3);
                $report = 'Incorrect Login details, try again.';
                $count = 1;

                $this->notifyFailedLogin($row['id']);
            }
        } else {
          loginAtt($email,4);
            $report = 'Incorrect Login details, try again';
            $count = 1;
        }
        
        return;
    }


    
    function LoginUsersMob()
    {
        global $db, $report, $count;
        $email = strtolower(sanitize(trim($_POST['email'])));
        $password = $_POST['password'];
        $sql = $db->query("SELECT * FROM user WHERE email='$email' ");

        if (mysqli_num_rows($sql) == 1) {
            $row = mysqli_fetch_array($sql);
            $status = $row['status'];

            if (password_verify($password, $row['pass'])) {

                if ($status > 0) {
                  $this->notifyLogin($row['id']);
                    $_SESSION['user_idx'] = $row['id'];
                    $_SESSION['lpk'] = $row['sn'];
                    setcookie('lpk', $row['sn'], time() + COOKIE_EXPIRE, "/");
                    setcookie('muser', $email, time() + 86400*7, "/");
                    setcookie('mpass', $password, time() + 86400*7, "/");
                      loginAtt($email,9);
                    header('location: index.php'); 
                } else {
                  loginAtt($email,10);
                    $report = 'Your user account has been deactivated, contact the system administrator ';
                    $count = 1;
                }
            } else {
              loginAtt($email,11);
                $report = 'Incorrect Login details.';
                $count = 1;
                $this->notifyFailedLogin($row['id']);
            }
           
        } else {loginAtt($email,12);
            $report = 'Incorrect Login details';
            $count = 1;
        }
       
        return;
    }



function toggleKeepLogin($uid){
  global $db;
  $keep = sqLx('user','id',$uid,'keep');
  $k = $keep==1 ? 0 : 1;
  $db->query("UPDATE user SET keep='$k' WHERE id='$uid' ");
  return;
}

function activeClient($id){
    $res = ($this->updatedActive($id)==TRUE AND $this->updatedPhoto($id)==TRUE AND $this->updatedCard($id)==TRUE AND $this->updatedUser($id)==TRUE) ? TRUE : FALSE;
    return $res;
}

function updatedActive($id){
    global $db;

    $sq=$db->query("SELECT * FROM matuser WHERE id='$id' " );
$res = (mysqli_num_rows($sq)==1) ? TRUE : FALSE;
    return $res;
}

function updatedPhoto($id){
    global $db;
    $sq=$db->query("SELECT * FROM user2 WHERE id='$id' AND type=1 " );
$res = (mysqli_num_rows($sq)==1) ? TRUE : FALSE;
    return $res;
}

function updatedCard($id){
    global $db;
    $sq=$db->query("SELECT * FROM user2 WHERE id='$id' AND type=2 " );
$res = (mysqli_num_rows($sq)==1) ? TRUE : FALSE;
    return $res;
}

function updatedUserBank($id){
    global $db;
    $sq=$db->query("SELECT * FROM user WHERE id='$id' " );
$row = mysqli_fetch_assoc($sq);
$res = (empty($row['bank']) OR empty($row['accountno'])) ? FALSE : TRUE;
    return $res;
}



    function AccountActini(){

$_SESSION['amount'] = 2500;
$_SESSION['paytype'] = $_POST['paytype'];
header("location: fundwalletpay.php");
// if($_SESSION['paytype']==3){}
// elseif($_SESSION['paytype']==4){
// header("location: activatewithpin.php");  
// }
return;
    }

        function cancelPay(){

unset($_SESSION['amount']);
unset($_SESSION['paytype']);
header("location: fundwallet.php");
return;
    }



function validLayer()
    {
        if (strlen($this->layerKey()) != 32) {
            unset($_SESSION['user_idx']);
        } else {
        }
        return;
}




    function updateUser()
    {
        global $db, $report, $userKey;
        $state = sanitize($_POST['state']);
        $city = sanitize($_POST['city']);
        $address = addslashes(sanitize($_POST['address']));
        $phone = sanitize($_POST['phone']);
        $bank = sanitize($_POST['bank']);
        $accountno = sanitize($_POST['accountno']);


        $db->query("UPDATE user SET state='$state', city='$city', phone='$phone', address='$address', bank='$bank', accountno='$accountno' WHERE id = '$userKey' ");
        $report = 'User Information Successfully Updated!';

        return;
    }


    function RestorePin()
    {
        global $db, $report;
        $pin = $_POST['RestorePin'];

        $db->query("UPDATE pin SET status=0, id='' WHERE pin = '$pin' ");
        $report = 'PIN Successfully Restored!';

        return;
    }


    function DeactivateUser()
    {
        global $db, $report;
        $userKey = $_POST['DeactivateUser'];
        $status = ($this->uName($userKey, 'status') == 1) ? 0 : 1;
        $act = ($status == 0) ? 'Deactivated!' : 'Activated!';

        $db->query("UPDATE user SET status='$status' WHERE id = '$userKey' ");
        $report = $this->uName($userKey) . ' has been successfully ' . $act;

        return;
    }

    function UpdatePin()
    {
        global $db, $report, $count, $signup;
        $userKey = $_POST['UpdatePin'];
        $pin = $_POST['pin'];
        $user = $this->uName($userKey);
        if ($signup->pinValidity($pin) == TRUE) {
            $db->query("UPDATE user SET pin='$pin' WHERE id = '$userKey' ");
            $db->query("UPDATE pin SET status=1, id='$user' WHERE pin = '$pin' ");
            $report = $this->uName($userKey) . ' has been successfully activated';
        } else {
            $signup->pinValidity($pin);
        }

        return;
    }


    function CourseUpload()
    {
        global $db, $report, $count;

        $title = sanitize($_POST['title']);
        $doc = str_replace(" ", "-", $_FILES['doc']['name']);
        define('upload', 'train/');
        if (isset($title) AND isset($doc) AND strlen($doc) > 5 AND strlen($title) > 5) {
            $success = move_uploaded_file($_FILES['doc']['tmp_name'], upload . $doc);


            $sqlw = $db->query("INSERT INTO course (title,file) VALUES ('$title','$doc') ");
            $report = 'Course Material Successfully Uploaded!';
        } else {
            $report = 'You have entered an incomplete information';
            $count = 1;
        }
        return;
    }



    function AddNewAdvert()
    {
    global $db,$report,$count; 
    $rep = $this->Uid();
    $note = $_POST['note'];
    $day = $_GET['day'];
    $cat = $_POST['category'];
    $url = $_POST['url'];

      $name = $_FILES['image']['name'];
      $name2 = 'p'.$day.$this->win_hashs(12).$this->fileExt2($name);
      define('upload', 'uphoto/ad/');
if($this->fileExt($name)==TRUE){
     $success = move_uploaded_file($_FILES['image']['tmp_name'], upload.$name2);

$sqlw = $db->query("INSERT INTO dailyad (day,category,note,url,rep,photo) VALUES ('$day','$cat','$note','$url','$rep','$name2') ");
$report = 'Daily Advert Successfully Submitted!';

}else{$report='Operation failed, could not upload Photograph'; $count=1; }
return;
    }



    function EditDailyAdvert()
    {
    global $db,$report,$count; 
    $rep = $this->Uid();
    $note = $_POST['note'];
    $day = $_POST['day'];
    $cat = $_POST['category'];
    $url = $_POST['url'];  
    $sn = $_GET['edit'];  
    //$nophoto = $_POST['nophoto']??0;

 if(empty($_FILES['image']['name'])){    
$sql = $db->query("UPDATE dailyad SET day='$day',category='$cat',note='$note',url='$url',rep='$rep' WHERE sn = '$sn' ");

}else{
    $name = $_FILES['image']['name'];
      $name2 = 'p'.$day.$this->win_hashs(12).$this->fileExt2($name);
      define('upload', 'uphoto/ad/');
if($this->fileExt($name)==TRUE){

     $success = move_uploaded_file($_FILES['image']['tmp_name'], upload.$name2);

$sql = $db->query("UPDATE dailyad SET day='$day',category='$cat',note='$note',url='$url',rep='$rep',photo='$name2' WHERE sn = '$sn' ");
}
}

$report = 'Daily Advert Successfully Submitted!';
return;
    }


    
    function updateUser2()
    {
        global $db, $report;
        $keys = $_GET['u-ref'];
        $state = sanitize($_POST['state']);
        $email = sanitize($_POST['email']);
        $othername = sanitize($_POST['othername']);
        $city = sanitize($_POST['city']);
        $address = addslashes(sanitize($_POST['address']));
        $phone = sanitize($_POST['phone']);
        $bank = sanitize($_POST['bank']);
        $accountno = sanitize($_POST['accountno']);


        $db->query("UPDATE user SET othername='$othername', state='$state', city='$city', phone='$phone', address='$address', bank='$bank', email='$email', accountno='$accountno' WHERE sha1(sn) = '$keys' ");
        $report = 'User Information Successfully Updated!';

        return;
    }

function fileExt($name){
    $ext = strtolower(substr($name, strpos($name,'.'), strlen($name)-1));
if($ext=='.jpg' OR $ext=='.jpeg' OR $ext=='.png'){ $res = TRUE; }else{$res= FALSE; }
return $res;
}

function fileExt2($name){
    $ext = strtolower(substr($name, strpos($name,'.'), strlen($name)-1));
// if($ext=='.jpg' OR $ext=='.jpeg' OR $ext=='.png'){ $res = TRUE; }else{$res= FALSE; }
return $ext;
}

function updatePhoto(){
    global $db,$report,$count; 
    $id = $this->Uid();
      $name = $_FILES['image']['name'];
      $name2 = 'pp'.$this->win_hashs(12).$this->fileExt2($name);
      define('upload', 'uphoto/');
if($this->fileExt($name)==TRUE){
    if(sqL1('user2','data',$name2)==0){
     $success = move_uploaded_file($_FILES['image']['tmp_name'], upload.$name2);

$sqlw = $db->query("INSERT INTO user2 (id,type,data) VALUES ('$id',3,'$name2') ");
$report = 'User Profile Photo Successfully Submitted!';
}
}else{$report='Operation failed, could not upload Photograph'; $count=1; }
return;
}


    // function updatePhoto()
    // {
    //     global $db, $report, $userKey;

    //     $name = $this->userName('user') . $_FILES['image']['name'];
    //     define('upload', 'photo/');
    //     $success = move_uploaded_file($_FILES['image']['tmp_name'], upload . $name);

    //     $sqlw = $db->query("UPDATE user SET photo = '$name' WHERE id = '$userKey' ");
    //     $report = 'User Profile Photo Successfully Update!';
    //     return;
    // }

    function updatePhoto2()
    {
        global $db, $report;
    $id = $this->Uid();
      $name = $_FILES['image']['name'];
      $name2 = 'mid'.$this->win_hashs(12).$this->fileExt2($name);
      define('upload', 'uphoto/');
if($this->fileExt($name)==TRUE){
    if(sqL1('user2','data',$name2)==0){
     $success = move_uploaded_file($_FILES['image']['tmp_name'], upload.$name2);

$sqlw = $db->query("INSERT INTO user2 (id,type,data) VALUES ('$id',4,'$name2') ");
$report = 'User Profile Photo Successfully Submitted!';
}
}else{$report='Operation failed, could not upload Photograph'; $count=1; }
        return;
    }
 
    function MessageSubmit()
    {
        global $db, $report, $count;

        $id = $this->Uid();
        $message = sanitize($_POST['message']);
        $time = time();
        $sql = $db->query("INSERT INTO msg(msg,senderid,receiverid,ctime) VALUES('$message','$id',1,'$time') ");
        $report = "Message Sent Successfully";
    }
   

    function isLogedIn(){

if (!empty($this->Uid()) AND $this->userExist2($this->Uid())==TRUE){
    $res=TRUE;
} 
    else {  $res=FALSE;  }
        return $res;
    }

    function checkLogin(){

if (!empty($this->Uid()) AND $this->userExist2($this->Uid())==TRUE) {} 
    else {  $this->LogoutUserTimeout();   }
        return;
    }

   function checkPackaged($uid){
  global $uri;
  $open = ['membership','fundaccount','transactionrecord','personalassistant'];
if(in_array($uri,$open) OR $this->isActive($uid)==TRUE){}
else{ header("location: membership.php");   }
        return;
    }

   function checkActivated($uid){

        global $db, $report, $count;
        $sql = $db->query("SELECT * FROM matuser WHERE id = '$uid' ") or die(mysqli_error());
        if (mysqli_num_rows($sql) == 1) { } 
        else {
            header("location: updateprofile.php");
        }
        return;
    }

   function isActive($uid){

        global $db, $report, $count;
        $sql = $db->query("SELECT * FROM matuser WHERE id = '$uid' ") or die(mysqli_error());
        if (mysqli_num_rows($sql) == 1) {return TRUE; } else { return FALSE; }

    }   

    function hasPurchased($uid){

        global $db, $report, $count;
        $sql = $db->query("SELECT * FROM newsales WHERE id = '$uid' ") or die(mysqli_error());
        if (mysqli_num_rows($sql) > 0) {return TRUE; } else { return FALSE; }

    }

function newSalesByUser(){
    $id = $this->Uid();
    $amount = $_POST['amount'];
    $item = $_POST['item'];
    $this->newTransaction($id,$amount,$item);
    return;
}

function newSalesByAdmin(){
    $id = $_SESSION['SearchClient'];
    $amount = $_POST['amount'];
    $item = $_POST['item'];
    $this->newTransaction($id,$amount,$item);
    return;
}


function newTransaction($id,$amount,$item){
global $db,$report,$count;
$tref = $this->win_hash(12);
//$amount = ($this->isActive($id)==TRUE AND $this->hasPurchased($id)==FALSE) ? $amount-2500 : $amount;
 $amount2 = $this->isActive($id)==TRUE ? $amount : $amount-5000;
if(sqL1('newsales','id',$id)==0 AND $amount==5000){
        $this->newSales($id,0,$amount2,$item,$tref);
}
 elseif($this->wallet($id) >= $amount AND $amount>=5000){

if($this->isActive($id)==FALSE){   $this->membershipUpgrade($id,2); }

 //
    $b1 = $this->idToKey($id,'b1');
    $b1id = $this->keyToId($b1);
 //$this->walletProcess($b1id,500,5,20,'Referal Bonus',$id);

     //Activate the user if inactive
    if(sqL1('newsales','id',$id)==0 AND $amount==5000){}else{
$this->walletProcess($id,$amount2,5,3,$item,$tref);//debit user
if($amount2>0){ $this->sharingFormula($id,$amount2,$tref); }//share commission
}
       //Register the sales
    $this->newSales($id,$amount,$amount2,$item,$tref);
    //Give value here. Identify items by serial number 
    $this->giveItemValue($id,$item);
    //share sales bonuses//

//unset($_SESSION['item']);
}else{
$report = 'Insufficient Fund in Wallet. Please, fund your wallet to complete this transaction'; $count=1;
}
return;
}


function giveItemValue($id,$item){
if($item==1){ /* do this */ }  
return;
}


function newSales($id,$amount,$amount2,$item,$trno){
    global $db;
        $b1 = $this->idToKey($id,'b1');
        $b2 = $this->idToKey($id,'b2');
        $b3 = $this->idToKey($id,'b3'); 
        $ctime = time();
        $expiry = $ctime+60*60*24*365; //subscribe for 6 months
      
        $rep = $this->Uid();
        $db->query("INSERT INTO newsales(id,amount,amount2,item,b1,b2,b3,ctime,expiry,rep,trno) VALUES ('$id','$amount','$amount2','$item','$b1','$b2','$b3','$ctime','$expiry','$rep','$trno') ");
return;
}

function isServiceActive($sn,$id){
    global $db;
    $ctime = time();
    $qu = $db->query("SELECT * FROM newsales WHERE id = '$id' AND item='$sn' AND expiry>'$ctime' ") or die(mysqli_error());
     return mysqli_num_rows($qu);
}

    function sharingFormula($id,$amount,$tref){
        $b1 = $this->idToKey($id,'b1');
        $b2 = $this->idToKey($id,'b2');
        $b3 = $this->idToKey($id,'b3');
        $b4 = $this->idToKey($id,'b4');
        $b5 = $this->idToKey($id,'b5');

    $b1id = $this->keyToId($b1);
    $b2id = $this->keyToId($b2);
    $b3id = $this->keyToId($b3);
    $b4id = $this->keyToId($b4);
    $b5id = $this->keyToId($b5);

    $b1cash = $this->bxPercent($b1id,'x1')*$amount;
    $b2cash = $this->bxPercent($b2id,'x2')*$amount;
    $b3cash = $this->bxPercent($b3id,'x3')*$amount;
    $b4cash = $this->bxPercent($b4id,'x4')*$amount;
    $b5cash = $this->bxPercent($b5id,'x5')*$amount;

    $lost = 0.08*$amount;
    $lost2 = 0.06*$amount;


                  $this->walletProcess($b1id,$b1cash,4,21,'G1 Sales Commission',$id); //pay X1
    if($b2cash>0){$this->walletProcess($b2id,$b2cash,4,22,'G2 Sales Commission',$id); }
    else{ $this->lostCredit($b2id,$lost,22,'G2 Sales Commission',$id); } //pay X2
    if($b3cash>0){$this->walletProcess($b3id,$b3cash,4,23,'G3 Sales Commission',$tref); }
    else{ $this->lostCredit($b3id,$lost,23,'G3 Sales Commission',$id); } //Pay X3
    if($b4cash>0){$this->walletProcess($b4id,$b4cash,4,24,'G4 Sales Commission',$id); }
    else{ $this->lostCredit($b4id,$lost,24,'G4 Sales Commission',$id); } //pay X4
    if($b5cash>0){$this->walletProcess($b5id,$b5cash,4,25,'G5 Sales Commission',$tref); }
    else{ $this->lostCredit($b5id,$lost2,25,'G5 Sales Commission',$id); } //Pay X5
             
    return;   
    }

    

function bxPercent($bxid,$x){
    $level = $this->idToKey($bxid,'level');
    $pack = $this->idToKey($bxid,'pack2');
     $p = sqLx2('packstages','ref',$pack,'stage',$level,$x);
    return $p*0.01;
}

    function DeleteMessage($sn)
    {
        global $db, $report, $count;

        $db->query("DELETE FROM msg WHERE sn='$sn'");
        $report = "Deleted Successfully";
        $count = 1;
    }

    function ReplyMessage($id, $sn)
    {
        global $db, $report;
        $message = sanitize($_POST['reply']);
        $time = time();
      $db->query("INSERT INTO msg(msg,senderid,receiverid,reply,ctime) VALUES('$message','','$id','$sn','$time')");
        $report = "Sent";
    }

    function MessageAdminSubmit()
    {
        global $db, $report, $count;

        $id = $_POST['id'];
        $message = sanitize($_POST['message']);
        $time = time();
        $sql = $db->query("INSERT INTO msg(msg,senderid,receiverid,ctime) VALUES('$message',1,'$id','$time') ");
        $report = "Message Sent Successfully";
    }

    function ChangeUserPassword()
    {
        global $db, $report, $count;

        $id = $this->Uid();
        $pass = userName($id, 'pass');
        $password = $_POST['pwd'];
        $new_pass = $_POST['newpwd'];
        $retype = $_POST['retype'];

    if ($new_pass != $retype) {
        $report = "Confirm Password Must Be the Same With New Password";
        $count = 1;
    }
        elseif (!password_verify($password, $pass)) {
            $report = "Wrong Password";
            $count = 1;
        } elseif (strlen($new_pass) <= 3) {
            $report = "Sorry Password Must Be More Than 3 Characters";
            $count = 1;
        }  else {
            $original = bcrypt($new_pass);
            $sql = $db->query("UPDATE user SET pass='$original' WHERE id='$id'");
            $report = "Password Changed Successfully";
        }

    }


       function ChangeUserPasswordAdmin()
    {
        global $db, $report,$userKey, $count;

        $id=$this->skeyToId($_GET['user']);
        $pass = userName($userKey, 'pass');
        $password = sanitize($_POST['pwd']);
        $new_pass = sanitize($_POST['newpwd']);
        $retype = sanitize($_POST['retype']);

    if ($new_pass != $retype) {
        $report = "Confirm Password Must Be the Same With New Password";
        $count = 1;
    }
        elseif (!password_verify($password, $pass)) {
            $report = "Wrong Password";
            $count = 1;
        } elseif (strlen($new_pass) <= 3) {
            $report = "Sorry Password Must Be More Than 3 Characters";
            $count = 1;
        }  else {
            $original = bcrypt($new_pass);
            $sql = $db->query("UPDATE user SET pass='$original' WHERE id='$id'");
            $report = "Password Changed Successfully";
        }
return;
    }



    //Total Sponsored by User               
    function Sponsored()
    {
        global $db;
        $id=$this->Uid();
        $key = userName($id,'sn');
        $qu = $db->query("SELECT * FROM matuser WHERE b1 = '$key' ") or die(mysqli_error());
        $nu = mysqli_num_rows($qu);
        return $nu;
    }


    function ForgertPassword(){
        global $db, $report, $count;

        $username = sanitize($_POST['username']);
        $email = sanitize($_POST['email']);
        $phone = sanitize($_POST['phone']);

        $sql = $db->query("SELECT * FROM user WHERE user='$username' AND email='$email'");
        if($sql->num_rows < 1){
            $count = 1;
            $report = "Sorry Username or Email does not exist";
        }
        else {
            $password = substr(str_shuffle(str_repeat('123456789abcdefghijk', 4)), 0, 4);
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $sql1 = $db->query("UPDATE user SET pass='$pass' WHERE user='$username' AND email='$email'");

            $subject= 'Password Changed';
            $message = '<p>Password Changed Succesfully<br> Your New Password is: '.$password.'.<br> Please Keep Safe';  
            $this->emailerAll($email, $message, $subject);

            $report = "Successful, Check Your Mail ";
        }
    }
   

function FundTransfer(){
        global $report, $count;

        $userKey = $this->Uid();
        $bene = $_SESSION['SearchClient'];
        $amount = $_POST['amount'];
        $pass = $_POST['password'];
        $password = userName($userKey,'pass');
        $remark = 'Fund Transfered to '.userName($bene);
        $remark2 = 'Fund Received from '.userName($userKey);
        $type = 2;
        $type2 = 19;
        $status = 5;
        $initBalance = $this->wallet($userKey);

        if($amount > $initBalance){
            $report = "Insufficient Balance";
            $count = 1;
        }
        elseif($amount < 100){
            $count = 1;
            $report = "Minimum Transfer amount is NGN100";
        }
        
        elseif($amount > $this->maxwithdraw){
            $count = 1;
            $report = "Cannot Transfer more than NGN".$this->maxwithdraw;
        }
        // elseif($this->idToKey($userKey,'level') < 2){
        //     $count = 1;
        //     $report = "You need to complete ".$this->stageToTitle(1)." stage to activate fund transfer";
        // }
        elseif(password_verify($pass, $password)){

           $this->walletProcess($userKey,$amount,$status,$type,$remark,$bene);
           $this->walletProcess($bene,$amount,$status,$type2,$remark2,$userKey);
           $report = "Fund transfer completed successfully";
        }
        
        else {
            $report = "Authentication failed. try again";
            $count = 1;
        }
        return;
    }
   

function FundTransferMob(){
        global $report, $count;

        $userKey = $this->Uid();
        $rec = $_POST['recipient'];
        $bene = strlen($rec)<9 ? $this->refToId($rec) : sqLx('user','phone',$rec,'id');
        $amount = $_POST['amount'];
        
        $remark = 'Fund Transfered to '.userName($bene);
        $remark2 = 'Fund Received from '.userName($userKey);
        $type = 2;
        $type2 = 19;
        $status = 5;
        $initBalance = $this->wallet($userKey);

        if($userKey==$bene){
            $report = "Invalid Beneficiary ID";
            $count = 1;
        }
        elseif($amount > $initBalance){
            $report = "Insufficient Balance";
            $count = 1;
        }
        elseif($amount < 100){
            $count = 1;
            $report = "Minimum Transfer amount is NGN100";
        }
        
        elseif($amount > $this->maxwithdraw){
            $count = 1;
            $report = "Cannot Transfer more than NGN".$this->maxwithdraw;
        }
       
        else{

           $this->walletProcess($userKey,$amount,$status,$type,$remark,$bene);
           $this->walletProcess($bene,$amount,$status,$type2,$remark2,$userKey);
           $report = "You successfully transfered NGN".number_format($amount,2).' to '.userName($bene);
        }
        
        return;
    }


function RequestWithdraw(){
        global $report, $count;

        $userKey = $this->Uid();
        $amount = $_POST['amount'];
        $amt=$amount;
        $pass = $_POST['password'];
        $password = userName($userKey,'pass');
        $remark = 'Cash Withdrawal';
        $type = 1;
        $status = 1;
        $initBalance = $this->wallet($userKey);
        $amount = $amount+$this->withdrawcharge;

           $stage = $this->idToKey($userKey,'level');
         $min = sqLx('levels','level',$stage,'minw');  
         $max = sqLx('levels','level',$stage,'maxw');

        if($amount > $initBalance){
            $report = "Insufficient Balance";
            $count = 1;
        }
        elseif($amount < $min){
            $count = 1;
            $report = "Your Minimum Withdrawal amount is NGN".number_format($min);
        }
        
        elseif($amount > $max){
            $count = 1;
            $report = "You Can not Withdraw more than NGN".number_format($max);
        }
        elseif($this->idToKey($userKey,'level') < 2){
            $count = 1;
            $report = "You need to complete ".$this->stageToTitle(1)." stage to activate cash withdrawals";
        }
        elseif(password_verify($pass, $password)){

           $this->walletProcess($userKey,$amt,$status,$type,$remark,'');
           $this->walletProcess($userKey,$this->withdrawcharge,5,5,'Cash Withdrawal Charges','');
           $report = "Withdrawal request successfully placed. It will be processed and delivered to your bank account within 24 hours on working days only";
        }
        
        else {
            $report = "Authentication failed. try again";
            $count = 1;
        }
        return;
    }

function YesInvest(){
        global $report, $count;

        $userKey = $this->Uid();
        $amount = $_SESSION['invamount'];
        $pass = $_POST['password'];
        $password = $this->userName4('pass');
        $remark = 'Cash Investment';
        $type = 4;
        $status = 5;
        $initBalance = $this->wallet($userKey);
        //$amount = $amount+$this->withdrawcharge;
        if($amount > $initBalance){
            $report = "Insufficient Balance";
            $count = 1;
        }
        elseif($amount < $this->mininvest){
            $count = 1;
            $report = "Minimum Investment amount is NGN".$this->mininvest;
        }
        
        elseif($amount > $this->maxwithdraw){
            $count = 1;
            $report = "You Cannot Invest more than NGN".$this->maxwithdraw;
        }
        elseif(password_verify($pass, $password)){
           $this->walletProcess($userKey,$amount,$status,$type,$remark,'');
           $report = "Withdrawal request successfully placed";
        }
        
        else {
            $report = "Authentication failed. try again";
            $count = 1;
        }
        return;
    }



function ApproveFundOrder(){
        global $db,$report, $count;
        $userKey = $_POST['ApproveFundOrder'];

$trno = $_GET['transaction'];
$uid = $this->Uid();
        
        $amount = $_POST['amount'];
        $pass = $_POST['password'];
        $password = userName($uid,'pass');
        $remark = 'Wallet Funding with Bank Deposit';
        $type = 17;
        $status = 5;
               
        if(password_verify($pass, $password)){

           $this->walletProcess($userKey,$amount,$status,$type,$remark);
         $db->query("UPDATE walletorder SET amount2='$amount',status='$status' WHERE trno='$trno' ");
           $report = "Wallet Funding successful";

        }
        
        else {
            $report = "Authentication failed. try again";
            $count = 1;
        }
        return;
    }





function walletName($trno,$opt='id'){
    global $db;

    $sql = $db->query("SELECT * FROM ewalletx WHERE trno='$trno' ");
    $row=mysqli_fetch_assoc($sql);
    return $row[$opt];
}

function ProcFundOrder(){
    global $db,$report,$count;
    $rid=$this->Uid();
   
$trno = isset($_GET['t_ref']) ? $_GET['t_ref'] : $_SESSION['wafundID'];
    $pa = $this->userNamex($rid,'pass');
      $currentpass = $_POST['currentpass'];
$ctime = time();
$st = $this->walletName($trno,'status')<2 ? 2 :5 ;
      
      if(password_verify($currentpass, $pa)){
$db->query("UPDATE ewalletx SET status='$st',ctime='$ctime' WHERE trno = '$trno' "); 
 
 if($st==5){
 $id = $this->walletName($trno,'id');
 $amount = $this->walletName($trno,'cos');
 $date = date('Y-m-d');
 $rep2 = userName($rid);

$sql = $db->query("INSERT INTO walletorder (id,trno,amount,amount2,date,ref,ctime,type,status) VALUES ('$id','$trno','$amount','$amount','$date','$rep2','$ctime','Cash Payment',5) "); 
$tan = $this->wallet($id);
$phone = userName($id,'whatsapp'); 
$msg = 'Your wallet funding transaction has been confirmed.' ;
$msg .= ' New Account Balance: '.NAIRA.number_format($tan,2);
//if(userName($id,'activewa')==1){sendWhatsapp($phone,$msg); } 
$this->addNotice($id,'BALANCE UPDATE',$msg);
}

$report = 'User Account Operation Successful!';
          
      }else{$report='Password Mismatch, Try Again!'; $count = 1;}

return;   
}

function FundWalletOrder(){
    global $db,$report,$count;
    $id=$this->Uid();
   
$trno = $this->win_hash(12);
$amount = $_POST['amount'];
$date = strtotime($_POST['date']);
$ref = $_POST['ref'];
$type = $_POST['type'];

$ctime = time();


$sql = $db->query("INSERT INTO walletorder (id,trno,amount,date,ref,ctime,type,status) VALUES ('$id','$trno','$amount','$date','$ref','$ctime','$type',1) ");  

$report = 'Payment details Successful Submitted!';
          

return;   
}

function incentName($trno,$opt='id'){
    global $db;

    $sql = $db->query("SELECT * FROM incentive WHERE trno='$trno' ");
    $row=mysqli_fetch_assoc($sql);
    return $row[$opt];
}

    function ApproveWithdrawal(){
      global $db,$report,$count;
    $rid=$this->Uid();
   
$trno = isset($_GET['t_ref']) ? $_GET['t_ref'] : $_SESSION['wafundID'];
    $pa = $this->userNamex($rid,'pass');
      $currentpass = $_POST['currentpass'];
$ctime = time();
$st = $this->walletName($trno,'status')<2 ? 2 :5 ;

if(password_verify($currentpass, $pa)){
$db->query("UPDATE ewalletx SET status='$st',ctime='$ctime',rep='$rid' WHERE trno = '$trno' "); 
$report = 'User Account Operation Successful!';
          
      }else{$report='Password Mismatch, Try Again!'; $count = 1;}

return;  
    }



    
function SendMail(){
    global $db, $report,$signup;
$message=$_POST['msg'];
$subject=$_POST['subject'];
$rec = $_POST['rec'];

$i=1; 
//$sql = $db->query("SELECT * FROM user WHERE active = 2 ");
$sql = $db->query("SELECT * FROM user WHERE sn>20044 ");

    while($row = mysqli_fetch_assoc($sql)){$email = $row['email'];
if($rec==2){$this->emailerAll($email,$message,$subject); $e=$i++; } 
elseif($rec==1 AND $this->isActive($row['id'])==TRUE){ $this->emailerAll($email,$message,$subject);  $e=$i++;  }
elseif($rec==3 AND $this->isActive($row['id'])==FALSE){ $this->emailerAll($email,$message,$subject);  $e=$i++;  }

}
$report='Your message was successfully sent: '.$e.' contacts';
return; 
}


   

function SendMail2(){
    global $db, $report,$signup;
$message=$_POST['msg'];
$subject=$_POST['subject'];
$rec = $_POST['rec'];
$rec2 = explode(',', $rec);
$count = count($rec2);

$i=0; 

    while($i<$count){$e=$i++;    $email = trim($rec2[$e]);
if($email !=''){$this->emailerAll($email,$message,$subject);  }

}
$report='Your message was successfully sent: '.$e.' contacts';
return; 
}




    function productHit($item){
        global $db;
        $sql = $db->query("SELECT * FROM newsales WHERE item='$item' ");
        return $sql->num_rows;
    }

        function countLevelUsers($lev){
        global $db;
        $sql = $db->query("SELECT * FROM user WHERE level = '$lev' ");
        return $sql->num_rows;
    }

  

    function team1($key)
    {
        global $db;


        $sql = $db->query("SELECT * FROM user WHERE a1='$key' OR a2='$key' ") or die(mysqli_error());

        $head = $sql->num_rows;

        return $head;
    }
 


function stageUpdate($key){
global $db;//

$i=1; 
   $sql = $db->query("SELECT * FROM matuser WHERE sn='$key' ");
    $row=mysqli_fetch_assoc($sql); 
    while($i <= 10) { $e=$i++;  $a = 'a'.$e;  $b = 'b'.$e;
      $keya = $row[$a];  $keyb = $row[$b];
if($this->leadershipTeam($keya)>9 AND $keya>0){$this->promoteUser($keya); }
if($this->leadershipTeam($keyb)>9 AND $keyb>0){$this->promoteUser($keyb); }
}
return;
}


    function uName($id, $col = 'user')
    {
        global $db;

        $que = $db->query("SELECT * FROM user WHERE id = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }

    function uNameUser($user, $col = 'user')
    {
        global $db;

        $que = $db->query("SELECT * FROM user WHERE user = '$user' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }

    function courseName($id, $col = 'title')
    {
        global $db;

        $que = $db->query("SELECT * FROM course WHERE sn = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }


    function chartMonth()
    {
        $range = '';
        $cm = date('m');
        $a = $cm - 5;
        while ($a <= $cm) {
            $b = $a++;
            $c = date("M", mktime(0, 0, 0, $b, 10));
            $range .= "'" . $c . "', ";
        }
        return $range;
    }


//chart data of total entry per 
    function monthEntryData()
    {
        $range = '';
        $cm = date('m');
        $a = $cm - 5;
        while ($a <= $cm) {
            $b = $a++;
            $c = $this->monthDownlines($b);
            $range .= $c . ', ';
        }

        return $range;
    }


//chart data of total entry per 
    function monthChartData()
    {
        $range = '';
        $cm = date('m');
        $a = $cm - 5;
        while ($a <= $cm) {
            $b = $a++;
            $c = $this->monthlyRegistered($b);
            $range .= $c . ', ';
        }

        return $range;
    }


    //chart data of total entry per 
    function monthEntryDataTotal()
    {
        $range = '';
        $cm = date('m');
        $a = $cm - 5;
        while ($a <= $cm) {
            $b = $a++;
            $c = $this->entryPerMonth($b);
            $range .= $c . ', ';
        }

        return $range;
    }


//chart data of user monthly sponsor
    function monthUserSponsor()
    {
        $range = '';
        $cm = date('m');
        $a = $cm - 5;
        while ($a <= $cm) {
            $b = $a++;
            $c = $this->sponsorPerMonth($b);
            $range .= $c . ', ';
        }

        return $range;
    }


    //chart data of user monthly sponsor
    function monthUserInducted()
    {
        $range = '';
        $cm = date('m');
        $a = $cm - 5;
        while ($a <= $cm) {
            $b = $a++;
            $c = $this->inductedPerMonth($b);
            $range .= $c . ', ';
        }

        return $range;
    }

//maximum monthly entry// $tim = max(explode(",", $profile->monthUserSponsor()));
    function maxMonthly()
    {
        $max = max(explode(",", $this->monthEntryData()));
        return $max;
    }


    function maxMonthlyAll()
    {
        $max = max(explode(",", $this->monthChartData()));
        return $max;
    }


    //maximum monthly entry total for all users //
    function maxMonthlyTotal()
    {
        $max = max(explode(",", $this->monthEntryDataTotal()));
        return $max;
    }

//Calculate total monthly entry
    function entryPerMonth($month)
    {
        global $db;
        $num = 0;
        $sql = $db->query("select * FROM user ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($sql)) {
            $tim = (int)substr($row['created'], 5, 2);
            if ($tim == $month) {
                $num += 1;
            }
        }
        return $num;
    }


    function monthDownlines($month)
    {
        global $db, $userKey;
        $randomKey = $this->userName('sn');
        $a = 1;
        $num = 0;
        while ($a <= 16) {
            $b = $a++;
            $gen = 'a' . $b;
            $sql = $db->query("SELECT * FROM user WHERE $gen = '$randomKey' ") or die(mysqli_error());
            while ($row = mysqli_fetch_assoc($sql)) {
                $tim = (int)substr($row['created'], 5, 2);
                if ($tim == $month) {
                    $num += 1;
                }
            }
        }
        return $num;
    }

    function LogoutUser()
    {
if(isset($_SESSION['user_idx'])){
        $_SESSION['user_idx'] == ''; }
        session_destroy();
if(isset($_COOKIE['muser'])){
setcookie('muser', $email, 86400, "/");
setcookie('mpass', $password, 86400, "/");
}
        header('location: login.php#');
        return;
    }

    function LogoutUserTimeout()
    {
if(isset($_SESSION['user_idx'])){
        $_SESSION['user_idx'] == ''; }
        session_destroy();
        header('location: login.php#');
        return;
    }

function accountExist($userid){
        global $db;
    $sql=$db->query("SELECT * FROM user WHERE id = '$userid' " )or die(mysqli_error());
if(mysqli_num_rows($sql)==0){ $this->LogoutUser(); }
return;
    }


    function monthlyRegistered($month)
    {
        global $db;

        $num = 0;

        $sql = $db->query("SELECT * FROM user ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($sql)) {
            $tim = (int)substr($row['created'], 5, 2);
            if ($tim == $month) {
                $num += 1;
            }
        }

        return $num;
    }


//Calculate the amunt of members sponsored by a user monthly
    function sponsorPerMonth($month)
    {
        global $db;
        $randomKey = $this->userName('sn');
        $num = 0;
        $sql = $db->query("SELECT * FROM user WHERE sponsor = '$randomKey' ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($sql)) {
            $tim = (int)substr($row['created'], 5, 2);
            if ($tim == $month) {
                $num += 1;
            }
        }
        return $num;
    }

   
//Count all registered users
    function allUsers()
    {
        global $db;
        $sql = $db->query("SELECT * FROM user ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        return $num;
    }



function profileType($type){
    $rem = '';
if($type==1){$rem='Email Verification'; }
elseif($type==2){$rem='Phone Number Verification'; }
elseif($type==3){$rem='Bank Account Details'; }
elseif($type==4){$rem='Passport Photograph'; }
elseif($type==5){$rem='Means of Identification'; }
elseif($type==6){$rem='BVN Verification'; }
elseif($type==7){$rem='Educational Qualification'; }
elseif($type==8){$rem='Payment Method Verification'; }
elseif($type==9){$rem='Facebook Linked'; }

}


        function updateBankAcc()
    {
        global $db, $report, $count,$userKey;
        
        $id=$this->Uid();
        $accname = sanitize($_POST['accname']);
        $accno = sanitize($_POST['accno']);
        $bank = sanitize($_POST['bank']);
        $type = 2;
        $data = $bank.','.$accno.','.$accname;
if(sqL1('user2','data',$data)==0){
        $sql = $db->query("INSERT INTO user2 (id,data,type) VALUES('$id','$data','$type') ");
        $db->query("UPDATE user SET bank='$bank', accountno='$accno', accname='$accname', WHERE id='$id' ");
  if ($sql) { $report = 'Profile Information Successfully Updated!'; } 
         }
         else {
            $report = 'Operation not Successful!';
            $count = 1;
        }
        return;

    }

    function levelUsers($level)
    {
        global $db;
        $count = 0;
        $qu = $db->query("SELECT * FROM user ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($qu)) {
            if ($level == $this->wildLevel2($row['sn'])) {
                $count += 1;
            }
        }
        return $count;
    }


    function stageUsers($stage)
    {
        global $db;
        $count = 0;
        $qu = $db->query("SELECT * FROM user WHERE st1=1") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($qu)) {
            if ($stage == $this->wildLevel2($row['sn'], 2)) {
                $count += 1;
            }
        }
        return $count;
    }


    function allPins()
    {
        global $db;
        $count = 0;
        $qu = $db->query("SELECT * FROM pin ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($qu)) {
            $count += 1;
        }
        return $count;
    }


    function activePins()
    {
        global $db;
        $count = 0;
        $qu = $db->query("SELECT * FROM pin WHERE status=0 ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($qu)) {
            $count += 1;
        }
        return $count;
    }


    function sendMessage()
    {
        global $userKey, $report;
        $message = addslashes($_POST['message']);
        $subject = addslashes($_POST['subject']);

        $this->message('Admin', $userKey, $message, $subject);
        $report = 'Your message was successfully sent';
        return;
    }

    function sendMessageToAll()
    {
        global $report;
        $message = addslashes($_POST['message']);
        $subject = addslashes($_POST['subject']);

        $this->message(1, 'Admin', $message, $subject);
        $report = 'Your message was successfully sent to all members';
        return;
    }




function userPhoto($userid){
                global $db;
                
            $que=$db->query("SELECT * FROM user2 WHERE id = '$userid' AND type=1 " )or die(mysqli_error());
                    $ro=mysqli_fetch_array($que);
                    if(isset($ro['card'])){ 
                return htmlspecialchars($ro['card']);
            }else{return 'user.png';}
}



function refEarn($id){

    return $this->wallet($id,20);
}

function matEarn($id){

    return 0;//$this->walletRange($id,11,15);
}

function salesEarn($id){

    return $this->walletRange($id,21,23);
}
function totalEarn($id){

    return $this->walletRange($id,21,52);
}
function nBalance($id){

    return $this->totalEarn($id)-$this->userWithdraw($id);
}


function monthlySales($idx,$mm){
    global $db;
    $amt =0;
    $sql = $db->query("SELECT * FROM newsales WHERE b1='$idx' AND amount>0  ");
    while($row = mysqli_fetch_assoc($sql)){ $date = date('Ym', $row['ctime']); 
        $amt += $mm==$date ? $row['amount'] : 0;
    }
        
        return $amt; 
}

function totalSales($idx){
    global $db;
    $amt =0;
    $sql = $db->query("SELECT * FROM newsales WHERE b1='$idx' AND amount>0  ");
    while($row = mysqli_fetch_assoc($sql)){
        $amt += $row['amount'] ;
    }
        
        return $amt; 
}
function totalPurchase($id){
    // global $db;
    // $amt =0;
    // $sql = $db->query("SELECT * FROM newsales WHERE id='$id' AND amount>0  ");
    // while($row = mysqli_fetch_assoc($sql)){
    //     $amt += $row['amount'] ;
    // }
        
        return $this->walletRange($id,3,7); 
}


function monthlyWallet($id,$mm){
    global $db;
    $amt =0;
    $sql = $db->query("SELECT * FROM ewalletx WHERE id='$id' ");
    while($row = mysqli_fetch_assoc($sql)){ $date = date('Ym', $row['ctime']); 
        $amt += $mm==$date ? $row['cos'] : 0;
    }
        
        return $amt; 
}


    function wallet($id,$opt=0)
    {
        global $db;
        $amt = 0;
        $sql = ($opt==0) ? $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND (status=5 OR type<6) ") : $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND status=5 AND type='$opt' ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum']??0;
   
        return $amt;
    }

    function walletNoStatus($id,$opt)
    {
        global $db;
        $amt = 0;
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND type='$opt' ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }
    function walletProNoStatus($id,$opt)
    {
        global $db;
        $amt = 0;
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM ewalletpro WHERE id = '$id' AND type='$opt' ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }

    function lastWalletDate($uid,$type,$st=2){ global $db;
$sql = $st==1 ? $db->query("SELECT * FROM ewalletx WHERE id='$uid' AND type='$type' ORDER BY sn ASC LIMIT 1 ") : $db->query("SELECT * FROM ewalletx WHERE id='$uid' AND type='$type' ORDER BY sn DESC LIMIT 1 ");
               $row = mysqli_fetch_assoc($sql);
               return $row['created'];
            }

    function lastRangeDate($uid,$r1,$r2){ global $db;
$sql = $db->query("SELECT * FROM ewalletx WHERE id='$uid' AND type BETWEEN '$r1' AND '$r2' ORDER BY sn DESC LIMIT 1 ");
               $row = mysqli_fetch_assoc($sql);
               return $row['created'];
            }
    function lastProRangeDate($uid,$r1,$r2){ global $db;
$sql = $db->query("SELECT * FROM ewalletpro WHERE id='$uid' AND type BETWEEN '$r1' AND '$r2' ORDER BY sn DESC LIMIT 1 ");
               $row = mysqli_fetch_assoc($sql);
               return $row['created'];
            }

    function lastWalletProDate($uid,$type,$st=2){ global $db;
$sql = $st==1 ? $db->query("SELECT * FROM ewalletpro WHERE id='$uid' AND type='$type' ORDER BY sn ASC LIMIT 1 ") : $db->query("SELECT * FROM ewalletpro WHERE id='$uid' AND type='$type' ORDER BY sn DESC LIMIT 1 ");
               $row = mysqli_fetch_assoc($sql);
               return $row['created'];
            }


    function countWallet($id,$opt)
    {
        global $db;
        
        $sql = $db->query("SELECT * FROM ewalletx WHERE id = '$id' AND type='$opt' ");
        $no = mysqli_num_rows($sql); 
        return $no;
    }
    function countWalletRange($id,$r1,$r2)
    {
        global $db;
        
        $sql = $db->query("SELECT * FROM ewalletx WHERE id = '$id' AND type BETWEEN '$r1' AND '$r2' ");
        $no = mysqli_num_rows($sql); 
        return $no;
    }
    function countWalletProRange($id,$r1,$r2)
    {
        global $db;
        
        $sql = $db->query("SELECT * FROM ewalletpro WHERE id = '$id' AND type BETWEEN '$r1' AND '$r2' ");
        $no = mysqli_num_rows($sql); 
        return $no;
    }


    function countWalletPro($id,$opt)
    {
        global $db;
        
        $sql = $db->query("SELECT * FROM ewalletpro WHERE id = '$id' AND type='$opt' ");
        $no = mysqli_num_rows($sql); 
        return $no;
    }


function totalEarned($uid){
  return $this->walletRange($uid,21,90)+$this->walletRange($uid,111,116)+$this->walletProRange($uid,41,55);
}

function totalPv($uid){
  return ceil($this->totalEarned($uid)/1000);
}

    function earnedThisMonth($id)
    {
        global $db;
        $mm = date('ym');
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND type>20 AND mm='$mm' ");
        $row = mysqli_fetch_assoc($sql);
        $sql2 = $db->query("SELECT SUM(cos) AS value_sum FROM ewalletpro WHERE id = '$id' AND type>20 AND mm='$mm' ");
        $row2 = mysqli_fetch_assoc($sql2);
       
   
        return $row2['value_sum'] + $row['value_sum'];
    }

    function walletPro($id,$opt=0)
    {
        global $db;
        $amt = 0;
        $sql = ($opt==0) ? $db->query("SELECT SUM(cos) AS value_sum FROM ewalletpro WHERE id = '$id' ") : $db->query("SELECT SUM(cos) AS value_sum FROM ewalletpro WHERE id = '$id' AND type='$opt' ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }

    function walletPv($id)
    {
        global $db;
        $amt = 0;
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM ewalletpro WHERE id = '$id' AND (cos>0 OR type=2) ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }
    function walletLost($id,$opt=0)
    {
        global $db;
        $amt = 0;
        $sql = ($opt==0) ? $db->query("SELECT SUM(cos) AS value_sum FROM lostcredit WHERE id = '$id' ") : $db->query("SELECT SUM(cos) AS value_sum FROM lostcredit WHERE id = '$id' AND type='$opt' ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }
    function walletLostAll($opt=0)
    {
        global $db;
        $amt = 0;
        $sql = ($opt==0) ? $db->query("SELECT SUM(cos) AS value_sum FROM lostcredit ") : $db->query("SELECT SUM(cos) AS value_sum FROM lostcredit WHERE type='$opt' ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }

    function walletAll($opt=0)
    {
        global $db;
        $amt = 0;
        $sql = ($opt==0) ? $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE status=5 OR type<6 ") : $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE status=5 AND type='$opt' ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }
    function walletRange($id,$r1,$r2)
    {
        global $db;
        $amt = 0;
        $sql =  $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND type BETWEEN $r1 AND $r2 ") ;//status removed
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }     

    function walletProRange($id,$r1,$r2)
    {
        global $db;
        $amt = 0;
        $sql =  $db->query("SELECT SUM(cos) AS value_sum FROM ewalletpro WHERE id = '$id' AND type BETWEEN $r1 AND $r2 ") ;//status removed
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }     

    function walletRangeAll($r1,$r2)
    {
        global $db;
        $amt = 0;
        $sql =  $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE status=5 AND type BETWEEN $r1 AND $r2 ") ;
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }    

    function walletPending($id,$r1,$r2)
    {
        global $db;
        $amt = 0;
        $sql =  $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND status<5 AND type BETWEEN $r1 AND $r2 ") ;
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }

    function walletPendingAll($r1,$r2)
    {
        global $db;
        $amt = 0;
        $sql =  $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE status<5 AND type BETWEEN $r1 AND $r2 ") ;
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }

        function wallet2($id,$opt=0)
    {
        global $db;
        $amt = 0;
        $sql = ($opt==0) ? $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' ") : $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND type='$opt' ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }

    function userPins($id,$opt=0)
    {
        global $db;
        $sql = $db->query("SELECT * FROM pin WHERE tm = 3 AND rep='$id' AND status='$opt' ");
        return mysqli_num_rows($sql);
    }

    function walletcredit($id)
    {
        global $db;
        $amt = 0;
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND type>=6 ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }

function getIncentive($uid,$opt=1){
    global $db;
    $total = $this->walletPv($uid);
    $sql = $db->query("SELECT * FROM incentive WHERE cumm >= '$total' ORDER BY sn ASC LIMIT 1 ");
    $row = mysqli_fetch_assoc($sql);
    $type = $row['status']=='2' ? ' | Cash' : ' | Pack';
    $bal = $row['cost']-($row['cumm']-$total);
    $per = $bal*100/$row['cost'];
    if($opt==1){$res= $row['title']; }elseif($opt==2){$res=$total;}
    elseif($opt==3){$res=$bal;}elseif($opt==4){$res=$per;}elseif($opt==5){$res=$row['cost'];}elseif($opt==6){$res=$row['sn'];}elseif($opt==7){$res=$type;}
    return $res;
}

function claimAward($award){
  global $db;
  $id = $this->Uid();
  $amount = sqLx('incentive','sn',$award,'cost');
  $title = sqLx('incentive','sn',$award,'title');
  $status = sqLx('incentive','sn',$award,'status');
  $type = sqLx('incentive','sn',$award,'status');
  $ctime = $type==2 ? time() : 0;
  $wtype = $award+90;

  if(sqL2('award','id',$id,'award',$award)==0){
$sql = $db->query("INSERT INTO award (id,award,amount,title,type,status,ctime) VALUES ('$id','$award','$amount','$title','$type','$status','$ctime') ");
if($type==2 AND sqL2('ewalletx','id',$id,'type',$wtype)==0){
$this->walletProcessPro($id,$amount,5,1,$title.' Award',$type); 
$this->walletProcess($id,$amount,4,$wtype,$title.' Award',$type); 
}
}
 $res = $type==2 ? 'Your wallet has been funded with the sum of '.NAIRA.number_format($amount,2) : 'Your award will be processed and delivered to you as soon as possible';
//  $phone = userName($id,'whatsapp');
//if(userName($id,'activewa')==1){sendWhatsapp($phone, $res); }
  $this->addNotice($id,'Award Successfully Claimed',$res);
 return $res;
}

    function orderPending($id)
    {
        global $db;
        //$amt = 0;
        $sql = $db->query("SELECT * FROM walletorder WHERE id = '$id' AND status<5 ");
       //$row = mysqli_fetch_assoc($sql);
        
       return mysqli_num_rows($sql);
    }

    function walletdebit($id)
    {
        global $db;
        $amt = 0;
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND type<=5 ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return $amt;
    }



    function walletStatus($status)
    {
        if($status==5){$r='<font color="green"> Complete</font>'; }
        elseif($status==1 OR $status==0){$r='<font color="red">Awaiting Confirmation</font>'; }
        elseif($status==2){$r='<font color="blue"> Processing...</font>'; }
        elseif($status==3){$r='<font color="red">Investigating...</font>'; }
        elseif($status==4){$r='<font color="#036">Bonus</font>'; }
        else{$r='Pending';}
   
        return $r;
    }    


//increase debit to 40 (1-40) and credit to 100 (41-100)
    function walletRemark($code)
    {   $r='';
    //Debits all types
            if($code==1){$r='Cash Withdrawal'; }
        elseif($code==2){$r='Fund Transfered'; }
        elseif($code==3){$r='Product/Service Purchase'; }
        elseif($code==4){$r='Prime Vault Deposit'; }
        elseif($code==5){$r='Transaction Charges'; }
        elseif($code==6){$r='Membership Upgrade Fee'; }
        elseif($code==7){$r='Topup purchase'; }
        elseif($code==8){$r='Wallet Deduction by Admin'; }
        elseif($code==9){$r='Incentive Funding'; }
        elseif($code==10){$r='Bank Transfer'; }
        //Other Debit relating to other products
        elseif($code==11){$r=''; }
        elseif($code==12){$r=''; }
        elseif($code==13){$r=''; }
        elseif($code==14){$r=''; }
        elseif($code==15){$r=''; }
        //Credit: Wallet Funding
        elseif($code==16){$r='Wallet Funding by Admin'; }        
        elseif($code==17){$r='Wallet funding by bank deposit'; }
        elseif($code==18){$r='Wallet funding by card'; }
        elseif($code==19){$r='Fund Received'; }
        elseif($code==20){$r='Investment Capital Retrieval'; }
        //Credit: Sales Commission
        elseif($code==21){$r='G1 Sales Commission'; }
        elseif($code==22){$r='G2 Sales Commission'; }
        elseif($code==23){$r='G3 Sales Commission'; }
        elseif($code==24){$r='G4 Sales Commission'; }
        elseif($code==25){$r='G5 Sales Commission'; }
        elseif($code==26){$r='Purchase cashback'; }
        elseif($code==27){$r=''; }
        elseif($code==28){$r='RPV Promotional Offer'; }
        elseif($code==29){$r='SPV Promotional Offer'; }
        elseif($code==30){$r='Return on Investment'; }
        //Credit: Wages, Ownership Fund, Mentors Commission
        elseif($code==31){$r='Product Ownership Earnings'; }//earnings on users products like trainings
        elseif($code==32){$r='Product Mentorship'; }//10% for sponsors of product owner
        elseif($code==33){$r=''; }
        elseif($code==34){$r=''; }
        elseif($code==35){$r=''; }
        elseif($code==36){$r=''; }
        elseif($code==37){$r=''; }
        elseif($code==38){$r=''; }
        elseif($code==39){$r=''; }
        elseif($code==40){$r=''; }

        //Matrix Bonuses
        elseif($code==41){$r='G1 Referral Bonus'; }
        elseif($code==42){$r='G2 Referral Bonus'; }
        elseif($code==43){$r='G3 Referral Bonus'; }
        elseif($code==44){$r='G4 Referral Bonus'; }
        elseif($code==45){$r='G5 Referral Bonus'; }
        elseif($code==46){$r='G6 Referral Bonus'; }
        elseif($code==47){$r='G7 Referral Bonus'; }
        elseif($code==48){$r='G8 Referral Bonus'; }
        elseif($code==49){$r='G9 Referral Bonus'; }
        elseif($code==50){$r='G10 Referral Bonus'; }

        elseif($code==51){$r='G1 Spillover Bonus'; }
        elseif($code==52){$r='G2 Spillover Bonus'; }
        elseif($code==53){$r='G3 Spillover Bonus'; }
        elseif($code==54){$r='G4 Spillover Bonus'; }
        elseif($code==55){$r='G5 Spillover Bonus'; }
        elseif($code==56){$r=''; }
        elseif($code==57){$r=''; }
        elseif($code==58){$r=''; }
        elseif($code==59){$r=''; }
        elseif($code==60){$r=''; }
        //Leadership Bonuses
        elseif($code==81){$r=''; }
        elseif($code==82){$r=''; }
        elseif($code==83){$r='District Manager Leadership Bonus'; }
        elseif($code==84){$r='Seniour Manager Leadership Bonus'; }
        elseif($code==85){$r='Regional Director Leadership Bonus'; }
        elseif($code==86){$r='Regional Vice President Leadership Bonus'; }
        elseif($code==87){$r='Senior Vice President Leadership Bonus'; }
        elseif($code==88){$r=''; }
        elseif($code==89){$r=''; }
        elseif($code==90){$r='Global Pool Payout'; }
        //Incentive Bonuses
        elseif($code==91){$r='1st Incentive Bonus'; }
        elseif($code==92){$r='2nd Incentive Bonus'; }
        elseif($code==93){$r='3rd Incentive Bonus'; }
        elseif($code==94){$r='4th Incentive Bonus'; }
        elseif($code==95){$r='5th Incentive Bonus'; }
        elseif($code==96){$r='6th Incentive Bonus'; }
        elseif($code==97){$r='7th Incentive Bonus'; }
        elseif($code==98){$r='8th Incentive Bonus'; }
        elseif($code==99){$r='9th Incentive Bonus'; }
        elseif($code==100){$r='10th Incentive Bonus'; }
        elseif($code==101){$r='11th Incentive Bonus'; }
        elseif($code==102){$r='12th Incentive Bonus'; }
        elseif($code==103){$r='13th Incentive Bonus'; }
        elseif($code==104){$r='14th Incentive Bonus'; }
        elseif($code==105){$r='15th Incentive Bonus'; }
        elseif($code==106){$r='16th Incentive Bonus'; }
        elseif($code==107){$r='17th Incentive Bonus'; }
        elseif($code==108){$r='18th Incentive Bonus'; }
        elseif($code==109){$r='19th Incentive Bonus'; }
        elseif($code==110){$r='20th Incentive Bonus'; }
        //Equity Bonuses
        elseif($code==111){$r='Diamond Equity Bonus'; }
        elseif($code==112){$r='Double Diamond Equity Bonus'; }
        elseif($code==113){$r='Prime Diamond Equity Bonus'; }
        elseif($code==114){$r='Emerald Equity Bonus'; }
        elseif($code==115){$r='Double Emerald Equity Bonus'; }
        elseif($code==116){$r='Prime Emerald Equity Bonus'; }
        
               
        return $r;
    }

function payDiamond(){
  $totalshare = '';
  $shareholders='';
  $bonus = $totalshare/$shareholders; 
  $sql='';//list
  while($row=mysqli_fetch_assoc($sql)){
    //$walletProcess($id,$bonus);
  }
}

  function invoiceRemark($code)
    {   $r='';
    //Topup Services
            if($code==1){$r='Airtime'; }
        elseif($code==2){$r='Direct Data'; }
        elseif($code==3){$r='SME Data'; }
        elseif($code==4){$r='Cable TV'; }
        elseif($code==5){$r='Electricity'; }
        //Fund Transfer
        elseif($code==6){$r='Wallet Transfer'; }
        elseif($code==7){$r='Bank Transfer'; }
        elseif($code==8){$r=''; }
        elseif($code==9){$r=''; }
        elseif($code==10){$r=''; }
        //Package Upgrade
        elseif($code==11){$r=''; }
        elseif($code==12){$r=''; }
        elseif($code==13){$r=''; }
        elseif($code==14){$r=''; }
        elseif($code==15){$r=''; }
        //Something Else
        elseif($code==16){$r=''; }        
        elseif($code==17){$r=''; }
        elseif($code==18){$r=''; }
        elseif($code==19){$r=''; }
        elseif($code==20){$r=''; }
               
        return $r;
    }

    function serviceStatus($status)
    {
            if($status==1){$r='<font color="blue">Active</font>'; }
        elseif($status==2){$r='<font color="#036">Warning</font>'; }
        elseif($status==3){$r='<font color="red">Expired</font>'; }
        else{$r='Suspended';}
   
        return $r;
    }

    function processIncent($id,$incent,$status,$type,$remark){
        global $db;
        $ctime = time();

        $trno = $this->win_hash(12);
        $sql = $db->query("INSERT INTO incentive (id,trno,stage,status,incentive,remark,ctime) VALUES ('$id','$trno','$type','$status','$incent','$remark','$ctime') ");   
        return;
    }


  function walletProcess($id,$amt,$status,$type,$remark,$opt=''){
        global $db,$report;
       // if($status>20 AND $status<29){$status=4;}
        $rep = $this->Uid();
        $ctime = time();
        $sin = $this->wallet($id);
        $amt = ($type>10) ? $amt : '-'.$amt;
        $agent = $_COOKIE['agent']??'';
        $tan = $sin+$amt;
        $trno = $this->win_hash(11);
       // $opt = $opt=='' ? $trno : $opt;
        $mm = date('ym');
         if(empty($id) OR $id=='' OR $amt==0){}else{
        $sql = $db->query("INSERT INTO ewalletx (id,trno,sin,cos,tan,type,status,remark,ctime,mm,rep,opt,agent) VALUES ('$id','$trno','$sin','$amt','$tan','$type','$status','$remark','$ctime','$mm','$rep','$opt','$agent') ");  
        if($sql){$report = 'Transaction successfully processed';
        $tan = $this->wallet($id);
       $note=''; $msg= '';
        $msg1= ($type>10) ? '*Credit Alert ['.userName($id,'sn').']*' : '*Debit Alert ['.userName($id,'sn').']*';
        $msg1=($type>20 AND $type<30) ? '*Bonus Alert ['.userName($id,'sn').']*' : $msg1;
        //$msg .= ' Hello '.userName($id).'! ';
        if($type<=10){$note .= $msg .= ' You performed a debit transaction of '.NAIRA.number_format(abs($amt),2). '. Remark: '.$remark ; }
        elseif($type<20){$note .= $msg .= ' A transaction was carried out on your account. Amount: '.NAIRA.number_format(abs($amt),2).'. Remark: '.$remark ; }
     else{ $you = $id==$rep ? ' You just' : ' Your team performed a transaction and you';
        $note .= $msg .= $you.' earned a profit of '.NAIRA.number_format(abs($amt),2).'. Remark: '.$remark ; }

        $msg .= '. Balance: '.NAIRA.number_format($tan,2).'. Reference: '.$trno;
        $phone = userName($id,'whatsapp');

        $title = $this->walletRemark($type);
         $this->addNotice($id,$title,$note); //Add notification
        //if(userName($id,'activewa')==1){sendWhatsapp($phone, $msg1.$msg); }
        
         }
        } 
      
        return;
    }


function createNewInvoice($id,$amount,$type,$remark,$recnumber,$productcode,$biller='',$opt=''){
        global $db,$report;
        $rep = $this->Uid();
        $ctime = time();
        $agent = $_COOKIE['agent']??'';
       $ref = $this->win_hash(12);
    
        $mm = date('ym');
         if(empty($id) OR $amount==0){}else{
        $sql = $db->query("INSERT INTO invoice (id,ref,amount,type,recnumber,biller,productcode,remark,ctime,mm,billto,rep,opt,agent) VALUES ('$id','$ref','$amount','$type','$recnumber','$biller','$productcode','$remark','$ctime','$mm','$id','$rep','$opt','$agent') ");  
        if($sql){$report = 'Invoice successfully created';  }
       
        } 
      
        return;
    }


function invoiceAction($ref){
global $topup;
    $amount = $this->invoiceName($ref);
    $id = $this->invoiceName($ref,'id');
    $type = $this->invoiceName($ref,'type');
    $type2 = $type<=5 ? 7 : 9;
    $remark = $this->invoiceName($ref,'remark');
    $recnumber = $this->invoiceName($ref,'recnumber');
    $productcode = $this->invoiceName($ref,'productcode');
  
   //$this->billShare($type,$amount)
}


function BuyAirtime(){
    global $report,$count;
    $uid = $this->Uid();
    $amount = $_POST['amount'];
    $productcode = $_POST['productcode'];
    $recnumber = $_POST['phone'];
    $bal = $this->wallet($uid);
if(strlen($recnumber) != 11){$report = 'Invalid Phone Number'; $count=1;}
elseif($amount<100){$report = 'Invalid Amount. Minimum is N100'; $count=1;}
elseif($bal<$amount){$report = 'You Insufficient Balance. You need additional N'.number_format($amount-$bal).'<br> <a href="#" data-toggle="modal" data-target="#depositActionSheet" class="btn btn-sm btn-primary">Fund Wallet</a>'; $count=1;}
elseif($bal>=$amount){
$this->billAndShare($uid,1,$amount,$recnumber,$productcode);
$report='Airtime Topup Transaction Completed ';
}
return;
}

function BuyData(){
    global $report,$count;
    $uid = $this->Uid();
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $productcode = $_POST['productcode'];
    $recnumber = $_POST['phone'];
    $bal = $this->wallet($uid);
if(strlen($recnumber) != 11){$report = 'Invalid Phone Number'; $count=1;}
elseif($amount<100){$report = 'Invalid Amount. Minimum is N100'; $count=1;}
elseif($bal<$amount){$report = 'You Insufficient Balance. You need additional N'.number_format($amount-$bal).'<br> <a href="#" data-toggle="modal" data-target="#depositActionSheet" class="btn btn-sm btn-primary">Fund Wallet</a>'; $count=1;}
elseif($bal>=$amount){
$this->billAndShare($uid,$type,$amount,$recnumber,$productcode);
$report='Data topup Transaction Completed ';
}
return;
}

function BuyElectric(){
    global $report,$count;
    $uid = $this->Uid();
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $productcode = $_POST['productcode'];
    $recnumber = $_POST['meter'];
    $bal = $this->wallet($uid);
if(strlen($recnumber) != 11){$report = 'Invalid Phone Number'; $count=1;}
elseif($amount<100){$report = 'Invalid Amount. Minimum is N100'; $count=1;}
elseif($bal<$amount){$report = 'You Insufficient Balance. You need additional N'.number_format($amount-$bal).'<br> <a href="#" data-toggle="modal" data-target="#depositActionSheet" class="btn btn-sm btn-primary">Fund Wallet</a>'; $count=1;}
elseif($bal>=$amount){
$this->billAndShare($uid,$type,$amount,$recnumber,$productcode);
$report='Electricity Bill Transaction Completed ';
}
return;
}



function BuyCable(){
    global $report,$count;
    $uid = $this->Uid();
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $productcode = $_POST['productcode'];
    $recnumber = $_POST['smartcard'];
    $bal = $this->wallet($uid);
if(strlen($recnumber) != 11){$report = 'Invalid Phone Number'; $count=1;}
elseif($amount<100){$report = 'Invalid Amount. Minimum is N100'; $count=1;}
elseif($bal<$amount){$report = 'You Insufficient Balance. You need additional N'.number_format($amount-$bal).'<br> <a href="#" data-toggle="modal" data-target="#depositActionSheet" class="btn btn-sm btn-primary">Fund Wallet</a>'; $count=1;}
elseif($bal>=$amount){
$this->billAndShare($uid,$type,$amount,$recnumber,$productcode);
$report='Cable TV Bill Transaction Completed ';
}
return;
}

function billAndShare($uid,$type,$amount,$recnumber,$productcode){
global $topup;
    if($type==1){ $recharge = $topup->airtime($amount, $recnumber, $productcode); }
    elseif($type==2){ $recharge = $topup->directData($recnumber, $productcode); }
    elseif($type==3){ $recharge = $topup->dataShare($recnumber, $productcode); }
    elseif($type==4){ $recharge = $topup->cable($recnumber, $productcode); }
    elseif($type==5){ $recharge = $topup->electric($amount, $recnumber, $productcode); }

//  $sid1 = $this->userUplineId($uid);
//  $sid2 = $this->userUplineId($sid1);
//  $sid3 = $this->userUplineId($sid2);
//  $sid4 = $this->userUplineId($sid3);
//  $sid5 = $this->userUplineId($sid4);
$recharge_id = $recharge['data']['recharge_id'];
$server_message = $recharge['text_status'];
$remark = $this->invoiceRemark($type);

if($type<=2){ $bonus = 0.03*$amount;  $commission = 0.003*$amount;  }
elseif($type==3){ $bonus = 0.25*$amount;  $commission = 0.03*$amount;  }
else{ $bonus = 0;  $commission = 0.003*$amount;  }
$this->walletProcess($uid,$amount,5,7,$remark.' for '.$recnumber,$recharge_id.', '.$server_message);

             $this->walletProcess($uid,$bonus,4,26,'Purchase Cashback',$recharge_id);   //
            //  $this->walletProcess($sid1,$commission,4,21,'G1 Sales commission',$recharge_id);
            //  $this->walletProcess($sid2,$commission,4,22,'G2 Sales commission',$recharge_id);
            //  $this->walletProcess($sid3,$commission,4,23,'G3 Sales commission',$recharge_id);
            //  $this->walletProcess($sid4,$commission,4,24,'G4 Sales commission',$recharge_id);
            //  $this->walletProcess($sid5,$commission,4,25,'G5 Sales commission',$recharge_id);
if($server_message=='COMPLETED'){
  $rem = $remark.' for '.$recnumber;
  $phone = userName($uid,'whatsapp');
  notifyTopupSuccess($uid,$amount,$rem);
   } 
return;
}


function addNotice($id,$title,$note){
    global $db;
    $db->query("INSERT INTO notice (id,title,note) VALUES('$id','$title','$note') ");
    return;
}


  function walletProcessPro($id,$amt,$status,$type,$remark,$opt=''){
        global $db,$report;
  //$status=5;
        $rep = $this->Uid();
        $ctime = time();
        $sin = $this->walletPro($id);
        $amt = ($type>10) ? $amt : '-'.$amt;
        $agent = $_COOKIE['agent']??'';
        $tan = $sin+$amt;
        $trno = $this->win_hash(11);
       // $opt = $opt=='' ? $trno : $opt;
        $mm = date('ym');
         if(empty($id) OR $id=='' OR $amt==0){}else{
        $sql = $db->query("INSERT INTO ewalletpro (id,trno,sin,cos,tan,type,status,remark,ctime,mm,rep,opt,agent) VALUES ('$id','$trno','$sin','$amt','$tan','$type','$status','$remark','$ctime','$mm','$rep','$opt','$agent') ");  
        if($sql){$report = 'Transaction successfully processed';

        $tan = $this->walletPro($id);
        $note=''; $msg= '';
        $msg1= ($type>10) ? '*Bonus Alert ['.userName($id,'sn').']*' : '*Debit Alert ['.userName($id,'sn').']*';
        //$msg .= ' Hello '.userName($id).'! ';
        if($type<=10){$note .= $msg .= ' You performed a debit transaction of '.NAIRA.number_format(abs($amt),2). '. Remark: '.$remark ; }
     else{ $you = ' Your team';
        $note .= $msg .= $you.' performed a transaction and you earned a profit of '.NAIRA.number_format(abs($amt),2).'. Remark: '.$remark ; }
       

        $msg .= '. RPV Balance: '.NAIRA.number_format($tan).'. Reference: '.$trno;
        $phone = userName($id,'whatsapp');

        $title = $this->walletRemark($type);
         $this->addNotice($id,$title,$note); //Add notification
        //if(userName($id,'activewa')==1){ sendWhatsapp($phone, $msg1.$msg); }
        
         }
        } 
        return;
    }

function lastTopup($uid){
    global $db;
    $sql = $db->query("SELECT * FROM ewalletx WHERE id = '$uid' AND type=7 ORDER BY sn DESC LIMIT 1 ");
    $row = mysqli_fetch_assoc($sql);
    $dif = time()-$row['ctime'];
    return $dif; 
}



  function lostCredit($id,$amt,$type,$remark,$opt=''){
        global $db,$report;
        $rep = $this->Uid();
        $ctime = time();
        $agent = $_COOKIE['agent']??'';
        $trno = $this->win_hash(11);
        $mm = date('ym');

         if($amt==0){}else{
        $sql = $db->query("INSERT INTO lostcredit (id,trno,cos,type,remark,ctime,mm,rep,opt,agent) VALUES ('$id','$trno','$amt','$type','$remark','$ctime','$mm','$rep','$opt','$agent') ");  
//Send WhatsApp
        $msg= 'You missed a transaction bonus of '.NAIRA.number_format(abs($amt),2).'. Remark: '.$remark.' from '.userName($opt).'. This is because you have not activated higher membership packages or leadership positions. Activate a higher plan now to avoid losing another credit.' ; 

        //$phone = userName($id,'whatsapp');
        $this->addNotice($id,'Lost Credit',$msg);
        //if(userName($id,'activewa')==1){sendWhatsapp($phone, $msg); }
   } 

        return;
    }

    function ProcWaFund(){
    global $db,$report,$count;

      $_SESSION['wafundID'] = $_POST['ProcWaFund'];
header("location: approvewalletfunding.php");
return;   
}
    function ProcWithdraw(){
    global $db,$report,$count;

      $_SESSION['wafundID'] = $_POST['ProcWithdraw'];
header("location: approvewithdrawal.php");
return;   
}

     function FundWallet(){
$this->initiatePay();
        return;
    }


        function AdminFundWalletIni(){

$amount = $_POST['amount'];
$id = $_SESSION['SearchClient'];
$ref = $this->win_hash(8);
$this->walletProcess($id,$amount,1,16,'Wallet Funding by Admin',$ref); 
return;
    }

        function AdminDeductWalletIni(){

$amount = $_POST['amount'];
$id = $_SESSION['SearchClient'];
$ref = $this->win_hash(8);
$this->walletProcess($id,$amount,5,8,'Wallet Deduction by Admin',$ref); 
return;
    }

// function findRef($ref){
// global $db;
// $sql = $db->query("SELECT * FROM logpay WHERE ref = '$ref' AND status=0 ");
//         $row = mysqli_fetch_assoc($sql);
//         if(mysqli_num_rows($sql)==1){
//         $_SESSION['user_idx'] = $row['id'];
//     }
//         return;
// }


function verifyTransaction(){
global $report;
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/6748236/verify",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer FLWSECK-3d1e4cd338418cce46e46f2ae48f607f-X"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$report = $response;
}



function verifyTransfer(){
global $report;
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/transfers/6748236",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer FLWSECK-3d1e4cd338418cce46e46f2ae48f607f-X"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$report = $response;
}

function InitiateBankTransfer(){
  global $report,$count;
  $amount = $_POST['amount'];
  $total = $amount+100; 
  $bank = $_POST['bank'];
  $acno = $_POST['acno'];
  $accname = $_POST['accname'];
  $narration = $_POST['narration'];
  $ref = win_hash(16);
  $uid = $this->Uid();
  $bal = $this->wallet($uid);

  if($amount<500){
$report = 'The minimum transfer amount is '.NAIRA.'500'; $count=1;
  }
  elseif($bal<$total){
$report = 'You have Insufficient Balance to complete this transaction. Fund your wallet and try again'; $count=1;
  }
  else{
  $this->walletProcess($uid,$amount,5,10,'Bank Transfer to '.$accname,$ref);
  $this->walletProcess($uid,100,5,5,'Bank Transfer Charges',$ref); //
  $resp = $this->bankTransfer($amount,$bank,$acno,$narration,$ref); 
   $this->logBankTransfer($uid,$resp);
   $report = 'Bank transfer of '.NAIRA.number_format($amount,2).' to '.$accname.' completed successfully';
  }
return;
}


function logBankTransfer($id,$resp){
  global $db;
  $resp = json_decode($resp,true);
$tstatus = $resp['status'];
$tid = $resp['data']['id'];
$acno = $resp['data']['account_number'];
$bank = $resp['data']['bank_code'];
$amount = $resp['data']['amount'];
$fee = $resp['data']['fee'];
$name = $resp['data']['full_name'];
$ref = $resp['data']['reference'];
$narration = $resp['data']['narration'];
$bankname = $resp['data']['bank_name'];

$db->query("INSERT INTO logtransfer (id,tstatus,tid,acno,amount,fee,bank,ref,narration,bankname,name) VALUES ('$id','$tstatus','$tid','$acno','$amount','$fee','$bank','$ref','$narration','$bankname','$name') ") or die(mysqli_error());
return; 
}


function bankTransfer($amount,$bank,$acno,$narration,$ref){
global $report;
$curl = curl_init();


//$PBFPubKey = "FLWPUBK-4afdc3988390fb6eee091d52062618b5-X"; // test keys//get your public key from the dashboard.

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/transfers",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    
    'account_bank'=>$bank,
    'account_number'=>$acno,
    'narration'=>'Livepetal '.$narration,
    'currency'=>'NGN',
    'reference'=>$ref,
    'debit_currency'=>'NGN',
    'amount'=>$amount
  ]),
  CURLOPT_HTTPHEADER => [
    "Authorization: Bearer FLWSECK-3d1e4cd338418cce46e46f2ae48f607f-X",
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);

return $response;

}



function initiatePay(){
    global $db,$report,$count;

$uid = $this->Uid();
$ref = $this->win_hash(14);
$amount = $_POST['amount']; 
if($amount<100){$report='Enter a valid transaction amount'; $count=1; return; }
$type=1;
$db->query("INSERT INTO logpay(ref,id,amount,type) VALUES('$ref','$uid','$amount','$type')");


$curl = curl_init();

$customer_email = userName($uid,'email');
$customer_name = userName($uid);

$currency = "NGN";
$txref = $ref; // ensure you generate unique references per transaction.
$PBFPubKey = "FLWPUBK-4afdc3988390fb6eee091d52062618b5-X"; // test keys//get your public key from the dashboard.

$redirect_url = isset($_POST['mob']) ? "https://livepetal.com/appp/index.php" : "https://livepetal.com/dashboard.php"; 

$payment_plan = "card wallet payment"; // this is only required for recurring payments.


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'customer_email'=>$customer_email,
    'customer_name'=>$customer_name,
    'currency'=>$currency,
    'txref'=>$txref,
    'PBFPubKey'=>$PBFPubKey,
    'redirect_url'=>$redirect_url,
    'payment_plan'=>$payment_plan
  ]),
  CURLOPT_HTTPHEADER => [
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the rave API
  die('Curl returned error: ' . $err);
}

$transaction = json_decode($response);

if(!$transaction->data && !$transaction->data->link){
  // there was an error from the API
  print_r('API returned error: ' . $transaction->message);
}

// uncomment out this line if you want to redirect the user to the payment page
//print_r($transaction->data->message);


// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $transaction->data->link);
}



function processPay($ref){
global $db,$report,$count;

if(sqL2('logpay','ref',$ref,'status',1)==1){return; }
$type=1;
        $amount = sqLx('logpay','ref',$ref,'amount'); //Correct Amount from Server
        $id = sqLx('logpay','ref',$ref,'id'); //Correct Amount from Server
        $currency = "NGN"; //Correct Currency from Server

        $query = array(
            "SECKEY" => "FLWSECK-3d1e4cd338418cce46e46f2ae48f607f-X",  //test keys
            "txref" => $ref
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
          // transaction was successful...
             // please check other things like whether you already gave value for this ref
          // if the email matches the customer who owns the product etc
          //Give Value and return to Success page
             $type=3;
        if($this->successPayCard($ref)==FALSE){
            $this->walletProcess($id,$chargeAmount,5,18,'Card Wallet Funding',$ref); 
           $report='Payment successfully processed and your wallet funded accordingly'; 
            
        }       
        } else { 
          $report ='Your card payment was not successful'; $count=1;// 
            $type=2;  
        }
      
   $db->query("UPDATE logpay SET status=1,type='$type' WHERE ref = '$ref' ");
       // header('location: dashboard.php'); exit;   
return;
}




function successPayCard($opt){
    global $db;
    $sql = $db->query("SELECT * FROM ewalletx WHERE opt='$opt' ");
 if(mysqli_num_rows($sql)==0){ $res=FALSE;    }else{ $res=TRUE;}
    return $res;
}





  

    function adminLevel($uid)
    {
        $xy=userName($uid,'sn');
        // if ($xy == 1 OR $xy == 2)  {
        //     return TRUE;
        // } else {
        //     return FALSE;
        // }
        return $xy;
    }


    function Uid()
    {
        $uid = isset($_SESSION['user_idx']) ? $_SESSION['user_idx'] : 0;
        return $uid;
    }

    function backToStage(){
      if(isset($_SESSION['user_idx'])){
        if($this->userExist2($_SESSION['user_idx'])==TRUE){header('location: index.php'); } }
      return;
    }

    function Sid($id)
    {
    $b1 = $this->idToKey($id,'b1');
    return $this->keyToId($b1);
    }


function leadTree($uidx){
    global $db;
$uid = $this->keyToId($uidx);
$level2 = $this->keyToId($uidx,'level2');
     $tree = '<ul class="tree">
    <li><span>'.userName($uid,'firstname').'<br><b>['.userName($uid,'sn').']</b></span>'; 
    $sql = $db->query("SELECT * FROM matuser WHERE (a1='$uidx' OR a2='$uidx' OR a3='$uidx' OR b1='$uidx') AND level2='$level2' "); 
 $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
                    while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
      $tree .=  '<li><span><a href="?treeid='.userName($row['id'],'lsk').'" style="color:'.$this->treeColor($uidx,$row['b1']).'">'.userName($row['id'],'firstname').'<br><b>['.userName($row['id'],'sn').']</b></a></span>';
        }
$tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
$tree .= '</li>

  </ul>';

  return $tree; 

}



function leadTreex(){
    global $db;
$uid = $this->lskToId($_GET['treeid']);
$uidx = $this->idToKey($uid);
$level2 = $this->keyToId($uidx,'level2');
     $tree = '<ul class="tree">
    <li><span>'.userName($uid,'firstname').'<br><b>['.userName($uid,'sn').']</b></span>'; 
    $sql = $db->query("SELECT * FROM matuser WHERE (a1='$uidx' OR a2='$uidx' OR a3='$uidx' OR b1='$uidx') AND level2='$level2' "); 
 $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
                    while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
      $tree .=  '<li><span><a href="?treeid='.userName($row['id'],'lsk').'" style="color:'.$this->treeColor($uidx,$row['b1']).'">'.userName($row['id'],'firstname').'<br><b>['.userName($row['id'],'sn').']</b></a></span>';
        }
$tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
$tree .= '</li>

  </ul>';

  return $tree; 

}
// function leadTree($uidx){
//     global $db;
// $uid = $this->keyToId($uidx);
// $level2 = $this->keyToId($uidx,'level2');
//      $tree = '<ul class="tree">
//     <li><span>'.userName($uid).'<br><b>['.userName($uid,'sn').']</b></span>'; 
//     $sql = $db->query("SELECT * FROM matuser WHERE (a1='$uidx' OR a2='$uidx' OR b1='$uidx') AND level2='$level2' "); 
//  $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
//                     while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
//       $tree .=  '<li><span><a href="?treeid='.userName($row['id'],'lsk').'" style="color:green">'.userName($row['id']).'<br><b>['.userName($row['id'],'sn').']</b></a></span>';
//   }

// $tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
// $tree .= '</li>

//   </ul>';

//   return $tree; 

// }



// function leadTreex(){
//     global $db;
// $uid = $this->lskToId($_GET['treeid']);
// $uidx = $this->idToKey($uid);
// $level2 = $this->keyToId($uidx,'level2');
//      $tree = '<ul class="tree">
//     <li><span>'.userName($uid,'firstname').'<br><b>['.userName($uid,'sn').']</b></span>'; 
//     $sql = $db->query("SELECT * FROM matuser WHERE (a1='$uidx' OR a2='$uidx' OR b1='$uidx') AND level2='$level2' "); 
//  $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
//                     while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
//       $tree .=  '<li><span><a href="?treeid='.userName($row['id'],'lsk').'" style="color:green">'.userName($row['id'],'firstname').'<br><b>['.userName($row['id'],'sn').']</b></a></span>';
//         }
// $tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
// $tree .= '</li>

//   </ul>';

//   return $tree; 

// }

// function matTree($uidx){
//     global $db;
// $uid = $this->keyToId($uidx);
//      $tree = '<ul class="tree">
//     <li><span>'.userName($uid).'<br><b>['.userName($uid,'sn').']</b></span>'; 
//     $sql = $db->query("SELECT * FROM matuser WHERE a1='$uidx' "); 
//  $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
//                     while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
//       $tree .=  '<li><span><a href="?treeid='.userName($row['id'],'lsk').'" style="color:green">'.userName($row['id']).'<br><b>['.userName($row['id'],'sn').']</b></a></span>';
//       $sq = $db->query("SELECT * FROM matuser WHERE a1='$nsn' "); 
//       $tree .= mysqli_num_rows($sq)>0 ? '<ul>' : '';
//                     while($ro = mysqli_fetch_assoc($sq)) {   
          
//           $tree .= '<li><span><a href="?treeid='.userName($ro['id'],'lsk').'" style="color:brown">'.userName($ro['id']).'<br><b>['.userName($ro['id'],'sn').']</b></a></span> </li>';  }
 

//       $tree .= mysqli_num_rows($sq)>0 ? '</ul>' : ''; 
    
//   $tree .= '</li>';    }
// $tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
// $tree .= '</li>

//   </ul>';

//   return $tree; 

// }
function leadIcon($x,$y){
    $xl=$this->userNamex2($x,'level');
    $yl = $this->userNamex2($y,'level');

    $xp=$this->userNamex2($x,'pack');
    $yp=$this->userNamex2($y,'pack');


$res = $xl==$yl ? ' class="btn-warning" ' : '';
$res = ($xp>$yp OR $xl>$yl) ? ' class="btn-danger" ' : $res;
return $res;
}



function matTree($uidx){
    global $db;
$uid = $this->keyToId($uidx);
     $tree = '<ul class="tree">
    <li><span><b><a href="#" data-toggle="tooltip" title="'.userName($uid).'">'.userName($uid,'sn').'</b> <br><div class="fa fa-users"></div> '.$this->userNamex2($uid,'sp').'</a></span>'; 
    $sql = $db->query("SELECT * FROM matuser WHERE a1='$uidx' "); 
 $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
                    while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
      $tree .=  '<li><span'.$this->leadIcon($row['id'],$uid).'><a href="?treeid='.userName($row['id'],'lsk').'" data-toggle="tooltip" title="'.userName($row['id']).'" style="color:'.$this->treeColor($uidx,$row['b1']).'"><b>'.userName($row['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$row['sp'].'</a></span>';
       $sq = $db->query("SELECT * FROM matuser WHERE a1='$nsn' "); 
       $tree .= mysqli_num_rows($sq)>0 ? '<ul>' : '';
                    while($ro = mysqli_fetch_assoc($sq)) {   $nss=$ro['sn']; 
          
           $tree .= '<li><span'.$this->leadIcon($ro['id'],$uid).'><a href="?treeid='.userName($ro['id'],'lsk').'" data-toggle="tooltip" title="'.userName($ro['id']).'" style="color:'.$this->treeColor($uidx,$ro['b1']).'"><b>'.userName($ro['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$ro['sp'].'</a></span>';

       $sqs = $db->query("SELECT * FROM matuser WHERE a1='$nss' "); 
       $tree .= mysqli_num_rows($sqs)>0 ? '<ul>' : '';
                    while($ros = mysqli_fetch_assoc($sqs)) {   
          
           $tree .= '<li><span'.$this->leadIcon($ros['id'],$uid).'><a href="?treeid='.userName($ros['id'],'lsk').'"  data-toggle="tooltip" title="'.userName($ros['id']).'" style="color:'.$this->treeColor($uidx,$ros['b1']).'"><b>'.userName($ros['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$ros['sp'].'</a></span> </li>';  }
 

      $tree .= mysqli_num_rows($sqs)>0 ? '</ul>' : ''; 
       $tree .= '</li>';  }
 
      $tree .= mysqli_num_rows($sq)>0 ? '</ul>' : ''; 
    
  $tree .= '</li>';    }
$tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
$tree .= '</li>

  </ul>';

  return $tree; 

}





function matTreeMobile($uidx){
    global $db;
$uid = $this->keyToId($uidx);
     $tree = '<ul class="tree">
    <li><span style="line-height:1"><b><a href="javascript:;" >'.userName($uid,'sn').'</b><br><small class="text-muted" style="font-size:10px">'.userName($uid,'firstname').'</small> <br>'.$this->userNamex2($uid,'sp').','.$this->userAllTeam($uidx).'</a></span>'; 
    $sql = $db->query("SELECT * FROM matuser WHERE a1='$uidx' "); 
 $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
                    while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
      $tree .=  '<li><span'.$this->leadIcon($row['id'],$uid).' style="line-height:1"><a  onclick="showTeam('.$row['sn'].')" href="javascript:;" style="color:'.$this->treeColor($uidx,$row['b1']).'"><b>'.userName($row['id'],'sn').'</b><br><small class="text-muted" style="font-size:10px">'.userName($row['id'],'firstname').'</small> <br>'.$row['sp'].','.$this->userAllTeam($row['sn']).'</a></span>';
       $sq = $db->query("SELECT * FROM matuser WHERE a1='$nsn' "); 
       $tree .= mysqli_num_rows($sq)>0 ? '<ul>' : '';
                    while($ro = mysqli_fetch_assoc($sq)) {   $nss=$ro['sn']; 
          
           $tree .= '<li><span'.$this->leadIcon($ro['id'],$uid).' style="line-height:1"><a onclick="showTeam('.$ro['sn'].')" href="javascript:;" style="color:'.$this->treeColor($uidx,$ro['b1']).'"><b>'.userName($ro['id'],'sn').'</b><br><small class="text-muted" style="font-size:10px">'.userName($ro['id'],'firstname').'</small> <br>'.$ro['sp'].','.$this->userAllTeam($ro['sn']).'</a></span>';

       $sqs = $db->query("SELECT * FROM matuser WHERE a1='$nss' "); 
       $tree .= mysqli_num_rows($sqs)>0 ? '<ul>' : '';
                    while($ros = mysqli_fetch_assoc($sqs)) {   
          
           $tree .= '<li><span'.$this->leadIcon($ros['id'],$uid).' style="line-height:1"><a onclick="showTeam('.$ros['sn'].')" href="javascript:;" style="color:'.$this->treeColor($uidx,$ros['b1']).'"><b>'.userName($ros['id'],'sn').'</b><br><small class="text-muted" style="font-size:10px">'.userName($ros['id'],'firstname').'</small> <br>'.$ros['sp'].','.$this->userAllTeam($ros['sn']).'</a></span> </li>';  }
 

      $tree .= mysqli_num_rows($sqs)>0 ? '</ul>' : ''; 
       $tree .= '</li>';  }
 
      $tree .= mysqli_num_rows($sq)>0 ? '</ul>' : ''; 
    
  $tree .= '</li>';    }
$tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
$tree .= '</li>

  </ul>';

  return $tree; 

}




function matTreex(){
    global $db;
$uid = $this->lskToId($_GET['treeid']);
$uidx = $this->idToKey($uid);
     $tree = '<ul class="tree">
    <li><span><b><a href="#" data-toggle="tooltip" title="'.userName($uid).'">'.userName($uid,'sn').'</b> <br><div class="fa fa-users"></div> '.$this->userNamex2($uid,'sp').'</a></span>'; 
    $sql = $db->query("SELECT * FROM matuser WHERE a1='$uidx' "); 
 $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
                    while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
      $tree .=  '<li><span'.$this->leadIcon($row['id'],$uid).'><a href="?treeid='.userName($row['id'],'lsk').'" data-toggle="tooltip" title="'.userName($row['id']).'" style="color:'.$this->treeColor($uidx,$row['b1']).'"><b>'.userName($row['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$row['sp'].'</a></span>';
       $sq = $db->query("SELECT * FROM matuser WHERE a1='$nsn' "); 
       $tree .= mysqli_num_rows($sq)>0 ? '<ul>' : '';
                    while($ro = mysqli_fetch_assoc($sq)) {   $nss=$ro['sn']; 
          
           $tree .= '<li><span'.$this->leadIcon($ro['id'],$uid).'><a href="?treeid='.userName($ro['id'],'lsk').'" data-toggle="tooltip" title="'.userName($ro['id']).'" style="color:'.$this->treeColor($uidx,$ro['b1']).'"><b>'.userName($ro['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$ro['sp'].'</a></span>';

       $sqs = $db->query("SELECT * FROM matuser WHERE a1='$nss' "); 
       $tree .= mysqli_num_rows($sqs)>0 ? '<ul>' : '';
                    while($ros = mysqli_fetch_assoc($sqs)) {   
          
           $tree .= '<li><span'.$this->leadIcon($ros['id'],$uid).'><a href="?treeid='.userName($ros['id'],'lsk').'"  data-toggle="tooltip" title="'.userName($ros['id']).'" style="color:'.$this->treeColor($uidx,$ros['b1']).'"><b>'.userName($ros['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$ros['sp'].'</a></span> </li>';  }
 

      $tree .= mysqli_num_rows($sqs)>0 ? '</ul>' : ''; 
       $tree .= '</li>';  }
 
      $tree .= mysqli_num_rows($sq)>0 ? '</ul>' : ''; 
    
  $tree .= '</li>';    }
$tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
$tree .= '</li>

  </ul>';

  return $tree; 

}




function matTree1($uidx){
    global $db;
$uid = $this->keyToId($uidx);
     $tree = '<ul class="tree">
    <li><span><b><a href="#" data-toggle="tooltip" title="'.userName($uid).'">'.userName($uid,'sn').'</b> <br><div class="fa fa-users"></div> '.$this->userNamex2($uid,'sp').'</a></span>'; 
    $sql = $db->query("SELECT * FROM matuser WHERE a1='$uidx' "); 
 $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
                    while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
      $tree .=  '<li><span'.$this->leadIcon($row['id'],$uid).'><a href="?treeid='.userName($row['id'],'lsk').'" data-toggle="tooltip" title="'.userName($row['id']).'" style="color:'.$this->treeColor($uidx,$row['b1']).'"><b>'.userName($row['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$row['sp'].'</a></span>';
       $sq = $db->query("SELECT * FROM matuser WHERE a1='$nsn' "); 
       $tree .= mysqli_num_rows($sq)>0 ? '<ul>' : '';
                    while($ro = mysqli_fetch_assoc($sq)) {   $nss=$ro['sn']; 
          
           $tree .= '<li><span'.$this->leadIcon($ro['id'],$uid).'><a href="?treeid='.userName($ro['id'],'lsk').'" data-toggle="tooltip" title="'.userName($ro['id']).'" style="color:'.$this->treeColor($uidx,$ro['b1']).'"><b>'.userName($ro['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$ro['sp'].'</a></span>';

       $sqs = $db->query("SELECT * FROM matuser WHERE a1='$nss' "); 
       $tree .= mysqli_num_rows($sqs)>0 ? '<ul>' : '';
                    while($ros = mysqli_fetch_assoc($sqs)) {  $nst=$ros['sn'];  
          
           $tree .= '<li><span'.$this->leadIcon($ros['id'],$uid).'><a href="?treeid='.userName($ros['id'],'lsk').'"  data-toggle="tooltip" title="'.userName($ros['id']).'" style="color:'.$this->treeColor($uidx,$ros['b1']).'"><b>'.userName($ros['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$ros['sp'].'</a></span>';

           $sqq = $db->query("SELECT * FROM matuser WHERE a1='$nst' "); 
       $tree .= mysqli_num_rows($sqq)>0 ? '<ul>' : '';
                    while($roq = mysqli_fetch_assoc($sqq)) {   $nsu=$roq['sn']; 
          
           $tree .= '<li><span'.$this->leadIcon($roq['id'],$uid).'><a href="?treeid='.userName($roq['id'],'lsk').'"  data-toggle="tooltip" title="'.userName($roq['id']).'" style="color:'.$this->treeColor($uidx,$roq['b1']).'"><b>'.userName($roq['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$roq['sp'].'</a></span>';

$sqr = $db->query("SELECT * FROM matuser WHERE a1='$nsu' "); 
       $tree .= mysqli_num_rows($sqr)>0 ? '<ul>' : '';
                    while($ror = mysqli_fetch_assoc($sqr)) {   
          
           $tree .= '<li><span'.$this->leadIcon($ror['id'],$uid).'><a href="?treeid='.userName($ror['id'],'lsk').'"  data-toggle="tooltip" title="'.userName($ror['id']).'" style="color:'.$this->treeColor($uidx,$ror['b1']).'"><b>'.userName($ror['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$ror['sp'].'</a></span> </li>';  }

      $tree .= mysqli_num_rows($sqr)>0 ? '</ul>' : ''; 
           ' </li>';  }
 
      $tree .= mysqli_num_rows($sqq)>0 ? '</ul>' : ''; 
          $tree .= ' </li>';  }
 

      $tree .= mysqli_num_rows($sqs)>0 ? '</ul>' : ''; 
       $tree .= '</li>';  }
 
      $tree .= mysqli_num_rows($sq)>0 ? '</ul>' : ''; 
    
  $tree .= '</li>';    }
$tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
$tree .= '</li>

  </ul>';

  return $tree; 

}




function matTreex1(){
    global $db;
$uid = $this->lskToId($_GET['treeid']);
$uidx = $this->idToKey($uid);
     $tree = '<ul class="tree">
    <li><span><b><a href="#" data-toggle="tooltip" title="'.userName($uid).'">'.userName($uid,'sn').'</b> <br><div class="fa fa-users"></div> '.$this->userNamex2($uid,'sp').'</a></span>'; 
    $sql = $db->query("SELECT * FROM matuser WHERE a1='$uidx' "); 
 $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
                    while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
      $tree .=  '<li><span'.$this->leadIcon($row['id'],$uid).'><a href="?treeid='.userName($row['id'],'lsk').'" data-toggle="tooltip" title="'.userName($row['id']).'" style="color:'.$this->treeColor($uidx,$row['b1']).'"><b>'.userName($row['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$row['sp'].'</a></span>';
       $sq = $db->query("SELECT * FROM matuser WHERE a1='$nsn' "); 
       $tree .= mysqli_num_rows($sq)>0 ? '<ul>' : '';
                    while($ro = mysqli_fetch_assoc($sq)) {   $nss=$ro['sn']; 
          
           $tree .= '<li><span'.$this->leadIcon($ro['id'],$uid).'><a href="?treeid='.userName($ro['id'],'lsk').'" data-toggle="tooltip" title="'.userName($ro['id']).'" style="color:'.$this->treeColor($uidx,$ro['b1']).'"><b>'.userName($ro['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$ro['sp'].'</a></span>';

       $sqs = $db->query("SELECT * FROM matuser WHERE a1='$nss' "); 
       $tree .= mysqli_num_rows($sqs)>0 ? '<ul>' : '';
                    while($ros = mysqli_fetch_assoc($sqs)) {  $nst=$ros['sn'];  
          
           $tree .= '<li><span'.$this->leadIcon($ros['id'],$uid).'><a href="?treeid='.userName($ros['id'],'lsk').'"  data-toggle="tooltip" title="'.userName($ros['id']).'" style="color:'.$this->treeColor($uidx,$ros['b1']).'"><b>'.userName($ros['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$ros['sp'].'</a></span>';

            $sqq = $db->query("SELECT * FROM matuser WHERE a1='$nst' "); 
       $tree .= mysqli_num_rows($sqq)>0 ? '<ul>' : '';
                    while($roq = mysqli_fetch_assoc($sqq)) {   $nsu=$roq['sn']; 
          
           $tree .= '<li><span'.$this->leadIcon($roq['id'],$uid).'><a href="?treeid='.userName($roq['id'],'lsk').'"  data-toggle="tooltip" title="'.userName($roq['id']).'" style="color:'.$this->treeColor($uidx,$roq['b1']).'"><b>'.userName($roq['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$roq['sp'].'</a></span>';

$sqr = $db->query("SELECT * FROM matuser WHERE a1='$nsu' "); 
       $tree .= mysqli_num_rows($sqr)>0 ? '<ul>' : '';
                    while($ror = mysqli_fetch_assoc($sqr)) {   
          
           $tree .= '<li><span'.$this->leadIcon($ror['id'],$uid).'><a href="?treeid='.userName($ror['id'],'lsk').'"  data-toggle="tooltip" title="'.userName($ror['id']).'" style="color:'.$this->treeColor($uidx,$ror['b1']).'"><b>'.userName($ror['id'],'sn').'</b> <br><div class="fa fa-users"></div> '.$ror['sp'].'</a></span> </li>';  }

      $tree .= mysqli_num_rows($sqr)>0 ? '</ul>' : ''; 
           ' </li>';  }
 
      $tree .= mysqli_num_rows($sqq)>0 ? '</ul>' : ''; 
          $tree .= ' </li>';  }
 

      $tree .= mysqli_num_rows($sqs)>0 ? '</ul>' : ''; 
       $tree .= '</li>';  }
 
      $tree .= mysqli_num_rows($sq)>0 ? '</ul>' : ''; 
    
  $tree .= '</li>';    }
$tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
$tree .= '</li>

  </ul>';

  return $tree; 

}






function matTreeRef($uidx){
    global $db;
$uid = $this->keyToId($uidx);
     $tree = '<ul class="tree">
    <li><span>'.userName($uid,'firstname').'<br><b>['.userName($uid,'sn').']</b></span>'; 
    $sql = $db->query("SELECT * FROM matuser WHERE b1='$uidx' "); 
 $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
                    while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
      
      $tree .=  '<li><span><a href="?treeid='.userName($row['id'],'lsk').'" style="color:'.$this->treeColor($uidx,$row['b1']).'">'.userName($row['id'],'firstname').'<br><b>['.userName($row['id'],'sn').']</b></a></span>';
       $sq = $db->query("SELECT * FROM matuser WHERE b1='$nsn' "); 
       $tree .= mysqli_num_rows($sq)>0 ? '<ul>' : '';
                    while($ro = mysqli_fetch_assoc($sq)) {   
          
           $tree .= '<li><span><a href="?treeid='.userName($ro['id'],'lsk').'" style="color:'.$this->treeColor($uidx,$ro['b1']).'">'.userName($ro['id'],'firstname').'<br><b>['.userName($ro['id'],'sn').']</b></a></span> </li>';  }
 

      $tree .= mysqli_num_rows($sq)>0 ? '</ul>' : ''; 
    
  $tree .= '</li>';    }
$tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
$tree .= '</li>

  </ul>';

  return $tree; 

}

function treeColor($uidx,$fidx){
     if($fidx==$uidx){$col='green';}elseif($fidx>$uidx){$col='brown';}else{$col='blue';}
     return $col;
}
  

function matTreeRefx(){
    global $db;
$uid = $this->lskToId($_GET['treeid']);
$uidx = $this->idToKey($uid);
     $tree = '<ul class="tree">
    <li><span>'.userName($uid,'firstname').'<br><b>['.userName($uid,'sn').']</b></span>'; 
    $sql = $db->query("SELECT * FROM matuser WHERE b1='$uidx' "); 
 $tree .= mysqli_num_rows($sql)>0 ? '<ul>' : '';
                    while($row = mysqli_fetch_assoc($sql) ) { $nsn=$row['sn']; 
     
      
      $tree .=  '<li><span><a href="?treeid='.userName($row['id'],'lsk').'" style="color:'.$this->treeColor($uidx,$row['b1']).'">'.userName($row['id'],'firstname').'<br><b>['.userName($row['id'],'sn').']</b></a></span>';
       $sq = $db->query("SELECT * FROM matuser WHERE b1='$nsn' "); 
       $tree .= mysqli_num_rows($sq)>0 ? '<ul>' : '';
                    while($ro = mysqli_fetch_assoc($sq)) {   
          
           $tree .= '<li><span><a href="?treeid='.userName($ro['id'],'lsk').'" style="color:'.$this->treeColor($uidx,$ro['b1']).'">'.userName($ro['id'],'firstname').'<br><b>['.userName($ro['id'],'sn').']</b></a></span> </li>';  }
 

      $tree .= mysqli_num_rows($sq)>0 ? '</ul>' : ''; 
    
  $tree .= '</li>';    }
$tree .= mysqli_num_rows($sql)>0 ? '</ul>' : ''; 
$tree .= '</li>

  </ul>';

  return $tree; 

}

    

    function  createPin()
    {
        global $report, $db, $userKey;

        $num = sanitize($_POST['no-of-pin']);
        for ($a = 1; $a <= $num; $a++) {
            $pin = strtoupper($this->win_hash(10));
            $sql = $db->query("INSERT INTO pin(pin,rep,tm) VALUES('$pin','$userKey','1') ");
        }
        $report = $num . ' PINs successfully generated';
        return;
    }


function logAgent(){
    global $db;
    $agent = $_COOKIE['agent']??'';
    $this->firstAgent($agent);
$dd = date('ymd');
if(sqL2('agentlog','agent',$agent,'dd',$dd)==0){
$type = sqL1('agentlog','agent',$agent);
$time = time();  
$ref = $_COOKIE['ref']??'';
$lpk = $_COOKIE['lpk'];
$media = $_COOKIE['media'];

$db->query("INSERT INTO agentlog (agent,ref,lpk,media,time,dd,type) VALUES('$agent','$ref','$lpk','$media','$time','$dd','$type') "); 
}
return;
}

function firstAgent($agent){
  global $db;

$dd = date('ymd');
if(sqL1('firstagent','agent',$agent)==0){

$time = time();  

$lpk = $_COOKIE['lpk']??'';
$os = getOS();
$browser = getBrowser();

$db->query("INSERT INTO firstagent (agent,os,browser,lpk,ctime) VALUES('$agent','$os','$browser','$lpk','$time') "); 
}

}




function staffRole(){
   global $db, $count, $report;

   $role = addslashes($_POST['role']);
   $detail = addslashes($_POST['detail']);
   if(1 == 1){$sql = $db->query("INSERT INTO staffrole (role,detail) VALUES ('$role','$detail')") or die('Cannot connect to server');
  $report = 'Successfully Submitted!';}else{$count = 2; $report ='failed could not upload ';}

return;
}

function fetchId($table,$id){
 global $db ;
  $sqll=$db->query("SELECT * FROM $table WHERE id='$id'")or die(mysqli_error());  
  $t=mysqli_num_rows($sqll); 
  return $t;
}
function idTo($table,$id,$row,$col){
 global $db ;
  $sqll=$db->query("SELECT * FROM $table WHERE $row='$id'")or die(mysqli_error());  
  $ro=mysqli_fetch_assoc($sqll); 
  return $ro[$col];
}

function Pro($id){
 global $db ;
  $sqll=$db->query("SELECT * FROM project2 WHERE pid='$id'")or die(mysqli_error());  
  $t=mysqli_num_rows($sqll); 
  return $t;
}


function addStaff(){
   global $db, $count, $report;
   $id = $_GET['staff'];
   $role = $_POST['role'];
   $level = $_POST['level'];$adate = $_POST['date'];
   $sqll=$db->query("SELECT * FROM staff")or die(mysqli_error());   
 $row = mysqli_fetch_array($sqll);
 $ro = $row['id']; 

   if($ro == $id){$count=2; $report='Already A Satff';}else{$sql = $db->query("INSERT INTO staff (id,role,level,adate) VALUES ('$id','$role','$level','$adate')") or die('Cannot connect to server');
  $report = 'Successfully Submitted!';}

return;
}

function selectWorker(){
   global $db, $count, $report;
   $rep = $_SESSION['user_idx'];
   $pid = $_SESSION['token'];
   $staff = $_POST['worker'];

{$sql = $db->query("INSERT INTO project2 (staffid,pid,rep) VALUES ('$staff','$pid','$rep')") or die('Cannot connect to server');
  $report = 'Successfully Submitted!';}

return;
}





function suggestionBox(){
   global $db, $count, $report;

   $id = $_SESSION['user_idx'];
   $title = addslashes($_POST['title']);
   $detail = addslashes($_POST['detail']);
   if(1 == 1){$sql = $db->query("INSERT INTO suggestion (id,title,detail) VALUES ('$id','$title','$detail')") or die('Cannot connect to server');
  $report = 'Successfully Submitted!';}else{$count = 2; $report ='failed could not upload ';}

return;
}


function support(){
   global $db, $count, $report;

   $id = $_SESSION['user_idx'];
   $title = addslashes($_POST['title']);
   $detail = addslashes($_POST['detail']);
   if(1 == 1){$sql = $db->query("INSERT INTO supportticket (id,title,detail) VALUES ('$id','$title','$detail')") or die('Cannot connect to server');
  $report = 'Successfully Submitted!';}else{$count = 2; $report ='failed could not upload ';}

return;
}

function ServicePortal()
{           
    global $db, $report,  $count;
        $_SESSION['itemx'] = $_POST['ServicePortal'];
        $trno = $_SESSION['itemx'];
    $sq=$db->query("SELECT * FROM newsales WHERE trno='$trno' ");
$ro=mysqli_fetch_array($sq);
$item = $ro['item'];

  $sl=$db->query("SELECT * FROM product2 WHERE sn='$item' ");
$rw=mysqli_fetch_array($sl);
$sn = $rw['sn'];
if($sn==1){header('location: cbt/selectsubject.php');}
elseif ($sn==2) {header('location: cbt/selectsubject.php');}
}


    function  contact()
    {
        global $db, $count, $report;

        $email = "livepetal@gmail.com";
        $usermail = $_POST['email'];
        $name = $_POST['name'];

        $subject = 'This is an enquiry from' . $usermail;
        $headers = 'From: ' . $usermail . "\r\n";
        $headers .= 'Reply-To: admin@gmail.com' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $message = $_POST['message'];


        $send = mail($email, $subject, $message, $headers);
        if ($send) {
            $report = 'sent';
        } else {
            $count = 1;
            $report = 'Message not sent.';
        }

        // header('location: download.php'); 


        return;
    }



function plan(){
    global $db, $count, $report ;
    $plan = $this->valEmpty($_POST['note'], 'Note');
    $ptime = time();
    $pid = $_SESSION['user_idx'];

    if(!isset($count)){
        $sql = $db->query("INSERT INTO projectreport (plan,ptime,pid) VALUES ('$plan','$ptime','$pid') ")or die ('cannot connect to server');
        $report = 'Succesfully Submitted, All the best for today!';
    }
    return;
}


function NewAddCategory(){
    global $db, $count, $report ;
    $title = $_POST['title'];
    $note = $_POST['note'];
   
        $sql = $db->query("INSERT INTO adcategory (category,note) VALUES ('$title','$note') ")or die ('cannot connect to server');
        $report = 'Succesfully Submitted';
    
    return;
}


function submitpro(){
    global $db, $count, $report ;

    $pid = $_SESSION['user_idx'];
    $report = $this->valEmpty($_POST['rep'], 'Report');
    $rtime = time();

    $ch = $db->query("SELECT * FROM projectreport WHERE pid='$pid' ORDER BY sn DESC LIMIT 1");
$r = mysqli_fetch_array($ch);
$sn = $r['sn'];
        $l = $db->query("UPDATE projectreport SET report='$report', rtime='$rtime' WHERE sn='$sn' ")or die ('cannot connect to server');
        $report = 'Succesfully Updated, Gooday!';
        unset($_SESSION['submitreport']);
        return;
}

function editassement(){
    global $db, $count, $report;
    $sn = $_SESSION['edit'];
    $plan = $this->valEmpty($_POST['updateplan'], 'Plan');
    $report = $this->valEmpty($_POST['updatereport'], 'Report');
    $t  = time();

        $sql=$db->query("UPDATE projectreport SET plan='$plan', report='$report', rtime='$t' WHERE sn ='$sn' ");
        $report = 'Sucessfully Updated';
        unset($_SESSION['edit']);
    return;
}


//Testing
function testPromotions(){
  global $db;
  $sql = $db->query("SELECT * FROM user WHERE sent=0 LIMIT 30");
  while($row = mysqli_fetch_assoc($sql)){ $id=$row['id']; $pack = $row['pack']; 
  $pack2 = sqLx('packs','ref',$pack,'sn')+1;
  $packfund = sqLx('packs','sn',$pack2,'cost');
  $this->walletProcess($id,$packfund,5,15,'Test wallet fund',''); //
 $this->membershipUpgrade($id,$pack2);
  $db->query("UPDATE user SET sent=1 WHERE id='$id' ");
  }
  return; 
}





}


/**
 * 

 */
class Maintain extends Profile
{
  
  function __construct()
  {
    # code...
  }


function migrateRefSpill(){
  global $db;
  $rep = $this->Uid();
  $sql = $db->query("SELECT * FROM matuser WHERE status=1 ");
  while($row=mysqli_fetch_assoc($sql)){ $id=$row['id'];
    $db->query("INSERT INTO ewalletpro (id,trno,sin,cos,tan,created,ctime,mm,status,type,remark,rep,opt,agent) SELECT id,trno,sin,cos,tan,created,ctime,mm,status,type,remark,rep,opt,agent FROM ewalletx WHERE id='$id' AND type BETWEEN 41 AND 55 ");
    $amt = $this->walletRange($id,41,55);
    $this->walletProcessPro($id,$amt,5,2,'Bonus Withdrawal',$rep);
    $db->query("DELETE FROM ewalletx WHERE id='$id' AND type BETWEEN 41 AND 55 ");
    $db->query("UPDATE matuser SET status=2 WHERE id='$id' ");
  }
  return;
}

function migrateRefSpill2(){
  global $db;
  $rep = $this->Uid();
  $sql = $db->query("SELECT * FROM matuser WHERE status=2 ");
  while($row=mysqli_fetch_assoc($sql)){ $id=$row['id'];
    $amt = abs($this->walletPro($id,2));
    $this->walletProcess($id,$amt,5,19,'Referral & Spillover Earnings',$rep);
    $db->query("UPDATE matuser SET status=1 WHERE id='$id' ");
  }
  return;
}


}

$maint = new Maintain;


$pro = new Profile;

$uid = $pro->Uid();
if($uid != 0){
$sid = $pro->Sid($uid);
$spv = $pro->calcSpv($uid);
$rpv = $pro->calcRpv($uid);



 $pro->logAgent();//log agent
$uidx = $pro->idToKey($uid);
$_SESSION['lpk'] = $uidx;

$stage = $pro->idToKey($uid,'level');

if(!isset($stage)){$stage=1; }
$ref = userName($uid,'sn');

$packid = userNameMat($uid,'pack2');
$packs = sqLx('packs','ref',$packid,'title'); 
}
