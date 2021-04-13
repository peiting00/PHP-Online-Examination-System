<?php

    include "security.php";
    $_SESSION["role"] = "teacher";
    include "header.php";
    include "dbConnection.php";
    include "dataTable.php";

    
?>

<br>
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<div class="row">
<span class="title1" style="font-size:30px"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6">
 <form class="form-horizontal title1" name="form" action="code.php"  method="POST">
<fieldset> 

<?php 

if(isset($_POST['question'])){
  $examID = $_POST['exam_id'];
  $q = $_POST['total_question'];
}
?>
<form action="code.php" method="post">
  <input type='hidden' class='btn btn-danger' name='exam_id' value='<?php echo $examID; ?>'/>
  <input type='hidden' class='btn btn-danger' name='total_question' value='<?php echo $q; ?>'/>
<?php
for($i=1; $i<=$q; $i++){


       		// <!-- Modal body -->
        		echo'<div class="modal-body">
              <b>Question number&nbsp;'.$i.'&nbsp;:</b><br><br> 
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Question Title <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<input type="text" name="question_title[]" id="question_title[]" autocomplete="off" class="form-control" required />
	                		</div>
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Option 1 <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<input type="text" name="option_first[]" id="option_first[]" autocomplete="off" class="form-control" required />
	                		</div>
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Option 2 <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<input type="text" name="option_second[]" id="option_second[]" autocomplete="off" class="form-control" required/>
	                		</div>
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Option 3 <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<input type="text" name="option_third[]" id="option_third[]" autocomplete="off" class="form-control" required />
	                		</div>
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Option 4 <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<input type="text" name="option_fourth[]" id="option_fourth[]" autocomplete="off" class="form-control" required/>
	                		</div>
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Answer <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<select name="answer_option[]" id="answer_option[]" class="form-control" required>
									<option value="">Select the answer</option>
	                				<option value="1">Option No 1</option>
	                				<option value="2">Option No 2</option>
	                				<option value="3">Option No 3</option>
	                				<option value="4">Option No 4</option>
	                			</select>
	                		</div>
            			</div>
          			</div>
        		</div>';

}

?>
<div class="modal-footer">
  <a href ="teacherHome.php?nav=examList" class="btn btn-danger btn-sm">Close</a>
  <input type="submit" name="addquestion" id="addquestion" class="btn btn-success btn-sm" value="Add" />
</div>
</form>
</div><!--container closed-->
</div></div>
</body>
</html>
