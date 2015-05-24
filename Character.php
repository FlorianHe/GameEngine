<?php

function addValuesQuestion($tab, $name, $sex, $class, $level) {
	$tab = str_replace("%name", $name, $tab);
	$tab = str_replace("%sex", $sex, $tab);
	$tab = str_replace("%class", $class, $tab);
	$tab = str_replace("%level", $level, $tab);
	return $tab;
}

function addValuesAnswers($tab, $name, $sex, $class, $level) {
	foreach ($tab as $key => $value)
		$keyTab[] = $key;
	$i = 0;
	while ($i < count($keyTab)){
		$tab[$keyTab[$i]] = str_replace("%name", $name, $tab[$keyTab[$i]]);
		$tab[$keyTab[$i]] = str_replace("%sex", $sex, $tab[$keyTab[$i]]);
		$tab[$keyTab[$i]] = str_replace("%class", $class, $tab[$keyTab[$i]]);
		$tab[$keyTab[$i]] = str_replace("%level", $level, $tab[$keyTab[$i]]);
		$i++;
	}
	return $tab;
}

class	Character {
	
	public $name;
	public $sex;
	public $class;
	public $level;
	public $question;
	public $answer;

	public function __construct($name = "Jean", $sex = "M", $question = "Hi", $answer = "Leave", $class = null, $level = null) {
		$this->name = $name;
		$this->sex = $sex;
		$this->class = $class;
		$this->level = $level;
		$this->question = addValuesQuestion($question, $name, $sex, $class, $level);
		$this->answer = addValuesAnswers($answer, $name, $sex, $class, $level);
	}

	public function showValueDebugMode() {
		echo "Name : " . $this->name . "<br/>";
		echo "Sex : " . $this->sex . "<br />";
		echo "Class : " . $this->class . "<br />";
		echo "Level : " . $this->level . "<br />";		
		$i = 1;
		foreach ($this->question as $key => $q) {
			echo "Question $i : " . $q . "<br/>";
			$j = 1;
			foreach ($this->answer[$key] as $a) {
				echo ">>Answer $j : " . $a . "<br/>";
				$j++;
			}
			$i++;
		}
	}

	public function showCharacter($image, $sizex = 0, $sizey = 0, $class = null) {
		$img = "";
		if ($class != null)
			$img .= "<div class=\"" . $class . "\">";
		if ($sizex > 50 && $sizey > 50)
			$img .= "<img src='" . IMAGES_FILE . $image . "' style=\"width:" . $sizex . "px;height:" . $sizey . "px\">";
		else
			$img .= "<img src='" . IMAGES_FILE . $image . "' style=\"width:50px;height:50px\">";
		if ($class != null)
			$img .= "</div>";
		echo $img;
	}

	public function showQuestion($id, $class = null) {
		$txt = "";
		if ($class != null)
			$txt .= "<div class=\"" . $class . "\">";
		$txt .= $this->question[$id];
		if ($class != null)
			$txt .= "</div>";
		echo $txt;
	}

	public function showAnswers($QuestionID, $class = null, $valueOnClick = null, $classbtn = null) {
		$txt = "";
		$i = 1;
		foreach ($this->answer[$QuestionID] as $answer) {
			if ($class != null)
				$txt .= "<div class=\"" . $class . $i . "\">";
			$txt .= "<button onclick=\"" . $valueOnClick . "\"";
			if ($classbtn != null)
				$txt .= " class=\"" . $classbtn . $i . "\" ";
			$txt .= ">" . $answer . "</button>";
			if ($class != null)
				$txt .= "</div>";
			$i++;
			}
			echo $txt;
		}
}





