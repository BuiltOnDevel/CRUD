<?php

/** O nome do banco de dados*/
define('DB_NAME', 'crud_golaw');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
	define('ABSPATH', ROOT);
	
/** caminho no server para o sistema **/
if ( !defined('BASEURL') )
	define('BASEURL', 'http://127.0.0.1/cliente');
	
/** caminho do arquivo de banco de dados **/
if ( !defined('DBAPI') )
	define('DBAPI', ABSPATH . '/inc/db-set.php');
