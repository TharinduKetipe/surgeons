<?php
require_once'core/init.php';
        $uname = 'Username';
        $pwd   = 'Password';
       
if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        
        $validate=new Validation();
        $validation=$validate->check($_POST, array(
            'username'=>array('required'=>true),
            'password'=>array('required'=>true)
        ));
        if ($validation->passed()) {
            $surgeon=new Surgeon();
            
            $remember = (Input::get('remember')==='on')?TRUE:FALSE;
            $login=$surgeon->login(Input::get('username'),Input::get('password'),$remember);
            if ($login) {
                
                Redirect::to('index.php');
            } else {
                echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Username or Password was incorrect !</strong> 
</div>';
                    
                 
                
               
                $uname='Invalid Log In. ';
                $pwd='Invalid Log In.';
            }
        
        
            
        }else{
            
            echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Username or password was not entered !</strong> 
</div>';
            
           
            
            
            
            if(sizeof($validation->errors())==1){
                if($validation->errors()[0]=='username is required'){
                    $uname = 'Username is required';
                    
                }  else {
                    $pwd = 'Password is required.';
                    
                }
                
                                
                
            }  else {
                
                $uname = 'Username is required.';
                $pwd = 'Password is required.';
                
            }
            
              
                
            
          
        }
    }
}

?>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
                <!-- Header Links-->
		<title>SriLanka Eye Donation Society</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
                <link href="interface/css/bootstrap.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
                <link href="interface/css/styles.css" rel="stylesheet">
                
	</head>
        <body style="background: #fff; margin-top: 0px;padding-top: 0px" >
            <!-- header -->
     <nav class="navbar navbar-static" >
    <a class="navbar-brand " href="http://localhost/netbeans/Eyee/index.php" target="ext"><b><image src="interface/images/eye.png"></b></a>
   <div class="container">
    <div class="navbar-header" >
      
      <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="glyphicon glyphicon-chevron-down"></span>
      </a>
    </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">  
            <li ><a href="#"  >Home</a></li>
          <li><a href="#" class="active">Surgeons</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Donate</a>
            <ul class="dropdown-menu">
              <li><a href="#">Cash</a></li>
              <li><a href="#">Tissues</a></li>
              
              
            </ul>
            <li><a href="#">Eyes</a></li>
            <li><a href="#">Tissues</a></li>
             <li><a href="#">Reservations</a></li>
            <li><a href="#">Lens Lab</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
          
          
        </ul>
         <b id="topname">SriLanka Eye Donation Society</b>
         
        
      </div>
       
       
       
    </div>
     </nav>
            
            <form action="" method="post">
            <div class="login">
                <table style="alignment-adjust: central;border-width: 0px;float: right">
                    <tr>
                        <td>
                             <div class="input-group input-group-sm">
                             <span class="input-group-addon">@</span>
                             <input type="text" class="form-control"  placeholder="<?php echo $uname;?>" name="username" id="username" autocomplete="off">
                              </div>
                        </td>
                        <td>
                             <div class="input-group input-group-sm">
                             <span class="input-group-addon">*</span>
                             <input type="password" class="form-control" placeholder="<?php echo $pwd;?>" name="password" id="password" autocomplete="off">
                        </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="input-group input-group-sm">
                                <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                                <input type="submit" value="log In" class="btn btn-default navbar-btn" style="background:#428bca;color: #fff">
                                
                            </div>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group input-group-sm">
                            <label for="remember">
                             <input type="checkbox" name="remember" id="remember"> Remember me 
                             </label>
                            </div>
                        </td>
                        <td>
                            <div class="input-group input-group-sm">
                            <label for="remember">
                                <a href="#">Forgot your password?</a>  
                             </label>
                            </div>
                        </td>
                        
                    </tr>
                </table>
                </div>
                
            
        </form>
            <!--
<form action="" method="post">
    
    <div class="field">
        <label for="username" >Username</label>
        <input type="text" name="username" id="username" autocomplete="off">
    </div>
    
    <div class="field">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off">
             
    </div>
    
    <div class="field">
        
        <label for="remember">
            <input type="checkbox" name="remember" id="remember"> Remember me 
        </label>
    </div>
    
    <input type="hidden" name="token" value="<//?php echo Token::generate();?>">
    <input type="submit" value="login">
</form> 

</body>
</html>
            -->
