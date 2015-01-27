<?php
class Image{
	public $image;
	public $dir;
	public $newName;
	public $toBase64;
	public $toUrl;
	private $extention;
	private $allowExtention = array("jpeg", "jpg", "png", "bmp", "gif");
	
	function __construct($image, $name, $dir){
		$this->image = $image;
		$this->newName = $name;
		$this->dir = $dir;
		$this->extention = $this->getExtention($image);
	}

	private function createImage(){
		move_uploaded_file($this->image['tmp_name'], $this->dir.$this->newName.'.'.$this->extention);
		$this->getBase64();
	}

	private function isValid($val){
		return in_array($this->getExtention($val), $this->allowExtention);
	}

	private function getBase64(){
		$type = pathinfo($this->dir.$this->newName.'.'.$this->extention);
		$this->toBase64 = base64_encode((file_get_contents($this->dir.$this->newName.'.'.$this->extention)));
	}

	private function removeImageTemp(){
		unlink($this->dir.$this->newName.'.'.$this->extention);
	}

	private function getExtention($val){
		return end(explode('.', $val['name']));
	}

	private function getUrl(){
		return URL.$this->dir.$this->newName.'.'.$this->extention;
	}

	public function Create(){
		$this->createImage();
	}

	public function resize($w){
		if($this->extention == 'jpg' || $this->extention == 'jpeg'){
			$src = imagecreatefromjpeg($this->dir.$this->newName.'.'.$this->extention);
			list($width, $height) = getimagesize($this->dir.$this->newName.'.'.$this->extention);
			$newheight = ($height / $width) * $w;
			$tmp = imagecreatetruecolor($w, $newheight);
			
			$filename = $this->dir.$this->newName.'_'.$w.'.'.$this->extention;
	        
	        imagealphablending($tmp, FALSE);
			imagesavealpha($tmp, TRUE);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0,$w, $newheight, $width, $height);
			imagejpeg($tmp, $filename, 100);
			imagedestroy($tmp);

			$this->removeImageTemp();
			$this->toUrl = URL.$filename; 

		}else if($this->extention == 'png'){
			$src = imagecreatefrompng($this->dir.$this->newName.'.'.$this->extention);

			list($width, $height) = getimagesize($this->dir.$this->newName.'.'.$this->extention);
			$newheight = ($height / $width) * $w;
			$tmp = imagecreatetruecolor($w, $newheight);
			
			$filename = $this->dir.$this->newName.'_'.$w.'.'.$this->extention;
	        
	        imagealphablending($tmp, FALSE);
			imagesavealpha($tmp, TRUE);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0,$w, $newheight, $width, $height);
			imagepng($tmp, $filename, 9);
			imagedestroy($tmp);

			$this->removeImageTemp();
			$this->toUrl = URL.$filename; 
		}else if($this->extention == 'gif'){
			$src = imagecreatefromgif($this->dir.$this->newName.'.'.$this->extention);

			list($width, $height) = getimagesize($this->dir.$this->newName.'.'.$this->extention);
			$newheight = ($height / $width) * $w;
			$tmp = imagecreatetruecolor($w, $newheight);
			
			$filename = $this->dir.$this->newName.'_'.$w.'.'.$this->extention;
	        
	        imagealphablending($tmp, FALSE);
			imagesavealpha($tmp, TRUE);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0,$w, $newheight, $width, $height);
			imagegif($tmp, $filename, 100);
			imagedestroy($tmp);

			$this->removeImageTemp();
			$this->toUrl = URL.$filename; 
		}else{
			$src = imagecreatefrombmp($this->dir.$this->newName.'.'.$this->extention);

			list($width, $height) = getimagesize($this->dir.$this->newName.'.'.$this->extention);
			$newheight = ($height / $width) * $w;
			$tmp = imagecreatetruecolor($w, $newheight);
			
			$filename = $this->dir.$this->newName.'_'.$w.'.'.$this->extention;
	        
	        imagealphablending($tmp, FALSE);
			imagesavealpha($tmp, TRUE);
			imagecopyresampled($tmp, $src, 0, 0, 0, 0,$w, $newheight, $width, $height);
			imagebmp($tmp, $filename, 100);
			imagedestroy($tmp);

			$this->removeImageTemp();
			$this->toUrl = URL.$filename;
		}
	}
}
