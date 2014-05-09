<?php

require 'functions.php';

$message = "Etudiant ajouté avec succces";

try {
  $note_regexp = '/^\d+(\.\d+)?$/';

  $form = [
    'code' => '',
    'nom' => '/^((?!\d).)*$/',
    'email' => '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',
    'mat1' => $note_regexp,
    'mat2' => $note_regexp,
    'mat3' => $note_regexp
  ];

  form_validate($form);

  $xml = open_xml('etudiants.xml');

  // array_interset_key supprime kes clé de $_POST qui n'existe pas dans form
  add_student($xml, array_intersect_key($_POST, $form));

  $xml->save('etudiants.xml');
  
} catch (Exception $e) {
  $message = $e->getMessage();
}

?>

<!doctype html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, minimumscale=1.0, maximumscale=1.0">
</head>
<body>
    <div><?php echo $message; ?></div>
</body>
</html>

