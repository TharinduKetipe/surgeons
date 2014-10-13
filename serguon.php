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
    <?php 
    include 'login.php';
    include 'register.php';
    include 'interface/footer.inc';
    
    if(isset($_POST['login'])){
        
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
  <strong>Username or Password is incorrect !</strong> 
</div>';
                    
                 
                
               
                $uname='Invalid Log In. ';
                $pwd='Invalid Log In.';
            }
        
        
            
        }else{
            
            echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Required data are missing!!</strong> 
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
    }elseif (isset ($_POST['register'])) {
        
        require_once 'core/init.php';
global $error;
global $fail;
$dcerror = "";









    






if(Input::exists()){
    
    
    
    if(Token::check(Input::get('token'))){
        if(!$_FILES['document']['size']>0){
            $dcerror = "Please upload the document.";
            
        }  else {
            
                  }

    $validate = new Validation();
    $validation = $validate->check($_POST,array(
        'username'=> array(
            'required' => TRUE,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'password'=> array(
            'required'=> TRUE,
            'min' => 6
        ),
        'ConfirmPassword' => array(
            'required' => TRUE,
            'matches' => 'password'
        ),
        'name' => array(
            'required' => TRUE,
            'min' => 2,
            'max' => 100,
        ),
        'email' => array(
            'required' => TRUE,
            'evalidate'=> TRUE,
            
            
        ),
        'nic' => array(
            'required' => TRUE,
            
        ),
        'birthday' => array(
            'required' => TRUE,
            
        ),
        'address' => array(
            'required' => TRUE,
            
        ),
        'country' => array(
            'required' => TRUE,
            
        ),
        'gender' => array(
            'required' => TRUE,
            
        ),
        
        
        
        
    ));
    
    
   
    if ( $validation->passed()&& $_FILES['document']['size']>0){
        $surgeon = new Surgeon();
        $salt = Hash::salt(32);
        
        $fileName = $_FILES['document']['name'];
        $tmpName  = $_FILES['document']['tmp_name'];
        $fileSize = $_FILES['document']['size'];
        $fileType = $_FILES['document']['type'];

        $fp      = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
         fclose($fp);

        if(!get_magic_quotes_gpc()){

        $fileName = addslashes($fileName);
        }
        
        
        try {
            $surgeon->create(array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'email'=> Input::get('email'),
                'nic'  => Input::get('nic'),
                'birthday' => Input::get('birthday'),
                'gender' => Input::get('gender'),
                'number' => Input::get('number'),
                'address' => Input::get('address'),
                'country' => Input::get('country'),
                'dname'   => $fileName,
                'dtype'   => $fileType,
                'dsize'   => $fileSize,
                'document'=> $content,
                'salt' => $salt,
                'name' => Input::get('name'),
                'joined' => date('Y-m-d H:i:s'),
                'group' => 1
            ));
            
            
            

            Session::flash('index','You have been registered and can now log in!');
            
            
            Redirect::to('index.php');
            
            
            
        } catch (Exception $e) {
            die($e->getMessage());
            
        }
    
    }  else {
        $error = $validation->errors();
        
        
        
    }
    
    }
}
    
}
    
    ?>