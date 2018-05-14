<?php session_start();
// include database and object files and Const file
include_once('api/config/config.php');
include_once('api/config/const.php');

// instantiate database
$database = new Database();
$db = $database->getConnection();


//print_r($_SESSION);
if(!isset($_SESSION['user'])&&($_SESSION['user']['auth']!=1)){
    header('location:'.BASE_URL.'login.php');
    exit();
}
else
{
    $username = $_SESSION['user']['username'];
    $email = $_SESSION['user']['email'];
    $uid = $_SESSION['user']['uid'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inbox</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/style.css" rel="stylesheet" id="bootstrap-css">    
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
 <div class="mail-box">
                  <aside class="sm-side">
                      <div class="user-head">
                          <a class="inbox-avatar" href="javascript:;">
                              <img  width="64" hieght="60" src="">
                          </a>
                          <div class="user-name">
                              <h5><a href="#"><?php echo $username;?></a></h5>
                              <span><a href="#"><?php echo $email;?></a></span>
                          </div>
                          <a class="mail-dropdown pull-right" href="javascript:;">
                              <i class="fa fa-chevron-down"></i>
                          </a>
                      </div>
                      
                      
                      <?php
                      $class1 = $class2 = $class3 = $class4 = ''; 
                      if(isset($_GET['sent'])){ $class2 = 'class="active"';  }
                      elseif(isset($_GET['draft'])){ $class3 = 'class="active"';  }
                      elseif(isset($_GET['trash'])){ $class4 = 'class="active"';  }
                      else { $class1 = 'class="active"';  }
                      ?>
                      <ul class="inbox-nav inbox-divider">
                          <li <?php echo $class1;?> >
                              <a href="<?php echo BASE_URL;?>"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right">2</span></a>

                          </li>
                          <li <?php echo $class2;?> >
                              <a href="<?php echo BASE_URL;?>?sent"><i class="fa fa-envelope-o"></i> Sent Mail</a>
                          </li>                          
                          <li <?php echo $class3;?> >
                              <a href="<?php echo BASE_URL;?>?draft"><i class=" fa fa-external-link"></i> Drafts <span class="label label-info pull-right">30</span></a>
                          </li>
                          <li <?php echo $class4;?> >
                              <a href="<?php echo BASE_URL;?>?trash"><i class=" fa fa-trash-o"></i> Trash</a>
                          </li>
                      </ul>     
                  </aside>
                  <aside class="lg-side">
                      <div class="inbox-head">
                          <h3>Inbox</h3>
                          <span class="pull-right position">
                              <a href="<?PHP echo BASE_URL.'logout.php';?>" >Logout</a>
                          </span>
                      </div>
                      <div class="inbox-body">
                         <div class="mail-option">
                             <div class="chk-all">
                                 <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                                 <div class="btn-group">
                                     <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                         All
                                         <i class="fa fa-angle-down "></i>
                                     </a>
                                     <ul class="dropdown-menu">
                                         <li><a href="#"> None</a></li>
                                         <li><a href="#"> Read</a></li>
                                         <li><a href="#"> Unread</a></li>
                                     </ul>
                                 </div>
                             </div>

                             <div class="btn-group">
                                 <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                                     <i class=" fa fa-refresh"></i>
                                 </a>
                             </div>
                             <div class="btn-group hidden-phone">
                                 <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                                     More
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                 </ul>
                             </div>
                             <div class="btn-group">
                                 <a data-toggle="dropdown" href="#" class="btn mini blue">
                                     Move to
                                     <i class="fa fa-angle-down "></i>
                                 </a>
                                 <ul class="dropdown-menu">
                                     <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                     <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                     <li class="divider"></li>
                                     <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                 </ul>
                             </div>

                             <ul class="unstyled inbox-pagination">
                                 <li><span>unknown</span></li>
                                 <li>
                                     <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                 </li>
                                 <li>
                                     <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                 </li>
                             </ul>
                         </div>
                          <table class="table">
                            <tbody>
                            <?php
                                // Code for retrive all messages as per status //
                                $id = $_REQUEST['id'];

                                $sql = 'select * from messages where id ='.$id;
                                $result = $db->query($sql);
                                if($row = $result->fetch_assoc()) { //print_r($row);

                                    $fromid = $row["fromid"];
                                    $toid = $row["id"];
                            
                                    // Get to ID details //
                                    $sql = 'select * from users where id = '.$toid;

                                    $result = $db->query($sql);
                                    if($row1 = $result->fetch_assoc()) {                            
                                        $toemail = $row1["email"];                            
                                    }
                                    // Get From ID details //
                                    $sql = 'select * from users where id = '.$fromid;

                                    $result = $db->query($sql);
                                    if($row2 = $result->fetch_assoc()) {                            
                                        $fromemail = $row2["email"];                            
                                    }

                                    
                            ?>    
                                <tr>
                                <td><b>From :</b></td>
                                <td><input type="text" value="<?php echo $fromemail;?>" size="50" readonly="readonly"></td>
                                
                            </tr>
                            <tr>
                                <td><b>To :</b></td>
                                <td><input type="text" value="<?php echo $toemail;?>" size="50" readonly="readonly"></td>
                                
                            </tr>
                                <tr class="unread" >
                                       <td class="view-message ">Subject: </td><td><?php echo $row['title'];?></td>
                                       
                                       
                                   </tr>
                                   <tr><td class="view-message ">Message: </td><td><?php echo $row['body'];?></td></tr>
                                   <?php
                                }
                                ?>
                            <tr>
                                <td colspan="2">
                                     <input type="button" name='reply' value='reply' class="btn btn-primary" onclick="location.href='<?php echo BASE_URL;?>reply.php?id=<?php echo $id; ?>'"> 
                                     <input type="button" name='delete' value='delete'  class="btn btn-primary" onclick="location.href='<?php echo BASE_URL;?>trash.php?id=<?php echo $id; ?>'">  
                                </td>
                            </tr>  
                          </tbody>
                          </table>
                      </div>
                  </aside>
              </div>
</div>
    
</body>
</html>