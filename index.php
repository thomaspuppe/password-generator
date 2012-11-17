<?php
require("Toro.php");
require("PasswordGenerator.php");

define('DEFAULT_LENGTH', 16);
define('NUMBER_OF_PASSWORDS', 50);

class PasswordHandler {
    function get($numberOfCharacters=null) {
	
		if ($numberOfCharacters==null) {
			$numberOfCharacters = DEFAULT_LENGTH;
		}
	
		$passwordGenerator = new PasswordGenerator($numberOfCharacters);
		
		echo '<div style="min-width:200px;float:left;">';
		$passwords = $passwordGenerator->getArrayOfComplicatedPasswords(NUMBER_OF_PASSWORDS);
		foreach($passwords as $password) {
			echo $password . '<br>';
		}
		echo '</div>';
		
		echo '<div style="min-width:200px;float:left;">';
		$passwords = $passwordGenerator->getArrayOfAlphanumericalPasswords(NUMBER_OF_PASSWORDS);
		foreach($passwords as $password) {
			echo $password . '<br>';
		}
		echo '</div>';
		
		echo '<div style="min-width:200px;float:left;">';
		$passwords = $passwordGenerator->getArrayOfMnemonicPasswords(NUMBER_OF_PASSWORDS);
		foreach($passwords as $password) {
			echo $password . '<br>';
		}
		echo '</div>';
		
		
		
		
    }
}

Toro::serve(array(
    "/" => "PasswordHandler",
	"/:number/" => "PasswordHandler",
	"/:number" => "PasswordHandler"
));