<h2> <?= $title; ?> </h2>

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
                    <a href="/user/<?= $user->id ;?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="/user/excluir/<?= $user->id ;?>" class="btn btn-sm btn-danger">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>