<?php 
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_W8lnfiJDy2np4McRZ1R8dJHL006hjRSFyP');

//sanitize post array
$POST=filter_var_array($_POST,FILTER_SANITIZE_STRING);

$first_name=$POST['first_name'];
$last_name=$POST['last_name'];
$email=$POST['email'];
$token=$POST['stripeToken'];
echo $token;

//create customer in stripe
$customer=\Stripe\Customer::create(array(
	"email" => $email,
    "source" =>  $token
));

//charge customer
$charge=\Stripe\Charge::create(array(
	"amount"=>5000,
    "currency"=>"usd",
    "description"=>"It's just a TEST",
    "customer"=>$customer->id
));

//redirect to success
header('Location: success.php?tid='.$charge->id.'&product='.$charge->description);






 ?>