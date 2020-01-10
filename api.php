<?php

// app.php

$post_data = array(
  'item' => array(
    'id' => 1,
    'nome' => 'rafael',
    'sobrenome' => 'mardegan',
    'telefone' => '996085899',
    'sexo' => 'masculino'
  )
);

echo json_encode($post_data)."\n";