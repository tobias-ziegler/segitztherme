<?php
    /**
     * module name: master data management
     * version: 1.0
     * author: Manuel Wischnat
     * development environment: Microsoft VS Code
     * 
     * 
     * This class represents a TransponderChip object.
     */
    class TransponderChip {

        private $chip_id;

        public function __construct($chip_id) {
            $this->chip_id = $chip_id;
        }

        public function getChip_ID() {
            return $this->chip_id;
        }
    }
?>