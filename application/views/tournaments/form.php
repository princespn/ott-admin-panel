<!-- Load common header -->
<?php $this->load->view('common/header'); ?>
<!-- Load common left panel -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/datepicker/jquery-ui.css">
<?php $this->load->view('common/left_panel.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?= $heading; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= site_url(DASHBOARD); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?= site_url(TOURNAMENTS); ?>"><?= $breadhead; ?></a></li>
        <li><?= $bread; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box bShow">
            <div class="box-header">
              <div class="col-md-10 box-title"><?= $heading; ?></div>
              <div class="col-md-2 text-right text-danger">* Fields are required</div>
            </div>
            <!-- /.box-header -->
             <?php echo form_open($action); ?>
                <!-- <?= form_hidden($hidden);?> -->
            <!-- <form  method="post" id="tornamntForm" action="<?= $action; ?>" > -->
              <div class="box-body">
                 <input type="hidden" class="form-control" name="id" id="id" placeholder="Name" value="<?= $id; ?>" autocomplete="off">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name<span class="text-danger"></span> <span class="text-danger">*</span><span id="errName" class="text-danger"></span></label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?= $name; ?>" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bet Amount<span class="text-danger"></span> <span id="errbetAmt" class="text-danger"></span></label>
                    <input type="text" class="form-control" onkeypress="only_number(event)"  name="betAmt" id="betAmt" placeholder="Bet Amount" value="<?= $betAmt; ?>" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Winning Amount<span class="text-danger"></span> <span id="errwinningAmt" class="text-danger"></span></label>
                    <input type="text" class="form-control" onkeypress="only_number(event)"  name="winningAmt" id="winningAmt" placeholder="Winning Amount" value="<?= $winningAmt; ?>" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>No. Of Players<span class="text-danger"></span> <span class="text-danger">*</span><span id="errnoOfPlayers" class="text-danger"></span></label>
                     <input type="text" class="form-control" onkeypress="only_number(event)" name="noOfPlayers" id="noOfPlayers" placeholder="Players" value="<?= $noOfPlayers; ?>" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>No of Rounds<span class="text-danger"></span> <span id="errround" class="text-danger"></span></label>
                    <input type="text" class="form-control" onkeypress="only_number(event)" name="round" id="round" placeholder="No of Rounds" value="<?= $round; ?>" autocomplete="off">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Start Time<span class="text-danger"></span> <span id="errstartTime" class="text-danger"></span></label>
                    <input type="text" class="form-control" name="startTime" id="startTime"  placeholder="h:i AM/AM" value="<?= date("h:i a",strtotime($startTime)); ?>"  readonly="true" autocomplete="off">
                  </div>
                </div>

                 <div class="col-md-6">
                  <div class="form-group">
                    <label>Commision <span class="text-danger"></span> <span id="errcommision" class="text-danger"></span></label>
                    <input type="text" class="form-control" onkeypress="only_number(event)" name="commision" id="commision" placeholder="commision" value="<?= $commision; ?>" autocomplete="off">
                  </div>
                </div>


                <div class="col-md-12" style="margin-top: 10px;">
                  <div class="form-group">
                    <input type="hidden" name="button" id="button" value="<?= $button; ?>">
                    <!-- <input type="hidden" name="id" value="<?= $id; ?>"> -->
                    <button type="submit" class="btn btn-primary" onclick="return validTournament()"><?= $button; ?></button>&nbsp;
                    <a href="<?= site_url('Tournaments'); ?>"><button type="button" class="btn btn-danger">Cancel</button></a>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
               <?php echo form_close(); ?>
            <!-- </form> -->
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
<script type="text/javascript">
  $('#startTime').timepicker({
       showInputs: false
      });
</script>
<!-- <script type="text/javascript">
   $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( ".from_date" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( ".to_date" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;

      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
</script> -->
<script type="text/javascript">
  // var todaydate = new Date();
  //         $( function() {
  //         $( ".datepick" ).datepicker({ 
  //           // maxDate:0,
  //           defaultDate:todaydate
  //         });
  //       } );

  function only_number(event)
    {
      var x = event.which || event.keyCode;
      console.log(x);
      if((x >= 48 ) && (x <= 57 ) || x == 8 | x == 9 || x == 13)
      {
        return;
      }else{
        event.preventDefault();
      }    
    }
</script>
<script src="<?php echo base_url();?>assets/datepicker/jquery-ui.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/custom_js/tournament.js"></script>