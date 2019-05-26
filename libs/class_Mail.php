<?php 
class Mail {
	static $subject = 'По умолчанию';
	static $from = 'admin@tim-btr.school-php.com';
	static $to = 'kido_koiin@mail.ru';
	static $text = 'Шаблонное письмо';
	static $headers = '';
	
	//в эту ф-ю вставляем полностью англоязычный текст
	static function testMail() {
		if(mail(self::$to, 'English Text', 'English Text')) {
			echo 'Письмо отправлено';
		} else {
			echo 'Письмо не отправлено';
		}
		exit();
	}
	
	//первые две строки исправляют проблему с кодировкой русскоязычного текста.
	//третья строка(From) - это тоже частая проблема, когда не совпадают домены(?)
	//последняя строка говорит о том что это типовое рассылочное письмо и его не стоит расценивать как спам. 
	static function send() {
		
		self::$subject = '=?utf-8?b?'. base64_encode(self::$subject) .'?=';
		self::$headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
		
		self::$headers .= "From: ".self::$from."\r\n";
		self::$headers .= "MIME-Version: 1.0\r\n";
		self::$headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";
		
		self::$headers .= "Precedence: bulk\r\n";
		
		return mail(self::$to, self::$subject, self::$text, self::$headers);
	}
}