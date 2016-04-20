<?php 
include("../configr.php");

 if(isset($_POST['Enter']))
	{
		
		 	$q = "select * from student where student_id='".$_POST['Snumber']."'";
			 $res=$mysqli->query($q);	
			 $count = mysqli_num_rows($res);
			 if($count==1)
			 {
				 echo"<script>alert('You have already Applied Please check your status')</script>";
	             echo"<script>window.open('checkStatus.php',)</script>";
			  }
		else
		{
		
		
			
		 $name=$mysqli->real_escape_string($_POST['name']);
	   	 $surname=$mysqli->real_escape_string($_POST['surname']);
		 $idn=$mysqli->real_escape_string($_POST['idn']);
		 $phone=$mysqli->real_escape_string($_POST['phone']);
		 $Haddress=$mysqli->real_escape_string($_POST['Haddress']);
		 $bio=$mysqli->real_escape_string($_POST['bio']);
		 $Paddress=$mysqli->real_escape_string($_POST['Paddress']);
		 $Eaddress=$mysqli->real_escape_string($_POST['Eaddress']);
		 $Snumber=$mysqli->real_escape_string($_POST['Snumber']);
		 $cumpus=$mysqli->real_escape_string($_POST['campus']);
		 $qaulification=$mysqli->real_escape_string($_POST['qualification']);
		 $national=$mysqli->real_escape_string($_POST['national']);
		 $Gpay=$mysqli->real_escape_string($_POST['Gpay']);
		 $Gen=$mysqli->real_escape_string($_POST['gender']);
		 $pass=$mysqli->real_escape_string($_POST['pass']);
		
		 $Gname=$mysqli->real_escape_string($_POST['Gname']);
		 $Gsurname=$mysqli->real_escape_string($_POST['Gsurname']);
		 $Gidn=$mysqli->real_escape_string($_POST['Gidn']);
		 $Gphone=$mysqli->real_escape_string($_POST['Gphone']);
		 $Gaddress=$mysqli->real_escape_string($_POST['Gaddress']);
		 $Gnational=$mysqli->real_escape_string($_POST['Gnational']);
		 $GpCode=$mysqli->real_escape_string($_POST['GpCode']);
		 $Gemails=$mysqli->real_escape_string($_POST['Gemail']);
        

	
	$q = "insert into gudian (g_name, g_surname, phone_number,g_address, g_postalcode, g_emailAddress, Id_number, g_nationality)values('$Gname','$Gsurname','$Gphone','$Gaddress','$GpCode','$Gemails','$Gidn','$Gnational')";
		$result=$mysqli->query($q);	
		$id = mysqli_insert_id($mysqli);
         
		
		if($result)
		{
							$in = "insert into student (student_id, name, surname,home_addres, cumpus, gender, postalcode, phonenumber, Email, nationality, application_status, ID_number, qualification, Biography, Date, pay_resposibility,g_id) values('$Snumber','$name','$surname','$Haddress','$cumpus','$Gen','$Paddress','$phone','$Eaddress','$national','0','$idn','$qaulification','$bio',NOW(),'$Gpay','$id')";  
		$resul=$mysqli->query($in);
		$query="SELECT * FROM student ORDER BY g_id DESC LIMIT 1";
		$res = $mysqli->query($query);
			while($row=$res->fetch_assoc())
			{
				$sid=$row["student_id"];
					
			}
			$quer="SELECT * FROM image ORDER BY id DESC LIMIT 1";
		    $re = $mysqli->query($quer);
			while($row=$re->fetch_assoc())
			{
				$imageWebname=$row["img"];
					
			}    
					 
							
							
				 	             	
					if(($imageWebname=="" || $imageWebname ==null ) && ($_FILES['imgF']['tmp_name']=="" || $_FILES['imgF']['tmp_name']==null))
					{
					}
					else if($imageWebname !="" && $_FILES['imgF']['tmp_name']!="" )
					{
						 
					}
					 if($_FILES['imgF']['tmp_name']!="" || $_FILES['imgF']['tmp_name']!=null)
					{
						   $ext = pathinfo($_FILES['imgF']['name'], PATHINFO_EXTENSION);
						   $name0 = $sid.".".$ext;
						   move_uploaded_file($_FILES['imgF']['tmp_name'],"images/d1/$name0");
						   $image = "images/d1/".$name0;
					}
					else if($imageWebname !="" || $imageWebname !=null)
					{
						rename($imageWebname,"images/d1/".$sid.".jpg");
						$image = "images/d1/".$sid.".jpg";
						$imageWebname="";
					}
					
					
									
									
									
						   
						  	
							
							
						
							$ext1 = pathinfo($_FILES['pRegister']['name'], PATHINFO_EXTENSION);
							$name1 = $sid.".".$ext1;
							move_uploaded_file($_FILES['pRegister']['tmp_name'],"images/d2/$name1");
							$proofReg="images/d2/".$name1;	
							
							

							
							
						    $ext2 = pathinfo($_FILES['cID']['name'], PATHINFO_EXTENSION);
				  			$name2 = $sid.".".$ext2;
							move_uploaded_file($_FILES['cID']['tmp_name'],"images/d3/$name2");
							$copyID = "images/d3/".$name2;	
							
						
							
							
							 $ext3 = pathinfo($_FILES['CpID']['name'], PATHINFO_EXTENSION);
							 $name3 = $sid.".".$ext3;
							 move_uploaded_file($_FILES['CpID']['tmp_name'],"images/d4/$name3");
					         $perentCopyID="images/d4/".$name3;
							
							
							
							    $ext4 = pathinfo($_FILES['Pay']['name'], PATHINFO_EXTENSION);
								$name4 = $sid.".".$ext4;
								
							    move_uploaded_file($_FILES['Pay']['tmp_name'],"images/d5/$name4");
								$proofofPayment="images/d5/".$name4;
							 
							 
							
							    $ext5 = pathinfo($_FILES['bLet']['name'], PATHINFO_EXTENSION);
								$name5 = $sid.".".$ext5;
								move_uploaded_file($_FILES['bLet']['tmp_name'],"images/d6/$name5");
								$busaryLetter="images/d6/".$name5;
								
								
								
								
$quer= "update student set proofRegistration='$proofReg',copyofid='$copyID',parentid='$perentCopyID',bursaryLetter='$busaryLetter',payment_proof='$proofofPayment',image='$image' where student_id='$sid'";
$res=$mysqli->query($quer);

					
								
						
							 	$q = "select * from users where student_id='".$sid."'";
		                        $res=$mysqli->query($q);	
							 $count = mysqli_num_rows($res);
							 if($count==1){
							 
							
							 }else{
								  $qe = "insert into users (password, access_level, student_id)values('$pass',0,'$sid')";
		                           $result=$mysqli->query($qe);	
								   
								   if($result)
								     {
							 				echo"<script>alert('Thanks for your Application it will be prosssed in due course')</script>";
	                                        echo"<script>window.open('checkStatus.php','_self')</script>";
							
							         }
																   
								 }
							
			}		
		header("location:application.php");
		
		
		
		
		
		
								  
	    }//end of else
		
		
		
		
		
		
		
		
		
		
		
		
	}
	
			
 ?>



