<?php
    /**
     * module name: master data management
     * version: 1.0
     * author: Manuel Wischnat
     * development environment: Microsoft VS Code
     * 
     * 
     * This class represents an Entrance object.
     */
    class Entrance {

        private $ein_id;

        private $ein_kategorie;

        private $ein_preis;

        private $ein_dauer;

        public function __construct($ein_id, $ein_kategorie, $ein_preis, $ein_dauer) {
            $this->ein_id = $ein_id;
            $this->ein_kategorie = $ein_kategorie;
            $this->ein_preis = $ein_preis;
            $this->ein_dauer = $ein_dauer;
        }

        public function getEin_ID() {
            return $this->ein_id;
        }

        public function getEin_Kategorie() {
            return $this->ein_kategorie;
        }

        public function setEin_Kategorie($ein_kategorie) {
            $this->ein_kategorie = $ein_kategorie;
        }

        public function getEin_Preis() {
            return $this->ein_preis;
        }

        public function setEin_Preis($ein_preis) {
            $this->ein_preis = $ein_preis;
        }

        public function getEin_Dauer() {
            return $this->ein_dauer;
        }

        public function setEin_Dauer($ein_dauer) {
            $this->ein_dauer = $ein_dauer;
        }
    }
?>