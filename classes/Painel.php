<?php
    class Painel
    {
        public static function imagemValida($imagem){
			if($imagem['type'] == 'image/jpeg' ||
				$imagem['type'] == 'image/jpg' ||
				$imagem['type'] == 'image/png'){

				$tamanho = intval($imagem['size']/1024);
				if($tamanho < 1000)
					return true;
				else
					return false;
			}else{
				return false;
			}
		}

		public static function uploadFile($file){
			$formatoArquivo = explode('.',$file['name']);
			$imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
			if(move_uploaded_file($file['tmp_name'],BASE_DIR.'/images/'.$imagemNome))
				return $imagemNome;
			else
				return false;
		}

        private static $pdo;

		public static function conectar(){
			if(self::$pdo == null){
				try{
				self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				}catch(Exception $e){
					echo '<h2>Erro ao conectar</h2>';
				}
			}

			return self::$pdo;
		}

        public static function deleteFile($file){
			unlink(ABSOLUT_PATH.'images/'.$file);
		}

        public static function deletar($tabela,$id=false){
			if($id == false){
				$sql = Painel::conectar()->prepare("DELETE FROM `$tabela`");
			}else{
				$sql = Painel::conectar()->prepare("DELETE FROM `$tabela` WHERE cod_livro = $id");
			}
			$sql->execute();
		}

        public static function redirect($url){
			echo '<script>location.href="'.$url.'"</script>';
			die();
		}

        public static function alertJS($msg){
            echo '<script>alert("'.$msg.'")</script>';
        }

        public static function select($table,$query = '',$arr = ''){
			if($query != false){
				$sql = Painel::conectar()->prepare("SELECT * FROM `$table` WHERE $query");
				$sql->execute($arr);
			}else{
				$sql = Painel::conectar()->prepare("SELECT * FROM `$table`");
				$sql->execute();
			}
			return $sql->fetch();
		}

        public static function alert($tipo,$mensagem){
			if($tipo == 'sucesso'){
				echo '<div class="box-alert sucesso"><i class="fa fa-check"></i> '.$mensagem.'</div>';
			}else if($tipo == 'erro'){
				echo '<div class="box-alert erro"><i class="fa fa-times"></i> '.$mensagem.'</div>';
			}
		}

        public static function update($arr,$single = false){
			$certo = true;
			$first = false;
			$nome_tabela = $arr['nome_tabela'];

			$query = "UPDATE `$nome_tabela` SET ";
			foreach ($arr as $key => $value) {
				$nome = $key;
				$valor = $value;
				if($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id')
					continue;
				if($value == ''){
					$certo = false;
					break;
				}
				
				if($first == false){
					$first = true;
					$query.="$nome=?";
				}
				else{
					$query.=",$nome=?";
				}

				$parametros[] = $value;
			}

			if($certo == true){
				if($single == false){
					$parametros[] = $arr['id'];
					$sql = Painel::conectar()->prepare($query.' WHERE id=?');
					$sql->execute($parametros);
				}else{
					$sql = Painel::conectar()->prepare($query);
					$sql->execute($parametros);
				}
			}
			return $certo;
		}

        public static function getTotalItemsCarrinho(){
            if(isset($_SESSION['carrinho'])){
                $quantidade = 0;
                foreach ($_SESSION['carrinho'] as $key => $value) {
                    $quantidade+=$value;
                }
            }else{
                return 0;
            }
            return $quantidade;
        }

        public static function formatarMoedaBd($valor){
            $valor = str_replace('.','',$valor);
            $valor = str_replace(',','.',$valor);
            return $valor;
        }
    }
?>