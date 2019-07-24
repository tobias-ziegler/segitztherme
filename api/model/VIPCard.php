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
        
        private $vipcard_id;

        private $vip_guthaben;

        private $vip_kategorie;

        private $vip_rabatt;

        public function __construct($vipcard_id, $vip_guthaben, $vip_kategorie, $vip_rabatt) {
            $this->vipcard_id = $vipcard_id;
            $this->vip_guthaben = $vip_guthaben;
            $this->vip_kategorie = $vip_kategorie;
            $this->vip_rabatt = $vip_rabatt;
        }

        public function getVIPCard_ID() {
            return $this->vipcard_id;
        }

        public function getVIP_Guthaben() {
            return $this->vip_guthaben;
        }

        public function setVIP_Guthaben($vip_guthaben) {
            $this->vip_guthaben = $vip_guthaben;
        }
        
        public function getVIP_Kategorie() {
            return $this->vip_kategorie;
        }

        public function setVIP_Kategorie($vip_kategorie) {
            $this->vip_kategorie = $vip_kategorie;
        }

        public function getVIP_Rabatt() {
            return $this->vip_rabatt;
        }

        public function setVIP_Rabatt($vip_rabatt) {
            $this->vip_rabatt = $vip_rabatt;
        }

        public function jsonSerialize() {
            return [
                "id" => $this->vipcard_id,
                "guthaben" => $this->vip_guthaben,
                "kategorie" => $this->vip_kategorie,
                "rabatt" => $this->vip_rabatt
            ];
        }
    }
?>