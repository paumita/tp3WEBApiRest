<?php

require_once "./MVC/Models/Categoria.model.php";
require_once "./MVC/Controllers/Api.controller.php";

class ApiCategoriaController extends ApiController{
    private $model;

    function __construct(){
        parent::__construct();
        $this->model = new CategoryModel();
    }

    public function getAll(){
            $categorias = $this->model->getAll();
            return $this->view->response($categorias, 200);
    }

    public function getFiltro() {
        
        $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'ID';
        $order = isset($_GET['order']) ? $_GET['order'] : 'asc';

        if($order == 'ASC' || $order == 'DESC' && $sort_by == 'id_categoria' ||$sort_by == 'nombre_categoria' ||$sort_by == 'descripcion' ||$sort_by == 'lugar'){
            $categorias = $this->model->getCategoriasOrden($sort_by,$order);
            return $this->view->response($categorias, 200);
        }else{
            return $this->view->response(['no existe el orden'], 200);
        }

    }

    public function editCategoria($params = []){

        $idCategoria = $params[':ID'];
        $existeCategoria = $this->model->getCategoria($idCategoria);
        if(!empty($existeCategoria)){
            $body = $this->getData();
            $nombre = $body->nombre_categoria;
            $descripcion = $body->descripcion;
            $lugar = $body->lugar;
            $this->model->editCategoria($idCategoria,$nombre,$descripcion,$lugar);
            $this->view->response(['la categoria con el id = '.$idCategoria.'se modifico con exito'],200);
        }else{
            $this->view->response(['la categoria con el id = '.$idCategoria.'no existe'],404);
        }
    }

    public function paginadoCategorias(){
            // Verifica si se solicita paginación
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Página actual
            $per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 10; // Elementos por página
    
            $categorias = $this->model->getCategoriasPaginadas($page, $per_page);
            return $this->view->response($categorias, 200);
    }

    public function deleteCategoria($params = []){
        $deleteCategoria = $this->model->getCategoria($params[':ID']);
        if(!empty($deleteCategoria)){
            $this->model->deleteCategoria($params[':ID']);
            $this->view->response(['Se borro con exito la categoria con el id = '.$params[':ID']],200);
        }else{
            $this->view->response(['no existe la categoria con el id = '.$params[':ID']],404);
        }
    }

    public function getCategoria($params = []){
        $categoria = $this->model->getCategoria($params[':ID']);
            if(!empty($categoria)){
                $this->view->response($categoria,200);
            }else{
                $this->view->response(['no se pudo encontrar la Categoria con el id = '.$params[':ID']],404);
            }
    }

    public function addCategoria(){

        $body = $this->getData();

        $nombre = $body->nombre_categoria;
        $descripcion = $body->descripcion;
        $lugar = $body->lugar;
      

        $id = $this->model->addCategoria($nombre,$descripcion,$lugar);
        $this->view->response(['El plan e agrego con exito con el id = '.$id],201);
    
    }

}