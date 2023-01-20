<?php
session_start();
include '_signup_modal.php';
include '_login_modal.php';
include '_dbconnect.php';

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/phpProject/forum2">Forum</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/phpProject/forum2">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Top Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          ';
          $sql1 = "SELECT * FROM `category`";
      $result1 = mysqli_query($conn,$sql1);
      while($row1 = mysqli_fetch_assoc($result1)){
        echo '<a class="dropdown-item" href="#">'.$row1['cat_title'].'</a>';
      }
          echo'
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
    </form>';
    
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
      $id1 = $_SESSION['id'];
      $sql = "SELECT * FROM `users` WHERE `user_id` = '$id1'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_assoc($result);
      echo '<p class="text-light mx-2 mb-0">Welcome '.$row['user_name'].'</p>
            <a href="partial/_logout.php">
              <button class="btn btn-outline-success my-2 my-sm-0 mx-2" type="submit">Logout</button>
            </a>
          </div>
        </nav>';
    }
    else{
      echo '<button class="btn btn-outline-success my-2 my-sm-0 mx-2" type="submit" data-toggle="modal" data-target="#loginModal">Login</button>
            <button class="btn btn-outline-success my-2 my-sm-0 mx-2" type="submit" data-toggle="modal" data-target="#signupModal">Signup</button>
          </div>
        </nav>';
    }

      
      
?>


