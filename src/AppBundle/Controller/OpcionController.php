<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use AppBundle\Entity\Opcion;
use AppBundle\Form\OpcionType;

/**
 * @Route("/gestionOpciones", name="gestionOpciones")
 */
class OpcionController extends Controller
{
   
    /**
     * @Route("/nuevaOpcion", name="nuevaOpcion")
     */
    public function nuevaOpcionAction(Request $request)
    {
        $opcion = new Opcion();
        $form = $this->createForm(OpcionType::class, $opcion);
        
        // Recogemos la inf
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            // Rellenar Entity de Opcion
            $opcion = $form->getData();
            // $opcion->setFechaCreacion(new \DateTime());

            // Almacenar nuevo opcion
            // $entityManager = $em
            $em = $this->getDoctrine()->getManager();
            // Objeto que queremos almacenar
            $em->persist($opcion);
            // Finalizar comunicación con bd
            $em->flush();

            return $this->redirectToRoute('opcion', ['id' => $opcion->getId()]);
        }
        return $this->render('gestionOpcion/nuevoOpcion.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
