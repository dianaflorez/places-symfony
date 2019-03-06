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
            // Upload photo
            $fotoFile = $lugar->getFoto();
            // use the original file name
            $fileName = $this->generateUniqueFileName().'.'.$fotoFile->guessExtension();
            // $file->move($directory, $file->getClientOriginalName());
        
            // lugarimg_directory Se define en parameters en config/config
            $fotoFile->move(
                $this->getParameter('lugarimg_directory'),
                $fileName
            );
            $lugar->setFoto($fileName);
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

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}