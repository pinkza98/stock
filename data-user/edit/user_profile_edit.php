<?php 
    require_once('../../database/db.php');
    if (isset($_REQUEST['update_id'])) {
        try {
            $stock_id = $_REQUEST['update_id'];
            $select_stock = $db->prepare("SELECT * FROM stock WHERE stock_id = :new_stock_id");
            $select_stock->bindParam(':new_stock_id', $stock_id);
            $select_stock->execute();
            $row = $select_stock->fetch(PDO::FETCH_ASSOC);
            extract($row);
        } catch(PDOException $e) {
            $e->getMessage();
        }
    }
    if (isset($_REQUEST['btn_update'])) {
        $stock_id = $_REQUEST['txt_stock_id'];
        $new_vandor = $_REQUEST['txt_vandor_id'];
        $new_unit_id = $_REQUEST['txt_unit_id'];
        $new_item_id = $_REQUEST['txt_item_id'];
        $new_type_item = $_REQUEST['txt_type_item'];
        $new_type_catagories = $_REQUEST['txt_type_catagories'];
        $new_img_stock = $_REQUEST['txt_img_stock'];
        
        if (empty($item_name_new)) {
            $errorMsg = "Please Enter item Name";
        } else {
            try {
                if (!isset($errorMsg)) {
                    $update_stmt = $db->prepare("UPDATE item SET item_name = :barnch_name_up  WHERE item_id = :item_id");
                    $update_stmt->bindParam(':barnch_name_up', $item_name_new);
                    $update_stmt->bindParam(':item_id', $item_id);

                    if ($update_stmt->execute()) {
                        $updateMsg = "ข้อมูลกำลังถูกอัพเดด.....";
                        header("refresh:2;../stock_main.php");
                    }
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>
<link rel="icon" type="image/png" href="../../components/images/tooth.png"/>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <title>Plus dental clinic</title>
    <?php include('../../components/header.php');?>
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
  </head>
  </head>
  <body>
  <?php include('../../components/nav_edit.php'); ?>
    <header>
      <div class="display-3 text-xl-center mt-4">
        <H2>แก้ไขข้อมูลส่วนตัว</H2>  
      </div>
    </header>
    <hr><br>
    <?php include('../../components/content.php')?>
    <div class="container">
    <?php 
         if (isset($errorMsg)) {
    ?>
        <div class="alert alert-danger mb-2">
            <strong>คำเตือน! <?php echo $errorMsg; ?></strong>
        </div>
    <?php } ?>
    <?php 
        if (isset($updateMsg)) {
    ?>
        <div class="alert alert-success mb-2">
            <strong>สำเร็จ! <?php echo $insertMsg; ?></strong>
        </div>
    <?php } ?>
    <?php 
    ?>
      <div class="container">
        <div class="container">
            <form method='post' enctype='multipart/form-data'>
              <div class="card">
                <div class="card-header">
                <label for="formGroupExampleInput" class="form-label"><b>ข้อมูล</b></label>
                <div class="mb-3">
                <input type="text"  value="<?php echo$row_session['username']?>" class="form-control"placeholder="E-mail"  display>
              </div>
                <div class="row g-3">
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="" value="" placeholder="รายการ" >
                </div>
                <div class="col-sm">
                  <input type="text" class="form-control" value="" placeholder="ราคา" >
                </div>
                <div class="col-sm">
                  <input type="text" class="form-control"   value="" placeholder="ต่อหน่วย" >
                  <input type="text"  name="" value=""hidden>
                </div>
              </div>
              <div class="row g-2">
              <label for="formGroupExampleInput" class="form-label">ประเภทรายการ</label>
                <div class="col-sm-8">
                <select class="form-select" name="txt_type_item"aria-label="Default select example">
                  <option value="" selected>---ถ้าต้องการเลือกใหม่----ค่าเดิม >()</option>
                
                  <option value=""></option>
                  
                </select>
                </div>
                <div class="col-sm-4">
                <select class="form-select" name="txt_type_catagories"aria-label="Default select example">
                  <option value="<?php echo$type_catagories ?>" selected>---ถ้าต้องการเลือกใหม่---ค่าเดิม >()</option>
                
                  <option value=""></option>
                  
                </select>
                </div>
              </div>
              <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">ผู้ขาย</label>
                <select name="txt_vendor"class="form-select" aria-label="Default select example">
                  <option value="" selected>---ถ้าต้องการเลือกใหม่---ค่าเดิม >()</option>
                  
                  <option value=""></option>
                  
                  </option>
                </select>
              </div>
                <label class="form-label" for="customFile">รูปภาพประกอบ</label>
                <input type="file"  name='' class="form-control" id="customFile" multiple  />
                <br>
              <div class="mb-3">    
                <input type="submit" name="save" class="btn btn-outline-success" value="Update Data">
                <a href="../stock_main.php" class="btn btn-outline-danger">Back</a>
              </div>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>   
   <?php include('../../components/footer.php')?>
   <script src="../../node_modules/jquery/dist/jquery.slim.min.js"></script>
   <script src="../../node_modules/jquery/dist/cdn_popper.js"></script>
   <script src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
