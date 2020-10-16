<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IMPOSTOR MESSENGER</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <div class="navbar">
        <div class="menu">
          <h3 class="logo">Mess<span>enger</span></h3>
          <div class="hamburger-menu">
            <div class="bar"></div>
          </div>
        </div>
      </div>

      <div class="main-container">
        <div class="main">
          <header>
            <div class="overlay">
              <div class="inner" style="height: 95%;width: 40%;background-color: white;font-size: 40px; overflow: auto; color: black">
                <p>
                    <?php
                    $con=mysqli_connect("localhost","root","","ssip");
                    $sql="SELECT msg, msg_time FROM messege";
                    $res= $con ->  query($sql);
                    if ($res -> num_rows > 0) {
                        while($row = $res -> fetch_assoc()) {
                            echo "<p>" . $row["msg"] ."\t" . '<span style="font-size: 17px;">' . $row["msg_time"] . "\t";
                        }
                    } else {
                        echo "DB error, create SQL table before";
                    }
                    $con -> close();
                    ?>
                </p>
                <input id="c" type="text" style="width: 415; height: 40">
                <input type="submit" style="width: 140" onclick="a2(); document.location.reload(true)">
              </div>
            </div>
          </header>
        </div>

        <div class="shadow one"></div>
        <div class="shadow two"></div>
      </div>

      <div class="links">
        <ul>
          <li>
            <a href="index.html" style="--i: 0.05s;">Home</a>
          </li>
          <li>
            <a href="#" style="--i: 0.1s;">Login</a>
          </li>
          <li>
            <a href="messeging.php" style="--i: 0.15s;">Messege</a>
          </li>
          <li>
            <a href="#" style="--i: 0.2s;">Profile</a>
          </li>
          <li>
            <a href="#" style="--i: 0.25s;">Setting</a>
          </li>
        </ul>
      </div>
    </div>

    <script src="app.js"></script>
      <script>
          function a2(){
            var a= new XMLHttpRequest();
            a.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){ document.getElementById("d1").innerHTML = this.responseText;
                }
            }
            a.open("GET","w.php?c="+c.value, true);
            a.send();
            document.getElementById("c").value="";
        }
          function reloadpage()
        {
            location.reload()
        }
      </script>
  </body>
</html>
