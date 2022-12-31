<!-- Load common header -->
<?php $this->load->view('common/header'); ?>

<!-- Load common left panel -->
<?php $this->load->view('common/left_panel.php'); ?>
<style type="text/css">
  /*---------chat window---------------*/
.container{
    max-width:900px;
}
.inbox_people {
  background: #fff;
  float: left;
  overflow: hidden;
  width: 30%;
  border-right: 1px solid #ddd;
}

.inbox_msg {
  border: 1px solid #ddd;
  clear: both;
  overflow: hidden;
}

.top_spac {
  margin: 20px 0 0;
}

.recent_heading {
  float: left;
  width: 40%;
}

.srch_bar {
  display: inline-block;
  text-align: right;
  width: 60%;
  padding:
}

.headind_srch {
  padding: 10px 29px 10px 20px;
  overflow: hidden;
  border-bottom: 1px solid #c4c4c4;
}

.recent_heading h4 {
  color: #0465ac;
    font-size: 16px;
    margin: auto;
    line-height: 29px;
}

.srch_bar input {
  outline: none;
  border: 1px solid #cdcdcd;
  border-width: 0 0 1px 0;
  width: 80%;
  padding: 2px 0 4px 6px;
  background: none;
}

.srch_bar .input-group-addon button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  padding: 0;
  color: #707070;
  font-size: 18px;
}

.srch_bar .input-group-addon {
  margin: 0 0 0 -27px;
}

.chat_ib h5 {
  font-size: 15px;
  color: #464646;
  margin: 0 0 8px 0;
}

.chat_ib h5 span {
  font-size: 13px;
  float: right;
}

