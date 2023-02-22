<?php

// mais para frente fazer a variavel global com os cargos 

session_start(); 

date_default_timezone_set('America/Sao_Paulo');


$autoload = function ($class) {
 include('classes/'.$class.'.php');
    
    // essa é uma função que inclui arquivos baseado  na classe que foi passada por argumento 
    // no caso estou chamando as classses aqui com 
};

spl_autoload_register($autoload);

// serve  para carregar automaticamente as classes 
// ou seja não é necessario ficar dando include em cada pagina 

define('INCLUDE_PATH','http://localhost/paineldev/');
define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
define('BASE_DIR_PAINEL',__DIR__.'/painel' );
define('HOST','localhost');
define('USER','root');
define('PASSWORD','');
define('DATABASE','projeto01');

// serve Para definir um caminho especifico 

    // funções de cargos

    function pegaCargo ($indice) {
      
        return Painel::$cargos[$indice];

        }

        // aqui eu usei uma função com array para definir os cargos de acordo com o numero  no banco de dados. 


     function verificaPermissaoMenu($permissao){
        if($_SESSION['cargo'] >= $permissao){
           return;

        }else{
            echo 'style="display:none"';
        }
     }

     function verificaPermissaoPagina($permissao){

        if($_SESSION['cargo'] >= $permissao){
            return;
 
         }else{
             include('painel/pages/permissao_negada.php');
             die();
         }

     }


?>


