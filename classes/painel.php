<?php

class Painel
{

    public static  $cargos = [
        '0' => 'Usuario',
        '1' => 'Gerente',
        '2' => 'Administrador'
    ];

    public static function logado()
    {
        return isset($_SESSION['login']) ? true : false;
        // É uma forma curta de escrever um if-else em uma única linha.

    }

    public static function loggout()

    {
        setcookie('lembrar', true, time() - 1, '/');
        // aqui serve para limpar os cookies
        session_destroy();

        header('location:' . INCLUDE_PATH_PAINEL);
    }


    public static function carregarPagina()
    {
        // Verifica se a variável $_GET['url'] existe
        if (isset($_GET['url'])) {
            // Divide a string em um array usando / como delimitador
            $url = explode('/', $_GET['url']);
            // Verifica se o arquivo correspondente a primeira parte da URL existe na pasta pages/
            if (file_exists('pages/' . $url[0] . '.php')) {
                // Inclui o arquivo na página
                include('pages/' . $url[0] . '.php');
            } else {
                // Redireciona para uma página padrão especificada em INCLUDE_PATH_PAINEL
                header('location:' . INCLUDE_PATH_PAINEL);
            }
        } else {
            // Inclui a página home.php por padrão
            include('pages/home.php');
        }
    }

    public static function mostrarOnline()
    {

        self::limparOnline();
        $sql = Mysql::conectar()->prepare("SELECT * FROM tb_admin_online");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function limparOnline()

    {
        $date = date('Y-m-d H:i:s');
        // Iniciando a variável $sql com uma string de consulta SQL
        $sql = Mysql::conectar()->exec("DELETE FROM tb_admin_online WHERE ultima_acao < DATE_SUB('$date', INTERVAL 2 MINUTE)");

        // A consulta SQL acima exclui todas as linhas na tabela `tb_admin_online`
        // onde o valor na coluna `ultima_acao` é menor do que a data atual menos um minuto ou podemos alterar para dias .
        // A função `DATE_SUB` é usada para subtrair um minuto da data atual.
        // A variável `$date` armazena a data atual e é passada como parâmetro para a consulta.

    }

    public static function alert($tipo, $mensagem)
    {
        if ($tipo == 'sucesso') {
            echo '<div class=" box-alert sucesso">' . $mensagem . '</div>';
        } elseif ($tipo == 'erro') {

            echo '<div class=" box-alert erro">' . $mensagem . '</div>';
        }
    }
    public static function imagemValida($imagem)
    {
        if (
            $imagem['type'] == 'image/jpeg' ||
            $imagem['type'] == 'image/jpg' ||
            $imagem['type'] == 'image/png'
        ) {
            // aqui estou definindo o tipo de imagem que vou permitir para o usuário fazer o upload 
            $tamanho = intval($imagem['size'] / 1024);
            if ($tamanho < 300)
                return true;
            else
                return false;
            // Aqui eu estou definindo o tamnho da imagem que  o usuário pode fazr upload para não carregar os servidores 
        } else {
            return false;
        }
    }



    public static function uploadFile($file)
    {
        $formatoArquivo = explode('.', $file['name']);
        $imagemNome = uniqid() . '.' . $formatoArquivo[count($formatoArquivo) - 1];
        if (move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL . '/uploads/' . $imagemNome)) {

            return $imagemNome;
        } else {
            return false;
        }
    }
    public static function deleteFile($file)
    {
        @unlink('/uploads/' . $file);
    }


