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
                        <li class="nav-item"><a class="nav-link active fs-10" aria-current="page" href="<?= base_url('list');?>">LISTINGSS</a></li> 
                        <li class="nav-item"><a class="nav-link active fs-10" aria-current="page" href="<?= base_url('trash');?>">TRASH LISTINGS</a></li> 

                      </ul>
                    </div>
                  </div>
                </nav>

           </div>
           <div class="col-lg-8 p-5 mt-5">
 
                 <form id="userRegForm">
                   <div class="card">
                      <div class="card-header">
                        <h4 class="text-uppercase pt-2">USER <span class="text-primary">REGISTRATION</span></h4>
                      </div>
                      <div class="card-body">
                            <input type="hidden" name="id" value="<?= $detail['id'];?>">
                            <div class="form-floating mb-3">
                              <input type="text" name="fname" class="form-control" id="floatingInputFname" value="<?= $detail['fname'];?>" placeholder="first name" autocomplete="none">
                              <label for="floatingInputFname">FIRST NAME</label>
                            </div>                        
                            <div class="form-floating mb-3">
                              <input type="text" name="lname" class="form-control" id="floatingInputLname" value="<?= $detail['lname'];?>"  placeholder="last name" autocomplete="none">
                              <label for="floatingInputLname">LAST NAME</label>
                            </div>
                            <div class="form-floating mb-3">
                              <input type="email" name="email" class="form-control" id="floatingInputEmail" value="<?= $detail['email'];?>"  placeholder="email" autocomplete="none">
                              <label for="floatingInputEmail">EMAIL ID</label>
                            </div>
                            <div class="form-floating mb-3">
                              <input type="number" name="phone" class="form-control" id="floatingInputPhone" value="<?= $detail['phone'];?>"  placeholder="phone">
                              <label for="floatingInputPhone">PHONE</label>
                            </div>
                            <div class="mb-3">
                              <label for="floatingInputTags" class="ps-2">&nbsp;SKILLS</label><br>
                              <input type="text" name="skills" class="form-control"  value="<?= $detail['skills'];?>"  placeholder="" data-role="tagsinput">
                            </div>

                      </div>
                      <div class="card-footer text-end">
                          <button type="button" id="btnReg" onclick="user_update()" class="btn btn-primary">UPDATE NOW</button>
                      </div>
                   </div>
                 </form>

           </div>
        </div>
     </div>
  </div>








 
<!-- ERRORS MODAL -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title small" id="exampleModalLabel">REQUIRED FIELDS</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div id="errors"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">CLOSE</button> 
      </div>
    </div>
  </div>
</div>





    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="<?= base_url();?>assets/bootstrap-tagsinput.min.js"></script>
    <script>
        $('#floatingInputTags').val();
        function user_update(){
              $('#btnReg').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> UPDATING...');
              $('#btnReg').attr('disabled',true); 
              var url;
              var formulario = new FormData($('#userRegForm').get(0));      
              url = "<?php echo base_url('main/list/update-user')?>"; 
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
                          $('#errors').html(data.msg); 
                          $('#errorModal').modal('show');
                      } 
                      $('#btnReg').html('UPDATE NOW');
                      $('#btnReg').attr('disabled',false);
                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                      console.log(jqXHR);
                      console.log(textStatus);
                      console.log(errorThrown);
                      alert('ERROR, SOMETHING WENT WRONG...!!!'); 
                      $('#btnReg').html('UPDATE NOW');
                      $('#btnReg').attr('disabled',false); 
                  }
              });
        }
    </script>
  </body>
</html>