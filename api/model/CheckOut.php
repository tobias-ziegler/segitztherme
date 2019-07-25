<?php
    class CheckOut {

        private $ein_betrag;

        private $ein_menge;

        private $ver_bezeichnung;

        private $ver_preis;

        private $ver_steuer;

        public function __construct($ein_betrag, $ein_menge, $ver_bezeichnung, $ver_preis, $ver_steuer) {
            $this->ein_betrag = $ein_betrag;
            $this->ein_menge = $ein_menge;
            $this->ver_bezeichnung = $ver_bezeichnung;
            $this->ver_preis = $ver_preis;
            $this->ver_steuer = $ver_steuer;
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
    }
?>