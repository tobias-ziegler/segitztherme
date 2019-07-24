<?php
    /**
     * module name: master data management
     * version: 1.0
     * author: Manuel Wischnat
     * development environment: Microsoft VS Code
     * 
     * 
     * This class provides methods for the interaction
     * between server and database.
     * Interactions like adding data to the database,
     * deleting or getting data from the database.
     */
    class DatabaseUtil {

        //private const HOST = "localhost";

        //private const USER = "root";

        //private const PASSWORD = "";

        //private const DBNAME = "rfidv4";

        private function __construct() {

        }

        /**
         * This method creates a connection to the database.
         */
        private static function getDatabaseConnection() {
            $Con = mysqli_connect("localhost", "root", "");
            if($Con == FALSE) {
                echo "Connection error to database!";
            }
            else {
                mysqli_select_db($Con, "test");
            }

		    return $Con;
        }

        /**
         * This method executes the query on the database.
         */
        private static function executeDatabaseQuery($query) {
            $Con = DatabaseUtil::getDatabaseConnection();

            $Result = mysqli_query($Con, $query);

            mysqli_close($Con);

            return $Result;
        }

        /**
         * This method gets the specific Consumable with the consumableID.
         */
        public static function fetchConsumable($consumableID) {
            $query = "SELECT * FROM verpflegung WHERE ";
            $query = $query."ver_id = ";
            $query = $query.$consumableID;
            $query = $query.";";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
            
            // transform mysql result set into object array 
            $listOfConsumables = array();

            while($data = mysqli_fetch_assoc($Result)) {
                $consumItem = new Consumable($data["ver_id"], $data["ver_bezeichnung"],
                                        $data["ver_preis"], $data["ver_steuer"]);
        
                $listOfConsumables[] = $verpflegung;
            }

            return $listOfConsumables;
        }

        /**
         * This method adds a Consumable to the database.
         */
        public static function addConsumable($consumable) {
            $query = "INSERT INTO verpflegung (";
            $query = $query."ver_bezeichnung, ";
            $query = $query."ver_preis, ";
            $query = $query."ver_steuer";
            $query = $query.") VALUES (";
            $query = $query."\"";
            $query = $query.$consumable->getVer_Bezeichnung();
            $query = $query."\"";
            $query = $query.", ";
            $query = $query.$consumable->getVer_Preis();
            $query = $query.", ";
            $query = $query.$consumable->getVer_Steuer();
            $query = $query.");";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
        }

        /**
         * This method deletes a Consumable from the database.
         */
        public static function deleteConsumable($consumableID) {
            $query = "DELETE FROM verpflegung WHERE ";
            $query = $query."ver_id = ";
            $query = $query.$consumableID;
            $query = $query.";";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
        }

        /**
         * This method delivers all Consumables from the database.
         */
        public static function getAllConsumables() {
            $query = "SELECT * FROM verpflegung;";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
            
            // transform mysql result set into object array 
            $listOfConsumables = array();

            while($data = mysqli_fetch_assoc($Result)) {
                $consumItem = new Consumable($data["ver_id"], $data["ver_bezeichnung"],
                                        $data["ver_preis"], $data["ver_steuer"]);
        
                $listOfConsumables[] = $consumItem;
            }

            return $listOfConsumables;
        }
        
        /**
         * This method gets the specific Employee with the employeeID.
         */
        public static function fetchEmployee($employeeID) {
            $query = "SELECT * FROM mitarbeiter WHERE ";
            $query = $query."mit_id = ";
            $query = $query.$employeeID;
            $query = $query.";";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);

            // transform mysql result set into object array 
            $listOfEmployees = array();

            while($data = mysqli_fetch_assoc($Result)) {
                $employeeObj = new Employee($data["mit_id"], $data["mit_nachname"],
                                            $data["mit_vorname"], $data["mit_strasse"],
                                            $data["mit_ort"], $data["mit_plz"],
                                            $data["mit_login"], $data["mit_passwort"]);
        
                $listOfEmployees[] = $employeeObj;
            }

            return $listOfEmployees;
        }

        /**
         * This method adds an Employee to the database.
         */
        public static function addEmployee($employee) {
            $query = "INSERT INTO mitarbeiter (";
            $query = $query."mit_nachname, ";
            $query = $query."mit_vorname, ";
            $query = $query."mit_strasse, ";
            $query = $query."mit_ort, ";
            $query = $query."mit_plz";
            $query = $query.") VALUES (";
            $query = $query."\"";
            $query = $query.$employee->getMit_Nachname();
            $query = $query."\"";
            $query = $query.", ";
            $query = $query."\"";
            $query = $query.$employee->getMit_Vorname();
            $query = $query."\"";
            $query = $query.", ";
            $query = $query."\"";
            $query = $query.$employee->getMit_Strasse();
            $query = $query."\"";
            $query = $query.", ";
            $query = $query."\"";
            $query = $query.$employee->getMit_Ort();
            $query = $query."\"";
            $query = $query.", ";
            $query = $query."\"";
            $query = $query.$employee->getMit_PLZ();
            $query = $query."\"";
            $query = $query.");";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
        }

        /**
         * This method deletes an Employee from the database.
         */
        public static function deleteEmployee($employeeID) {
            $query = "DELETE FROM mitarbeiter WHERE ";
            $query = $query."mit_id = ";
            $query = $query.$employeeID;
            $query = $query.";";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
        }

        /**
         * This method delivers all Employees from the database.
         */
        public static function getAllEmployees() {
            $query = "SELECT * FROM mitarbeiter;";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);

            // transform mysql result set into object array 
            $listOfEmployees = array();

            while($data = mysqli_fetch_assoc($Result)) {
                $employeeObj = new Employee($data["mit_id"], $data["mit_nachname"],
                                            $data["mit_vorname"], $data["mit_strasse"],
                                            $data["mit_ort"], $data["mit_plz"],
                                            $data["mit_login"], $data["mit_passwort"]);
        
                $listOfEmployees[] = $employeeObj;
            }

            return $listOfEmployees;
        }

        /**
         * This method gets the specific Chip with the chipID.
         */
        public static function fetchChip($chipID) {
            $query = "SELECT * FROM chip WHERE ";
            $query = $query."chip_id = ";
            $query = $query.$chipID;
            $query = $query.";";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);

            // transform mysql result set into object array 
            $listOfChips = array();

            while($data = mysqli_fetch_assoc($Result)) {
                $chipObj = new TransponderChip($data["chip_id"]);
        
                $listOfChips[] = $chipObj;
            }

            return $listOfChips;
        }

        /**
         * This method adds an Chip to the database.
         */
        public static function addChip($chipID) {
            $query = "INSERT INTO chip (";
            $query = $query."chip_id";
            $query = $query.") VALUES (";
            $query = $query.$chipID;
            $query = $query.");";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
        }

        /**
         * This method deletes a Chip from the database.
         */
        public static function deleteChip($chipID) {
            $query = "DELETE FROM chip WHERE ";
            $query = $query."chip_id = ";
            $query = $query.$chipID;
            $query = $query.";";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
        }

        /**
         * This method delivers all Chips from the database.
         */
        public static function getAllChips() {
            $query = "SELECT * FROM chip;";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);

            // transform mysql result set into object array 
            $listOfChips = array();

            while($data = mysqli_fetch_assoc($Result)) {
                $chipObj = new TransponderChip($data["chip_id"]);
        
                $listOfChips[] = $chipObj;
            }

            return $listOfChips;
        }

        /**
         * This method gets the specific VIPCustomer with the customerID.
         */
        public static function fetchVIPCustomer($customerID) {
            $query = "SELECT * FROM vip_kunde WHERE ";
            $query = $query."kun_id = ";
            $query = $query.$customerID;
            $query = $query.";";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);

            // transform mysql result set into object array 
            $listOfVIPCustomers = array();

            while($data = mysqli_fetch_assoc($Result)) {
                $vipCustomerObj = new VIPCustomer($data["kun_id"], $data["vip_id"],
                                                    $data["kun_nachname"], $data["kun_vorname"],
                                                    $data["kun_geburtsdatum"]);
        
                $listOfVIPCustomers[] = $vipCustomerObj;
            }

            return $listOfVIPCustomers;
        }

        /**
         * This method adds an VIPCustomer to the database.
         */
        public static function addVIPCustomer($vipCustomer) {
            $query = "INSERT INTO vip_kunde (";
            $query = $query."vip_id, ";
            $query = $query."kun_vorname, ";
            $query = $query."kun_nachname, ";
            $query = $query."kun_geburtsdatum";
            $query = $query.") VALUES (";
            $query = $query.$vipCustomer->getVIPCard_ID();
            $query = $query.", ";
            $query = $query."\"";
            $query = $query.$vipCustomer->getKun_Vorname();
            $query = $query."\"";
            $query = $query.", ";
            $query = $query."\"";
            $query = $query.$vipCustomer->getKun_Nachname();
            $query = $query."\"";
            $query = $query.", ";
            $query = $query."\"";
            $query = $query.$vipCustomer->getKun_Geburtsdatum();
            $query = $query."\"";
            $query = $query.");";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
        }

        /**
         * This method deletes a VIPCustomer from the database.
         */
        public static function deleteVIPCustomer($customerID) {
            $query = "DELETE FROM vip_kunde WHERE ";
            $query = $query."kun_id = ";
            $query = $query.$customerID;
            $query = $query.";";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
        }

        /**
         * This method delivers all Customers from the database.
         */
        public static function getAllVIPCustomers() {
            $query = "SELECT * FROM vip_kunde;";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);

            // transform mysql result set into object array 
            $listOfVIPCustomers = array();

            while($data = mysqli_fetch_assoc($Result)) {
                $vipCustomerObj = new VIPCustomer($data["kun_id"], $data["vip_id"],
                                                    $data["kun_nachname"], $data["kun_vorname"],
                                                    $data["kun_geburtsdatum"]);
        
                $listOfVIPCustomers[] = $vipCustomerObj;
            }

            return $listOfVIPCustomers;
        }

        /**
         * This method gets the specific VIPCard with the vip_id.
         */
        public static function fetchVIPCard($vip_id) {
            $query = "SELECT * FROM vip_karte WHERE ";
            $query = $query."vip_id = ";
            $query = $query.$vip_id;
            $query = $query.";";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);

            // transform mysql result set into object array 
            $listOfVIPCards = array();

            while($data = mysqli_fetch_assoc($Result)) {
                $vipCardObj = new VIPCard($data["vip_id"], $data["vip_guthaben"],
                                            $data["vip_kategorie"], $data["vip_rabatt"]);
        
                $listOfVIPCards[] = $vipCardObj;
            }

            return $listOfVIPCards;
        }

        /**
         * This method adds an VIPCard to the database.
         */
        public static function addVIPCard($vipCard) {
            $query = "INSERT INTO vip_karte (";
            $query = $query."vip_guthaben";
            $query = $query.") VALUES (";
            $query = $query.$vipCard->getVIP_Guthaben();
            $query = $query.");";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
        }

        /**
         * This method deletes a VIPCard from the database.
         */
        public static function deleteVIPCard($vip_id) {
            $query = "DELETE FROM vip_karte WHERE ";
            $query = $query."vip_id = ";
            $query = $query.$vip_id;
            $query = $query.";";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
        }

        /**
         * This method delivers all VIPCards from the database.
         */
        public static function getAllVIPCards() {
            $query = "SELECT * FROM vip_karte;";

            // execute $query on DB
            $Result = DatabaseUtil::executeDatabaseQuery($query);
            
            // transform mysql result set into object array 
            $listOfVIPCards = array();

            while($data = mysqli_fetch_assoc($Result)) {
                $vipCardObj = new VIPCard($data["vip_id"], $data["vip_guthaben"],
                                            $data["vip_kategorie"], $data["vip_rabatt"]);
        
                $listOfVIPCards[] = $vipCardObj;
            }

            return $listOfVIPCards;
        }
    }
?>