<?php

include "config.php";

$query = $pdo->prepare("INSERT INTO ator (primeiro_nome, ultimo_nome)
                                VALUES (:primeiro_nome, :ultimo_nome)");


$query->bindParam(":primeiro_nome", $_POST['primeiro_nome']);
$query->bindParam(":ultimo_nome", $_POST['ultimo_nome']);

$query->execute();

/*

$query->execute([
    ":primeiro_nome" => $_POST['primeiro_nome'],
    ":ultimo_nome" => $_POST['ultimo_nome']
]);

*/

?><script>
    alert('Inserido com sucesso');
    parent.window.location.reload();
</script>