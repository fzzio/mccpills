<?php 


namespace Celmedia\PillsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class IphoneController extends Controller
{



	public function indexAction()
	{
		return $this->render('.html.twig');
	}





	public function loginAction($usuario , $password)
	{

		$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('CelmediaPillsBundle:User')->findOneBy(array("username" => $usuario));

		$json = array();

		 $elemento = array();
		 $elemento["autenticacion"] = false;
		 if(  $usuario ){
			$elemento["id"] = $usuario->getId();
		 	$elemento["autenticacion"] = true;
			$elemento["usuario"] = $usuario->getUsername();
			$json[] = $elemento; 
		 }
		 

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;

	}



	public function listarPillsAction()
	{

		$em = $this->getDoctrine()->getManager();
		$pills = $em->getRepository('CelmediaPillsBundle:Pill')->findAll();

		$json = array();

		foreach ($pills as $pill ) {
			$elemento = array();
			$elemento["id"] = $pill->getId();
			$elemento["imagen"] = $pill->getImagen();
			$elemento["fechaCreacion"] = $pill->getFechaCreacion();
			$json[] = $elemento; 
		}

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;

	}


	public function mostrarPillAction( $id_pill  )
	{

		$em = $this->getDoctrine()->getManager();
		$pill = $em->getRepository('CelmediaPillsBundle:Pill')->find( $id_pill );
		$favoritos = $em->getRepository('CelmediaPillsBundle:Favorito')->findBy(array("pill" => $pill ));

		$json = array();

		$elemento = array();
		$elemento["id"] = $pill->getId();
		$elemento["imagen"] = $pill->getImagen();
		$elemento["favoritos"] = count( $favoritos ) . " favoritos";
		$elemento["fechaCreacion"] = $pill->getFechaCreacion();
		$json[] = $elemento; 

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;

	}


	//TODO - falta modificar
	public function modificarDatosUsuarioAction($usuario, $passwordactual, $newpassword, $nombre, $apellido){

		$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('CelmediaPillsBundle:User')->findOneBy(array("username" => $usuario));

		$json = array();

		
		if( $usuario ){

			//$passA = $usuario->getId();
		 	//$elemento["usuario"] = $usuario->getUsername();
		 	$passA = $usuario->getPassword();
			$passARecibida = md5($passwordactual);
			
			print_r("Pass guardada: " . $passA . "\n");
			print_r("Pass recibida: " . $passARecibida . "\n");
			
			
		 	

		}


		$elemento = array();
		$elemento["codigo"] = "1";
		$elemento["mensaje"] = "Modificacion correct";
		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;

	}


	public function existeCorreoAction($correo){
		$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('CelmediaPillsBundle:User')->findBy(array("email" => $correo ));

		$json = array();
		$elemento = array();
		
		if( $usuario ){
			$elemento["codigo"] = "1";
			$elemento["mensaje"] = "Existe el correo";
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "No existe el correo";
		}
		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}

	
	public function getNumTruthBriefRecibidosAction($idusuario){
		$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('CelmediaPillsBundle:User')->findBy(array("id" => $idusuario ));

		$json = array();
		$elemento = array();
		
		if( $usuario ){

			$enviados = $em->getRepository('CelmediaPillsBundle:Briefenviado')->findBy(array(
	            "usuario" => $idusuario
	        ));

			$elemento["codigo"] = "1";
			$elemento["mensaje"] = "Truth Briefs listados";
			$elemento["totalTruthBriefs"] = count($enviados);
			
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "Error al obtener la cantidad";
			
		}
		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}