<!DOCTYPE html>

<html>
<head>
<title>City | Pages | Application</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="../layout/styles/webcam.js"></script>
<script language="javascript">

        //
		webcam.set_api_url( 'imge.php' );
		webcam.set_quality( 90 ); // JPEG quality (1 - 100)
		webcam.set_shutter_sound( true ); // play shutter click sound
		webcam.set_hook( 'onComplete', 'my_completion_handler' );

		function take_snapshot(){
			// take snapshot and upload to server
			document.getElementById('upload_results').innerHTML = '<h3>thank u</h3>';
			webcam.snap();
			
		}
		
		function Res() {
			
				webcam.reset();
				document.getElementById('upload_results').innerHTML = '';
		}
	//		function up() {
//			
//				webcam.upload('imge.php');
//		}
		
		function validation()
		{
     	  if( document.getElementById("idn").value!= "" && document.getElementById("idn").value.length != 13)
		  {
			  alert("(invalid ID number)ID must have 13 digits");
		      return false;
			
			  
			  }
				  else if(document.getElementById("phone").value != "" && document.getElementById("phone").value.length != 10)
				 {
				   	alert("(invalid phone number)your phone numbers must be 10 digit long");
		   			  return false;
				  }
					  else if(document.getElementById("Snumber").value != "" && document.getElementById("Snumber").value.length != 9)
					  {
							alert("(invalid student number) Student must be 9 digit long");
							 return false;
					  }
						  else if( document.getElementById("pass").value!= "" && document.getElementById("pass").value.length != 6)
						  {
								alert("Password must be six charecters long");
								 return false;
						  } 
							  else if(document.getElementById("Gidn").value != "" && document.getElementById("Gidn").value.length != 13)
							  {
									alert("(invalid perent ID number) parent ID must be 13 digits long");
									 return false;					
									 		  }
								 else if(document.getElementById("Gphone").value != "" && document.getElementById("Gphone").value.length != 10)
								  {
										alert("(invalid phone number) parent phone number must be 10 digit long");
										 return false;
								  }
			
			                   
							   
							      if(document.getElementById("Pay").value == "" && document.getElementById("bLet").value == "")
								  {
										alert(" if you pay cash please upload proof of payments or if you use bursary please upload bursary proof");
										 return false;
								  }
								  else if(document.getElementById("Pay").value != "" && document.getElementById("bLet").value != "")
								  {
										alert(" if you pay cash please upload proof of payments or if you use bursary please upload bursary proof, Please choose what is approppriate to you, just choose one to upload");
										 return false;
								  }
									
			}
		
		
		
