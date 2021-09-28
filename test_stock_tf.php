<?php 
include('database/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- <==========================================booystrap 5==================================================> -->
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
<!-- <========================================== jquery ==================================================> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script> -->
<!-- <========================================== jquery ==================================================> -->
<script src="node_modules/jquery/dist/jquery.js"></script>
  <!-- <==========================================data-teble==================================================> -->
 <script type="text/javascript" src="node_modules/data-table/jquery-table-2.min.js"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">     -->
   <!-- <link rel="stylesheet" href="node_modules/data-table/dataTables.bootstrap.min.css" />  -->
  <script type="text/javascript" src="node_modules/data-table/dataTables_excel.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<!-- <==========================================data-teble==================================================> -->
<script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- <==========================================data-teble==================================================> -->
    <script>
    $(document).ready(function() {

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
    $id = "ON492959CN";
    $select_transfer_stock = $db->prepare("SELECT code_item,item_name,SUM(transfer_qty)as sum_qty,transfer_price,SUM(transfer_qty_set)as sum_qty_set,transfer_stock_log.stock_id  FROM transfer_stock_log INNER JOIN stock ON transfer_stock_log.stock_id = stock.stock_id
INNER JOIN item ON stock.item_id = item.item_id
 WHERE transfer_stock_id='$id'
 GROUP BY code_item
 ");
        $select_transfer_stock->execute();
    ?>
    <form name="surplus" id="surplus">
    <table class="table" id="stock">
    <tr  id="transfer">
        <th>NO.</th>
        <th>รหัส</th>
        <th>รายการ</th>
        <th>จำนวนส่ง</th>
        <th>จำนวนรับ</th>
        <th>ราคา</th>
    </tr>
    <?php $i=1; ?>
    <?php while ($row_transfer = $select_transfer_stock->fetch(PDO::FETCH_ASSOC)) {?>
    <tr>
        <td><?php echo $i?></td>
        <td><?php echo $row_transfer['code_item'] ?></td>
        <td><?php echo $row_transfer['item_name'] ?></td>
        <td><?php echo $row_transfer['sum_qty'] ?></td>
        <input type="text" name="sum_qty[]" value="<?php echo $row_transfer['sum_qty']?>" hidden>
        <input type="text" name="code[]" value="<?php echo $id?>" hidden>
        <input type="text" name="stock_id[]" value="<?php echo $row_transfer['stock_id']?>" hidden>
        <td><div class="input-group mb-3"><span class="input-group-text" >จำนวนที่ได้รับ</span><input type="text" class="form-control" name="sum_qty_set[]" value="<?php echo $row_transfer['sum_qty_set'] ?>" size="1"></div></td>
        <td><?php echo $row_transfer['transfer_price'] ?></td>
    </tr>
    <?php $i++; } ?>
    </table>
    <input type="submit" name="submit" id="submit" class="btn btn-success" value="OK" />
    </form>
</body>
</html>
<script>
        $('#submit').click(function(e) {
        var data_add = $('#surplus').serialize(); 
        $.ajax({
            url: "data-stock/manage_db_stock/transfer_reconcile.php",
            method: "POST",
            data: data_add,
            success: function(data) {
                // alert(data);
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: data,
                showConfirmButton: true,
                timer: false
                })
                setTimeout(function(){
                window.location.reload(1);
                }, 2800);
            
            }
        });
        e.preventDefault();
    });
</script>