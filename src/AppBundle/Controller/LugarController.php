<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Lugar;
use AppBundle\Form\LugarType;

/**
 * @Route("/gestionLugares", name="gestionLugares")
 */
class LugarController extends Controller
{
    /**
     * @Route("/nuevoLugar", name="nuevoLugar")
     */
    public function nuevoLugarAction(Request $request)
    {
        // Muestra la inf del request
        // if(!is_null($request)){
        //     $datos = $request->request->all();
        //     var_dump($datos);
        // }
        $lugar = new Lugar();
        $form = $this->createForm(LugarType::class, $lugar);
        
        // Recogemos la inf
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            // Rellenar Entity de Lugar
            $lugar = $form->getData();
            $lugar->setFoto("");
            $lugar->setFechaCreacion(new \DateTime());

            // Almacenar nuevo lugar
            // $entityManager = $em
            $em = $this->getDoctrine()->getManager();
            // Objeto que queremos almacenar
            $em->persist($lugar);
            // Finalizar comunicación con bd
            $em->flush();

            return $this->redirectToRoute('lugar', ['id' => $lugar->getId()]);
        }
        return $this->render('gestionLugar/nuevoLugar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
