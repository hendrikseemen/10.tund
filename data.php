<?php
	require_once("functions.php");
	require_once("InterestsManager.class.php");
	
	if(!isset($_SESSION["logged_in_user_id"])){
		header("Location: login.php");
		
		
		exit();
	}
	
	
	if(isset($_GET["logout"])){
		
		session_destroy();
		
		header("Location: login.php");
	}
	
	$InterestsManager = new InterestsManager($mysqli, $_SESSION["logged_in_user_id"]);
	
	
	if(isset($_GET["add_interest"])){
		
		$add_new_response = $InterestsManager->addInterests($_GET["add_interest"]);
		
		
		
		
	}
	
	if(isset($_GET["new_dd_selection"])){
		
		$add_new_userinterest_response = $InterestsManager->addUserInterest($_GET["new_dd_selection"]);
		
		
		
		
	}
	
?>

<p>
	Tere, <?=$_SESSION["logged_in_user_id"];?>
	<a href="?logout=1">Logi välja<a>
</p>

 <?php if(isset($add_new_response->error)):?>
  
	<p style="color:red;"><?=$add_new_response->error->message;?> </p>
	
  <?php elseif(isset($add_new_response->success)):?>
  
	<p style="color:green;"><?=$add_new_response->success->message;?> </p>
  
<?php endif; ?>
<form >
    <input name="add_interest">
    <input type="submit" value="Lisa">
</form>

<?php if(isset($add_new_userinterest_response->error)):?>
  
	<p style="color:red;"><?=$add_new_userinterest_response->error->message;?> </p>
	
  <?php elseif(isset($add_new_userinterest_response->success)):?>
  
	<p style="color:green;"><?=$add_new_userinterest_response->success->message;?> </p>
  
<?php endif; ?>

<h2>Minu huvialad</h2>

<form >
    <?=$InterestsManager->createDropdown();?>
    <input type="submit" value="Lisa">
</form>

<br><br>
	
	<?=$InterestsManager->getUserInterests();?>
