<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Reserva;
use AppBundle\Form\ReservaType;

/**
 * @Route("/reservas")
 */
class ReservaController extends Controller
{
    /**
     * @Route("/nueva/{id}", name="nuevaReserva")
     */
    public function nuevaAction(Request $request, $id = null)
    {
        if($id){
            $repository = $this->getDoctrine()->getRepository(Reserva::class);
            $reserva = $repository->find($id);
         
        } else {
            $reserva = new Reserva();
        }
        $form = $this->createForm(ReservaType::class, $reserva);
        
        // Recogemos la inf
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            // Rellenar Entity de Reserva
            $usuario = $this->getUser();
            $reserva->setUsuario($usuario);

            // $reserva = $form->getData();
            // $reserva->setFechaCreacion(new \DateTime());

            // Almacenar nuevo reserva
            $em = $this->getDoctrine()->getManager();
            $em->persist($reserva);
            $em->flush();

            return $this->redirectToRoute('reservas');
        }
        return $this->render('reserva/nueva.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reservas", name="reservas")
     */
    public function reservasAction(Request $request, $id=null)
    {
        $repository = $this->getDoctrine()->getRepository(Reserva::class);
        $reservas = $repository->findByUsuario($this->getUser());
        return $this->render('reserva/reservas.html.twig', ["reservas" => $reservas]);
    
    }

     /**
     * @Route("/eliminar/{id}", name="eliminarReserva")
     */
    public function eliminarAction(Request $request, $id = null)
    {
        if($id){
            // Busqueda
            $repository = $this->getDoctrine()->getRepository(Reserva::class);
            $reserva = $repository->find($id);
         
            // Eliminar reserva
            $em = $this->getDoctrine()->getManager();
            $em->remove($reserva);
            $em->flush();

        }
        return $this->redirectToRoute('reservas');
    }


}
