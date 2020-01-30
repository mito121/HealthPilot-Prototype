<?php

/* Definer klasse */

class Img extends Crud {

    private $table_name = 'frisoer_galleri';
    private $id, $img, $imgdesc;

    // Definer konstruktor
    public function __construct(mysqli $connection) {
        parent::__construct($connection);
    }

    // Definer getters og setters
    /*     * ******************************************************************************* */
    /*     * * synlighed, private egenskaber kan tilgås gennem public get og set metoder  ** */
    /*     * ******************************************************************************* */
    function setTable_name($table_name) {
        $this->table_name = $table_name;
    }

    function getId() {
        return $this->id;
    }

    function getImg() {
        return $this->img;
    }

    function getImgdesc() {
        return $this->imgdesc;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setImg($img) {
        $this->img = $img;
    }

    function setImgdesc($imgdesc) {
        $this->imgdesc = $imgdesc;
    }


// CRUD
    public function save(array $fields_and_values = NULL, $table_name = NULL) {

        $fields_and_values = array(
            'id' => $this->id,
            'img' => $this->img,
            'imgdesc' => $this->imgdesc
        );

        return parent::save($fields_and_values, $this->table_name);
    }

    public function delete($table_name = NULL, $id_field = NULL, $id_value = NULL) {
        return parent::delete($this->table_name, 'id', $this->id);
    }

    public function update(Array $fields_and_values = NULL, $table_name = NULL, Array $clause = NULL) {
        $to_be_updated = array(
            'id' => $this->id,
            'img' => $this->img,
            'imgdesc' => $this->imgdesc
        );
        $clause = array('id' => $this->id);
        return parent::Update($to_be_updated, $this->table_name, $clause);
    }

}
