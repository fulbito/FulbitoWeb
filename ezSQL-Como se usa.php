<?
// ------------------- ezSQL functions

$db->get_results // get multiple row result set from the database (or previously cached results)
$db->get_row  // get one row from the database (or previously cached results)
$db->get_col // get one column from query (or previously cached results) based on column offset
$db->get_var // get one variable, from one row, from the database (or previously cached results)
$db->query // send a query to the database (and if any results, cache them)
$db->debug // print last sql query and returned results (if any)
$db->vardump // print the contents and structure of any variable
$db->select // select a new database to work with
$db->get_col_info // get information about one or all columns such as column name or type
$db->hide_errors // turn ezSQL error output to browser off
$db->show_errors // turn ezSQL error output to browser on
$db->escape // Format a string correctly to stop accidental mal formed queries under all PHP conditions
$db = new db // Initiate new db object.

// ------------------- ezSQL variables

$db->num_rows // Number of rows that were returned (by the database) for the last query (if any)
$db->insert_id // ID generated from the AUTO_INCRIMENT of the previous INSERT operation (if any)
$db->rows_affected // Number of rows affected (in the database) by the last INSERT, UPDATE or DELETE (if any)
$db->num_queries // Keeps track of exactly how many 'real' (not cached) queries were executed during the lifetime of the current script
$db->debug_all // If set to true (i.e. $db->debug_all = true;) Then it will print out ALL queries and ALL results of your script.
$db->cache_dir // Path to mySQL caching dir.
$db->cache_queries // Boolean flag (see mysql/disk_cache_example.php)
$db->cache_inserts // Boolean flag (see mysql/disk_cache_example.php)
$db->use_disk_cache // Boolean flag (see mysql/disk_cache_example.php)
$db->cache_timeout // Number in hours (see mysql/disk_cache_example.php)

Detaylar : http://blog.rakkoc.com/2012/06/ezsql-samples/#ixzz2xTPppkB6


/*----------------------------------------------------------------------------------
---------------------------------- CONEXION --------------- -----------------------
------------------------------------------------------------------------------------*/

include_once "../shared/ez_sql_core.php";
include_once "ez_sql_mysql.php";
$db = new ezSQL_mysql('usuario_db','contraseña_db','nombre_db','host_db');

/*------------------------------------------------------------------------------------
---------------------------------- OBTENER DATOS ( SELECT ) -----------------------
------------------------------------------------------------------------------------*/

//----- MUCHAS FILAS ----------------
$usuarios = $db->get_results("SELECT nombre, email FROM u_usuarios"); 

foreach ( $usuarios as $user )
{
	echo $user->name;
	echo $user->email;
}

if(!empty($usuarios)) // Comprobar que no este vacio


//----- UNA FILA ----------------
$usuario = $db->get_row("SELECT nombre,email FROM u_usuarios WHERE id = 2");
echo $usuario->nombre;
echo $usuario->email;

//----- UNA VARIABLE ----------------
$var = $db->get_var("SELECT count(*) FROM users");
echo $var;

//------ UNA COLUMNA ----------------

// Get 'one column' (based on index) from a query..
$names = $db->get_col("SELECT name,email FROM users",0)

foreach ( $names as $name )
{
	echo $name;
}

// Get another column from the previous (cached) query results..
$emails = $db->get_col(null,1)

foreach ( $emails as $email )
{
	echo $email;
}

/*-----------------------------------------------------------------------------------
---------------------------------- INSERTAR DATOS ( INSERT ) -----------------------
------------------------------------------------------------------------------------*/

$db->query("INSERT INTO users (id, name, email) VALUES (NULL,'Justin','jv@foo.com')");

/*-----------------------------------------------------------------------------------
---------------------------------- ACTUAIZAR DATOS ( UPDATE ) -----------------------
------------------------------------------------------------------------------------*/

$db->query("UPDATE users SET name = 'Justin' WHERE id = 2)");

/*-----------------------------------------------------------------------------------
---------------------------------- BORRAR DATOS ( DELET ) -----------------------
------------------------------------------------------------------------------------*/

$delete_user = $db->query("DELETE FROM users WHERE id='$user'");

/*-----------------------------------------------------------------------------------
----------------------------------   DEBUGEAR -----------------------
------------------------------------------------------------------------------------*/

$db->debug(); // muestra la ultima consulta y su resultad
$db->vardump($results) // muestra toda la estructura de la base y el resultado de la consulta o variables

// Map out the full schema of any given database..
$db->select("my_database");

foreach ( $db->get_col("SHOW TABLES",0) as $table_name )
{
	$db->debug();
	$db->get_results("DESC $table_name");
}

$db->debug();

?>