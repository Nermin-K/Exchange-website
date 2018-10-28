
<?php

function validateEmail ($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	else
		return false;
}


function validateFB ($fbAccount)
{
	$fbUrlCheck = '/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/';
	$secondCheck = '/home((\/)?\.[a-zA-Z0-9])?/';

	$validUrl = $fbAccount;

	if(preg_match($fbUrlCheck, $validUrl) == 1 && preg_match($secondCheck, $validUrl) == 0) {
		return true;
	} else {
		return false;
	}
}

function hasPresence($value){
	return (isset($value) && $value !=="");
}

function validatePresence ($required_fields , $errors){
	foreach($required_fields as $field){
		$value=trim($_POST[$field]);
		if(!hasPresence($value)){
			$errors[] = ($field) . " can't be blank";
		}
	}
	return $errors;
}
//length
function isMax ($value, $max){
	$value=trim($value);
	return strlen($value)<= $max;
}
	
?>
