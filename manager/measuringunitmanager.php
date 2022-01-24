<?php
require_once __DIR__ . '/../model/unit_of_measurement.php';
require_once __DIR__ . '/../inc/maininclude.php';

/**
 * The MeasuringUnitManager class contains methods for editing the table unit_of_measurement.
 */
class MeasuringUnitManager
{
    private PDO $conn;

    /**
     * @param PDO $connection the connection to the DB
     */
    public function __construct(PDO $connection)
    {
        $this->conn = $connection;
    }

    /**
     * inserts measurement unit into DB
     * @param string $name the name of the measurement unit
     */
    function createMeasuringUnit(string $name)
    {
        $ps = $this->conn->prepare('INSERT INTO unit_of_measurement (name) VALUES (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
    }

    /**
     * gets all measurement units from DB
     * @return array array of measurement units
     */
    function getMeasuringUnits(): array
    {
        $result = $this->conn->query('SELECT * FROM unit_of_measurement');
        $measurementUnits = [];
        while ($row = $result->fetch()) {
            $measurementUnits[] = new Unit_of_Measurement($row['id'], $row['name']);
        }
        return $measurementUnits;
    }

    /**
     * gets the id of one specific measurement unit
     * @param string $name the name of the measurement unit
     * @return int|bool the id or false if there is no match
     */
    function getMeasuringUnitId(string $name): int|bool
    {
        $result = $this->conn->query("SELECT id FROM unit_of_measurement WHERE name = '$name'");
        if ($row = $result->fetch()) {
            return $row['id'];
        }
        return false;
    }

    /**
     * updates the measurement unit
     * @param string $id the id of the measurement unit to be updated
     * @param string $name the new name of the measurement unit
     */
    function updateMeasuringUnitId(int $id, string $name)
    {
        $ps = $this->conn->prepare('UPDATE unit_of_measurement 
        SET name = :name WHERE id = :id');
        $ps->bindValue('name', $name);
        $ps->bindValue('id', $id);
        $ps->execute();
    }

    /**
     * deletes one measurement unit from DB
     * @param string $name the name of the measurement unit to be deleted
     */
    function deleteMeasuringUnit(string $name)
    {
        $ps = $this->conn->query('DELETE FROM unit_of_measurement WHERE name = (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
    }

}