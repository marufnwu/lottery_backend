<?php
class result extends db_connect{

    public function __construct($dbo=null)
    {
        parent::__construct($dbo);
        
    }

    public function getTodaysResult($gameNo){
        $time = date('H:m:s');
        $today = date('Y-m-d');

        $stmt = $this->db->prepare("SELECT * FROM result WHERE date=(:today) AND game_no=(:gameNo) LIMIT 1");
        $stmt->bindParam(":today", $today, PDO::PARAM_STR);
        $stmt->bindParam(":gameNo", $gameNo, PDO::PARAM_STR);

        if($stmt->execute()){
            if($stmt->rowCount()>0){
                //result found
                $row = $stmt->fetch();

                $result = array(
                    "result_url"=>$row['result_url'],
                    "game_no"=>(int)$row['game_no'],
                    "date"=>$row['date'],
                    "game_time"=>$row['game_time'],

                );

                return array(
                    "error"=>false,
                    "hasResult"=>true,
                    "error_description"=>"Result Found",
                    "result"=>$result
                );
            }else{
                //result not found or not published

                return array(
                    "error"=>false,
                    "hasResult"=>false,
                    "error_description"=>"Result Not Published",
                   
                );
            }
        }else{
            return array(
                "error"=>true,
                "hasResult"=>false,
                "error_description"=>$stmt->errorInfo(),
               
            );
        }
        
    }
}