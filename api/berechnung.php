<?php
	function berechneEintritt ($betrag) {
		$betrag = $betrag * 1.07;
		return $betrag;
	}
	function berechneVerpflegung ($betrag) {
		$betrag = $betrag * 1.19;
		return $betrag;
	}


?>
