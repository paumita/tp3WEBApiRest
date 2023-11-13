<?php

class CategoryModel {

    private $db;

    public function __construct(){ 
        $this->db = new PDO('mysql:host=localhost;dbname=parque;charset=utf8','root','');
    }

    public function getAll(){
        $datos = $this->db->prepare('SELECT * FROM categorias');
        $datos->execute();
        return $datos->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoria($id){
        $datos = $this->db->prepare('SELECT * FROM categorias WHERE id_categoria = ?');
        $datos->execute([$id]);
        return $datos->fetch(PDO::FETCH_OBJ);
    }

    public function addCategoria($nombre,$descripcion,$lugar) {
        $datos = $this->db->prepare('INSERT INTO categorias (nombre_categoria, descripcion, lugar) VALUES (?, ?, ?)');
        $datos->execute([$nombre, $descripcion, $lugar]);

        // Devuelve "true" si la operación se realizó con éxito
        return $this->db->lastInsertId();
    }

    public function deleteCategoria($id){
        $datos = $this->db->prepare('DELETE FROM categorias WHERE id_categoria = ?');
        $datos->execute([$id]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }

    public function getCategoriasPaginadas($page, $per_page){
        // Calcula el límite y el desplazamiento para la paginación
        $limit = $per_page;
        $offset = ($page - 1) * $per_page;
    
        // Construye la consulta SQL con el nombre de la columna y la dirección de orden, además de la paginación.
        $query = "SELECT * FROM categorias LIMIT $limit OFFSET $offset";
        
        // Prepara y ejecuta la consulta.
        $datos = $this->db->prepare($query);
        $datos->execute();
        
        // Obtén los resultados en forma de objetos.
        $resultado = $datos->fetchAll(PDO::FETCH_OBJ);
        
        return $resultado;
    }

    public function editCategoria($idCategoria,$nombre,$descripcion,$lugar){
        $datos = $this->db->prepare('UPDATE categorias SET nombre_categoria = ?, descripcion = ?, lugar = ? WHERE id_categoria = ?');
        $datos->execute([$nombre, $descripcion, $lugar, $idCategoria]);

        // Devuelve "true" si la operación se realizó con éxito
        return true;
    }

    public function getCategoriasOrden($sort_by,$order){
        // Mantén la función original para manejar solicitudes sin paginación.
        // No es necesario realizar cambios en esta función.
        // ...

        // Asegúrate de que $sort_by sea un nombre de columna válido y seguro.
        // Asegúrate de que $order sea "ASC" o "DESC" para la dirección de orden.
    
        // Verifica que $order sea "ASC" o "DESC" y, si no lo es, establece un valor predeterminado.
        $order = ($order === 'DESC') ? 'DESC' : 'ASC';
    
        // Construye la consulta SQL con el nombre de la columna y la dirección de orden.
        $query = "SELECT * FROM categorias ORDER BY $sort_by $order";
        
        // Prepara y ejecuta la consulta.
        $datos = $this->db->prepare($query);
        $datos->execute();
        
        // Obtén los resultados en forma de objetos.
        $resultado = $datos->fetchAll(PDO::FETCH_OBJ);
        
        return $resultado;
    }

}

?>