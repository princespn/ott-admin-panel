<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = LOGIN;
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route[LOGIN] = 'Login';
$route[PROFILE] = 'Login/profile';
$route[CHANGEKEY] = 'Login/changekey';
$route[LOGOUT] = 'Login/logout';
$route[DASHBOARD] = 'Dashboard';
$route[CHNGPASSWORD] = '/Login/changePassword';
$route[LOGINACTION] = '/Login/loginAction';

/* User Routing */
$route[USERS] = 'Users';
$route[USERDETAILS] = 'Users/getUserDetails';
$route[USERS . '/(:any)'] = 'Users/index/$1';
$route[USERVIEW . '/(:any)'] = 'Users/view/$1';
$route[USEREXPORT] = 'Users/exportAction';
$route[USERCHANGESTATUS . '/(:num)'] = 'Users/change_status/$1';
$route[USERCHANGEPASSWORD . '/(:num)'] = 'Users/change_password/$1';
$route[DELUSER] = 'Users/delete';
$route[EDITUSER] = 'Users/editUser';
$route[USERGAMEPLAYEDEXPORT . '/(:any)'] = 'Users/gamePlayedExportAction/$1';
$route[USERCOMPWITHDRAWEXPORT . '/(:any)'] = 'Users/compWithdrawExportAction/$1';
$route[USERCOMPDEPOSITEXPORT . '/(:any)'] = 'Users/compDepositExportAction/$1';
$route[USERREFERALBONUSEXPORT . '/(:any)'] = 'Users/referalBonusExportAction/$1';
$route[USEGAMEPLAYBONUSEXPORT . '/(:any)'] = 'Users/gamePlayBonusExportAction/$1';

$route[SETTINGS] = 'Settings';
$route[SETTINGSCMSUPDATEACTION . '/(:any)'] = 'Settings/update_action/$1';
$route[DAYWISETIMINGS] = 'Settings/dayWiseTimings';
$route[DAYWISETIMINGSUPDATE] = 'Settings/update_daytimings';

/* Bonus Routing */
$route[BONUS] = 'Bonus';
$route[BONUSAJAX] = 'Bonus/ajax_manage_page';
$route[BONUSCREATE] = 'Bonus/create';
$route[BONUSCREATEACTION] = 'Bonus/createAction';
$route[BONUSIMPORT] = 'Bonus/import';

/* Referral  Routing */
$route[REFERRAL] = 'Referral';
$route[REFERRALVIEW . '/(:any)'] = 'Referral/view/$1';

/* Payment Transaction  Routing */
$route[PAYMENTTRANSACTION] = 'PaymentTransaction';

/* Gamerecords  Routing */
$route[GAMERECORD] = 'Gamerecords';
$route[GAMERECORDSEXPORT] = 'Gamerecords/exportAction';

/* Withdrawal status  Routing */
$route[WITHDRWALSTATUS] = 'DepositWithdraw';
$route[CHANGEWITHDRWALSTATUS . '/(:any)'] = 'DepositWithdraw/changeStatus/$1';

/* Tournament Routing */
$route[TOURNAMENT] = 'Tournaments';
$route[ADDTOURNAMENT] = 'Tournaments/addTournament';
$route[DELETETOURNAMENT] = 'Tournaments/deleteTournament';
$route[EDITTOURNAMENT] = 'Tournaments/editTournament';
$route[TOURNAMETDETAILS] = 'Tournaments/getTournamentDetails';

/* Questions Routing */
$route[QUESTION] = 'Questions';
$route[ADDQUESTION] = 'Tournaments/addQuestion';
$route[DELETEQUESTION] = 'Tournaments/deleteQuestion';
$route[EDITQUESTION] = 'Tournaments/editQuestion';
$route[QUESTIONDETAILS] = 'Tournaments/getQuestionDetails';

/** Videos Routing */
$route[VIDEO] = 'Videos';
//$route[USERVIEW.'/(:any)'] = 'Users/view/$1';

$route[VIDEOVIEW . '/(:any)'] = 'Videos/view/$1';
$route[ADDVIDEOS] = 'Videos/addVideo';
$route[DELETEVIDEOS] = 'Videos/deleteVideo';
$route[DELETETRAILVIDEOS] = 'Videos/deleteTrailVideo';
$route[DELETEMOVIVIDEOS] = 'Videos/deleteMovieVideo';
$route[DELETETHUMBNAIL] = 'Videos/deleteThumbnail';
$route[DELETEBANNER] = 'Videos/deleteBanner';





/**MOVIES ROUTING */

