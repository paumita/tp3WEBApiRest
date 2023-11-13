Readme

Nombre de los integrantes del grupo
Paula Manzalini 
Lucia Ramos 

Tematica del TP : Parque de diversiones
Un parque de diversiones separado en categorias de distintas tematicas (adrenalina,electricos,niños,acuaticos y safari), con distintos juegos segun la categoria.
El sistema de esta pagina puede crear, modificar, eliminar o mostrar cualquier categoría de distintos parques de diversiones.

Endpoints utilizados
* GET:          /api/categorias - muestra todas las categorías registradas
* GET:          /api/categorias/:ID - muestra una categoría especifica
* GET:          /api/categoriasPaginado - solicita una lista de entidades para paginar
* GET:          /user/token - token que permite la identificación
* GET.          /categoriasFiltro - filtra categoria por determinada condición
* PUT.          /categorias/:ID - se modifica una categoria especifica
* POST.         /categorias - se agrega una categoria
* DELETE.       /categorias/:ID - se elimina una categoria especifica