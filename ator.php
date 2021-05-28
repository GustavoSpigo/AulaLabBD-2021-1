<?php

    include "config.php";
    include "header.php";

    $query = $pdo->prepare("SELECT * FROM ator ORDER BY ator_id DESC");

    $query->execute();
    $retorno = $query->fetchAll();
?>
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
        <iframe src="" id="ifr" name="ifr" style="/*display: none;*/ border: solid black"></iframe>
        <button id="show-dialog" type="button" onclick="mostrarDialogoInserir()"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
            Novo registro
        </button>
        <br><br>
        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">ID</th>
                    <th class="mdl-data-table__cell--non-numeric">Primeiro Nome</th>
                    <th class="mdl-data-table__cell--non-numeric">Último Nome</th>
                    <th class="mdl-data-table__cell--non-numeric">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($retorno as $numLinha => $linha) { ?>
                <tr id="linha-ator-<?php echo $linha['ator_id']; ?>">
                    <td>
                        <?php echo $linha['ator_id']; ?>
                    </td>

                    <td class="mdl-data-table__cell--non-numeric">
                        <?php echo $linha['primeiro_nome']; ?>
                    </td>

                    <td class="mdl-data-table__cell--non-numeric">
                        <?php echo $linha['ultimo_nome']; ?>
                    </td>

                    <td>
                        <button class="mdl-button mdl-js-button mdl-button--icon"
                                onclick="mostrarDialogEdicao(<?php echo $linha['ator_id']; ?>, '<?php echo $linha['primeiro_nome']; ?>', '<?php echo $linha['ultimo_nome']; ?>')">
                            <i class="material-icons">edit</i>
                        </button>

                        
                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored"
                                onclick="perguntarDelete(<?php echo $linha['ator_id']; ?>)">
                            <i class="material-icons">delete_forever</i>
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<dialog class="mdl-dialog" id="dialog" style="width: fit-content;">
    <form action="ator-acoes.php" method="post" target="ifr" id="form-insupd">
        <input type="hidden" name="acao" id="acao">
        <h4 class="mdl-dialog__title">Dados do ator</h4>
        <div class="mdl-dialog__content">
            <p>
            <input type="hidden" name="ator_id" id="ator_id">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="primeiro_nome" name="primeiro_nome" onkeyup="this.setCustomValidity('');this.parentElement.MaterialTextfield.checkValidity()">
                <label class="mdl-textfield__label" for="primeiro_nome">Primeiro nome</label>
            </div>
            <br>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="ultimo_nome" name="ultimo_nome" 
                       onkeyup="this.setCustomValidity('');this.parentElement.MaterialTextfield.checkValidity()">
                <label class="mdl-textfield__label" for="ultimo_nome">Último nome</label>
            </div>
            </p>
        </div>
        <div class="mdl-dialog__actions">
            <button type="submit" class="mdl-button submit">Salvar</button>
            <button type="button" class="mdl-button" onclick="document.getElementById('dialog').close()">Fechar</button>
        </div>
    </form>
</dialog>
<form action="ator-acoes.php" method="post" target="ifr" id="form-delete" >
    <input type="hidden" name="acao" value="delete">
    <input type="hidden" name="ator_id" id="ator_id_delete" value="">
</form>
<script>
    //Dialogo de Editar
    function mostrarDialogEdicao(v_ator_id, v_primeiro_nome , v_ultimo_nome){
        document.getElementById('acao'          ).value = "alterar";
        document.getElementById('ator_id'       ).value = v_ator_id;
        
        document.getElementById('primeiro_nome' ).parentElement.MaterialTextfield.change(v_primeiro_nome);
        document.getElementById('ultimo_nome'   ).parentElement.MaterialTextfield.change(v_ultimo_nome);

        document.getElementById('dialog').showModal();
    }

    function mostrarDialogoInserir(){
        document.getElementById('acao').value = "inserir";
        document.getElementById('form-insupd').reset();

        document.getElementById('dialog').showModal();
    }

    var confirmarDelete = function(){
        document.getElementById('aviso-toast').classList.remove("mdl-snackbar--active");
        document.getElementById('form-delete').submit();
    }
    function perguntarDelete(v_ator_id){
        document.getElementById('ator_id_delete').value = v_ator_id;
        var data = {
            message: 'Tem certeza?',
            timeout: 5000,
            actionHandler: confirmarDelete,
            actionText: 'Sim'
        };
        document.getElementById('aviso-toast').MaterialSnackbar.showSnackbar(data);
    }

</script>

<div id="aviso-toast" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

<?php
    include "footer.php";
?>