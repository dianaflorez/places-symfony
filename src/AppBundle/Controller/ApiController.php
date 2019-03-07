<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use AppBundle\Entity\Categoria;

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
    function catToArray($categoria){
        $categoriaArray=array();
        $categoriaArray['id']  = $categoria->getId();
        $categoriaArray['nombre'] = $categoria->getNombre();
        $categoriaArray['descripcion'] = $categoria->getDescripcion();
        return $categoriaArray;
    }
    function catsToArray($categorias){
        $categoriasArray = array();
        foreach($categorias as $categoria){
            $categoriasArray[] = $this->catToArray($categoria);
        }
        return $categoriasArray;
    }
    /**
     * @Route("/listarCategorias", methods={"GET"})
     */
    public function listaCategoriasAction()
    {
        // ... return a JSON response with the post
        $repository = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $repository->findAll();
        $response = new JsonResponse($this->catsToArray($categorias));
        // return new Response("<html><head></head><body>Listar categorias</body></html>");
        return $response;
    }

    /**
     * @Route("/insertarCategoria/{nombre}/{descripcion}", methods={"POST"})
     */
    public function insertarCategoriaAction($nombre = "", $descripcion = "")
    {
        // ... edit a post
        if(strlen($nombre) > 0){
            $categoria = new Categoria();
            $categoria->setNombre($nombre);
            $categoria->setDescripcion($descripcion);
            $categoria->setFoto("");
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
            $response = new JsonResponse($this->catToArray($categoria));
            return $response;
            // return new Response("<html><head></head><body>Insertar categoria: ".$nombre."</body></html>");        
        }
        throw new BadRequestHttpException('Falta nombre', null, 400);
        // return new Response("<html><head></head><body>Insertar categorias: ".$categoria."</body></html>");        return new Response();

    }
}

