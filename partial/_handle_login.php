
<?php
        include '_dbconnect.php'; 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $user = $_POST['user'];
                $pass = $_POST['pwd'];
                $sql = "SELECT * FROM `users` WHERE `user_name`='$user'";
                $result = mysqli_query($conn,$sql);
                $num = mysqli_num_rows($result);
                if($num == 1){
                    $row = mysqli_fetch_assoc($result);
                    if(password_verify($pass, $row['user_password'])){
                        $pass1 = password_hash($pass, PASSWORD_DEFAULT);
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['id'] =  $row['user_id'];   
                        header("location:/phpProject/forum2/index.php?loggedin=true");
                        exit;               
                    }
                    else{
                            echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                <strong>Error!</strong> Password is wrong.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                            header("location:/phpProject/forum/index.php?loggedin=false");
                    }
                }
                else{
                      echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                            <strong>Error!</strong> User not exist.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                        header("location:/phpProject/forum/index.php?loggedin=false");
                }
            }
            ?>