	public function getTruthBriefsPorUsuarioAction($idusuario){
		$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('CelmediaPillsBundle:User')->findBy(array("id" => $idusuario ));

		

		$json = array();
		$elemento = array();


		if ($usuario) {
			$pillBriefsResult = $em->getRepository('CelmediaPillsBundle:Pillbrief')->findBy(array(
	            "usuario" => $idusuario
	        ));
			

			if( $pillBriefsResult ){
				$arrayPillBrief = array();

				foreach ($pillBriefsResult as $pillBrief) {
					$pillBriefBasico = array(
						'id' => $pillBrief->getId(), 
						'pill' => $pillBrief->getPill()->getId(), 
						'usuario' => $pillBrief->getUsuario()->getId(), 
						'idContacto' => $pillBrief->getIdContacto(), 
						'entendimiento' => $pillBrief->getEntendimiento(), 
						'briefing' => $pillBrief->getBriefing(), 
						'fechaCreacion' => $pillBrief->getFechaCreacion()->format('Y-m-d H:i:s'),
						'estado' => $pillBrief->getEstado()
					);

					array_push($arrayPillBrief, $pillBriefBasico);
				}
				
				$elemento["codigo"] = "1";
				$elemento["mensaje"] = "Truth Briefs listados";
				$elemento["truthBriefs"] = $arrayPillBrief;
				
			}else{
				$elemento["codigo"] = "0";
				$elemento["mensaje"] = "Error al obtener TruthBriefs.";
				
			}
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "Error: Usuario inexistente.";
		}
		
			
		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}


	public function getTruthBriefAction($idTruthBrief){
		$em = $this->getDoctrine()->getManager();
		$truthBrief = $em->getRepository('CelmediaPillsBundle:Pillbrief')->findOneBy(array("id" => $idTruthBrief ));
		
		$json = array();
		$elemento = array();
		
		if( $truthBrief ){
			$objPillBrief = array(
				'id' => $truthBrief->getId(), 
				'pill' => $truthBrief->getPill()->getId(), 
				'usuario' => $truthBrief->getUsuario()->getId(), 
				'idContacto' => $truthBrief->getIdContacto(), 
				'entendimiento' => $truthBrief->getEntendimiento(), 
				'briefing' => $truthBrief->getBriefing(), 
				'fechaCreacion' => $truthBrief->getFechaCreacion()->format('Y-m-d H:i:s'),
				'estado' => $truthBrief->getEstado()
			);

				
			$elemento["codigo"] = "1";
			$elemento["mensaje"] = "Truth Brief encontrado";
			$elemento["truthBrief"] = $objPillBrief;
			
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "Error al obtener TruthBrief.";
			
		}
		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}


	public function getNumFavoritosAction($idPill){
		$em = $this->getDoctrine()->getManager();
		$pill = $em->getRepository('CelmediaPillsBundle:Pill')->findOneBy(array("id" => $idPill ));
		
		$pillsFavorito = $em->getRepository('CelmediaPillsBundle:Favorito')->findBy(array("pill" => $pill ));

		$json = array();
		$elemento = array();
		
		if( $pillsFavorito ){
				
			$elemento["codigo"] = "1";
			$elemento["mensaje"] = "Favoritos encontrados";
			$elemento["totalFavoritos"] = count($pillsFavorito);
			
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "Error al obtener Favoritos.";
			
		}
		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}

	

