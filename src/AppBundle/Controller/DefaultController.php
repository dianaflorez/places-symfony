<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Lugar;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Opcion;

class DefaultController extends Controller
{
    /**
     * @Route("/{pag}", name="homepage")
     */
    public function homeAction(Request $request, $pag = 1)
    {
        $numLugares = 3; // Cant. registros para mostrar en paginación
        // Capturar repositorio para la tabla Lugar
        $repository = $this->getDoctrine()->getRepository(Lugar::class);

        // finds *all* lugar
        // $lugares = $repository->findAll();
        // $lugares = $repository->findByTop(1);
        $query = $repository->createQueryBuilder('t')
            ->where('t.top = 1')
            ->setFirstResult(0)
            ->setMaxResults(3)
            ->getQuery();
        $lugares = $query->getResult();

        // replace this example code with whatever you need
        return $this->render('frontal/index.html.twig', array('lugares' => $lugares));
        // return $this->render('default/index.html.twig', [
        //     'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        // ]);
    }

    /**
     * @Route("/nosotros", name="nosotros")
     */
    public function nosotrosAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('frontal/nosotros.html.twig');
    }

    /**
     * @Route("/contactar/{sitio}", name="contactar")
     */
    public function contactarAction(Request $request, $sitio="todos")
    {
        // replace this example code with whatever you need
        return $this->render('frontal/sedes.html.twig', array("sitio" => $sitio));
    }

    /**
     * @Route("/lugar/{id}", name="lugar")
     */
    public function lugarAction(Request $request, $id=null)
    {
        if($id !== null ){
            $repository = $this->getDoctrine()->getRepository(Lugar::class);
            $lugar = $repository->find($id);
            return $this->render('frontal/lugar.html.twig', array("lugar" => $lugar));
        }        
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/categoria/{id}", name="categoria")
     */
    public function categoriaAction(Request $request, $id=null)
    {
        if($id !== null ){
            $repository = $this->getDoctrine()->getRepository(Categoria::class);
            $categoria = $repository->find($id);
            return $this->render('frontal/categoria.html.twig', array("categoria" => $categoria));
        }        
        return $this->redirectToRoute('homepage');
    }

     /**
     * @Route("/opcion/{id}", name="opcion")
     */
    public function opcionAction(Request $request, $id=null)
    {
        if($id !== null ){
            $repository = $this->getDoctrine()->getRepository(Opcion::class);
            $opcion = $repository->find($id);
            return $this->render('frontal/opcion.html.twig', array("opcion" => $opcion));
        }        
        return $this->redirectToRoute('homepage');
    }
}