</script>






</head>
<body id="top" class="bgded fixed" style="background-image:url('../images/demo/backgrounds/02.png');">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="clear"> 
    <!-- ################################################################################################ -->
    <div class="fl_left">
      <ul class="faico clear">
         <li><a href="https://www.facebook.com/City-Waldorf-SA-365564913456693/timeline/" target="_blank"><i class="fa fa-facebook"></i></a></li>
        <li><a href="https://twitter.com/citywaldorf" target="_blank"><i class="fa fa-twitter"></i></a></li>
        <li><a href="https://plus.google.com/100408896509910932335/posts" target="_blank"><i class="fa fa-google-plus"></i></a></li>
      </ul>
    </div>
    <div class="fl_right">
      <ul class="faico clear">
        <li><a href="login.html" title="Login"><i class="fa fa-sign-in"></i></a></li>
        <li><a href="Register.html" title="Register"><i class="fa fa-user-plus"></i></a></li>
        
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <div class="spacer">
    <header id="header" class="clear"> 
      <!-- ################################################################################################ -->
      <div id="logo" class="fl_left">
        <h1><a href="../index.html">City Wardolf</a></h1>
      </div>
      <div class="fl_right">
        <form class="clear" method="post" action="#">
          <fieldset>
            <legend>Search:</legend>
            <input type="text" value="" placeholder="Search Here">
            <button class="fa fa-search" type="submit" title="Search"><em>Search</em></button>
          </fieldset>
        </form>
      </div>
      <!-- ################################################################################################ -->
    </header>
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <div class="spacer">
    <nav id="mainav" class="clear"> 
      <!-- ################################################################################################ -->
      <ul class="clear">
        <li><a href="../index.html">Home</a></li>
        <li class="active"><a class="drop" href="#">Apply</a>
          <ul>
            <li class="active"><a href="gallery.html">Gallery</a></li>
            <li><a href="ckeckStatus.html">Check Status</a></li>
            <li><a href="roomsavail.html">Rooms Availalble</a></li>
            <li><a href="application.html">Apply Here</a></li>
            <li><a href="accountdetails.html">Account Details</a></li>
          </ul>
        </li>
        <li><a class="drop" href="#">Notices</a>
          <ul>
            <li><a href="facilities.html">Facilities</a></li>
            <li><a class="drop" href="rules.html">Rules</a>
              <ul>
                <li><a href="onlinerules.html">online application rules</a></li>
                <li><a href="busschedule.html">Bus Schedule</a></li>
                <li><a href="postandcomm.html">Post/View Comments</a></li>
              </ul>
            </li>
            
          </ul>
        </li>
		<li><a href="about.html">About</a></li>
        <li><a href="mapExample.html">Contact</a></li>
      </ul>
      <!-- ################################################################################################ -->
    </nav>
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row4">
  <div class="spacer">
    <div id="breadcrumb" class="clear"> 
      <!-- ################################################################################################ -->
      <ul>
        <li><a href="../index.html">Home</a></li>
        <li><a href="application.html">Apply</a></li>
        <li><a href="mapExample.html">Contact</a></li>
        <li><a href="#">Apply</a></li>
      </ul>
      <!-- ################################################################################################ -->
    </div>
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <div class="spacer">
    <main class="container clear"> 
      <!-- main body -->
      <!-- ################################################################################################ -->
      	<!--div id="content1"--->
