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
        <li><a href="<?= site_url('Dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url('Rooms'); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header">
              <div class="col-md-8 box-title paddLeft"><?= $heading; ?></div>
             <div class="col-md-4 paddRight"> <a href="<?= site_url(PLAYERS); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <td class="text_view"><b>Player</b></td>
                        <td>:</td>
                        <td><?php if(!empty($player)){ echo ucfirst($player); }else{ echo "N/A";} ?></td>
                        <td class="text_view"><b>Status</b></td>
                        <td>:</td>
                        <td>
                          <?php
                            if(!empty($status) && $status == 'Active')
                              $class = 'label label-success';
                            else
                              $class = 'label label-danger';
                          ?>
                          <span class="<?= $class; ?>"><?php if(!empty($status)){ echo ucfirst($status); }else{ echo "N/A";} ?></span>
                        </td>
                    </tr>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>
