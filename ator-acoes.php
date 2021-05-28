<?php
include "config.php";

function validaAtor(){
    $nome_faltando = "";
    if(trim($_POST['ultimo_nome'])==""){
        $nome_faltando = "último nome"; 
        $comeComponete =  "ultimo_nome";
    }
    if(trim($_POST['primeiro_nome'])==""){
        $nome_faltando = "primeiro nome";    
        $comeComponete =  "primeiro_nome";
    }
    if($nome_faltando!=""){
        ?><script>
        parent.document.getElementById('<?php echo $comeComponete ?>').setCustomValidity('Preencha o <?php echo $nome_faltando ?>');
        parent.document.getElementById('<?php echo $comeComponete ?>').reportValidity();
        parent.document.getElementById('<?php echo $comeComponete ?>').parentElement.MaterialTextfield.checkValidity();
        </script><?php        
        return false;
    }
    return true;
}


/** DELETAR O ATOR */
if(@$_POST['acao']=="delete"){
    $query = $pdo->prepare("DELETE FROM ator 
                            WHERE ator_id = :ator_id ");

    $query->bindParam(":ator_id", $_POST['ator_id']);

    $query->execute();

    ?><script>
        parent.document.getElementById('linha-ator-<?php echo $_POST['ator_id']?>').remove();
        var data = {message: 'Ator deletado'};
        parent.document.getElementById('aviso-toast').MaterialSnackbar.showSnackbar(data);
    </script><?php
}

/** INSERIR O ATOR */
if(@$_POST['acao']=="inserir"){
    if(validaAtor()){
        $query = $pdo->prepare("INSERT INTO ator (primeiro_nome, ultimo_nome)
                                    VALUES (:primeiro_nome, :ultimo_nome)");


        $query->bindParam(":primeiro_nome", $_POST['primeiro_nome']);
        $query->bindParam(":ultimo_nome", $_POST['ultimo_nome']);

        $query->execute();
        ?><script>
        parent.window.location.reload();
        </script><?php
    }
}

/** ALTERAR O ATOR */
if(@$_POST['acao']=="alterar"){
    if(validaAtor()){
        $query = $pdo->prepare("UPDATE ator SET primeiro_nome = :primeiro_nome, 
                                            ultimo_nome = :ultimo_nome  
                                WHERE ator_id = :ator_id");


        $query->bindParam(":primeiro_nome", $_POST['primeiro_nome']);
        $query->bindParam(":ultimo_nome", $_POST['ultimo_nome']);
        $query->bindParam(":ator_id", $_POST['ator_id']);

        $query->execute();

        ?><script>
        parent.window.location.reload();
        </script><?php
    }
}
?>