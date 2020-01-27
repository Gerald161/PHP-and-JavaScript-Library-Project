<?php session_start();?>
<?php 
	if(isset($_GET['id'])){

		if(isset($_SESSION['username'])){
			$logged = 'yup';
			include('nav.php');
		}else{
			$logged = '';
			include('nav2.php');
		}

		$id = $_GET['id'];

		$_SESSION['storyid'] = $_GET['id'];

		$sql = "SELECT * FROM stories WHERE id = '$id'";

		$result = mysqli_query($conn, $sql);

		$image = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$sql = "SELECT * FROM comments WHERE id ='$id'";

		$result = mysqli_query($conn, $sql);

		$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$sql = "SELECT * FROM otherpics WHERE storyid = '$id'";

		$result = mysqli_query($conn, $sql);

		$Oimages = mysqli_fetch_all($result, MYSQLI_ASSOC);	

		if(array_filter($Oimages)){
			$otherpics = 'yup';
		}else{
			$otherpics = '';
		}

	}
?>

	<?php if($otherpics){ ?>
		<div class="first">
			<div class="read-flex"> 
				<div class="img" data-left="">
					<img src="storyimages.php?id=<?php echo $image[0]['id']?>">
				</div>	
				<?php foreach ($Oimages as $Oimage) {?>
					<div class="img" data-left="">
	        		  <img src="otherpics.php?id=<?php echo $Oimage['id']?>">
	      		    </div>
				<?php } ?>	

			</div>
			<a class="prev">&#10094;</a>
   	   	    <a class="next">&#10095;</a>
		</div>	
	<?php }else{ ?>
		<div class="read">
			<img src="storyimages.php?id=<?php echo $image[0]['id']?>">
		</div>
	<?php } ?>	

	<h2><?php echo $image[0]['bookName']?></h2>
	<h3>By: <?php echo $image[0]['bookAuthor'] ?></h3>
	<p class="sypnosis"><?php echo base64_decode($image[0]['sypnosis']);?></p>

	 <?php if(array_filter($comments)){ ?>

	 	<h3>Comments</h3>
	 	
	 	<div class="all_comments">
	 		
	 	</div>	

	 	<?php if($logged){ ?>
			 <form id="postData">
      		 	 <div>
         		   <!-- <input type="text" name="title"> -->
         		   <textarea name="title" placeholder="Add a public comment" required="" id="title"></textarea>
      			  </div>
    		    <input type="submit" value="Comment">
   			 </form>

		<?php }else{ ?>
			<?php foreach ($comments as $comment){?>
	 		<?php $_SESSION['commentuserid'] = $comment['userid']?>

	 		<div class="commentary">
	 			<div class="profilee">
	 				<a href="timeline.php?id=<?php echo $comment['userid'];?>"><img src="imagee.php?id=<?php echo $comment['userid']?>"></a>
	 			</div>
	 			<div class="two">
	 				<p style="text-transform: capitalize; color: #fff"><?php echo $comment['username'];?></p>
	 				<p class="cmmt"><?php echo base64_decode($comment['comment'])?></p>
	 			</div>
	 			
	 			
		 	</div>

	 	<?php } ?>
		 	
			<p style="position: relative; left: 10px; color: #fff; padding: 20px;">You must be logged in to comment booboo</p>

		<?php } ?>	
		
	 <?php }else{ ?>	

	 	<?php if($logged){ ?>
	 		<form id="postData">
      		 	 <div>
         		   <!-- <input type="text" name="title"> -->
         		   <textarea name="title" placeholder="Add a public comment" required="" id="title"></textarea>
      			  </div>
    		    <input type="submit" value="Comment">
   			 </form>
   			 <h2 style="padding: 20px" class="h">No comments added yet,be the first to add</h2>
	 	<?php }else{ ?>	
	 		<h2 style="padding: 20px">No comments added yet</h2>
	 		<p style="position: relative; left: 10px; color: #fff; padding: 20px;">You must be logged in to comment booboo</p>
	 	<?php } ?>

	 	<div class="all_comments">
	 		
	 	</div>	

	 <?php } ?>	
		
<script type="text/javascript" src="read.js"></script>
<script type="text/javascript" src="post.js"></script>
</body>
</html>