	public function getPillsAction(){
		$em = $this->getDoctrine()->getManager();
		$pills = $em->getRepository('CelmediaPillsBundle:Pill')->findBy(array("estado" => 1 ));

		$json = array();
		$elemento = array();
		
		if( $pills ){

			$arrayPills = array();

			foreach ($pills as $pill) {
				$pillBasico = array(
					'id' => $pill->getId(),
					'usuario' => $pill->getUsuario()->getId(), 
					'estudio' => $pill->getEstudio()->getId(), 
					'descripcion' => $pill->getDescripcion(), 
					'imagen' => $pill->getImagen(), 
					'fechaCreacion' => $pill->getFechaCreacion()->format('Y-m-d H:i:s'),
					'estado' => $pill->getEstado()
				);

				array_push($arrayPills, $pillBasico);
			}
			
			$elemento["codigo"] = "1";
			$elemento["mensaje"] = "Pills listados";
			$elemento["pills"] = $arrayPills;


				
			$elemento["codigo"] = "1";
			$elemento["mensaje"] = "Pills encontrados";
			$elemento["totalFavoritos"] = count($pills);
			
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "Error al obtener Pills.";
			
		}
		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}


	
	public function getPillsFavoritosAction($idusuario){
		$em = $this->getDoctrine()->getManager();

		$usuario = $em->getRepository('CelmediaPillsBundle:User')->findBy(array("id" => $idusuario ));


		$json = array();
		$elemento = array();

		if ($usuario) {
			$pillsFavoritos = $em->getRepository('CelmediaPillsBundle:Favorito')->findBy(array("usuario" => $usuario ));
			

			if( $pillsFavoritos ){
				
				$arrayPills = array();

				foreach ($pillsFavoritos as $pillFavorito) {
					$pillBasico = array(
						'id' => $pillFavorito->getId(),
						'usuario' => $pillFavorito->getUsuario()->getId(), 
						'pill' => $pillFavorito->getPill()->getId(), 
						'fechaCreacion' => $pillFavorito->getFechaCreacion()->format('Y-m-d H:i:s')
					);

					array_push($arrayPills, $pillBasico);
				}
				

				$elemento["codigo"] = "1";
				$elemento["mensaje"] = "Favoritos encontrados";
				$elemento["pillsFavoritos"] = $arrayPills;
				
			}else{
				$elemento["codigo"] = "0";
				$elemento["mensaje"] = "Error al obtener Favoritos.";
				
			}
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "Error: Usuario inexistente.";
		}
		
			
		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}


	public function getTruthBriefRecibidosAction($idusuario){
		$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('CelmediaPillsBundle:User')->findBy(array("id" => $idusuario ));

        $json = array();
		$elemento = array();

		if ($usuario) {
			$recibidos = $em->getRepository('CelmediaPillsBundle:Briefenviado')->findBy(array(
	            "usuario" => $usuario,
	            "estado" => 0
	        ));

			if( $recibidos ){

				$arrayPillBriefs = array();

				foreach ($recibidos as $truthBrief) {
					$truthBriefBasico = array(
						'id' => $truthBrief->getId(),
						'usuario' => $truthBrief->getUsuario()->getId(), 
						'pillbrief' => $truthBrief->getPillBrief()->getId(), 
						'fechaEnvio' => $truthBrief->getFechaEnvio()->format('Y-m-d H:i:s'),
						'estado' => $truthBrief->getEstado()
					);
					array_push($arrayPillBriefs, $truthBriefBasico);
				}
				
				$elemento["codigo"] = "1";
				$elemento["mensaje"] = "Truth brief enviados";
				$elemento["pillsFavoritos"] = $arrayPillBriefs;
				
			}else{
				$elemento["codigo"] = "0";
				$elemento["mensaje"] = "No hay pillbriefs enviados.";
				
			}
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "Error: Usuario inexistente.";
		}

		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}

	public function getTotalCalificacionesPillBriefAction($idPillBrief){
		$em = $this->getDoctrine()->getManager();
		$pillbrief = $em->getRepository('CelmediaPillsBundle:Pillbrief')->findOneBy(array("id" => $idPillBrief ));


        $json = array();
		$elemento = array();

		if ( $pillbrief ) {
			$calificacionesInvisible = $em->getRepository('CelmediaPillsBundle:Calificacion')->findBy(array(
	            "pillbrief" => $pillbrief,
	            "tipo" => "invisible",
	            "estado" => 1
	        ));

	        $calificacionesCliche = $em->getRepository('CelmediaPillsBundle:Calificacion')->findBy(array(
	            "pillbrief" => $pillbrief,
	            "tipo" => "cliche",
	            "estado" => 1
	        ));

	        $calificacionesRevolucionario = $em->getRepository('CelmediaPillsBundle:Calificacion')->findBy(array(
	            "pillbrief" => $pillbrief,
	            "tipo" => "revolucionario",
	            "estado" => 1
	        ));

	        $calificacionesInspirador = $em->getRepository('CelmediaPillsBundle:Calificacion')->findBy(array(
	            "pillbrief" => $pillbrief,
	            "tipo" => "inspirador",
	            "estado" => 1
	        ));	
				
			$calificacionesPillBrief = array(
				'invisible' => count($calificacionesInvisible),
				'cliche' => count($calificacionesCliche),
				'revolucionario' => count($calificacionesRevolucionario),
				'inspirador' => count($calificacionesInspirador)
			);


	        $elemento["codigo"] = "1";
			$elemento["mensaje"] = "Calificaciones encontradas.";
			$elemento["calificaciones"] = $calificacionesPillBrief;
	        
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "Error: Pillbrief inexistente.";
		}

		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}



