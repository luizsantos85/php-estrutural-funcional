<div class="align-items-center mt-5">

    <h2><?= $title; ?></h2>

    <form action="/user/store" method="post">
        <div class="row">
            <div class="col-12">
                </div>
                
                <div class="col-6">
                    <div class="form-group mt-2">
                        <label for="name">Nome</label>
                        <input type="name" class="form-control" name="name" id="name">
                        <?= getFlash('name'); ?>
                    </div>
                    
                    <div class="form-group mt-2">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="">
                        <?= getFlash('email'); ?>
                    </div>
                    
                    <div class="form-group mt-2">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                        <?= getFlash('password'); ?>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </div>
    </form>
</div>