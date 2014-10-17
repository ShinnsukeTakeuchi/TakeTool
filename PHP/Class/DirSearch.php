<?php
/**
 * 多階層ディレクトリのファイル情報を引き出すクラス
 */

class ImgDirSearch {

	private $home_dir = null;

	function __construct(){
		$this->home_dir = './';
	}

	//ディレクトリとファイル名の取得
	public function getImgDir($home_dir){
		$file_list = array();
		$img_files = scandir($home_dir);

		foreach ($img_files as $img_file) {
			if($img_file == '.' || $img_file == '..'){
				continue;
			} else if (is_file($home_dir.$img_file)){
				$file_list[] = $home_dir.$img_file;
			} else if (is_dir($home_dir.$img_file)){
				$file_list = array_merge($file_list, $this->getImgDir($home_dir.$img_file.DIRECTORY_SEPARATOR));
			}
		}
		return $file_list;
	}
}
?>