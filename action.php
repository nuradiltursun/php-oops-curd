<?php 
include './db.php';
$db=new Database();

// 每个请求都有action，通过action的值进行对应的操作

// 一开始就通过ajax获取数据
if(isset($_POST['action']) && $_POST['action']=='view'){
    $output='';
    // 获取全部数据
    $data=$db->read();
    // print_r($data);
    if($db->totalRowcCount()>0){
        $output.='  <table class="table tab-sm table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <td>ID</td>
                <td>Fristname</td>
                <td>Lastname</td>
                <td>E-mail</td>
                <td>Phone</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>';
        foreach($data as $row){
            $output.='
            <tr class="text-center text-secondary">
            <td>'.$row['id'].'</td>
            <td>'.$row['first_name'].'</td>
            <td>'.$row['last_name'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['phone'].'</td>
            <td>
            <a href="" title="Details" class="infoBtn text-info" id="'.$row['id'].'">
                <i class="fas fa-info-circle fa-lg "></i>&nbsp; &nbsp;
            </a>
            <a href="" title="Edit" class="editBtn text-primary" id="'.$row['id'].'" data-target="#editModal" data-toggle="modal" >
                <i class="fas fa-edit fa-lg"></i>&nbsp; &nbsp;
            </a>
            <a href="" title="Delete" id="'.$row['id'].'" class="text-danger delBtn" >
                <i class="fas fa-trash-alt fa-lg "></i>&nbsp; &nbsp;
            </a>
        </td></tr>
            ';

        }
        $output.='</tbody></table>';
        echo $output;
    }else{
        echo '<h3>some err </h3>';
    }



}


// 插入数据
if(isset($_POST["action"]) && $_POST['action']=="insert"){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];

    $db->insert($fname,$lname,$email,$phone);
}



// 通过id获取一个用户的信息，就是编辑更新的时候输入框自动填充这些数据

if(isset($_POST['edit_id'])){
    $id=$_POST["edit_id"];

    $row=$db->getUserById($id);
    echo json_encode($row);
}

// 在editmodal里的按钮来提交数据
if(isset($_POST['action']) && $_POST['action'] == 'update'){
    $id=$_POST['id'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];

    $db->update($id,$fname,$lname,$email,$phone);

}


//删除数据，这个不用action 
if(isset($_POST['del_id'])){
    $id=$_POST['del_id'];
    $db->deleteById($id);
}


// 用户详细信息
if(isset($_POST['info_id'])){
    $id=$_POST['info_id'];
    $row=$db->getUserById($id);
    echo json_encode($row);
}


//下载功能，直接设置a标签的href="action?export=excel"
if(isset($_GET['export']) && $_GET['export']=='excel'){
    header("Content-Type : application/xls");
    header("Content-Disposition : attachment; filename=users.xls");
    header("Pragma : no-cache");
    header("Expires : 0");

    $data=$db->read();

    echo '<table  border="1">';
    echo '<tr><th>Id</th><th>Firsname</th><th>Lastname</th><th>E-mail</th><th>Phone</th></tr>';

    foreach($data as $row){
        echo '<tr>
        <td>'.$row['id'].'</td>
        <td>'.$row['first_name'].'</td>
        <td>'.$row['last_name'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['phone'].'</td>
            </tr>
        ';
    }
    echo '</table>';

}

?>