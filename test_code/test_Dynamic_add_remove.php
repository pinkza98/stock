<html>  
      <head>  
           <title> test</title>  
           <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css"> 
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <div class="container">  
                <br />  
                <br />  
                <div class="mb-5" >
                <h2 class="text-center">เพิ่มรายการสต๊อก</h2>  
                </div>
                <div class=" container">  
                     <form name="add_name" id="add_name">  
                     <div class="">
                            <div class="col-md-4">
                                <div class="form.group">
                                    <input type="text" name="name[]" placeholder="Enter Code item" class="form-control name_list" id="code_item" autofocus>
                                </div>
                            </div>
                            
                            <div class="col-md-2">

                            <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                            </div>
                        </div>
                       
                     </form>
                     <form name="add_name" id="add_name">  
                          <div class="responsive p-6">  
                               <table class="table table-bordered" id="dynamic_field">  
                               <thead class="table-dark ">
                                    <th>รหัสบาร์โค้ด</th>
                                    <th>จำนวน</th>
                                    <th>ลบ</th>
                               </thead>
                                    <tr>  

                                    </tr>  
                               </table>  
                          </div>  
                     </form>
                     
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      var i=1;  
      var s=1;
      $("#code_item").keypress(function(e) {
    if(e.which == 13) {
        $("#add").click();
        code_item = "";
    }
  
        });
        
       

        $("#add").click(function(e){
            i++;  
          
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" class="form-control name_list" id = "'+s+'"/></td><td><input type="text" name="name[]" placeholder="Enter your Qty" class="form-control name_list" id = "'+s+'"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>'); 
        });
        $(document).on('click', '.btn_remove', function(e){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $('#submit').click(function(){            
           $.ajax({  
                url:"name.php",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                     alert(data);  
                     $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
 </script>