<?php 
include('../../database/db.php');
?>
<link rel="icon" type="image/png" href="../../components/images/tooth.png"/>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Plus dental clinic</title>
     <!-- <==========================================booystrap 5==================================================> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <========================================== jquery ==================================================> -->
    <script src="../../node_modules/jquery/dist/jquery.js"></script>
    <!-- <==========================================data-teble==================================================> -->
    <script type="text/javascript" src="../../node_modules/data-table/jquery-table-2.min.js"></script>
    <script type="text/javascript" src="../../node_modules/data-table/dataTables_excel.js"></script>
    <script type="text/javascript" src="../../https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
    <!-- <==========================================data-teble==================================================> -->
    <script src="../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- <==========================================data-teble==================================================> -->
    <script>
    $(document).ready(function() { //function data table display for excel and pdf

        $('#stock').DataTable({
            dom: 'lBfrtip',
          buttons: [
            'excel', 'print'
          ],
        });
    });
    </script>
</head>
<body>
    <?php 
   
        
   if (isset($_REQUEST['update_id'])) {
      
            $id = $_REQUEST['update_id'];
      }else{
          $id=NULL;
      }
   
    $select_transfer_stock = $db->prepare("SELECT unit_name,code_item,item_name,SUM(transfer_qty)as sum_qty,transfer_price,SUM(transfer_qty_set)as sum_qty_set,transfer_stock_log.stock_id  FROM transfer_stock_log INNER JOIN stock ON transfer_stock_log.stock_id = stock.stock_id
INNER JOIN item ON stock.item_id = item.item_id
INNER JOIN unit ON item.unit_id = unit.unit_id
 WHERE transfer_stock_id='$id'
 GROUP BY code_item
 ");
        $select_transfer_stock->execute();
    
    ?>
    <div class="display-3 text-xl-center mt-3 mb-3">
            <H2>ปรับยอดรับ </H2>
        </div>
        <br>
        <div class="m-4">
    <button class="btn btn-yellow btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    คำเตือน
  </button>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
   <p>
     <div style="color:red"> 
      - ถ้ารายการไหน 0 หรือยังไม่ได้รับ ไม่ต้อง!!!กรอกตัวเลขอะไรลงไป ปล่อยให้ว่าง<br>
 
      </div>
     
    </p>
  </div>
</div>
        <hr>
    </div>
    <form name="surplus" id="surplus">
    <div class="container">
            <br>
<table class="table table-dark table-hover text-xl-center" id="stock_bn">
    <thead class="table-dark">
        <tr class="table-active">
        <th>NO.</th>
        <th>รหัส</th>
        <th>รายการ</th>
        <th>จำนวนส่ง</th>
        <th>หน่วย</th>
        <th>จำนวนรับ</th>
        <th>ราคา</th>
    </tr>
                </thead>
    <?php $i=1; ?>
    <?php while ($row_transfer = $select_transfer_stock->fetch(PDO::FETCH_ASSOC)) {?>
    <tr>
        <td><?php echo $i?></td>
        <td><?php echo $row_transfer['code_item'] ?></td>
        <td><?php echo $row_transfer['item_name'] ?></td>
        <td><?php echo $row_transfer['sum_qty'] ?></td>
        <td><?php echo $row_transfer['unit_name'] ?></td>
        <input type="text" name="sum_qty[]" value="<?php echo $row_transfer['sum_qty']?>" hidden>
        <input type="text" name="code[]" value="<?php echo $id?>" hidden>
        <input type="text" name="stock_id[]" value="<?php echo $row_transfer['stock_id']?>" hidden>
        <td><div class="input-group mb-3"><span class="input-group-text" >จำนวนที่ได้รับ</span><input type="text" class="form-control" name="sum_qty_set[]" value="<?php if($row_transfer['sum_qty_set']){echo $row_transfer['sum_qty_set'];}?>" size="1"></div></td>
        <td><?php echo $row_transfer['transfer_price'] ?></td>
        <input type="text" name="transfer_price[]" value="<?php echo $row_transfer['transfer_price']?>" hidden>
    </tr>
    
    <?php $i++; } ?>
    </table>
    <input type="submit" name="submit" id="submit" class="btn btn-outline-success" value="OK" />
    <a href="../transfer_inventory_check.php" class="btn btn-outline-danger">Back</a>
    </div>
    </form>

</body>
</html>
<script>
        $('#submit').click(function(e) {
        var data_add = $('#surplus').serialize(); 
        $.ajax({
            url: "transfer_reconcile_db.php",
            method: "POST",
            data: data_add,
            success: function(data) {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: "สำเร็จ",
                showConfirmButton: true,
                timer: false
                })
                setTimeout(function(){
                    window.location.href = "../transfer_inventory_check.php";
                }, 2800);
            
            }
        });
        e.preventDefault();
    });
</script>