$route[MOVIE] = 'Movies';
//$route[USERVIEW.'/(:any)'] = 'Users/view/$1';
$route[MOVIEVIEW . '/(:any)'] = 'Movies/view/$1';
$route[ADDMOVIE] = 'Movies/addMovie';
$route[DELETEMOVIE] = 'Movies/deleteMovie';

/**SERIES ROUTING */
$route[SERIES] = 'Series';
$route[DELETESEASON] = 'Series/deleteSeason';
$route[SERIESVIEW . '/(:any)'] = 'Series/viewSeries/$1';
$route[SEASONVIEW . '/(:any)'] = 'Series/viewSeason/$1';
$route[EPISODEVIEW . '/(:any)'] = 'Series/viewEpisode/$1';
$route[DELETESVIDEOS] = 'Series/deleteVideo';
$route[DELETEEPISODE] = 'Series/deleteEPISODE';

$route[DELETETRAILSVIDEOS] = 'Series/deleteSVideos';
$route[DELETESTHUMBS] = 'Series/deleteSThumbs';
$route[DELETESBANNERS] = 'Series/deleteSBanners';
$route[DELETEPVIDEOS] = 'Series/deleteEPVideos';
$route[DELETEPTHUMB] = 'Series/deleteEPThumbs';
$route[DELETSEVIDEOS] = 'Series/deleteSEVideos';
$route[DELETSETHUMBS] = 'Series/deleteSEThumb';

/** Subscription */
$route[SUBSCRIPTION] = 'Subscription';
$route[ADDSUBSCRIPTION] = 'Subscription/addSubs';
$route[EDITSUBSCRIPTION] = 'Subscription/editSubs';
$route[DELETESUBSCRIPTION] = 'Subscription/deleteSubs';
$route[SUBSCRIPTIONDETAILS] = 'Subscription/getSubscriptionDetails';

/** Category */
$route[CATEGORY] = 'Category';
$route[ADDCATEGORY] = 'Category/addCategory';
$route[EDITCATEGORY] = 'Category/editCategory';
$route[DELETECATEGORY] = 'Category/deleteCategory';
$route[CATEGORYDETAILS] = 'Category/getCategoryDetails';

$route[MOVIESLIDER] = 'MovieSlider';
$route[SLIDERDETAILS] = 'MovieSlider/getSliderDetails';

$route[SUPPORT] = 'Support';
$route[SUPPORTCHANGESTATUS] = 'Support/change_status';
$route[DELSUPPORT] = 'Support/delete_status';

/* Withdrawal Request  Routing */
$route[WITHDRAWAL] = 'Withdrawal';
$route[WITHDRAWAL . '/(:any)'] = 'Withdrawal/index/$1';
$route[WITHDRAWALDISTRIBUTE . '/(:any)'] = 'Withdrawal/redeemDistribute/$1';
/* Withdrawal  Completed Request  Routing */
$route[WITHDRAWALCOMPREQ] = 'CompletedRequest';
$route[WITHDRAWALCOMPREQLIST] = 'CompletedRequest/ajax_manage_page';
$route[WITHDRAWALEXPORT] = 'Withdrawal/exportAction';
$route[WITHDRAWALCOMPREQEXPORT] = 'CompletedRequest/exportAction';
$route[WITHDRAWALCOMPREQVIEW . '/(:any)'] = 'CompletedRequest/viewRequest/$1';

/* Withdrawal  Completed Request  Routing */
$route[WITHDRAWALREJECTREQ] = 'RejectedRequest';
$route[WITHDRAWALREJECTREQLIST] = 'RejectedRequest/ajax_manage_page';
$route[WITHDRAWALREJECTREQEXPORT] = 'RejectedRequest/exportAction';
$route[WITHDRAWALREJECTVIEW . '/(:any)'] = 'RejectedRequest/viewRequest/$1';

/* Withdrawal  Completed Request  Routing */
$route[WITHDRAWALBANKEXPORT] = 'BankExpWithdrawRequest';
$route[WITHDRAWALBANKEXPORTLIST] = 'BankExpWithdrawRequest/ajax_manage_page';
$route[BANKWITHDRAWALEXPORT] = 'BankExpWithdrawRequest/exportAction';

/* Tickect History Routing */
$route[TICKETHISTORY] = 'TicketHistory';

/* Refund Status Routing */
$route[REFUNDSTATUS] = 'RefundStatus';

/* Maintainance  Routing */
$route[MAINTAINANCE] = 'Maintainance';
$route[PAYMENTENABLE] = 'PaymentMode';

