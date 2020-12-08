<?php
	/*
	*@filename topicster_post_data.php
	*@des ---
	*@Author Arpit sharma
	*/
	error_reporting(0);
	if(!RootPath){
		define("RootPath", "../../../../");
	}
	
	if($DatabaseAccessCode == 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap' || DatabaseAccessCode == 'T@6Ug5t_u56t*P_B&B@Kl7U_v8N_xN7b_Z&B@Kl75t_u56@6Ug5t_u56t*P_B&Ap'){
		try {
			// VariableName = new PDO(hostname,databaseName,databaseUser,DatabasePassword);
			$PdoTopicsterPostData = new PDO("mysql:host=localhost;dbname=".DatabaseNamePrefix."topicster_post_data",'topicst1_Ap9919t','_L6sTh-FD2*hPpSjDeWSF5tMy-7D8ct:FfMSE@,-*VZ9EP_BvJSVe-4u*PhUJuWr');
			$PdoTopicsterPostData->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		} catch (PDOException $e) {
			foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
			AptPrint(['msg'=>'Database connection faild due to technical error']); exit();
		}
	}else{
		foreach (get_defined_vars() as $SetVarKey=>$SetVarVal){ unset($$SetVarKey); } unset($SetVarKey,$SetVarVal);
		header("Location: " . RootPath . "Library/SiteComponents/PageNotFound/index.php"); die();
		AptPrint(['msg'=>'Authentication failed [Permission]']); exit();
	}
?>