<?php

class GalleryImage extends Elem {

	var $galleryId;
	var $uploadId;

	function __construct() {
		parent::__construct();
		$this->galleryId = -1;
		$this->uploadId = -1;
	}

	function createFromBdd($tuple) {
		parent::createFromBdd($tuple);
		$this->galleryId = $tuple['galleryId'];
		$this->uploadId = $tuple['uploadId'];
	}

	function createFromForm($galleryId, $uploadId, $rank) {
	  $this->galleryId = $galleryId;
	  $this->uploadId = $uploadId;
	  $this->rank = $rank;
	}

	function toFrontEnd($uploads) {
		$content = file_get_contents('../view/asset/curGalery_image.html');

		$imageName = "";
		foreach($uploads as $u) {
		    if ($u->id == $this->uploadId) {
		       $imageName = $u->initialName;
		       break;
		    }
		}
		$content = str_replace('<IMAGENAME>', $imageName, $content);
		return $content;
	}

	function toBDD() {
		$q = "DELETE FROM adm_galleryimage WHERE id='" . $this->id . "'; ";
		$q .= "INSERT INTO adm_galleryimage(id, galleryId, uploadId, rank)" 
			. "VALUES('" . $this->id . "', '" . $this->galleryId . "', '" . $this->uploadId . "', '" . $this->rank . "'); ";
		return $q;
	}
}
?>