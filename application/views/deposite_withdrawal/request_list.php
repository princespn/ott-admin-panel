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
          <div class="box-header">
            <div class="col-md-4 box-title paddLeft">User Deposite Withdrawal Request  </div>

          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <hr>
          
              <div class="box-header">
           
               

              </div>
              <table class="table table-bordered table-striped display" id="example_datatable" style="width: 100%;">
                <thead>
                  <tr>
                    <th>Sno.</th>
                    <th>Username</th>
                    <th>PaymentType</th>
                    <th>Amount</th>
                    <th>Coin Wallet</th>
                    <th>Main Wallet</th>
                    <th>Win Wallet</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                     <?php $index=1; if(!empty($getWithdrawalRecords))   { foreach ($getWithdrawalRecords as $getRecords) { ?>
                   <tr>
                      <td><?php echo $index++; ?></td>
                      <td><?php echo  $getRecords->user_name;?></td>
                      <td><?php echo  $getRecords->paymentType;?></td>
                      <td><?php echo  $getRecords->amount;?></td>
                      <td><?php echo  $getRecords->coinWallet;?></td>
                      <td><?php echo  $getRecords->mainWallet;?></td>
                      <td><?php echo  $getRecords->winWallet;?></td>
                      <td><?php echo  $getRecords->type;?></td>
                      <td>
                        <?php if($getRecords->status == 'Pending'){?><span class='label label-warning'>Pending</span>
                        <?php }else if($getRecords->status == 'Process'){?><span class='label label-info'>Process</span>
                        <?php }else if($getRecords->status == 'Approved'){?><span class='label label-success'>Approved</span>
                        <?php }else{?><span class='label label-danger'>Rejected</span> <?php } ?>
                      </td>
                      <td><?php echo  $getRecords->created;?></td>
                      <td>
                          <span class="fa fa-check btn btn-success btn-sm" onclick="changeStatus('<?php echo $getRecords->id;?>')"></span>

                      </td>
                   </tr>
                   <?php } } ?>
                </tbody>
              </table>
            </div>


            <!-- /.box-body -->
        
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>


<script type="text/javascript">

function changeStatus(id) {
     $("#Statusmodal").modal('show');
     $("#statusSuccBtn").click(function(){
     var site_url = $("#site_url").val();
     var url = "DepositWithdraw/changeStatus";
       var datastring = "id="+id+"&"+csrfName+"="+csrfHash;
       $.post(url,datastring,function(data){
         $("#Statusmodal").modal('hide');
         $("#Statusmodal").load(location.href+" #Statusmodal>*","");
         var obj = JSON.parse(data);
         csrfName = obj.csrfName;
         csrfHash = obj.csrfHash;
        $("#msgData").val(obj.msg);
         $("#toast-fade").click();
       });
     });
 }  
</script>