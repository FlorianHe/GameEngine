<?php

require_once('Config.php');

class GameEngine {


	public function run($file = "default.xml") {
		$ParserDOM = new ParserDOM();
		$Jean = $ParserDOM->createCharacter("Jean.xml");
		//$Jean->showValueDebugMode();
		$Jean->showCharacter("male1.jpg", 100, 201, "toto");
		$Jean->showQuestion("Q1", "Q1");
		$Jean->showAnswers("Q1", "A1", null,"Abtn");
		$Jean->showQuestion("Q2", "Q2");
		$Jean->showAnswers("Q2", "A2", null,"Abtn");
		// LOAD LE FICHIER CONFIG
		// LANCE LA FONCTION DE CREATION DU PNJ
	}
}