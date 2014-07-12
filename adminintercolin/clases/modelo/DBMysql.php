<?php

class DBMysql{
  var $dataBase;
  var $server;
  var $login;
  var $pass;

  //  id de conexion/resultado
  var $idConexion;
  var $idConsulta;

  //Manejo de errores
  var $errorNum;
  var $errorText;

  //Constructor
  function Mysql($db="",$host="",$user="",$pas=""){
    $this->dataBase=$db;
    $this->server=$host;
    $this->login=$user;
    $this->pass=$pas;
  }
    
  function conect($db,$host,$user,$pas){
    $this->dataBase=$db;
    $this->server=$host;
    $this->login=$user;
    $this->pass=$pas;
    $this->idConexion=mysql_connect($this->server,$this->login,$this->pass);
    if(!$this->idConexion){
	$this->errorText="No hay conexion al servidor/maquina";
	$this->errorNum=mysql_errno();
	return 0;
    }
    if(!mysql_select_db($this->dataBase,$this->idConexion)){
	$this->errorText="No es posible abrir DB:".$this->dataBase;
	$this->errorNum=mysql_errno();
	return 0;
    }
    //Si todo salio bien, regresamos el identificador de la conexion;
    return $this->idConexion;
  }

  //para seleccionar una BD o cambiarse a otra DB
  function useBD($db){
    $this->dataBase=$db;
    if(!$this->idConexion){
        $this->errorText="No hay conexion al servidor";
        return 0;
    }
    if(!mysql_select_db($this->dataBase,$this->idConexion)){
        $this->errorText="No es posible abrir:".$this->dataBase;
        return 0;
    }
    return 1;
  }

  function select($sql=""){
    $e=$this->existQuery($sql);
    if($e>0){
       $this->idConsulta=mysql_query($sql,$this->idConexion);
       if(!$this->idConsulta){
	  $this->errorNum=mysql_errno();
	  $this->errorText=mysql_error();
       }
       return $this->idConsulta; //devuelve 0 si hay error
    }
    return $e;
  }
  
  function insert($sql=""){
	  return $this->select($sql);
  }

  function update($sql=""){
	  return $this->select($sql);
  }


  function delete ($sql=""){
    $e=$this->existQuery($sql);
    if($e>0){
       $e = mysql_query($sql,$this->idConexion);
       if(!$e){
         $this->errorNum=mysql_errno();
         $this->errorText=mysql_error();
       }
    }
    return $e; //devuelve 0 si hay error
  }

   //metodo para checar que se haya especificado un query
   function existQuery($sql){
      if($sql==""){
        $this->errorText="No se especifico Query SQL";
        return 0;
      }else return 1;
   }


  //regresa la cantidad de renglones del idConsulta atributo de la clase
  function getRow($idConsulta){
     if($idConsulta<0){  
       if($row= mysql_fetch_array($this->idConsulta))
	  return $row;
       else
	  return false;
     }else{
        if($row= mysql_fetch_array($idConsulta))
          return $row;
        else
          return false;   
     }
  }

  function countRows($idConsulta){
    if($idConsutal<0)
	return mysql_num_rows($this->idConsulta); //devuelve el numero de renglones de una consulta
    else
        return mysql_num_rows($idConsulta); //devuelve el numero de renglones de una consulta
  }
  //regresa el ultimo max id (cantidad de renglones en una tabla)
  function insertId(){
	return mysql_insert_id();
  }
  
}//fin clase

?>