	public function getCalificacionesPillBriefPorUsuarioAction($idusuario, $idPillBrief){
		$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('CelmediaPillsBundle:User')->findOneBy(array("id" => $idusuario ));
		$pillbrief = $em->getRepository('CelmediaPillsBundle:Pillbrief')->findOneBy(array("id" => $idPillBrief ));


        $json = array();
		$elemento = array();

		if ($usuario && $pillbrief ) {

			$calificacionInvisible = $em->getRepository('CelmediaPillsBundle:Calificacion')->findOneBy(array(
	            "usuario" => $usuario,
	            "pillbrief" => $pillbrief,
	            "tipo" => "invisible",
	            "estado" => 1
	        ));
	        $calificacionCliche = $em->getRepository('CelmediaPillsBundle:Calificacion')->findOneBy(array(
	            "usuario" => $usuario,
	            "pillbrief" => $pillbrief,
	            "tipo" => "cliche",
	            "estado" => 1
	        ));
	        $calificacionInspirador = $em->getRepository('CelmediaPillsBundle:Calificacion')->findOneBy(array(
	            "usuario" => $usuario,
	            "pillbrief" => $pillbrief,
	            "tipo" => "inspirador",
	            "estado" => 1
	        ));
	        $calificacionRevolucionario = $em->getRepository('CelmediaPillsBundle:Calificacion')->findOneBy(array(
	            "usuario" => $usuario,
	            "pillbrief" => $pillbrief,
	            "tipo" => "revolucionario",
	            "estado" => 1
	        ));

			$detalleCalificaciones = array(
				'usuario' => $usuario->getId(),
				'pillbrief' => $pillbrief->getId(),
				"invisible" => array('valor' => ( ($calificacionInvisible) ? true : false ) , "fechaCreacion" => ( ($calificacionInvisible) ? $calificacionInvisible->getFechaCreacion()->format('Y-m-d H:i:s') : null ) ),
				"cliche" => array('valor' => ( ($calificacionCliche) ? true : false ) , "fechaCreacion" => ( ($calificacionCliche) ? $calificacionCliche->getFechaCreacion()->format('Y-m-d H:i:s') : null ) ),
				"inspirador" => array('valor' => ( ($calificacionInspirador) ? true : false ) , "fechaCreacion" => ( ($calificacionInspirador) ? $calificacionInspirador->getFechaCreacion()->format('Y-m-d H:i:s') : null ) ),
				"revolucionario" => array('valor' => ( ($calificacionRevolucionario) ? true : false ) , "fechaCreacion" => ( ($calificacionRevolucionario) ? $calificacionRevolucionario->getFechaCreacion()->format('Y-m-d H:i:s') : null ) )				
			);

	        $elemento["codigo"] = "1";
			$elemento["mensaje"] = "Calificaciones encontradas.";
			$elemento["calificaciones"] = $detalleCalificaciones;

		}else{
			$elemento["codigo"] = "-1";
			$elemento["mensaje"] = "Error: Usuario o pillbrief inexistente.";
		}

		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}

	

