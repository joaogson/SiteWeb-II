<?php
    class Painel{

        public static $cargos = [
            '0' => 'Normal',
            '1' => 'Sub-administrador',
            '2' => 'Administrador'
        ];

        public static function logado(){
            //Operador ternário
            return isset($_SESSION['login']) ? true : false;
        }

        public static function logout(){
            setcookie('lembrar', true, time() - 3600, '/');
            session_destroy();
            header('Location: '.INCLUDE_PATH_PAINEL);
        }

        public static function loadPage(){
            if(isset($_GET['url'])){
                $url = explode('/', $_GET['url']);
                if(file_exists('pages/'.$url[0].'.php')){
                    include('pages/'.$url[0].'.php');
                }else{
                    header('Location: '.INCLUDE_PATH_PAINEL);
                }
            }else{
                include('pages/home.php');
            }
        }

        public static function deleteUserOnline(){
            $date = date('Y-m-d H:i:s');
            MySql::conectar()->exec("DELETE FROM `tb_admin.online` 
                                     WHERE `ultima_acao` < '$date' - INTERVAL 30 MINUTE");
        }

        public static function listUserOnline(){
            self::deleteUserOnline();
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.online`");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function getUserTotal(){
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
            $sql->execute();
            return $sql->rowCount();
        }

        public static function getUserTotalToday(){
            $sql = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`
                                               WHERE dia = ?");
            $sql->execute(array(date('Y-m-d')));
            return $sql->rowCount();
        }

        public static function messageToUser($type, $message){
            if($type== 'sucesso'){
                echo '<div class="box-alert sucesso"><i class="fa-solid fa-check"></i>'.$message.'</div>';
            } else {
                echo '<div class="box-alert erro"><i class="fa-solid fa-times"></i>'.$message.'</div>';
            }
        }

        public static function validImage($imagem){
            if($imagem['type'] == 'image/jpg' ||
                $imagem['type'] == 'image/png' ||
                $imagem['type'] == 'image/jpeg'){

                    $size = intval($imagem['size']/1024);
                    if($size<500){
                        return true;
                    } else {
                        Painel::messageToUser('erro', 'O tamanho precisa ser menor do que 500kb');
                    }
                }
        }

        public static function uploadFile($file){
            $formatoArquivo = explode('.', $file['name']);
            $nomeImagem = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
            if(move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL.'/uploads'.$file['name'])){
                return $file['name'];
                return false;
            }
        }

        public static function deleteFile($file){
            //@unlink(BASE_DIR_PAINEL.'uploads'.$file);
            @unlink('uploads/'.$file);
        }

        public static function painelUsers(){
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function insert($arr){
            $certo = true;
            $nomeTabela = $arr['nomeTabela'];
            $query = "INSERT INTO `$nomeTabela` VALUES (null";
            foreach($arr as $key => $value){
                $nome = $key;
                if($nome == 'acao' || $nome == 'nomeTabela')
                    continue;
                if($value == ''){
                    $certo = false;
                    break;
                }
                $query.=",?";
                $parametros[] = $value;
            }
            $query.=")";
            if($certo){
                $sql = MySql::conectar()->prepare($query);
                $sql->execute($parametros);
                $lastId = MySql::conectar()->lastInsertId();
                $sql = MySql::conectar()->prepare("UPDATE `$nomeTabela` SET order_id = ? WHERE id = $lastId");
                $sql->execute(array($lastId));
            }
            return $certo;
        }

        public static function getAll($tabela, $start = null, $end = null){
            if($start == null && $end == null){
                $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id DESC");
                $sql->execute();
            } else {
                $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` ORDER BY order_id DESC LIMIT $start, $end");
                $sql->execute();
            }
            return $sql->fetchAll();
        }

        public static function delete($tabela, $id=false){
            if($id == false){
                $sql = MySql::conectar()->prepare("DELETE FROM `'$tabela` WHERE id = ?");
                $sql->execute(array($id));
            }
        }

        public static function redirect($url){
            echo '<script>location.href="'.$url.'"</script>';
            die();
        }

        public static function get($tabela, $query, $arr){
            $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE $query");
            $sql->execute($arr);
            return $sql->fetch();
        }

        public static function update($arr){
            $certo = true;
            $first = false;
            $nomeTabela = $arr['nomeTabela'];
            $query = "UPDATE `$nomeTabela` SET ";
            foreach ($arr as $key => $value) {
                $nome = $key;
                if($nome == 'acao' || $nome == 'nomeTabela' || $nome == 'id'){
                    continue;
                }
                if($value == '') {
                    $certo = false;
                    break;
                }
                if($first == false){
                    $first = true;
                    $query.="$nome=?";
                } else {
                    $query.=",$nome=?";
                }
                $parametros[] = $value;
            }
            if($certo) {
                $parametros[] = $arr['id'];
                $sql = MySql::conectar()->prepare($query.'WHERE id = ?');
                $sql->execute($parametros);
            }
            return $certo;
        }

        public static function orderItem($tabela, $orderType, $id){
            if($orderType == 'up'){
                $infoItemAtual = Painel::get($tabela, 'id=?', array($id));
                $order_id = $infoItemAtual['order_id'];
                $itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela`
                                                        WHERE order_id < $order_id
                                                        ORDER BY order_id DESC
                                                        LIMIT 1");
                $itemBefore->execute();
                if($itemBefore->rowCount() == 0){
                    return;
                }
                $itemBefore = $itemBefore->fetch();
                Painel::update(array('nomeTabela' => $tabela,
                                    'id' => $itemBefore['id'],
                                    'oder_id' => $infoItemAtual['order_id']));
                Painel::update(array('nomeTabela' => $tabela,
                                    'id' => $infoItemAtual['id'],
                                    'order_id' => $itemBefore['order_id']));
            } else if($orderType == 'down'){
                $infoItemAtual = Painel::get($tabela, 'id=?', array($id));
                $order_id = $infoItemAtual['order_id'];
                $itemBefore = MySql::conectar()->prepare("SELECT * FROM `$tabela` WHERE order_id > $order_id ORDER BY order_id ASC LIMIT 1");
                $itemBefore->execute();
                if($itemBefore->rowCount() == 0){
                    return;
                }
                $itemBefore = $itemBefore->fetch();
                Painel::update(array('nomeTabela' => $tabela,
                                    'id' => $itemBefore['id'],
                                    'oder_id' => $infoItemAtual['order_id']));
                Painel::update(array('nomeTabela' => $tabela,
                                    'id' => $infoItemAtual['id'],
                                    'order_id' => $itemBefore['order_id']));
            }
        }
    }
?>