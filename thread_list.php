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
        include 'partial/_header.php'; 
        include 'partial/_dbconnect.php';
        
    ?>
    <?php
        $id = $_GET['cat_id'];
        $sql = "SELECT * FROM `category` WHERE `cat_id` = '$id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $ct = $row['cat_title'];
        $cd = $row['cat_desc'];

    ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcom to the <?php echo "$ct"; ?> forum.</h1>
            <p class="lead"><?php echo "$cd"; ?></p>
            <!-- <hr class="my-4"> -->
            <!-- <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
        </div>
    </div>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
                    $id1 = $_SESSION['id'];
            }
            $thread_t = $_POST['title'];
            $thread_d = $_POST['desc'];
            $sql1 = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `thread_time`) 
            VALUES ('$thread_t', '$thread_d', '$id', '$id1', current_timestamp());";
            $result1 = mysqli_query($conn,$sql1);
        }
    ?>
    
        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
            echo '<div class="container my-3">
                    <h2>Start a discussion</h2>
                    <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                        <div class="form-group">
                            <label for="title">Problem Title</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">Keep your title as short as possible.</small>
                        </div>
                        <div class="form-group">
                            <label for="desc">Elaborate your problem</label>
                            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>';
        }
        else{
            echo '<div class="container my-3">
                    <h2>Start a discussion</h2>
                    <p>You are not logged in. please login to start a discussion</p>
                </div>';
        }

        ?>
        
        
    


    <div class="container my-2">
        <h2>Browse Question</h2>
        <?php
            $sql = "SELECT * FROM `threads` where `thread_cat_id`='$id'";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            
            if($num>0){
                
                while($row = mysqli_fetch_assoc($result)){
                    $i = $row['thread_user_id'];
                    $sql1 = "SELECT * FROM `users` where `user_id`='$i'";
                    $result1 = mysqli_query($conn,$sql1);
                    $row1 = mysqli_fetch_assoc($result1);
                    $ttitle = $row['thread_title'];
                    $tid = $row['thread_sr'];
                    echo '<div class="media">
                            <img src="images/user.png" class="align-self-start mr-3" alt="..." style="width:50px;">
                            <div class="media-body">
                                <h5><b>'.$row1['user_name'].' at '.$row['thread_time'].'</b> </h5>
                                <a href="thread.php?threadid='.$tid.'" class="text-dark">
                                    <h5 class="mt-0">'.$ttitle.'</h5>
                                </a>
                                <p>'.$row['thread_desc'].'</p>
                                
                            </div>
                        </div>';

                }
            }
            else{
                echo '<div class="container">
                        <div class="jumbotron">
                            <h1 class="display-4">Oops! no result found</h1>
                            <p class="lead">Be the first person to ask a question.</p>
                        </div>
                    </div>';
            }
        ?>
    </div>

    <?php include 'partial/_footer.php'; ?>

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