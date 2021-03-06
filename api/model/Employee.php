<?php
    /**
     * module name: master data management
     * version: 1.0
     * author: Manuel Wischnat
     * development environment: Microsoft VS Code
     * 
     * 
     * This class represents an Employee object.
     */
    class Employee implements JsonSerializable {

        private $mit_id;

        private $mit_nachname;

        private $mit_vorname;

        private $mit_strasse;

        private $mit_ort;

        private $mit_plz;

        private $mit_login;

        private $mit_passwort;

        public function __construct($mit_id, $mit_nachname, $mit_vorname, $mit_strasse, $mit_ort, $mit_plz, $mit_login, $mit_passwort) {
            $this->mit_id = $mit_id;
            $this->mit_nachname = $mit_nachname;
            $this->mit_vorname = $mit_vorname;
            $this->mit_strasse = $mit_strasse;
            $this->mit_ort = $mit_ort;
            $this->mit_plz = $mit_plz;
            $this->mit_login = $mit_login;
            $this->mit_passwort = $mit_passwort;
        }

        public function getMit_ID() {
            return $this->mit_id;
        }

        public function getMit_Nachname() {
            return $this->mit_nachname;
        }

        public function setMit_Nachname($mit_nachname) {
            $this->mit_nachname = $mit_nachname;
        }

        public function getMit_Vorname() {
            return $this->mit_vorname;
        }

        public function setMit_Vorname($mit_vorname) {
            $this->mit_vorname = $mit_vorname;
        }

        public function getMit_Strasse() {
            return $this->mit_strasse;
        }

        public function setMit_Strasse($mit_strasse) {
            $this->mit_strasse = $mit_strasse;
        }

        public function getMit_Ort() {
            return $this->mit_ort;
        }

        public function setMit_Ort($mit_ort) {
            $this->mit_ort = $mit_ort;
        }

        public function getMit_PLZ() {
            return $this->mit_plz;
        }

        public function setMit_PLZ($mit_plz) {
            $this->mit_plz = $mit_plz;
        }

        public function getMit_Login() {
            return $this->mit_login;
        }

        public function setMit_Login($mit_login) {
            $this->mit_login = $mit_login;
        }

        public function getMit_Passwort() {
            return $this->mit_passwort;
        }

        public function setMit_Passwort($mit_passwort) {
            $this->mit_passwort = $mit_passwort;
        }

        public function jsonSerialize() {
            return [
                "id" => $this->mit_id,
                "nachname" => $this->mit_nachname,
                "vorname" => $this->mit_vorname,
                "strasse" => $this->mit_strasse,
                "ort" => $this->mit_ort,
                "plz" => $this->mit_plz,
                "login" => $this->mit_login,
                "passwort" => $this->mit_passwort
            ];
        }
    }
?>