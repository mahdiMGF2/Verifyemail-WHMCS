<?php
if (!defined("WHMCS")){
die("Access to this file is not possible");
}
use Illuminate\Database\Capsule\Manager as Capsule;



add_hook("ShoppingCartValidateCheckout", 1, function($vars){
$Emailauthentication=Capsule::table('mod_Verifyemail')->where('id', '1')->value('Emailauthentication');
    if ($Emailauthentication=="on"){
        $client = Menu::context("client");
         if (!is_null($client) && $client) {
            if ($client->isEmailAddressVerified()==false)
            {
                return array("قبل از تکمیل  سفارش، ابتدا باید آدرس ایمیل خود را تأیید کنید");
            }
         }
    }
});
// Redirect the user if the email is not confirmed
add_hook("ClientAreaPage", 1, function($vars){
    $Userauthentication=Capsule::table('mod_Verifyemail')->where('id', '1')->value('Userauthentication'); 
    if ($Userauthentication=="on"){
    $client = Menu::context("client");
    if (!is_null($client) && $client) {
       if ($client->isEmailAddressVerified()==false)
       {
         $namepage = $vars['pagetitle'];
         if($namepage!="احراز هویت ایمیل"){
             header("Location: ./index.php?m=Verifyemail");
         }
    }
    }
}
 });