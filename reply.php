<?php session_start();
include_once('api/config/config.php');
include_once('api/config/const.php');
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

// instantiate database
$database = new Database();
$db = $database->getConnection();


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
    <script language="javascript">
     function callme(){
        alert(1);
        $('input[name=amessage]').val(document.getElementById("rmessage").innerHTML);       
        
        return true;
     }
    </script>
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
                      <div class="inbox-body">
                          <a href="#myModal" data-toggle="modal"  title="Compose"    class="btn btn-compose">
                              Compose
                          </a>
                          <!-- Modal -->
                          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                          <h4 class="modal-title">Compose</h4>
                                      </div>
                                      <div class="modal-body">
                                          <form role="form" data-toggle="validator" class="form-horizontal" method="post" action="composeSubmit.php">
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">To</label>
                                                  <div class="col-lg-10">
                                                      <input type="email" placeholder="abc@gmail.com" name='toemail' id="inputEmail1" class="form-control" required>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Cc / Bcc</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" placeholder="" id="cc" class="form-control" disabled='disabled'>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Subject</label>
                                                  <div class="col-lg-10">
                                                      <input type="text" name='subject' id="inputPassword1" class="form-control"  required>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-lg-2 control-label">Message</label>
                                                  <div class="col-lg-10">
                                                      <textarea rows="10" cols="30" class="form-control" id="" name="message"  required></textarea>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <div class="col-lg-offset-2 col-lg-10">
                                                      <input type="hidden" name="fromid" value="<?php echo $uid;?>">
                                                      <button class="btn btn-send" type="submit">Send Mail!</button>
                                                  </div>
                                              </div>
                                          </form>
                                      </div>
                                  </div><!-- /.modal-content -->
                              </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
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
                        <?php
                        $id = $_REQUEST['id'];
                        $sql = 'select * from messages where id = '.$id.' order by sdate desc';

                        $result = $db->query($sql);
                        if($row = $result->fetch_assoc()) {
                            
                            $fromid = $row["fromid"];
                            $toid = $row["toid"];
                            $title = $row["title"];
                            $body = $row["body"];
                            $sdate = $row['sdate'];
                            $sdate = date('l jS \of F Y h:i:s A',strtotime($sdate));
                        }

                        // Get to ID details //
                        $sql = 'select * from users where id = '.$toid;

                        $result = $db->query($sql);
                        if($row = $result->fetch_assoc()) {                            
                            $toemail = $row["email"];                            
                        }
                        // Get From ID details //
                        $sql = 'select * from users where id = '.$fromid;

                        $result = $db->query($sql);
                        if($row = $result->fetch_assoc()) {                            
                            $fromemail = $row["email"];                            
                        }

                        if($email == $toemail){
                            $sender = $toemail;
                            $reciever = $fromemail;
                            $senderid = $toid;
                            $recieverid = $fromid; 
                        }
                        else{
                            $sender = $fromemail;
                            $reciever = $toemail;
                            $senderid = $fromid;
                            $recieverid = $toid; 
                        }

                        ?>
                        <form action="replysubmit.php" onsubmit="return callme();" method="post">
                          <table class="table ">
                            <tbody>
                            <tr>
                                <td><b>From :</b></td>
                                <td><input type="text" name="fromemail" value="<?php echo $reciever;?>" size="50" readonly="readonly"></td>
                                
                            </tr>
                            <tr>
                                <td><b>To :</b></td>
                                <td><input type="text" name="toemail" value="<?php echo $sender;?>" size="50" readonly="readonly"></td>
                                
                            </tr>
                            <tr>
                                <td>
                                    <b>Subject :</b>
                                </td>
                                <td><input type="text" name="title" value="<?php echo "Re:".$title;?>" size="50"></td>
                                
                            </tr>
                            <tr>
                                <td>Message :</td><td style="border:1px solid black;"><div contenteditable="true" id="rmessage"><br><div style="margin-left:20px;"><font color="#cccccc">On <?php echo $sdate;?>,<?php echo $fromemail;?> wrote:</font> <br> <?php echo $body;?></div></div></td>
                            </tr>
                            <td colspan="2">
                                     <input type="submit" name='reply' value='reply' class="btn btn-primary" > 
                                     <input type="hidden" name="fromid" value="<?php echo $senderid;?>">
                                     <input type="hidden" name="toid" value="<?php echo $recieverid;?>">
                                     <input type="hidden" name="amessage" id="amessage" value="">  
                            </td>

                               
                          </tbody>
                          </table>
                    </form>
                      </div>
                  </aside>
              </div>
</div>
    
</body>
</html>