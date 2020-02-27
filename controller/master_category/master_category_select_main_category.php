<?php
    require '../../engine/db_config.php';

    $post 	= $_POST;
    if($post == null){
        $sql = "SELECT MAINCATEGORYID, GROUPS, MAINCATEGORYNAME, COLOR FROM maincategory";
        $result = $mysqli->query($sql);

        $json = [];
        while($row = $result->fetch_assoc()){
            $json[] = ['id'=>$row['MAINCATEGORYID'], 'text'=>$row['MAINCATEGORYNAME'], 'groups'=>$row['GROUPS'], 'color'=>$row['COLOR']];
        }
    }else{
        $resid  = $post['1'];
        $sql 	= "SELECT * FROM maincategory WHERE MAINCATEGORYID = '".$resid."'";
        $result = $mysqli->query($sql);
        $json 	= $result->fetch_assoc();
    }
    echo json_encode($json);
?>