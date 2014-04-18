<?php
// Clases
include_once "../clases/ezSQL-master/shared/ez_sql_core.php"; // Include ezSQL core (BD)
include_once "../clases/ezSQL-master/mysql/ez_sql_mysql.php"; // Include ezSQL mysql
 
// Conexion de la BD
include_once "../conexionBD.php";
include_once "../funciones/funcionesGenerales.php";
$tiempo = '0';
$locationHome = './home.php';
$locationIndex = './index.php';


	global $db;

	$correo= $_GET['correo'];
	$clave= md5($_GET['clave']);
	
	$usuario = $db->get_row("SELECT * FROM USUARIO WHERE MAIL = '$correo' AND PASSWORD  = '$clave' "); // --------- buscar usuario ---
	//$db->debug();

	$email = $usuario->MAIL; 

	// --------- Filas insertadas ----------
	if($db->num_rows > 0){
	    $aux['id'] = $usuario->ID;
        $aux['alias'] = $usuario->ALIAS;
        $aux['mail'] = $usuario->MAIL;
		$return["error"] = FALSE;
        $return["data"] = $aux;
	}
	else{
		$return["error"] = TRUE;
        $return["data"] = "Usuario invalido";
	}


if (function_exists('json_encode'))
{
    print json_encode($return);
}
else
{
    print __json_encode($return);
}


function __json_encode( $data )
{
    if( is_array($data) || is_object($data) ) {
        $islist = is_array($data) && ( empty($data) || array_keys($data) === range(0,count($data)-1) );

        if( $islist ) {
            $json = '[' . implode(',', array_map('__json_encode', $data) ) . ']';
        } else {
            $items = Array();
            foreach( $data as $key => $value ) {
                $items[] = __json_encode("$key") . ':' . __json_encode($value);
            }
            $json = '{' . implode(',', $items) . '}';
        }
    } elseif( is_string($data) ) {
        # Escape non-printable or Non-ASCII characters.
        # I also put the \\ character first, as suggested in comments on the 'addclashes' page.
        $string = '"' . addcslashes($data, "\\\"\n\r\t/" . chr(8) . chr(12)) . '"';
        $json    = '';
        $len    = strlen($string);
        # Convert UTF-8 to Hexadecimal Codepoints.
        for( $i = 0; $i < $len; $i++ ) {

            $char = $string[$i];
            $c1 = ord($char);

            # Single byte;
            if( $c1 <128 ) {
                $json .= ($c1 > 31) ? $char : sprintf("\\u%04x", $c1);
                continue;
            }

            # Double byte
            $c2 = ord($string[++$i]);
            if ( ($c1 & 32) === 0 ) {
                $json .= sprintf("\\u%04x", ($c1 - 192) * 64 + $c2 - 128);
                continue;
            }

            # Triple
            $c3 = ord($string[++$i]);
            if( ($c1 & 16) === 0 ) {
                $json .= sprintf("\\u%04x", (($c1 - 224) <<12) + (($c2 - 128) << 6) + ($c3 - 128));
                continue;
            }

            # Quadruple
            $c4 = ord($string[++$i]);
            if( ($c1 & 8 ) === 0 ) {
                $u = (($c1 & 15) << 2) + (($c2>>4) & 3) - 1;

                $w1 = (54<<10) + ($u<<6) + (($c2 & 15) << 2) + (($c3>>4) & 3);
                $w2 = (55<<10) + (($c3 & 15)<<6) + ($c4-128);
                $json .= sprintf("\\u%04x\\u%04x", $w1, $w2);
            }
        }
    } else {
        # int, floats, bools, null
        $json = strtolower(var_export( $data, true ));
    }
    return $json;
}
?>