<?php
    /**
     * module name: master data management
     * version: 1.0
     * author: Manuel Wischnat
     * development environment: Microsoft VS Code
     * 
     * 
     * This class represents a VIPCard object.
     */
    class VIPCard implements JsonSerializable {
        
        private $kar_id;

        private $kat_id;

        private $kar_guthaben;

        public function __construct($kar_id, $kat_id, $kar_guthaben) {
            $this->kar_id = $kar_id;
            $this->kat_id = $kat_id;
            $this->kar_guthaben = $kar_guthaben;
        }

        public function getVIPCard_ID() {
            return $this->kar_id;
        }
        
        public function getVIP_Kategorie() {
            return $this->kat_id;
        }

        public function setVIP_Kategorie($kat_id) {
            $this->kat_id = $kat_id;
        }

        public function getVIP_Guthaben() {
            return $this->kar_guthaben;
        }

        public function setVIP_Guthaben($kar_guthaben) {
            $this->kar_guthaben = $kar_guthaben;
        }

        public function jsonSerialize() {
            return [
                "id" => $this->kar_id,
                "kategorieId" => $this->kat_id,
                "guthaben" => $this->kar_guthaben
            ];
        }
    }
?>