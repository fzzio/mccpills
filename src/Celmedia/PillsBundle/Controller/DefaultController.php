<?php

namespace Celmedia\PillsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Celmedia\PillsBundle\Entity\Task;


class DefaultController extends Controller
{


    public function validateEmailDomain($email) {

        $correo_exploded = explode('@', $email);

      

        list ($email_user, $email_dominio) = array_pad(explode('@', $email, 2), 2, '');// separar el correo

        //$arraycorreo = explode("@",$email); // separar el correo
        //$email_dominio = $arraycorreo[1]; // get the domain of email address
        $listablanca = array("mccann.com","mccann.com.mx","mccann.com.ec");
        if(in_array($email_dominio,$listablanca) ) {
          return true;
      }
      else{
        return false;
    }
    return false;
}

public function indexAction()
{
    return $this->render('CelmediaPillsBundle:Pages:index.html.twig');
}
public function validacionAction(Request $request){
    //public function validacionAction(){
  // $request = $this->container->get('request');        

  $correo = $request->request->get('data1');
   
  //handle data
//   if (!(filter_var($correo, FILTER_VALIDATE_EMAIL))) {
//           # code...
//     $response = array("code" => 500, "success" => false);
//     return new Response(json_encode($response)); 
//     // print_r($correo);
//     // return new Response(json_encode($response));
//     //exit();
// }
if ($this->validateEmailDomain($correo)) {
           # code...
    $response = array("code" => 100, "success" => true);
    return new Response(json_encode($response)); 
} else{
    $response = array("code" => 300, "success" => false);  
    return new Response(json_encode($response)); 
}

  //prepare the response, e.g.
$response = array("code" => 400, "success" => false);
  //you can return result as JSON
return new Response(json_encode($response)); 
}  


public function loginAction(Request $request)
{
  /**/
        // $task = new Task();
        // $task->setTask('');
        // $task->setDueDate(new \DateTime('tomorrow'));

        // $form = $this->createFormBuilder()
        // ->add('task', 'text')
        // //->add('dueDate', 'date')
        // ->add('Enviar', 'submit')
        // ->getForm();
  /**/

        // $form->handleRequest($request);

        // if ($form->isValid()) {
        // // perform some action, such as saving the task to the database
        //     $data = $form->getData();
        //     // print_r($data->getTask());
        //     //$task


        //     if (self::validateEmailDomain($data["task"], self::$whitelist)){

        //         $user="valido";
        //         print_r($user);

        //     } else{
        //         return $this->redirect($this->generateUrl('error'));
        //     }
        //     // return $this->redirect($this->generateUrl('error'));
        // }
        // return $this->render('CelmediaPillsBundle:Pages:login.html.twig', array(
        //     'formRegistro' => $form->createView(),
        //     ));
  return $this->render('CelmediaPillsBundle:Pages:login.html.twig');
}

public function truthpillsAction()
{

    $em    = $this->getDoctrine()->getManager();
    $pills = $em->getRepository('CelmediaPillsBundle:Pill')->findAll();
    return $this->render('CelmediaPillsBundle:Pages:truthpills.html.twig', array(
        "pills" => $pills
        ));
}

public function mispillbriefAction()
{

    $usuario = $this->get('security.context')->getToken()->getUser();
    $em      = $this->getDoctrine()->getManager();
    $pills   = $em->getRepository('CelmediaPillsBundle:Pillbrief')->findBy(array(
        "usuario" => $usuario , "estado" => 1
        ));
    return $this->render('CelmediaPillsBundle:Pages:mispills.html.twig', array(
        "pills" => $pills
        ));

}

public function misfavoritosAction()
{

    $usuario   = $this->get('security.context')->getToken()->getUser();
    $em        = $this->getDoctrine()->getManager();
    $favoritos = $em->getRepository('CelmediaPillsBundle:Favorito')->findBy(array(
        "usuario" => $usuario
        ));
    return $this->render('CelmediaPillsBundle:Pages:favoritos.html.twig', array(
        "favoritos" => $favoritos
        ));
}


public function recibidosAction()
{
    $usuario = $this->get('security.context')->getToken()->getUser();        
    $em = $this->getDoctrine()->getManager();  

    $pils = $em->getRepository('CelmediaPillsBundle:Briefenviado')->findBy(array(
        "usuario" => $usuario->getId()            
        ));    


    return $this->render('CelmediaPillsBundle:Pages:pillsRecibidos.html.twig'  , array("pillsEnviados" => $pils ) );        
}



    /**
     * Funcion que relacion un pill con un usuario , en caso de que la relacion ya exista la elimina
     * @param  [type] $id_pill
     * @return [type]
     */
    public function updateFavoritoAction($id_pill)
    {
        $usuario = $this->get('security.context')->getToken()->getUser();
        
        $em   = $this->getDoctrine()->getManager();
        $pill = $em->getRepository('CelmediaPillsBundle:Pill')->find($id_pill);
        
        $favorito = $em->getRepository('CelmediaPillsBundle:Favorito')->findOneBy(array(
            "usuario" => $usuario,
            "pill" => $pill
            ));
        
        if ($favorito) {
            $em->remove($favorito);
            $em->flush();
        } else {

            $favorito = new \Celmedia\PillsBundle\Entity\Favorito();
            $favorito->setUsuario($usuario);
            $favorito->setPill($pill);
            $favorito->setFechacreacion(new \DateTime());
            $favorito->setEstado(1);
            $em->persist($favorito);
            $em->flush();
        }
        
        return $this->redirect($this->generateUrl('ver_detalle_pill_por_id', array(
            "idpill" => $id_pill
            )));
        
    }
    
