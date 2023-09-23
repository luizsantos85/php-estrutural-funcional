<nav class="navbar navbar-expand-lg navbar-light bg-dark ">
    <div class="container ">
        <!-- Links à esquerda -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-light" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="/user">Usuários</a>
            </li>
        </ul>

        <!-- Links à direita -->
        <ul class="navbar-nav ml-auto">
            <?php if (logged()) : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" role="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Minha Conta
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#"><?= userLogged()->name; ?></a></li>
                        <li><a class="dropdown-item" href="/logout">Sair</a></li>
                    </ul>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="/register">Cadastro</a>
                </li>

            <?php endif; ?>
        </ul>
    </div>
</nav>