<?php

class fr
{
	private $lang = [
		"January" => "Janvier",
		"February" => "Février",
		"March" => "Mars",
		"April" => "Avril",
		"May" => "Mai",
		"June" => "Juin",
		"July" => "Juillet",
		"August" => "Août",
		"September" => "Septembre",
		"October" => "Octobre",
		"November" => "Novembre",
		"December" => "Décembre",

		"Monday" => "Lundi",
		"Tuesday" => "Mardi",
		"Wednesday" => "Mercredi",
		"Thursday" => "Jeudi",
		"Friday" => "Vendredi",
		"Saturday" => "Samedi",
		"Sunday" => "Dimanche",

		"Autumn" => "Automne",
		"Winter" => "Hiver",
		"Spring" => "Printemps",
		"Summer" => "Été",
	];

	public function __($text){
		return $this->lang[$text];
	}
	public function all(){
		return $this->lang;
	}
}