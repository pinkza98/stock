<?php 
    require_once('../database/db.php');
?>
<link rel="icon" type="image/png" href="../components/images/tooth.png" />
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <title>Plus dental clinic</title>
    
    <?php include('../components/header.php');?>
     <!-- liberty ทำงานในคำสั่งตามที่คาดหัวไว้ -->
     <!-- <==========================================booystrap 5==================================================> -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
   <!-- <==========================================booystrap 5==================================================> -->
   <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- <==========================================data-teble==================================================> -->

</head>
<body>
    <?php include('../components/nav_stock.php'); ?>
    <header>

        <div class="display-3 text-xl-center mt-3">
            <H2>เพิ่ม/เบิกใช้ คลังสาขา</H2>
        </div>
    </header>
    <hr><br>
    <?php include('../components/content.php')?>
    <div class="container">
        <?php 
         if (isset($errorMsg)) { //function แสดงข้อความ error ตามไลน์
    ?>
        <div class="alert alert-danger mb-2">
            <strong>คำเตือน! <?php echo $errorMsg; ?></strong>
        </div>
        <?php } ?>
        <?php 
        if (isset($insertMsg)) { //function แสดงข้อความ error ตามไลน์
    ?>
        <div class="alert alert-success mb-2">
            <strong>เยี่ยม! <?php echo $insertMsg; ?></strong>
        </div>
        <?php } ?>
        
        <div class="row">
            <div class="col-md-12">
            <div class="card text-white bg-secondary mb-3" style="max-width: 29rem;">
                <div class="card-header">
                    <h4 class="card-title">จัดการรายการ เพิ่มสินค้า/เบิกใช้สินค้า คลัง</h4>
                </div>
            </div>
                <form id="list_item" name="list_item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-select mb-2 mt-2" name="status" id="status" required="true" >
                                    <option value="stock_item">เพิ่มสินค้า</option>
                                    <option value="disburse">เบิกใช้</option>
                                </select>
                                <?php 
                                    if($row_session['user_lv']>=3){
                                        ?>
                                <?php 
                                        $select_bn = $db->prepare("SELECT * FROM branch ORDER BY bn_id DESC");
                                        $select_bn->execute();
                                        ?>

                                <select class="form-select mt-3" name="bn_id" id="bn_id">
                                    <option value="<?php echo$row_session['user_bn']?>">สาขาปัจจุบันที่สังกัด
                                    </option>
                                    <?php  while ($row_bn = $select_bn->fetch(PDO::FETCH_ASSOC)) {?>
                                    <option value="<?php echo$row_bn['bn_id']?>"><?php echo$row_bn['bn_name']?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <?php
                                    }else{
                                    ?>
                                <select class="form-select mt-3" name="bn_id" id="bn_id">
                                    <option value="<?php echo$row_session['user_bn']?>">สาขาปัจจุบันที่สังกัด
                                    </option>
                                </select>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form.group">
                                <input type="text" name="code_item" id="code_item" class="form-control"
                                    placeholder=" รหัสบาร์โค้ด" required autofocus>
                                <?php $user_name = $row_session['user_fname'].$row_session['user_lname'] ?>
                                <input type="text" name="user_name" id="user_name" value="<?php echo $user_name?>"
                                    hidden>
                                    
                            </div>
                        </div>
                    </div>
                </form>
                <form name="add_name" id="add_name">
                    <div class="responsive p-6">
                        <table class="table table-bordered" id="dynamic_field">
                            <thead class="table-dark text-center">
                                <th class="col-md-1">รหัสบาร์โค้ด</th>
                                <th class="col-md-4">ชื่อรายการ</th>
                                <th class="col-md-1">จำนวน</th>
                                <th class="col-md-1">ที่มีจำนวน</th>
                                <th class="col-md-2">สาขา</th>
                                <th class="col-md-1">view</th>
                                <th class="col-md-1">ลบ</th>
                            </thead>
                            <tr>
                            

                            </tr>
                        </table>
                        <input type="submit"  name="submit" id="submit" class="btn btn-success" value="Add" />
                        <input type="submit" href="stock_center.php" class="btn btn-primary"value="Reset"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php require ('viewmodal.php');?>
<script type="text/javascript">
$(document).ready(function() { //function รับข้อมูล รหัสบาร์โค้ด จากหน้าจอ
    var i = 1;
    var qty = 1;
    $("#code_item").keypress(function(event) {
        if (event.keyCode === 13) {
            if (!this.value == "") {
                event.preventDefault(event);
                $.ajax({
                    url: 'select_stock/stock_center_load.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#list_item').serialize(),
                    success: function(result) {
                        var item_name = result.item_name;
                        var code_item = result.code_item;
                        var sum_item = result.sum_item;
                        var bn_name = result.bn_name;
                        var bn_id = result.bn_id;
                        var stock_id = result.stock_id;
                        var exd_date = result.exd_date;
                        var price_stock = result.price_stock;
                        var user_name = result.user_name;
                        var status = result.status;
                        var unit_name = result.unit_name;
                        // 
                        i++;
                        $('#dynamic_field').append('<tr id="row' + i +
                            '" class="dynamic-added"><td><input type="text" value="' +
                            code_item +
                            '" class=" form-control text-center" /disabled></td><td><input type="text" value="' +
                            item_name +'('+unit_name+')'+
                            '" class=" form-control text-center"/disabled></td><td><input type="number" value="' +
                            qty +
                            '" class=" form-control  text-center" name="qty[]"/></td><input type="hidden" value="' +
                            stock_id +
                            '" name="stock_id[]"/><input type="hidden" value="' +
                            bn_id + '" name="bn_id[]"/><input type="hidden" value="' +
                            user_name +
                            '" name="user_name[]"/><input type="hidden" value="' +
                            price_stock +
                            '" name="price_stock[]"/><input type="hidden" value="' +
                            exd_date +
                            '" name="exd_date[]"/><input type="hidden" value="' +
                            status +
                            '" name="status[]"/><input type="hidden" value="' +
                            sum_item +
                            '" name="sum[]"/><td><input type="text" value="' +
                            sum_item +
                            '" class=" form-control  text-center"/disabled></td><td><input type="text" value="' +
                            bn_name +
                            '" class=" form-control text-center"/disabled></td><td><input type="button" name="view" value="view" class="btn btn-info view_data" id="'+stock_id+'"/></td><td><button type="button" name="remove" id="' +
                            i +
                            '" class="btn btn-danger btn_remove">X</button></td></tr>'
                        );
                        event.currentTarget.value = "";
                        qty =1;
                    }
                });
            }
        }
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
  $('#submit').click(function(e) { //function สำหรับบันทึกข้อมูลจากรหัสบาร์โค้ดที่กรอก
        var data_add = $('#add_name').serialize(); 
        e.preventDefault();
        $.ajax({
            url: "stock_center_db.php",
            method: "POST",
            data: data_add,
            success: function(data) {
                if(data != false ) {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: data,
                showConfirmButton:false,
                timer: 1500
                }); 
                setTimeout(function(){
                window.location.reload(1);
                }, 2000);
            }else{
                Swal.fire({
                position: 'center',
                icon: 'error',
                title: "มีรายการไม่ถูกต้อง!!",
                showConfirmButton: false,
                timer: 1500
                });
            }
        }
    });
});

    $(document).on('click', '.view_data', function() { //function สำหรับดึงข้อมูลจากรหัสบาร์โค้ดที่กรอก
        var uid=$(this).attr("id");
        $.ajax({
        url:"select_stock.php",
        method:"POST",
        data:{uid},
        success:function(data) {
          $('#detail').html(data);
          $('#dataModal').modal('show');
        }
      });
});
});
</script>
