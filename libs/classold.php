<?php

        if(isset($_SESSION['user_idx'])){   
$userKey = $_SESSION['user_idx'];
}   


    
class Profile
{
    var $regfee = 2500;  //Registration Fee

    var $minwithdraw = 5000;
    var $maxwithdraw = 500000;
    var $withdrawcharge = 100;//0.5;
    var $mininvest = 20000;//0.5;




    //User Array Keys 
    /* Class constructor */
    function __construct()
    {
global $report, $count;
if (array_key_exists('InitialSignup', $_POST)) { $this->signupUserIni(); } 
elseif (array_key_exists('FindBeneficiary', $_POST)) { $this->FindBeneficiary();  }
elseif (array_key_exists('VerifySponsor', $_POST)) { $this->VerifySponsor(); } 
elseif (array_key_exists('payWithPin', $_POST)) { $this->payWithPin();     }
elseif (array_key_exists('AccountActini', $_POST)) { $this->AccountActini();     }
elseif (array_key_exists('unsetSignup', $_POST)) { unset($_SESSION['signup']); header("location: ?");  } 
//elseif (array_key_exists('RegisterWithPin', $_POST)) { $this->RegisterWithPin();        } 
elseif (array_key_exists('ProceedToLogin', $_POST)) { session_destroy(); header("location:login.php"); } 
elseif (array_key_exists('LoginUsers', $_POST)) {  $this->LoginUsers(); } 
elseif (array_key_exists('LogoutUser', $_POST)) {  $this->LogoutUser(); } 
elseif(array_key_exists('FundWalletIni', $_POST)){ $this->FundWalletIni(); }
elseif(isset($_GET['txref'])) {$this->processPay(); } 
elseif(array_key_exists('SearchClient', $_POST)){ $this->SearchClient(); }
elseif (array_key_exists('ApproveFundOrder', $_POST)) { $this->ApproveFundOrder();}
elseif (array_key_exists('PinActivation', $_POST)) { $this->PinActivation();}
elseif (array_key_exists('WalletActivation', $_POST)) { $this->WalletActivation();}


elseif (array_key_exists('changeSponsor', $_POST)) { $_SESSION['signup'] = NULL; } 
elseif (array_key_exists('changeLogin', $_POST)) { $_SESSION['signup'] = 2; } 
elseif (array_key_exists('regContinue', $_POST)) {  $_SESSION['signup'] = 5;  $head = $this->win_hash(85);
            header("location: ?user_ref=$head"); } 
elseif (array_key_exists('searchU', $_POST)) { $this->searchU(); }
elseif (array_key_exists('SearchUserMessage', $_POST)) {  $this->SearchUserMessage();      } 
elseif (array_key_exists('signupUser', $_POST)) {   $this->signupUser();       } 
elseif (array_key_exists('resetPass', $_POST)) {  $this->resetPass();   } 
elseif (array_key_exists('updateSignup', $_POST)) {   $this->updateSignup();   } 
elseif (array_key_exists('updateUserBank', $_POST)) {   $this->updateUserBank();   } 
elseif (array_key_exists('resetPassConfirm', $_POST)) {   $this->resetPassConfirm(); } 
elseif (array_key_exists('signupUserIni', $_POST)) {   $this->signupUserIni();     } 
elseif (isset($_GET['tr_reference'])) {  $this->confirmPayment();   } 
elseif (isset($_GET['ref'])) { $this->refLink();  } 
elseif (isset($_GET['reff'])) {  $this->findSponsorx();   } 
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
// elseif (array_key_exists('ApproveFundOrder', $_POST)) { $this->ApproveFundOrder();} 
elseif (array_key_exists('ApproveWithdrawal', $_POST)) { $this->ApproveWithdrawal();} //
elseif (array_key_exists('FundWallet', $_POST)) { $this->FundWallet();} 
elseif (array_key_exists('RequestTransfer', $_POST)) { $this->RequestTransfer();}
elseif(array_key_exists('AdminFundWalletIni', $_POST)){ $this->AdminFundWalletIni(); }
elseif(array_key_exists('ProcWaFund', $_POST)){ $this->ProcWaFund(); }
elseif(array_key_exists('ProcWithdraw', $_POST)){ $this->ProcWithdraw(); }
if(array_key_exists('ProcFundOrder', $_POST)){ $this->ProcFundOrder(); }
       
elseif (array_key_exists('ForgertPassword', $_POST)) { $this->ForgertPassword();}
elseif (array_key_exists('ApproveWithdraw', $_POST)) { $this->ApproveWithdraw();}
elseif (array_key_exists('ReturnWithdraw', $_POST)) { $this->ReturnWithdraw();}
elseif (array_key_exists('RequestIncentive1', $_POST)) { $this->RequestIncentive1();}
elseif (array_key_exists('ApproveIncentive1', $_POST)) { $this->ApproveIncentive1();}
          
elseif (array_key_exists('DownloadMaterial', $_POST)) { $this->DownloadMaterial($_POST['DownloadMaterial']); }
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
elseif (array_key_exists('approveIncentiveOrder', $_POST)) { $this->approveIncentiveOrder();} 
elseif (array_key_exists('SearchDownline', $_POST)) { $this->SearchDownline(); } 
elseif (array_key_exists('SendUserMessage', $_POST)) { $this->SendUserMessage(); } 
elseif (array_key_exists('DeactivateUser', $_POST)) { $this->DeactivateUser(); } 
elseif (array_key_exists('UpdatePin', $_POST)) { $this->UpdatePin(); } 
elseif (array_key_exists('CourseUpload', $_POST)) { $this->CourseUpload(); } 
elseif (array_key_exists('processPin', $_POST)) {  $_SESSION['processPin'] = $_POST['processPin'];  } 
elseif (array_key_exists('replyMsg', $_POST)) { $this->replyMsg(); } 
elseif (array_key_exists('verifyUser', $_POST)) { $this->verifyUser();   } 
elseif (array_key_exists('updateAward', $_POST)) {  $this->updateAward();  } 
elseif (array_key_exists('updateBankAcc', $_POST)) { $this->updateBankAcc(); } 
elseif (array_key_exists('requestEpins', $_POST)) { $this->requestEpins(); } 
elseif (array_key_exists('approvePinRequest', $_POST)) {  $this->approvePinRequest(); } 
elseif (array_key_exists('deletePinRequest', $_POST)) {  $this->deletePinRequest();   } 
elseif (array_key_exists('requestIncentive', $_POST)) { $this->requestIncentive();   } 
elseif (array_key_exists('RestorePin', $_POST)) {  $this->RestorePin();    } 
elseif (array_key_exists('userid', $_POST)) { $this->userid(); } 
elseif (array_key_exists('UpdateUserSponsor', $_POST)) { $this->UpdateRegister(); } 
elseif (isset($_GET['tr_referenca'])) { $this->confirmPinPayment(); } 
elseif (isset($_GET['payment-confirmed']) AND isset($_SESSION['report'])) { $report = $_SESSION['report'];  } 
elseif (isset($_GET['action'])) { if ($_GET['action']=='logout'){session_destroy(); header('location: ../');     }   }

        return;
    }

















    function refLink()
    {
        $this->VerifySponsor();
        return;
    }

    function VerifySponsor()
    {
        global $db, $report, $count;

        $sponsor = $_SESSION['sponsor'] = sanitize($_POST['sponsor']);
        if ($this->validateUser($sponsor) == FALSE) {
            $report = 'Invalid sponsor ID. Please Try Again';
            $count = 1;
        } else {
            $report = 'Sponsor verified';
            $_SESSION['signup'] = 1;
        }

        return;
    }

