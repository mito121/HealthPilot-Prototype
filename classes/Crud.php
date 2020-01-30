<?php

/**
 * Description of Crud
 *
 */
class Crud
{
    protected $connection;
    
    protected function __construct(mysqli $connection) 
    {
        $this->connection = $connection;
    }

    protected function Delete($table_name, $id_field, $id_value)
    {
        $sql = "DELETE FROM $table_name WHERE $id_field = '$id_value'";
        return $this->connection->query($sql);
    }
    
    protected function save(Array $fields_and_values, $table_name)
    {
        $fields = array_keys($fields_and_values);
        $fields = implode(',', $fields);
        $values = "'" . implode("','", $fields_and_values) . "'";
        $sql = "INSERT INTO $table_name ($fields) VALUES ($values)";
        $this->connection->query($sql);
        return $this->connection->insert_id;
    }
    
    protected function Update(Array $fields_and_values, $table_name, Array $clause) {
        foreach ($fields_and_values as $field => $value) {
            $temp .= " $field = '$value',";
        }
        $temp = rtrim($temp, ',');
        $identifying_fields = array_keys($clause);
        $identifying_field = $identifying_fields[0];
        $identifying_value = $clause[$identifying_field];
        $sql = "UPDATE $table_name 
            SET 
            ($temp)
            WHERE $identifying_field = '$identifying_value'";
        $this->connection->query($sql);
        return $this->connection->affected_rows;
    }
}