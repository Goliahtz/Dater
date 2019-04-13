<?php

class tr
{
	private $lang = [
		"January" => "Ocak",
		"February" => "Şubat",
		"March" => "Mart",
		"April" => "Nisan",
		"May" => "Mayıs",
		"June" => "Haziran",
		"July" => "Temmuz",
		"August" => "Ağustos",
		"September" => "Eylül",
		"October" => "Ekim",
		"November" => "Kasım",
		"December" => "Aralık",

		"Monday" => "Pazartesi",
		"Tuesday" => "Salı",
		"Wednesday" => "Çarşamba",
		"Thursday" => "Perşembe",
		"Friday" => "Cuma",
		"Saturday" => "Cumartesi",
		"Sunday" => "Pazar",

		"Autumn" => "Sonbahar",
		"Winter" => "Kış",
		"Spring" => "İlkbahar",
		"Summer" => "Yaz",
	];

	public function __($text){
		return $this->lang[$text];
	}
	public function all(){
		return $this->lang;
	}
}