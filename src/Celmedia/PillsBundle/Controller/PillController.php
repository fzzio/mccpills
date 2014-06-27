<?php


namespace Celmedia\PillsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class PillController extends Controller {



    public function crearBriefAction($idpill )
    {
        $request = $this->getRequest();


        $session = $this->get("session");

        $form = $this->createFormBuilder()
        ->add('entendimiento', 'textarea')
        ->add('briefing', 'textarea')
        ->add('equipodetrabajo', 'text')
        ->getForm();


        if ($request->isMethod('POST')) {
            $form->bind($request);


            if ($form->isValid()) {
                $pillBrief = new \Celmedia\PillsBundle\Entity\Pillbrief();

                $usuario = $this->get('security.context')->getToken()->getUser();

                $data = $form->getData();

                $em = $this->getDoctrine()->getManager();
                /* Creacion del pill */

                $pill = $em->getRepository('CelmediaPillsBundle:Pill')->find( $idpill );
                




                /* Creacion del PillBrief y agregado de datos */
                $brief = new \Celmedia\PillsBundle\Entity\Pillbrief();
                $brief->setUsuario($usuario); /* Agregar usuario creador de pill */
                $brief->setEntendimiento($data["entendimiento"]);
                $brief->setBriefing($data["briefing"]);
                $brief->setFechaCreacion(new \DateTime());
                $brief->setEstado(1);
                $brief->setPill($pill);
                $brief->addEnviado($usuario); /* Agregar usuario receptor de pill */

                /* Guardar los cambios con persistencia */
                // $em->persist($pill);
                $em->persist($brief);
                $em->flush();
//                
                $equipo_de_trabajo = $data["equipodetrabajo"];
                $correos = explode(",", $equipo_de_trabajo);

                $lista_correos = array();

                for ($i = 0; $i < count($correos); $i++) {
                    $usuario = new \Celmedia\PillsBundle\Entity\User();
                    $usuario = $em->getRepository('CelmediaPillsBundle:User')->findOneBy(array("email" => $correos[$i]));
                    $lista_correos[$correos[$i]] = $usuario->getEmail();

                    $briefEnviado = new \Celmedia\PillsBundle\Entity\Briefenviado();
                    $briefEnviado->setFechaenvio(new \DateTime());
                    $briefEnviado->setEstado(0);
                    $briefEnviado->setUsuario($usuario);
                    $briefEnviado->setPillbrief($brief);

                    $em->persist($briefEnviado);
                }
                $em->flush();

                $this->enviarCorreos($correos, $pill, $brief);

                return $this->redirect($this->generateUrl('pillbrief_creado'));

            }
        }

        $errors = $form->getErrors();

        $em = $this->getDoctrine()->getManager();
        $usuarios = $em->getRepository('CelmediaPillsBundle:User')->findAll();
        $tags = $em->getRepository('CelmediaPillsBundle:Tag')->findAll();

        return $this->render('CelmediaPillsBundle:Pages:crear_solo_brief.html.twig', array(
            'form' => $form->createView(),
            'usuarios' => $usuarios,
            'idpill' => $idpill,
            'tags' => $tags
            ));

    }



    public function verpillbriefAction($idpillbrief)
    {

        $em   = $this->getDoctrine()->getManager();
        $pill = $em->getRepository('CelmediaPillsBundle:Pill')->find($idpillbrief);

        $brief = $em->getRepository('CelmediaPillsBundle:Pillbrief')->findOneBy(  array( "pill" => $pill ));

        /// cuento cuantas personas pueden votar por el pillbrief 
        $enviados = $em->getRepository('CelmediaPillsBundle:Briefenviado')->findBy(  array(  "pillbrief"  => $brief ) );

        $favoritos = $em->getRepository('CelmediaPillsBundle:Favorito')->findBy(array("pill" => $pill));

        $cantidad_votantes = array();

        foreach ( $brief->getCalificaciones() as $calificacion ) {
            if(  !in_array(  $calificacion->getUsuario() , $cantidad_votantes) ){
                $cantidad_votantes[] = $calificacion->getUsuario();
            }
        }

        //cuento cuantas personas han votado 
        
        return $this->render('CelmediaPillsBundle:Modal:verpillbrief.html.twig', array(
            'pill' => $pill , 
            'brief' => $brief , 
            'cantidad_votantes' => count($enviados) , 
            'cantidad_favoritos' => count($favoritos) , 
            'votos' => count($cantidad_votantes)
            ));
    }


