<?php

/*
1. Kopioi tämä scripti kansioon jonka tiedostoja haluat muuttaa.

2. Aseta ajan siirto esim 1 tunti taaksepäin '-1 hour' tai 1 päivä taakse '-1 day' vastaavasti eteenpäin käyttämällä plussaa
'+1 hour' - 1 tunti eteenpäin
'-2 hours' - 2 tuntia taaksepäin
'+3 days' - 3 päivää eteenpäin
'-4 days' - 4 pivää taaksepäin
'+5 months' - 5 kuukautta eteenpäin
'-6 months' - 6 kuukautta taaksepäin
*/
$siirto = '-1 hour';

/*
3. Ajaa tämä scripti komentokehotteella: php -f changeDate.php
4. Tällä kerta ei tehdä muutoksia, vaan tarkistetaan onko oikeat tiedostot ja onko uusi aika haluttu aika.
5. Poista tarkistus päältä, asettamalla arvoksi 0.
*/
$tarkistus = 1;
/*
6. Ajaa tämä scripti uudestaan, tällä kerta muutokset tallennetaan tiedostoihin.
*/

date_default_timezone_set('Europe/Helsinki');

function showDate($time) {
	return date('Y-m-d H:i:s', $time);
}

$dir = getcwd();
print $dir."\n";
$list = scandir($dir);

foreach($list as $file) {

	if(!preg_match('/(^\.+|\.php$)/', $file)) {
		print $file."\n";
		$stat = stat($file);
		$created = exec("stat -f %B $file");
		print "\tLuotu: ".showDate($created)." muokattu: ".showDate($stat['mtime'])." avattu: ".showDate($stat['atime'])."\n";
		$newDate = date('YmdHi', strtotime($siirto, $created));
		print "\tUusi aika: $newDate\n";
		if(!$tarkistus) print exec("touch -t $newDate '".$file."'")."\n";
	}
	
}
?>
