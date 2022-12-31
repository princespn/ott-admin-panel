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
                        <div class="col-md-4 box-title paddLeft"><?= $heading; ?></div>
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
                                    <th>Ticket Id</th>
                                    <th>Ticket Used Status</th>
                                    <th>Tournament</th>
                                  </tr>
                            </thead>
                            <tbody>
                              <?php $index=1; if(!empty($tickect_data)) { foreach ($tickect_data as $data) { ?>
                               <tr>
                                 <td><?php echo $index++;?></td>
                                 <td><?php echo $data['user_name'];?></td>
                                 <td><?php echo $data['ticketId'];?></td>
                                 <td><?php echo $data['ticketUsedStatus'];?></td>
                                 <td><?php echo $data['name'];?></td>
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

<!-- Load common footer -->
<?php $this->load->view('common/footer.php'); ?>