    public function verbriefAction($idbrief)
    {

        $em   = $this->getDoctrine()->getManager();
        $brief = $em->getRepository('CelmediaPillsBundle:Pillbrief')->find(   $idbrief  );


        $pill = $em->getRepository('CelmediaPillsBundle:Pill')->find($brief->getPill()->getId());


        /// cuento cuantas personas pueden votar por el pillbrief 
        $enviados = $em->getRepository('CelmediaPillsBundle:Briefenviado')->findBy(  array(  "pillbrief"  => $brief ) );

        $favoritos = $em->getRepository('CelmediaPillsBundle:Favorito')->findBy(array("pill" => $pill));

        $cantidad_votantes = array();

        foreach ( $brief->getCalificaciones() as $calificacion ) {
            if(  !in_array(  $calificacion->getUsuario() , $cantidad_votantes) ){
                $cantidad_votantes[] = $calificacion->getUsuario();
            }
        }

        //cuento cuantas personas han votado 
        
        return $this->render('CelmediaPillsBundle:Modal:verpillbrief.html.twig', array(
            'pill' => $pill , 
            'brief' => $brief , 
            'cantidad_votantes' => count($enviados) , 
            'cantidad_favoritos' => count($favoritos) , 
            'votos' => count($cantidad_votantes)
            ));
    }
    




    public function mostrarVotacionAction( $idbrief )
    {

        $em = $this->getDoctrine()->getManager();
        $brief = $em->getRepository('CelmediaPillsBundle:pillbrief')->find(  $idbrief );

        /// cuento cuantas personas pueden votar por el pill 
        $enviados = $em->getRepository('CelmediaPillsBundle:Briefenviado')->findBy(  array(  "pillbrief"  => $brief    ) );

        $maximo_votantes= count($enviados );    

        $votos = array();
        $votos['inspirador'] = 0 ; 
        $votos['revolucionario'] = 0 ; 
        $votos['invisible'] = 0 ; 
        $votos['cliche'] = 0 ;  

        $votos_inspirador = $votos_invisible = $votos_revolucionario = $votos_cliche = 0 ;  


        //// proceso de contar el numero de votos que tiene el pillbrief 
        foreach ($brief->getCalificaciones() as $calificacion ) {

            if(   $calificacion->getTipo() == "cliche"){
                $votos_cliche++;
            }
            if(   $calificacion->getTipo() == "revolucionario"){
                $votos_revolucionario++;
            }
            if(   $calificacion->getTipo() == "inspirador"){
                $votos_inspirador++;
            }
            if(   $calificacion->getTipo() == "invisible"){
                $votos_invisible++;
            }
        }

        $votos['inspirador'] = $votos_inspirador ; 
        $votos['revolucionario'] = $votos_revolucionario ; 
        $votos['invisible'] = $votos_invisible ; 
        $votos['cliche'] = $votos_cliche ; 



        /// poderacion de lo votos con respecto a 27 que es la altura de la imagen que muestra los votos
        /// para esto se hace una regla de 3 simple 
        /// calculo el porcentaje de votos en cada tipo 
        foreach ($votos as $tipo => $cantidad) {
            if(  $maximo_votantes != 0 )
                $votos[$tipo] = ($cantidad / $maximo_votantes )* 100 ;
            else 
                $votos[$tipo] = 0 ;
        }

        // //// pondero los votos a los 27px 
        foreach ($votos as $tipo => $porcentaje) {
            $votos[$tipo] = ($porcentaje * 27 )  /100  ; 
        }

        //// saco el complemento de 27 pixeles pues una altura de 0px es el 100 de votos y viceversa 
        foreach ($votos as $tipo => $pixeles) {
            $votos[$tipo] = 27 - $pixeles  ; 
        }


        return $this->render('CelmediaPillsBundle:Blocks:votaciones.html.twig'  ,  array(
            "brief" => $brief,
            "votos" => $votos 
            ));
    }




