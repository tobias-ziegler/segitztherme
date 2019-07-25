<?php
    /**
     * module name: master data management
     * version: 1.0
     * author: Manuel Wischnat
     * development environment: Microsoft VS Code
     * 
     * 
     * This class represents an Purchase object.
     */
    class Purchase implements JsonSerializable {

        private $ein_id;

        private $auf_id;

        private $ver_id;

        private $ein_betrag;

        private $ein_menge;

        public function __construct($ein_id, $auf_id, $ver_id, $ein_betrag, $ein_menge) {
            $this->ein_id = $ein_id;
            $this->auf_id = $auf_id;
            $this->ver_id = $ver_id;
            $this->ein_betrag = $ein_betrag;
            $this->ein_menge = $ein_menge;
        }

        public function getEin_ID() {
            return $this->ein_id;
        }

        public function getAuf_ID() {
            return $this->auf_id;
        }

        public function setAuf_ID($auf_id) {
            $this->auf_id = $auf_id;
        }

        public function getVer_ID() {
            return $this->ver_id;
        }

        public function setVer_ID($ver_id) {
            $this->ver_id = $ver_id;
        }

        public function getEin_Betrag() {
            return $this->ein_betrag;
        }

        public function setEin_Betrag($ein_betrag) {
            $this->ein_betrag = $ein_betrag;
        }

        public function getEin_Menge() {
            return $this->ein_menge;
        }

        public function setEin_Menge($ein_menge) {
            $this->ein_menge = $ein_menge;
        }

        public function jsonSerialize() {
            return [
                "id" => $this->ein_id,
                "auf_id" => $this->auf_id,
                "ver_id" => $this->ver_id,
                "betrag" => $this->ein_betrag,
                "menge" => $this->ein_menge
            ];
        }
    }
?>