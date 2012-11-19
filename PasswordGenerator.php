<?php

class PasswordGenerator {

	private $passwordLength;
	
	private $POOL_OF_NUMBERS;
	private $POOL_OF_CHARACTERS_LC;
	private $POOL_OF_CHARACTERS_UC;
	private $POOL_OF_SPECIALCHARS;
	private $POOL_OF_VOCALS;
	private $POOL_OF_CONSONANTS;
	
	private $POOL_FOR_COMPLICATED;
	private $POOL_FOR_ALPHANUMERIC;

	public function __construct($passwordLength=16) {
	
		$this->passwordLength = $passwordLength;
	
		$this->POOL_OF_NUMBERS = array(2, 3, 4, 5, 6 , 7, 8, 9);
		$this->POOL_OF_CHARACTERS_LC = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
		$this->POOL_OF_CHARACTERS_UC = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
		$this->POOL_OF_SPECIALCHARS = array('#', '&', '@', '$', '_', '%', '?', '+', '-', '!', '=', ':', ';');
		
		$this->POOL_OF_VOCALS = array ('a', 'e', 'i', 'o', 'u', 'y');
		$this->POOL_OF_CONSONANTS = array ('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'z');
		
		$this->POOL_FOR_COMPLICATED = array_merge($this->POOL_OF_NUMBERS, $this->POOL_OF_CHARACTERS_LC, $this->POOL_OF_CHARACTERS_UC, $this->POOL_OF_SPECIALCHARS);
		$this->POOL_FOR_ALPHANUMERIC = array_merge($this->POOL_OF_NUMBERS, $this->POOL_OF_CHARACTERS_LC, $this->POOL_OF_CHARACTERS_UC);
	
	}
	
	public function getArrayOfComplicatedPasswords($numberOfPasswords) {
	
		$passwordArray = array();
		$poolLengthMinusOne = count($this->POOL_FOR_COMPLICATED)-1;
		
		for($i=0; $i<$numberOfPasswords; $i++) {
			$password = '';
			for($j=0; $j<$this->passwordLength; $j++) {
				$password.= $this->POOL_FOR_COMPLICATED[mt_rand(0, $poolLengthMinusOne)];
			}
			$passwordArray[] = $password;
		}
		return $passwordArray;
	}
	
	
	public function getArrayOfAlphanumericalPasswords($numberOfPasswords) {
	
		$passwordArray = array();
		$poolLengthMinusOne = count($this->POOL_FOR_ALPHANUMERIC)-1;
		
		for($i=0; $i<$numberOfPasswords; $i++) {
			$password = '';
			for($j=0; $j<$this->passwordLength; $j++) {
				$password.= $this->POOL_FOR_ALPHANUMERIC[mt_rand(0, $poolLengthMinusOne)];
			}
			$passwordArray[] = $password;
		}
		return $passwordArray;
	}
	
	
	public function getArrayOfMnemonicPasswords($numberOfPasswords) {
	
		$passwordArray = array();
		$vocalsPoolLengthMinusOne = count($this->POOL_OF_VOCALS)-1;
		$consonantsPoolLengthMinusOne = count($this->POOL_OF_VOCALS)-1;
		
		for($i=0; $i<$numberOfPasswords; $i++) {
			$password = '';
			for($j=0; $j<$this->passwordLength; $j++) {
				if ($j%2==0) {
					$password.= $this->POOL_OF_VOCALS[mt_rand(0, $vocalsPoolLengthMinusOne)];
				} else {
					$password.= $this->POOL_OF_CONSONANTS[mt_rand(0, $consonantsPoolLengthMinusOne)];
				}
			}
			$passwordArray[] = $password;
		}
		return $passwordArray;
	}
	
}