    public function calificarPillAction( $id_brief ,  $categoria )
    {

        $current_usuario = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $brief = $em->getRepository('CelmediaPillsBundle:Pillbrief')->find(  $id_brief );
        $encontrado = false ; 

        foreach ($brief->getCalificaciones() as $calificacion ) {
            $usuario = $calificacion->getUsuario(); 
            $tipo = $calificacion->getTipo();

            if( $usuario === $current_usuario->getId()  && $tipo === $categoria ){
                $em->remove( $calificacion );
                $encontrado = true ; 
            }       
        }

        if(  !$encontrado ){
            $calificacion = new \Celmedia\PillsBundle\Entity\Calificacion();
            $calificacion->setFechaCreacion(  new \DateTime() );
            $calificacion->setEstado(  1 );
            $calificacion->setTipo(  $categoria);
            $calificacion->setUsuario( $current_usuario->getId() );
            $calificacion->setPillbrief(  $brief );
            $em->persist(  $calificacion); 
            $brief->getCalificaciones()->add($calificacion);
        }

        $em->flush(); 
        return $this->forward('CelmediaPillsBundle:Pill:mostrarVotacion', array(  "idbrief" => $brief->getId() ));
    }


    /**
     * Muestra los pills que contengas los tags seleccionados 
     * @param [type] $idtag [description]
     */
    public function mostrarResultadosTagAction($idtag)
    {

        $em = $this->getDoctrine()->getManager();
        $tagSeleccionado = $em->getRepository('CelmediaPillsBundle:Tag')->find( $idtag );
        $pills = $em->getRepository('CelmediaPillsBundle:Pill')->findAll();
        $pills_mostrar = array();

        foreach ($pills as $pill) {
            $tags = $pill->getTags();
            foreach ($tags as $tag) {
                if(  $tag->getId() === $tagSeleccionado->getId() )
                    $pills_mostrar[] = $pill ; 
            }

        }
        
        return $this->render('CelmediaPillsBundle:Pages:resultadosBusqueda.html.twig' , 
            array(
                "pills" => $pills_mostrar,
                "criterio" => $tagSeleccionado->getNombre()
                )
            );
    }
    /**
     * Muestra los pills que contengas las categorias seleccionados 
     * @param [type] $idcategoria [description]
     */
    public function mostrarResultadosCategoriasAction($idcategoria)
    {

        $em = $this->getDoctrine()->getManager();
        $catSeleccionado = $em->getRepository('CelmediaPillsBundle:Categoria')->find( $idcategoria );
        $pills = $em->getRepository('CelmediaPillsBundle:Pill')->findAll();
        $pills_mostrar = array();

        foreach ($pills as $pill) {
            $categorias = $pill->getCategorias();
            foreach ($categorias   as $categoria) {
                if(  $categoria->getId() === $catSeleccionado->getId() )
                    $pills_mostrar[] = $pill ; 
            }

        }

        return $this->render('CelmediaPillsBundle:Pages:resultadosBusqueda.html.twig' , 
            array(
                "pills" => $pills_mostrar,
                "criterio" => $catSeleccionado->getNombre()
                )
            );
    }
    /**
     * Muestra los pills que contengas el estudio seleccionado
     * @param [type] $idestudio [description]
     */
    public function mostrarResultadosEstudiosAction($idestudio)
    {

        $em = $this->getDoctrine()->getManager();
        $estudioSeleccionado = $em->getRepository('CelmediaPillsBundle:Estudio')->find( $idestudio );
        $pills = $em->getRepository('CelmediaPillsBundle:Pill')->findAll();
        $pills_mostrar = array();

        foreach ($pills as $pill) {
            $estudio = $pill->getEstudio();
            // foreach ($estudios as $estudio) {
            //     if(  $estudio->getId() === $estudioSeleccionado->getId() )
            //         $pills_mostrar[] = $pill ; 
            // }
            $id=$estudio->getId();
                if(  $id === $estudioSeleccionado->getId() ){
                    $pills_mostrar[] = $pill ; 
                }

        }
        
        return $this->render('CelmediaPillsBundle:Pages:resultadosBusqueda.html.twig' , 
            array(
                "pills" => $pills_mostrar,
                "criterio" => $estudioSeleccionado->getNombre()
                )
            );
    }




