<html>
  <head> 
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin</title>

      <!-- Bootstrap -->
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Overlock' rel='stylesheet' type='text/css'>

      <style type="text/css">
        body{
          font-family: 'Overlock', cursive;
          font-size: 50px;
        }
        #cen{
          position: relative;
          margin-top: 2%;
        }
        .btn{
          width: 300px;
          height: 100px;
        }
      </style>      
  </head>

  <body>
    <center id = "cen">

      <p>
        <a style ="color:white;" href="events_new.php">
          <button class="btn btn-success">
            <font size = "5px"> 
                Add Event
            </font>
          </button>
        </a>
      </p>
      <p>
        <a style ="color:white;" href="events_view.php">
        <button class="btn btn-primary">
          <font size = "5px">
              View/Edit/Delete Events
          </font>
        </button>
        </a>
      </p>
      <p>
        <a style ="color:white;" href="blogs_new.php">
          <button class="btn btn-warning">
            <font size = "5px"> 
                Add Blog
            </font>
          </button>
        </a>
      </p>
      <p>
        <a style ="color:white;" href="blogs_view.php">
        <button class="btn btn-danger">
          <font size = "5px">
              View/Edit/Delete Blogs
          </font>
        </button>
        </a>
      </p>
      <p>
        <a style ="color:white;" href="music_view.php">
        <button class="btn btn-info">
          <font size = "5px">
              View/Edit/Delete Music
          </font>
        </button>
        </a>
      </p>
      <p>
        <a style ="color:white;" href="image_new.php">
        <button class="btn btn-success">
          <font size = "5px">
              Add Images
          </font>
        </button>
        </a>
      </p>
    </center>
  </body>
</html>