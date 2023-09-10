<?php

/**
 * Esta função carrega e executa um controlador com base nas informações fornecidas.
 *
 * @param array $matchedUri As informações da URI correspondente, incluindo o nome do controlador e do método.
 * @param array $params Os parâmetros a serem passados para o método do controlador, se houver.
 *
 * @throws Exception Se o controlador ou o método não existir, uma exceção é lançada com uma mensagem de erro correspondente.
 */
function loadController($matchedUri, $params)
{
    // Obtém o nome do controlador e do método da URI correspondente
    [$controller, $method] = explode('@', array_values($matchedUri)[0]);

    // Constrói o nome completo do controlador com o namespace
    $controllerWithNameSpace = CONTROLLER_PATH . $controller;

    // Verifica se a classe do controlador existe
    if (!class_exists($controllerWithNameSpace)) {
        throw new Exception("Controller '{$controller}' não existe.", 1);
    }

    // Cria uma instância do controlador
    $controllerInstance = new $controllerWithNameSpace;

    // Verifica se o método existe no controlador
    if (!method_exists($controllerInstance, $method)) {
        throw new Exception("O método '{$method}' não existe no controller '{$controller}'", 1);
    }

    // Chama o método do controlador, passando os parâmetros
    $controllerInstance->$method($params);
}