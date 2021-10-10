<?php 
   
   // include("../inc/connection.php");

   function concat1($ar){
      $conCat = implode("','", $ar);
         return $conCat;
   }
   function concat2($ar){
      $conCat = implode(",", $ar);
         return $conCat;
   }
   function arrayfy($values){
        $ar_arr = array();
        foreach($values as $val){
         array_push($ar_arr, $val);
      }
      return $ar_arr;
   }

   function columns($table){
        global $conn; 
        $col_arr = array();
        $sql_f_s = mysqli_query($conn, "SHOW COLUMNS FROM $table");
        while($row = mysqli_fetch_array($sql_f_s)){
           array_push($col_arr, $row['Field']);
      }
      // array_shift($col_arr);
      return $col_arr;
   }


   function myInsert($table,$values,$redirect = ""){
        global $conn;
        echo "Found me!!"."<br>";
        $arr = columns($table);
        array_shift($arr);
        $arr2 = arrayfy($values);
      $col_names = concat2($arr);
      $con_val = concat1($arr2);
      $sql_f_i = "INSERT INTO $table ($col_names) VALUES ('$con_val')";
      $result = mysqli_query($conn,$sql_f_i);
      if($result){
         if($redirect != "")header("location: ".$redirect);
         
      }else{
         echo mysqli_error($conn)."<br>";
         echo $col_names."<br>";
         echo $con_val."<br>";
         echo sizeof($arr)."<br>";
         echo sizeof($arr2);

      }
    }
    function myInsertF($table,$values,$redirect=""){
      global $conn;
      echo "Found me!!"."<br>";
      $arr = columns($table);
      // array_shift($arr);
      $arr2 = arrayfy($values);
    $col_names = concat2($arr);
    $con_val = concat1($arr2);
    $sql_f_i = "INSERT INTO $table ($col_names) VALUES ('$con_val')";
    $result = mysqli_query($conn,$sql_f_i);
    if($result){
       if($redirect != "")header("location: ".$redirect);
       
    }else{
       echo mysqli_error($conn)."<br>";
       echo $col_names."<br>";
       echo $con_val."<br>";
       echo sizeof($arr)."<br>";
       echo sizeof($arr2);

    }
  }
    function myDelete($table ,$id_d, $redirect){
      global $conn;
      $arr = columns($table);
      $id = $arr[0];
      // echo $id;
      $sql_f_d = "DELETE FROM $table WHERE $id = '$id_d'";
      $result = mysqli_query($conn,$sql_f_d);
        if($result){
            header("location: ".$redirect);
         
        }else{
            echo mysqli_error($conn)."<br>";
            echo $col_names."<br>";
            echo $con_val."<br>";
      }

    }
    function my_delete($conn , $table , $id_d , $redirect){
      $arr = columns($table);
      $id = $arr[0];
      // echo $id;
      $sql_f_d = "DELETE FROM $table WHERE $id = '$id_d'";
      $result = mysqli_query($conn,$sql_f_d);
        if($result){
           header("location: ".$redirect);
        
        }else{
          echo mysqli_error($conn)."<br>";
          echo $col_names."<br>";
          echo $con_val."<br>";
      }
    }
    function myUpdate($table , $array , $u_id , $redirect=""){
        //    requires a compact array 
        global $conn;
        $arr = columns($table);
        $id = $arr[0];
        $parts = array();
        foreach ($array as $key => $value) {
             $part = "" . $key . " = '".$value."'";
             array_push($parts, $part);
         }
        $query =  "UPDATE $table SET ".implode(",", $parts)." WHERE $id = $u_id";
        // echo $query;
        // print_r($array);
        // echo $query."<br>";
        // echo $id;
        $result_u = mysqli_query($conn , $query);
        if($result_u){
            if($redirect!="")header("location: ".$redirect);
         
        }else{
            echo mysqli_error($conn)."<br>";
            
      }
   }
   
  function get_all($conn , $table){
    $qu = "SELECT * FROM $table";
    $re = mysqli_query($conn , $qu);
    return $out = mysqli_fetch_assoc($re);
  }
  function getAll($table){
    global $conn;
    $qu = "SELECT * FROM $table";
    $re = mysqli_query($conn , $qu);
    $out = array();
    while($row = mysqli_fetch_assoc($re)){
        array_push($out, $row);
    }
    return $out;
  }
  function get_by($conn , $table , $query){
    $qu = "SELECT * FROM $table ".$query;
    $re = mysqli_query($conn, $qu);
    return $out = mysqli_fetch_assoc($re);
  }
  function getBy($table , $query){
    global $conn;
    $qu = "SELECT * FROM $table ".$query;
    $re = mysqli_query($conn, $qu);
    return $out = mysqli_fetch_assoc($re);
  }
 ?>