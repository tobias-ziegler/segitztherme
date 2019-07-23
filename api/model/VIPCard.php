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
    class VIPCard {
        
        private $vipcard_id;

        private $vip_guthaben;

        public function __construct($vipcard_id, $vip_guthaben) {
            $this->vipcard_id = $vipcard_id;
            $this->vip_guthaben = $vip_guthaben;
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
    }
?>