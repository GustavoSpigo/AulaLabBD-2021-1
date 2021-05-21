<?php
    $SERVIDOR = 'spigo.net';
    $USUARIO = 'spigo594_sakila';
    $SENHA = 'sakila';
    $NOME_BANCO = 'spigo594_sakila';

    try {

        $pdo = new PDO("mysql:host=$SERVIDOR;dbname=$NOME_BANCO",
                        $USUARIO,
                        $SENHA);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    } catch (\Throwable $th) {
        throw $th;
    }
?>