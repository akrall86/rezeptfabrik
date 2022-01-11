<?php
require_once __DIR__ . '/../model/unit_of_measurement.php';
require_once __DIR__ . '/../inc/maininclude.php';

/**
 * The MeasuringUnitManager class contains methods for editing the table unit_of_measurement.
 */
class MeasuringUnitManager {
    private PDO $conn;

    /**
     * @param PDO $connection the connection to the db
     */
    public function __construct(PDO $connection) {
        $this->conn = $connection;
    }

    /**
     * insert measurement unit into DB
     * @param string $name the name of measurement unit
     */
    function createMeasuringUnit(string $name) {
        $ps = $this->conn->prepare('INSERT INTO unit_of_measurement (name) VALUES (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
    }

    /**
     * get all measurement units from db
     * @return array of measurement units
     */
    function getMeasuringUnits(): array {
        $result = $this->conn->query('SELECT * FROM unit_of_measurement');
        $measurementUnits = [];
        while ($row = $result->fetch()) {
            $measurementUnits[] = new Unit_of_Measurement($row['id'], $row['name']);
        }
        return $measurementUnits;
    }

    /**
     * get the id of one specific measurement unit
     * @param string $name
     * @return int|bool the id or false if there is no match
     */
    function getMeasuringUnitId(string $name): int|bool {
        $result = $this->conn->query("SELECT id FROM unit_of_measurement WHERE name = '$name'");
        if ($row = $result->fetch()) {
            return $row['id'];
        }
        return false;
    }

    /**
     * deletes one measurement unit from db
     * @param string $name the name of the measurement unit to be deleted
     */
    function deleteMeasuringUnit(string $name) {
        $ps = $this->conn->query('DELETE FROM unit_of_measurement WHERE name = (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
    }

}