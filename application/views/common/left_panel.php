<?php
$page = $this->uri->segment(1);
$split = explode('-', $page);
//print_r($page);exit;

$flag = $this->uri->segment(2);
// print_r($flag);exit;
$getProfile = $this->Crud_model->GetData("admin_login", 'image', 'id="' . $_SESSION[SESSION_NAME]['id'] . '"', '', '', '', '1');
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<?php
$image = $getProfile->image;
$path = "assets/images/profile/";
$file = FCPATH . $path . $image;
if (file_exists($file) && !empty($image)) {
	$img = base_url() . $path . $image;
} else {
	$img = base_url() . $path . "profile.png";
}
?>
				<img src="<?=$img;?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $_SESSION[SESSION_NAME]['name']; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="<?php if ($page == DASHBOARD) {
	echo " active";
}
?> ">
				<a href="<?php echo site_url(DASHBOARD); ?>">
					<i class="fa fa-home"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="<?php if ($split[0] == USERS) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(USERS); ?>">
					<i class="fa fa-users"></i>
					<span>Users Management</span>
				</a>
			</li>
			<li class="<?php if ($split[0] == CATEGORY) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(CATEGORY); ?>">
					<i class="fa fa-user-plus"></i>
					<span>Category List</span>
				</a>
			</li>
			<li class="<?php if ($split[0] == MOVIESLIDER) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(MOVIESLIDER); ?>">
					<i class="fa fa-user-plus"></i>
					<span>Movie Slider</span>
				</a>
			</li>

				<li class="<?php if ($split[0] == NOTIFICATION) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(NOTIFICATION); ?>">
					<i class="fa fa-bell" ></i>
					<span>Notification </span>
				</a>
			</li>
			<?php /*
<li class="treeview <?php if ($page == SETTINGS || $page == DAYWISETIMINGS) echo " active"; ?>">
<a href="javascript:void(0)">
<i class="fa fa-th"></i> <span>Manage Appearances</span>
<span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
</a>
<ul class="treeview-menu <?php if ($page == SETTINGS || $page == DAYWISETIMINGS) echo " active"; ?>">
<li class="<?php if ($page == SETTINGS) echo " active"; ?>">
<a href="<?php echo site_url(SETTINGS); ?>">
<i class="fa fa-gears"></i><span>Settings</span>
</a>
</li>

</ul>
</li>
 */?>
			<li class="<?php if ($split[0] == REFERRAL) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(REFERRAL); ?>">
					<i class="fa fa-user-plus"></i>
					<span>Referral List</span>
				</a>
			</li>
			<?php /*
<li class="<?php if ($page == MAINTAINANCE) echo "active"; ?>">
<a href="<?php echo site_url(MAINTAINANCE); ?>">
<i class="fa fa-wrench"></i> <span>Maintenance</span>
</a>
</li>

<li class="<?php if ($split[0] == KYC) echo " active"; ?>">
<a href="<?php echo site_url(KYC); ?>">
<i class="fa fa-money"></i>
<span>KYC</span>
</a>
</li>
 */?>
			<li class="<?php if ($split[0] == SUBSCRIPTION) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(SUBSCRIPTION); ?>">
					<i class="fa fa-gamepad"></i>
					<span>Subscription Management</span>
				</a>
			</li>

			<?php /*
<li class="<?php if ($split[0] == VIDEO) echo " active"; ?>">
<a href="<?php echo site_url(VIDEO); ?>">
<i class="fa fa-gamepad"></i>
<span>Video Management</span>
</a>
</li>
 */?>
			<li class="<?php if ($split[0] == MOVIE) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(MOVIE); ?>">
					<i class="fa fa-film"></i>
					<span>Movie Management</span>
				</a>
			</li>
			<li class="<?php if ($split[0] == SERIES) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(SERIES); ?>">
					<i class="fa fa-television"></i>
					<span>Series Management</span>
				</a>
			</li>


			<li class="<?php if ($split[0] == SUPPORT) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(SUPPORT); ?>">
					<i class="fa fa-gamepad"></i>
					<span>Support</span>
				</a>
			</li>


			<li class="<?php if ($split[0] == BANNER) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(BANNER); ?>/series">
					<i class="fa fa-gamepad"></i>
					<span>Banner</span>
				</a>
			</li>
<!--
			<li class="<?php if ($split[0] == REFUNDSTATUS) {
	echo " active";
}
?>">
				<a href="<?php echo site_url(REFUNDSTATUS); ?>">
					<i class="fa fa-money"></i>
					<span>Refund Status Logs</span>
				</a>
			</li> -->
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
