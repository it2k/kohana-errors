<?php

return array(
	'show_alter_text_always' => TRUE, // Показвать алтернативный текст ошибки вместо реального $e->message
	'show_validation_error' => TRUE, // Показывать ошибки валидации
	'default_error_code' => '500', // Если код ошибки не наедтся в файле сообщений подставится этот код ошибки
	'show_debug_info' => array('127.0.0.1'), // TRUE или FALSE или Массив IP адресов
	'contact_email' => $_SERVER['SERVER_ADMIN'], // Контактный email адрес
);