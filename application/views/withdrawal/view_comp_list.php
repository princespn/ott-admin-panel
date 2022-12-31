<!-- Load common header -->
<?php $this->load->view('common/header');
?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url(WITHDRAWALREJECTREQ); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header with-border">
              <div class="col-md-8 box-title paddLeft"><?= $heading; ?>
                 <!-- <span class="box-title" id="msgHide">&nbsp; &nbsp;
                  <?php if(!empty($this->session->flashdata('message'))) echo  $this->session->flashdata('message'); ?> 
                  </span> -->
                </div>
             <div class="col-md-4 paddRight"> <a href="<?= site_url(WITHDRAWALCOMPREQ); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a></div>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
                <div class="col-xs-12">
                  
                  <!-- <form method="post" action="<?= $action1; ?>" id="showBtn"> -->
                  
                
                  <div class="col-xs-6" style="padding-left:0" id="myDiv">
                    <table class="table table-bordered table-responsive" border="1">
                      <tr>
                        <td width="180px"><strong>Order Id</strong></td>
                        <td><?php if(!empty($getData->orderId)) { echo ucwords($getData->orderId); } else { echo "NA"; } ?> </td>
                      </tr>
                      <tr>
                        <td width="180px"><strong>Payment Mode</strong></td>
                        <td><?php if(!empty($getData->paymentType)) { echo ucwords($getData->paymentType); } else { echo "NA"; } ?> </td>
                      </tr>
                      <tr>
                        <td width="180px"><strong>Mobile number</strong></td>
                        <td><?php if(!empty($getData->mobile)) { echo ucwords($getData->mobile); } else { echo "NA"; } ?> </td>
                      </tr>
                      <tr>
                        <td width="180px"><strong>Account Name</strong></td>
                        <td><?php if(!empty($getData->acc_holderName)) { echo $getData->acc_holderName; } else { echo "NA"; } ?></td>
                      </tr>
                      <tr>
                        <td width="180px"><strong>Account Number </strong></td>
                        <td> <?php if(!empty($getData->accno)) { echo $getData->accno; } else { echo "NA"; } ?></td>
                      </tr>
                      <tr>
                        <td width="180px"><strong>IFSC </strong></td>
                        <td> <?php if(!empty($getData->ifsc)) { echo $getData->ifsc; } else { echo "NA"; } ?></td>
                      </tr>
                      <tr>
                        <td width="180px"><strong>Amount </strong></td>
                        <td> <?php if(!empty($getData->amount)) { echo $getData->amount; } else { echo "NA"; } ?></td>
                      </tr>
                      <tr>
                        <td width="180px"><strong>Withdrawl Date </strong></td>
                        <td> <?php if(!empty($getData->created)) { echo date('d M Y H:i A', strtotime($getData->created)); } else { echo "NA"; } ?></td>
                      </tr>
                    </table>
                  </div>
                </div> 
              </div>
            <!-- /.box-body -->
            <!-- </form> -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->          
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Load common footer -->
<?php $this->load->view('common/footer'); ?>