<?php
    /**
     * module name: master data management
     * version: 1.0
     * author: Manuel Wischnat
     * development environment: Microsoft VS Code
     * 
     * 
     * This class represents an Stay object.
     */
    class Stay implements JsonSerializable {

        private $auf_id;

        private $chip_id;

        // Entrance ID
        private $ein_id;

        private $mit_id_an;

        private $mit_id_ab;

        private $kun_id;

        private $auf_ankunft;

        private $auf_abfahrt;

        public function __construct($auf_id, $chip_id, $ein_id, $mit_id_an, $mit_id_ab, $kun_id, $auf_ankunft, $auf_abfahrt) {
            $this->auf_id = $auf_id;
            $this->chip_id = $chip_id;
            $this->ein_id = $ein_id;
            $this->mit_id_an = $mit_id_an;
            $this->mit_id_ab = $mit_id_ab;
            $this->kun_id = $kun_id;
            $this->auf_ankunft = $auf_ankunft;
            $this->auf_abfahrt = $auf_abfahrt;
        }

        public function getAuf_ID() {
            return $this->auf_id;
        }

        public function getChip_ID() {
            return $this->chip_id;
        }

        public function setChip_ID($chip_id) {
            $this->chip_id = $chip_id;
        }

        public function getEin_ID() {
            return $this->ein_id;
        }

        public function setEin_ID($ein_id) {
            $this->ein_id = $ein_id;
        }

        public function getMit_ID_An() {
            return $this->mit_id_an;
        }

        public function setMit_ID_An($mit_id_an) {
            $this->mit_id_an = $mit_id_an;
        }

        public function getMit_ID_Ab() {
            return $this->mit_id_ab;
        }

        public function setMit_ID_Ab($mit_id_ab) {
            $this->mit_id_ab = $mit_id_ab;
        }

        public function getKun_ID() {
            return $this->kun_id;
        }

        public function setKun_ID($kun_id) {
            $this->kun_id = $kun_id;
        }

        public function getAuf_Ankunft() {
            return $this->auf_ankunft;
        }

        public function setAuf_Ankunft($auf_ankunft) {
            $this->auf_ankunft = $auf_ankunft;
        }

        public function getAuf_Abfahrt() {
            return $this->auf_abfahrt;
        }

        public function setAuf_Abfahrt($auf_abfahrt) {
            $this->auf_abfahrt = $auf_abfahrt;
        }

        public function jsonSerialize() {
            return [
                "id" => $this->auf_id,
                "chipId" => $this->chip_id,
                "entranceId" => $this->ein_id,
                "mitId_ankunft" => $this->mit_id_an,
                "mitId_abfahrt" => $this->mit_id_ab,
                "kunId" => $this->kun_id,
                "ankunft" => $this->auf_ankunft,
                "abfahrt" => $this->auf_abfahrt
            ];
        }
    }
?>