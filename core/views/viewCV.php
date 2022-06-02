<div>
<div class="border resume-wrapper">
    <form name="cvForm" class="bg-light p-2" action="cv/create" method="post">
    <link rel="stylesheet" href="./Template/style.css">

	<section class="profile section-padding">
		<div class="container">
			<div class="picture-resume-wrapper">
        <div class="picture-resume">

      <div class="name-wrapper">
        <h1><input name="Name" style = "height:50px;font-size:14pt;" type="text" value="<?php echo $cvData['Name'];?>" disabled></h1> <!-- YOUR NAME AND LAST NAME  -->
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
        	<li><input name="Phone" type="text" value="<?php echo $cvData['Phone'];?>" disabled></li> <!-- YOUR PHONE NUMBER  -->
        	<li><input name="Mail" type="text" value="<?php echo $cvData['Mail'];?>" disabled></li> <!-- YOUR EMAIL -->
        	<li><input name="Web" type="text" value="<?php echo $cvData['Web'];?>" disabled></li> <!-- YOUR WEBSITE  -->
        	<li><input name="Place" type="text" value="<?php echo $cvData['Place'];?>" disabled></li> <!-- YOUR STATE AND COUNTRY  -->
        </ul>
      </div>
	<div class = "description">
		<ul class="description-type">
      		<li>About Me</li>
      		
      	</ul>
	</div>
      <div class="contact-presentation"> <!-- YOUR PRESENTATION RESUME  -->
      	<textarea name="About" cols="50" rows="10" disabled ><?php echo $cvData['About'];?></textarea>
      </div>
      
		</div>
	</section>
  
  <section class="experience section-padding">
  	<div class="container">
  		<h3 class="experience-title">Experience</h3>
      
      <div class="experience-wrapper">
      	<div class="company-wrapper clearfix">
      		<div class="experience-title"><input name="company1" type="text" value="<?php echo $cvData['company1'];?>" disabled></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
          <div class="time"><input name="period1" type="text" value="<?php echo $cvData['period1'];?>" disabled></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
      	</div>
        
		<div class="job-wrapper">
        	<div class="experience-title"><input name="role1" type="text" value="<?php echo $cvData['role1'];?>" disabled></div> <!-- JOB TITLE  -->
          <div class="company-description">
          	<textarea name="companydes1" cols="40" rows="5" disabled><?php echo $cvData['companydes1'];?></textarea>
          </div>
        </div>
        
        <div class="company-wrapper clearfix">
      		<div class="experience-title"><input name = "company2" type="text" value="<?php echo $cvData['company2'];?>" disabled></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
          <div class="time"><input name="period2" type="text" value="<?php echo $cvData['period2'];?>" disabled></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
      	</div>
        
        <div class="job-wrapper clearfix">
        	<div class="experience-title"><input name="role2" type="text" value="<?php echo $cvData['role2'];?>" disabled></div> <!-- JOB TITLE  -->
          <div class="company-description">
          	<textarea name="companydes2" cols="40" rows="5" value="Company Description" disabled><?php echo $cvData['companydes2'];?></textarea>
          </div>
        </div>
        
        <div class="company-wrapper clearfix">
      		<div class="experience-title"><input name = "company3" type="text" value="<?php echo $cvData['company3'];?>" disabled></div> <!-- NAME OF THE COMPANY YOUWORK WITH  -->
          <div class="time"><input name="period3" type="text" value="<?php echo $cvData['period3'];?>" disabled></div> <!-- THE TIME YOU WORK WITH THE COMPANY  -->
      	</div>
        
        <div class="job-wrapper clearfix">
        	<div class="experience-title"><input input name="role3" type="text" value="<?php echo $cvData['role3'];?>" disabled></div> <!-- JOB TITLE  -->
          <div class="company-description">
          	<textarea name="companydes3" cols="40" rows="5" value="Company Description" disabled><?php echo $cvData['companydes3'];?></textarea>
          </div>
        </div>
        
      </div><!--Skill experience-->
      
      <div class="section-wrapper clearfix">
      	<h3 class="section-title">Skills</h3>  <!-- YOUR SET OF SKILLS  -->
        	<ul>
        		<li><input name="skill1" type="text" value="<?php echo $cvData['skill1'];?>" disabled></li>
			<input name="slide1" type="range" value="<?php echo $cvData['slide1'];?>" disabled>
        		<li><input name="skill2" type="text" value="<?php echo $cvData['skill2'];?>" disabled></li>
			<input name="slide2" type="range" value="<?php echo $cvData['slide2'];?>" disabled>
        		<li><input name="skill3" type="text" value="<?php echo $cvData['skill3'];?>" disabled></li>
			<input name="slide3" type="range" value="<?php echo $cvData['slide3'];?>" disabled>
        		<li><input name="skill4" type="text" value="<?php echo $cvData['skill4'];?>" disabled></li>
			<input name="slide4" type="range" value="<?php echo $cvData['slide4'];?>" disabled>
        		<li><input name="skill5" type="text" value="<?php echo $cvData['skill5'];?>" disabled></li>
			<input name="slide5" type="range" value="<?php echo $cvData['slide5'];?>" disabled>
        		<li><input name="skill6" type="text" value="<?php echo $cvData['skill6'];?>" disabled></li>
			<input name="slide6" type="range" value="<?php echo $cvData['slide6'];?>" disabled>
            
        	</ul>
        
      </div>
      
      <div class="section-wrapper clearfix">
        <h3 class="section-title">Hobbies</h3>  <!-- DESCRIPTION OF YOUR HOBBIES -->
        <textarea name="hobbies" cols="40" rows="10" disabled><?php echo $cvData['hobbies'];?></textarea>
      </div>
      
  	</div>
  </section>
  
  <div class="clearfix"></div>
  <br>
</form>
</div>

</div>
