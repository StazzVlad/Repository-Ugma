<?php

    // Conexion a la base de datos //
    function conexion(){
		try {
			$pdo = new PDO('mysql:host=127.0.0.1:33065;dbname=repositorio', 'root', '');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'Error de conexión: ' . $e->getMessage();
		}
		return $pdo;
	}
	

    # Limpiar cadenas de texto #
	function limpiar_cadena($cadena){
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		$cadena=str_ireplace("<script>", "", $cadena);
		$cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
	}

    # Verificar datos #
	function verificar_datos($filtro,$cadena){
		if(preg_match("/^".$filtro."$/", $cadena)){
			return false;
        }else{
            return true;
        }
	}

	function paginadora_trabajos($pagina,$nregistros,$query,$nombre_listado,$lq=null,$ctipo=null,$cfacultad=null,$ccarrera=null){

		//Variables iniciales//
			$tabla=" ";
			//Pagina actual//
			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			//Inicio del registro//
			$inicio = ($pagina>0) ? (($pagina * $nregistros)-$nregistros) : 0;


		//Concatenar a la Query el limite de inicio y numero de registros a montrar//
			$query.=" LIMIT ".$inicio.",".$nregistros;

		//Conexion BD y obtener los registros//
			$conectar = conexion();
			$cone = $conectar->query($query);
		//Obtener el total de registros//
			$total= $conectar->query("SELECT FOUND_ROWS()");
			$total= (int) $total->fetchColumn();

		//Calcular los n registros a enseñar y el total de todas las paginas// 
			$enseniar = min($nregistros,$total-$inicio);

			$total_paginas = ceil($total/$nregistros);
		//Contador de registro montado en html//
			$count=0;
		//Concatenar el numero de registros enseñados sobre el total de registros//
			$tabla.="<p class='coincidencias'> Enseñando ".$enseniar." de ".$total ." coincidencias</p>";
		//WHILE que crea cada box de registro//
			while($row = $cone->fetch(PDO::FETCH_ASSOC)){
				$tabla .= '<div class="listado-contenedor">
                <div class="listado">
                    <div class="listadoizq">
                        <img src="imagen.jpg" alt="">
                    </div>
                
                    <div class="listadoder">

                        <div class="descripcion">
                            <p>Titulo: <span>'.$row['trabajo_titulo'].'</span></p>
                            <br>
                            <p>Autor: <span>'.$row["autor_nombre"].'</span></p>
                            <p>Carrera: <span>'.$row["carrera_nombre"].'</span></p>
                            <p>Area de investigacion: <span>'.$row["area_nombre"].'</span></p>
                        </div>
                    </div>
                </div>
				</div>';
				$count++;
			}
		//IF para concatenar al final si no hay mas registros en la pagina//
			if($count<$nregistros){
				$tabla.="<p class='coincidencias'> No hay mas registros por aqui</p>";
			}
		//Concatenar botones de paginacion//

			$tabla.='<br>';
			$tabla.= '<div class="botones-paginadora">';
			//Variables de Clase, categorias y q//
			$clase="";
			$categorias="";
			$q="";

			//Asignar categorias si las hay//
			if(isset($ctipo)){
				$categorias.='&tipo='.$ctipo;
			}
			if(isset($cfacultad)){
				$categorias.='&facultad='.$cfacultad;
			}
			if(isset($ccarrera)){
				$categorias.='&carrera='.$ccarrera;
			}

			//Asignar q//
			if(isset($lq)){
				$q.='&q='.$lq;
			}

			//FOR que crea los botones//
			for($i=1;$i<=$total_paginas;$i++){

				//Asignacion de tipo de boton con respecto a la pagina actual//
				if($pagina==$i){
					$clase='class="boton_p"';
				} else {
					$clase='class="boton"';
				}


				//Concatenacion resultante de botones de la paginadora//
				$tabla.= '<a type="button" '.$clase.' href="/Repository-Ugma-main/'.$nombre_listado.'.php?p='.$i.$categorias.$q.'" >'.$i.'</a>
					';
			}
			$tabla.= '</div>';
		//Retornar HTML resultante//
			return $tabla;
	}