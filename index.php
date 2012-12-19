<?php
header("Pragma: no-cache");
header("Cache-Control: s-maxage=0, max-age=0, must-revalidate, no-cache");

require("Toro.php");
require("PasswordGenerator.php");

define('DEFAULT_LENGTH', 16);
define('NUMBER_OF_PASSWORDS', 50);

class PasswordHandler {
    function get($numberOfCharacters=null) {
	
		if ($numberOfCharacters==null) {
			$numberOfCharacters = DEFAULT_LENGTH;
		}
		
		$numberOfCharacters = intval($numberOfCharacters);
		if ($numberOfCharacters<4) {
			$numberOfCharacters = 4;
		}
		if ($numberOfCharacters>32) {
			$numberOfCharacters = 32;
		}
	
		$passwordGenerator = new PasswordGenerator($numberOfCharacters);
		
		echo '<div style="min-width:400px;float:left;">';
		$passwords = $passwordGenerator->getArrayOfComplicatedPasswords(NUMBER_OF_PASSWORDS);
		foreach($passwords as $password) {
			echo $password . '<br>';
		}
		echo '</div>';
		
		echo '<div style="min-width:400px;float:left;">';
		$passwords = $passwordGenerator->getArrayOfAlphanumericalPasswords(NUMBER_OF_PASSWORDS);
		foreach($passwords as $password) {
			echo $password . '<br>';
		}
		echo '</div>';
		
		echo '<div style="min-width:400px;float:left;">';
		$passwords = $passwordGenerator->getArrayOfMnemonicPasswords(NUMBER_OF_PASSWORDS);
		foreach($passwords as $password) {
			echo $password . '<br>';
		}
		echo '</div>';
		
		
		
		
    }
}

ToroHook::add("before_handler", function() {
	echo '<html><header><title>generate secure passwords easily</title></header><body>
		<h2>I need a password.</h2>
		<h1>You`re welcome.</h1>
		<p>bla blubb</p>
	
	</body>';
});

Toro::serve(array(
	"" => "PasswordHandler",
    "/" => "PasswordHandler",
	"/:number/" => "PasswordHandler",
	"/:number" => "PasswordHandler"
));

