<?php
	require 'SQLGlobal.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		try{
			$datos = json_decode(file_get_contents("php://input"),true);

			$idCard = $datos["idCard"]; // obtener parametros POST

            $respuesta = SQLGlobal::selectArrayFiltro(
				"select * from userff where idCard = ?",
				array($idCard)
			);//con filtro ("El tamaño del array debe ser igual a la cantidad de los '?'")
            if($respuesta){
                echo json_encode(array(
                    'respuesta'=>'200',
                    'estado' => 'Se obtuvieron correctamente las listas de datos',
                    'data'=>$respuesta,
                    'error'=>''
                ));
            }else{
                echo json_encode(array(
                    'respuesta'=>'100',
                    'estado' => 'No fue posible obtener las listas de datos',
                    'error'=>''
                ));
            }
		}catch(PDOException $e){
			echo json_encode(
				array(
					'respuesta'=>'-1',
					'estado' => 'Ocurrio un error, intentelo más tarde',
					'data'=>'',
					'error'=>$e->getMessage())
			);
		}
	}

?>