<?php
	/*// Set language to German
	$locale = "fa-IR";
	$result = putenv("LC_ALL=$locale");
	$result = setlocale(LC_ALL, $locale);
	if($result)
	{
		$domain = 'messages';
		// Specify location of translation tables
		bindtextdomain($domain, "./locale");
		bind_textdomain_codeset($domain, 'UTF-8');
		
		// Choose domain
		textdomain($domain);
		
		// Translation is looking for in ./locale/de_DE/LC_MESSAGES/messages.mo now
		
		// Print a test message
		echo "<br>" . gettext("Description");
	}
	
	
	
	$locale = 'fa_IR';
	
	$result = putenv("LC_ALL={$locale}"); // Returns TRUE
	if($result)
	{
		$domain = 'messages';
		bindtextdomain($domain, './locale');
		bind_textdomain_codeset($domain, 'UTF-8');
		textdomain($domain); // Returns'messages'
		
		print  "<br>" . gettext("Description");
	}*/
	require_once("control/persian_date/PCalendar.Class.php");
	$dAlarm     = FALSE;
	$dLocalTime = date("H:i:s", time());
	
	//			$datetime = new DateTime($dDateTime); // current time = server time
	$datetime = new DateTime($dLocalTime); // current time = server time
	
	$jalaliObject = new PersianCalendar();
	list($year, $month, $day) = $jalaliObject->gregorian_to_jalali($datetime->format("Y"),
	                                                               $datetime->format("m"),
	                                                               $datetime->format("d"));
	$dLocalDateTime = $year . "-" . $month . "-" . $day . $datetime->format(" H:i");
	
	echo $dLocalTime . "<br>";
	var_dump($datetime);
	echo "<br>";
	echo $dLocalDateTime . "<br>";
	
	$triggerOn = '2017-02-13T08:34:21Z';
	$user_tz = 'Asia/Tehran';
	
	echo $triggerOn. "<br>"; // echoes 04/01/2013 03:08 PM
	
	$schedule_date = new DateTime($triggerOn, new DateTimeZone('UTC') );
	$schedule_date->setTimeZone(new DateTimeZone($user_tz));
	$triggerOn =  $schedule_date->format('Y-m-d H:i:s');
	
	echo $triggerOn. "<br>"; // echoes 2013-04-01 22:08:00
?>