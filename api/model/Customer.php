<?php
    /**
     * module name: master data management
     * version: 1.0
     * author: Manuel Wischnat
     * development environment: Microsoft VS Code
     * 
     * 
     * This class represents a Customer object.
     */
    class Customer {

        private $kun_id;

        private $vipcard_id;

        private $kun_nachname;

        private $kun_vorname;

        private $kun_geburtsdatum;

        public function __construct($kun_id, $vipcard_id, $kun_nachname, $kun_vorname, $kun_geburtsdatum) {
            $this->kun_id = $kun_id;
            $this->vipcard_id = $vipcard_id;
            $this->kun_nachname = $kun_nachname;
            $this->kun_vorname = $kun_vorname;
            $this->kun_geburtsdatum = $kun_geburtsdatum;
        }

        public function getKun_ID() {
            return $this->kun_id;
        }

        public function getVIPCard_ID() {
            return $this->vipcard_id;
        }

        public function setVIPCard_ID($vipcard_id) {
            $this->vipcard_id = $vipcard_id;
        }

        public function getKun_Nachname() {
            return $this->kun_nachname;
        }

        public function setKun_Nachname($kun_nachname) {
            $this->kun_nachname = $kun_nachname;
        }

        public function getKun_Vorname() {
            return $this->kun_vorname;
        }

        public function setKun_Vorname($kun_vorname) {
            $this->kun_vorname = $kun_vorname;
        }

        public function getKun_Geburtsdatum() {
            return $this->kun_geburtsdatum;
        }

        public function setKun_Geburtsdatum($kun_geburtsdatum) {
            $this->kun_geburtsdatum = $kun_geburtsdatum;
        }
    }
?>