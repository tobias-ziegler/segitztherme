<?php
    /**
     * module name: master data management
     * version: 1.0
     * author: Manuel Wischnat
     * development environment: Microsoft VS Code
     * 
     * 
     * This class represents a Category object.
     */
    class VIPCategory implements JsonSerializable {

        private $kat_id;

        private $kat_kategorie;

        private $kat_rabatt;

        public function __construct($kat_id, $kat_kategorie, $kat_rabatt) {
            $this->kat_id = $kat_id;
            $this->kat_kategorie = $kat_kategorie;
            $this->kat_rabatt = $kat_rabatt;
        }

        public function getKat_ID() {
            return $this->kat_id;
        }

        public function getKat_Kategorie() {
            return $this->kat_kategorie;
        }

        public function setKat_Kategorie($kat_kategorie) {
            $this->kat_kategorie = $kat_kategorie;
        }

        public function getKat_Rabatt() {
            return $this->kat_rabatt;
        }

        public function setKat_Rabatt($kat_rabatt) {
            $this->kat_rabatt = $kat_rabatt;
        }

        public function jsonSerialize() {
            return [
                "id" => $this->kat_id,
                "kategorie" => $this->kat_kategorie,
                "rabatt" => $this->kat_rabatt
            ];
        }
    }
?>