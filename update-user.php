                       <?php
                        /**................................................................
 * @package eblog v 1.0
 * @author Faith Awolu 
 * Hillsofts Technology Ltd.            
 * (hillsofts@gmail.com)
 * ................................................................
 */
                        
session_start();
include('connect.php');
 $user=$_SESSION['SESS_MEMBER_ID'];

$a = $_POST['username'];
$b = $_POST['chapa_agente'];
$c = $_POST['pass'];
// query

$sql = "UPDATE user SET 
        `username`=?,`chapa_agente`=?,`pass`=?
        WHERE id='$user'";


//$sql = "INSERT INTO settings (site_name,site_title,email,site_keyword,street,city,country,phone,facebook,twitter,linkedin,status) VALUES (:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l)";

$q = $db->prepare($sql);
$q->execute(array($a,$b,$c));{
if($q){
      header("location:user.php?success=true");
        }else{
            header("location:user.php?failed=true");
        } 
		}


?>