    function SearchClient(){
    global $db,$report,$count;
    $Client = $_POST['client'];
    $userKey=$this->userToId($Client);
    if(empty($userKey)){
        $report = 'Clent not found, please try again'; $count=1;
        if(isset($_SESSION['SearchClient'])){ unset($_SESSION['SearchClient']); }
    }else{
        $_SESSION['SearchClient'] = $userKey;
        $report='Client successfully verified';
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


    function pinMultiplex($username)
    {
        global $db;
        $sql = $db->query("SELECT * FROM user WHERE user = '$username' ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        $pin = $row['pin'];
        $sq = $db->query("SELECT * FROM user WHERE pin = '$pin' ") or die(mysqli_error());

        return mysqli_num_rows($sq);
    }

     function userid()
    {
       $userid = ($this->userExist($_POST['userid'])==TRUE) ? sha1($this->userToKey($_POST['userid'])):'';
if($userid != '' AND $this->adminLevel()==TRUE){ header("location: finduserprofile.php?user=$userid");}

        return;
    }

    function findSponsorx()
    {
        global $db, $report, $count;

        $user = strtolower($_GET['reff']);
        if ($this->validateUser($user) == FALSE) {
            $report = 'You have entered an invalid sponsor ID. Please Try Again';
            $count = 1;
        } else {
            $_SESSION['signup'] = 2;
            $_SESSION['sponsorUsername'] = $user;
            $_SESSION['reff'] = $user;

            $_SESSION['sponsor'] = $this->validateUser($user, 1);
            $_SESSION['sponsorId'] = $this->validateUser($user, 2);
            $report = 'Sponsor Successfully Validated';

            header('location: ?');
            //$count=''; 

        }

        return;
    }
    function DeleteNews($sn){
        global $db, $report, $count;

        $newsImage = $_POST['newsImage'];
        $path = $_SERVER["DOCUMENT_ROOT"]."/cci/profile/news/".$newsImage;
        if ($sql = $db->query("DELETE FROM news WHERE sn='$sn'")) {
            unlink($path);
            $report = "Deleted Successfully";
        }
    }
    function DeleteMaterial($id)
    {
        global $db, $report, $count;

        $name = $_POST['name'];
        $path = $path = $_SERVER["DOCUMENT_ROOT"]."/cci/profile/material/" . $name;
        if ($sql = $db->query("DELETE FROM material WHERE sn='$id'")) {
            unlink($path);
            $report = "Deleted Successfully";
        }

    }

    function DownloadMaterial($id)
    {
        global $db, $report;

        $sql = $db->query("SELECT * FROM material WHERE sn='$id'");
        $row = $sql->fetch_assoc();

        $path = 'material/' . $row['material'];
        $new_name = $row['title'] . '.' . pathinfo($row['material'], PATHINFO_EXTENSION);
//        $report = $path;
        if (file_exists($path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $new_name);
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length:' . filesize('material/' . $row['material']));
            readfile('material/' . $row['material']);

            $newcount = $row['downloads'] + 1;
            $db->query("UPDATE material SET downloads='$newcount' WHERE sn='$id'");

        }

    }



    function UpdateNews(){
        global $db, $report, $count;

        $sn = $_POST['UpdateNews'];
        $title = sanitize($_POST['title']);
        $news = sanitize($_POST['news']);
        $newsFeed = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $loc = $_FILES['image']['tmp_name'];

        $ext = strtolower(pathinfo($newsFeed, PATHINFO_EXTENSION));
        $array = array('jpg', 'jpeg', 'png');
        if (in_array($ext, $array)) {
            if ($size < 2000000) {
                $newsImage = "Glee".time().".".$ext;
                if (move_uploaded_file($loc, 'news/' . $newsImage)) {
                    $time = time();
                    $sql = $db->query("UPDATE news SET title='$title', news='$news', image='$newsImage', time='$time' WHERE sn='$sn'");
//                    header("Location:managenews.php");
                    $report = "Updated Successfully";
                } else {
                    $count = 1;
                    $report = "Problem Uploading Material";
                }
            } else {
                $count = 1;
                $report = "File shouldn't be larger than 2MB";
            }

        } else {
            $count = 1;
            $report = "File Must Be in jpg,jpeg or png format only";
        }
    }

    function UploadNewsImage(){
        global $db, $report, $count;

        $title = sanitize($_POST['title']);
        $news = sanitize($_POST['news']);
        $newsFeed = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $loc = $_FILES['image']['tmp_name'];

        $ext = strtolower(pathinfo($newsFeed, PATHINFO_EXTENSION));
        $array = array('jpg', 'jpeg', 'png');
        if (in_array($ext, $array)) {
            if ($size < 2000000) {
                $newsImage = "Glee".time().".".$ext;
                if (move_uploaded_file($loc, 'news/' . $newsImage)) {
                    $time = time();
                    $sql = $db->query("INSERT INTO news(title,news,image,time) VALUES('$title','$news','$newsImage','$time')");
                    $report = "Uploaded Successfully";
                } else {
                    $count = 1;
                    $report = "Problem Uploading Material";
                }
            } else {
                $count = 1;
                $report = "File shouldn't be larger than 2MB";
            }

        } else {
            $count = 1;
            $report = "File Must Be in pdf,docx or zip format only";
        }
    }
    function UploadMaterial()
    {
        global $db, $report, $count;

        $title = sanitize($_POST['title']);
        $description = sanitize($_POST['description']);
        $material = $_FILES['material']['name'];
        $size = $_FILES['material']['size'];
        $loc = $_FILES['material']['tmp_name'];

        $ext = strtolower(pathinfo($material, PATHINFO_EXTENSION));
        $array = array('zip', 'pdf', 'docx');
        if (in_array($ext, $array)) {
            if ($size < 2000000) {
                if (move_uploaded_file($loc, 'material/' . $material)) {
                    $ql = $db->query("INSERT INTO material(title,description,material,size) VALUES('$title','$description','$material','$size')");
                    $report = $title . " Uploaded Successfully";
                } else {
                    $count = 1;
                    $report = "Problem Uploading Material";
                }
            } else {
                $count = 1;
                $report = "File shouldn't be larger than 2MB";
            }

        } else {
            $count = 1;
            $report = "File Must Be in pdf,docx or zip format only";
        }
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



    function confirmPayment()
    {
        global $db;
        $payref = $_GET['tr_reference'];


        if ($_GET['tr_reference'] == $_SESSION['referenc']) {
            $this->signupUser();
            $_SESSION['signup'] = 4;
        }
        unset($_SESSION['referenc']);
        header("location: ?payment-confirmed#online");
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


    function searchU()
    {
        global $db, $report, $count;
        $username = sanitize($_POST['u-ref']);
        $sql = $db->query("SELECT * FROM user WHERE user = '$username' ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        $uid = $_SESSION['user_idx'];
        $sn = IdToSn($uid);
        $sn2 = IdToSn($row['id']);
        $array = array();
        for($i=1;$i<=20;$i++){ $a = 'a'.$i;
            array_push($array, $row[$a]);
        }
        if($sql->num_rows < 1){
            $report = "Username Does Not Exists";
            $count = 1;
        }
        elseif($sn == $sn2){
            $report = "This Username is Yours ";
            $count = 1;
        }
        elseif(!in_array($sn, $array)){
            $report = "You can only search for Username in your Team";
            $count = 1;
        }
        else{
             $uref = sha1($row['sn']);
            $_SESSION['searchid'] = $row['id'];
            header("location: searchProfile.php?u-ref=$uref");
        }
       
        return;
    }


    function signupUserIni()
    {
        global $db, $report, $count;
        $report = '';

       $sponsor = $_SESSION['sponsor'] = strtolower($this->valEmpty($_POST['sponsor'], 'Surname'));
       $surname = $_SESSION['surname'] = ucwords(strtolower($this->valEmpty($_POST['surname'], 'Surname')));
       $othername = $_SESSION['othername'] = ucwords(strtolower($this->valEmpty($_POST['othername'], 'Other Names')));
        $phone = $_SESSION['phone'] = $this->valPhone($_POST['phone']);
        $email = $_SESSION['email'] = strtolower($this->valEmpty(sanitize($_POST['email']), 'E-mail'));

        $username = $_SESSION['username'] = strtolower($this->valEmpty(sanitize($_POST['username']), 'Username'));
        $password  = $this->valPass($_POST['password']);
        $password2 = $_POST['password2'];
        $gender = $_SESSION['gender']=$_POST['gender'];
        $state = $_SESSION['state']=$_POST['state'];
        $city = $_SESSION['city']=sanitize($_POST['city']);
        $address = $_SESSION['address']=sanitize(addslashes($_POST['address']));
        $birthday = $_SESSION['birthday']=sanitize($_POST['birthday']);

        if ($this->validateUser($sponsor) == FALSE) {
            $report .= 'Invalid sponsor ID';
            $count = 1;
        }
        elseif ($password != $password2) {
            $report .= "<br>Password confirmation failed, Try again";
            $count = 1;
        } elseif ($this->userExist($username) == TRUE) {
            $report .= "<br>A user with this username already exist. Try again.";
            $count = 1;
        } elseif (!isset($count)) {

            $id = $this->win_hashs(9);
            $pwd = password_hash($password, PASSWORD_BCRYPT);
            $sql = $db->query("INSERT INTO user (id,sponsor,surname,othername,phone,birthday,email,sex,state,address,city,user,pass)
VALUES('$id','$sponsor','$surname','$othername','$phone','$birthday','$email','$gender','$state','$address','$city','$username','$pwd')") or die('Cannot Connect to Server');
            $report = "<br>User Information successfully submitted, proceed to make Payment";
            

            if ($this->userExist($username) == TRUE) {$_SESSION['signup'] = 2; $_SESSION['user_idx'] = $id; header("location: portal/"); }
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
        } elseif (strlen($field) < 4) {
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

    function PinActivation()
    {
        global $db, $count, $report;

        $pin = sanitize(trim($_POST['pin']));

        $sql = $db->query("SELECT * FROM pin WHERE pin = '$pin' ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        $num = mysqli_num_rows($sql);
        if ($num == 1 AND $row['status']==0) {
            $id = $this->Uid();
            $sponsor = userName($id,'sponsor');
            $sponsorid = $this->userToId($sponsor);

       if($this->matExist($id)==FALSE){  $this->RegisterWithPin($id,$sponsorid,$pin);  }
        } else {
            $report = 'The PIN you entered is invalid or already used';
            $count = 1;
        }

        return;
    }
    
    function PinActivation()
    {
        global $db, $count, $report;

        $pin = sanitize(trim($_POST['pin']));

        $sql = $db->query("SELECT * FROM pin WHERE pin = '$pin' ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        $num = mysqli_num_rows($sql);
        if ($num == 1 AND $row['status']==0) {
            $id = $this->Uid();
            $sponsor = userName($id,'sponsor');
            $sponsorid = $this->userToId($sponsor);

       if($this->matExist($id)==FALSE){  $this->RegisterWithPin($id,$sponsorid,$pin);  }
        } else {
            $report = 'The PIN you entered is invalid or already used';
            $count = 1;
        }

        return;
    }



    function findUplineKey($key)
    {
        global $db;
      

        $sql = $db->query("SELECT * FROM user WHERE (a1='$key' OR a2='$key' OR a3='$key' OR a4='$key' OR a5='$key' OR a6='$key' OR a7='$key' OR a8='$key' OR a9='$key' OR a10='$key' OR a11='$key' OR a12='$key' OR a13='$key')
 AND active < 3 ORDER BY a1 ASC, a2 ASC, a3 ASC, a4 ASC, a5 ASC, a6 ASC,
   a7 ASC, a8 ASC, a10 ASC LIMIT 1") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        return $row['sn'];
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


    function serviceName($sn,$col='service')
    {
        global $db;
        $que = $db->query("SELECT * FROM ourservices WHERE sn = '$sn' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return $ro[$col];
    }


        function userName($user,$col='')
    {
        global $db;
        $que = $db->query("SELECT * FROM matuser WHERE sn = '$user' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        $val = $ro[$col];
        return $val;
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
            return htmlspecialchars($ro['surname'] . ' ' . $ro['othername']);
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
        $que = $db->query("SELECT * FROM user WHERE user = '$user' ") or die(mysqli_error());
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

    function userTeam($uidx)
    {
        global $db;
        $que = $db->query("SELECT * FROM matuser WHERE b1 = '$uidx' OR b2 = '$uidx' OR b3 = '$uidx' ") or die(mysqli_error());
        $num = $uidx>0 ? mysqli_num_rows($que) : 0;
        return $num;
    }


    function stageToTitle($st)
    {
        $t='';
      if($st==1){$t='Team Player'; }
      elseif($st==2){$t='Team Leader'; }
      elseif($st==3){$t='Team Coordinator'; }
      elseif($st==4){$t='District Manager'; }
      elseif($st==5){$t='Business Mentor'; }
      elseif($st==6){$t='Regional Director'; }
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
        global $db, $report, $count;
//$sql=$db->query("SELECT * FROM user WHERE user = '$username' OR email = '$email' " )or die(mysqli_error()); 
        $sql = $db->query("SELECT * FROM matuser WHERE id = '$id' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        if ($num > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }


    function Downline($user)
    {
        global $db;
        $sql = $db->query("select * FROM user WHERE a1 = '$user' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        return $num;
    }

        function inactiveReferral($uidy)
    {
        global $db;  
        $num=0;
       $sql = $db->query("SELECT * FROM user WHERE sponsor='$uidy' "); 
                    while($row = mysqli_fetch_assoc($sql)) {  $id = $row['id'];             
        $num += $this->matExist($id)==FALSE ? 1 : 0; 
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
//

     function findUpline($key){
        global $db;

        $sql = $db->query("SELECT * FROM matuser WHERE (a1='$key' OR a2='$key' OR a3='$key' OR a4='$key' OR a5='$key' OR a6='$key' OR a7='$key' OR a8='$key' OR a9='$key' OR a10='$key')
 AND active < 3 ORDER BY a1 ASC, sn ASC LIMIT 1") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        return $row['sn'];
    }
   
    function RegisterWithPin($userid,$sponsorid,$pin,$uplinex=0)
    {
        global $db, $report, $count;

        $user = $this->idToUser($userid);
        $b1 = $this->idToKey($sponsorid);
        $b2 = $this->idToKey($sponsorid,'b1');
        $b3 = $this->idToKey($sponsorid,'b2');

        $upline = $this->idToKey($sponsorid,'active')<3 ? $this->idToKey($sponsorid) : $this->findUpline($b1);
        $upline = $uplinex>0 ? $uplinex : $upline;
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
        $ctime = time();

        if(empty($sponsorid) OR empty($userid) OR empty($pin)){
            unset($_SESSION['signup']); $report='Sorry, Registration failed. Please repeat your registration '; $count=1;
        }else{

        $reg = $db->query("INSERT INTO matuser (id,user,a1,a2,a3,a4,a5,a6,a7,a8,b1,b2,b3,pin,ctime)
VALUES('$userid','$user','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$b1','$b2','$b3','$pin','$ctime')") or die('Cannot Connect to Server');

      if($pin==$this->idToKey($userid,'pin')){  
        $sql = $db->query("UPDATE pin SET status = 1, id = '$userid', used='$ctime' WHERE pin = '$pin' ") or die(mysqli_error());  }
        //Update Active and Sponsors
        $this->updateActiveAndRef($upline,$b1);
        
        //Send Email to Registered User
        $email = $this->idToUser($userid,'email');
        $this->emailer($email);
        //Promote Uplines
        if($this->stage1($a2)==12){ $this->stageUpdate($a2); }
       //Pay referral Bonus 0f NGN500
        $this->walletProcess($sponsorid,500,5,9,'Referral Bonus',$userid);
        $report = 'Account Activation successful';
     }
         return;
  }


    function RegisterWithCard($userid,$sponsorid,$uplinex=0)
    {
        global $db, $report, $count;

        $user = $this->idToUser($userid);
        $b1 = $this->idToKey($sponsorid);
        $b2 = $this->idToKey($sponsorid,'b1');
        $b3 = $this->idToKey($sponsorid,'b2');

        $upline = $this->idToKey($sponsorid,'active')<3 ? $this->idToKey($sponsorid) : $this->findUpline($b1);
        $upline = $uplinex>0 ? $uplinex : $upline;
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
        $ctime = time();

        if(empty($sponsorid) OR empty($userid)){
            unset($_SESSION['signup']); $report='Sorry, Registration failed. Please repeat your registration '; $count=1;
        }else{

        $reg = $db->query("INSERT INTO matuser (id,user,a1,a2,a3,a4,a5,a6,a7,a8,b1,b2,b3,pin,ctime)
VALUES('$userid','$user','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$b1','$b2','$b3','card','$ctime')") or die('Cannot Connect to Server');

        //Update Active and Sponsors//
        $this->updateActiveAndRef($upline,$b1);
        
        //Send Email to Registered User
        $email = $this->idToUser($userid,'email');
        $this->emailer($email);
        //Promote Uplines
        if($this->stage1($a2)==12){ $this->stageUpdate($a2); }
       //Pay referral Bonus 0f NGN500
        $this->walletProcess($sponsorid,500,5,9,'Referral Bonus',$userid);
        $report = 'Account Activation successful';
     }
         return;
  }


    function RegisterWithSales($userid,$sponsorid,$uplinex=0)
    {
        global $db, $report, $count;

        $user = $this->idToUser($userid);
        $b1 = $this->idToKey($sponsorid);
        $b2 = $this->idToKey($sponsorid,'b1');
        $b3 = $this->idToKey($sponsorid,'b2');

        $upline = $this->idToKey($sponsorid,'active')<3 ? $this->idToKey($sponsorid) : $this->findUpline($b1);
        $upline = $uplinex>0 ? $uplinex : $upline;
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
        $ctime = time();

        if(empty($sponsorid) OR empty($userid)){
            unset($_SESSION['signup']); $report='Sorry, Registration failed. Please repeat your registration '; $count=1;
        }else{

        $reg = $db->query("INSERT INTO matuser (id,user,a1,a2,a3,a4,a5,a6,a7,a8,b1,b2,b3,pin,ctime)
VALUES('$userid','$user','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$b1','$b2','$b3','sales','$ctime')") or die('Cannot Connect to Server');

        //Update Active and Sponsors//
        $this->updateActiveAndRef($upline,$b1);
        
        //Send Email to Registered User
        $email = $this->idToUser($userid,'email');
        $this->emailer($email);
        //Promote Uplines
        if($this->stage1($a2)==12){ $this->stageUpdate($a2); }
       //Pay referral Bonus 0f NGN500
        $this->walletProcess($sponsorid,500,5,9,'Referral Bonus',$userid);
        $report = 'Account Activation successful';
     }
         return;
  }

    function RegisterWithWallet($userid,$sponsorid,$uplinex=0)
    {
        global $db, $report, $count;

        $user = $this->idToUser($userid);
        $b1 = $this->idToKey($sponsorid);
        $b2 = $this->idToKey($sponsorid,'b1');
        $b3 = $this->idToKey($sponsorid,'b2');

        $upline = $this->idToKey($sponsorid,'active')<3 ? $this->idToKey($sponsorid) : $this->findUpline($b1);
        $upline = $uplinex>0 ? $uplinex : $upline;
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
        $ctime = time();

        if(empty($sponsorid) OR empty($userid)){
            unset($_SESSION['signup']); $report='Sorry, Registration failed. Please repeat your registration '; $count=1;
        }else{

        $reg = $db->query("INSERT INTO matuser (id,user,a1,a2,a3,a4,a5,a6,a7,a8,b1,b2,b3,pin,ctime)
VALUES('$userid','$user','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$b1','$b2','$b3','wallet','$ctime')") or die('Cannot Connect to Server');

        //Update Active and Sponsors//
        $this->updateActiveAndRef($upline,$b1);
        
        //Send Email to Registered User
        $email = $this->idToUser($userid,'email');
        $this->emailer($email);
        //Promote Uplines
        if($this->stage1($a2)==12){ $this->stageUpdate($a2); }
       //Pay referral Bonus 0f NGN500
        $this->walletProcess($sponsorid,500,5,9,'Referral Bonus',$userid);
        $report = 'Account Activation successful';
     }
         return;
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


   


function UpdateRegister()
    {
        global $db, $report, $count;
$sponsor = $_POST['sponsor'];
$upline = $_POST['upline'];
$ssn = $_POST['UpdateUserSponsor'];

        $que = $db->query("SELECT * FROM user WHERE sn = '$upline' ") or die(mysqli_error());
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
        $a11 = $ro['a10'];
        $a12 = $ro['a11'];
        $a13 = $ro['a12'];
        $a14 = $ro['a13'];
        $a15 = $ro['a14'];
        $a16 = $ro['a15'];



        //$id = $this->win_hashs(8);

        $reg = $db->query("UPDATE user SET sponsor='$sponsor',a1='$a1',a2='$a2',a3='$a3',a4='$a4',a5='$a5',a6='$a6',a7='$a7',a8='$a8',a9='$a9',a10='$a10',a11='$a11',a12='$a12',a13='$a13',a14='$a14',a15='$a15',a16='$a16' WHERE sn='$ssn' ") or die('Cannot Connect to Server 2');

        $down = $db->query("SELECT * FROM user WHERE a1 = '$upline' ") or die(mysqli_error());
        $nd = mysqli_num_rows($down);

        $upd = $db->query("UPDATE user SET active='$nd' WHERE sn = '$upline' ");
        $sp = $this->wildSponsored($sponsor);
        $updx = $db->query("UPDATE user SET sp='$sp' WHERE sn = '$sponsor' ");

        if($this->level2($a2)==2){$sql = $db->query("UPDATE user SET level='2' WHERE sn = '$a2' ");}
      $report ='Operation Successful ';

        return;
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




      function ModifyMallItemPhoto(){
        global $db, $report, $count,$userKey;

         $id = $_GET['item'];
        
        $photo = $_FILES['image']['name'];
        $size = $_FILES['image']['size'];
        $loc = $_FILES['image']['tmp_name'];
        $ctime = time();
        $trno = $this->win_hash(8);

        $ext = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
        $array = array('jpg', 'jpeg', 'png');
        if (in_array($ext, $array)) {
            if ($size <= 1000000) {
                $photo = $this->win_hashs(22).".".$ext;
                if (move_uploaded_file($loc, '../gstore/mall/' . $photo)) {
                    
      $sql = $db->query("UPDATE mallitem SET photo='$photo' WHERE id='$id' AND rep='$userKey' ");
if($sql){
                    $report = "Item Image Update Successfully";    }
                } else {
                    $count = 1;
                    $report = "Problem Uploading Photograph";
                }
            } else {
                $count = 1;
                $report = "File should not be larger than 1MB";
            }

        } else {
            $count = 1;
            $report = "File Must Be in jpg,jpeg or png format only";
        }
        return;
    }   



function ModifyMallItem(){
        global $db, $report, $count,$userKey;

        $id = $_GET['item'];
        $cat = $_POST['cat'];
        $item = sanitize($_POST['item']);
        $des = sanitize($_POST['des']);
         $cost = sanitize($_POST['cost']);
       
                    
$sql = $db->query("UPDATE mallitem SET cat='$cat',item='$item',des='$des',cost='$cost' WHERE id='$id' AND rep='$userKey' ");
                    $report = "Updated Successfully";
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


    function ModifyItemPosition(){
        global $db, $report, $count,$userKey;

        $id = $_GET['item'];
        $act = $_POST['act'];
        $type = $_POST['type'];
        $link = addslashes(sanitize($_POST['link']));
       
                    
$sql = $db->query("UPDATE mallitem SET type='$type',status='$act',link='$link' WHERE id='$id' ");
                    $report = "Updated Successfully";
            return;
    }     
    function DeleteMallItem(){
        global $db, $report, $count,$userKey;

        $id = $_GET['item'];    
                    
$sql = $db->query("DELETE FROM mallitem WHERE id='$id' AND rep='$userKey' ");
                    $report = "Item Deleted Successfully";
            return;
    }   

    function AddCategory()
    {
        global $db,$userKey,$report,$count;
        $cat = addslashes(sanitize($_POST['cat']));
        $des = addslashes(sanitize($_POST['des']));

        $photo = $_FILES['image']['name'];
        $loc = $_FILES['image']['tmp_name'];
        $ctime = time();
        $trno = $this->win_hash(8);

        $ext = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
        $array = array('jpg', 'jpeg', 'png');
        if (in_array($ext, $array)) {

                $photo = $this->win_hashs(8).".".$ext;
             move_uploaded_file($loc, '../gstore/mall/' . $photo);
        $id = $this->win_hashs(45);
        $msg = $db->query("INSERT INTO mallcat (cat,des,rep,id,photo) VALUES('$cat','$des','$userKey','$id','$photo')") or die(mysqli_error());
$report = 'Category Created Successfully';
}else{$report = 'Invalid image format'; $count=1; }
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



    function AddEbook()
    {
        global $db,$userKey,$report,$count;
        $ebook = addslashes(sanitize($_POST['ebook']));
        $des = addslashes(sanitize($_POST['des']));

        $photo = $_FILES['image']['name'];
        $loc = $_FILES['image']['tmp_name'];

        $pdf = $_FILES['pdf']['name'];
        $loc2 = $_FILES['pdf']['tmp_name'];

        $ctime = time();
        $trno = $this->win_hash(8);

        $ext = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
        $array = array('jpg', 'jpeg', 'png');
        if (in_array($ext, $array) AND strtolower(pathinfo($pdf, PATHINFO_EXTENSION))=='pdf') {

                $photo = $this->win_hashs(12).".".$ext;
             move_uploaded_file($loc, '../gstore/e_book/' . $photo);

             $pdf = $this->win_hashs(12).".pdf";
             move_uploaded_file($loc2, '../gstore/e_book/' . $pdf);

        $id = $this->win_hashs(44);
        $msg = $db->query("INSERT INTO ebook (book,des,rep,id,ebook,cover) VALUES('$ebook','$des','$userKey','$id','$pdf','$photo')") or die(mysqli_error());
$report = 'E-book Created Successfully';
}else{$report = 'Invalid image/file format'; $count=1; }
        return;
    }


    function ModifyCategory()
    {
        global $db,$userKey,$report;
        $cat = addslashes(sanitize($_POST['cat']));
        $des = addslashes(sanitize($_POST['des']));
        $id = $_GET['cat'];
        $msg = $db->query("UPDATE mallcat SET cat='$cat', des='$des' WHERE id='$id' ") or die(mysqli_error());
$report = 'Category Modified Successfully';
        return;
    }

        function ModifyEbook()
    {
        global $db,$userKey,$report;
        $ebook = addslashes(sanitize($_POST['ebook']));
        $des = addslashes(sanitize($_POST['des']));
        $id = $_GET['book'];
        $msg = $db->query("UPDATE ebook SET book='$ebook', des='$des' WHERE id='$id' ") or die(mysqli_error());
$report = 'E-book Modified Successfully';
        return;
    }

    function catName($id,$col='cat'){
        global $db;
        $que = $db->query("SELECT * FROM mallcat WHERE id = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return stripslashes($ro[$col]);
    } 
    function eventName($id,$col='title'){
        global $db;
        $que = $db->query("SELECT * FROM event WHERE id = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return stripslashes($ro[$col]);
    }    

    function bookName($id,$col='book'){
        global $db;
        $que = $db->query("SELECT * FROM ebook WHERE id = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return stripslashes($ro[$col]);
    }

    function itemName($id,$col='item'){
        global $db;
        $que = $db->query("SELECT * FROM mallitem WHERE id = '$id' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return stripslashes($ro[$col]);
    }

     function catName2($sn,$col='cat'){
        global $db;
        $que = $db->query("SELECT * FROM mallcat WHERE sn = '$sn' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        return stripslashes($ro[$col]);
    }

    function catNum($sn){
        global $db;
        $que = $db->query("SELECT * FROM mallitem WHERE cat = '$sn' ") or die(mysqli_error());
        return mysqli_num_rows($que);
    }

    function nextUpline($ge)
    {
        global $db;
        $sponsor = $_SESSION['sponsorId'];
        $gen = 'a' . $ge;

        $matrix = MATRIX;
        $que = $db->query("SELECT * FROM user WHERE $gen = '$sponsor' AND active < '$matrix' ORDER BY sn ASC LIMIT 1") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        $find = mysqli_num_rows($que);
        $user = $ro['sn'];
        if ($find < 1) {
            $ge = $ge + 1;
            $user = $this->nextUpline2($ge);
        }
        return $user;
    }

    function nextUpline2($ge)
    {
        global $db;
        $sponsor = $_SESSION['sponsorId'];
        $gen = 'a' . $ge;
        $matrix = MATRIX;

        $que = $db->query("select * FROM user WHERE $gen = '$sponsor' AND active < '$matrix' ORDER BY sn ASC LIMIT 1") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        $find = mysqli_num_rows($que);
        $user = $ro['sn'];
        if ($find < 1) {
            $ge = $ge + 1;
            $user = $this->nextUpline($ge);
        }
        return $user;
    }


    function win_hash($length)
    {
        return substr(str_shuffle(str_repeat('123456789', $length)), 0, $length);
    }

    function win_hashs($length)
    {
        return substr(str_shuffle(str_repeat('123456789abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);
    }

    function resetPass()
    {
        global $db, $report, $count;
        $email = strtolower(trim(sanitize($_POST['emailreset'])));
        $sql = $db->query("SELECT * FROM user WHERE email = '$email' ") or die('Could not initiate password reset');
        $row = mysqli_fetch_array($sql);
        $reset_order = $this->win_hash(41);
        $find = mysqli_num_rows($sql);
        if ($find == 0) {
            $report = 'This email does not exist in our system, check and try again';
            $count = 1;
        } elseif ($find == 1) {
            $sql = $db->query("UPDATE user SET code='$reset_order' WHERE email = '$email' ") or die('Could not initiate password reset');
            $message = 'You have requested for a password reset. Follow the link below to reset your password:<br>';
            $message .= 'https://www.gleeglobal.com/accountreset.php?request-index=' . $reset_order;
            $subject = 'Smile We-care Password Recovery';
            $this->emailerAll($email, $message, $subject);
            $report = 'We have sent you an e-mail containing your password reset link. Follow the link to reset your password';
        }

        return;
    }


    function updateSignup()
    {
        global $db, $report, $count;
        $username = $_SESSION['username'];
        $surname = ucwords(strtolower($this->valEmpty($_POST['surname'], 'Surname')));
        $othername = ucwords(strtolower($this->valEmpty($_POST['othername'], 'Other Names')));

        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = ucwords(strtolower($this->valEmpty($_POST['city'], 'City')));
        $address = addslashes(ucwords(strtolower($this->valEmpty($_POST['address'], 'Address'))));
        $phone = $this->valPhone($_POST['phone']);
        $bank = ucwords(strtolower($this->valEmpty($_POST['bank'], 'Bank')));
        $accountno = $this->valEmpty($_POST['accountno'], 'Account Number');
        $course = $_POST['course'];

        $dob = $this->valEmpty($_POST['dob'], 'Date of Birth');
        $sex = $_POST['sex'];
        $accname = ucwords(strtolower($this->valEmpty($_POST['accname'], 'Account Name')));
//$officeaddress=addslashes(ucwords(strtolower($_POST['officeaddress'])));

        $photo = isset($_FILES['image']) ? str_replace(' ', '-', $username) . $_FILES['image']['name'] : 'user.png';
        if (isset($_SESSION['user_idx'])) {
            define('upload', 'photo/');
        } else {
            define('upload', 'dashboard/photo/');
        }
        $success = move_uploaded_file($_FILES['image']['tmp_name'], upload . $photo);


        $db->query("UPDATE user SET country='$country', state='$state', city='$city', phone='$phone', address='$address', bank='$bank', accountno='$accountno', surname='$surname', othername='$othername', sex='$sex', dob='$dob', accname='$accname', photo='$photo' WHERE user = '$username' ");
        $id = $this->userName3($username);
        $this->courseOrder2($id, $course); //submit required course
        $report = 'User Registration Information Successfully Updated!';
        $count = 0;
        $_SESSION['signup'] = 6;

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


    function courseOrder2($userkey, $course)
    {
        global $db;

        $tno = substr(str_shuffle(str_repeat('1234567890', 10)), 0, 10);
        $sql = $db->query("INSERT INTO download (id,course,tno) VALUES ('$userkey','$course','$tno')");

        return;
    }


    function resetPassOrder()
    {
        global $db;
        $order = isset($_GET['request-index']) ? $_GET['request-index'] : '';
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
        $pwd1 = md5($_POST['password']);
        $pwd2 = md5($_POST['password2']);
        $reset_order = $this->win_hash(41);
        $code = $this->resetPassOrder() ? $_GET['request-index'] : 0;
        if ($pwd1 == $pwd2) {
            $db->query("UPDATE user SET pass='$pwd1', code='$reset_order' WHERE code = '$code' ");
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


    function emailerAll($email, $message, $subject)
    {
        global $surname;
        $headers = 'From: GLEE GLOBAL <admin@gleeglobal.com>' . "\r\n";
        $headers .= 'Reply-To: admin@gleeglobal.com' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $send = mail($email, $subject, $message, $headers);
        return;
    }


    function emailer($email)
    {
    
        $headers = 'From: GLEE GLOBAL <admin@gleeglobal.com>' . "\r\n";
        $headers .= 'Reply-To: admin@gleeglobal.com' . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


        $subject = 'WELCOME TO GLEE GLOBAL EMPOWERMENT';
        $mailmessage = "<p>Welcome " . ucwords($_SESSION['username']) . '<br>Your registration with GLEE GLOBAL EMPOWERMENT is successful! You have joined a network of people that are passionate about self empowerment, finacial freedom and continuous improvement towards the next stages of their lives.  <br>In GLEE GLOBAL EMPOWERMENT we inspire greatness, team and entrepreneurial spirit, willingness to help each other and a motivation to hit our life goals in less time than ever thought possible. </p>
<p>
    This platform offers two possibilities for all members. It provides an opportunity to get active mentorship from people in enviable position and makes it possible for you to empower others by sharing your God-given talents in ways that leave people better than what they were. This is what GLEE GLOBAL EMPOWERMENT exist to achieve and the testimonies we receive are quite reassuring and affirms the fact that we are actually empowering people in no small ways. We are glad you are now part of our unbeatable team and we can work together to achieve global relevance through consistent quality transformational impacts across continents.</p>

    <p>Our Electronic Library provides free and unlimited access to content-rich books and educational materials. Feel free to take advantage of them. We provide an exciting online shopping experience that allows you to buy cheap items directly from others and enables you to sell your own items as well and thereby drive massive patronage to your goods and services.</p>

   
<p> <br>
 You can do mere than simply network when you login to your account at 
https://gleeglobal.com/login.php
<br></p>
 <p>Thank you for being a part of us. We wish you a very fruitful business colaboration.<br> <br> 

 Human Resource Department,<br>
 GLEE GLOBAL EMPOWERMENT<br> <br> </p>';


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

    function SearchDownline()
    {
        global $db, $report, $count;
        $randomKey = $this->userName('sn');
        $username = $_POST['u-ref'];


        $a = 1;
        $nu = 0;
        while ($a <= 16) {
            $b = $a++;
            $gen = 'a' . $b;
            $qu = $db->query("SELECT * FROM user WHERE $gen = '$randomKey' AND user = '$username' ") or die(mysqli_error());
            $nu += mysqli_num_rows($qu);
        }

        if ($nu > 0) {
            $sql = $db->query("SELECT * FROM user WHERE user = '$username' ") or die(mysqli_error());
            $row = mysqli_fetch_assoc($sql);
            $uref = sha1($row['sn']);
            header("location: generations.php?u-ref=$uref");
        } else {
            $report = 'Error! search could find the user in your team. confirm and try again';
            $count = 1;
        }
        return;
    }


//*
    function LoginUsers()
    {
        global $db, $report, $count;
        $username = strtolower(sanitize($_POST['username']));
        $password = $_POST['password'];
        $sql = $db->query("SELECT * FROM user WHERE user='$username' ");


        if (mysqli_num_rows($sql) == 1) {
            $row = mysqli_fetch_array($sql);
            $status = $row['status'];

            if (password_verify($password, $row['pass'])) {
                if ($status == 1) {
                    $_SESSION['user_idx'] = $row['id'];
                     header('location:portal/');
                } else {
                    $report = 'Your user account has been deactivated, contact the system administrator ';
                    $count = 1;
                }
            } else {
                $report = 'Incorrect Login details, try again';
                $count = 1;
            }
        } else {
            $report = 'Incorrect Login details, try again';
            $count = 1;
        }
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


    function pinMultiple($username)
    {
        global $db;
        $sql = $db->query("SELECT * FROM user WHERE user = '$username' ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        $pin = $row['pin'];
        $sq = $db->query("SELECT * FROM user WHERE pin = '$pin' ") or die(mysqli_error());

        return mysqli_num_rows($sq);
    }

    function pinMultiple2($username)
    {
        global $db;
        $list = '';
        $a = 1;
        $sql = $db->query("SELECT * FROM user WHERE user = '$username' ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        $pin = $row['pin'];
        $sq = $db->query("SELECT * FROM user WHERE pin = '$pin' ") or die(mysqli_error());
        while ($ro = mysqli_fetch_assoc($sq)) {
            $b = $a++;
            $list .= '<p>' . $b . '. ' . $ro['pin'] . ' ' . $ro['user'] . '</p>';
        }
        return $list;
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
     $success = move_uploaded_file($_FILES['image']['tmp_name'], upload.$name2);

$sqlw = $db->query("INSERT INTO user2 (id,type,card) VALUES ('$id',1,'$name2') ");
$report = 'User Profile Photo Successfully Submitted!';
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
        $keys = $_GET['u-ref'];
        $name = 'a' . date('ymdhis') . $_FILES['image']['name'];
        define('upload', 'photo/');
        $success = move_uploaded_file($_FILES['image']['tmp_name'], upload . $name);

        $sqlw = $db->query("UPDATE user SET photo = '$name' WHERE sha1(sn) = '$keys' ");
        $report = 'User Profile Photo Successfully Update!';
        return;
    }
    function SearchUserMessage(){
        global $db,$report,$count;
        $user = sanitize($_POST['username']);

        $sql = $db->query("SELECT * FROM user WHERE user='$user'");
        if($sql->num_rows < 1){$report = "Username Does Not Exists"; $count = 1;}
        else{
            $row = $sql->fetch_assoc();
            header("Location:?ugh=".$row['id']);
        }
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

    // function chkLogin()
    // {

    //     if ($_SERVER['SCRIPT_NAME'] == '/glee/login.php' OR $_SERVER['SCRIPT_NAME'] == '/login.php') {
    //     } elseif ($_SERVER['SCRIPT_NAME'] == '/glee/register.php' OR $_SERVER['SCRIPT_NAME'] == '/register.php') {
    //     } elseif (isset($_SESSION['user_idx']) AND $this->userExist2($_SESSION['user_idx'])==TRUE) {
    //     } else { 
    //     $this->LogoutUser();   
    //      }
    //     return;
    // }    

    function checkLogin(){

if (!empty($this->Uid()) AND $this->userExist2($this->Uid())==TRUE) {} 
    else {  $this->LogoutUser();   }
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
$amount = ($this->isActive($id)==TRUE AND $this->hasPurchased($id)==FALSE) ? $amount-2500 : $amount;
if($this->wallet($id) >= $amount){
$this->walletProcess($id,$amount,5,3,'Product Purchase: '.ucwords(strtolower($this->serviceName($item))),$item);
 $amount2 = $this->isActive($id)==TRUE ? $amount : $amount-2500;
if($this->isActive($id)==FALSE){     //Activate the user if inactive
    $sponsor = userName($id,'sponsor');
    $sponsorid = $this->userToId($sponsor);
    $this->RegisterWithSales($id,$sponsorid); }
    //Register the sales
    $this->newSales($id,$amount,$amount2,$item);
    //Give value here. Identify items by serial number 
    $this->giveItemValue($id,$item);
    //share sales bonuses
if($amount2>0){ $this->sharingFormula($id,$amount2); }
unset($_SESSION['item']);
}else{
$report = 'Insufficient Fund in Wallet. Please, fund your wallet to complete this transaction'; $count=1;
}
return;
}


function giveItemValue($id,$item){
if($item==1){/* do this */ }

return;
}


function newSales($id,$amount,$amount2,$item){
    global $db;
        $b1 = $this->idToKey($id,'b1');
        $b2 = $this->idToKey($id,'b2');
        $b3 = $this->idToKey($id,'b3'); 
        $ctime = time();
        $expiry = $ctime+60*60*24*$this->serviceName($_SESSION['item'],'duration'); //subscribe for 6 months
        $trno = $this->win_hash(10);
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

    function sharingFormula($id,$amount){
        $b1 = $this->idToKey($id,'b1');
        $b2 = $this->idToKey($id,'b2');
        $b3 = $this->idToKey($id,'b3');

    $b1cash = $this->b1Percent($b1)*$amount*0.01;
    $b2cash = $this->b2Percent($b2)*$amount*0.01;
    $b3cash = $this->b3Percent($b3)*$amount*0.01;

    $b1id = $this->keyToId($b1);
    $b2id = $this->keyToId($b2);
    $b3id = $this->keyToId($b3);

                  $this->walletProcess($b1id,$b1cash,5,21,'Index 1 Sales Bonus',$id);
    if($b2cash>0){$this->walletProcess($b2id,$b2cash,5,22,'Index 2 Sales Bonus',$id);}
    if($b3cash>0){$this->walletProcess($b3id,$b3cash,5,23,'Index 3 Sales Bonus',$id);}
    return;   
    }

function b1Percent($b1){
    $level = $this->keyToLevel($b1);
    $p=0;
        if($level==1){$p=10;}
    elseif($level==2){$p=20;}
    elseif($level==3){$p=20;}
    elseif($level==4){$p=30;}
    elseif($level==5){$p=40;}
    return $p;
}

function b2Percent($b2){
    $level = $this->keyToLevel($b2);
    $p=0;
        if($level==1){$p=0;}
    elseif($level==2){$p=10;}
    elseif($level==3){$p=10;}
    elseif($level==4){$p=10;}
    elseif($level==5){$p=10;}
    return $p;
}

function b3Percent($b3){
    $level = $this->keyToLevel($b3);
    $p=0;
        if($level==1){$p=0;}
    elseif($level==2){$p=0;}
    elseif($level==3){$p=10;}
    elseif($level==4){$p=10;}
    elseif($level==5){$p=10;}
    return $p;
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

    }

    function changePassword()
    {
        global $db, $report, $count, $userKey;
        $pa = $this->userName('pass');
        $currentpass = md5($_POST['currentpass']);
        $newpass = md5($_POST['newpass']);
        $newpass2 = md5($_POST['newpass2']);

        if ($pa == $currentpass) {
            if ($newpass == $newpass2) {
                $db->query("UPDATE user SET pass='$newpass' WHERE id = '$userKey' ");
                $report = 'User Password Successfully Changed!';
            } else {
                $report = 'New Password Mismatch, Try Again';
                $count = 1;
            }

        } else {
            $report = 'Password Mismatch, Try Again';
            $count = 1;
        }

        return;
    }


    function changePassword2()
    {
        global $db, $report, $count;
        $keys = $_GET['u-ref'];
        $pa = $this->userName('pass');
        $currentpass = md5($_POST['currentpass']);
        $newpass = md5($_POST['newpass']);
        $newpass2 = md5($_POST['newpass2']);

        if ($pa == $currentpass) {
            if ($newpass == $newpass2) {
                $db->query("UPDATE user SET pass='$newpass' WHERE sha1(sn) = '$keys' ");
                $report = 'User Password Successfully Changed!';
            } else {
                $report = 'New Password Mismatch, Try Again';
                $count = 1;
            }

        } else {
            $report = 'Password Mismatch, Try Again';
            $count = 1;
        }

        return;
    }




    //Genrating Row Data


    //Total Downlines
    function Downlines($key)
    {
        global $db;
       
            $qu = $db->query("SELECT * FROM user WHERE a1='$key' OR a2='$key' OR a3='$key' OR a4='$key' OR a5='$key' OR a6='$key' OR a7='$key' OR a8='$key' OR a9='$key' OR a10='$key' OR a11='$key' OR a12='$key' OR a13='$key' OR a14='$key' ") or die(mysqli_error());
        return mysqli_num_rows($qu);
    }

    //Total Sponsored by User               
    function Sponsored()
    {
        global $db;
        $randomKey = $this->userName('sn');
        $qu = $db->query("select * FROM user WHERE sponsor = '$randomKey' ") or die(mysqli_error());
        $nu = mysqli_num_rows($qu);
        return $nu;
    }


    //Points Generated By User
    function Point()
    {
        return ($this->Sponsored() * $this->sponsorpoint) + $this->Downlines();
    }

    function teamPoint()
    {
        return $this->Downlines();
    }


    function sponsorPoint()
    {
        return $this->Sponsored() * $this->sponsorpoint;
    }

    function levelRate()
    {
        return ($this->Level() * 100) + $this->pointrate;
    }

    //Loanable Amount
    function Potential()
    {
        return $this->Point() * $this->levelRate();
    }


    function Gen($e)
    {
        global $db;
        $randomKey = $this->userName('sn');
        $gen = 'a' . $e;
        $q = $db->query("SELECT * FROM user WHERE $gen ='$randomKey' ") or die(mysqli_error());
        return mysqli_num_rows($q);
    }


    function wildGen($key, $e)
    {
        global $db;
        $gen = 'a' . $e;
        $q = $db->query("SELECT * FROM user WHERE $gen ='$key' ") or die(mysqli_error());
        return mysqli_num_rows($q);
    }


    function legGen($e, $leg)
    {
        global $db;
        $e = ($e > 0) ? $e : 1;
        $randomKey = $this->legKey($leg);
        $gen = 'a' . $e;
        $q = $db->query("SELECT * FROM user WHERE $gen ='$randomKey' ");
        return mysqli_num_rows($q);
    }

//User Stage level
    function Level($t = '')
    {
        global $db;
        $randomKey = $this->userName('sn');

        $sql = $db->query("SELECT * FROM user WHERE a1 = '$randomKey' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);

        $a = 1;
        $nu = 0;
        while ($a <= 16) {
            $b = $a++;
            $gen = 'a' . $b;
            $target = MATRIX ** $b;
            $qu = $db->query("SELECT * FROM user WHERE $gen = '$randomKey' ") or die(mysqli_error());
            $nu = mysqli_num_rows($qu);
            if ($num < MATRIX) {
                $level = 0;
                $targ = MATRIX;
            } elseif ($nu == $target) {
                $level = $b;
                $targ = $target;
            }
        }

        if ($level <= 1) {
            $stagelevel = 0;
        } elseif ($level == 2) {
            $stagelevel = 1;
        } elseif ($level == 3) {
            $stagelevel = 0;
        } elseif ($level == 4) {
            $stagelevel = 1;
        } elseif ($level == 5) {
            $stagelevel = 2;
        } elseif ($level == 6) {
            $stagelevel = 0;
        } elseif ($level == 7) {
            $stagelevel = 1;
        } elseif ($level == 8) {
            $stagelevel = 2;
        } elseif ($level == 9) {
            $stagelevel = 0;
        } elseif ($level == 10) {
            $stagelevel = 1;
        } elseif ($level == 11) {
            $stagelevel = 2;
        } elseif ($level == 12) {
            $stagelevel = 0;
        } elseif ($level == 13) {
            $stagelevel = 1;
        } elseif ($level == 14) {
            $stagelevel = 2;
        } elseif ($level == 15) {
            $stagelevel = 0;
        } elseif ($level == 16) {
            $stagelevel = 1;
        } elseif ($level == 17) {
            $stagelevel = 2;
        } elseif ($level == 18) {
            $stagelevel = 0;
        } elseif ($level == 19) {
            $stagelevel = 1;
        } elseif ($level == 20) {
            $stagelevel = 2;
        } elseif ($level == 21) {
            $stagelevel = 0;
        }

        //stg = stages counting from 1;
        if ($this->Sponsored() < 2) {
            $stage = 'Waiting';
            $stg = 1;
            $nextstagelevel = 1;
        } elseif ($level < 1) {
            $stage = 'Waiting';
            $stg = 1;
            $nextstagelevel = 1;
        } elseif ($level < 3) {
            $stage = 'Induct';
            $stg = 2;
            $nextstagelevel = 3;
        } elseif ($level < 6) {
            $stage = 'Stage 1';
            $stg = 3;
            $nextstagelevel = 6;
        } elseif ($level < 9) {
            $stage = 'Stage 2';
            $stg = 4;
            $nextstagelevel = 9;
        } elseif ($level < 12) {
            $stage = 'Stage 3';
            $stg = 5;
            $nextstagelevel = 12;
        } elseif ($level < 15) {
            $stage = 'Stage 4';
            $stg = 6;
            $nextstagelevel = 15;
        } elseif ($level < 18) {
            $stage = 'Stage 5';
            $stg = 7;
            $nextstagelevel = 18;
        } elseif ($level < 21) {
            $stage = 'Stage 6';
            $stg = 8;
            $nextstagelevel = 21;
        }
        if ($t == 1) {
            return $stage;
        } elseif ($t == 2) {
            return $stg;
        } elseif ($t == 3) {
            return MATRIX ** ($level + 1);
        } elseif ($t == 4) {
            return $nextstagelevel;
        } elseif ($t == 5) {
            return $stagelevel;
        } elseif ($t == 7) {
            return $stage . ',' . $stagelevel;
        } else {
            return $level;
        }

    }


    function findLevel($key)
    {
        global $db;
        $a = 1;
        $level = 1;
        while ($a <= 16) {
            $b = $a++;
            $nu = 0;
            $gen = 'a' . $b;
            $target = MATRIX ** $b;
            $qu = $db->query("SELECT * FROM user WHERE $gen = '$key' ") or die(mysqli_error());
            while ($row = mysqli_fetch_assoc($qu)) {

                if ($this->wildSponsored($row['sn']) > 1) {
                    $nu += 1;
                }
                if ($nu == $target) {
                    if ($this->wildSponsored($key) > 1) {
                        $level = $b + 1;
                    } else {
                        $level = $b + 1;
                    }
                }
            }
        }
        if ($this->wildSponsored($key) < 2) {
            $level = 0;
        }
        return $level;
    }


    /*
function findLevelx($key){
global $db;
//$key = $this->userName('sn'); 
$lkey = $key;
$level = 0;  
$prog=1;
$a = 1;   //$sq=$db->query("SELECT * FROM levels " );
            while($a <= 10){$b = $a++;

$gen = 'a'.$b; $target = (MATRIX**$b)/2;
            //$sql=$db->query("SELECT * FROM user WHERE $gen = '$key' AND active = 2 " )or die(mysqli_error());
                if($b==1){$m=0;}elseif($b==2){$m=1;} else{$m=(MATRIX**($b-3)); }
            if($this->legL($this->wildLegKey($lkey))-$m >= $target AND $this->legL($this->wildLegKey($lkey,1))-$m >= $target AND $prog==1){$level += 1; $prog=1; }else{$prog=0;} 
        }

        $levels = ($this->wildSponsored($key)>1) ? $level+1 : 0;

        return $levels;
}
*/


    function findLevelx($key)
    {
        global $db;
//$key = $this->userName('sn'); 
        $lkey = $key;
        $level = 0;
        $left = $this->legL($this->wildLegKey($lkey));
        $right = $this->legL($this->wildLegKey($lkey, 1));
        if ($this->wildSponsored($key) > 1) {
            $level = 1;
            if ($left >= 3 AND $right >= 3) {
                $level = 3;
            } elseif ($left >= 1 AND $right >= 1) {
                $level = 2;
            }
        }
        return $level;
    }





    function updateStage1($user)
    {
        global $db;
        $sql = $db->query("SELECT * FROM user WHERE user='$user' ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);
        $i = 1;
        while ($i <= 20) {
            $e = $i++;
            $a = 'a' . $e;
            $kk = $row[$a];
            if ($kk > 0) {
                if ($this->verifyStage1($kk) == 1) {
                    $db->query("UPDATE user SET st1=1 WHERE sn='$kk' ");
                }
            }
        }
        return;
    }


  


    function stagePro($key, $st)
    {
        global $db, $head;

        $num = ($this->wildLevel2($key, 2) >= $st) ? 1 : 0;


        $a = 1;
        while ($a <= 16) {
            $b = $a++;

            $gen = 'a' . $b;
            $sql = $db->query("SELECT * FROM user WHERE $gen = '$key' AND sp > 1 ") or die(mysqli_error());
            while ($r = mysqli_fetch_assoc($sql)) {
                $lkey = $r['sn'];
                if ($this->wildLevel2($key, 2) >= $st) {
                    $num += 1;
                }

            }
        }

        return $num;
    }


//

    function stageProgress($opt = '')
    {
        $keys = $this->userName('sn');
        $st = $this->wildLevel2($keys, 2);

        $left = count(explode(',', $this->legSt($this->legKey(), $st))) - 1;
        $right = count(explode(',', $this->legSt($this->legKey(1), $st))) - 1;
//$left = $this->stagePro($this->wildLegKey($keys),$st);
//$right = $this->stagePro($this->wildLegKey($keys,1),$st);

        if ($st > 1) {
            if ($st == 2) {
                $max = 3;
            } else {
                $max = 7;
            }
            $leftp = $left / $max * 50;
            $leftp = ($leftp > 50) ? 50 : $leftp;
            $rightp = $right / $max * 50;
            $rightp = ($rightp > 50) ? 50 : $rightp;
        } else {
            $leftp = ($this->wildSponsored($keys) > 0) ? 50 : 0;
            $rightp = 0;
        }
        if ($opt == 1) {
            return number_format($leftp, 1) . '%';
        } elseif ($opt == 2) {
            return number_format($rightp, 1) . '%';
        } else {
            return number_format($rightp + $leftp, 1) . '%';
        }

    }

    /*
function legH($key){
global $db;

$head = ($this->wildSponsored($key)>1) ? $key.',' : '';
$a = 1;//sq=$db->query("SELECT * FROM levels " );
            while($a <= 16){$b = $a++;

$gen = 'a'.$b;
            $sql=$db->query("SELECT * FROM user WHERE $gen = '$key' AND sp > 1 " )or die(mysqli_error());
            while($r = mysqli_fetch_assoc($sql)){ $lkey=$r['sn'];
//$num += 1; 
$head .= $r['sn'].',';
        }
        }
        
        return $head;


}*/




    function cLevel1($key)
    {
        global $db;


        $sql = $db->query("SELECT * FROM user WHERE a1='$key' ") or die(mysqli_error());

         $head = mysqli_num_rows($sql);
       
            $moveto = ($head == 3) ? 1 : 0;
            if($moveto==1){
$db->query("UPDATE user SET level='$moveto' WHERE sn='$key' ");
}
            return;
      }


    function cLevel2($key)
    {//
        global $db;
$level = $this->keyToLevel($key);

        $sql = $db->query("SELECT * FROM user WHERE a2='$key' ") or die(mysqli_error());

        $head = mysqli_num_rows($sql);
       
            $moveto = ($head == 9) ? 2 : $level;
            if($moveto==2){
$db->query("UPDATE user SET level='$moveto' WHERE sn='$key' ");

$cash = $this->matrixBonus($moveto) ;
if($cash>0){
$stage = $this->matrixBonus($moveto,'title').', Level '.$this->matrixBonus($moveto,'level');;
$type = $this->matrixBonus($moveto,'code');
$this->processWallet($this->keyToId($key),$cash,9,$type,$stage.' Matrix Cash Bonus');
}

}
            return;
      }    

    function createStage2($key)
    {//
        global $db;
//$level = $this->keyToLevel($key);
$id = $this->keyToId($key);
$db->query("UPDATE matuser SET level=2 WHERE sn='$key' ");
$cash = $this->matrixBonus(2) ;
$this->walletProcess($id,$cash,5,10,'Stage 1 Leadership Cash Bonus');
  return;
      }


        function stage1($key)
    {
        global $db;
        $sql = $db->query("SELECT * FROM matuser WHERE a1='$key' OR a2='$key' ") or die(mysqli_error());
        return $sql->num_rows;
    }



    function stageLevel($key)
    {
        $stlevel = 0;
        $level = $this->userLevel($key);
        if ($level == 1) {
            $stlevel = 1;
        } elseif ($level == 2) {
            $stlevel = 0;
        } elseif ($level == 3) {
            $stlevel = 1;
        } elseif ($level == 4) {
            $stlevel = 0;
        } elseif ($level == 5) {
            $stlevel = 1;
        } elseif ($level == 6) {
            $stlevel = 0;
        } elseif ($level == 7) {
            $stlevel = 1;
        } elseif ($level == 8) {
            $stlevel = 0;
        } elseif ($level == 9) {
            $stlevel = 1;
        } elseif ($level == 10) {
            $stlevel = 0;
        } elseif ($level == 11) {
            $stlevel = 1;
        }
        elseif ($level == 12) {
            $stlevel = 0;
        }
        elseif ($level == 13) {
            $stlevel = 1;
        }
        elseif ($level == 14) {
            $stlevel = 2;
        }
        

        return $stlevel;
    }
    function ApproveIncentive1(){
         global $db,$report,$count;

        $sn = $_POST['ApproveIncentive1'];
        $db->query("UPDATE incentive SET status='1' WHERE sn='$sn'");

        $report = "Approved Successfully";
    }

    function ReturnWithdraw(){
        global $db,$report,$count;

        $id = $_POST['ReturnWithdraw'];
        $transaction = $_POST['transaction'];
        $sql = $db->query("DELETE FROM withdraw WHERE id='$id' AND type='w' AND tno='$transaction'");
        $report = "Returned Successfully";
    }


function RequestIncentive1(){
        global $db,$report,$count;

        $id = $_POST['id'];
        $stage = $_POST['stage'];
        $level = $_POST['level'];
        $incentive = sanitize($_POST['RequestIncentive1']);

        if($db->query("INSERT INTO incentive(id,incentive,stage,level) VALUES('$id','$incentive','$stage','$level')")){
            $report = "Request Submitted Successfully";
        }
        else {
            $count = 1;
            $report = "Error Submitting Request";
        }
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
    function RequestTransfer(){
        global $db, $report, $count;

        $uid = $_POST['id'];
        $username = sanitize($_POST['recipient']);
        $uid2 = $this->userName3($username);
        $amount = sanitize($_POST['amount']);
        $pass = $_POST['authenticate'];
        $password = userName($uid,'pass');
        $initBalance = $_POST['balance'];
        $type = "t";
        $status = 1;
        $sql1 = $db->query("SELECT * FROM user WHERE user='$username'");

        if($amount > $initBalance){
            $report = "Insufficient Balance";
            $count = 1;
        }
        elseif(userName($uid,'user') == $username){
             $report = "Cannot Transfer To The Same Account, Please Check Username And Try Again";
            $count = 1;
        }
        elseif($sql1->num_rows < 1){
            $count = 1;
            $report = "Username Does Not Exist";
        }
        elseif($_POST['amount'] < 1){
            $count = 1;
            $report = "Minimum Transfer is $1";
        }
        elseif($amount > 10000){
            $count = 1;
            $report = "Cannot Transfer More than $10,000";
        }
        elseif(password_verify($pass, $password)){
           $tno = substr(str_shuffle(str_repeat('1234567890', 10)), 0, 10);
            $finalbalance = $initBalance - $amount;
            $sql = $db->query("INSERT INTO transfer (id,id2,inibalance,amount,finalbalance,status,type,tno) VALUES ('$uid','$uid2','$initBalance','$amount','$finalbalance','$status','$type','$tno')");
                $_SESSION['report'] = "$".$amount. " Transfered Successfully To ".$username;

            header("Location:?#");
        }
        else {
            $report = "Invalid authentication";
            $count = 1;
        }
    }



function FundTransfer(){
        global $report, $count;

        $userKey = $this->Uid();
        $bene = $_SESSION['SearchClient'];
        $amount = $_POST['amount'];
        $pass = $_POST['password'];
        $password = $this->userName4('pass');
        $remark = 'Fund Transfered to '.userName($bene);
        $remark2 = 'Fund Received from '.userName($userKey);
        $type = 2;
        $type2 = 6;
        $status = 5;
        $initBalance = $this->wallet($userKey);

        if($amount > $initBalance){
            $report = "Insufficient Balance";
            $count = 1;
        }
        elseif($amount < 20){
            $count = 1;
            $report = "Minimum Transfer amount is NGN20";
        }
        
        elseif($amount > $this->maxwithdraw){
            $count = 1;
            $report = "Cannot Transfer more than NGN".$this->maxwithdraw;
        }
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

function RequestWithdraw(){
        global $report, $count;

        $userKey = $this->Uid();
        $amount = $_POST['amount'];
        $pass = $_POST['password'];
        $password = $this->userName4('pass');
        $remark = 'Cash Withdrawal Request';
        $type = 1;
        $status = 1;
        $initBalance = $this->wallet($userKey);
        $amount = $amount+$this->withdrawcharge;

        if($amount > $initBalance){
            $report = "Insufficient Balance";
            $count = 1;
        }
        elseif($amount < $this->minwithdraw){
            $count = 1;
            $report = "Minimum Withdrawal amount is NGN".$this->minwithdraw;
        }
        
        elseif($amount > $this->maxwithdraw){
            $count = 1;
            $report = "Cannot Transfer more than NGN".$this->maxwithdraw;
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
        
        $amount = $_POST['amount'];
        $pass = $_POST['password'];
        $password = $this->userName4('pass');
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
}

$report = 'User Account Operation Successful!';
          
      }else{$report='Password Mismatch, Try Again!'; $count = 1;}

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



       


        function buyEpins(){
        global $report, $count;
        $id = $this->Uid();
        $pin = sanitize($_POST['pins']);
        $amount = $pin*$this->regfee;

        //$amount = $_POST['amount']+$this->charge;
        $pass = $_POST['password'];
        $password = userName($id,'pass');
        $remark = 'Purchase of '.$pin.' Unit(s) of PIN';
        $type = 5;
        $status = 5;
        $initBalance = $this->wallet($id);

        if($amount > $initBalance){
            $report = "Insufficient Fund in Wallet";
            $count = 1;
        }
       
        elseif($amount > $this->maxwithdraw){
            $count = 1;
            $report = "Maximum limit is ".NAIRA.$this->maxwithdraw;
        }
        elseif(password_verify($pass, $password)){

           $this->walletProcess($id,$amount,$status,$type,$remark);
           $this->sellEpins($id,$pin,3);
           // header("Location:?");
           $report = $pin." PIN purchase successful";
        }
        
        else {
            $report = "Authentication failed.";
            $count = 1;
        }

        return;
    }


   function getUsername($e){
global $db,$userKey;
$que = $db->query("SELECT * FROM user WHERE id = '$userKey' ") or die(mysqli_error());
$ro = mysqli_fetch_array($que);
$use = $ro['user'];
 $user = $use.$e;  $ran = rand(51,999);
 $user = ($this->userExist($user) == TRUE) ? $use.$ran : $user;
 $user = ($this->userExist($user) == TRUE) ? $use.$ran : $user;
$user = ($this->userExist($user) == TRUE) ? $use.$ran : $user;
 $user = ($this->userExist($user) == TRUE) ? $use.$ran : $user;
return $user;
   }         

            function RegisterMultiple(){
        global $report, $count,$userKey;

//$sponsor = $this->idToKey($userkey);
$sponsorkey = $this->idToKey($userKey);
        $pass = $_POST['password'];
        $password = $this->userName4('pass');
        
        if(password_verify($pass, $password)){
            $this->buyEpinsWithAll();
$i=1; $units = $this->userPins($userKey);
$units = ($units>100) ? 100 : $units;
while($i <= $units){ $e=$i++;
            
            $upline = ($this->Downline($sponsorkey) < 3) ? $sponsorkey : $this->findUplineKey($sponsorkey);
            $username = $this->getUsername($e);
           $this->registerOne($sponsorkey,$upline,$username);
           
}
$report = "Multiple Registration Operation successful: ".$e." Accounts";

        }
        
        else {
            $report = "Authentication failed. try again";
            $count = 1;
        }
        return;
    }





  function buyEpinsx(){
        global $userKey;

        $pin = 1; //sanitize($_POST['pins']);
        $amount = $pin*$this->dollarfee;

        $remark = 'PIN purchase from Wallet';
        $type = 2;
        $status = 9;
        $initBalance = $this->wallet($userKey);

        if($amount > $initBalance){
            $report = "Insufficient Balance";
            $count = 1;
        }
       
         else{

           $this->processWallet($userKey,$amount,$status,$type,$remark);
           $this->sellEpins($userKey,$pin,3);
           }
        
        return;
    }




    function splitEarnings($uidx,$stage,$lev){
        $total = $this->totalEarnings($uidx,$stage,$lev);

        return (int)($total/5);
    }
    function checkTransferGain($uidx){
         global $db;

        $id = snToId($uidx);
        $sql = $db->query("SELECT SUM(amount) AS sum FROM transfer WHERE id2='$id'");
        $row = $sql->fetch_assoc();

        return $row['sum'];
    }
    function checkTransfer($uidx){
        global $db;

        $id = snToId($uidx);
        $sql = $db->query("SELECT SUM(amount) AS sum FROM transfer WHERE id='$id'");
        $row = $sql->fetch_assoc();

        return $row['sum'];
    }
    function checkWithdraw($uidx){
        global $db;
        $id = snToId($uidx);
        $sql = $db->query("SELECT SUM(amount) AS sum FROM withdraw WHERE id='$id'");
        $row = $sql->fetch_assoc();

        return $row['sum'];
    }
    function totalEarnings($uidx,$stage,$lev){
        $referrals = $this->referral($uidx);
        $matrix = $this->matrixBonus($stage,$lev);
        $withdraw = $this->checkWithdraw($uidx);
        $transfer = $this->checkTransfer($uidx);
        $transfergain = $this->checkTransferGain($uidx);
        $total = ($referrals + $matrix + $transfergain) - ($withdraw + $transfer);

        return $total;
    }
    // function stageCalc($key)
    // {
    //     $stage = 0;

    //     if ($this->userLevel($key) <= 1) {
    //         $stage = 1;
    //     } elseif ($this->userLevel($key) > 1 && $this->userLevel($key) <= 4) {
    //         $stage = 2;
    //     } elseif ($this->userLevel($key) > 4 && $this->userLevel($key) <= 7) {
    //         $stage = 3;
    //     } elseif ($this->userLevel($key) > 7 && $this->userLevel($key) <= 10) {
    //         $stage = 4;
    //     } elseif ($this->userLevel($key) > 10 && $this->userLevel($key) <= 13) {
    //         $stage = 5;
    //     }
    //     elseif ($this->userLevel($key) > 13 && $this->userLevel($key) <= 16) {
    //         $stage = 6;
    //     }
    //     elseif ($this->userLevel($key) > 16 && $this->userLevel($key) <= 19) {
    //         $stage = 7;
    //     }
    //     elseif ($this->userLevel($key) > 19 && $this->userLevel($key) <= 22) {
    //         $stage = 8;
    //     }
    //     elseif ($this->userLevel($key) > 22 && $this->userLevel($key) <= 25) {
    //         $stage = 9;
    //     }

    //     return $stage;
    // }


    function stageCalc($key)
    {
        $stage = 1;
        $level = $this->keyToId($key,'level');
        if ($level >= 12) {
            $stage = 7;
        } elseif ($level >= 10) {
            $stage = 6;
        } elseif ($level >= 8) {
            $stage = 5;
        } elseif ($level >= 6) {
            $stage = 4;
        }
        elseif ($level >= 4) {
            $stage = 3;
        }
        elseif ($level >= 2) {
            $stage = 2;
        }
        
        return $stage;
    }

    function userLevel($key)
    {
        $level = 0;
        if ($this->level2($key) == 2 && $this->level3($key) >= 3) {
            $level = $this->level3($key);
        } elseif ($this->level2($key) == 2) {
            $level = $this->level2($key);
        } elseif ($this->level1($key) == 1) {
            $level = $this->level1($key);
        }

        return $level;
    }


        function userUnreadMsg($id)
    {
        global $db;

        $sql = $db->query("SELECT * FROM msg WHERE senderid='$id' AND active<2");
        $no = $sql->num_rows;
        return $no;
    }

    function UnreadMsg()
    {
        global $db;
$no=0;
$sql = $db->query("SELECT * FROM user ");
while($row = mysqli_fetch_assoc($sql)){ $id=$row['id'];
if($this->userUnreadMsg($id)>0){ $no += 1; }
                                       }
        return $no;
    }


    function UpdateReward($id){
        global $db,$report,$count;

        $award = $_POST['awards'];
        $incentives = $_POST['incentives'];

        $sql = $db->query("UPDATE levels SET award='$award', award2='$incentives' WHERE sn='$id'");
        $report = "Updated Successfully";
    }

    function userlevelNo2(){
        global $db;

        $sum = 0;
        $sql = $db->query("SELECT * FROM user WHERE level>=2");
        while($row = $sql->fetch_assoc()){
             if($this->level2($row['sn'])==2){$sum += 1; }
        }
        return $sum;
    }
    function userlevelNo3($level){
        global $db;

        $sum = 0;
        $sql = $db->query("SELECT * FROM user WHERE level>=2");
        while($row = $sql->fetch_assoc()){
           if($this->level3($row['sn'])==$level){
                $sum += 1;
           }
        }
        return $sum;
    }
    function userlevelNo1(){
        global $db;

        $sum= 0;
        $sql = $db->query("SELECT * FROM user WHERE active = 3 ");
       $sql2 = $db->query("SELECT * FROM user WHERE level >= 2 ");

        return $sql->num_rows-$sql2->num_rows;
    }
    function userlevelNo(){
        global $db;
        $sql = $db->query("SELECT * FROM user WHERE active = 0");
        //$sql2 = $db->query("SELECT * FROM user WHERE level >= 2 ");
        return $sql->num_rows;
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

    function levelToStage($lev){
        global $db;
        $sql = $db->query("SELECT * FROM levels WHERE sn = '$lev' ");
        $row = mysqli_fetch_assoc($sql);
        return $row['title'].', Level '.$row['level'];
    }

    function team1($key)
    {
        global $db;


        $sql = $db->query("SELECT * FROM user WHERE a1='$key' OR a2='$key' ") or die(mysqli_error());

        $head = $sql->num_rows;

        return $head;
    }

    function score($key)
    {
        global $db;

        $sql = $db->query("SELECT * FROM user WHERE a1='$key' OR a2='$key' OR a3='$key' OR a4='$key' OR a5='$key' OR a6='$key' OR a7='$key' OR a8='$key' OR a9='$key' OR a10='$key' OR a11='$key' OR a12='$key' OR a13='$key' OR a14='$key' OR a15='$key' OR a16='$key' ") or die(mysqli_error());

        $head = $sql->num_rows;
        return $head;
    }

// function levelUpdate($key){
// global $db;
// $i=1; 
//    $sql = $db->query("SELECT * FROM user WHERE sn='$key' ");
//     $row=mysqli_fetch_assoc($sql); 
//    if($row['a1']>0){$this->cLevel1($row['a1']);}
//    if($row['a2']>0){$this->cLevel2($row['a2']);}
//    if($row['a3']>0){$this->levelCreate($row['a3']);}
//    if($row['a4']>0){$this->levelCreate($row['a4']);}
//    if($row['a5']>0){$this->levelCreate($row['a5']);}
//    if($row['a6']>0){$this->levelCreate($row['a6']);}
//    if($row['a7']>0){$this->levelCreate($row['a7']);}
//    if($row['a8']>0){$this->levelCreate($row['a8']);}
//    if($row['a9']>0){$this->levelCreate($row['a9']);}
//    if($row['a10']>0){$this->levelCreate($row['a10']);}
//    if($row['a11']>0){$this->levelCreate($row['a11']);}
//    if($row['a12']>0){$this->levelCreate($row['a12']);}
//    if($row['a13']>0){$this->levelCreate($row['a13']);}

//     while($i <= 14) { $e=$i++;  $a = 'a'.$e;
//       $sn = $row[$a];
//   if($sn == 0){return;}
// elseif($e==1){$this->cLevel1($sn); }
// elseif($e==2){$this->cLevel2($sn);  }
// else{$this->levelCreate($sn); }
//}
//return;
//}


function levelUpdate($key){
global $db;
$i=1; 
   $sql = $db->query("SELECT * FROM user WHERE sn='$key' ");
    $row=mysqli_fetch_assoc($sql); 
    while($i <= 14) { $e=$i++;  $a = 'a'.$e;
      $sn = $row[$a];
  if($sn == 0){return;}
elseif($e==1){$this->cLevel1($sn); }
elseif($e==2){$this->cLevel2($sn);  }
else{$this->levelCreate($sn); }
}
return;
}

function stageUpdate($key){
global $db;
$this->createStage2($key);

$i=2; 
   $sql = $db->query("SELECT * FROM matuser WHERE sn='$key' ");
    $row=mysqli_fetch_assoc($sql); 
    while($i <= 8) { $e=$i++;  $a = 'a'.$e;
      $sn = $row[$a];
    if($sn == 0){ }
elseif($e > 4){$this->levelCreate($sn); }
}

return;
}

    function levelCreate($key)
    {
        global $db;

$level = $this->keyToLevel($key);
$even = ($level % 2 == 0) ? $level : $level-1;

        $sql = $db->query("SELECT * FROM user WHERE (a1='$key' OR a2='$key' OR a3='$key' OR a4='$key' OR a5='$key' OR a6='$key' OR a7='$key' OR a8='$key') AND level>='$even' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);

 if($num >=12){$moveto = $even+2; }
elseif($num >=3){$moveto = $even+1; }
else{$moveto = $level; }

if($moveto>$level AND $moveto>2){
$db->query("UPDATE user SET level='$moveto' WHERE sn='$key' ");
//matrix bonus
$incent = $this->matrixBonus($moveto,'award2') ;  
$cash = $this->matrixBonus($moveto) ;
$stage = $this->matrixBonus($moveto,'title').', Level '.$this->matrixBonus($moveto,'level');
$type = $this->matrixBonus($moveto,'code');
if($cash>0){ //cash bonus
$this->processWallet($this->keyToId($key),$cash,9,$type,$stage.' Matrix Cash Bonus');

}
if(strlen($incent)>4){//incentive bonus
 $this->processIncent($this->keyToId($key),$incent,2,$type,$stage.' Matrix Incentive Bonus');   
}

}


return;
    }




    function level3($key)
    {
        
        return $this->keyToLevel($key);
    }

 
    function CheckSponsor($sql)
    {
        $num = 0;
        while ($row = mysqli_fetch_assoc($sql)) {
            if ($this->wildSponsored($row['sn']) > 1) {
                $num += 1;
            }
        }
        return $num;
    }

//User Stage level
    function wildLevel2($key, $t = '')
    {
        global $db;

        $level = ($this->verifyStage1($key) == 0) ? $this->findLevelx($key) : $this->findLevely($key);


        if ($level == 0) {
            $stagelevel = 0;
            $stage = 'Waiting';
            $stg = 1;
            $nextstagelevel = 1;
        } elseif ($level == 1) {
            $stagelevel = 0;
            $stage = 'Induct';
            $stg = 2;
            $nextstagelevel = 3;
        } elseif ($level == 2) {
            $stagelevel = 1;
            $stage = 'Induct';
            $stg = 2;
            $nextstagelevel = 3;
        } elseif ($level == 3) {
            $stagelevel = 0;
            $stage = 'Stage 1';
            $stg = 3;
            $nextstagelevel = 6;
        } elseif ($level == 4) {
            $stagelevel = 1;
            $stage = 'Stage 1';
            $stg = 3;
            $nextstagelevel = 6;
        } elseif ($level == 5) {
            $stagelevel = 2;
            $stage = 'Stage 1';
            $stg = 3;
            $nextstagelevel = 6;
        } elseif ($level == 6) {
            $stagelevel = 0;
            $stage = 'Stage 2';
            $stg = 4;
            $nextstagelevel = 9;
        } elseif ($level == 7) {
            $stagelevel = 1;
            $stage = 'Stage 2';
            $stg = 4;
            $nextstagelevel = 9;
        } elseif ($level == 8) {
            $stagelevel = 2;
            $stage = 'Stage 2';
            $stg = 4;
            $nextstagelevel = 9;
        } elseif ($level == 9) {
            $stagelevel = 0;
            $stage = 'Stage 3';
            $stg = 5;
            $nextstagelevel = 12;
        } elseif ($level == 10) {
            $stagelevel = 1;
            $stage = 'Stage 3';
            $stg = 5;
            $nextstagelevel = 12;
        } elseif ($level == 11) {
            $stagelevel = 2;
            $stage = 'Stage 3';
            $stg = 5;
            $nextstagelevel = 12;
        } elseif ($level == 12) {
            $stagelevel = 0;
            $stage = 'Stage 4';
            $stg = 6;
            $nextstagelevel = 15;
        } elseif ($level == 13) {
            $stagelevel = 1;
            $stage = 'Stage 4';
            $stg = 6;
            $nextstagelevel = 15;
        } elseif ($level == 14) {
            $stagelevel = 2;
            $stage = 'Stage 4';
            $stg = 6;
            $nextstagelevel = 15;
        } elseif ($level == 15) {
            $stagelevel = 0;
            $stage = 'Stage 5';
            $stg = 7;
            $nextstagelevel = 18;
        } elseif ($level == 16) {
            $stagelevel = 1;
            $stage = 'Stage 5';
            $stg = 7;
            $nextstagelevel = 18;
        } elseif ($level == 17) {
            $stagelevel = 2;
            $stage = 'Stage 5';
            $stg = 7;
            $nextstagelevel = 18;
        } elseif ($level == 18) {
            $stagelevel = 0;
            $stage = 'Stage 6';
            $stg = 8;
            $nextstagelevel = 21;
        } elseif ($level == 19) {
            $stagelevel = 1;
            $stage = 'Stage 6';
            $stg = 8;
            $nextstagelevel = 21;
        } elseif ($level == 20) {
            $stagelevel = 2;
            $stage = 'Stage 6';
            $stg = 8;
            $nextstagelevel = 21;
        } elseif ($level == 21) {
            $stagelevel = 0;
        }

        //$count = $this->legCount($key,$stg);
        //$stg = ($stg > 3 AND $count < 15)?$stg-1:$stg;

        if ($t == 1) {
            return $stage;
        } elseif ($t == 2) {
            return $stg;
        } elseif ($t == 3) {
            return MATRIX ** ($level + 1);
        } elseif ($t == 4) {
            return $nextstagelevel;
        } elseif ($t == 5) {
            return $stagelevel;
        } elseif ($t == 7) {
            return $stage . ',' . $stagelevel;
        } else {
            return $level;
        }

    }


    function matrixAward()
    {
        global $db;
        $randomKey = $this->userName('sn');
        $level = $this->wildLevel2($randomKey) + 1;
        $award = 0;
        $sql = $db->query("SELECT * FROM levels WHERE sn <= '$level' ");
        while ($row = mysqli_fetch_assoc($sql)) {
            $award += (int)$row['award'];
        }
        return $award;
    }


// function wildSponsored($key){
//          global $db,$user;
//          $qu=$db->query("select * FROM user WHERE sponsor = '$key' " )or die(mysqli_error());
//          $nu = mysqli_num_rows($qu); 
//          return $nu; 
//          }


//Wild User Stage/level statistics
    function wildLevel($key, $t = '')
    {
        global $db;

        $level = $this->findLevelx($key);

        if ($level == 0) {
            $stagelevel = 0;
            $stage = 'Waiting';
            $stg = 1;
            $nextstagelevel = 1;
        } elseif ($level == 1) {
            $stagelevel = 0;
            $stage = 'Induct';
            $stg = 2;
            $nextstagelevel = 3;
        } elseif ($level == 2) {
            $stagelevel = 1;
            $stage = 'Induct';
            $stg = 2;
            $nextstagelevel = 3;
        } elseif ($level == 3) {
            $stagelevel = 0;
            $stage = 'Stage 1';
            $stg = 3;
            $nextstagelevel = 6;
        } elseif ($level == 4) {
            $stagelevel = 1;
            $stage = 'Stage 1';
            $stg = 3;
            $nextstagelevel = 6;
        } elseif ($level == 5) {
            $stagelevel = 2;
            $stage = 'Stage 1';
            $stg = 3;
            $nextstagelevel = 6;
        } elseif ($level == 6) {
            $stagelevel = 0;
            $stage = 'Stage 2';
            $stg = 4;
            $nextstagelevel = 9;
        } elseif ($level == 7) {
            $stagelevel = 1;
            $stage = 'Stage 2';
            $stg = 4;
            $nextstagelevel = 9;
        } elseif ($level == 8) {
            $stagelevel = 2;
            $stage = 'Stage 2';
            $stg = 4;
            $nextstagelevel = 9;
        } elseif ($level == 9) {
            $stagelevel = 0;
            $stage = 'Stage 3';
            $stg = 5;
            $nextstagelevel = 12;
        } elseif ($level == 10) {
            $stagelevel = 1;
            $stage = 'Stage 3';
            $stg = 5;
            $nextstagelevel = 12;
        } elseif ($level == 11) {
            $stagelevel = 2;
            $stage = 'Stage 3';
            $stg = 5;
            $nextstagelevel = 12;
        } elseif ($level == 12) {
            $stagelevel = 0;
            $stage = 'Stage 4';
            $stg = 6;
            $nextstagelevel = 15;
        } elseif ($level == 13) {
            $stagelevel = 1;
            $stage = 'Stage 4';
            $stg = 6;
            $nextstagelevel = 15;
        } elseif ($level == 14) {
            $stagelevel = 2;
            $stage = 'Stage 4';
            $stg = 6;
            $nextstagelevel = 15;
        } elseif ($level == 15) {
            $stagelevel = 0;
            $stage = 'Stage 5';
            $stg = 7;
            $nextstagelevel = 18;
        } elseif ($level == 16) {
            $stagelevel = 1;
            $stage = 'Stage 5';
            $stg = 7;
            $nextstagelevel = 18;
        } elseif ($level == 17) {
            $stagelevel = 2;
            $stage = 'Stage 5';
            $stg = 7;
            $nextstagelevel = 18;
        } elseif ($level == 18) {
            $stagelevel = 0;
            $stage = 'Stage 6';
            $stg = 8;
            $nextstagelevel = 21;
        } elseif ($level == 19) {
            $stagelevel = 1;
            $stage = 'Stage 6';
            $stg = 8;
            $nextstagelevel = 21;
        } elseif ($level == 20) {
            $stagelevel = 2;
            $stage = 'Stage 6';
            $stg = 8;
            $nextstagelevel = 21;
        } elseif ($level == 21) {
            $stagelevel = 0;
        }

        //stg = stages counting from 1;

        if ($t == 1) {
            return $stage;
        } elseif ($t == 2) {
            return $stg;
        } elseif ($t == 3) {
            return MATRIX ** ($level + 1);
        } elseif ($t == 4) {
            return $nextstagelevel;
        } elseif ($t == 5) {
            return $stagelevel;
        } elseif ($t == 7) {
            return $stage . ',' . $stagelevel;
        } else {
            return $level;
        }


    }


    function legLevel($leg, $t = '')
    {
        global $db;
        $randomKey = $this->legKey($leg);

        $sql = $db->query("SELECT * FROM user WHERE a1 = '$randomKey' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);

        $a = 1;
        $nu = 0;
        while ($a <= 16) {
            $b = $a++;
            $gen = 'a' . $b;
            $target = MATRIX ** $b;
            $qu = $db->query("SELECT * FROM user WHERE $gen = '$randomKey' ") or die(mysqli_error());
            $nu = mysqli_num_rows($qu);
            if ($num < MATRIX) {
                $level = 0;
                $targ = MATRIX;
            } elseif ($nu == $target) {
                $level = $b;
                $targ = $target;
            }
        }

        if ($level <= 1) {
            $stagelevel = 0;
        } elseif ($level == 2) {
            $stagelevel = 1;
        } elseif ($level == 3) {
            $stagelevel = 0;
        } elseif ($level == 4) {
            $stagelevel = 1;
        } elseif ($level == 5) {
            $stagelevel = 2;
        } elseif ($level == 6) {
            $stagelevel = 0;
        } elseif ($level == 7) {
            $stagelevel = 1;
        } elseif ($level == 8) {
            $stagelevel = 2;
        } elseif ($level == 9) {
            $stagelevel = 0;
        } elseif ($level == 10) {
            $stagelevel = 1;
        } elseif ($level == 11) {
            $stagelevel = 2;
        } elseif ($level == 12) {
            $stagelevel = 0;
        } elseif ($level == 13) {
            $stagelevel = 1;
        } elseif ($level == 14) {
            $stagelevel = 2;
        } elseif ($level == 15) {
            $stagelevel = 0;
        } elseif ($level == 16) {
            $stagelevel = 1;
        } elseif ($level == 17) {
            $stagelevel = 2;
        } elseif ($level == 18) {
            $stagelevel = 0;
        } elseif ($level == 19) {
            $stagelevel = 1;
        } elseif ($level == 20) {
            $stagelevel = 2;
        } elseif ($level == 21) {
            $stagelevel = 0;
        }

        //stg = stages counting from 1;
        if ($level < 1) {
            $stage = 'WAITING';
            $stg = 1;
            $nextstagelevel = 1;
        } elseif ($level < 3) {
            $stage = 'Induct';
            $stg = 2;
            $nextstagelevel = 3;
        } elseif ($level < 6) {
            $stage = 'STAGE 1';
            $stg = 3;
            $nextstagelevel = 6;
        } elseif ($level < 9) {
            $stage = 'STAGE 2';
            $stg = 4;
            $nextstagelevel = 9;
        } elseif ($level < 12) {
            $stage = 'STAGE 3';
            $stg = 5;
            $nextstagelevel = 12;
        } elseif ($level < 15) {
            $stage = 'STAGE 4';
            $stg = 6;
            $nextstagelevel = 15;
        } elseif ($level < 18) {
            $stage = 'STAGE 5';
            $stg = 7;
            $nextstagelevel = 18;
        } elseif ($level < 21) {
            $stage = 'STAGE 6';
            $stg = 8;
            $nextstagelevel = 21;
        }
        elseif ($level < 24) {
            $stage = 'STAGE 7';
            $stg = 9;
            $nextstagelevel = 24;
        }
        if ($t == 1) {
            return $stage;
        } elseif ($t == 2) {
            return $stg;
        } elseif ($t == 3) {
            return MATRIX ** ($level + 1);
        } elseif ($t == 4) {
            return $nextstagelevel;
        } elseif ($t == 5) {
            return $stagelevel;
        } else {
            return $level;
        }

    }


    function levelScore()
    {
        $lev = $this->Level() + 1;
        return $this->Gen($lev);
    }


    function levelTarget()
    {
        return $this->Level(3);
    }


    function stageLevelScore()
    {
        $lev = $this->Level(4);
        return $this->Gen($lev);
    }


    function stageLevelTarget()
    {
        return MATRIX ** ($this->Level(4));//$this->Level(3);
    }

    function stageLevelProgress()
    {
        //$pro = ($this->stageLevelScore()*100)/$this->stageLevelTarget();
        //if($this->Sponsored()==0){$pro = 0;}elseif($this->Sponsored()==1){$pro = 50;}
        return 0;//number_format($this->gTree(1),1).'%';
    }


//leg statistics
    function legStageLevelScore($leg)
    {
        $lev = $this->Level(4) - 1;
        return $this->legGen($lev, $leg);
    }


    function legStageLevelTarget()
    {
        return $this->stageLevelTarget() / 2;//$this->Level(3);
    }

    function legStageLevelProgress($leg)
    {
        global $directdown;
        $pro = ($this->legStageLevelScore($leg) > 0) ? ($this->legStageLevelScore($leg) * 100) / $this->legStageLevelTarget($leg) : 0;
        if ($this->Sponsored() < 2) {
            return '0.0%';
        } elseif ($directdown == 0) {
            return '0.0%';
        } elseif ($directdown == 1 && $leg == 1) {
            return '0.0%';
        } elseif ($directdown == 1 && $leg == 0) {
            return '100.0%';
        } else {
            return number_format($pro, 1) . '%';
        }
    }


    function proLevel($leg, $t = '')
    {
        global $db;
        $randomKey = $this->legKey($leg);

        $sql = $db->query("SELECT * FROM user WHERE a1 = '$randomKey' ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);

        $a = 1;
        $nu = 0;
        while ($a <= 16) {
            $b = $a++;
            $gen = 'a' . $b;
            $target = MATRIX ** $b;
            $qu = $db->query("SELECT * FROM user WHERE $gen = '$randomKey' ") or die(mysqli_error());
            $nu = mysqli_num_rows($qu);
            if ($num < MATRIX) {
                $level = 0;
                $targ = MATRIX;
            } elseif ($nu == $target) {
                $level = $b;
                $targ = $target;
            }
        }
        if ($level < 1) {
            $stage = 'WAITING';
            $stg = 1;
        } elseif ($level < 3) {
            $stage = 'Induct';
            $stg = 2;
        } elseif ($level < 6) {
            $stage = 'STAGE 1';
            $stg = 3;
        } elseif ($level < 9) {
            $stage = 'STAGE 2';
            $stg = 4;
        } elseif ($level < 12) {
            $stage = 'STAGE 3';
            $stg = 5;
        } elseif ($level < 15) {
            $stage = 'STAGE 4';
            $stg = 6;
        } elseif ($level < 18) {
            $stage = 'STAGE 5';
            $stg = 7;
        } elseif ($level < 21) {
            $stage = 'STAGE 6';
            $stg = 8;
        }
        if ($t == 1) {
            return $stage;
        } elseif ($t == 2) {
            return $stg;
        } else {
            return $level;
        }

    }


//stage
    function Stage()
    {
        return $this->wildLevel2($this->userName('sn'), 1);
    }

    function totalEarning()
    {
        return $this->matrixAward() + $this->referalB();
    }

    function Balance()
    {
        return $this->totalEarning() - $this->totalWithdraw() - $this->totalPending() + $this->transfered(2) - $this->transfered();
    }







   

    function userNameWild($col = '')
    {
        global $db, $user;

        $que = $db->query("SELECT * FROM user WHERE sn = '$user' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        if (!empty($col)) {
            return $ro[$col];
        } else {
            return $ro['surname'];
        }
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
            $sql = $db->query("select * FROM user WHERE $gen = '$randomKey' ") or die(mysqli_error());
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

        $_SESSION['user_idx'] == '';
        session_destroy();
        header('location: ../login.php');
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


//Calculate the amunt of members sponsored by a user monthly
    function inductedPerMonth($month)
    {
        global $db;
        $num = 0;
        $sql = $db->query("SELECT * FROM user ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($sql)) {
            $tim = (int)substr($row['created'], 5, 2);
            if ($tim == $month && $this->wildSponsored($row['sn']) > 1) {
                $num += 1;
            }
        }
        return $num;
    }

    function matrixBonus($stage){
        global $db;
// $sql= $db->query("SELECT * FROM levels WHERE sn='$level'");
//         $row = $sql->fetch_assoc();
//         return $row[$opt];
        $b=0;
if($stage==2){$b=2500; }
elseif($stage==3){$b=25000; }
elseif($stage==4){$b=120000; }
elseif($stage==5){$b=2500000; }
return $b;
    }

    function getreward($stg,$level,$col=''){
        global $db;

        $sql= $db->query("SELECT * FROM levels WHERE stg='$stg' AND level='$level'");
        $row = $sql->fetch_assoc();
        $value = ($col=='')?$row['award']:$row['award2'];

        return $value;
    }

    function getreward1($stage1,$lev){
        global $db;

        $sql = $db->query("SELECT * FROM levels WHERE stg='$stage1' AND level='$lev'");
        $row = $sql->fetch_assoc();
        return $row['sn'];

    }

    function nextReward($stage,$lev, $col=''){
        global $db;

        $sql = $db->query("SELECT * FROM levels WHERE stg='$stage' AND level='$lev'");
        $row = $sql->fetch_assoc();
        $sn = $row['sn']+1;

        $sql = $db->query("SELECT * FROM levels WHERE sn='$sn'");
        $row = $sql->fetch_assoc();
        $value = ($col=='')?$row['award']:$row['award2'];

        return $value;
    }

//Count all registered users
    function allUsers()
    {
        global $db;

        $sql = $db->query("SELECT * FROM user ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        return $num;
    }


//Calculate the amunt of members sponsored by a user monthly
    function allInductedUsers()
    {
        global $db;

        $sql = $db->query("SELECT * FROM user WHERE sp>1 ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        return $num;
    }

//referral table
    function Referrals()
    {
        global $db;
        $randomKey = $this->userName('sn');
        $table = '<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                             <th>Full Name</th>
                                            <th>username</th>
                                            
                                            <th>Phone Number</th>
                                            <th>Location</th>
                                            <th>Join on</th>
                                            <th>Stage</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>';
        $i = 1;
        $sql = $db->query("select * FROM user WHERE sponsor = '$randomKey' ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($sql)) {
            $e = $i++;
            $mark = ($this->wildSponsored($row['sn']) < 2) ? '*' : '';
            $table .= ' <tr>
                                            <td>' . $e . '</td>
                                            <td>' . $row['surname'] . ' ' . $row['othername'] . '</td>
                                            <td>' . $row['user'] . '</td>
                                            
                                            <td>' . $row['phone'] . '</td>
                                            <td>' . $row['city'] . ', ' . $row['state'] . '</td>
                                             <td>' . date('d M, Y', strtotime($row['created'])) . '</td>
                                               <td>' . $mark . $this->wildLevel2($row['sn'], 7) . '</td>
                                        </tr>';
        }

        $table .= ' </tbody>
                                </table>';
        return $table;
    }


///waiting List

    function waitingList($no = 3)
    {
        global $db, $key;
        $randomKey = $this->userName('sn');
        $key = '';
        $a = 1;
        $x = 1;
        $c = 0;
        $nu = 0;
        while ($a <= 16) {
            $b = $a++;
            $gen = 'a' . $b;
            $qu = $db->query("SELECT * FROM user WHERE $gen = '$randomKey' AND active < 2 ") or die(mysqli_error());
            while ($row = mysqli_fetch_assoc($qu) AND $c < $no) {
                $c = $x++;
                $key .= '<tr><td>' . $row['surname'] . '</td>
                                            <td>' . $row['user'] . '</td></tr>';


            }
        }
        return $key;
    }


    function recentlyRegistered()
    {
        global $db;

        $key = '';
        $c = 0;
        $nu = 0;

        $qu = $db->query("SELECT * FROM user ORDER BY sn DESC LIMIT 7 ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($qu)) {

            $key .= '<tr><td><a href="javascript:void(0);" class="text-link">' . $row['surname'] . '</a></td>
                                            <td>' . $row['user'] . '</td></tr>';


        }
        return $key;
    }


    function waitingList2($no = 20)
    {
        global $db, $key;
        $randomKey = $this->userName('sn');
        $table = '<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                             <th>Full Name</th>
                                            <th>username</th>
                                            
                                            <th>Phone Number</th>
                                            <th>Location</th>
                                            <th>Join on</th>
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>';
        $a = 1;
        $x = 1;
        $c = 0;
        $nu = 0;
        while ($a <= 16) {
            $b = $a++;
            $gen = 'a' . $b;
            $qu = $db->query("SELECT * FROM user WHERE $gen = '$randomKey' AND active < 2 ") or die(mysqli_error());
            while ($row = mysqli_fetch_assoc($qu) AND $c < $no) {
                $c = $x++;
                $table .= ' <tr>
                                            <td>' . $c . '</td>
                                            <td>' . $row['surname'] . ' ' . $row['othername'] . '</td>
                                            <td>' . $row['user'] . '</td>
                                            
                                            <td>' . $row['phone'] . '</td>
                                            <td>' . $row['city'] . ', ' . $row['state'] . '</td>
                                             <td>' . date('d M, Y', strtotime($row['created'])) . '</td>
                                        </tr>';


            }
        }

        $table .= ' </tbody>
                                </table>';
        return $table;
    }


    function showMypin()
    {
        global $db, $userKey, $signup;
        $table = '<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                                                
                                                                <th>SN</th>
                                                                <th>E-PIN</th>
                                                                <th>PIN Date</th>
                                                                <th>Type</th>
                                                                <th>Status</th>
                                                                <th>Recipient</th>
                                                            </tr>
                                    </thead>
                                   
                                    <tbody>';
        $sql = $db->query("SELECT * FROM pin WHERE rep='$userKey' ORDER BY sn DESC");
        $i = 1;
        while ($row = mysqli_fetch_assoc($sql)) {
            $e = $i++;
            $user = $row['id'];
            if ($row['status'] == 1) {
                $st = 'used';
            } else {
                $st = 'active';
            }
            if ($row['tm'] == 'Request') {
                $type = 'Request';
            } else {
                $type = 'Auto';
            }
            $uname = ($row['status'] == 1) ? ' (' . $this->uNameUser($user) . ')' : '';
            $table .= '<tr>
                                      <td >' . $e . '</td>
                                      <td  ><a href="#">' . $row['pin'] . '</a></td>
                                      <td >' . $row['created'] . '</td>
                                      <td >' . $row['tm'] . '</td>
                                        <td >' . $st . '</td>
                                     <td >' . $this->uNameUser($user, 'surname') . ' ' . $this->uNameUser($user, 'othername') . $uname . '</td>
                                    </tr>';
        }

        $table .= '</tbody> </table>';

        return $table;
    }


    function showMypinRequest()
    {
        global $db, $userKey;
        $table = '<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                                                
                                                                <th>SN</th>
                                                                <th>Number of PINs</th>
                                                                <th>Payment Details</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                            </tr>
                                    </thead>
                                   
                                    <tbody>';
        $sql = $db->query("SELECT * FROM payment WHERE id='$userKey' ");
        $i = 1;
        while ($row = mysqli_fetch_assoc($sql)) {
            $e = $i++;

            if ($row['status'] == 1) {
                $st = $row['buy'] . ' Approved';
            } else {
                $st = 'Pending';
            }
            $table .= '<tr>
                                      <td >' . $e . '</td>
                                      <td  ><a href="#">' . $row['qty'] . '</a></td>
                                      <td >' . $row['details'] . '</td>
                                      <td >' . $row['created'] . '</td>
                                      <td >' . $st . '</td>
                                    
                                    </tr>';
        }

        $table .= '</tbody> </table>';

        return $table;
    }


    function viewPinRequest()
    {
        global $db;
        $table = '<table id="" class="table-bordered display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                                                
                                                                <th>SN</th>
                                                                <th>Username</th>
                                                                <th>Number of PINs</th>
                                                                <th>Payment Details</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                    </thead>
                                   
                                    <tbody>';
        $col = '';
        $sql = $db->query("SELECT * FROM payment ORDER BY status ASC, created DESC LIMIT 50 ");
        $i = 1;
        while ($row = mysqli_fetch_assoc($sql)) {
            $e = $i++;

            if ($row['status'] == 1) {
                $st = $row['buy'] . ' Approved';
                $btn = '';
            } else {
                $st = 'Pending';
                $btn = '<button type="submit" class="btn btn-xs btn-primary" name="processPin" value="' . $row['sn'] . '">Process</button>';
            }
            // if(isset($_SESSION['processPin'])){  
            $col = ($_SESSION['processPin'] == $row['sn']) ? ' bgcolor="#FF66CC"' : '';

            // }
            $table .= '<tr ' . $col . '>
                                      <td >' . $e . '</td>
                                      <td >' . $this->uName($row['id']) . '</td>
                                      <td  ><a href="#">' . $row['qty'] . '</a></td>
                                      <td >' . $row['details'] . '</td>
                                      <td >' . $row['created'] . '</td>
                                      <td >' . $st . '</td>
                                      <td >' . $btn . '</td>
                                    
                                    </tr>';
        }

        $table .= '</tbody> </table>';

        return $table;
    }





        function updateBankAcc()
    {
        global $db, $report, $count,$userKey;
        
        $accname = sanitize($_POST['accname']);
        $accno = sanitize($_POST['accno']);
        $bank = sanitize($_POST['bank']);
        $sql = $db->query("UPDATE user SET bank = '$bank', accountno = '$accno', accname = '$accname' WHERE id = '$userKey' ");
        if ($sql) {
            $report = 'Account Information Successfully Updated!';
        } else {
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



// function message($id,$sender,$msg,$subject){
// global $db;
// $ctime = CTIME;
// $msg = $db->query("INSERT INTO msg (rec,sender,subject,msg,ctime)
// VALUES('$id','$sender','$subject','$msg','$ctime')") or die(mysqli_error());

//  return;
// }

//administrator messages
    function adminMsg($nu = '')
    {
        global $db, $userKey;
        $msg = '';
        $bl = ['info', 'warning', 'primary', 'danger', 'success'];
        $a = 0;
        $usercreated = $this->uName($userKey, 'created');
        $sql = $db->query("SELECT * FROM msg WHERE (rec = '$userKey' OR rec = 1 OR sender = '$userKey') AND created >= '$usercreated' ORDER BY sn DESC ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_assoc($sql)) {
            $sn = $row['sn'];
            if ($row['active'] == 1) {
                $sql = $db->query("UPDATE msg SET active=2 WHERE sn = '$sn' ");
            }
            $b = $a++;
            $c = $b % 5;
            if ($row['sender'] == 'Admin') {
                $sender = 'Admin';
            } else {
                $sender = ucwords($this->uName($row['sender']));
            }
            if ($row['rec'] == $userKey OR $row['rec'] == 1) {
                $bb = 'bl';
                $bg = '';
            } else {
                $bb = 'br';
                $bg = 'style="background-color:#FFFFCA"';
            }
            $msg .= ' <li class="list-group-item ' . $bb . '-' . $bl[$c] . '" id="' . $row['subject'] . '" ' . $bg . '>
                                            
                                                    <span class="font-16"><strong>' . $sender . ': ' . $row['subject'] . '</strong><br>' . htmlspecialchars($row['msg']) . '</span>
                                               
                                                <h6 class="">' . date('d-M-y h:i A', $row['ctime']) . $this->findReply($row['sn']) . '</h6>
                                            
                                        </li>';
        }
        if ($nu == 1) {
            $sql = $db->query("SELECT * FROM msg WHERE (rec = '$userKey' OR  rec = 1) AND created >= '$usercreated' ") or die(mysqli_error());
            $num = mysqli_num_rows($sql);
            $msg = $num;
        }
        return $msg;
    }

    function findReply($mid)
    {
        global $db;
        $reply = '<br><b>Reply:</b> ';
        $sq = $db->query("SELECT * FROM replymsg WHERE mid = '$mid' ") or die(mysqli_error());
        while ($ro = mysqli_fetch_assoc($sq)) {
            $reply .= '<li>' . htmlspecialchars($ro['reply']) . '</li>';
        }
        $reply = (mysqli_num_rows($sq) > 0) ? '<ul>' . $reply . '</li>' : '';
        return $reply;
    }

//administrator messages
    function adminMsgAll()
    {
        global $db;
        $msg = '';
        $bl = ['info', 'warning', 'primary', 'danger', 'success'];
        $a = 0;
        if (isset($_GET['reply'])) {
            $reply = $_GET['reply'];
            $sq = $db->query("SELECT * FROM msg WHERE sn = '$reply' ") or die(mysqli_error());
            $ro = mysqli_fetch_assoc($sq);
            $user = $ro['sender'];
            $sql = $db->query("SELECT * FROM msg WHERE rec = '$user' OR  rec = '1' OR  sender = '$user' ORDER BY sn DESC ") or die(mysqli_error());
        } else {
            $sql = $db->query("SELECT * FROM msg ORDER BY sn DESC LIMIT 200 ") or die(mysqli_error());
        }
        $num = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_assoc($sql)) {
            $user = ($row['sender'] == 'Admin') ? $row['rec'] : $row['sender'];
            $b = $a++;
            $c = $b % 5;
            if ($row['sender'] == 'Admin') {
                $sender = 'Admin';
            } else {
                $sender = ucwords($this->uName($row['sender']));
            }
            if ($row['rec'] == '1') {
                $rec = 'All';
            } elseif ($row['rec'] == 'Admin') {
                $rec = 'Admin';
            } else {
                $rec = ucwords($this->uName($row['rec']));
            }
            if ($row['rec'] == $user) {
                $bb = 'bl';
                $bg = '';
            } else {
                $bb = 'br';
                $bg = 'style="background-color:#FFFFCA"';
            }
            $msg .= ' <li class="list-group-item ' . $bb . '-' . $bl[$c] . '" id="' . $row['subject'] . '" ' . $bg . '>
                                            
                                                    <span class="font-16"><strong>[' . $sender . ' - ' . $rec . '] ' . $row['subject'] . '</strong><br>' . htmlspecialchars($row['msg']) . '</span>
                                               
                      <h6 class="">' . date('d-M-y h:i A', $row['ctime']) . $this->findReply($row['sn']);
            if ($sender != 'Admin') {
                $msg .= ' <a href="?reply=' . $row['sn'] . '"> Reply</a>';
            }
            if (isset($_GET['reply'])) {
                if ($_GET['reply'] == $row['sn']) {
                    $msg .= '<br><form method="post"><input class="form-control" onchange="submit" name="replyMsg" placeholder="Enter reply & press enter" autofocus></form>';
                }
            }
            $msg .= '</h6>
                                            
                                        </li>';
        }
        return $msg;
    }


//administrator messages
    function adminMsgUser($user)
    {
        global $db;
        $msg = '';
        $bl = ['info', 'warning', 'primary', 'danger', 'success'];
        $a = 0;
        $sql = $db->query("SELECT * FROM msg WHERE rec = '$user' OR  rec = '1' OR  sender = '$user' ORDER BY sn DESC ") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_assoc($sql)) {
            $b = $a++;
            $c = $b % 5;
            if ($row['sender'] == 'Admin') {
                $sender = 'Admin';
            } else {
                $sender = ucwords($this->uName($row['sender']));
            }
            if ($row['rec'] == '1') {
                $rec = 'All';
            } elseif ($row['rec'] == 'Admin') {
                $rec = 'Admin';
            } else {
                $rec = ucwords($this->uName($row['rec']));
            }
            if ($row['rec'] == $userKey) {
                $bb = 'bl';
                $bg = '';
            } else {
                $bb = 'br';
                $bg = 'style="background-color:#FFFFCA"';
            }
            $msg .= ' <li class="list-group-item ' . $bb . '-' . $bl[$c] . '" id="' . $row['subject'] . '" ' . $bg . '>
                                            
                                                    <span class="font-16"><strong>[' . $sender . ' - ' . $rec . '] ' . $row['subject'] . '</strong><br>' . htmlspecialchars($row['msg']) . '</span>
                                               
                                                <h6 class="">' . date('d-M-y h:i A', $row['ctime']) . ' <a href="?reply=' . $row['sn'] . '"> Reply</a></h6>
                                            
                                        </li>';
        }
        if ($nu == 1) {
            $sql = $db->query("SELECT * FROM msg WHERE rec = '$userKey' ") or die(mysqli_error());
            $num = mysqli_num_rows($sql);
            $msg = $num;
        }
        return $msg;
    }


//administrator messages on top nav
    function adminMsg2($nu = '')
    {
        global $db, $userKey;
        $msg = '';
        $bl = ['info', 'warning', 'primary', 'danger', 'success'];
        $a = 0;
        $usercreated = $this->uName($userKey, 'created');
        $sql = $db->query("SELECT * FROM msg WHERE (rec = '$userKey' OR rec = 1) AND active = 1 AND created >= '$usercreated' ORDER BY sn DESC") or die(mysqli_error());
        $num = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_assoc($sql)) {
            $b = $a++;
            $c = $b % 5;
            $msg .= '<a href="messages.php#' . $row['subject'] . '">
                                        
                                        <div class="mail-contnet">
                                            <h5>' . $row['subject'] . '</h5>
                                            <span class="mail-desc">' . htmlspecialchars($row['msg']) . '</span>
                                            <span class="time">' . date('d-M h:i A', $row['ctime']) . '</span>
                                        </div>
                                    </a>';
        }
        if ($nu == 1) {
            $msg = $num;
        }
        return $msg;
    }

    function paystackCharge($amt, $opt = '')
    {
        $result = 100 + ($amt * 0.015);
//$result = ($result<2500) ? $result-100 : $result;
        $result = ($opt == 1) ? $result + $amt : $result;
        return $result;
    }


    function stgTost($stg)
    {
        if ($stg == 1) {
            $s = 'Waiting';
        } elseif ($stg == 2) {
            $s = 'Induction';
        } elseif ($stg == 3) {
            $s = 'Stage 1';
        } elseif ($stg == 4) {
            $s = 'Stage 2';
        } elseif ($stg == 5) {
            $s = 'Stage 3';
        } elseif ($stg == 6) {
            $s = 'Stage 4';
        } elseif ($stg == 7) {
            $s = 'Stage 5';
        }
        return $s;
    }


    function stgTostage($stg)
    {
        if ($stg == 1) {
            $s = 'Induction';
        } elseif ($stg == 2) {
            $s = 'Stage 1';
        } elseif ($stg == 3) {
            $s = 'Stage 2';
        } elseif ($stg == 4) {
            $s = 'Stage 3';
        } elseif ($stg == 5) {
            $s = 'Stage 4';
        } elseif ($stg == 6) {
            $s = 'Stage 5';
        }
        return $s;
    }


    function stagetoLevel($stage, $level)
    {
        if ($stage == 1 && $level == 0) {
            $lev = 1;
        } elseif ($stage == 1 && $level == 1) {
            $lev = 2;
        } elseif ($stage == 2 && $level == 0) {
            $lev = 3;
        } elseif ($stage == 2 && $level == 1) {
            $lev = 4;
        } elseif ($stage == 2 && $level == 2) {
            $lev = 5;
        } elseif ($stage == 3 && $level == 0) {
            $lev = 6;
        } elseif ($stage == 3 && $level == 1) {
            $lev = 7;
        } elseif ($stage == 3 && $level == 2) {
            $lev = 8;
        } elseif ($stage == 4 && $level == 0) {
            $lev = 9;
        } elseif ($stage == 4 && $level == 1) {
            $lev = 10;
        } elseif ($stage == 4 && $level == 2) {
            $lev = 11;
        } elseif ($stage == 5 && $level == 0) {
            $lev = 12;
        } elseif ($stage == 5 && $level == 1) {
            $lev = 13;
        } elseif ($stage == 5 && $level == 2) {
            $lev = 14;
        }
        elseif ($stage == 6 && $level == 0) {
            $lev = 15;
        }
        elseif ($stage == 6 && $level == 1) {
            $lev = 16;
        }
        elseif ($stage == 6 && $level == 2) {
            $lev = 17;
        }
        else {
            $lev = 0;
        }
        return $lev;
    }


    function resetChart()
    {
        unset($_SESSION['stg']);
        header('location: ?');
        return;
    }


    function domTree($parent, $wing = 'a')
    {

        return 'a' . $wing . $parent . ' = {
        parent: a' . $parent . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';
    }

//$code .= 'a'.$left[1].', ' ;

    function domCode($wing, $no = 1)
    {

        $code = 'a' . $wing . ', ';

        if ($no == 2) {
            $code .= 'aa' . $wing . ', ';
            $code .= 'ab' . $wing . ', ';
        }


        if ($no == 3) {
            $code .= 'aa' . $wing . ', ';
            $code .= 'ab' . $wing . ', ';
            $code .= 'aaa' . $wing . ', ';
            $code .= 'aba' . $wing . ', ';
            $code .= 'aab' . $wing . ', ';
            $code .= 'abb' . $wing . ', ';

        }

        return $code;
    }


    function domChild($parent, $wing, $no = 1)
    {

        $tree = 'a' . $wing . ' = {
        parent: a' . $parent . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';

        if ($no == 2) {
            $tree .= 'aa' . $wing . ' = {
        parent: a' . $wing . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';

            $tree .= 'ab' . $wing . ' = {
        parent: a' . $wing . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';
        }


        if ($no == 3) {
            $tree .= 'aa' . $wing . ' = {
        parent: a' . $wing . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';

            $tree .= 'ab' . $wing . ' = {
        parent: a' . $wing . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';
            //end of two
            $tree .= 'aaa' . $wing . ' = {
        parent: aa' . $wing . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';

            $tree .= 'aba' . $wing . ' = {
        parent: aa' . $wing . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';


            $tree .= 'aab' . $wing . ' = {
        parent: ab' . $wing . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';

            $tree .= 'abb' . $wing . ' = {
        parent: ab' . $wing . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';
        }

        return $tree;
    }

    function childTree($parent, $child, $cname)
    {
        global $img;


        return 'a' . $child . ' = {
        parent: a' . $parent . ',
        text:{
            name: "' . $cname . '",
            title: "",
            contact: "",
        },
        link: {
            href: "?u-ref=' . sha1($child) . '"
        },
    
        image: "../headshots/' . $img . '"
    }, ';
    }

    function childTreeAll($parent, $child, $cname)
    {
        global $mystage;


        return 'a' . $child . ' = {
        parent: a' . $parent . ',
        text:{
            name: "' . $cname . '",
            title: "",
            contact: "",
        },
        link: {
            href: "?u-ref=' . sha1($child) . '"
        },
    
        image: "../headshots/users.png"
    }, ';
    }


    function childTreex($parent, $child, $cname)
    {
        global $mystage;


        return 'a' . $child . ' = {
        parent: a' . $parent . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
    
        image: "../headshots/use.png"
    }, ';
    }


    function gTreex($opt = '')
    {
        global $db, $key, $report, $count, $user, $randomKey;
        if (isset($_GET['u-ref'])) {
            $random = $_GET['u-ref'];
            $sql = $db->query("SELECT * FROM user WHERE sha1(sn) = '$random' ") or die(mysqli_error());
            $ro = mysqli_fetch_assoc($sql);
            $keys = $ro['sn'];
        }
//$level = $this->wildLevel2($randomKey,2);


        $randomKey = isset($_GET['u-ref']) ? $keys : $this->userName('sn');
        $user = $randomKey;
        $gen1 = $this->wildGen($randomKey, 1);
        //$randomKey = $this->userName('sn');


        $code = 'chart_config = [
        config, a' . $randomKey . ', ';

        $tree = 'var config = {
        container: "#basic-example",
        nodeAlign: "BOTTOM",
        connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
        $tree .= 'a' . $randomKey . ' = {
        text: {
            name: "' . $this->userNameWild('user') . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
        image: "../headshots/feeder.png"
    },';


        if ($gen1 == 0) {
            $code .= 'aa' . $randomKey . ', ';
            $tree .= $this->domTree($randomKey);

            $code .= 'ab' . $randomKey . ', ';
            $tree .= $this->domTree($randomKey, 'b');
        } elseif ($gen1 == 1) {

            $qu = $db->query("SELECT * FROM user WHERE a1 = '$randomKey' ") or die(mysqli_error());
            while ($row = mysqli_fetch_assoc($qu)) {

                $code .= 'a' . $row['sn'] . ', ';
                $tree .= $this->childTree($randomKey, $row['sn'], $row['user']);

            }

            $code .= 'aa' . $randomKey . ', ';
            $tree .= $this->domTree($randomKey);
        } else {
            $qu = $db->query("SELECT * FROM user WHERE a1 = '$randomKey' ") or die(mysqli_error());
            while ($row = mysqli_fetch_assoc($qu)) {

                $code .= 'a' . $row['sn'] . ', ';
                $tree .= $this->childTree($randomKey, $row['sn'], $row['user']);

            }
        }


        $code .= '];';

        //$report = 'Showing your '.$this->stgTost($mystage).' geneology ';
        //$count = 0;
        return $tree . $code;


    }


    /*

function gTreey($opt=''){
global $db,$key,$report,$count,$user,$randomKey;
if(isset($_GET['u-ref'])){ $random = $_GET['u-ref'];
$sql=$db->query("SELECT * FROM user WHERE sha1(sn) = '$random' " )or die(mysqli_error());
$ro = mysqli_fetch_assoc($sql);
$keys = $ro['sn'];
}
//$level = $this->wildLevel2($randomKey,2);




                $randomKey = isset($_GET['u-ref']) ? $keys : $this->userName('sn');
                $user=$randomKey;
                $gen1 = $this->wildGen($randomKey,1);
                //$randomKey = $this->userName('sn');
                $leftkey = $this->wildLegKey($randomKey);
                $rightkey = $this->wildLegKey($randomKey,1);
            

                
                

                $code='chart_config = [
        config, a'.$randomKey.', ';

                $tree='var config = {
        container: "#basic-example",
        nodeAlign: "BOTTOM",
        connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
                $tree.='a'.$randomKey.' = {
        text: {
            name: "'.$this->userNameWild('user').'",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
        image: "../headshots/induction.png"
    },';  

//left child
    if(isset($leftkey) && $this->wildSponsored($leftkey)>1){
        $left = $this->wildLegKey($leftkey);
        $right = $this->wildLegKey($leftkey,1);
        
 $code .= 'a'.$leftkey.', ' ;
 $tree .= $this->childTree($randomKey,$leftkey,$this->wildUserName($leftkey,'user'));  

//left grand child
  if(isset($left) && $this->wildSponsored($left)>1){
   $code .= 'a'.$left.', ' ;
 $tree .= $this->childTree($leftkey,$left,$this->wildUserName($left,'user'));           
        
    }else{
        $code .= 'aa'.$leftkey.', ' ;
        $tree .= $this->domTree($leftkey);
    }
    //right grand child
   if(isset($right) && $this->wildSponsored($right)>1){
  $code .= 'a'.$right.', ' ;
 $tree .= $this->childTree($leftkey,$right,$this->wildUserName($right,'user'));         
        
    }else{
        $code .= 'ab'.$leftkey.', ' ;
        $tree .= $this->domTree($leftkey,'b');
    }       
        
    }else{
        $code .= 'aa'.$randomKey.', ' ;
        $tree .= $this->domTree($randomKey);

        $grand = 'a'.$randomKey;
        $code .= 'ae'.$grand.', ' ;
        $tree .= $this->domTree($grand,'e');

        $code .= 'af'.$grand.', ' ;
        $tree .= $this->domTree($grand,'f');
    }




//right child
        if(isset($rightkey) && $this->wildSponsored($rightkey)>1){
        $left = $this->wildLegKey($rightkey);
        $right = $this->wildLegKey($rightkey,1);

 $code .= 'a'.$rightkey.', ' ;
 $tree .= $this->childTree($randomKey,$rightkey,$this->wildUserName($rightkey,'user'));         
        
        //left grand child
     if(isset($left) && $this->wildSponsored($left)>1){
   $code .= 'a'.$left.', ' ;
 $tree .= $this->childTree($rightkey,$left,$this->wildUserName($left,'user'));          
        
    }else{
        $code .= 'aa'.$rightkey.', ' ;
        $tree .= $this->domTree($rightkey);
    }
    //right grand child
   if(isset($right) && $this->wildSponsored($right)>1){
  $code .= 'a'.$right.', ' ;
 $tree .= $this->childTree($rightkey,$right,$this->wildUserName($right,'user'));        
        
    }else{
        $code .= 'ab'.$rightkey.', ' ;
        $tree .= $this->domTree($rightkey,'b');
    }
    }else{
        $code .= 'ab'.$randomKey.', ' ;
        $tree .= $this->domTree($randomKey,'b');

        //'a'.$wing.$parent.' = {
      //  parent: a'.$parent.',
$grand = 'b'.$randomKey;
        $code .= 'ac'.$grand.', ' ;
        $tree .= $this->domTree($grand,'c');

        $code .= 'ad'.$grand.', ' ;
        $tree .= $this->domTree($grand,'d');
    }
            



            $code .='];';

            //$report = 'Showing your '.$this->stgTost($mystage).' geneology ';
            //$count = 0;
        return $tree.$code; 

            
            }


*/


    function gTreey($opt = '')
    {
        global $db, $key, $img, $user;
        if (isset($_GET['u-ref'])) {
            $random = $_GET['u-ref'];
            $sql = $db->query("SELECT * FROM user WHERE sha1(sn) = '$random' ") or die(mysqli_error());
            $ro = mysqli_fetch_assoc($sql);
            $keys = $ro['sn'];
            $randomKey = $keys;
            $left = explode(',', $this->legH($this->wildLegKey($keys)));
            $right = explode(',', $this->legH($this->wildLegKey($keys, 1)));
        } else {
            $randomKey = $this->userName('sn');
            $left = explode(',', $this->legH($this->legKey()));
            $right = explode(',', $this->legH($this->legKey(1)));
        }

        $user = $randomKey;
        $img = 'induction.png';


        $code = 'chart_config = [
        config, a' . $randomKey . ', ';

        $tree = 'var config = {
        container: "#basic-example",
         nodeAlign: "BOTTOM",
         connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
        $tree .= 'a' . $randomKey . ' = {
        text: {
            name: "' . $this->userNameWild('user') . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
        image: "../headshots/induction.png"
    },';

        if (!empty($left[0])) {
            $code .= 'a' . $left[0] . ', ';
            $tree .= $this->childTree($randomKey, $left[0], $this->wildUserName($left[0], 'user'));
        } else {
            //$code .= 'aa'.$randomKey.', ' ;
            //$tree .= $this->domTree($randomKey,'a');
            $code .= $this->domCode('x', 2);
            $tree .= $this->domChild($randomKey, 'x', 2);
        }

        if (!empty($left[0])) {
            if (!empty($left[1])) {
                $code .= 'a' . $left[1] . ', ';
                $tree .= $this->childTree($left[0], $left[1], $this->wildUserName($left[1], 'user'));
            } else {
                $code .= $this->domCode('y');
                $tree .= $this->domChild($left[0], 'y');
            }

            if (!empty($left[2])) {
                $code .= 'a' . $left[2] . ', ';
                $tree .= $this->childTree($left[0], $left[2], $this->wildUserName($left[2], 'user'));
            } else {
                $code .= $this->domCode('z');
                $tree .= $this->domChild($left[0], 'z');
            }
        }


        if (!empty($right[0])) {
            $code .= 'a' . $right[0] . ', ';
            $tree .= $this->childTree($randomKey, $right[0], $this->wildUserName($right[0], 'user'));
        } else {
            $code .= $this->domCode('p', 2);
            $tree .= $this->domChild($randomKey, 'p', 2);
        }

        if (!empty($right[0])) {
            if (!empty($right[1])) {
                $code .= 'a' . $right[1] . ', ';
                $tree .= $this->childTree($right[0], $right[1], $this->wildUserName($right[1], 'user'));
            } else {
                $code .= $this->domCode('q');
                $tree .= $this->domChild($right[0], 'q');
            }

            if (!empty($right[2])) {
                $code .= 'a' . $right[2] . ', ';
                $tree .= $this->childTree($right[0], $right[2], $this->wildUserName($right[2], 'user'));
            } else {
                $code .= $this->domCode('r');
                $tree .= $this->domChild($right[0], 'r');
            }
        }


        $code .= '];';

        //$report = 'Showing your '.$this->stgTost($mystage).' geneology ';
        //$count = 0;
        return $tree . $code;


    }


    function level2($key)
    {

        if ($this->team1($key) == 12) {
            return 2;
        } else {
            return 0;
        }
    }


    function gTreez($st = 3)
    {
        global $db, $img, $user;
        if (isset($_GET['u-ref'])) {
            $random = $_GET['u-ref'];
            $sql = $db->query("SELECT * FROM user WHERE sha1(sn) = '$random' ") or die(mysqli_error());
            $ro = mysqli_fetch_assoc($sql);
            $keys = $ro['sn'];
            $randomKey = $keys;
//legSt($key,$st)
            $left = explode(',', $this->legSt($this->wildLegKey($keys), $st));
            $right = explode(',', $this->legSt($this->wildLegKey($keys, 1), $st));
        } else {
            $randomKey = $this->userName('sn');
            $left = explode(',', $this->legSt($this->legKey(), $st));
            $right = explode(',', $this->legSt($this->legKey(1), $st));
        }

        $user = $randomKey;
        $img = $this->image2($st);


        $code = 'chart_config = [
        config, a' . $randomKey . ', ';

        $tree = 'var config = {
        container: "#basic-example",
         nodeAlign: "BOTTOM",
         connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
        $tree .= 'a' . $randomKey . ' = {
        text: {
            name: "' . $this->userNameWild('user') . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
        image: "../headshots/' . $img . '"
    },';

        if (!empty($left[0])) {
            $code .= 'a' . $left[0] . ', ';
            $tree .= $this->childTree($randomKey, $left[0], $this->wildUserName($left[0], 'user'));
        } else {
            //$code .= 'aa'.$randomKey.', ' ;
            //$tree .= $this->domTree($randomKey,'a');
            $code .= $this->domCode('x', 3);
            $tree .= $this->domChild($randomKey, 'x', 3);
        }

        if (!empty($left[0])) {
            if (!empty($left[1])) {
                $code .= 'a' . $left[1] . ', ';
                $tree .= $this->childTree($left[0], $left[1], $this->wildUserName($left[1], 'user'));
            } else {
                $code .= $this->domCode('y', 2);
                $tree .= $this->domChild($left[0], 'y', 2);
            }

            if (!empty($left[2])) {
                $code .= 'a' . $left[2] . ', ';
                $tree .= $this->childTree($left[0], $left[2], $this->wildUserName($left[2], 'user'));
            } else {
                $code .= $this->domCode('z', 2);
                $tree .= $this->domChild($left[0], 'z', 2);
            }
        }


        if (!empty($left[1])) {
            if (!empty($left[3])) {
                $code .= 'a' . $left[3] . ', ';
                $tree .= $this->childTree($left[1], $left[3], $this->wildUserName($left[3], 'user'));
            } else {
                $code .= $this->domCode('l');
                $tree .= $this->domChild($left[1], 'l');
            }

            if (!empty($left[4])) {
                $code .= 'a' . $left[4] . ', ';
                $tree .= $this->childTree($left[1], $left[4], $this->wildUserName($left[4], 'user'));
            } else {
                $code .= $this->domCode('m');
                $tree .= $this->domChild($left[1], 'm');
            }
        }


        if (!empty($left[2])) {
            if (!empty($left[5])) {
                $code .= 'a' . $left[5] . ', ';
                $tree .= $this->childTree($left[2], $left[5], $this->wildUserName($left[5], 'user'));
            } else {
                $code .= $this->domCode('n');
                $tree .= $this->domChild($left[2], 'n');
            }

            if (!empty($left[6])) {
                $code .= 'a' . $left[6] . ', ';
                $tree .= $this->childTree($left[2], $left[6], $this->wildUserName($left[6], 'user'));
            } else {
                $code .= $this->domCode('o');
                $tree .= $this->domChild($left[2], 'o');
            }
        }


        if (!empty($right[0])) {
            $code .= 'a' . $right[0] . ', ';
            $tree .= $this->childTree($randomKey, $right[0], $this->wildUserName($right[0], 'user'));
        } else {
            $code .= $this->domCode('p', 3);
            $tree .= $this->domChild($randomKey, 'p', 3);
        }

        if (!empty($right[0])) {
            if (!empty($right[1])) {
                $code .= 'a' . $right[1] . ', ';
                $tree .= $this->childTree($right[0], $right[1], $this->wildUserName($right[1], 'user'));
            } else {
                $code .= $this->domCode('q', 2);
                $tree .= $this->domChild($right[0], 'q', 2);
            }

            if (!empty($right[2])) {
                $code .= 'a' . $right[2] . ', ';
                $tree .= $this->childTree($right[0], $right[2], $this->wildUserName($right[2], 'user'));
            } else {
                $code .= $this->domCode('r', 2);
                $tree .= $this->domChild($right[0], 'r', 2);
            }
        }


        if (!empty($right[1])) {
            if (!empty($right[3])) {
                $code .= 'a' . $right[3] . ', ';
                $tree .= $this->childTree($right[1], $right[3], $this->wildUserName($right[3], 'user'));
            } else {
                $code .= $this->domCode('s');
                $tree .= $this->domChild($right[1], 's');
            }

            if (!empty($right[4])) {
                $code .= 'a' . $right[4] . ', ';
                $tree .= $this->childTree($right[1], $right[4], $this->wildUserName($right[4], 'user'));
            } else {
                $code .= $this->domCode('t');
                $tree .= $this->domChild($right[1], 't');
            }
        }


        if (!empty($right[2])) {
            if (!empty($right[5])) {
                $code .= 'a' . $right[5] . ', ';
                $tree .= $this->childTree($right[2], $right[5], $this->wildUserName($right[5], 'user'));
            } else {
                $code .= $this->domCode('u');
                $tree .= $this->domChild($right[2], 'u');
            }

            if (!empty($right[6])) {
                $code .= 'a' . $right[6] . ', ';
                $tree .= $this->childTree($right[2], $right[6], $this->wildUserName($right[6], 'user'));
            } else {
                $code .= $this->domCode('v');
                $tree .= $this->domChild($right[2], 'v');
            }
        }


        $code .= '];';

        //$report = 'Showing your '.$this->stgTost($mystage).' geneology ';
        //$count = 0;
        return $tree . $code;


    }


    function allTree($opt = '')
    {
        global $db, $key, $report, $count, $user, $randomKey, $mystage;
        if (isset($_GET['u-ref'])) {
            $random = $_GET['u-ref'];
            $sql = $db->query("SELECT * FROM user WHERE sha1(sn) = '$random' ") or die(mysqli_error());
            $ro = mysqli_fetch_assoc($sql);
            $keys = $ro['sn'];
        }
//$level = $this->wildLevel2($randomKey,2);


        $randomKey = isset($_GET['u-ref']) ? $keys : $this->userName('sn');
        $user = $randomKey;

        $mystage = 0;


        $code = 'chart_config = [
        config, a' . $randomKey . ', ';

        $tree = 'var config = {
        container: "#basic-example",
        nodeAlign: "BOTTOM",
        connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
        $tree .= 'a' . $randomKey . ' = {
        text: {
            name: "' . $this->userNameWild('user') . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },
        image: "../headshots/users.png"
    },';

        $a = 1;
        $x = 1;
        $nu = 0;
        while ($a <= 3) {
            $b = $a++;
            $gen = 'a' . $b;
            $qu = $db->query("SELECT * FROM user WHERE $gen = '$randomKey' ") or die(mysqli_error());
            while ($row = mysqli_fetch_assoc($qu)) {
                $child = $row['sn'];
                $parent = $row['a1'];
                //  $stage = $this->wildLevel2($child,2);
                $y = $x++;


                //$x = ($b==1) ? 'a' : 'b';
//left child

                if ($b < 3) {
                    $code .= 'a' . $child . ', ';
                    $tree .= $this->childTreeAll($parent, $child, $this->wildUserName($child, 'user'));

                    if ($this->wildGen($child, 1) == 0) {
                        $code .= 'aa' . $child . ', ';
                        $tree .= $this->domTree($child, 'a');

                        $code .= 'ab' . $child . ', ';
                        $tree .= $this->domTree($child, 'b');

                    } elseif ($this->wildGen($child, 1) == 1) {
                        $code .= 'aa' . $child . ', ';
                        $tree .= $this->domTree($child, 'a');
                    }
                } else {
                    $code .= 'a' . $child . ', ';
                    $tree .= $this->childTreeAll($parent, $child, $this->wildUserName($child, 'user'));
                }

            }

        }


        $code .= '];';

        //$report = 'Showing your '.$this->stgTost($mystage).' geneology ';
        //$count = 0;
        return $tree . $code;


    }


    function legStageProgress($leg = 0)
    {
        global $db;
        $percent = 0;
        $randomKey = $this->legKey($leg);
        $upstage = $this->wildLevel2($this->userName('sn'), 2);
        $mystage = $this->wildLevel2($randomKey, 2);
        if ($mystage == 1) {
            $show = 1;
        } elseif ($mystage == 2) {
            $show = 2;
        } else {
            $show = 3;
        }
        $a = 1;
        $nu = 0;
        while ($a <= $show) {
            $b = $a++;
            $gen = 'a' . $b;
            $qu = $db->query("SELECT * FROM user WHERE $gen = '$randomKey' ") or die(mysqli_error());
            while ($row = mysqli_fetch_assoc($qu)) {
                //$user = $row['sn'];
                $stage = $this->wildLevel2($row['sn'], 2);
                //Indicate waiting user with < 2 sponsored
                if (($stage >= $upstage AND $this->wildSponsored($row['sn']) > 1) OR ($show == 1 AND $this->wildSponsored($randomKey) > 1)) {
                    $nu += 1;
                }
            }
        }
        if ($mystage >= $upstage) {
            $nu = $nu + 1;
            if ($upstage == 1) {
                $percent = 100 * $nu / 2;
            } elseif ($upstage == 2) {
                $percent = 100 * $nu / 6;
            } else {
                $percent = 100 * $nu / 14;
            }
        }
        return number_format($percent, 1) . '%';
    }


    function levelProgress()
    {
        global $db;
        $key = $this->userName('sn');
        $level = $this->findLevel($key);
        $nextlevel = $level + 1;
        $stagelevel = $this->wildLevel2($key, 5) + 1;
        $gen = 'a' . $stagelevel;
        $target = 2 ** $stagelevel;
        $upstage = $this->wildLevel2($key, 2);
        $nu = 0;
        $qu = $db->query("SELECT * FROM user WHERE $gen = '$key' ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($qu)) {
            $stage = $this->wildLevel2($row['sn'], 2);
            if (($stage >= $upstage AND $this->wildSponsored($row['sn']) > 1) OR $level == 0) {
                $nu += 1;
            }
        }
        $percent = (100 * $nu / $target);

        return number_format($percent, 1) . '%';
    }


    function image($key)
    {
        $level = $this->wildLevel2($key, 2);
        //if($this->wildSponsored($key)<2){ $wait = 'waiting.jpg' ;}
        if ($level == 1) {
            $wait = 'feeder.png';
        } elseif ($level == 2) {
            $wait = 'induction.png';
        } elseif ($level == 3) {
            $wait = 'stage1.png';
        } elseif ($level == 4) {
            $wait = 'stage2.png';
        } elseif ($level == 5) {
            $wait = 'stage3.png';
        } elseif ($level == 6) {
            $wait = 'stage4.png';
        } elseif ($level == 7) {
            $wait = 'stage5.png';
        } //elseif($level<1){ $wait = 'user4.jpg' ;}
        else {
            $wait = 'stage5.png';
        }
        return $wait;
    }

    function image2($level)
    {

        if ($level == 1) {
            $wait = 'feeder.png';
        } elseif ($level == 2) {
            $wait = 'induction.png';
        } elseif ($level == 3) {
            $wait = 'stage1.png';
        } elseif ($level == 4) {
            $wait = 'stage2.png';
        } elseif ($level == 5) {
            $wait = 'stage3.png';
        } elseif ($level == 6) {
            $wait = 'stage4.png';
        } elseif ($level == 7) {
            $wait = 'stage5.png';
        } //elseif($level<1){ $wait = 'user4.jpg' ;}
        else {
            $wait = 'stage5.png';
        }
        return $wait;
    }

//Geneology Tree
    function gTreeAll()
    {
        global $db, $key, $user;
        $show = 3;
        if (isset($_GET['u-ref'])) {
            $random = $_GET['u-ref'];
            $sql = $db->query("SELECT * FROM user WHERE sha1(sn) = '$random' ") or die(mysqli_error());
            $ro = mysqli_fetch_assoc($sql);
            $key = $ro['sn'];
        }
        $randomKey = isset($_GET['u-ref']) ? $key : $this->userName('sn');
        $mystage = $this->wildLevel2($randomKey, 2);
        $sstag = $this->Level(1);
        $user = $randomKey;

        $code = 'chart_config = [
        config, a' . $randomKey . ', ';

        $tree = 'var config = {
        container: "#basic-example",
        nodeAlign: "BOTTOM",
        connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
        $tree .= 'a' . $randomKey . ' = {
        text: {
            name: "' . $this->userNameWild('user') . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },

        image: "../headshots/users.png"
    },';

        if ($this->wildGen($randomKey, 1) == 0) {
            $code .= 'aa' . $randomKey . ', ';
            $tree .= 'aa' . $randomKey . ' = {
        parent: a' . $randomKey . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: "registernew.php?reff=' . $this->userNameWild('user') . '"
        },
    
        image: "../headshots/reg.png"
    }, ';

            $code .= 'ab' . $randomKey . ', ';
            $tree .= 'ab' . $randomKey . ' = {
        parent: a' . $randomKey . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: "registernew.php?reff=' . $this->userNameWild('user') . '"
        },
    
        image: "../headshots/reg.png"
    }, ';
        }


//   contact: "'.$this->wildLevel2($randomKey,7).'",
        $a = 1;
        $x = 1;
        $c = 0;
        $nu = 0;
        while ($a <= $show) {
            $b = $a++;
            $gen = 'a' . $b;
            $qu = $db->query("SELECT * FROM user WHERE $gen = '$randomKey' ") or die(mysqli_error());
            while ($row = mysqli_fetch_assoc($qu)) {
                $user = $row['sn'];


                $code .= 'a' . $row['sn'] . ', ';
                $tree .= 'a' . $row['sn'] . ' = {
        parent: a' . $row['a1'] . ',
        text:{
            name: "' . $row['user'] . '",
            title: "",
            contact: "",
        },
        link: {
            href: "?u-ref=' . sha1($row['sn']) . '"
        },
    
        image: "../headshots/users.png"
    }, ';


                if ($this->wildGen($randomKey, 1) == 1 && $b == 1) {
                    $code .= 'aa' . $randomKey . ', ';
                    $tree .= 'aa' . $randomKey . ' = {
        parent: a' . $randomKey . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: "registernew.php?reff=' . $this->userNameWild('user') . '"
        },
    
        image: "../headshots/reg.png"
    }, ';
                }

                if ($this->wildGen($row['sn'], 1) == 0 && $b < 3) {
                    $code .= 'aa' . $row['sn'] . ', ';
                    $tree .= 'aa' . $row['sn'] . ' = {
        parent: a' . $row['sn'] . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: "registernew.php?reff=' . $row['user'] . '"
        },
    
        image: "../headshots/reg.png"
    }, ';

                    $code .= 'ab' . $row['sn'] . ', ';
                    $tree .= 'ab' . $row['sn'] . ' = {
        parent: a' . $row['sn'] . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: "registernew.php?reff=' . $row['user'] . '"
        },
    
        image: "../headshots/reg.png"
    }, ';
                }

                if ($this->wildGen($row['a1'], 1) == 1 && $b < 4) {
                    $user = $row['a1'];
                    $code .= 'aa' . $row['a1'] . ', ';
                    $tree .= 'aa' . $row['a1'] . ' = {
        parent: a' . $row['a1'] . ',
        text:{
            name: "",
            title: "",
            contact: "",
        },
        link: {
            href: "registernew.php?reff=' . $this->userNameWild('user') . '"
        },
    
        image: "../headshots/reg.png"
    }, ';
                }


            }
        }
        //contact: "'.$this->wildLevel2($row['sn'],7).'",
        $code .= '];';

        return $tree . $code;
    }


    function stageEarning($opt = '')
    {
        $stage = 2 ** $this->Level();
        $total = 0;
        $a = 1;
        while ($a <= $this->Level()) {
            $b = $a++;
            $total += 2 ** $b;
        }
        if ($opt == 1) {
            return 1.5 * $total;
        } else {
            return 1.5 * $stage;
        }
    }

    //user Rank     

    function Rank($user)
    {
        if ($this->Downlines() < 3) {
            $rank = 0;
        } elseif ($this->Downlines() < 12) {
            $rank = 1;
        } elseif ($this->Downlines() < 39) {
            $rank = 2;
        } elseif ($this->Downlines() < 120) {
            $rank = 3;
        } elseif ($this->Downlines() < 363) {
            $rank = 4;
        } elseif ($this->Downlines() < 1092) {
            $rank = 5;
        } elseif ($this->Downlines() < 3279) {
            $rank = 6;
        } elseif ($this->Downlines() < 9840) {
            $rank = 7;
        } elseif ($this->Downlines() < 29523) {
            $rank = 8;
        } elseif ($this->Downlines() < 88572) {
            $rank = 9;
        } else {
            $rank = 10;
        }
        return $rank;
    }

    //Bonus Types
    function matrixB()
    {
        global $id;
        return $this->Downlines() * $this->percent() / $this->dola;
    }

    function referalB()
    {
        return $this->Sponsored() * 2;
    }


    function percent($p = 5)
    {
        return $this->amount * $p / 100;
    }

    //Withdrawal Methods


    function confirmedWithdraw()
    {
        global $db, $userKey;

        $status = STATUSALPHA;

        $sql = $db->query("SELECT amount FROM withdraw WHERE id2 = '$userKey' AND status = '$status' ");
        $amt = 0;
        while ($row = mysqli_fetch_assoc($sql)) {
            $amt += $row['amount'];
        }
        return $amt;
    }


    function userWithdraw($id)
    {

        return $this->confirmedWithdraw($id) + $this->pendingWithdraw($id);
    }


    function pendingWithdraw($id)
    {
        global $db;

        $status = STATUSBETA;

        $sql = $db->query("SELECT amount FROM withdraw WHERE id2 = '$id' AND status = '$status' ");
        $amt = 0;
        while ($row = mysqli_fetch_assoc($sql)) {
            $amt += $row['amount'];
        }
        return $amt;
    }

    function accountBalance()
    {
        return $this->totalEarning() - $this->confirmedWithdraw() - $this->pendingWithdraw();
    }


    function possibleEpin()
    {
        return (int)($this->accountBalance() / $this->dolafee);
    }


//Withdrawal Order
   


    // function confirmPinPayment()
    // {
    //     global $db;
    //     $payref = $_GET['tr_referenca'];
    //     $epinqty = $_SESSION['pins'];

    //     if ($_GET['tr_referenca'] == $_SESSION['referenca']) {
    //         $this->sellEpins($epinqty, 'Card Pay');
    //         $_SESSION['report'] = 'Payment Successful. Your newly purchases E-PINs (' . $epinqty . ') have been delivered to you';
    //     }
    //     unset($_SESSION['referenca']);
    //     header("location: ?payment-confirmed=online");
    //     return;
    // }


//Withdrawal Order
    function approvePinRequest()
    {
        global $db, $epinqty, $paytype, $report, $count;
        $epinqty = sanitize($_POST['pins']);
        $sn = $_POST['approvePinRequest'];
        //$withdrawAmount = $epinqty*10;//$this->$dolafee;
        $approval = md5($_POST['approval']);
        $type = 'E-PIN Request';
        $status = 1;

        $sq = $db->query("SELECT * FROM payment WHERE sn = '$sn' ");
        $row = mysqli_fetch_assoc($sq);
        $key = $row['id'];
        //$accountBalance = $this->accountBalance();
        //$finalbalance = $accountBalance-$withdrawAmount;


        if ($this->userName('pass') == $approval) {
            //$this->withdrawProcess($withdrawAmount,$type,$status);
            $sql = $db->query("UPDATE payment SET status=1, buy='$epinqty' WHERE sn = '$sn' ");
            $this->sellEpinsAdmin($epinqty, $key);
            $report = 'Transaction Successful';
        } else {
            $report = 'Transaction Unsuccessful. Authentication failed or insufficient balance';
            $count = 1;
        }

        return;
    }


//Withdrawal Order
    function deletePinRequest()
    {
        global $db, $epinqty, $paytype, $report, $count;

        $sn = $_POST['deletePinRequest'];
        $approval = md5($_POST['approval']);

        if ($this->userName('pass') == $approval) {
            $sq = $db->query("DELETE FROM payment WHERE sn = '$sn' ");
            $report = 'Successfully Deleted Pin Request';
        } else {
            $report = 'Transaction Unsuccessful. Authentication failed';
            $count = 1;
        }


        return;
    }


//Withdrawal Order
    function requestEpins()
    {
        global $db, $userKey, $report, $count, $signup;
        $epinqty = sanitize($_POST['pins']);
        $details = sanitize($_POST['details']);

        $approval = md5($_POST['approval']);
        $type = 'E-PIN Request';

        $doc = $signup->win_hashs(5) . str_replace(" ", "-", $_FILES['docc']['name']);
        define('upload', 'payment/');
        if (isset($doc) AND strlen($doc) > 4) {
            $success = move_uploaded_file($_FILES['docc']['tmp_name'], upload . $doc);
        }

        if ($this->userName('pass') == $approval) {
            $msg = $db->query("INSERT INTO payment (id,qty,details,type,image)
VALUES('$userKey','$epinqty','$details','$type','$doc')") or die(mysqli_error());

            $report = 'Transaction Request Sent';
        } else {
            $report = 'Transaction Request Not Sent. Authentication failed or insufficient balance';
            $count = 1;
        }

        return;
    }

    function GenerateUserPin(){
        global $db,$report,$count;

        $pin = sanitize($_POST['pin']);
        $username = sanitize($_POST['username']);

        $sql = $db->query("SELECT * FROM user WHERE user='$username' LIMIT 1");
        $row = $sql->fetch_assoc();
        if($sql->num_rows < 1){
            $count = 1;
            $report = "Username Does not Exist, Please check and Try Again";
        }
        else {
            $id = $row['id'];
            $i = 1; $sum1 = $sum2 = 0;
            
            while ($i <= $pin){ 
                $p = substr(str_shuffle(str_repeat('123456789', 10)), 0, 10);
                $sql1=$db->query("SELECT * FROM pin WHERE pin='$p'");
                if($sql1->num_rows > 0){
                    $sum1 += 1;
                }
                else {
                    $sum2 += 1;
                $db->query("INSERT INTO pin (pin,rep,tm) VALUES('$p','$id','1')");
                
            }
            $i = $i + 1;
            }
//            $_SESSION['rs'] = $sum1." Rejected<br>". $sum2." PIN(s) Succcessfully Generated";
            $report = $sum1." Rejected<br>". $sum2." PIN(s) Succcessfully Generated";
            $msg = 'Pin purchase successful. The E-PINs you purchased (' . $sum2 . ') have been delivered to you. click on BUY & MANAGE E-PINs from the menu to see the PINs';
            //$this->message($id, $msg);

//            header("Location:?#");
        }
    }
    function sellEpins($id,$epinqty, $type='Admin')
    {
        global $db;
        $i = 1;
        while ($i <= $epinqty) {
            $e = $i++;
            $pin = $this->win_hash('10');

            $db->query("INSERT INTO pin (pin,rep,tm) VALUES('$pin','$id','$type')");
        }

        return;
    }


    function sellEpinsAdmin($epinqty, $key)
    {
        global $db;
        $i = 1;
        while ($i <= $epinqty) {
            $e = $i++;
            $pin = substr(str_shuffle(str_repeat('1234567890', 10)), 0, 10);

            $db->query("INSERT INTO pin (pin,rep,tm) VALUES('$pin','$key','Request')");
        }
        $msg = 'Pin purchase successful. The E-PINs you purchased (' . $epinqty . ') have been delivered to you. click on BUY & MANAGE E-PINs from the menu to see the PINs';
        $this->message($key, 'Admin', $msg, 'E-PIN Purchase');
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

function logdraw($tno)
    {
        global $db;
        $sql = $db->query("INSERT INTO logdraw SELECT * FROM withdraw WHERE tno = '$tno' ");
        return;
    }


    function withdrawHistory()
    {
        global $db, $userKey;

        $table = '<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                             <th>Transaction No</th>
                                            <th>Amount</th>
                                            <th>Charges</th>
                                            <th>Date</th>

                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>';
        $i = 1;
        $sql = $db->query("SELECT * FROM withdraw WHERE id = '$userKey' ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($sql)) {
            $e = $i++;
            $status = ($row['status'] == 1) ? 'Complete' : 'Pending';
            $amt = ($row['type'] == 'Cash Withdrawal') ? '$' . ($row['amount'] - 0.5) : '$' . $row['amount'];
            $charge = ($row['type'] == 'Cash Withdrawal') ? '$' . '0.5' : 0;

            $table .= ' <tr>
                                            <td>' . $e . '</td>
                                            <td>' . $row['tno'] . '</td>
                                            <td>' . $amt . '</td>
                                            <td>' . $charge . '</td>
                                            <td>' . $row['created'] . '</td>
                                            <td>' . $status . '</td>
                                             
                                        </tr>';
        }

        $table .= ' </tbody>
                                </table>';
        return $table;
    }


    function transferHistory()
    {
        global $db, $userKey;

        $table = '<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                             <th>Transaction No</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>';
        $i = 1;
        $amt = 0;
        $sql = $db->query("SELECT * FROM transfer WHERE id = '$userKey' OR id2 = '$userKey' ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($sql)) {
            $e = $i++;
            $amt += ($row['id'] == $userKey) ? $row['amount'] : 0;
            $type = ($row['id'] == $userKey) ? 'Debit' : 'Credit';
            $des = ($row['id'] == $userKey) ? 'Transfer to ' . $this->uName($row['id2']) : 'Received from ' . $this->uName($row['id']);
            //$sender = ($row['id']==$userKey) ? $this->uName($row['id2']) : $this->uName($row['id']);

            $table .= ' <tr>
                                            <td>' . $e . '</td>
                                            <td>' . $row['tno'] . '</td>
                                            <td>$' . $row['amount'] . '</td>
                                          
                                            <td>' . $type . '</td>
                                            <td>' . $des . '</td>
                                             <td>' . $this->uName($row['id']) . '</td>
                                              <td>' . $this->uName($row['id2']) . '</td>
                                            <td>' . $row['created'] . '</td>
                                             
                                        </tr>';
        }

        $table .= ' </tbody>
                                </table>';
        return $table;
    }


    /*
function fileDownload(){
            global $db,$userKey;

            $table = '<table  class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                             <th>Code</th>
                                             <th>Course</th>
                                            <th>File</th>
                                            <th>Date</th>
                                             <th>Download</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>';
$i=1;   $amt = 0;
            $sql=$db->query("SELECT * FROM download WHERE id = '$userKey' " )or die(mysqli_error());
            while($row = mysqli_fetch_assoc($sql)){ $e=$i++; 
            $amt += ($row['id']==$userKey) ? $row['amount'] : 0;
            $type = ($row['id']==$userKey) ? 'Debit' : 'Credit';
            
            
                $table .= ' <tr>
                                            <td>'.$e.'</td>
                                            <td>'.$row['tno'].'</td>
                                            <td></td>
                                          
                                            <td>my-course-material.pdf</td>
                                             <td>'.$row['created'].'</td>
                                             
                                            <td><button onclick="document.getElementById('link').click()">Download Now!</button>
<a id="link" href="treant/opt'.$row['course'].'.pdf" download="my-course-material.pdf" hidden></a></td>
                                             
                                        </tr>';
            }

            $table .= ' </tbody>
                                </table>';  
            return $table;  
            }
*/

    function transferHistoryAdmin()
    {
        global $db, $userKey;

        $table = '<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                             <th>Transaction No</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>';
        $i = 1;
        $amt = 0;
        if (isset($_GET['quser'])) {
            $quser = $this->uNameUser($_GET['quser'], 'id');
            $sql = $db->query("SELECT * FROM transfer WHERE id = '$quser' OR id2 = '$quser' ORDER BY sn DESC  ") or die(mysqli_error());
        } else {
            $sql = $db->query("SELECT * FROM transfer ORDER BY sn DESC LIMIT 100 ") or die(mysqli_error());
        }
        while ($row = mysqli_fetch_assoc($sql)) {
            $e = $i++;
            $amt += ($row['id'] == $userKey) ? $row['amount'] : 0;
            $type = ($row['id'] == $userKey) ? 'Debit' : 'Credit';
            //$sender = ($row['id']==$userKey) ? $this->uName($row['id2']) : $this->uName($row['id']);

            $table .= ' <tr>
                                            <td>' . $e . '</td>
                                            <td>' . $row['tno'] . '</td>
                                            <td>$' . $row['amount'] . '</td>
                                          
                                            <td>' . $type . '</td>
                                             <td><a href="?quser=' . $this->uName($row['id']) . '">' . $this->uName($row['id']) . '</a></td>
                                              <td><a href="?quser=' . $this->uName($row['id2']) . '">' . $this->uName($row['id2']) . '</a></td>
                                            <td>' . $row['created'] . '</td>
                                             
                                        </tr>';
        }

        $table .= ' </tbody>
                                </table>';
        return $table;
    }


    function transfered($opt = 1)
    {
        global $db, $userKey;
        $amt = 0;
        $amt2 = 0;
        $sql = $db->query("SELECT * FROM transfer WHERE id = '$userKey' OR id2 = '$userKey' ") or die(mysqli_error());
        while ($row = mysqli_fetch_assoc($sql)) {
            $amt += ($row['id'] == $userKey) ? $row['amount'] : 0;
            $amt2 += ($row['id2'] == $userKey) ? $row['amount'] : 0;
        }
        $sum = ($opt == 1) ? $amt : $amt2;
        return $sum;
    }

function refEarn($id){

    return $this->wallet($id,9);
}

function matEarn($id){

    return $this->walletRange($id,10,14);
}

function salesEarn($id){

    return $this->walletRange($id,21,23);
}
function totalEarn($id){

    return $this->refEarn($id)+$this->matEarn($id)+$this->salesEarn($id);
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
    global $db;
    $amt =0;
    $sql = $db->query("SELECT * FROM newsales WHERE id='$id' AND amount>0  ");
    while($row = mysqli_fetch_assoc($sql)){
        $amt += $row['amount'] ;
    }
        
        return $amt; 
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
        $amt = $row['value_sum'];
   
        return abs($amt);
    }
    function walletRange($id,$r1,$r2)
    {
        global $db;
        $amt = 0;
        $sql =  $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND status=5 AND type BETWEEN $r1 AND $r2 ") ;
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return abs($amt);
    }    

    function walletPending($id,$r1,$r2)
    {
        global $db;
        $amt = 0;
        $sql =  $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND status<5 AND type BETWEEN $r1 AND $r2 ") ;
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return abs($amt);
    }

        function wallet2($id,$opt=0)
    {
        global $db;
        $amt = 0;
        $sql = ($opt==0) ? $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' ") : $db->query("SELECT SUM(cos) AS value_sum FROM ewalletx WHERE id = '$id' AND type='$opt' ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return abs($amt);
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
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM wallet WHERE id = '$id' AND type>=6 ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return abs($amt);
    }

    function walletPendingW($id)
    {
        global $db;
        $amt = 0;
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM wallet WHERE id = '$id' AND type=1 AND status<9 ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return abs($amt);
    }

    function orderPending($id)
    {
        global $db;
        //$amt = 0;
        $sql = $db->query("SELECT * FROM walletorder WHERE id = '$id' AND status<9 ");
       //$row = mysqli_fetch_assoc($sql);
        
       return mysqli_num_rows($sql);
    }

    function walletdebit($id)
    {
        global $db;
        $amt = 0;
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM wallet WHERE id = '$id' AND type<=5 ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return abs($amt);
    }

    function walletearning($id)
    {
        global $db;
        $amt = 0;
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM wallet WHERE id = '$id' AND type >= 9 ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return abs($amt);
    }

    function walletmatrix($id)
    {
        global $db;
        $amt = 0;
        $sql = $db->query("SELECT SUM(cos) AS value_sum FROM wallet WHERE id = '$id' AND type > 10 ");
        $row = mysqli_fetch_assoc($sql);
        $amt = $row['value_sum'];
   
        return abs($amt);
    }


    function walletStatus($status)
    {
        if($status==5){$r='<font color="green"> Complete</font>'; }
        elseif($status==1 OR $status==0){$r='<font color="red">Awaiting Confirmation</font>'; }
        elseif($status==2){$r='<font color="blue"> Processing...</font>'; }
        elseif($status==3){$r='<font color="#036">Ready for Pick-up</font>'; }
        elseif($status==4){$r='<font color="red">Troubleshooting</font>'; }
        else{$r='Pending';}
   
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
        $userKey = $this->Uid();
        $ctime = time();
        $sin = $this->wallet($id);
        $amt = ($type>5) ? $amt : '-'.$amt;

        $tan = $sin+$amt;
        $trno = $this->win_hash(11);
       // $opt = $opt=='' ? $trno : $opt;
         if(empty($id) OR $id=='' OR $id=='0'){}else{
        $sql = $db->query("INSERT INTO ewalletx (id,trno,sin,cos,tan,type,status,remark,ctime,rep,opt) VALUES ('$id','$trno','$sin','$amt','$tan','$type','$status','$remark','$ctime','$userKey','$opt') ");  
        if($sql){$report = 'Transaction successfully processed'; }
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
        global $db,$userKey,$report;
        $ctime = time();
        $amount = sanitize($_POST['amount']);
        $date = sanitize($_POST['date']);
        $ref = sanitize($_POST['ref']);
        $type = $_POST['type'];

        
        $trno = $this->win_hash(8);
        $sql = $db->query("INSERT INTO walletorder (id,trno,amount,date,ref,ctime,type) VALUES ('$userKey','$trno','$amount','$date','$ref','$ctime','$type') ");   
if($sql){
        $report = 'Payment information submitted';
    }
        return;
    }


        function AdminFundWalletIni(){

$amount = $_POST['amount'];
$id = $_SESSION['SearchClient'];
$ref = $this->win_hash(8);
$this->walletProcess($id,$amount,1,16,'Wallet Funding by Admin',$ref); 
return;
    }


function processPay(){

 //if (isset($_GET['txref'])) {
    $id = $this->Uid();

        $ref = $_GET['txref'];
         // $profile->fundWalletWithOnlineCard($ref);//change this position later
        $amount = $_SESSION['amount']; //Correct Amount from Server
        $currency = "NGN"; //Correct Currency from Server

        $query = array(
            "SECKEY" => "FLWSECK-5e4477aeb49fa7d847ef573f27ffcff0-X",  //test keys
            "txref" => $ref
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/v2/verify');                                                                      
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
            
            if($_SESSION['amount']==2500 AND $_SESSION['paytype']==3){
            $sponsor = userName($id,'sponsor');
            $sponsorid = $this->userToId($sponsor);
      if($this->matExist($id)==FALSE){  $this->RegisterWithCard($id,$sponsorid);  }
       header("location: updateprofile.php");
            }
            elseif($this->successPayCard($_SESSION['ref'])==FALSE){
            $this->walletProcess($id,$_SESSION['amount'],5,18,'Card Wallet Funding',$_SESSION['ref']); 
            header("location: fundaccount.php"); }
        } else {
           header("location: index.php"); //Dont Give Value and return to Failure page
        }
   
        
return;
}


function successPayCard($opt){
    global $db;
$id = $this->Uid();

    $sql = $db->query("SELECT * FROM ewalletx WHERE id='$id' AND opt='$opt' ");
 if(mysqli_num_rows($sql)==0){ $res=FALSE;    }else{ $res=TRUE;}
    return $res;
}


    function invTotalInt()
    {
        global $db, $userKey;
        $status = STATUSALPHA;
        $amt = 0;
        $sql = $db->query("SELECT * FROM invacc WHERE userid='$userKey' AND status='$status' ");
        while ($row = mysqli_fetch_assoc($sql)) {

            $age = $this->accAge($row['accno'], 1);
            $interest = $age * $row['roi'];

            $amt = $amt + $interest;
        }
        return $amt;
    }


//from investment//
    function accAge($accountno, $type = '')
    {
        global $db, $userKey;
        $sql = $db->query("SELECT * FROM invacc WHERE accno='$accountno' ");
        $row = mysqli_fetch_assoc($sql);
        if ($row['tan'] > 0) {
            $diff = CTIME - $row['tan'];
            $age = $diff / (86400);
            $weeks = (int)($age / 7);
            if ($age <= 280) {
                $percent = number_format((100 * $age / 280), 1) . '%';
            }

            if ($type == 1) {
                return $weeks;
            } elseif ($diff < 3600) {
            } elseif ($diff > 3600 && $age < 1) {
                return (int)($diff / 3600) . ' hours';
            } elseif ($age < 7) {
                return (int)$age . ' days<br>' . $percent;
            } elseif ($age > 7) {
                return (int)($age / 7) . ' weeks<br>' . $percent;
            } //elseif($age>=30){return (int)($age/30).' months<br>'.$percent;}


            else {
                return;
            }
        }


    }


  

    function adminLevel()
    {
        $xy=$this->userName4('sn');
        if ($xy == 1 OR $xy == 23)  {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    function wildUserName($key, $col = '')
    {
        global $db;

        $que = $db->query("select * FROM user WHERE sn = '$key' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        if (!empty($col)) {
            return $ro[$col];
        } else {
            return htmlspecialchars($ro['surname'] . ' ' . $ro['othername']);
        }
    }

    function wildUserKeys($key, $col = '')
    {
        global $db;

        $que = $db->query("select * FROM user WHERE id = '$key' ") or die(mysqli_error());
        $ro = mysqli_fetch_array($que);
        if (!empty($col)) {
            return $ro[$col];
        } else {
            return htmlspecialchars($ro['surname'] . ' ' . $ro['othername']);
        }
    }


    function userProfileData($a)
    {
        global $db;
        $id = '';
        $sql = $db->query("SELECT * FROM user WHERE id = '$id' ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);

        $data = ' <div class="col-md-4 col-xs-12">
                         <div class="box bg-white">
                            <div class="box-block">

                            <img width="100%" alt="user" src="photo/' . $row['photo'] . '">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)">
                                        <img src="photo/' . $row['photo'] . '" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white">' . $row['surname'] . ' ' . $row['othername'] . '</h4>
                                        <h5 class="text-white">' . $row['email'] . '</h5> </div>
                                </div>
                            </div>

                             <hr>
                               
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 col-xs-6">

                                    <strong>Sponsor</strong>
                                        <p>' . $this->wildUserName($row['sponsor']) . '</p>
                                    </div>
                                    <div class="col-md-6 col-xs-6"><strong>Upline</strong>
                                        <p>' . $this->wildUserName($row['a1']) . '</p>
                                    </div>
                                </div>
                                <!-- /.row -->

                            

                            
                        </div>
                    </div>';

        $data2 = '<div class="col-md-8 col-xs-12">
                        <div class="box bg-white">
                         <div class="box-block">
                            <!-- .tabs -->
                            <ul class="nav nav-tabs tabs customtab">


                                <li class="active tab col-md-6">
                                    <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Profile</span> </a>
                                </li>
                                <li class="tab col-md-6">
                                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Edit Profile</span> </a>
                                </li>
                            </ul>
                            <!-- /.tabs -->
                            <div class="tab-content">
                               
                                <!-- .tabs2 -->
                                <div class="tab-pane active" id="profile">
                                    
                                    <h6 class="m-t-30">Profile Information</h6>
                                   <hr>
                                 
                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Phone Number</div>
                                    <div class="col-md-7 col-xs-12">' . $row['phone'] . '</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Gender</div>
                                    <div class="col-md-7 col-xs-12">' . $row['sex'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Birthday</div>
                                    <div class="col-md-7 col-xs-12">' . $row['dob'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Residential Address</div>
                                    <div class="col-md-7 col-xs-12">' . $row['address'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">City/State</div>
                                    <div class="col-md-7 col-xs-12">' . $row['city'] . ', ' . $row['state'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Office Address</div>
                                    <div class="col-md-7 col-xs-12">' . $row['officeaddress'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-12 col-xs-12"><h6 class="m-t-30">Bank Account Details</h6></div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Bank Name</div>
                                    <div class="col-md-7 col-xs-12">' . $row['bank'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Account Nunmber</div>
                                    <div class="col-md-7 col-xs-12">' . $row['accountno'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Account Name</div>
                                    <div class="col-md-7 col-xs-12">' . $row['accname'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-12 col-xs-12"><h6 class="m-t-30">Referral Information</h6></div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Referral ID</div>
                                    <div class="col-md-7 col-xs-12">' . $row['user'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Referral Link</div>
                                    <div class="col-md-7 col-xs-12">https://gleeglobal.com/signup.php?ref=' . $row['user'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Share on WhatsApp<br><br></div>
                                    <div class="col-md-7 col-xs-12"><a href="whatsapp://send?text=It\'s all about financial empowerment. We can make you smile because we care. Join us now at @    
https://gleeglobal.com/signup.php?ref=' . $row['user'] . '" data-action="share/whatsapp/share" class="btn btn-success">Share on WhatsApp</a></div>
                                    </div>
                                    <hr>

                                </div>
                                <!-- /.tabs2 -->
                                <!-- .tabs3 -->
                                <div class="tab-pane" id="settings">
                                 <form method="post" class="form-horizontal">
                                        <h5 class="m-t-30">Update Profile</h5>
                                    <hr>
                                       
                                        
                                        <div class="form-group">
                                            <label class="col-md-12">Phone Number</label>
                                            <div class="col-md-12">
                                                <input type="text" name="phone" class="form-control" value="' . $row['phone'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Residential Address</label>
                                            <div class="col-md-12">
                                                <input type="text" name="address" class="form-control" value="' . $row['address'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">State</label>
                                            <div class="col-md-12">
                                                <input type="text" name="state" class="form-control" value="' . $row['state'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">City</label>
                                            <div class="col-md-12">
                                                <input type="text" name="city" class="form-control" value="' . $row['city'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Bank</label>
                                            <div class="col-md-12">
                                                <input type="text" name="bank" class="form-control" value="' . $row['bank'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Account Number</label>
                                            <div class="col-md-12">
                                                <input type="text" name="accountno" class="form-control" value="' . $row['accountno'] . '"> </div>
                                        </div>
                                      

                                         <div class="form-group">
                                           <label class="col-md-12"></label>
                                            <div class="col-md-12">
                                                <button type="submit" name="UpdateUser" class="btn btn-success">Save Update</button>
                                            </div>
                                    </form>
                                    </div>


                                    <form method="post" class="form-horizontal">
                                        <h5 class="m-t-30">Password Reset</h5>
                                    <hr>
                                        <div class="form-group">
                                            <label class="col-md-12">Old Password</label>
                                            <div class="col-md-12">
                                                <input type="password" placeholder="" name="currentpass" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">New Password</label>
                                            <div class="col-md-12">
                                                <input type="password" placeholder="" class="form-control" name="newpass" id="example-email"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Confirm Password</label>
                                            <div class="col-md-12">
                                                <input type="password" name="newpass2" class="form-control"> </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" name="changePassword" class="btn btn-success">Reset Password</button>
                                            </div>
                                        </div>

                                       
                                    </form>

                                     <h5 class="m-t-30">Update Profile Passport Photograph</h5>
                                    <hr>
                                    <form method="post"  enctype="multipart/form-data">
                                    <div class="row">
                    <div class="col-sm-6 ol-md-6 col-xs-12">
                      
                          
                            <label for="input-file-max-fs">Maximum Size is 200kb</label>
                            <input type="file" name="image" id="input-file-max-fs" class="dropify" data-max-file-size="200K" required /> </div>
                    </div>
                
                 <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="updatePhoto">Update Photograph</button>
                                            </div>
                                        </div>


                                </div>
                                </form>
                                <!-- /.tabs3 -->
                            </div>
                        </div>
                    </div>';
        return $$a;
    }


    function userProfileDataSearch($keys, $a)
    {
        global $db;

        $sql = $db->query("SELECT * FROM user WHERE sn = '$keys' ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($sql);

        $activate = ($row['status'] == 1) ? '<button class="btn btn-danger" name="DeactivateUser" value="' . $row['id'] . '">Deactivate ' . ucwords($row['surname'] . ' ' . $row['othername']) . '</button>' : '<button class="btn btn-success" name="DeactivateUser" value="' . $row['id'] . '">Activate ' . ucwords($row['surname'] . ' ' . $row['othername']) . '</button>';

        $updatepin = ($this->pinMultiple($row['user']) > 1) ? '<br><br><br><br>
                       <p>UPDATE USER PIN</p><hr class="p-0">
                        <p>PIN <input type="text" name="pin" class="form-control" value="' . $row['pin'] . '"></p><p><br><button class="btn btn-primary" name="UpdatePin" value="' . $row['id'] . '">Update PIN for ' . ucwords($row['surname'] . ' ' . $row['othername']) . '</button></p><p><br></p>' . $this->pinMultiple2($row['user']) : '';

        $data = '        <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" alt="user" src="photo/' . $row['photo'] . '">
                               
                                    <div class="user-content text-center">
                                        
                                        <b><br>' . ucwords($row['surname'] . ' ' . $row['othername']) . '</b>
                                        <h5 class="">' . $row['email'] . '</h5> </div>
                               
                            </div>

                             <hr>
                               
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 col-xs-6 b-r"><strong>Sponsor</strong>
                                        <p>' . $this->wildUserName($row['sponsor']) . '</p>
                                    </div>
                                    <div class="col-md-6 col-xs-6"><strong>Upline</strong>
                                        <p>' . $this->wildUserName($row['a1']) . '</p>
                                    </div>
                                </div>
                                <!-- /.row -->

                      

                            
                        </div>  
                        <b>SEND MESSAGE TO USER<br></b>
                        <form method="post">
                        <p><br>Message Title: <input class="form-control"  name="subject"></p>
                        <p><br>Message: <textarea class="form-control" rows="10" name="msg"></textarea></p>
                        <p><br><button class="btn btn-primary pull-right" name="SendUserMessage" value="' . $row['id'] . '">Send Message to ' . ucwords($row['surname'] . ' ' . $row['othername']) . '</button></p></form>


                        <form method="post">
                       <br><br><br><br><br>
                       <p>DEACTIVATE/ACTIVATE USER</p><hr class="p-0">
                        <p><br>' . $activate . '</p></form>

                        <form method="post">
                       ' . $updatepin . '</form>

                    </div>';


        $data2 = '<div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <!-- .tabs -->
                            <ul class="nav nav-tabs tabs customtab">
                                
                                <li class="active tab">
                                    <a href="#profile" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span> </a>
                                </li>
                                <li class="tab">
                                    <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Edit Profile</span> </a>
                                </li>
                            </ul>
                            <!-- /.tabs -->
                            <div class="tab-content">
                               
                                <!-- .tabs2 -->
                                <div class="tab-pane active" id="profile">
                                    
                                    <h6 class="m-t-30">Profile Information</h6>
                                   <hr>
                                 
                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Phone Number</div>
                                    <div class="col-md-7 col-xs-12">' . $row['phone'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Gender</div>
                                    <div class="col-md-7 col-xs-12">' . $row['sex'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Birthday</div>
                                    <div class="col-md-7 col-xs-12">' . $row['dob'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Residential Address</div>
                                    <div class="col-md-7 col-xs-12">' . $row['address'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">City/State</div>
                                    <div class="col-md-7 col-xs-12">' . $row['city'] . ', ' . $row['state'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Office Address</div>
                                    <div class="col-md-7 col-xs-12">' . $row['officeaddress'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-12 col-xs-12"><h6 class="m-t-30">Bank Account Details</h6></div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Bank Name</div>
                                    <div class="col-md-7 col-xs-12">' . $row['bank'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Account Nunmber</div>
                                    <div class="col-md-7 col-xs-12">' . $row['accountno'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Account Name</div>
                                    <div class="col-md-7 col-xs-12">' . $row['accname'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-12 col-xs-12"><h6 class="m-t-30">Referral Information</h6></div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Referral ID</div>
                                    <div class="col-md-7 col-xs-12">' . $row['user'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Referral Link</div>
                                    <div class="col-md-7 col-xs-12">https://gleeglobal.com/signup.php?ref=' . $row['user'] . '</div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                    <div class="col-md-5 col-xs-12 font-12">Share on WhatsApp<br><br></div>
                                    <div class="col-md-7 col-xs-12"><a href="whatsapp://send?text=It\'s all about financial empowerment. We can make you smile because we care. Join us now at @    
https://gleeglobal.com/signup.php?ref=' . $row['user'] . '" data-action="share/whatsapp/share" class="btn btn-success">Share on WhatsApp</a></div>
                                    </div>
                                    <hr>

                                </div>
                                <!-- /.tabs2 -->
                                <!-- .tabs3 -->
                                <div class="tab-pane" id="settings">

                                    <form method="post" class="form-horizontal">
                                        <h5 class="m-t-30">Update Profile</h5>
                                    <hr>
                                        <div class="form-group">
                                            <label class="col-md-12">Other Names</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="" name="othername" class="form-control" value="' . $row['othername'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">Email</label>
                                            <div class="col-md-12">
                                                <input type="text" placeholder="" class="form-control" name="email" value="' . $row['email'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Phone Number</label>
                                            <div class="col-md-12">
                                                <input type="text" name="phone" class="form-control" value="' . $row['phone'] . '"> </div>
                                        </div>
<div class="form-group">
                                            <label class="col-md-12">Residential Address</label>
                                            <div class="col-md-12">
                                                <input type="text" name="address" class="form-control" value="' . $row['address'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">State</label>
                                            <div class="col-md-12">
                                                <input type="text" name="state" class="form-control" value="' . $row['state'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">City</label>
                                            <div class="col-md-12">
                                                <input type="text" name="city" class="form-control" value="' . $row['city'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Bank</label>
                                            <div class="col-md-12">
                                                <input type="text" name="bank" class="form-control" value="' . $row['bank'] . '"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Account Number</label>
                                            <div class="col-md-12">
                                                <input type="text" name="accountno" class="form-control" value="' . $row['accountno'] . '"> </div>
                                        </div>
                                      

                                         <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" name="UpdateUser2" class="btn btn-success">Save Update</button>
                                            </div>
                                        </div>

                                       
                                    </form>


                                    <form method="post" class="form-horizontal">
                                        <h5 class="m-t-30">Password Reset</h5>
                                    <hr>
                                        <div class="form-group">
                                            <label class="col-md-12">Admin Password</label>
                                            <div class="col-md-12">
                                                <input type="password" placeholder="" name="currentpass" class="form-control"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">New Password</label>
                                            <div class="col-md-12">
                                                <input type="password" placeholder="" class="form-control" name="newpass" id="example-email"> </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Confirm Password</label>
                                            <div class="col-md-12">
                                                <input type="password" name="newpass2" class="form-control"> </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="col-sm-12">
                                                <button type="submit" name="changePassword2" class="btn btn-success">Reset Password</button>
                                            </div>
                                        </div>

                                       
                                    </form>



                                     <h5 class="m-t-30">Update Profile Passport Photograph</h5>
                                    <hr>
                                    <form method="post"  enctype="multipart/form-data">
                                    <div class="row">
                    <div class="col-sm-6 ol-md-6 col-xs-12">
                      
                          
                            <label for="input-file-max-fs">Maximum Size is 200kb</label>
                            <input type="file" name="image" id="input-file-max-fs" class="dropify" data-max-file-size="200K" required /> </div>
                    </div>
                
                 <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="updatePhoto2">Update Photograph</button>
                                            </div>
                                        </div>


                                </div>
                                </form>
                                <!-- /.tabs3 -->
                            </div>
                        </div>
                        </div>
                    </div>';
        return $$a;
    }
    function covisSearchTree3($stage)
    {
        global $db;
        $userkey = isset($_SESSION['searchid'])?$_SESSION['searchid']:$_SESSION['user_idx'];

        $randomKey = $this->idToKey($userkey);
        $key = $randomKey;


        $code = 'chart_config = [
        config, a' . $randomKey . ', ';

        $tree = 'var config = {
        container: "#basic-example",
        nodeAlign: "BOTTOM",
        connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
        $tree .= 'a' . $randomKey . ' = {
        text: {
            name: "' . $this->idToKey($userkey, 'user') . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },

        image: "../headshots/'.$this->stageImage($stage).'"
    },';
        $i=1;
        $n = $randomKey . ',';
        $sql = $db->query("SELECT * FROM user WHERE (a1='$key' OR a2='$key' OR a3='$key' OR a4='$key' OR a5='$key' OR a6='$key' OR a7='$key' OR a8='$key') AND level>=2 ");
        while ($row = mysqli_fetch_assoc($sql) AND $i<=12){ $e=$i++;
          if($this->stageCalc($row['sn'])>=$stage){
            $n .= $row['sn'] . ','; }
        }
        $h = explode(',', $n);
        $s = count($h) - 1;
        $i = 1;
        while ($i < $s) {
            $e = $i++;
            $par = ceil($e / 3) - 1;
            $code .= 'a' . $h[$e] . ', ';
            $tree .= 'a' . $h[$e] . ' = {
        parent: a' . $h[$par] . ',
        text:{
            name: "' . $this->wildUserName($h[$e], 'user') . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },

        image: "../headshots/'.$this->stageImage($stage).'"
    }, ';

        }


        $code .= '];';

        return $tree . $code;
    }
    function covisSearchTree()
    {
        global $db;
        $key = isset($_SESSION['searchid'])?$_SESSION['searchid']:$_SESSION['user_idx'];

        $randomKey = $this->idToKey($key);


        $code = 'chart_config = [
        config, a' . $randomKey . ', ';

        $tree = 'var config = {
        container: "#basic-example",
        nodeAlign: "BOTTOM",
        connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
        $tree .= 'a' . $randomKey . ' = {
        text: {
            name: "' . $this->idToKey($key, 'user') . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },

        image: "../headshots/st11.png"
    },';


        $sql = $db->query("SELECT * FROM user WHERE a1='$randomKey' OR a2='$randomKey' ");
        while ($row = mysqli_fetch_assoc($sql)) {

            $code .= 'a' . $row['sn'] . ', ';
            $tree .= 'a' . $row['sn'] . ' = {
        parent: a' . $row['a1'] . ',
        text:{
            name: "' . $this->wildUserName($row['sn'], 'user') . '",
            title: "",
            contact: "",
        },
        link: {
            href: "?u-ref='.sha1($row['sn']).'&st=1"
        },

        image: "../headshots/st1.png"
    }, ';

        }


        $code .= '];';

        return $tree . $code;
    }

    function Uid()
    {
        $uid = isset($_SESSION['user_idx']) ? $_SESSION['user_idx'] : 0;
        return $uid;
    }


    function covisTree()
    {
        global $db;
        $key = $_SESSION['user_idx'];

        $randomKey = $this->idToKey($key);
        $img = $this->idToKey($key, 'sex')=='Male' ? 'm.png' : 'f.png';

        $code = 'chart_config = [
        config, a' . $randomKey . ', ';

        $tree = 'var config = {
        container: "#basic-example",
        nodeAlign: "BOTTOM",
        connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
        $tree .= 'a' . $randomKey . ' = {
        text: {
            name: "' . strtoupper($this->idToKey($key, 'user')) . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },

        image: "../headshots/'.$img.'"
    },';


        $sql = $db->query("SELECT * FROM user WHERE a1='$randomKey' ");
$i=1;
        $num = 3-mysqli_num_rows($sql);
        while ($row = mysqli_fetch_assoc($sql)) {
            $img = $row['sex']=='Male' ? 'm.png' : 'f.png';
            $random = $row['sn'];
            $code .= 'a' . $row['sn'] . ', ';
            $tree .= 'a' . $row['sn'] . ' = {
        parent: a' . $row['a1'] . ',
        text:{
            name: "' . strtoupper($this->wildUserName($row['sn'], 'user')) . '",
            title: "",
            contact: "",
        },
        link: {
            href: "?user='.sha1($row['sn']).'"
        },

        image: "../headshots/'.$img.'"
    }, ';




    $sq = $db->query("SELECT * FROM user WHERE a1='$random' ");
$a=1;
        $nu = 3-mysqli_num_rows($sq);
        while ($ro = mysqli_fetch_assoc($sq)) {
            $img = $ro['sex']=='Male' ? 'm.png' : 'f.png';
            $code .= 'a' . $ro['sn'] . ', ';
            $tree .= 'a' . $ro['sn'] . ' = {
        parent: a' . $ro['a1'] . ',
        text:{
            name: "' . strtoupper($this->wildUserName($ro['sn'], 'user')) . '",
            title: "",
            contact: "",
        },
        link: {
            href: "?user='.sha1($ro['sn']).'"
        },

        image: "../headshots/'.$img.'"
    }, ';

        }

        while ($a <= $nu) { $b=$a++;
            $img = 'uses.png';
            $code .= 'a' .$b. $random . ', ';
            $tree .= 'a' .$b. $random . ' = {
        parent: a' . $random . ',
        text:{
            name: "ADD NEW",
            title: "",
            contact: "",
        },
        link: {
            href: "newmember.php?upline='.sha1($random).'"
        },

        image: "../headshots/'.$img.'"
    }, ';

        }

        }

        while ($i <= $num) { $e=$i++;
            $img = 'uses.png';
            $code .= 'a' .$e. $randomKey . ', ';
            $tree .= 'a' .$e. $randomKey . ' = {
        parent: a' . $randomKey . ',
        text:{
            name: "ADD NEW",
            title: "",
            contact: "",
        },
        link: {
            href: "newmember.php?upline='.sha1($randomKey).'"
        },

        image: "../headshots/'.$img.'"
    }, ';

        }


        $code .= '];';

        return $tree . $code;
    }





    function stageImage($stage){
        $img = '';
        if($stage == 2){$img = "s2.jpg";}
        elseif($stage == 3){$img = "s3.png";}
         elseif($stage == 4){$img = "s4.png";} 
         elseif($stage == 5){$img = "s5.png";}
         elseif($stage == 6){$img = "s6.png";} 
         elseif($stage == 7){$img = "s7.png";}
         else{$img = "s8.png";}  

         return $img;
    }

function stageToEvenLevel($stage){
        $even=2;
        if($stage==2){$even=2;}
    elseif($stage==3){$even=4;}
    elseif($stage==4){$even=6;}
    elseif($stage==5){$even=8;}
    elseif($stage==6){$even=10;}
    elseif($stage==7){$even=12;}
    return $even;
}


function covisTree3s($stage)
    {
        global $db;
        $userkey = $_SESSION['user_idx'];

        $randomKey = $this->idToKey($userkey);
        $key = $randomKey;
        $e=0;
        $i=1;
        $n = $randomKey . ',';
        $even = $this->stageToEvenLevel($stage);
        $sql = $db->query("SELECT * FROM user WHERE (a1='$key' OR a2='$key' OR a3='$key' OR a4='$key' OR a5='$key' OR a6='$key' OR a7='$key' OR a8='$key') AND level>='$even' ");
        while ($row = mysqli_fetch_assoc($sql) AND $i<=12){ $e=$i++;
         // if($this->stageCalc($row['sn'])>=$stage){
            $n .= $row['sn'] . ','; 
            //}
        }
        $sq = $db->query("SELECT * FROM user WHERE a1='$key' OR a2='$key' ");
        if(mysqli_num_rows($sq)<12){$e=mysqli_num_rows($sq);}

        return $e;
    }
    function covisTree3($stage)
    {
        global $db;
        $userkey = $_SESSION['user_idx'];

        $randomKey = $this->idToKey($userkey);
        $key = $randomKey;


        $code = 'chart_config = [
        config, a' . $randomKey . ', ';

        $tree = 'var config = {
        container: "#basic-example",
        nodeAlign: "BOTTOM",
        connectors: {
            type: "step"
        },
        node: {
            HTMLclass: "nodeExample1"
        }
    },';
        $tree .= 'a' . $randomKey . ' = {
        text: {
            name: "' . strtoupper($this->idToKey($userkey, 'user')) . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },

        image: "../headshots/'.$this->stageImage($stage).'"
    },';
        $i=1;
        $n = $randomKey . ',';
        $even = $this->stageToEvenLevel($stage);
        $sql = $db->query("SELECT * FROM user WHERE (a1='$key' OR a2='$key' OR a3='$key' OR a4='$key' OR a5='$key' OR a6='$key' OR a7='$key' OR a8='$key') AND level>='$even' ");
        while ($row = mysqli_fetch_assoc($sql) AND $i<=12){ $e=$i++;
         // if($this->stageCalc($row['sn'])>=$stage){
            $n .= $row['sn'] . ','; 
            //}
        }
        $h = explode(',', $n);
        $s = count($h) - 1;
        $i = 1;
        while ($i < $s) {
            $e = $i++;
            $par = ceil($e / 3) - 1;
            $code .= 'a' . $h[$e] . ', ';
            $tree .= 'a' . $h[$e] . ' = {
        parent: a' . $h[$par] . ',
        text:{
            name: "' . strtoupper($this->wildUserName($h[$e], 'user')) . '",
            title: "",
            contact: "",
        },
        link: {
            href: ""
        },

        image: "../headshots/'.$this->stageImage($stage).'"
    }, ';

        }


        $code .= '];';

        return $tree . $code;
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


}

$pro = new Profile;
$uid = $pro->Uid();

$uidx = $pro->idToKey($uid);
$uidy = $pro->idToUser($uid);


//end of Bonus Class
// $sq = $db->query("SELECT * FROM user WHERE level>1");
// while($row=mysqli_fetch_assoc($sq)){
// $glee->levelCreate($row['sn']);
// }

?>
