<?php
function inverse($x) {
    //if (!$x) {
     //   throw new Exception('Division par z�ro.');
    //}
   // else 
    return 1/$x;
}

try {
    echo inverse(5) . "\n";
    echo inverse(0) . "\n";
} catch (Exception $e) {
    echo 'Exception re�ue : ',  $e->getMessage(), "\n";
}

// Continue execution
echo 'Bonjour le monde !';
?>
