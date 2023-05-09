<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TASK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url();?>assets/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
       * {font-family: 'Lilita One', cursive;}
       #errors p{
         text-transform: uppercase;
         font-size: 12px;
         color: #000!important;
       }
    </style>
  </head>
  <body> 



  <div class="section">
     <div class="container">
        <div class="row justify-content-center">
           <div class="col-lg-12 mt-5">

                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                  <div class="container-fluid text-center">
                    <a class="navbar-brand" href="#">TASK</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                      <ul class="navbar-nav">

                        <li class="nav-item"><a class="nav-link active fs-10" aria-current="page" href="<?= base_url();?>">HOME</a></li> 
                        <li class="nav-item"><a class="nav-link active fs-10" aria-current="page" href="<?= base_url('list');?>">LISTINGS</a></li> 
                        <li class="nav-item"><a class="nav-link active fs-10" aria-current="page" href="<?= base_url('trash');?>">TRASH LISTINGS</a></li> 

                      </ul>
                    </div>
                  </div>
                </nav>

           </div>
           <div class="col-lg-12 p-5 mt-5">

               <div class="card">
                  <div class="card-header">
                    <h4 class="text-uppercase pt-2">USER <span class="text-primary">REGISTRATION TRASH LISTINGS</span></h4>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive">
                         <table class="table table-bordered w-100" id="data-table">
                                <thead>
                                    <tr>
                                        <th class="small">S.NO</th>
                                        <th class="small">FIRST NAME</th>
                                        <th class="small">LAST NAME</th>
                                        <th class="small">EMAIL ID</th>
                                        <th class="small">PHONE NUMBER</th>
                                        <th class="small">SKILLS</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody> 
                                   <?php foreach($trashlists as $row):?>
                                          <tr>
                                             <td><?= $row['id'];?></td>
                                             <td><?= $row['fname'];?></td>
                                             <td><?= $row['lname'];?></td>
                                             <td><?= $row['email'];?></td>
                                             <td><?= $row['phone'];?></td>
                                             <td><?php 
                                                $skills = explode(',',$row['skills']);
                                                $i=0;
                                                foreach($skills as $skill):?>
                                                   <span class="badge badge-primary bg-danger badge-pill" style="font-weight:400;"><?= $skill; ?></span>
                                                <?php $i++;endforeach;?>   
                                             </td>
                                             <td class="text-end">
                                                 <div class="btn-group btn-group-sm"> 
                                                    <button type="button" onclick="restore_user(<?= $row['id']?>)" class="btn btn-warning">RESTORE</button>
                                                    <button type="button" onclick="get_user(<?= $row['id']?>)" class="btn btn-danger">DELETE</button>
                                                 </div>
                                             </td>
                                          </tr>
                                   <?php  endforeach;?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="small">S.NO</th>
                                        <th class="small">FIRST NAME</th>
                                        <th class="small">LAST NAME</th>
                                        <th class="small">EMAIL ID</th>
                                        <th class="small">PHONE NUMBER</th>
                                        <th class="small">SKILLS</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                         </table>
                      </div>
                         

                  </div> 
               </div> 

           </div>
        </div>
     </div>
  </div>








 
<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title small" id="exampleModalLabel">REQUIRED FIELDS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" id="userDelForm">
      <div class="modal-body text-center"> 
         <h5 class="text-uppercase">DO YOU REALLY WANT TO DELETE PERMANENTLY ?</h5>
        <input type="hidden" name="id">
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">NO</button> 
        <button type="button" onclick="delete_user()" class="btn btn-primary">YES</button> 
      </div>
    </form>
    </div>
  </div>
</div>





    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url();?>assets/bootstrap-tagsinput.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#data-table').DataTable();
        });

        $('#floatingInputTags').val(); 

        function restore_user(id)
        { 
            $('.form-group').removeClass('has-error'); 
            $('.help-block').empty();
            $.ajax({
                url : "<?php echo base_url('main/trash/restore/')?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    alert(data.msg);
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('ERROR, SOMETHING WENT WRONG...!!!'); 
                }
            });
        }


        function get_user(id)
        { 
            $('.form-group').removeClass('has-error'); 
            $('.help-block').empty();
            $.ajax({
                url : "<?php echo base_url('main/trash/get-user/')?>" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                     $('[name="id"]').val(data.id);
                     $('#deleteModal').modal('show');
                     $('.modal-title').text('PERMANENTLY DELETE ?'); 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                   alert('ERROR, SOMETHING WENT WRONG...!!!'); 
                }
            });
        }

        function delete_user(id){
              $('#btnReg').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> DELETING...');
              $('#btnReg').attr('disabled',true); 
              var url;
              var formulario = new FormData($('#userDelForm').get(0));      
              url = "<?php echo base_url('main/trash/delete-permanently/')?>" + id; 
              $.ajax({
                  url : url,
                  type: "POST",
                  data: formulario,
                  processData: false,
                  contentType: false,
                  dataType: "JSON",
                  success: function(data)
                  {
                      if(data.status)
                      {    
                          alert(data.msg);
                          location.reload();
                      }else{ 
                          alert(data.msg);
                      } 
                      $('#btnReg').html('DELETE');
                      $('#btnReg').attr('disabled',false);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      console.log(jqXHR);
                      console.log(textStatus);
                      console.log(errorThrown);
                      alert('ERROR, SOMETHING WENT WRONG...!!!'); 
                      $('#btnReg').html('DELETE');
                      $('#btnReg').attr('disabled',false); 
                  }
              });
        }
    </script>
  </body>
</html>