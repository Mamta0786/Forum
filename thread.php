<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Post</title>
  </head>
  <body>
    <?php include 'partial/_header.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Post</title>
</head>

<body>
    <?php 
        include 'partial/_dbconnect.php';
    ?>
    <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE `thread_sr` = '$id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $tt = $row['thread_title'];
        $td = $row['thread_desc'];
        $tuid = $row['thread_user_id'];
        $sql1 = "SELECT * FROM `users` where `user_id`='$tuid'";
        $result1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $user = $row1['user_name'];

    ?>
    <div class="container my-2">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo "$tt"; ?></h1>
            <p class="lead"><?php echo "$td"; ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
            <p><strong>Posted by- <?php echo "$user"; ?></strong></p>
        </div>
    </div>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
                $id1 = $_SESSION['id'];
            }
            $cmnt = $_POST['comment'];
            $sql1 = "INSERT INTO `comments` (`comment_desc`, `comment_user_id`, `comment_thread_id`, `comment_time`) 
            VALUES ('$cmnt', '$id1', '$id', current_timestamp());";
            $result1 = mysqli_query($conn,$sql1);
        }
    ?>
    <div class="container my-3">
        <h2>Post a comment</h2>
        <?php
        // session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                    <div class="form-group">
                        <label for="comment">Write your comment here</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>';
        }
        else{
            echo "You are not logged in. please login to write your comment.";
        }
        ?>
        
    </div>


    <div class="container my-2">
        <h2>Discussion  </h2>
        <?php
            $sql = "SELECT * FROM `comments` where `comment_thread_id`='$id'";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            if($num>0){
                while($row = mysqli_fetch_assoc($result)){
                    $i = $row['comment_user_id'];
                    $sql1 = "SELECT * FROM `users` where `user_id`='$i'";
                    $result1 = mysqli_query($conn,$sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $user = $row1['user_name'];
                    echo '<div class="media">
                            <img src="images/user.png" class="align-self-start mr-3" alt="..." style="width:70px;">
                            <div class="media-body">
                                <h5 class="mt-0">'.$user.'</h5>
                                <p>'.$row['comment_desc'].'</p>
                            </div>
                        </div>';
                }
            }
            else{
                echo '
                        <div class="jumbotron">
                            <h1 class="display-4">Oops! no result found</h1>
                            <p class="lead">Be the first person to ask a question.</p>
                        </div>
                    ';
            }
        ?>
    </div>

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
    <?php include 'partial/_footer.php'; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

