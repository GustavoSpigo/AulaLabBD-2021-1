<?php

    include "config.php";
    include "header.php";

    $query = $pdo->prepare("SELECT * FROM ator ORDER BY ator_id DESC");

    $query->execute();
    $retorno = $query->fetchAll();
?>
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">
        <iframe src="" id="ifr" name="ifr" style="display: none"></iframe>
        <button id="show-dialog" type="button"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Novo
            registro</button>
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

                        <form onsubmit="return window.confirm('Tem certeza?');" action="ator-delete.php" method="post" target="ifr" style="display:inline">
                            <input type="hidden" name="ator_id" value="<?php echo $linha['ator_id']; ?>">
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored">
                                <i class="material-icons">delete_forever</i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<dialog class="mdl-dialog" id="dialog-insert" style="width: fit-content;">
    <form action="ator-inserir.php" method="post" target="ifr">
        <h4 class="mdl-dialog__title">Inserir novo item</h4>
        <div class="mdl-dialog__content">
            <p>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="primeiro_nome">
                <label class="mdl-textfield__label" >Primeiro nome</label>
            </div>
            <br>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="ultimo_nome">
                <label class="mdl-textfield__label" >Último nome</label>
            </div>
            </p>
        </div>
        <div class="mdl-dialog__actions">
            <button type="submit" class="mdl-button submit">Inserir</button>
            <button type="button" class="mdl-button close">Fechar</button>
        </div>
    </form>
</dialog>
<script>
    //Dialogo de inserir
    var dialog = document.querySelector('#dialog-insert');
    var showDialogButton = document.querySelector('#show-dialog');
    if (!dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);
    }
    showDialogButton.addEventListener('click', function() {
        dialog.showModal();
    });
    dialog.querySelector('.close').addEventListener('click', function() {
        dialog.close();
    });
</script>


<dialog class="mdl-dialog" id="dialog-edit" style="width: fit-content;">
    <form action="ator-alterar.php" method="post" target="ifr">
        <h4 class="mdl-dialog__title">Inserir novo item</h4>
        <div class="mdl-dialog__content">
            <p>
            <input type="hidden" name="ator_id" id="ator_id">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="primeiro_nome" name="primeiro_nome">
                <label class="mdl-textfield__label" for="primeiro_nome">Primeiro nome</label>
            </div>
            <br>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="ultimo_nome" name="ultimo_nome">
                <label class="mdl-textfield__label" for="ultimo_nome">Último nome</label>
            </div>
            </p>
        </div>
        <div class="mdl-dialog__actions">
            <button type="submit" class="mdl-button submit">Alterar</button>
            <button type="button" class="mdl-button" onclick="document.getElementById('dialog-edit').close()">Fechar</button>
        </div>
    </form>
</dialog>
<script>
    //Dialogo de Editar
    function mostrarDialogEdicao(v_ator_id, v_primeiro_nome , v_ultimo_nome){

        document.getElementById('ator_id'       ).value = v_ator_id;
        
        document.getElementById('primeiro_nome' ).parentElement.MaterialTextfield.change(v_primeiro_nome);
        document.getElementById('ultimo_nome'   ).parentElement.MaterialTextfield.change(v_ultimo_nome);

        document.getElementById('dialog-edit').showModal();
    }
</script>

<div id="aviso-toast" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

<?php
    include "footer.php";
?>