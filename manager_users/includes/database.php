<?php
if(!defined('_CODE')){
    die('Access dinied...');
}

//hàm query
function query($sql, $data=[], $check = false){
    global $conn;
    $ketqua = false;

    try{
        $statement = $conn -> prepare($sql);

        if(!empty($data)){
            $ketqua = $statement -> execute($data);
        }
        else{
            $ketqua = $statement ->execute();
        }
    }
    catch(Excetion $exp){
        echo $exp ->getMessage().'<br>';
        echo 'File: '. $exp -> getFile().'<br>';
        echo 'Line: '.$exp -> getLine();
        die();
    }

    if($check){
        return $statement;
    }

    return $ketqua;
}

//hàm insert
function insert($table, $data){
    $key = array_keys($data);
    $truong = implode(',', $key);
    $valuetb = ':'.implode(',:', $key);
    
    $sql = 'INSERT INTO '.$table. ' ('.$truong.')'. 'VALUES('.$valuetb.')';

    $kq = query($sql, $data);
    return $kq;
}

//hàm update
function update($table, $data, $condition=''){
    $update = '';
    foreach($data as $key =>$value){
        $update.= $key.'= :'.$key . ',';
    }
    $update = trim($update, ',');

    if(!empty($condition)){
        $sql = 'UPDATE '.$table.' SET ' . $update. ' WHERE '.$condition;
    }else{
        $sql = 'UPDATE '.$table.' SET ' . $update;
    }

    $kq = query($sql, $data);
    return $kq;
}

//hàm delete
function delete($table, $condition=''){
    if(empty($condition)){
        $sql = 'DELETE FROM '.$table;
    }
    else{
        $sql = 'DELETE FROM '.$table. ' WHERE '.$conditon;
    }

    $kq = query($sql);
    return $kq;
}

//hàm lấy nhiều dòng dữ liệu
function getRaw ($sql){
    $kq = query($sql,'',true);
    if(is_object($kq)){
        $dataFetch = $kq ->fetchAll(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

//hàm lấy 1 dòng dữ liệu
function oneRaw($sql){
    $kq = query($sql,'',true);
    if(is_object($kq)){
        $dataFetch = $kq ->fetch(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

//hàm đếm số dòng dữ liệu
function getRows($sql){
    $kq = query($sql,'',true);
    if(!empty($kq)){
        return $kq -> rowCount();
    }
}
?>

