
<link rel="icon" type="image/png" href="components/images/tooth.png" />
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <title>Plus dental clinic</title>
    <!-- <==========================================booystrap 5==================================================> -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <==========================================booystrap 5==================================================> -->

    <!-- <==========================================data-teble==================================================> -->
    <script src="node_modules/data-table/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="node_modules/data-table/datatables.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script type="text/javascript" src="node_modules/data-table/dataTables_excel.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
    <!-- <==========================================data-teble==================================================> -->
    <script>
    $(document).ready(function() {

        var table = $('#stock').DataTable({
            fixedHeader: {
                header: true
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "fetch_stock.php?page=2",
                type: "POST"
            },
            dom: 'lBfrtip',
            buttons: [
                'excel', 'print'
            ],
            //   "lengthMenu": [ [50, -1], [50, "All"] ],
            "searching": true,
            "lengthChange": false,
            "paging": false


        });

    });
    </script>


   
    
</head>

<body>
    

    

    <header>
        <div class="display-3 text-xl-center">
            <H2>PIVOT สต๊อกคลัง </H2>
        </div>
    </header>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col">
  
            </div>
        </div>
    </div>
    </header>

    <div  class="tableFixHead"style ="width:1900; word-wrap: break-word">
        <br>
        <table class="table table-hover text-center m-2 " id="stock">
            <thead class="table-dark">
                <tr>
                    <th class="text-center ">รหัส</th>
                    <th class="text-center ">รายการ</th>
                    <th class="text-center ">หน่วย</th>
                    <th class="text-center ">ผู้ขาย</th>
                    <th class="text-center ">ราคา</th>
                    <th class="text-center">RA</th>
                    <th class="text-center">AR</th>
                    <th class="text-center">SA</th>
                    <th class="text-center">AS</th>
                    <th class="text-center">ON</th>
                    <th class="text-center">UD</th>
                    <th class="text-center">NW</th>
                    <th class="text-center">CW</th>
                    <th class="text-center">R2</th>
                    <th class="text-center">LB</th>
                    <th class="text-center">BK</th>
                    <th class="text-center">CN</th>
                    <th class="text-center">รวม</th>
                    
                </tr>
            </thead>
            <tbody class="table-light">
                <tr>

                </tr>
            </tbody>
        </table>
    </div>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
