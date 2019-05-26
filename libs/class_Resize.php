<?php 
class Resize {
	public $array     = array('image/jpeg', 'image/png', 'image/gif');
	public $array2    = array('jpeg', 'png', 'gif', 'jpg');
	public $newwidth;  
	public $newheight;
	public $width;  
	public $height;
	public $img_path  = '';
	public $name      = '';
	public $error     = '';
	public $tempname;
	public $extent;

	public function __construct() {
		$this->tempname = date('Ymd-His').'_'.rand(10, 99999).'_img_'.rand(10, 99999);
	}
	
	public function imgResize($filename, $extent, $width, $height, $newwidth, $newheight) {
		if($extent == 'jpg' || $extent == 'jpeg'){
			$src = imagecreatefromjpeg('.'.$filename);
		} elseif ($extent == 'gif'){
			$src = imagecreatefromgif('.'.$filename);
		} elseif($extent == 'png') {
			$src = imagecreatefrompng('.'.$filename);
		} else {
			$this->error = 'Не удалось изменить размер изображения';
			return false;
		}


		//пропорциональная подгонка нового изображения
		if ($width < $height) {
			$newwidth=($width/$height)*$newheight;
		} else {
			$newheight=($height/$width)*$newwidth;
		}  
		$newwidth = ($newwidth > $width) ? $width : $newwidth;
		$newheight= ($newheight > $height) ? $height : $newheight;

		$tmp = imagecreatetruecolor($newwidth, $newheight);

		//сохранение прозрачного фона для PNG
		if($extent == 'png') {
			imagealphablending($tmp, false);
			imagesavealpha($tmp, true);
		}

		//сохранение прозрачного фона для GIF
		if($extent == 'gif') {
			$transp_index = imagecolortransparent('.'.$filename);

			if($transp_index !== -1) {
				$transp_color = imagecolorsforindex('.'.$filename, $transp_index);

    			$transp_index2 = imagecolorallocate($tmp, 0, 0, 0);
    			imagecolortransparent($tmp, $transp_index2);
			}
		}

		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

		//формируется путь для нового изображения 
		$link = $this->img_path.$this->tempname.'.'.$extent;
		
		if($extent == 'jpg' || $extent == 'jpeg'){
			imagejpeg($tmp, '.'.$link, 100);
		} elseif ($extent == 'gif'){
			imagegif($tmp, '.'.$link);
		} elseif($extent == 'png') {
			imagepng($tmp, '.'.$link);
		} else {
			$this->error = 'Не удалось создать изображение';
			return false;
		}

		imagedestroy($tmp);

		return $link;
	}

	public function uploadNResize($fName, $fTmpName, $fError, $fSize) {
		if($fError == 0) {
			if($fSize < 1000 || $fSize > 20000000){
				$this->error = 'Файл не подходит по размерам';
				return false;
			} else {
				preg_match('#\.([a-z]+)$#ui', $fName, $matches);
				if (isset($matches[1])) {
					$matches[1] = mb_strtolower($matches[1]);
					
					$this->extent = $matches[1];

					$temp = getimagesize($fTmpName);

					$this->width = $temp[0];
					$this->height = $temp[1];
					
					$this->name = '/img/users/'.$this->tempname .'.'.$matches[1];
				
					if (!in_array($matches[1], $this->array2)) {
						$this->error = 'Поддерживаются только jpeg, gif, png';
						return false;
					} elseif(!in_array($temp['mime'], $this->array)) {
						$this->error = 'Данный тип файла не является изображением';
						return false;
					} elseif(!move_uploaded_file($fTmpName, '.'.$this->name)){
						$this->error = 'Изображение не загружено. Ошибка.';
						return false;
					} else {
						return true;	
					}
				} else {
					$this->error = 'Неизвестный тип расширения';
					return false;
				}
			}
		} else {
			$this->error = 'Ошибка. Изображение не отправлено!';
			return false;
		}
	}
}



