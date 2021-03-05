<?php

$username = $_SESSION['username'];
?>

</div><!--container closed-->
</div></div>
</body>
</html>
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">


<form name="form" action="code.php"  method="POST">
        		<!-- Modal body -->
        		<div class="modal-body">
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Exam Title <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<input type="text" name="online_exam_title" id="online_exam_title" class="form-control" />
	                		</div>
            			</div>
          			</div>
					  <div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Course<span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<select name="online_exam_course" id="online_exam_course" class="form-control">
								<?php  
              
              $query = "SELECT DISTINCT tc.courseID, c.courseName FROM course c, teacher_course tc WHERE tc.teacherID='$username' AND tc.courseID=c.courseID";
              $result = mysqli_query($conn, $query);
              
              if(mysqli_num_rows($result)>0){
                while($row1 = mysqli_fetch_assoc($result)){
                echo "<option value='". $row1['courseID'] ."'>".$row1['courseName']."</option>" ;
               }
              }
              else{
                echo "You haven't enroll to any course";
              }

              ?>
	                			</select>
	                		</div>
            			</div>
          			</div>
					  
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Exam Date<span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<input type="date" name="online_exam_datetime" id="online_exam_datetime" class="form-control"/>
	                		</div>
            			</div>
          			</div>
					  <div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Exam Time<span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<input type="time" name="online_exam_time" id="online_exam_time" class="form-control"/>
	                		</div>
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Exam Duration <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<select name="online_exam_duration" id="online_exam_duration" class="form-control">
	                				<option value="">Select</option>
	                				<option value="5">5 Minute</option>
	                				<option value="30">30 Minute</option>
	                				<option value="60">1 Hour</option>
	                				<option value="120">2 Hour</option>
	                				<option value="180">3 Hour</option>
	                			</select>
	                		</div>
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Total Question <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<select name="total_question" id="total_question" class="form-control">
	                				<option value="">Select</option>
	                				<option value="5">5 Question</option>
	                				<option value="10">10 Question</option>
	                				<option value="25">25 Question</option>
	                				<option value="50">50 Question</option>
	                				<option value="100">100 Question</option>
	                				<option value="200">200 Question</option>
	                				<option value="300">300 Question</option>
	                			</select>
	                		</div>
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Marks for Right Answer <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<select name="marks_per_right_answer" id="marks_per_right_answer" class="form-control">
	                				<option value="">Select</option>
	                				<option value="1">+1 Mark</option>
	                				<option value="2">+2 Mark</option>
	                				<option value="3">+3 Mark</option>
	                				<option value="4">+4 Mark</option>
	                				<option value="5">+5 Mark</option>
	                			</select>
	                		</div>
            			</div>
          			</div>
          			<div class="form-group">
            			<div class="row">
              				<label class="col-md-4 text-right">Marks for Wrong Answer <span class="text-danger">*</span></label>
	              			<div class="col-md-8">
	                			<select name="marks_per_wrong_answer" id="marks_per_wrong_answer" class="form-control">
	                				<option value="">Select</option>
	                				<option value="1">-1 Mark</option>
	                				<option value="1.25">-1.25 Mark</option>
	                				<option value="1.50">-1.50 Mark</option>
	                				<option value="2">-2 Mark</option>
	                			</select>
	                		</div>
            			</div>
          			</div>
        		</div>

				  <input type="hidden" name="userID" id="userID" value="<?php echo $username; ?>">

	        	<!-- Modal footer -->
	        	<div class="modal-footer">
	        		<input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add" />
	        	</div>
        
</div><!--container closed-->
</div></div>
</body>
</html>
<script>

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("online_exam_datetime").setAttribute("min", today);

function myFunction() {
	        var x = document.getElementById("online_exam_time").value;
	        document.getElementById("demo").innerHTML = x;
	    }
</script> 