<?php
include 'conf.php';

$con=$GLOBALS['conn'];
class Modelo
	{
	
	var $sinconexion=false;
	var $error="Error de condición.";
 
 	//se instancia la conexión a la base de datos

	// funcion que ejecuta las consultas en la base de datos
	public function Conect($consulta){
		$resultado="";
		if ($this->sinconexion==FALSE) {
			try{				
			 	$resultado= $GLOBALS['conn']->prepare($consulta);
				$resultado->execute();		
			 }catch(PDOException $e){
			 	echo "Error de Conexi&oacute;n";
				$this->sinconexion=true;
			 }
		}
		return $resultado;
	}
	
//============================LOGIN===============================================	
	
	/**
	 *  verificación de usuarios en la base de datos
	 * */
	public function login($user,$pass){
		$pass1=sha1($pass);
		$arrDatos="";
		$consulta =("SELECT * FROM db_persona  WHERE usuario = '{$user}' AND clave = '{$pass1}' LIMIT 1");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}

//======================Catalogos de usuario ===============================================	
/*
 * catalogos de rol de usuario
 */	
	public function getRol(){
		$arrDatos="";
		$consulta =("SELECT * FROM db_nivel_usuario");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
/*
 * catalogos de rol de usuario
 */	
	public function getTipo(){
		$arrDatos="";
		$consulta =("SELECT * FROM db_tipo_persona");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
/*
 * catalogos de usuarios con rol
 */	
	public function getUser(){
		$arrDatos="";
		$consulta =("SELECT p.*, tp.TIPO_PERSONA,nu.NIVEL FROM db_persona p JOIN db_tipo_persona tp ON tp.COD_TIPO_P=p.COD_TIPO_P JOIN db_nivel_usuario nu ON nu.COD_NIVEL=p.COD_NIVEL");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
/*
 * catalogos de usuarios con rol
 */	
	public function getCatedraticos(){
		$arrDatos="";
		$consulta =("SELECT p.NOMBRE, p.APELLIDO, P.COD_PERSONA FROM db_persona p WHERE p.COD_NIVEL=2");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
/*
 * datos del catedratico
 */	
	public function getCatedratico($id){
		$arrDatos="";
		$consulta =("SELECT p.NOMBRE, p.APELLIDO, p.NO_DPI, p.CORREO FROM db_persona p WHERE p.COD_PERSONA=$id");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
	/*
 * datos de estudiantes
 */	
	public function getEstudiante($id){
		$arrDatos="";
		$consulta =("SELECT p.NOMBRE, p.APELLIDO, p.CORREO, p.USUARIO, g.NOMBRE_GRADO, c.NOMBRE_CARRERA FROM db_persona p JOIN db_asig_grado_persona gp ON gp.COD_PERSONA=p.COD_PERSONA JOIN db_grado g ON g.COD_GRADO=gp.COD_GRADO JOIN db_carrera c ON c.COD_CARRERA=g.COD_CARRERA WHERE p.COD_PERSONA=$id");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
/*
 * catalogos de jornadas
 */	
	public function getJornada(){
		$arrDatos="";
		$consulta =("SELECT * FROM db_jornada");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
	/*
 * catalogos de carreras
 */	
	public function getCarrera(){
		$arrDatos="";
		$consulta =("SELECT c.*, j.JORNADA FROM db_carrera c INNER JOIN db_jornada j ON j.COD_JORNADA=c.COD_JORNADA");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}

	
	/*
 * catalogos de carreras y jornadas
 */	
	public function getCarreraJ(){
		$arrDatos="";
		$consulta =("SELECT DISTINCT(j.JORNADA),c.* FROM db_carrera c INNER JOIN db_jornada j ON j.COD_JORNADA=c.COD_JORNADA GROUP BY j.COD_JORNADA");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
/*
 * catalogos de grados
 */	
	public function getGrado(){
		$arrDatos="";
		$consulta =("SELECT g.*, c.NOMBRE_CARRERA,j.JORNADA FROM db_grado g INNER JOIN db_carrera c ON g.COD_CARRERA=c.COD_CARRERA INNER JOIN db_jornada j ON j.COD_JORNADA=c.COD_JORNADA");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
/*
 * catalogos de curso
 */	
	public function getCurso(){
		$arrDatos="";
		$consulta =("SELECT c.*, g.NOMBRE_GRADO FROM db_curso c JOIN db_asig_curso_grado acg ON acg.COD_CURSO=c.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
/*
 * catalogos de unidad
 */	
	public function getUnidad(){
		$arrDatos="";
		$consulta =("SELECT * FROM db_unidad");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}	
/*
 * catalogos de tipo persona
 */	
	public function getTipoP(){
		$arrDatos="";
		$consulta =("SELECT * FROM db_tipo_persona");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}	
/*
 * catalogos de curso
 */	
	public function getCatalogoCurso(){
		$arrDatos="";
		$consulta =("SELECT g.NOMBRE_GRADO, ca.NOMBRE_CARRERA, j.JORNADA, acg.COD_GRADO FROM db_asig_curso_grado acg JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_carrera ca ON ca.COD_CARRERA=g.COD_CARRERA JOIN db_jornada j ON j.COD_JORNADA=ca.COD_JORNADA GROUP BY acg.COD_GRADO");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}
/*
 * catalogos de asignacion de cursos
 */	
	public function getAsigCatedratico(){
		$arrDatos="";
		$consulta =("SELECT acg.COD_CURSO_GRADO, c.NOMBRE_CURSO, p.NOMBRE, p.APELLIDO FROM db_asig_curso_grado acg JOIN db_persona p ON p.COD_PERSONA=acg.COD_PERSONA JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}
		return $arrDatos;
	}	
	
/*
 * catalogos de asignacion de cursos perfil catedratico
 */	
	public function getAsigCatedraticoCurso($id){
		$arrDatos="";
		if($id!=""){
			$consulta =("SELECT acg.COD_CURSO_GRADO, c.NOMBRE_CURSO,c.COD_CURSO, g.NOMBRE_GRADO, g.COD_GRADO ,ca.NOMBRE_CARRERA,ca.COD_CARRERA,j.JORNADA, j.COD_JORNADA, p.NOMBRE, p.APELLIDO FROM db_asig_curso_grado acg JOIN db_persona p ON p.COD_PERSONA=acg.COD_PERSONA JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_carrera ca on ca.COD_CARRERA=g.COD_CARRERA JOIN db_jornada j ON j.COD_JORNADA=ca.COD_JORNADA WHERE acg.COD_PERSONA=".$id." ORDER BY g.COD_GRADO ASC ");
			$result = $this->Conect($consulta);
			if (count($result)>0){
				$arrDatos = $result->fetchAll();
			}
			
			return $arrDatos;
		}
	}		
/*
 * data de tareas por curso asignado a un profesor
 */	
	public function getActividadCurso($id){
		$arrDatos="";
		if($id!=""){
			$consulta =("SELECT pc.COD_CURSO_GRADO, a.NOMBRE_ACTIVIDAD,a.DESCRIPCION_ACTIVIDAD,a.COD_ACTIVIDAD, u.NOMBRE_UNIDAD FROM db_plan_curso pc JOIN db_unidad u ON u.COD_UNIDAD=pc.COD_UNIDAD JOIN db_asig_curso_grado cg ON cg.COD_CURSO_GRADO=pc.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD WHERE pc.COD_CURSO_GRADO=".$id." ORDER BY a.FECHA_ACTIVIDAD DESC");
			$result = $this->Conect($consulta);
			if (count($result)>0){
				$arrDatos = $result->fetchAll();
			}			
			return $arrDatos;
		}
	}
/*
 * catalogos de asignacion de cursos por grado
 */	
	public function getAsigCursoGrado($id){
		$arrDatos="";
		if($id!=""){
			$consulta =("SELECT c.NOMBRE_CURSO,c.COD_CURSO,p.COD_PERSONA,p.NOMBRE,p.APELLIDO, acg.COD_CURSO_GRADO FROM db_curso c JOIN db_asig_curso_grado acg ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_asig_grado_persona agp ON agp.COD_GRADO=g.COD_GRADO JOIN db_persona p ON p.COD_PERSONA=agp.COD_PERSONA WHERE agp.COD_PERSONA=".$id);
			$result = $this->Conect($consulta);
			if (count($result)>0){
				$arrDatos = $result->fetchAll();
			}
			
			return $arrDatos;
		}
	}
/*
 * unidad activa
 */	
	public function getUnidad1(){
		$arrDatos="";		
			$consulta =("SELECT u.* FROM db_unidad u WHERE u.ESTADO_UNIDAD=1");
			$result = $this->Conect($consulta);
			if (count($result)>0){
				$arrDatos = $result->fetchAll();
			}			
			return $arrDatos;		
		}	
	
	//<=============================================================Consultar para la generación de pdf de actividades alumnos=========================================>
	/*
 * actividades por curso
 */	
	public function getActividades($id){
		$arrDatos="";
		if($id!=""){
			$consulta =("SELECT cu.NOMBRE_CURSO, pc.COD_CURSO_GRADO, a.NOMBRE_ACTIVIDAD, a.DESCRIPCION_ACTIVIDAD, a.COD_ACTIVIDAD, u.NOMBRE_UNIDAD, a.FECHA_ACTIVIDAD FROM db_plan_curso pc JOIN db_asig_curso_grado cg ON cg.COD_CURSO_GRADO=pc.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_curso cu ON cu.COD_CURSO=cg.COD_CURSO JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE pc.COD_CURSO_GRADO='$id' AND u.ESTADO_UNIDAD=1 ORDER BY a.FECHA_ACTIVIDAD DESC");
			$result = $this->Conect($consulta);
			if (count($result)>0){
				$arrDatos = $result->fetchAll();
			}
			
			return $arrDatos;
		}
	}
/*
 * punteos de aspectos de actividades
 */	
	public function getActividadesPunteos($id){
		$arrDatos="";
		if($id!=""){
			$consulta =("SELECT asp.DESCRIPCION_ASPECTO, asp.PUNTEO FROM db_aspectos asp JOIN db_rubrica ru ON ru.COD_ASPECTO=asp.COD_ASPECTO JOIN db_actividad ac ON ac.COD_ACTIVIDAD=ru.COD_ACTIVIDAD WHERE ru.COD_ACTIVIDAD=".$id);
			$result = $this->Conect($consulta);
			if (count($result)>0){
				$arrDatos = $result->fetchAll();
			}
			
			return $arrDatos;
		}
	}
/*
 * punteos de actividades
 */	
	public function getPunteos($id){
		$arrDatos="";
		if($id!=""){
			$consulta =("SELECT sum(asp.PUNTEO)total FROM db_aspectos asp JOIN db_rubrica ru ON ru.COD_ASPECTO=asp.COD_ASPECTO WHERE ru.COD_ACTIVIDAD=".$id);
			$result = $this->Conect($consulta);
			if (count($result)>0){
				$arrDatos = $result->fetchAll();
			}
			
			return $arrDatos;
		}
	}
/*
 * Datos generales de los cursos
 */	
	public function getDataCurso($id){
		$arrDatos="";
		if($id!=""){
			$consulta =("SELECT acg.COD_CURSO_GRADO, c.NOMBRE_CURSO, g.NOMBRE_GRADO, ca.NOMBRE_CARRERA, j.JORNADA FROM db_asig_curso_grado acg JOIN db_persona p ON p.COD_PERSONA=acg.COD_PERSONA JOIN db_curso c ON c.COD_CURSO=acg.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_carrera ca ON ca.COD_CARRERA=g.COD_CARRERA JOIN db_jornada j ON j.COD_JORNADA=ca.COD_JORNADA WHERE acg.COD_CURSO_GRADO='$id' ORDER BY g.COD_GRADO ASC ");
			$result = $this->Conect($consulta);
			if (count($result)>0){
				$arrDatos = $result->fetchAll();
			}
			
			return $arrDatos;
		}
	}
//================================================================= datos de grado del estudiantes=========================	
	/*
 * Datos generales de los cursos
 */	
	public function getDataStudent($id){
		$arrDatos="";
		if($id!=""){
			$consulta =("SELECT pe.*,g.NOMBRE_GRADO, c.NOMBRE_CARRERA, j.JORNADA FROM db_persona pe JOIN db_asig_grado_persona gp ON gp.COD_PERSONA=pe.COD_PERSONA JOIN db_grado g ON g.COD_GRADO=gp.COD_GRADO JOIN db_carrera c ON c.COD_CARRERA=g.COD_CARRERA JOIN db_jornada j ON j.COD_JORNADA=c.COD_JORNADA WHERE pe.COD_PERSONA='$id'");
			$result = $this->Conect($consulta);
			if (count($result)>0){
				$arrDatos = $result->fetchAll();
			}			
			return $arrDatos;
		}
	}			
	

	/*
 * Datos generales de los alumnos de un grado
 */	
	public function getDataStudentReport($jornada,$carrera,$grado){
		$arrDatos="";
		if($jornada!=""){
			$consulta =("SELECT pe.*,g.NOMBRE_GRADO, c.NOMBRE_CARRERA, j.JORNADA FROM db_persona pe JOIN db_asig_grado_persona gp ON gp.COD_PERSONA=pe.COD_PERSONA JOIN db_grado g ON g.COD_GRADO=gp.COD_GRADO JOIN db_carrera c ON c.COD_CARRERA=g.COD_CARRERA JOIN db_jornada j ON j.COD_JORNADA=c.COD_JORNADA WHERE j.COD_JORNADA='$jornada' AND c.COD_CARRERA='$carrera'  AND g.COD_GRADO='$grado'");
			$result = $this->Conect($consulta);
			if (count($result)>0){
				$arrDatos = $result->fetchAll();
			}			
			return $arrDatos;
		}
	}	
	/*
 * Datos generales de los alumnos de un grado
 */	
	public function getCountUnity(){
		$arrDatos="";		
		$consulta =("SELECT COUNT(u.COD_UNIDAD)numero FROM db_unidad  u");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}			
		return $arrDatos;		
	}	
	/*
 * Datos del cuadro de Honor por grado
 */	
	public function getCuadrodeHonor($g,$u){
		$arrDatos="";		
		$consulta =("SELECT pe.NOMBRE, pe.APELLIDO, a.NOMBRE_ACTIVIDAD, a.COD_UNIDAD, sum(aag.NOTA) nota FROM db_curso cu JOIN db_asig_curso_grado acg ON acg.COD_CURSO=cu.COD_CURSO JOIN db_grado g ON g.COD_GRADO=acg.COD_GRADO JOIN db_plan_curso pc ON pc.COD_CURSO_GRADO=acg.COD_CURSO_GRADO JOIN db_actividad a ON a.COD_ACTIVIDAD=pc.COD_ACTIVIDAD JOIN db_asig_acti_grado aag ON aag.COD_ACTIVIDAD=a.COD_ACTIVIDAD JOIN db_asig_grado_persona gp ON gp.COD_ASIG_GRADO_P=aag.COD_ASIG_GRADO_P LEFT JOIN db_persona pe ON pe.COD_PERSONA=gp.COD_PERSONA JOIN db_unidad u ON u.COD_UNIDAD=a.COD_UNIDAD WHERE g.COD_GRADO=".$g." AND u.COD_UNIDAD=".$u." GROUP BY pe.COD_PERSONA ORDER BY nota DESC LIMIT 10");
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}			
		return $arrDatos;		
	}
		/*
 * Datos del cuadro de Honor por grado
 */	
	public function getNocursos($g){
		$arrDatos="";		
		$consulta =("SELECT COUNT(c.COD_CURSO)cursos FROM db_curso c JOIN db_asig_curso_grado ac ON ac.COD_CURSO=c.COD_CURSO WHERE ac.COD_GRADO=".$g);
		$result = $this->Conect($consulta);
		if (count($result)>0){
			$arrDatos = $result->fetchAll();
		}			
		return $arrDatos;		
	}	
	
}


?>