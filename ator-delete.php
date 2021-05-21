<?php

include "config.php";

$query = $pdo->prepare("DELETE FROM ator 
                         WHERE ator_id = :ator_id ");

$query->bindParam(":ator_id", $_POST['ator_id']);

$query->execute();

?><script>
    parent.document.getElementById('linha-ator-<?php echo $_POST['ator_id']?>').remove();
    var data = {message: 'Ator deletado'};
    parent.document.getElementById('aviso-toast').MaterialSnackbar.showSnackbar(data);
</script>