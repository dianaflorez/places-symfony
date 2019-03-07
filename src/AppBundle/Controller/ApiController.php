<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Categoria;

/**
 * @Route("/api")
 */
class ApiController extends Controller
    {
    /**
     * @Route("/listarCategorias", methods={"GET"})
     */
    public function listaCategoriasAction()
    {
        // ... return a JSON response with the post
        $repository = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $repository->findAll();
        $categoriasArray = array();
        foreach($categorias as $categoria){
            $categoriasArray=array();
            $categoriasArray['id']  = $categoria->getId;
            $categoriasArray['nombre'] = $categoria->getNombre;
            $categoriasArray['descripcion'] = $categoria->getDescripcion;
        }
     
        return new Response("<html><head></head><body>Listar categorias</body></html>");
    }

    /**
     * @Route("/insertarCategoria/{categoria}", methods={"POST"})
     */
    public function insertarCategoriaAction($categoria)
    {
        // ... edit a post
        return new Response("<html><head></head><body>Insertar categorias: ".$categoria."</body></html>");        return new Response();

    }
}

