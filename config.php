<?php
    $SERVIDOR = '';
    $USUARIO = '';
    $SENHA = '';
    $NOME_BANCO = '';

    try {

        $pdo = new PDO("mysql:host=$SERVIDOR;dbname=$NOME_BANCO",
                        $USUARIO,
                        $SENHA);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    } catch (\Throwable $th) {
        throw $th;
    }
?>