    /**
     * devuelve el resultado de busqueda de pills
     * @return [type] [description]
     */
    public function buscarAction(Request $request)
    {

        $string_buscar = $request->request->get('text_buscar');
        
        $em       = $this->getDoctrine()->getManager();
        $estudios = $em->getRepository('CelmediaPillsBundle:Estudio')->findAll();
        
        
        $tags = $em->getRepository("CelmediaPillsBundle:Tag")->createQueryBuilder('t')->where("t.nombre LIKE '%" . $string_buscar . "%'")->getQuery()->getResult();
        
        
        $categorias = $em->getRepository("CelmediaPillsBundle:Categoria")->createQueryBuilder('t')->where("t.nombre LIKE '%" . $string_buscar . "%'")->getQuery()->getResult();
        
        
        
        
        return $this->render('CelmediaPillsBundle:Pages:resultados.html.twig', array(
            "tags" => $tags,
            "categorias" => $categorias,
            "estudio" => $estudios
            ));
    }
    
    
    

    public function verpillbriefrecibidoAction($idpill)
    {
        $em   = $this->getDoctrine()->getManager();
        $pillbrief = $em->getRepository('CelmediaPillsBundle:Pill')->find($idpill);
        $brief = $em->getRepository('CelmediaPillsBundle:Pillbrief')->findOneBy(  array("pill" => $idpill ));
        $enviados = $em->getRepository('CelmediaPillsBundle:Briefenviado')->findBy(  array(  "pillbrief"  => $brief    ) );
        
        return $this->render('CelmediaPillsBundle:Modal:recibido.html.twig', array(
            'brief' => $brief , 
            'pill' => $pillbrief , 
            'enviados' => $enviados 
            ));
    }
    
    public function miCuentaPillAction()
    {
        return $this->render('CelmediaPillsBundle:Pages:micuenta.html.twig');
    }
    
    public function mensajeAction()
    {
        return $this->render('CelmediaPillsBundle:Mensajes:mensaje.html.twig');
    }
    
    public function pillbriefEliminadoAction()
    {

        return $this->render('CelmediaPillsBundle:Mensajes:eliminado.html.twig');
    }
    public function pillbriefCreadoAction()
    {
        return $this->render('CelmediaPillsBundle:Mensajes:pillbriefcreado.html.twig');
    }
    
    
    
    /**
     * Muestra los resultados de los estudios 
     * @return [type] [description]
     */
    public function resultadosAction()
    {

        $em         = $this->getDoctrine()->getManager();
        $tags       = $em->getRepository('CelmediaPillsBundle:Tag')->findAll();
        $categorias = $em->getRepository('CelmediaPillsBundle:Categoria')->findAll();
        $estudios   = $em->getRepository('CelmediaPillsBundle:Estudio')->findAll();
        
        return $this->render('CelmediaPillsBundle:Pages:resultados.html.twig', array(
            "tags" => $tags,
            "categorias" => $categorias,
            "estudio" => $estudios
            ));
    }
    public function estudioAction()
    {
        return $this->render('CelmediaPillsBundle:Pages:estudio.html.twig');
    }
    public function cambioExitosoAction()
    {
        return $this->render('CelmediaPillsBundle:Mensajes:cambioexitoso.html.twig');
    }
    public function registroExitosoAction()
    {
        return $this->render('CelmediaPillsBundle:Mensajes:registroexitoso.html.twig');
    }
    public function errorAction()
    {
        return $this->render('CelmediaPillsBundle:Mensajes:error.html.twig');
    }
    
    public function getNotificacionesAction()
    {
        $usuario = $this->get('security.context')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        $enviados = $em->getRepository('CelmediaPillsBundle:Briefenviado')->findBy(array(
            "usuario" => $usuario->getId(),
            "estado" => 0
            ));
        
        return $this->render('CelmediaPillsBundle:Blocks:notificaciones.html.twig', array(
            "numero_notificaciones" => count($enviados)
            ));
    }


    public function mostrarEstudiosAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $tags       = $em->getRepository('CelmediaPillsBundle:Tag')->findAll();
        $categorias = $em->getRepository('CelmediaPillsBundle:Categoria')->findAll();
        $estudios   = $em->getRepository('CelmediaPillsBundle:Estudio')->findAll();
        
        return $this->render('CelmediaPillsBundle:Pages:estudios.html.twig', array(
            "tags" => $tags,
            "categorias" => $categorias,
            "estudio" => $estudios
            ));
        // return $this->render('CelmediaPillsBundle:Pages:estudios.html.twig');
    }

    public function newAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
        ->add('task', 'text')
        ->add('dueDate', 'date')
        ->add('save', 'submit')
        ->getForm();

        return $this->render('CelmediaPillsBundle:Pages:login.html.twig', array(
            'formRegistro' => $form->createView(),
            ));
    }
}