	public function setCalificacionAction($idusuario, $idpillbrief, $calificacion){
		$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('CelmediaPillsBundle:User')->findOneBy(array("id" => $idusuario ));
		$pillbrief = $em->getRepository('CelmediaPillsBundle:Pillbrief')->findOneBy(array("id" => $idpillbrief ));


        $json = array();
		$elemento = array();

		if ($usuario && $pillbrief ) {

			$calificacionExistente = $em->getRepository('CelmediaPillsBundle:Calificacion')->findOneBy(array(
	            "usuario" => $usuario,
	            "pillbrief" => $pillbrief,
	            "tipo" => $calificacion,
	            "estado" => 1
	        ));

	        if($calificacionExistente){
				$em->remove($calificacionExistente);
            	$em->flush();
            	
	        	$elemento["codigo"] = "0";
				$elemento["mensaje"] = "Calificacion eliminada.";
				$elemento["calificacion"] = $calificacion;
	        }else{
				$calificacionNueva = new \Celmedia\PillsBundle\Entity\Calificacion();
	            $calificacionNueva->setPillBrief($pillbrief);
	            $calificacionNueva->setUsuario($usuario->getId());
	            $calificacionNueva->setFechacreacion(new \DateTime());
	            $calificacionNueva->setEstado(1);
	            $calificacionNueva->setTipo($calificacion);
	            $em->persist($calificacionNueva);
	            $em->flush();	        	

	        	$elemento["codigo"] = "1";
				$elemento["mensaje"] = "Calificacion asignada.";
				$elemento["calificacion"] = $calificacion;
	        }
		}else{
			$elemento["codigo"] = "-1";
			$elemento["mensaje"] = "Error: Usuario o pillbrief inexistente.";
		}

		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}

	public function setFavoritoAction($idusuario, $idpill)
    {
    	$em = $this->getDoctrine()->getManager();
		$usuario = $em->getRepository('CelmediaPillsBundle:User')->findOneBy(array("id" => $idusuario ));
		$pill = $em->getRepository('CelmediaPillsBundle:Pill')->findOneBy(array("id" => $idpill ));

        $json = array();
		$elemento = array();

		if ($usuario && $pill ) {
			$favoritoExistente = $em->getRepository('CelmediaPillsBundle:Favorito')->findOneBy(array(
	            "usuario" => $usuario,
	            "pill" => $pill
	        ));

	        if($favoritoExistente){
				$em->remove($favoritoExistente);
            	$em->flush();
            	
	        	$elemento["codigo"] = "0";
				$elemento["mensaje"] = "Favorito eliminado.";
	        }else{
	        	$nuevoFavorito = new \Celmedia\PillsBundle\Entity\Favorito();
	            $nuevoFavorito->setUsuario($usuario);
	            $nuevoFavorito->setPill($pill);
	            $nuevoFavorito->setFechacreacion(new \DateTime());
	            $nuevoFavorito->setEstado(1);
	            $em->persist($nuevoFavorito);
	            $em->flush();

	        	$elemento["codigo"] = "1";
				$elemento["mensaje"] = "Favorito asignado.";
	        }
		}else{
			$elemento["codigo"] = "-1";
			$elemento["mensaje"] = "Error: Usuario o pillbrief inexistente.";
		}

		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;        
    }

	public function buscarTagsAction($tags){
		$arrayTagsRecibidos = preg_split("/[\s,]+/", $tags);

		$em = $this->getDoctrine()->getManager();
		
		$tagsEnBase = array();
		foreach ($arrayTagsRecibidos as $tagRecibido) {
			$tagsObtenidos = $em->getRepository("CelmediaPillsBundle:Tag")->createQueryBuilder('t')->where("t.nombre LIKE '%" . $tagRecibido . "%' AND t.estado=1")->getQuery()->getResult();
	
			$tagsEnBase = array_merge($tagsEnBase, $tagsObtenidos);
		}
		$objTagsSinRepetir = array_unique($tagsEnBase, SORT_REGULAR);
		
        $json = array();
		$elemento = array();

		if ($objTagsSinRepetir) {
			$arrayJSONTag = array();

			foreach ($objTagsSinRepetir as $tagSinRepetir) {
				$tagJSON["id"] = $tagSinRepetir->getId();
				$tagJSON["nombre"] = $tagSinRepetir->getNombre();
				$tagJSON["estado"] = $tagSinRepetir->getEstado();

				array_push($arrayJSONTag, $tagJSON);
			}


			$elemento["codigo"] = "1";
			$elemento["mensaje"] = "Tags encontrados.";
			$elemento["tags"] = $arrayJSONTag;
	        
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "No se encontraron tags.";
		}

		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}