    /**
     * funcion que envia un correo a la lista de usuarios en el arreglo enviado 
     * @param  [type] $correos_array [     ejemplo $correo_array = array("mail@coreo1.com "  ,  "mail@coreo1.com "  , "mail@coreo1.com "  ) ]
     * @return [type]                [description]
     */
//public function enviarCorreoAction($correos_array , $pill , $pillbrief ){
    public function enviarCorreos($correos_array, $pill, $pillbrief) {


        $pathArchivoPill = __DIR__ . '/../../../../web/uploads/pills/' . $pill->getImagen();


        $message = \Swift_Message::newInstance()
        ->setSubject('Nuevo Pill Brief')
        ->setFrom(array('cerebro@celmedia.com' => 'Cerebro Celmediano'))
        ->setTo($correos_array)
        ->setBody(
            '<h2>Pill Brief Recibido</h2><br />' .
            '<strong>Entendimiento:</strong> ' . $pillbrief->getEntendimiento() . '<br/>' .
            '<strong>Briefing:</strong> ' . $pillbrief->getBriefing()
            )
        ->attach(\Swift_Attachment::fromPath($pathArchivoPill)->setFilename('PillBrief.png'))
        ->setContentType("text/html");


        if ($this->get('mailer')->send($message)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Funcion que trae el detalle del pill y consulta si el Pills es favorito para el usuario 
     * @param  [integer] $idpill
     * @return [type]
     */
    public function verPillAction($idpill) {

        $usuario = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $pill = $em->getRepository('CelmediaPillsBundle:Pill')->find($idpill);
        $fav = $em->getRepository('CelmediaPillsBundle:Favorito')->findOneBy(array("usuario" => $usuario, "pill" => $pill));
        $favoritos = $em->getRepository('CelmediaPillsBundle:Favorito')->findBy(array("pill" => $pill));

        return $this->render('CelmediaPillsBundle:Modal:ver_pill.html.twig', array(
            'pill' => $pill,
            "favorito" => $fav != null,
            "cantidad_favoritos" => count($favoritos)
            ));
    }

    public function uploadImageAction(Request $request) {


        $session = $this->get("session");


        $img = $_POST['imgBase64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        $filename = uniqid() . '.png';

        $session->set("imagen_pill", $filename);

        // $filename = "/var/www/Pills/web/uploads/pills/" . $filename;
        $filename = "/opt/lampp/htdocs/pills/web/uploads/pills/" . $filename;

        $file = $this->getUploadRootDir() . $filename;
        echo( realpath($file) );
        $success = file_put_contents($filename, $data);

        die();

        // print $success ? realpath( $filename )  : 'Unable to save the file.';
        // return $this->render('.html.twig');
    }

    private function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../web/uploads/pills/';
    }





    public function crearPillAction(Request $request) {

        $session = $this->get("session");

        $form = $this->createFormBuilder()
        ->add('descripcion', 'text', array("data" => 'Contenido del pill'))
        ->add('tags', 'text')
        ->add('color', 'text')
        ->add('categorias', 'entity', array(
            'class' => 'CelmediaPillsBundle:Categoria',
            'property' => 'nombre',
            'multiple' => false
            ))
        ->add('entendimiento', 'textarea')
        ->add('briefing', 'textarea')
        ->add('equipodetrabajo', 'text')
        ->getForm();


        if ($request->isMethod('POST')) {
            $form->bind($request);


            if ($form->isValid()) {
                $pillBrief = new \Celmedia\PillsBundle\Entity\Pillbrief();

                $usuario = $this->get('security.context')->getToken()->getUser();

                $data = $form->getData();

                $em = $this->getDoctrine()->getManager();
                /* Creacion del pill */

                $em->getRepository('CelmediaPillsBundle:Pill');
                $pill = new \Celmedia\PillsBundle\Entity\Pill();
                $pill->setDescripcion($data["descripcion"]);

                $pill->setImagen($session->get("imagen_pill"));


                $pill->setEstado(1);
                $pill->setFechaCreacion(new \DateTime());


                $tags = explode(",", $data["tags"]);
                foreach ($tags as $tag) {
                    $tagObj = $em->getRepository('CelmediaPillsBundle:Tag')->findOneBy(array("nombre" => $tag));
                    if ($tagObj == null) {
                        $tagObj = new \Celmedia\PillsBundle\Entity\Tag();
                        $tagObj->setNombre($tag);
                        $tagObj->setEstado(1);
                    }
                    $pill->addTag($tagObj);
                }

                /* Consulta de las categorias */
                $categoria = $data["categorias"];

                $pill->addCategoria($categoria);

                $pill->setUsuario($usuario);


                /* Creacion del PillBrief y agregado de datos */
                $brief = new \Celmedia\PillsBundle\Entity\Pillbrief();
                $brief->setUsuario($usuario); /* Agregar usuario creador de pill */
                $brief->setEntendimiento($data["entendimiento"]);
                $brief->setBriefing($data["briefing"]);
                $brief->setFechaCreacion(new \DateTime());
                $brief->setEstado(1);
                $brief->setPill($pill);
                $brief->addEnviado($usuario); /* Agregar usuario receptor de pill */

                /* Guardar los cambios con persistencia */
                $em->persist($pill);
                $em->persist($brief);
                $em->flush();
//                
                $equipo_de_trabajo = $data["equipodetrabajo"];
                $correos = explode(",", $equipo_de_trabajo);

                $lista_correos = array();

                for ($i = 0; $i < count($correos); $i++) {
                    $usuario = new \Celmedia\PillsBundle\Entity\User();
                    $usuario = $em->getRepository('CelmediaPillsBundle:User')->findOneBy(array("email" => $correos[$i]));
                    $lista_correos[$correos[$i]] = $usuario->getEmail();

                    $briefEnviado = new \Celmedia\PillsBundle\Entity\Briefenviado();
                    $briefEnviado->setFechaenvio(new \DateTime());
                    $briefEnviado->setEstado(0);
                    $briefEnviado->setUsuario($usuario);
                    $briefEnviado->setPillbrief($brief);

                    $em->persist($briefEnviado);
                }
                $em->flush();

                $this->enviarCorreos($correos, $pill, $brief);

                return $this->redirect($this->generateUrl('pillbrief_creado'));
            }
        }

        $errors = $form->getErrors();

        $em = $this->getDoctrine()->getManager();
        $usuarios = $em->getRepository('CelmediaPillsBundle:User')->findAll();
        $tags = $em->getRepository('CelmediaPillsBundle:Tag')->findAll();

        return $this->render('CelmediaPillsBundle:Pages:crear.html.twig', array(
            'form' => $form->createView(),
            'usuarios' => $usuarios,
            'tags' => $tags
            ));
    }




    public function eliminarBriefAction(  $idbrief )
    {


      $usuario = $this->get('security.context')->getToken()->getUser();

      if(  !usuarios ){


        $em = $this->getDoctrine()->getManager();
        $brief = $em->getRepository('CelmediaPillsBundle:Pillbrief')->find(   $idbrief );
        $brief->setEstado(0);
        $em->persist($brief); 
        $em->flush();

        return $this->render('CelmediaPillsBundle:Mensajes:eliminado.html.twig');
    }

        return $this->redirect($this->generateUrl('mis_pills'));
}



}
