<?php

/**
 * Esta função verifica se uma URI exata existe em um array de rotas.
 * Ela recebe uma URI e um array de rotas como argumentos.
 * Retorna um array associativo com a URI como chave e a rota correspondente como valor,
 *ou um array vazio se não houver correspondência.
 *
 * @param string $uri A URI que você deseja corresponder às rotas.
 * @param array $routes Um array contendo as rotas que você deseja comparar com a URI.
 * @return array
 */
function exactMatchUriInArrayRoutes($uri, $routes)
{
    // Verifica se a URI é uma chave no array de rotas.
    // Retorna um array associativo com a rota correspondente.
    return  (array_key_exists($uri, $routes)) ? [$uri => $routes[$uri]] : [];
}

/**
 * Esta função realiza uma correspondência de expressão regular entre uma URI e um array de rotas.
 * Ela recebe uma URI e um array de rotas como argumentos.
 * Utiliza uma função de filtro (array_filter) para aplicar uma expressão regular a cada rota no array.
 * Retorna um subconjunto das rotas que correspondem à URI com base na expressão regular.
 *
 * @param string $uri A URI que você deseja corresponder às rotas.
 * @param array $routes Um array contendo as rotas que você deseja comparar com a URI.
 * @return array Um subconjunto das rotas que correspondem à URI com base na expressão regular.
 */
function regularExpressionMatchArrayRoutes($uri, $routes)
{
    return array_filter($routes, function ($value) use ($uri) {
        $regex = str_replace('/', '\/', ltrim($value, '/')); // Remove a barra inicial e escapa as barras na rota.
        return preg_match("/^$regex$/", ltrim($uri, '/')); // Realiza a correspondência usando uma expressão regular.
    }, ARRAY_FILTER_USE_KEY);
}

/**
 * Esta função é usada para obter os parâmetros de uma URI em relação a uma URI correspondente.
 *
 * @param string $uri A URI da qual você deseja extrair os parâmetros.
 * @param array $matchedUri Um array de URI correspondentes, geralmente obtido de funções como `exactMatchUriInArrayRoutes` ou `regularExpressionMatchArrayRoutes`.
 *
 * @return array Uma matriz contendo os parâmetros da URI. Se não houver correspondência, retorna um array vazio.
 */
function paramsUri($uri, $matchedUri)
{
    if (!empty($matchedUri)) { // Verifica se há uma correspondência de URI.
        $matchedToGetParams = array_keys($matchedUri)[0]; // Obtém a primeira chave da matriz de correspondência.
        return array_diff(
            $uri,
            explode('/', ltrim($matchedToGetParams, '/')) // Divide a URI correspondente em partes e remove a barra inicial.
        );
    }
    return []; // Retorna um array vazio se não houver correspondência.
}

function paramsFormat($uri,$params)
{
    $paramsData = [];
    foreach ($params as $index => $param) {
        $paramsData[$uri[$index - 1]] = $param;
    }
    return $paramsData;
}

/**
 * Esta função é responsável por rotear as solicitações HTTP para controladores com base nas rotas definidas.
 *
 * Ela começa obtendo a URI atual da solicitação e as rotas definidas.
 * Primeiro, tenta encontrar uma correspondência exata entre a URI e as rotas.
 * Se nenhuma correspondência exata for encontrada, ele tenta corresponder usando expressões regulares.
 * Se uma correspondência for encontrada, carrega o controlador correspondente.
 * Caso contrário, lança uma exceção informando que algo deu errado na rota.
 *
 * @return void
 */
function router()
{
    // Obtém a URI da solicitação atual
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Obtém as rotas definidas
    $routes = require_once "routes.php";
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    // Tenta encontrar uma correspondência exata entre a URI e as rotas
    $matchedUri = exactMatchUriInArrayRoutes($uri, $routes[$requestMethod]);

    $params = [];

    // Se não houver correspondência exata, tenta corresponder usando expressões regulares
    if (empty($matchedUri)) {
        $matchedUri = regularExpressionMatchArrayRoutes($uri, $routes[$requestMethod],);

        // Divide a URI em partes e extrai parâmetros, se houver
        $uri = explode('/', ltrim($uri, '/'));
        $params = paramsUri($uri, $matchedUri);

        // Formata os parâmetros
        $params = paramsFormat($uri, $params);
    }

    // Se uma correspondência for encontrada, carrega o controlador correspondente
    if (!empty($matchedUri)) {
        return loadController($matchedUri,$params);
    }

    // Se não houver correspondência, lança uma exceção informando que algo deu errado na rota
    throw new Exception("Opss... Algo deu errado na sua rota.", 1);
}