.chat_ib p {
    font-size: 12px;
    color: #989898;
    margin: auto;
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.chat_img {
  float: left;
  width: 11%;
}

.chat_img img {
  width: 100%
}

.chat_ib {
  float: left;
  padding: 0 0 0 15px;
  width: 88%;
}

.chat_people {
  overflow: hidden;
  clear: both;
}

.chat_list {
  border-bottom: 1px solid #ddd;
  margin: 0;
  padding: 18px 16px 10px;
}

.inbox_chat {
  height: 550px;
  overflow-y: scroll;
}

.active_chat {
  background: #e8f6ff;
}

.incoming_msg_img {
  display: inline-block;
  width: 6%;
}

.incoming_msg_img img {
  width: 100%;
}

.received_msg {
  display: inline-block;
  padding: 0 0 0 10px;
  vertical-align: top;
  width: 92%;
}

.received_withd_msg p {
  background: #ebebeb none repeat scroll 0 0;
  border-radius: 0 15px 15px 15px;
  color: #646464;
  font-size: 14px;
  margin: 0;
  padding: 5px 10px 5px 12px;
  width: 100%;
}

.time_date {
  color: #747474;
  display: block;
  font-size: 12px;
  margin: 8px 0 0;
}

.received_withd_msg {
  width: 57%;
}

.mesgs{
  float: left;
  padding: 30px 15px 0 25px;
  width:70%;
}

.sent_msg p {
  background:#0465ac;
  border-radius: 12px 15px 15px 0;
  font-size: 14px;
  margin: 0;
  color: #fff;
  padding: 5px 10px 5px 12px;
  width: 100%;
}

.outgoing_msg {
  overflow: hidden;
  margin: 26px 0 26px;
}

.sent_msg {
  float: right;
  width: 46%;
}

.input_msg_write input {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: medium none;
  color: #4c4c4c;
  font-size: 15px;
  min-height: 48px;
  width: 100%;
  outline:none;
}

.type_msg {
  border-top: 1px solid #c4c4c4;
  position: relative;
}

.msg_send_btn {
  background: #05728f none repeat scroll 0 0;
  border:none;
  border-radius: 50%;
  color: #fff;
  cursor: pointer;
  font-size: 15px;
  height: 33px;
  position: absolute;
  right: 0;
  top: 11px;
  width: 33px;
}

.messaging {
  padding: 0 0 50px 0;
}

.msg_history {
  height: 516px;
  overflow-y: auto;
}
</style>
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

         <div class="messaging ">
  <div class="inbox_msg bShow">
  <div class="inbox_people ">
    <div class="headind_srch">
    <div class="recent_heading">
      <h4>Recent</h4>
    </div>
   <!--  <div class="srch_bar">
      <div class="stylish-input-group">
      <input type="text" class="search-bar"  placeholder="Search" >
      </div>
    </div> -->
    </div>
    <div class="inbox_chat scroll">
    <div class="chat_list active_chat">
      <div class="chat_people">
      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
      <div class="chat_ib">
        <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
        <p>Test, which is a new approach to have all solutions 
        astrology under one roof.</p>
      </div>
      </div>
    </div>
    <div class="chat_list">
      <div class="chat_people">
      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
      <div class="chat_ib">
        <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
        <p>Test, which is a new approach to have all solutions 
        astrology under one roof.</p>
      </div>
      </div>
    </div>
    <div class="chat_list">
      <div class="chat_people">
      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
      <div class="chat_ib">
        <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
        <p>Test, which is a new approach to have all solutions 
        astrology under one roof.</p>
      </div>
      </div>
    </div>
    <div class="chat_list">
      <div class="chat_people">
      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
      <div class="chat_ib">
        <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
        <p>Test, which is a new approach to have all solutions 
        astrology under one roof.</p>
      </div>
      </div>
    </div>
    <div class="chat_list">
      <div class="chat_people">
      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
      <div class="chat_ib">
        <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
        <p>Test, which is a new approach to have all solutions 
        astrology under one roof.</p>
      </div>
      </div>
    </div>
    <div class="chat_list">
      <div class="chat_people">
      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
      <div class="chat_ib">
        <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
        <p>Test, which is a new approach to have all solutions 
        astrology under one roof.</p>
      </div>
      </div>
    </div>
    <div class="chat_list">
      <div class="chat_people">
      <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
      <div class="chat_ib">
        <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
        <p>Test, which is a new approach to have all solutions 
        astrology under one roof.</p>
      </div>
      </div>
    </div>
    </div>
  </div>
  <div class="mesgs bShow">
    <div class="msg_history">
    <div class="incoming_msg">
      <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
      <div class="received_msg">
      <div class="received_withd_msg">
        <p>Test which is a new approach to have all
        solutions</p>
        <span class="time_date"> 11:01 AM    |    June 9</span></div>
      </div>
    </div>
    <div class="outgoing_msg">
      <div class="sent_msg">
      <p>Test which is a new approach to have all
        solutions</p>
      <span class="time_date"> 11:01 AM    |    June 9</span> </div>
    </div>
    <div class="incoming_msg">
      <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
      <div class="received_msg">
      <div class="received_withd_msg">
        <p>Test, which is a new approach to have</p>
        <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
      </div>
    </div>
    <div class="outgoing_msg">
      <div class="sent_msg">
      <p>Apollo University, Delhi, India Test</p>
      <span class="time_date"> 11:01 AM    |    Today</span> </div>
    </div>
    <div class="incoming_msg">
      <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
      <div class="received_msg">
      <div class="received_withd_msg">
        <p>We work directly with our designers and suppliers,
        and sell direct to you, which means quality, exclusive
        products, at a price anyone can afford.</p>
        <span class="time_date"> 11:01 AM    |    Today</span></div>
      </div>
    </div>
    </div>
    <div class="type_msg">
    <div class="input_msg_write">
      <input type="text" class="write_msg" placeholder="Type a message" />
      <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
    </div>
    </div>
  </div>
  </div>
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

<script type="text/javascript">
  var url = '<?= site_url(USERREPORTLIST); ?>';
  var actioncolumn=4;
  var pageLength='';
    
</script>
  <!-- Load common footer -->

<script type="text/javascript">
  
</script>
<?php $this->load->view('common/footer.php'); ?>