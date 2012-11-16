<?php
require("Toro.php");

class PasswordIndexHandler {
    function get() {
      echo "Hello, world";
    }
}

class PasswordNumberHandler {
    function get($numberOfCharacters) {
      echo "Hello, world: " . $numberOfCharacters;
    }
}

Toro::serve(array(
    "/" => "PasswordIndexHandler",
	"/:number/" => "PasswordNumberHandler"
));