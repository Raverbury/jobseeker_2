<div>
<div class="border resume-wrapper">
    <form name="cvForm" class="bg-light p-2" action="cv/edit/<?php echo $cvData['cvID'];?>" method="post">
    <link rel="stylesheet" href="./Template/style.css">

	<section class="profile section-padding">
		<div class="container">
			<div class="picture-resume-wrapper">
        <div class="picture-resume">

      <div class="name-wrapper">
        <h1><input name="Name" style = "height:50px;font-size:14pt;" type="text" value="<?php echo $cvData['Name'];?>" ></h1> <!-- YOUR NAME AND LAST NAME  -->
      </div>
      <div class="clearfix"></div>
      <div class="contact-info clearfix">
      	<ul class="list-titles">
      		<li>Phone</li>
      		<li>Mail</li>
      		<li>Website</li>
      		<li>Address</li>
      	</ul>
        <ul class="list-content ">
        	<li><input name="Phone" type="text" value="<?php echo $cvData['Phone'];?>" ></li> <!-- YOUR PHONE NUMBER  -->
        	<li><input name="Mail" type="text" value="<?php echo $cvData['Mail'];?>" ></li> <!-- YOUR EMAIL -->
        	<li><input name="Web" type="text" value="<?php echo $cvData['Web'];?>" ></li> <!-- YOUR WEBSITE  -->
        	<li><input name="Place" type="text" value="<?php echo $cvData['Place'];?>" ></li> <!-- YOUR STATE AND COUNTRY  -->
        </ul>
      </div>
	<div class = "description">
		<ul class="description-type">
      		<li>About Me</li>
      		
      	</ul>
	</div>
      <div class="contact-presentation"> <!-- YOUR PRESENTATION RESUME  -->
      	<textarea name="About" cols="50" rows="10"  ><?php echo $cvData['About'];?></textarea>
      </div>
      
		</div>
	</section>
  
  <section class="experience section-padding">
  	<div class="container">
  		<h3 class="experience-title">Experience</h3>
      
      <div class="experience-wrapper">
      	<div class="company-wrapper clearfix">
      		<div class="experience-title"><input name="company1" type="text" value="<?php echo $cvData['company1'];?>" ></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
          <div class="time"><input name="period1" type="text" value="<?php echo $cvData['period1'];?>" ></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
      	</div>
        
		<div class="job-wrapper">
        	<div class="experience-title"><input name="role1" type="text" value="<?php echo $cvData['role1'];?>" ></div> <!-- JOB TITLE  -->
          <div class="company-description">
          	<textarea name="companydes1" cols="40" rows="5" ><?php echo $cvData['companydes1'];?></textarea>
          </div>
        </div>
        
        <div class="company-wrapper clearfix">
      		<div class="experience-title"><input name = "company2" type="text" value="<?php echo $cvData['company2'];?>" ></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
          <div class="time"><input name="period2" type="text" value="<?php echo $cvData['period2'];?>" ></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
      	</div>
        
        <div class="job-wrapper clearfix">
        	<div class="experience-title"><input name="role2" type="text" value="<?php echo $cvData['role2'];?>" ></div> <!-- JOB TITLE  -->
          <div class="company-description">
          	<textarea name="companydes2" cols="40" rows="5" value="Company Description" ><?php echo $cvData['companydes2'];?></textarea>
          </div>
        </div>
        
        <div class="company-wrapper clearfix">
      		<div class="experience-title"><input name = "company3" type="text" value="<?php echo $cvData['company3'];?>" ></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
          <div class="time"><input name="period3" type="text" value="<?php echo $cvData['period3'];?>" ></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
      	</div>
        
        <div class="job-wrapper clearfix">
        	<div class="experience-title"><input input name="role3" type="text" value="<?php echo $cvData['role3'];?>" ></div> <!-- JOB TITLE  -->
          <div class="company-description">
          	<textarea name="companydes3" cols="40" rows="5" value="Company Description" ><?php echo $cvData['companydes3'];?></textarea>
          </div>
        </div>
        
      </div><!--Skill experience-->
      
      <div class="section-wrapper clearfix">
      	<h3 class="section-title">Skills</h3>  <!-- YOUR SET OF SKILLS  -->
        	<ul>
        		<li><input name="skill1" type="text" value="<?php echo $cvData['skill1'];?>" ></li>
			<input name="slide1" type="range" value="<?php echo $cvData['slide1'];?>" >
        		<li><input name="skill2" type="text" value="<?php echo $cvData['skill2'];?>" ></li>
			<input name="slide2" type="range" value="<?php echo $cvData['slide2'];?>" >
        		<li><input name="skill3" type="text" value="<?php echo $cvData['skill3'];?>" ></li>
			<input name="slide3" type="range" value="<?php echo $cvData['slide3'];?>" >
        		<li><input name="skill4" type="text" value="<?php echo $cvData['skill4'];?>" ></li>
			<input name="slide4" type="range" value="<?php echo $cvData['slide4'];?>" >
        		<li><input name="skill5" type="text" value="<?php echo $cvData['skill5'];?>" ></li>
			<input name="slide5" type="range" value="<?php echo $cvData['slide5'];?>" >
        		<li><input name="skill6" type="text" value="<?php echo $cvData['skill6'];?>" ></li>
			<input name="slide6" type="range" value="<?php echo $cvData['slide6'];?>" >
            
        	</ul>
        
      </div>
      
      <div class="section-wrapper clearfix">
        <h3 class="section-title">Hobbies</h3>  <!-- DESCRIPTION OF YOUR HOBBIES -->
        <textarea name="hobbies" cols="40" rows="10" ><?php echo $cvData['hobbies'];?></textarea>
      </div>
      
  	</div>
  </section>
  
  <div class="clearfix"></div>
  <br>
  <input class="btn btn-primary m-1" type="submit">

</form>
</div>

</div>
