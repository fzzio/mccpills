<?php 

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicController extends Controller
{
    


    public function indexAction()
    {
        return $this->render('.html.twig');
    }



    public function listarPillsAction()
    {


    	$em = $this->getDoctrine()->getManager();
    	$pills = $em->getRepository('CelmediaPillsBundle:Pill')->findAll();

    	$response = new Response(json_encode( $pills ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;

    }





}
