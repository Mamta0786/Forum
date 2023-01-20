
<?php
        include '_dbconnect.php';
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $user = $_POST['user'];
                $pass = $_POST['pwd'];
                $cpass = $_POST['cpwd'];
                $sql = "SELECT * FROM `users` WHERE `user_name`='$user'";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
                if($num == 0){
                    if($pass == $cpass && $pass != null && $user != null){
                        $pass1 = password_hash($pass, PASSWORD_DEFAULT);
                        $sql1 = "INSERT INTO `users` (`user_name`, `user_password`, `user_time`) 
                        VALUES ('$user', '$pass1', current_timestamp())";
                        $result1 = mysqli_query($conn,$sql1);
                        header("location:/phpProject/forum2/index.php?Signup=true");
                        exit;  
                    }
                    else{
                        echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                 <strong>Error!</strong> Password was mismatch.
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                                 </button>
                               </div>';
                    }
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            <strong>Error!</strong> User already exist.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';

                }
            }
            ?>