	public function buscarCategoriasAction($categorias){
		$arrayCategoriasRecibidas = preg_split("/[\s,]+/", $categorias);

		$em = $this->getDoctrine()->getManager();
		
		$categoriasEnBase = array();
		foreach ($arrayCategoriasRecibidas as $categoriaRecibida) {
			$categoriasObtenidas = $em->getRepository("CelmediaPillsBundle:Categoria")->createQueryBuilder('t')->where("t.nombre LIKE '%" . $categoriaRecibida . "%' AND t.estado=1")->getQuery()->getResult();
	
			$categoriasEnBase = array_merge($categoriasEnBase, $categoriasObtenidas);
		}
		$objCategoriasSinRepetir = array_unique($categoriasEnBase, SORT_REGULAR);
		
        $json = array();
		$elemento = array();

		if ($objCategoriasSinRepetir) {
			$arrayJSONCategorias = array();

			foreach ($objCategoriasSinRepetir as $categoriaSinRepetir) {
				$categoriaJSON["id"] = $categoriaSinRepetir->getId();
				$categoriaJSON["nombre"] = $categoriaSinRepetir->getNombre();
				$categoriaJSON["descripcion"] = $categoriaSinRepetir->getDescripcion();
				$categoriaJSON["estado"] = $categoriaSinRepetir->getEstado();

				array_push($arrayJSONCategorias, $categoriaJSON);
			}


			$elemento["codigo"] = "1";
			$elemento["mensaje"] = "Categorias encontradas.";
			$elemento["tags"] = $arrayJSONCategorias;
	        
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "No se encontraron categorias.";
		}

		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}



	public function buscarEstudiosAction($estudios){
		$arrayEstudiosRecibidas = preg_split("/[\s,]+/", $estudios);

		$em = $this->getDoctrine()->getManager();
		
		$estudiosEnBase = array();
		foreach ($arrayEstudiosRecibidas as $estudioRecibida) {
			$estudiosObtenidas = $em->getRepository("CelmediaPillsBundle:Estudio")->createQueryBuilder('t')->where("t.nombre LIKE '%" . $estudioRecibida . "%' AND t.estado=1")->getQuery()->getResult();
	
			$estudiosEnBase = array_merge($estudiosEnBase, $estudiosObtenidas);
		}
		$objEstudiosSinRepetir = array_unique($estudiosEnBase, SORT_REGULAR);
		
        $json = array();
		$elemento = array();

		if ($objEstudiosSinRepetir) {
			$arrayJSONEstudios = array();

			foreach ($objEstudiosSinRepetir as $estudioSinRepetir) {
				$estudioJSON["id"] = $estudioSinRepetir->getId();
				$estudioJSON["nombre"] = $estudioSinRepetir->getNombre();
				$estudioJSON["descripcion"] = $estudioSinRepetir->getDescripcion();
				$estudioJSON["fechaCreacion"] = $estudioSinRepetir->getFechaCreacion()->format('Y-m-d H:i:s');
				$estudioJSON["estado"] = $estudioSinRepetir->getEstado();

				array_push($arrayJSONEstudios, $estudioJSON);
			}


			$elemento["codigo"] = "1";
			$elemento["mensaje"] = "Estudios encontradas.";
			$elemento["tags"] = $arrayJSONEstudios;
	        
		}else{
			$elemento["codigo"] = "0";
			$elemento["mensaje"] = "No se encontraron estudios.";
		}

		$json[] = $elemento;

		$response = new Response(json_encode( $json  ));
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}

}
