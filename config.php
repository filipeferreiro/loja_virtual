<?php 

    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','db_lojavirtual');

    $pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				
    define('ABSOLUT_PATH','/xampp/htdocs/PW_II/loja_virtual/');
    define('INCLUDE_PATH','https://localhost/PW_II/loja_virtual/');
    define('INCLUDE_PATH_CAT','https://localhost/PW_II/loja_virtual/categorias');
    define('INCLUDE_PATH_CONTA','https://localhost/PW_II/loja_virtual/conta');
    define('INCLUDE_PATH_IMG','https://localhost/PW_II/loja_virtual/images');
    define('BASE_DIR',__DIR__);

    $autoload = function($class){
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($autoload);
?>