<?php

/*
Para funcionar esta clase debe de incluirse en el core del proyecto
*/
class Redirecciona{

	//función que redirecciona hacia algun lugar
	// parametro: $url - especifica la url a donde se ira ('/hola/nuevo')
	public static function LetsGoTo($url){
		self::redirect($url);
		return new Redirecciona();
	}

	private function redirect($rute){
		$url = ABS_PATH;
		header("Location: {$url}{$rute}");
	}

}