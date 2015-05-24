<?php

require_once('./Config.php');

class ParserDOM {

	public $DOMDocument;

	public function __construct() {
		$this->DOMDocument = new DOMDocument();
	}

	public function createCharacter($file){
		$name = null;
		$sex = null;
		$class = null;
		$level = null;

		// Load the xml file for the character
		$this->DOMDocument->load(CHARACTERS_FILE . $file);

		// Take the character
		$characterDOM = $this->DOMDocument->getElementsByTagName('character')->item(0);

		// Find the name of the character
		if ($characterDOM->hasAttribute("name"))
			$name = $characterDOM->getAttribute("name");

		// Find the sex of the character
		if ($characterDOM->hasAttribute("sex"))
			$sex = $characterDOM->getAttribute("sex");

		// Find the class of the character
		if ($characterDOM->hasAttribute("class"))
			$class = $characterDOM->getAttribute("class");

		// Find the level of the character
		if ($characterDOM->hasAttribute("level"))
			$level = $characterDOM->getAttribute("level");

		//Find the list of question
		$listQuestion = $characterDOM->getElementsByTagName('question');
		$questionTab = array();
  		foreach($listQuestion as $question) {
  			if ($question->hasAttribute("id")){
  				$questionID = $question->getAttribute("id");
  				$questionTab[$questionID] = $question->firstChild->nodeValue;
  			}
  			else {
  				$res = $question->firstChild->nodeValue;
	    		$questionTab[] = $res;
	    		$array_test = array_keys($questionTab);
	    		$questionID = array_pop($array_test);
	    	}
	    	// Find and attach the list of question to the questions
	    	foreach ($question->getElementsByTagName('answer') as $answer) {
	    		if ($answer->hasAttribute("id")) {
	    			$answerID = $answer->getAttribute("id");
	    			$answerTab[$questionID][$answerID] = $answer->firstChild->nodeValue;
				}
				else {
					$answerTab[$questionID][] = $answer->firstChild->nodeValue;
				}
	    	}
	    }

	    // Create and return the Character with the parsed info
		$character = new Character($name, $sex, $questionTab, $answerTab, $class, $level);
		return ($character);
	}
}