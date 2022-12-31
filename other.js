var other={};
var database = require('../database/database.js');
var common_model = require('../socket/common_model.js');
var crypto = require('crypto');

other.topPlayersRecord = function(reqData,cb){
	let  gettopPlayerLimit ={
		'table':"mst_settings",
		'fields':"id,topPlayerLimit",
		'condition':"",
	}
	common_model.GetData(gettopPlayerLimit,function(response){
		if (response.success===1) {
			let topplayerlim = response.data[0].topPlayerLimit;
			var sql ="select * from user_details order by totalScore desc limit "+topplayerlim+"";
			common_model.sqlQuery(sql,function(response){
				if(response.success===1) {
					let topPlayersObject = [];
					response.data.forEach(function(data){
	    			let result = {
	    				 userId:data.id,
	    				 userName:data.user_name,
	    				 playerProgress:data.playerProgress,
	    				 availableBalance:data.balance,
						 totalScore:data.totalScore,
	    			}
	    			topPlayersObject.push(result);
	    		});
					cb({status:true,success:"1",message:"Success",result:topPlayersObject,errorList: []}); 
				}else{
					cb({status:false,success:"2",message:"No Record Found"}); 
				}
			});
		}else{
			cb(response);
		}
		
	});
}


/*------------------- For get AdminPercent version -------------------------*/

other.getadminPercent =function (reqData,cb) {
	let  getVersion ={
		'table':"mst_settings",
		'fields':"adminPercent ",
		'condition':""
	}
	common_model.GetData(getVersion,function(response){
		if(response.success===1) {
			cb({status:true,message:"Success",result:response.data}); 
		}else{
			cb(response); 
		}
	});
} 


/*------------------- Game History -------------------------*/
other.getGameHistory =function (reqData,cb) {
	let  getGamePlayedHistory ={
		'table':"coins_deduct_history",
		'fields':"",
		'condition':"userId='"+reqData.userId+"'",
	}
	common_model.GetData(getGamePlayedHistory,function(response){
	if(response.success===1){
		let gameObject = [];
			response.data.forEach(function(data){
			let result = {
				 userId:data.userId,
				 tableId:data.tableId,
				 gameType:data.gameType,
				 betValue:data.betValue,
				 coins:data.coins,
				 isWin:data.isWin,
				 adminCommition:data.adminCommition,
				 adminAmount:data.adminAmount,
			}
			gameObject.push(result);
		});
			cb({status:true,success:"1",message:"Success",result:gameObject}); 
	}else{
		cb(response);
	}
	});
} 



/*------------------- Game History -------------------------*/
other.myReferrRecord =function (reqData,cb) {
	let  getreferrRecord ={
		'table':"referral_users",
		'fields':"",
		'condition':"fromReferralUserId='"+reqData.userId+"'",
	}
	common_model.GetData(getreferrRecord,function(response){
	if(response.success===1){
		let referrObject = [];
			response.data.forEach(function(data){
			let result = {
				referralUser:data.toReferralUserId,
				referralBonus:data.referralBonus,
				isRegister:data.isRegister,
			}
			referrObject.push(result);
		});
			cb({status:true,success:"1",message:"Success",result:referrObject}); 
	}else{
		cb(response);
	}
	});
} 

module.exports = other;