    public static function insert($arr)
    {
        // Variável booleana que indica se os dados são válidos e podem ser inseridos no banco de dados
        $certo = true;

        // Recupera o nome da tabela a partir do array
        $nome_tabela = $arr['nome_tabela'];

        // Inicia a string de consulta com a cláusula "INSERT INTO" e especifica que o primeiro valor será "null"
        $query = "INSERT INTO $nome_tabela  VALUES(null";

        // Loop através dos elementos do array
        foreach ($arr as $key => $value) {
            // Armazena o nome e o valor do elemento
            $nome = $key;
            $valor = $value;

            // Se o nome for "acao" ou "nome_tabela", pula para o próximo elemento
            if ($nome == 'acao' || $nome == 'nome_tabela')
                continue;
            // Se o valor estiver vazio, a inserção não será realizada
            if ($value == '') {
                $certo = false;
                break;
            }
            // Adiciona o valor à consulta como um parâmetro (marcado com "?")
            $query .= ",?";
            $parametros[] = $value;
        }

        // Fecha a consulta
        $query .= ")";

        // Se todos os dados são válidos, prepara e executa a consulta
        if ($certo == true) {
            $sql = Mysql::conectar()->prepare($query);
            $sql->execute($parametros);
        }

        // Retorna o resultado da validação dos dados
        return $certo;
    }


    public static function selectAll($tabela, $start = null, $end = null)
    {
        if ($start == null && $end == null) 
            $sql = Mysql::conectar()->prepare("SELECT * FROM $tabela");
         else 
            $sql = Mysql::conectar()->prepare("SELECT * FROM $tabela LIMIT $start,$end" );
            
            $sql->execute();
        
        
        return $sql->fetchAll();

        // esta função estatica esta sendo usada para listar os serviços do usuário 
    }

    public static function deleteServico($tabela, $id=false ){

        if($id==false){
            $sql = Mysql::conectar()->prepare("DELETE FROM $tabela");

        }else{
            $sql = Mysql::conectar()->prepare("DELETE FROM $tabela WHERE id = $id");

        }

        $sql->execute(); 

        // este comando pega o uxuario pelo id e deleta ele da tabela assim evitando deletar todos 

    }


    public static function redirect($url){
        echo "<script>location.href='".$url."';</script>";
        die(); 

        // aqui é uma função php  que esta chamando um script em js criando um redirecionamento ou seja va ficar na mesma pagina. 
    }


    public static function serviceSelect($table, $query,$arr){
        // este é um metedo especifico para selecionar um registro 
        
        $sql = Mysql::conectar()->prepare("SELECT* FROM $table WHERE $query ");
        $sql ->execute($arr);
        return $sql->fetch(); 


    }
    
    public static function updateService($arr){
        // Variável booleana que indica se os dados são válidos e podem ser inseridos no banco de dados
        $certo = true;
        $first =false;
    
        // Recupera o nome da tabela a partir do array
        $nome_tabela = $arr['nome_tabela'];
    
        // Inicia a string de consulta com a cláusula "UPDATE" 
        $query = "UPDATE $nome_tabela SET";
        
        // Loop através dos elementos do array
        foreach ($arr as $key => $value) {
            // Armazena o nome e o valor do elemento
            $nome = $key;
            $valor = $value;
    
            // Se o nome for "acao" ou "nome_tabela" ou "id", pula para o próximo elemento
            if ($nome == 'acao' || $nome == 'nome_tabela' || $nome =='id')
                continue;
            
            // Se o valor estiver vazio, a atualização não será realizada
            if ($value == '') {
                $certo = false;
                break;
            }
    
            // Adiciona o valor à consulta como um parâmetro (marcado com "?")
            if($first == false){
                $first = true;
                $query .= " $nome = ?";
            } else {
                $query .= ", $nome = ?";
            }
    
            $parametros[] = $value;
        }
    
        // Adiciona o parâmetro do ID ao array de parâmetros
        $parametros[] = $arr['id'];
    
        // Fecha a consulta com a cláusula WHERE
        $query .= " WHERE id = ?";
    
        // Se todos os dados são válidos, prepara e executa a consulta
        if ($certo == true) {
            $sql = Mysql::conectar()->prepare($query);
            $sql->execute($parametros);
        }
    
        // Retorna o resultado da validação dos dados
        return $certo;
    }
}
