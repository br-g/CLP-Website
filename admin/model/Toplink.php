<?php

class Toplink extends Elem {

	var $sectionId;
	var $label;

	function __construct() {
		parent::__construct();
		$this->sectionId = -1;
		$this->label = "";
	}

	function loadFromDB($tuple) {
		parent::loadFromDB($tuple);
		$this->sectionId = $tuple['sectionId'];
		$this->label = stripslashes($tuple['label']);
	}

	function createFromForm($sectionId, $label) {
	  $this->sectionId = $sectionId;
	  $this->label = $label;
	}

	function toMenuForm() {
		$content = file_get_contents('../view/asset/toplink.html');
		$content = str_replace('<ID>', $this->id, $content);
		$content = str_replace('<TITLE>', $this->label, $content);
		$content = str_replace('<SECTIONID>', $this->sectionId, $content);
		return $content;
	}

	function toSQL() {
		$q = "INSERT INTO adm_toplink(id, sectionId, label, rank)" 
			. "VALUES('" . $this->id . "', '" . $this->sectionId . "', '" . addslashes($this->label) . "', '" . $this->rank . "'); ";
		return $q;
	}

	function toWebsite() {
		$content = file_get_contents('../../assets/html_chuncks/toplink.html');
		$content = str_replace('<REF>', $this->sectionId, $content);
		$content = str_replace('<LABEL>', $this->label, $content);
		return $content;
	}

	function rankUpdate() {
		return "UPDATE adm_toplink SET rank = '" . $this->rank . "' WHERE id = '" . $this->id . "'; ";
	}

	function delete() {
		$q = "DELETE FROM adm_toplink WHERE id = '" . $this->id . "'; ";
    	executeQuery($q);
	}
}
?>