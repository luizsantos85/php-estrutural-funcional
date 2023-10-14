<?php $this->layout('template', ['title' => $title]) ?>

<div class="align-items-center mt-5">

    <h2><?= $title; ?></h2>

    <form action="/user/update" method="post">
        <div class="row">
            <div class="col-12">
                <?= getFlash('message'); ?>


                <div class="col-6">
                    <div class="form-group mt-2">
                        <label for="name">Nome</label>
                        <input type="name" class="form-control" name="name" id="name" 
                        value="<?= $user->name ?>">
                        <?= getFlash('name'); ?>
                    </div>

                    <div class="form-group mt-2">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" name="email" id="email" 
                        value="<?= $user->email ?>">
                        <?= getFlash('email'); ?>
                    </div>

                    <!-- <div class="form-group mt-2">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                        <?= getFlash('password'); ?>
                    </div> -->

                    <input type="hidden" name="user_id" value="<?= $user->id ?>">


                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </div>
            </div>
    </form>
</div>