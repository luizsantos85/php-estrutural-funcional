<?php
function validate(array $validations)
{
    $result = [];
    $param = '';
    foreach ($validations as $field => $validate) {
        $result[$field] = (!str_contains($validate, '|')) ?
            singleValidation($field, $validate, $param) :
            multipleValidations($field, $validate, $param);
    }

    if (in_array(false, $result)) {
        return false;
    }

    return $result;
}

function singleValidation($field, $validate, $param)
{
    if (str_contains($validate, ':')) {
        [$validate, $param] = explode(':', $validate);
    }
    return $validate($field, $param);
}

function multipleValidations($field, $validate, $param)
{
    $explodePipeValidate = explode('|', $validate);
    foreach ($explodePipeValidate as $validate) {
        if (str_contains($validate, ':')) {
            [$validate, $param] = explode(':', $validate);
        }
        $result = $validate($field, $param);
    }

    return $result;
}

function required($field)
{
    if ($_POST[$field] === '') {
        setFlash($field, 'O campo é obrigatorio.');
        return false;
    }

    return strip_tags($_POST[$field]);
}

function email($field)
{
    $isValidEmail = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);

    if (!$isValidEmail) {
        setFlash($field, 'O campo tem que ser um e-mail válido.');
        return false;
    }

    return strip_tags($_POST[$field]);
}

function unique($field, $param)
{
    $data = strip_tags($_POST[$field]);
    $user = findBy($param, $field, $data);
    if ($user) {
        setFlash($field, 'Campo com valor já cadastrado.');
        return false;
    }
    return $data;
}

function maxlen($field, $param)
{
    $data = strip_tags($_POST[$field]);

    if (strlen($data) > $param) {
        setFlash($field, "O campo pode ter no máximo {$param} caracteres.");
        return false;
    }

    return $data;
}
