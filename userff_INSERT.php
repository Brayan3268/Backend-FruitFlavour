<?php
	require 'SQLGlobal.php';

	if($_SERVER['REQUEST_METHOD']=='POST'){
		try{
			$datos = json_decode(file_get_contents("php://input"),true);

			$idCard = $datos["idCard"]; // obtener parametros POST
			$nameUser = $datos["nameUser"];
			$lastNameUser = $datos["lastNameUser"];
            $email = $datos["email"];
            $cellphone = $datos["cellphone"];
            $passwordUser = $datos["passwordUser"];
            $image = $datos["image"];

            $respuesta = SQLGlobal::cudFiltro(
				"insert into userff(idCard, nameUser, lastNameUser, email, cellphone, 
                passwordUser, image) values (?, ?, ?, ?, ?, ?, ?);",
				array($idCard, $nameUser, $lastNameUser, $email, $cellphone, $passwordUser,
                $image)
			);//con filtro ("El tamaño del array debe ser igual a la cantidad de los '?'")
            if($respuesta > 0){
                echo json_encode(array(
                    'respuesta'=>'200',
                    'estado' => 'Se agrego correctamente la idea',
                    'data'=> 'El numero de registros afectados son: '.$respuesta,
                    'error'=>''
                ));
            }else{
                echo json_encode(array(
                    'respuesta'=>'100',
                    'estado' => 'No se agrego correctamente la idea',
                    'data'=> 'El numero de registros afectados son: '.$respuesta,
                    'error'=>''
                ));
            }

		}catch(PDOException $e){
			echo json_encode(
				array(
					'respuesta'=>'-1',
					'estado' => 'Ocurrio un error, intentelo mas tarde',
					'data'=>'',
					'error'=>$e->getMessage())
			);
		}
	}
?>