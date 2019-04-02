<?php
/**
 * Created by PhpStorm.
 * User: nnrrr
 * Date: 2019/02/26
 * Time: 18:43
 */

class ContractModel extends CI_Model
{
    private $database;

    /**
     * UserModel constructor.
     * @param $db
     */
    public function __construct()
    {
        $this->database = $this->db->conn_id;
    }

    public function getContractTypes()
    {
        $qry = "SELECT * FROM `contract`;";
        $smt = $this->database->prepare($qry);

        $smt->execute();

        if($smt->rowCount() > 0)
        {
            return $smt->fetchAll(PDO::FETCH_OBJ);
        }
        return null;
    }
}