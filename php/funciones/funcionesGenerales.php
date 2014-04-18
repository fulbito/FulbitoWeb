<?php

// Abre la pagina en el tiempo requerido
function abrirPagina($url,$tiempo)
{
  print "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"$tiempo; URL=$url\">";
}

// Se utiliza en RECUPERAR PASSWORD.PHP
function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
{
    $source = 'abcdefghijklmnopqrstuvwxyz';
    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if($n==1) $source .= '1234567890';
    if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
    if($length>0){
        $rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=$length; $i++){
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source[$num-1];
        }
 
    }
    return $rstr;
}

// Redimensiona las fotos de los usuarios
function redimensionar_imagen($imagen, $nombre_imagen_asociada)
{
//$directorio = "../../imagenes/thumbnails/" ;
//$directorio = "./thumbnails/" ;

//$directorio= realpath('images/thumbnails/').'\\'; // CAMBIAR PATH CUANDO TERMINE OBJETOS 2
$directorio= './images/thumbnails/'; // CAMBIAR PATH CUANDO TERMINE OBJETOS 2
//establecemos los límites de ancho y alto
$nuevo_ancho = 134 ;
$nuevo_alto = 101 ;

//echo $directorio."ss";

//Recojo información de la imágen
$info_imagen = getimagesize($imagen);
$alto = $info_imagen[1];
$ancho = $info_imagen[0];
$tipo_imagen = $info_imagen[2];

//Determino las nuevas medidas en función de los límites
if($ancho > $nuevo_ancho OR $alto > $nuevo_alto)
{
	//echo "aaaaaaaa";
	
	if(($alto - $nuevo_alto) > ($ancho - $nuevo_ancho))
	{
	$nuevo_ancho = round($ancho * $nuevo_alto / $alto,0) ;
	}
	else
	{
	$nuevo_alto = round($alto * $nuevo_ancho / $ancho,0);
	}
}
else //si la imagen es más pequeña que los límites la dejo igual.
{
	$nuevo_alto = $alto;
	$nuevo_ancho = $ancho;
}

// dependiendo del tipo de imagen tengo que usar diferentes funciones
switch ($tipo_imagen) {
	case 1: //si es gif ...
			$imagen_nueva = imagecreate($nuevo_ancho, $nuevo_alto);
			$imagen_vieja = imagecreatefromgif($imagen);
			//cambio de tamaño...
			imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
			if (!imagegif($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
			break;

	case 2: //si es jpeg ...
			$imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
			$imagen_vieja = imagecreatefromjpeg($imagen);
			//cambio de tamaño...
			imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
			if (!imagejpeg($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
			break;

	case 3: //si es png ...
			$imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
			$imagen_vieja = imagecreatefrompng($imagen);
			//cambio de tamaño...
			imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
			if (!imagepng($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
			break;
}

return true; //si todo ha ido bien devuelve true
}

// ------------- FORMATEAR lA FECHA ------///


function formatear_fecha($fecha, $tipo)
{
  if($tipo == 1) //Formato AAAA-MM-DD
  {
    $fecha_aux = explode('-',$fecha);
    if(count($fecha_aux)<3)
    {
        $fecha_aux = explode('/',$fecha);
    }
    if(count($fecha_aux)<3)
    {
        return $fecha;
    }

    if(strlen($fecha_aux[0])>2)
    {
        $fecha_final = $fecha_aux[0].'-'.$fecha_aux[1].'-'.$fecha_aux[2];
    }
    else
        $fecha_final = $fecha_aux[2].'-'.$fecha_aux[1].'-'.$fecha_aux[0];
  }
  else  //Formato DD-MM-AAAA
  {
    $fecha_aux = explode('-',$fecha);
    if(count($fecha_aux)<3)
    {
        $fecha_aux = explode('/',$fecha);
    }
    if(count($fecha_aux)<3)
    {
        return $fecha;
    }

    if(strlen($fecha_aux[0])>2)
    {
        $fecha_final = $fecha_aux[2].'-'.$fecha_aux[1].'-'.$fecha_aux[0];
    }
    else
        $fecha_final = $fecha_aux[0].'-'.$fecha_aux[1].'-'.$fecha_aux[2];
  }

  return $fecha_final;
}


function esVacio($variable)
{
  if(isset($variable) && !empty($variable) )
      return   "'".$variable."'";
  else
      return 'NULL';

}
=======
<?php

// Abre la pagina en el tiempo requerido
function abrirPagina($url,$tiempo)
{
  print "<META HTTP-EQUIV=\"Refresh\"  CONTENT=\"$tiempo; URL=$url\">";
}

// Se utiliza en RECUPERAR PASSWORD.PHP
function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
{
    $source = 'abcdefghijklmnopqrstuvwxyz';
    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if($n==1) $source .= '1234567890';
    if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
    if($length>0){
        $rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=$length; $i++){
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source[$num-1];
        }
 
    }
    return $rstr;
}

// Redimensiona las fotos de los usuarios
function redimensionar_imagen($imagen, $nombre_imagen_asociada)
{
//$directorio = "../../imagenes/thumbnails/" ;
//$directorio = "./thumbnails/" ;

//$directorio= realpath('images/thumbnails/').'\\'; // CAMBIAR PATH CUANDO TERMINE OBJETOS 2
$directorio= './images/thumbnails/'; // CAMBIAR PATH CUANDO TERMINE OBJETOS 2
//establecemos los límites de ancho y alto
$nuevo_ancho = 134 ;
$nuevo_alto = 86 ;

//echo $directorio."ss";

//Recojo información de la imágen
$info_imagen = getimagesize($imagen);
$alto = $info_imagen[1];
$ancho = $info_imagen[0];
$tipo_imagen = $info_imagen[2];

//Determino las nuevas medidas en función de los límites
if($ancho > $nuevo_ancho OR $alto > $nuevo_alto)
{
	//echo "aaaaaaaa";
	
	if(($alto - $nuevo_alto) > ($ancho - $nuevo_ancho))
	{
	$nuevo_ancho = round($ancho * $nuevo_alto / $alto,0) ;
	}
	else
	{
	$nuevo_alto = round($alto * $nuevo_ancho / $ancho,0);
	}
}
else //si la imagen es más pequeña que los límites la dejo igual.
{
	$nuevo_alto = $alto;
	$nuevo_ancho = $ancho;
}

// dependiendo del tipo de imagen tengo que usar diferentes funciones
switch ($tipo_imagen) {
	case 1: //si es gif ...
			$imagen_nueva = imagecreate($nuevo_ancho, $nuevo_alto);
			$imagen_vieja = imagecreatefromgif($imagen);
			//cambio de tamaño...
			imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
			if (!imagegif($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
			break;

	case 2: //si es jpeg ...
			$imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
			$imagen_vieja = imagecreatefromjpeg($imagen);
			//cambio de tamaño...
			imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
			if (!imagejpeg($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
			break;

	case 3: //si es png ...
			$imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
			$imagen_vieja = imagecreatefrompng($imagen);
			//cambio de tamaño...
			imagecopyresampled($imagen_nueva, $imagen_vieja, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
			if (!imagepng($imagen_nueva, $directorio . $nombre_imagen_asociada)) return false;
			break;
}

return true; //si todo ha ido bien devuelve true
}

// ------------- FORMATEAR lA FECHA ------///


function formatear_fecha($fecha, $tipo)
{
  if($tipo == 1) //Formato AAAA-MM-DD
  {
    $fecha_aux = explode('-',$fecha);
    if(count($fecha_aux)<3)
    {
        $fecha_aux = explode('/',$fecha);
    }
    if(count($fecha_aux)<3)
    {
        return $fecha;
    }

    if(strlen($fecha_aux[0])>2)
    {
        $fecha_final = $fecha_aux[0].'-'.$fecha_aux[1].'-'.$fecha_aux[2];
    }
    else
        $fecha_final = $fecha_aux[2].'-'.$fecha_aux[1].'-'.$fecha_aux[0];
  }
  else  //Formato DD-MM-AAAA
  {
    $fecha_aux = explode('-',$fecha);
    if(count($fecha_aux)<3)
    {
        $fecha_aux = explode('/',$fecha);
    }
    if(count($fecha_aux)<3)
    {
        return $fecha;
    }

    if(strlen($fecha_aux[0])>2)
    {
        $fecha_final = $fecha_aux[2].'-'.$fecha_aux[1].'-'.$fecha_aux[0];
    }
    else
        $fecha_final = $fecha_aux[0].'-'.$fecha_aux[1].'-'.$fecha_aux[2];
  }

  return $fecha_final;
}
?>