<form action="application.php" method="post"  name="form1"  onSubmit="return validation();"  enctype="multipart/form-data"> 
      
 <table id="t1" width="100%" cellpadding="6" border="1">
  <tr>
    <td align="center"><h2>Personal Details</h2></td>
  </tr>
  <tr>
    <td>  
    
     <table  width="100%" cellpadding="6" >
            
              <tr>
                <td><strong>Name</strong></td>
                <td><input type="text" name="name" id="name" size="15" required/></td>
                <td><strong>Surname</strong></td>
                <td><input type="text" name="surname" id="surname" size="15" required/></td>
                <td rowspan="7">
                <div id="cam">
				<script language="JavaScript">
                        document.write( webcam.get_html(200, 150) );
                    </script>
                 <form>
              <br/>
                &nbsp;&nbsp;
                    <input type=button value="Configure..." onClick="webcam.configure()">
                    &nbsp;&nbsp;
                    <input type=button value="Take Snapshot" onClick="take_snapshot()">
                    &nbsp;&nbsp;
                    <input type=button value="Reset" onClick="Res()">
                </form>
                </div>
                <div id="upload_results" style="background-color:#eee;"></div>
    			</td>
                
              </tr>
              <tr>
                <td><strong>ID Number</strong></td>
                <td><input type="number" name="idn" id="idn" size="15" maxlength="13" required/></td>
                <td><strong>Phone Number</strong></td>
                <td><input type="number"  maxlength="10" required name="phone" id="phone" size="30"/></td>
                 
              </tr>
                  <tr>
                  <td><strong>Gender</strong></td>
                <td><select name="gender" id="gender">
                <option value="none"></option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            </select></td>
            <td><strong>Password</strong></td>
            <td><input type="password" required maxlength="6"  name="pass" id="pass"/></td>
            </tr>
              <tr>
                <td><strong>Postal code</strong></td>
                <td><input type="number" required name="Paddress" id="Paddress" size="15"/></td>
                <td><strong>Nationality</strong></td>
                <td><input type="text" required name="national" id="national" size="15"/></td>
              </tr>
              <tr>
                <td><strong>Home Address</strong></td>
                <td><textarea required name="Haddress" id="Haddress" cols="28" rows="5"></textarea></td>
                <td><strong>Biography</strong></td>
                <td><textarea name="bio" id="bio" cols="28" rows="5"></textarea></td>              
                </tr>
              <tr>
                <td><strong>Email Address</strong></td>
                <td><input type="email" required name="Eaddress" id="Eaddress" size="15"/></td>
                <td><strong>Student Number</strong></td>
                <td><input type="number" required maxlength="9" name="Snumber" id="Snumber" size="15"/></td>
              </tr>
              <tr>
                <td><strong>Campus</strong></td>
                <td><select name="campus" id="campus">
                <option value="APB">Auckland Park Bunting Road</option>
                <option value="APK">Auckland Park Kingsway</option>
                <option value="SWC">Soweto Campus</option>
                <option value="Collage">Collages</option>
                <option value="WITS">WITS</option>
            
            </select></td>
                <td><strong>qualification</strong></td>
                <td><input type="text" required name="qualification" id="qualification" size="30"/></td>
                
              </tr>
              <tr>
              
              <td><strong>Payments Responsibility</strong></td>
                <td><select name="Gpay" id="Gpay">
                <option value="none"></option>
            <option value="Perents">Perents</option>
            <option value="nsfas">NSFAS</option>
            <option value="edu">EDU</option>
            <option value="inteli">INTELI</option>
            <option value="busary">Bursary</option>
            </select></td>
                <td><strong>Upload Your Image</strong> </td>
                <td><input type="file" name="imgF" id="imgF"/></td>
              </tr>
            <tr style="border:1px thin #F00;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>         
              </tr>
                  <tr>
                <td colspan="4" align="center"><strong><h3>Required Documents</h3></strong><br/> </hr></td>
                <td></td>
                <td></td>
                <td></td>         
              </tr>
                  <tr>
                <td><strong>proof of registration</strong> </td>
                <td><input type="file" required name="pRegister" id="pRegister"/></td>
                <td><strong>Certified Copy of ID</strong></td>
                <td><input type="file" required name="cID" id="cID"/></td>         
              </tr>
                  <tr>
                <td><strong>parent Certified copy of ID</strong> </td>
                <td><input type="file" required name="CpID" id="CpID"/></td>
                <td><strong>Proof of Payment</strong> </td>
                <td><input type="file" name="Pay" id="Pay"/></td>         
              </tr>
                <tr>
                <td><strong>bursary Letter</strong> </td>
                <td><input type="file" name="bLet" id="bLet"/></td>
                <td></td>
                <td></td>         
              </tr>
            </table>
            </td>   
         </tr>
    </table>
