<?php
function dbConnect() {
    $dns = 'mysql:host=172.16.238.12;dbname=poocombat';
    $user = 'root';
    $password = '';
    $db;

    try {
        $db = new PDO($dns, $user, $password);

    } catch (Exception $error) {
        echo '<p>Une erreur est survenue lors de la connexion à la base de données.</p>';

        var_dump($error);
    }

    return $db;
}

?>