/* Room  Routing */
$route[GAMEPLAY] = 'GamePlay';
$route[GAMEPLAYCREATE] = 'GamePlay/create';
$route[GAMEPLAYSTATUS] = 'GamePlay/status';
$route[GAMEPLAYUPDATE . '/(:any)'] = 'GamePlay/update/$1';
$route[GAMEPLAYACTION] = 'GamePlay/action';
$route[GAMEPLAYAJAX] = 'GamePlay/ajax_manage_page';
$route[GAMEPLAYIMPORT] = 'GamePlay/import';
$route[GAMEPLAYDELETE] = 'GamePlay/delete';

/* KYC Routing */
$route[KYC] = 'Kyc/index';
$route[KYC . '/(:any)'] = 'Kyc/index/$1';
$route[KYCAJAXLIST] = 'Kyc/ajax_manage_page';
$route[VERIFYKYC] = 'Kyc/verifyKyc';
$route[KYCIMG] = 'Kyc/getImage';
$route[KYCBANKDETAIL] = 'Kyc/getBankDetail';
$route[KYCEXPORT] = 'Kyc/exportAction';
$route[DELKYC] = 'Kyc/delete';
$route[KYCVIEW . '/(:any)'] = 'Kyc/view/$1';

/* verify KYC Routing */
$route[VERIFIEDKYC] = 'VerifiedKyc';
$route[VERIFIEDKYCLIST] = 'VerifiedKyc/ajax_manage_page';
$route[VERIFIEDKYCVIEW . '/(:any)'] = 'VerifiedKyc/view/$1';

/* Deposit Routing */
$route[DEPOSIT] = 'Deposit';
$route[AJAXDEPOSITLIST] = 'Deposit/ajax_manage_page';
$route[DEPOSITEXPORT] = 'Deposit/exportAction';

$route[TODAYSDEPOSIT] = 'TodaysDeposit';
$route[TODAYSDEPOSITLIST] = 'TodaysDeposit/ajax_manage_page';

/* bot Routing */
$route[BOTPLAYER] = 'BotPlayer';
$route[BOTPLAYERAJAX] = 'BotPlayer/ajax_manage_page';
$route[BOTPLAYERCREATE] = 'BotPlayer/create';
$route[BOTPLAYERCREATEACTION] = 'BotPlayer/createAction';
$route[BOTPLAYERUPDATE . '/(:any)'] = 'BotPlayer/update/$1';
$route[BOTPLAYERUPDATEACTION] = 'BotPlayer/updateAction';
$route[BOTPLAYERDELETE] = 'BotPlayer/deleteAction';

/* contact us Routing */
$route[CONTACTUS] = 'ContactUs';
$route[CONTACTAJAXLIST] = 'ContactUs/ajax_manage_page';
$route[CONTACTDELETE] = 'ContactUs/delete';
$route[SENDREPLY] = 'ContactUs/sendReplyMail';
$route[GETSENDREPLY] = 'ContactUs/getReply';

/* userReport us Routing */
$route[USERREPORT] = 'UserReport/index';
$route[USERREPORT . '/(:any)'] = 'UserReport/index/$1';
//$route[USERREPORTLIST.] = 'UserReport/ajax_manage_page/$1';
$route[USERREPORTVIEW . '/(:any)'] = 'UserReport/view/$1';
$route[USERREPORTEXPORT] = 'UserReport/exportAction';

/* Bot Report us Routing */
$route[BOTREPORT] = 'BotReport/index';
$route[BOTREPORT . '/(:any)'] = 'BotReport/index/$1';

//$route[SUPPORTS] = 'Supports';
$route[SUPPORTSLIST] = 'Supports/getuserlist';
$route[SUPPORTCHAT] = 'Supports/getChat';
$route[SUPPORTREPLY] = 'Supports/replychat';

$route[SUPPORTSCHAT] = 'SupportChats';

$route[MATCHHISTORY] = 'MatchHistory';
$route[MACTHHISTORYVIEW . '/(:any)'] = 'MatchHistory/view/$1';
$route[MACTHHISTORYEXPORT] = 'MatchHistory/exportAction';

$route[TODAYBONUS] = 'TodayBonus';

$route[MAIL] = 'Mail';
$route[MAILLIST] = 'Mail/ajax_manage_page';
//$route[MAILCREATE]  = 'Mail/create';
$route[MAILUPDATE . '/(:any)'] = 'Mail/update/$1';
$route[MAILACTION] = 'Mail/updateAction';
$route[MAILDELETE] = 'Mail/delete';

$route[NOTIFICATION] = 'Notification';

$route[BANNER] = 'banner';
$route[BANNERUPDATE] = 'banner/updateBanner';
$route[BANNER . '/(:any)'] = 'banner/index/$1';
