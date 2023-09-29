<?php $this->layout('template', ['title' => $title]) ?>

<div class="align-items-center mt-4">

    <h2><?= $title; ?></h2>

    <form action="/login" method="post">
        <div class="row">
            <div class="col-12">
                <?= getFlash('message'); ?>
            </div>

            <div class="col-6">
                <div class="form-group mt-2">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="">
                </div>

                <div class="form-group mt-2">
                    <label for="password">Senha</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="">
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Logar</button>
                </div>
            </div>
        </div>
    </form>
</div>