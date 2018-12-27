<?php

/**
 * Incrusta un snippet de la carpeta de snippets
 *
 * @param string $file
 * @param mixed $data array or object
 * @param boolean $return
 * @return string
 */

function snippet($file, $data = array(), $return = false) {
  	//Invocamos la clase
	$s = new snippet($file,$data,$return);
	$result = $s->show();
	return $result;
}

//Función que extrae las palabras clave de un texto, excluyendo los $stopwords
//https://www.hashbangcode.com/article/extract-keywords-text-string-php
function extractKeyWords($string) {
  mb_internal_encoding('UTF-8');
  $stopwords = array('una','un','unos','unas','la','el','lo','las','los','de','para','si','sí','no');
  $string = preg_replace('/[\pP]/u', '', trim(preg_replace('/\s\s+/iu', '', mb_strtolower($string))));
  $matchWords = array_filter(explode(' ',$string) , function ($item) use ($stopwords) { return !($item == '' || in_array($item, $stopwords) || mb_strlen($item) <= 2 || is_numeric($item));});
  $wordCountArr = array_count_values($matchWords);
  arsort($wordCountArr);
  return array_keys(array_slice($wordCountArr, 0, 10));
}


?>