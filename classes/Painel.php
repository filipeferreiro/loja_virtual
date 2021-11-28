<?php
    class Painel{
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

        public static function resize_image($resize){
            $resize = new ResizeImage('images/Be-Original.jpg');
            $resize->resizeTo(100, 100, 'exact');
            $resize->saveImage('images/be-original-exact.jpg');
        }
    }
?>