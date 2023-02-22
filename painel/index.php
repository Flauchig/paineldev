<?php

include('../config.php');


?>








<?php
if(Painel::logado()== false){
    include('login.php');


}else {

    
    include('main.php');
    Online::userOnline();
    Online::contador();
  
    
}

?>