<br/><p></p><br/>

         
             
             
  <table id="t2"  width="100%" cellpadding="6" border="1">
  <tr>
    <td align="center"><h2>Parents/ Guardian/ Next of Keen Details</h2></td>
  </tr>
  <tr>
    <td> <table width="81%" cellpadding="6" >
               <tr>
                <td><strong>Name</strong></td>
                <td><input type="text" required name="Gname" id="Gname" size="30"></td>
                <td><strong>Surname</strong></td>
                <td><input type="text" required name="Gsurname" id="Gsurname" size="30"></td>
                
              </tr>
              <tr>
                <td><strong>ID Number</strong></td>
                <td><input type="number" required maxlength=" 13"name="Gidn" id="Gidn" size="30"></td>
                <td><strong>Contact Number</strong></td>
                <td><input type="number" required  maxlength="10"name="Gphone" id="Gphone" size="30"></td>
                
              </tr>
              <tr>
                <td><strong>Postal code</strong></td>
                <td><input type="number" required maxlength="4" name="GpCode" id="GpCode" size="30"></td>
                <td><strong>Nationality</strong></td>
                <td><input type="text" name="Gnational" id="Gnational" size="30"></td>
              </tr>
              <tr>
                <td><strong>Home Address</strong></td>
                <td><textarea name="Gaddress" id="Gaddress" cols="28" rows="5"></textarea></td>
                          
            </tr>
              <tr>
                <td><strong>Email Address</strong></td>
                <td><input type="email" name="Gemail" id="Gemail" size="30"></td>
                <td></td>
                <td></td>
              </tr>
                 <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
                 <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
             </table>
             </td>
    
  </tr>
 
</table>
<br/><br/>
<input type="hidden" name="webcam" id="webcam" value=" <?php echo $newname;?>"/>
<input type="submit" name="Enter" value="Submit Application"/>
       </form>  
	
      <div class="clear"></div>
    </main>
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div class="spacer">
    <footer id="footer" class="clear"> 
      <!-- ################################################################################################ -->
      <div class="one_quarter first">
        <h6 class="title">Address</h6>
        <address class="btmspace-15">
        City Waldorf<br>
        278 Bree Street<br>
        Johannesburg<br>
        South Africa
        </address>
        <ul class="nospace">
          <li class="btmspace-10"><span class="fa fa-phone"></span> +27 (71) 222 2222</li>
          <li><span class="fa fa-envelope-o"></span> info@citywaldorf.com</li>
        </ul>
      </div>
      <div class="one_quarter">
        <h6 class="title">Social media</h6>
        <ul class="nospace linklist">
          <p>you can get</p>
          <p>us on social networks</p>
          <p>pages </p>
          <p>that are above </p>
          <p>just click on them</p>
        </ul>
      </div>
      <div class="one_quarter">
        <h6 class="title">Facilities</h6>
        <article>
          <p>Security</p>
          <p>Study area</p>
		  </p>Conferencing area</p>
		  <p>Kitchen</p>
		  </p>Rooms</p>
		  
		  
        </article>
      </div>
      <div class="one_quarter">
        <h6 class="title">Grab Our Newsletter</h6>
        <form method="post" action="#">
          <fieldset>
            <legend>Newsletter:</legend>
            <input class="btmspace-15" type="text" value="" placeholder="Name">
            <input class="btmspace-15" type="text" value="" placeholder="Email">
            <button type="submit" value="submit">Submit</button>
          </fieldset>
        </form>
      </div>
      <!-- ################################################################################################ -->
    </footer>
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row6">
  <div class="spacer">
    <div id="copyright" class="clear"> 
      <!-- ################################################################################################ -->
      <p class="fl_left">Copyright &copy; 2015 - All Rights Reserved - <a href="#">www.citywaldorf-student.co.za</a></p>
      <p class="fl_right">Made by <a target="_blank" href="" title="">Panacea IT</a></p>
      <!-- ################################################################################################ -->
    </div>
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="../layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
</body>
</html>