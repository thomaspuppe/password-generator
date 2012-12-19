<?php
header("Pragma: no-cache");
header("Cache-Control: s-maxage=0, max-age=0, must-revalidate, no-cache");

require("Toro.php");
require("PasswordGenerator.php");

define('DEFAULT_LENGTH', 16);
define('NUMBER_OF_PASSWORDS', 25);

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
		
		echo '<div class="pw">';
		echo '<h3>With Special characters</h3><p class="pw">';
		$passwords = $passwordGenerator->getArrayOfComplicatedPasswords(NUMBER_OF_PASSWORDS);
		foreach($passwords as $password) {
			echo $password . '<br>';
		}
		echo '</p></div>';
		
		echo '<div class="pw">';
		echo '<h3>Characters and numbers</h3><p class="pw">';
		$passwords = $passwordGenerator->getArrayOfAlphanumericalPasswords(NUMBER_OF_PASSWORDS);
		foreach($passwords as $password) {
			echo $password . '<br>';
		}
		echo '</p></div>';
		
		echo '<div class="pw">';
		echo '<h3>Easy to remember (up to 10 chars)</h3><p class="pw">';
		$passwords = $passwordGenerator->getArrayOfMnemonicPasswords(NUMBER_OF_PASSWORDS);
		foreach($passwords as $password) {
			echo $password . '<br>';
		}
		echo '</p></div>';
		
		
		
		
    }
}

ToroHook::add("before_handler", function() {

	$ticks = '';
	for ($i=4;$i<=32;$i++) {
		$ticks.= '<li><a href="/'.$i.'/">'.$i.'</a></li>';
	}

	echo '<html><header><title>Password Maker: Generate Secure Passwords Easily. Long passwords, Unambiguous passwords, Mnemonic passwords.</title>
			<style type="text/css">
				body {
					margin-top: 20px;
					font-family: Helvetica, Arial, sans-serif;
					font-size: 15px;
					line-height: 24px;
				}
				.ruler, .ruler li {
					margin: 0;
					padding: 0;
					list-style: none;
					display: inline-block;
				}
				/* IE6-7 Fix */
				.ruler, .ruler li {
					*display: inline;
				}
				.ruler {
					background: lightYellow;
					box-shadow: 0 -1px 1em hsl(60, 60%, 84%) inset;
					border-radius: 2px;
					border: 1px solid #ccc;
					color: #ccc;
					margin: 0;
					height: 2.2em;
					padding-right: 1cm;
					white-space: nowrap;
				}
				.ruler a {
				display: block;
					padding-left: 37px;
					width: 1.5em;
					margin: .64em -1em -.64em;
					text-align: center;
					position: relative;
					text-shadow: 1px 1px hsl(60, 60%, 84%);
					cursor: pointer;
				}
				.ruler a:before {
					content: \'\';
					position: absolute;
					border-left: 1px solid #ccc;
					height: .5em;
					top: -.64em;
					right: 0.7em;
				}
				.ruler li.a {
					font-weight; bold;
				}
				.ruler a {
					color: #ccc;
					text-decoration: none;
				}
				.ruler a:hover {
					text-decoration: underline;
				}
				h1 {
					font-family: Georgia, serif;
					font-style: italic;
					font-size: 1.5em;
					width: 900px;
				}
				h1 span.q {
					color: grey;
				}
				p.intro {
					width: 900px;
				}
				div.pw {
					min-width: 400px;
					float: left;
				}
				h3 {
					font-family: Georgia, serif;
					font-size: 15px;
					
				}
				div.pw p.pw {
				
				}
			</style>
		</header><body>
		<!--ul class="ruler">'.$ticks.'</ul-->

		<h1><span class="q">&ldquo;I need a password!&rdquo;</span> &mdash; You`re welcome! I just generated some for you.</h1>
		
		<p class="intro"><strong>ineedapassword.com generates passwords for you. No form filling, no settings.</strong> Just 25 of each type. You can even use them for writing down and printing, there are <strong>no ambiguois characters</strong> like Zero and Oh or lowercase L and uppercase i. You can choose the length of your password via the URL and save it as a bookmark. Like this: <a href="http://ineedapassword.com/16/">http://ineedapassword.com/16/</a></p>
	
	</body>';
});

Toro::serve(array(
	"" => "PasswordHandler",
    "/" => "PasswordHandler",
	"/:number/" => "PasswordHandler",
	"/:number" => "PasswordHandler"
));

