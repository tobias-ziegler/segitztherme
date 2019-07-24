<?php
    /**
     * module name: master data management
     * version: 1.0
     * author: Manuel Wischnat
     * development environment: Microsoft VS Code
     * 
     * 
     * This class represents a Consumable object.
     */
    class Consumable implements JsonSerializable {

        private $ver_id;

        private $ver_bezeichnung;

        private $ver_preis;

        private $ver_steuer;

        public function __construct($ver_id, $ver_bezeichnung, $ver_preis, $ver_steuer) {
             $this->ver_id = $ver_id;
             $this->ver_bezeichnung = $ver_bezeichnung;
             $this->ver_preis = $ver_preis;
             $this->ver_steuer = $ver_steuer;
        }

        public function getVer_ID() {
            return $this->ver_id;
        }

        public function getVer_Bezeichnung() {
            return $this->ver_bezeichnung;
        }

        public function setVer_Bezeichnung($ver_bezeichnung) {
            $this->ver_bezeichnung = $ver_bezeichnung;
        }

        public function getVer_Preis() {
            return $this->ver_preis;
        }

        public function setVer_Preis($ver_preis) {
            $this->ver_preis = $ver_preis;
        }

        public function getVer_Steuer() {
            return $this->ver_steuer;
        }

        public function setVer_Steuer($ver_steuer) {
            $this->ver_steuer = $ver_steuer;
        }

        public function jsonSerialize() {
            return [
                "id" => $this->ver_id,
                "bezeichnung" => $this->ver_bezeichnung,
                "preis" => $this->ver_preis,
                "steuer" => $this->ver_steuer
            ];
        }
    }
?>