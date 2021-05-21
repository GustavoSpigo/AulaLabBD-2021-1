<?php

include "config.php";

$query = $pdo->prepare("UPDATE ator SET primeiro_nome = :primeiro_nome, 
                                        ultimo_nome = :ultimo_nome  
                            WHERE ator_id = :ator_id");


$query->bindParam(":primeiro_nome", $_POST['primeiro_nome']);
$query->bindParam(":ultimo_nome", $_POST['ultimo_nome']);
$query->bindParam(":ator_id", $_POST['ator_id']);

$query->execute();

?><script>
parent.window.location.reload();
</script>