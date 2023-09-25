<?php
function setFlash(string $index, string $message, string  $type = 'danger')
{
    if (!isset($_SESSION['flash'][$index])) {
        $_SESSION['flash'][$index] = "<span class='text-{$type} p-1'>{$message}</span>";
    }
}

function getFlash($index)
{
    if(isset($_SESSION['flash'][$index])){
        //guarda a msg na sessão
        $message = $_SESSION['flash'][$index];

        //deleta a sessão
        unset($_SESSION['flash'][$index]);

        //retornar se existir mensagem
        return $message ?? '';
    }
}
