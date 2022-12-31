<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $heading; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><?= $bread; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box bShow">
                    <div class="box-header col-md-12">
                       <!-- <div class="col-md-4 box-title paddLeft"><?= $heading; ?></div>-->
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-right paddRight">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="example_datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>User Name</th>
                                    <th>Mobile</th>
                                    <th>E-mail</th>
                                    <th>Massage</th>
                                    <th>Status</th>
                                    <th></th>
                                   <th>Options <th>
                                  </tr>
                            </thead>
                            <tbody>
                              <?php $index=1; if(!empty($support_data)) { foreach ($support_data as $data) { ?>
                               <tr>
                                 <td><?php echo $index++;?></td>
                                 <td><?php echo $data->name;?></td>
                                 <td><?php echo $data->mobile;?></td>
                                 <td><?php echo $data->email;?></td>
                                  <td><?php echo $data->message;?></td>
                                 <td><span id="status_span<?php echo $data->id; ?>" onclick="return change_status('<?php echo $data->id; ?>')";  style='cursor:pointer;' class="<?php if($data->status !=='Pending'){echo "label label-success";}else {echo "label label-danger";}?>"><?php echo $data->status;?></span></td>
                                 <td></td>
                                  <td><!--<span title="Edit" class="btn btn-primary btn-xs"  data-placement="right"
                                         onclick="edit_subscription('<?php //echo $data->id; ?>')"><i class="fa fa-edit"></i></span>
                                        &nbsp;|&nbsp; -->
                                        <button title='Delete' class='btn btn-danger btn-xs' onclick="deleteSubs( '<?php  echo $data->id; ?>')"><i class='fa fa-trash-o'></i></button>
                                      </td>
                               </tr>
                              <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
   
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
    
   function change_status(id)
   { 
     $("#Statusmodal").modal('show');
     $("#statusSuccBtn").click(function(){
     var site_url = $("#site_url").val();
      var url        =  site_url+"/<?= SUPPORTCHANGESTATUS; ?>";
     //var url = site_url+"/Support'/change_status";
       var datastring = "id="+id+"&"+csrfName+"="+csrfHash;
       $.post(url,datastring,function(data){        
         $("#Statusmodal").load(location.href+" #Statusmodal>*","");
          $("#Statusmodal").modal('hide');
          location.reload();
         var obj = JSON.parse(data);
         csrfName = obj.csrfName;
         csrfHash = obj.csrfHash;
         table.draw();
         $("#msgData").val(obj.msg);
         $("#toast-fade").click();
       });
     });
   }

   
   
   function deleteSubs(id) {

       $("#Deletemodal").modal('show');
       $("#deleteSuccBtn").click(function(){
         var site_url   = $("#site_url").val();
         var url        =  site_url+"/<?= DELSUPPORT; ?>";
         var datastring =  'id='+id+"&"+csrfName+"="+csrfHash;
         $.post(url,datastring,function(response){
          $("#Deletemodal").load(location.href+" #Deletemodal>*","");
            $("#Deletemodal").modal('hide');
             location.reload();
             var obj   = JSON.parse(response);
             csrfName = obj.csrfName;
             csrfHash = obj.csrfHash;
             table.draw();
             $("#msgData").val(obj.msg);
             $("#toast-fade").click();
           });
       });
     }
</script>

<!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>

