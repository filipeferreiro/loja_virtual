<?php 

    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','db_lojavirtual');

    $pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				

    define('INCLUDE_PATH','https://localhost/PW_II/loja_virtual/');
?>