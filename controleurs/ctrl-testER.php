<?php 

$expression = $_POST['expression'];
$char = $_POST['char'];


?>


<?php 

    echo "expression : $expression<br>";
    echo "char : $char<br><br>";

    echo "ER > ";
    $er = rtrim( fgets($expression) );

    echo "Chaine > ";
    $s = rtrim( fgets($char) );


    if ( preg_match( "/$expression/", $char ) ){
        echo "Correspondance Ok\n";
    }
    else{
        echo "Correspondance Nok\n";
    }

?>