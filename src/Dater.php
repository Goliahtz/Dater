<?php
class Dater
{
	const DEFAULT_LANG = "en";
	private $currentDateTime;
	private $timestamp;
	private $userValue;
	private $values = [];
	private $langFolder = "lang";
	private $flang = "en";
	private $lang;
	private $timezone = null;
	
	public function __construct($dateTime = 'now', $timezone = null, $lang = null)
	{
		$this->userValue = $dateTime;
		if ($timezone) {$this->setTimezone($timezone);}
		if ($lang) {$this->setLang($lang);}
		$this->createVars($dateTime);
	}
	public function setLang($lang){
		if ($lang !== 'en') {
			include_once $this->langFolder."/".$lang.".php";
			$this->lang = new $lang();
			foreach ($this->values as $key => $value) {
				if (array_key_exists($value, $this->lang->all())) {
					$this->values[$key] = $this->lang->__($value);
				}
			}
		}
		$this->flang = $lang;
	}
	public function setTimezone($timezone) {
		date_default_timezone_set($timezone);
		$this->createVars($this->userValue);
		$this->timezone = $timezone;
	}
	public function getInfo(){return $this->values;}
	public function getYear(){return $this->values['year'];}
	public function getMon(){return $this->values['mon'];}
	public function getMonth(){return $this->values['month'];}
	public function getMday(){return $this->values['mday'];}
	public function getWday(){return $this->values['wday'];}
	public function getYday(){return $this->values['yday'];}
	public function getWeekday(){return $this->values['weekday'];}
	public function getHours(){return $this->values['hours'];}
	public function getMinutes(){return $this->values['minutes'];}
	public function getSeconds(){return $this->values['seconds'];}
	public function getTimestamp(){return $this->values['timestamp'];}
	public function createDate($string) {
		$result = date($string, $this->getTimestamp());
		if ($this->flang == self::DEFAULT_LANG) {
			return $result;
		}
		return str_replace(array_keys($this->lang->all()), array_values($this->lang->all()), $result);
	}
	public function yesterday(){
		return $this->ago(1);
	}
	public function tomorrow(){
		return $this->later(1);
	}
	public function ago($number, $type = 'days'){
		$new = [
			'years' => $this->getYear(),
			'months' => $this->getMon(),
			'days' => $this->getMday(),
			'hours' => $this->getHours(),
			'minutes' => $this->getMinutes(),
			'seconds' => $this->getSeconds(),
		];
		if (array_key_exists($type, $new)) {
			$new[$type] -= $number;
		}
		return new Dater(mktime($new['hours'], $new['minutes'], $new['seconds'], $new['months'], $new['days'], $new['years']), $this->timezone, $this->flang);
	}
	public function later($number, $type = 'days'){
		$new = [
			'years' => $this->getYear(),
			'months' => $this->getMon(),
			'days' => $this->getMday(),
			'hours' => $this->getHours(),
			'minutes' => $this->getMinutes(),
			'seconds' => $this->getSeconds(),
		];
		if (array_key_exists($type, $new)) {
			$new[$type] += $number;
		}
		return new Dater(mktime($new['hours'], $new['minutes'], $new['seconds'], $new['months'], $new['days'], $new['years']), $this->timezone, $this->flang);
	}
	public function info(){
		return $this->setInfo([
			$this->getYear(),
			$this->getMon(),
			$this->getMday(),
			$this->getHours(),
			$this->getMinutes(),
			$this->getSeconds()
		]);
	}
	public function firstDay(){
		$d = new DateTime($this->getYear()."-".$this->getMon()."-".$this->getMday()." ".$this->getHours().":".$this->getMinutes().":".$this->getSeconds());
		$d->modify('first day of this month');
		return new Dater($d->format('Y-m-d H:i:s'), $this->timezone, $this->flang);
	}
	public function lastDay(){
		$d = new DateTime($this->getYear()."-".$this->getMon()."-".$this->getMday()." ".$this->getHours().":".$this->getMinutes().":".$this->getSeconds());
		$d->modify('last day of this month');
		return new Dater($d->format('Y-m-d H:i:s'), $this->timezone, $this->flang);
	}
	public function between($firstDay, $lastDay){
		$firstDayST = $firstDay->createDate("Y-m-d H:i:s");
		$lastDayST = $lastDay->createDate("Y-m-d H:i:s");
		$diff = strtotime($lastDayST) - strtotime($firstDayST);
		$totalDay = $diff/(60 * 60 * 24);
		$datesBetween = [];
		$nextDay = $firstDay->later(1);
		while(strtotime($nextDay->createDate("Y-m-d H:i:s")) < strtotime($lastDayST)) {
			array_push($datesBetween, $nextDay);
			$nextDay = $nextDay->later(1);
		}
		return [
			'totalDay' => $totalDay,
			'firstDay' => $firstDay,
			'lastDay' => $lastDay,
			'datesBetween' => $datesBetween,
		];
	}
	private function createVars($dateTime){
		if ($this->isTimeStamp($dateTime)) {
			$this->timestamp = $dateTime;
			$this->currentDateTime = date("Y-m-d H:i:s", $dateTime);
			$this->values = $this->createValues($this->currentDateTime, $dateTime);
		} else {
			switch ($dateTime) {
				case 'now':
					$this->timestamp = time();
					$this->currentDateTime = date("Y-m-d H:i:s", $this->timestamp);
					$this->values = $this->createValues($this->currentDateTime, $this->timestamp);
					break;
				default:
					$this->timestamp = strtotime($dateTime);
					$this->currentDateTime = $dateTime;
					$this->values = $this->createValues($dateTime, $this->timestamp);
			}
		}
	}
	private function createValues($dateTime, $timestamp){
		$exp = explode(" ", $dateTime);
		$date = explode("-", $exp[0]);
		$time = explode(":", $exp[1]);
		return [
			'year'  => $date[0],
			'mon' => $date[1],
			'month' => $this->lang(date("F", $timestamp)),
			'mday' => $date[2],
			'wday' => date('w', $timestamp),
			'yday' => date('z', $timestamp),
			'weekday' => $this->lang(date('l', $timestamp)),
			'hours'  => $time[0],
			'minutes'  => $time[1],
			'seconds'  => $time[2],
			'timestamp' => $timestamp
		];
	}
	private function lang($text){
		if ($this->flang == self::DEFAULT_LANG) {
			return $text;
		}
		if (array_key_exists($text, $this->lang->all())){
			return $this->lang->__($text);
		}
		return "";
	}
	private function isTimeStamp($timestamp){
		try {
			new DateTime('@' . $timestamp);
		} catch(Exception $e) {
			return false;
		}
		return true;
	}
	private function setInfo($arr){
		for ($i=0; $i<5; $i++) {
			if (!isset($arr[$i])) {$arr[$i] = -1;}
		}
		return [
			'years' => $arr[0],
			'months' => $arr[1],
			'days' => $arr[2],
			'hours' => $arr[3],
			'minutes' => $arr[4],
			'seconds' => $arr[5],
		];
	}
}