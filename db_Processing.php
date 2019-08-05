<?php


class DB_info
{
  const DB_URL  = "localhost";
  const DB_HOST = "root";
  const DB_PW   = '';
  const DB_NAME = "ecmall";

}


$Query = new mysqli(DB_info::DB_URL, DB_info::DB_HOST,
                    DB_info::DB_PW, DB_info::DB_NAME);



class process{

  function insert($table, $value){
    global $Query;
      $Query->query("insert into $table values $value");
  }

  function delete($table, $column, $value){
    global $Query;
      $Query->query("delete from $table where $column = $value");
  }
}



 ?>
