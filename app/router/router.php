<?php

function routes()
{
    return require_once "routes.php";
}

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
    if (array_key_exists($uri, $routes)) {
        return [$uri => $routes[$uri]]; // Retorna um array associativo com a rota correspondente.
    }

    return [];
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
            explode('/', ltrim($uri, '/')), // Divide a URI em partes e remove a barra inicial.
            explode('/', ltrim($matchedToGetParams, '/')) // Divide a URI correspondente em partes e remove a barra inicial.
        );
    }
    return []; // Retorna um array vazio se não houver correspondência.
}

function paramsFormat($uri,$params)
{
    $uri = explode('/', ltrim($uri, '/'));
    $paramsData = [];
    foreach ($params as $index => $param) {
        $paramsData[$uri[$index - 1]] = $param;
    }
    return $paramsData;
}

/**
 * Undocumented function
 *
 * @return void
 */
function router()
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $routes = routes();
    $matchedUri = exactMatchUriInArrayRoutes($uri, $routes);

    if (empty($matchedUri)) {
        $matchedUri = regularExpressionMatchArrayRoutes($uri, $routes);
        $params = paramsUri($uri, $matchedUri);
        $params = paramsFormat($uri,$params);

        echo '<pre>';
        print_r($params['user']);
        echo '</pre>';
        exit;
    }
}
