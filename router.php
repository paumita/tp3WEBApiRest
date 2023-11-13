<?php

    require_once './libs/router.php';

    require_once './MVC/Controllers/Api.Categoria.controller.php';
    require_once './MVC/Controllers/Api.controller.php';

    require_once './config.php';

    $router = new Router();

    //                endpoint                verbo    controller                  metodo

    $router->addRoute('categoriasFiltro',     'GET',   'ApiCategoriaController',     'getFiltro');
    $router->addRoute('categorias',           'GET',   'ApiCategoriaController',     'getAll');
    $router->addRoute('categorias/:ID',       'GET',   'ApiCategoriaController',     'getCategoria');
    $router->addRoute('categorias/:ID',       'PUT',   'ApiCategoriaController',     'editCategoria');
    $router->addRoute('categorias',           'POST',  'ApiCategoriaController',     'addCategoria');
    $router->addRoute('categoriasPaginado',   'GET',   'ApiCategoriaController',     'paginadoCategorias');
    $router->addRoute('categorias/:ID',       'DELETE','ApiCategoriaController',     'deleteCategoria');

    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);