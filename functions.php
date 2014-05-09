<?php

function form_validate($form) {

  foreach($form as $input => $test) {
    if(empty($_POST[$input]))
      throw new Exception($input . ' est requit.');

    if($test and !preg_match($test, $_POST[$input]))
      throw new Exception($input . ' est invalide');
  }  
}

function open_xml($filename) {
  $xml = new DOMDocument('1.0', 'UTF-8');

  // creer le fichier si il n'existe pas
  if (!file_exists($filename)) {
      $file = fopen($filename, 'w+');
      fclose($file);
  }

  // Ajout dans le fichier xml
  if (!$xml->documentElement) {
      $xml->appendChild($xml->createElement('etudiants'));
  }

  // charger le fichier
  $xml->load($filename);

  return $xml;
}

function add_student($xml, $student) {    
  $std = $xml->createElement('etudiant');

  foreach ($student as $key => $value)
    $std->appendChild($xml->createElement($key, $value));

  $xml->documentElement->appendChild($std);
}