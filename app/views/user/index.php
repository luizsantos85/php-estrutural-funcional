<?php $this->layout('template', ['title' => $title]) ?>

<div class="row mt-5">

    <div class="col mr-auto">
        <h2> <?= $title; ?> </h2>
    </div>
    <div class="col-auto ml-auto">
        <a href="/user/create" class="btn btn-sm btn-outline-primary">Cadastrar Usuário</a>
    </div>

    <div class="col-12">
        <?= getFlash('message'); ?>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th width="150px">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td scope="row"> <?= $user->id; ?> </td>
                        <td> <?= $user->name; ?> </td>
                        <td> <?= $user->email; ?> </td>
                        <td>
                            <a href="/user/<?= $user->id; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/user/<?= $user->id; ?>/excluir" class="btn btn-sm btn-danger">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>