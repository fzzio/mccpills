<?php


namespace Celmedia\PillsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Celmedia\PillsBundle\Entity\Estudio;

class EstudioController extends Controller {



	public function crearEstudioAction(  Request $request )
	{

		$estudio = new Estudio();



		$form = $this->createFormBuilder($estudio)
		->add('nombre', 'text')
		->add('descripcion', 'textarea')
		 ->add('categorias', 'entity', array(
            'class' => 'CelmediaPillsBundle:Categoria',
            'property' => 'nombre',
            'multiple' => true
            ))
		->getForm();

		if ($request->isMethod('POST')) {
			$form->bind($request);

			if ($form->isValid()) {
            // perform some action, such as saving the task to the database
				$em = $this->getDoctrine()->getManager();
				$estudio->setFechaCreacion(  new \DateTime() );
				$estudio->setEstado(1);
				$em->persist( $estudio );
				$em->flush();
				return $this->redirect($this->generateUrl('ver_estudio' , array("idEstudio"=> $estudio->getId()) ));
			}
		}

		return $this->render('CelmediaPillsBundle:Pages:crear_estudio.html.twig'
			, array("form"  => $form->createView() )
			);
	}

	public function mostrarEstudiosAction(  Request $request )
	{


				$em = $this->getDoctrine()->getManager();
		$estudios = $em->getRepository('CelmediaPillsBundle:Estudio')->findAll(  );

		return $this->render('CelmediaPillsBundle:Pages:estudios.html.twig'  , array("estudios" => $estudios) );
	}



	public function verEstudioAction($idEstudio)		
	{

		$em = $this->getDoctrine()->getManager();
		$estudio = $em->getRepository('CelmediaPillsBundle:Estudio')->find(  $idEstudio );
	    return $this->render('CelmediaPillsBundle:Pages:estudio.html.twig' , array("estudio" => $estudio));
	}




}
