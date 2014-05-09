<?php

require 'functions.php';

$xml = open_xml('etudiants.xml');

$studants = $xml->getElementsByTagName('etudiant');

$notesClass = [];
?>

<!doctype html>
<html>
<head>
  <title>Liste des etudiants</title>
  <meta charset="utf-8">
  <style type="text/css">
    table {
      border-collapse: collapse;
      box-shadow: 0 0 2px black;
      margin : 10px;
    }

    td {
      border : 2px solid black;
      padding : 5px;
    }
  </style>
</head>
<body>
  <?php foreach ($studants as $etd) :?>
  <table>
    <tr>
      <td>nom</td>
      <td>email</td>
      <td>mat1</td>
      <td>mat2</td>
      <td>mat3</td>
      <td>moyenne</td>
    </tr>
    <tr>
      <td><?php echo $etd->getElementsByTagName('nom')->item(0)->nodeValue?></td>
      <td><?php echo $etd->getElementsByTagName('email')->item(0)->nodeValue?></td>
      <td><?php $mat1 = $etd->getElementsByTagName('mat1')->item(0)->nodeValue; echo $mat1 ?></td>
      <td><?php $mat2 = $etd->getElementsByTagName('mat2')->item(0)->nodeValue; echo $mat2 ?></td>
      <td><?php $mat3 = $etd->getElementsByTagName('mat3')->item(0)->nodeValue; echo $mat3 ?></td>
      <td><?php 
            $moy = ($mat1 + $mat2 + $mat3) / 3;  
            $notesClass[] = $moy;
            echo $moy;
          ?>
      </td>
    </tr> 
  </table>
  <?php endforeach; ?>

  <div>
    <ul>
      <li>Note minimum : <?php echo min($notesClass) ?></li>
      <li>Note maximum : <?php echo max($notesClass) ?></li>
      <li>moyenne de la classe : <?php echo array_sum($notesClass) / count($notesClass) ?></li>
    </ul>
  </div>
</body>
</html>