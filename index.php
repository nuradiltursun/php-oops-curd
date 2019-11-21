<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>php+mysql+oop+pdo+ajax curd</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.bootcss.com/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
 
   
</head>
<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">我的Logo</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="#">主页</a>
    <a class="p-2 text-dark" href="#">关于</a>
    <a class="p-2 text-dark" href="#">联系</a>
    <a class="p-2 text-dark" href="#">帮助</a>
  </nav>
</div>

<!-- 菜单 -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h4 class="text-center text-danger font-weight-normal my-3">基于php+mysql+oops+ajax+bt4的curd系统</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2 class="text-primary mt-2">全部用户</h2>
        </div>
        <div class="col-lg-6">
            <button type="button" class="btn btn-primary m-1 float-right" data-target="#addModal" data-toggle="modal"><i class="fas fa-user-plus fa-lg"></i>&nbsp;  添加 </button>
            <a href="action.php?export=excel" class="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i> &nbsp;  导出为excel </a>
        </div>
    </div>
    <hr class="my-1">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive" id="showUser">
              <h3 class="text-center text-success" style="margin-top: 150px;">
                    加载中....
            </h3>
            </div>
        </div>
    </div>
</div>


<!-- 下面有好几个modal都是用的时bt4的modal，功能，这个值得掌握 -->

<!-- 添加新用户 -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">添加用户</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body px-4">
              <form action="" method="POST" id="form-data">
                  <div class="form-group">
                      <input type="text" class="form-control" name="fname" placeholder="First name" required>
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" name="lname" placeholder="Last name" required>
                  </div>
                  <div class="form-group">
                      <input type="email" class="form-control" name="email" placeholder="E-Mail" required>
                  </div>
                  <div class="form-group">
                      <input type="tel" class="form-control" name="phone" placeholder="Phone" required>
                  </div>
                  <div class="form-group">
                      <input type="submit" value="添加" id="insert" class="btn btn-danger btn-block"  >
                  </div>
              </form>
            </div>
          
          </div>
        </div>
      </div>


      
<!-- 编辑用户信息 -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">修改信息</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body px-4">
              <form action="" method="POST" id="edit-form-data">
                  <input type="hidden" name="id" id="id">
                  <div class="form-group">
                      <input type="text" class="form-control" name="fname" id="fname" required>
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" name="lname" id="lname" required>
                  </div>
                  <div class="form-group">
                      <input type="email" class="form-control" name="email" id="email" required>
                  </div>
                  <div class="form-group">
                      <input type="tel" class="form-control" name="phone" id="phone" required>
                  </div>
                  <div class="form-group">
                      <input type="submit" id="update" name="update" value="修改" class="btn btn-primary btn-block"  >
                  </div>
              </form>
            </div>
          
          </div>
        </div>
      </div>
    



      <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
$(document).ready(function(){
   
    // $('table').DataTable();

    // bt的slim jqury要去掉，要不然用不了ajax

    showAllUsers();
    // 一开始就初始化，通过ajax来获取数据
    function showAllUsers(){
        $.ajax({
            type : "POST",
            url : 'action.php',
            data : {
                action : 'view',
            },
            success : function(response){
                // console.log(response);
                $("#showUser").html(response);
                $('table').DataTable();
            }
        })

        // 插入用户
        $('#insert').click(function(e){
            console.log("hi");
            if($('#form-data')[0].checkValidity()){
                e.preventDefault();
                $.ajax({
                    url : 'action.php',
                    type : "POST",
                    data :$("#form-data").serialize()+"&action=insert",
                    success : function(response){
                        // console.log(response);
                        // 这个用的时sweetalert的内容，不会过去看看，挺简单的
                        Swal.fire({
                            title : 'insert data successfully',
                            type : 'success'
                        })
                        $("#addModal").modal('hide');
                        $("#form-data")[0].reset();
                        showAllUsers();
                    }
                       
                })
            }
        })


        // 更新为编辑内容提供数据
        $('body').on('click','.editBtn',function(e){
            // console.log("working...");
            e.preventDefault();
            var edit_id=$(this).attr('id');
            $.ajax({
                url : "action.php",
                type : "POST",
                data : {edit_id : edit_id },
                success : function(response){
                    // console.log(response);
                    var data=JSON.parse(response);

                    $("#id").val(data.id);
                    $("#fname").val(data.first_name);
                    $("#lname").val(data.last_name);
                    $("#email").val(data.email);
                    $("#phone").val(data.phone);

                }
            })
        })

         // 更新提交数据
         $('#update').click(function(e){
            if($('#edit-form-data')[0].checkValidity()){
                e.preventDefault();
                $.ajax({
                    url : 'action.php',
                    type : "POST",
                    data :$("#edit-form-data").serialize()+"&action=update",
                    success : function(response){
                        // console.log(response);
                        Swal.fire({
                            title : 'update data successfully',
                            type : 'success'
                        })
                        $("#editModal").modal('hide');
                        $("#edit-form-data")[0].reset();
                        showAllUsers();
                    }
                       
                })
            }
        })


        // 删除

        $("body").on('click',".delBtn",function(e){
            e.preventDefault();
            var tr=$(this).closest('tr');
            var del_id=$(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type : "POST",
                        url :"action.php",
                        data : {del_id : del_id},
                        success : function(response){
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            showAllUsers();
                        }
                        
                    })
                    
                }
                })
        })


        // 显示用户详细信息
        $('body').on('click','.infoBtn',function(e){
            e.preventDefault();
            var info_id=$(this).attr('id');
            $.ajax({
                url : 'action.php',
                type : "POST",
                data : {info_id : info_id },
                success : function(response){
                    // console.log(response);
                    var data=JSON.parse(response);
                    Swal.fire({
                        title : '<strong>User info Id('+data.id+')</strong>',
                        type : 'info',
                        html : '<b>First name : </b>'+data.first_name+'<br><b>Last name :</b>'+data.last_name+'<br><b>E-Mail</b>'+data.email+'<br><b>Phone</b>'+data.phone,
                        showCancelButton : true
                    })
                }
            })
        })
       
    }
})
</script>

</body>
</html>