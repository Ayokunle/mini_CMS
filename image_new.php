<html>
  <head> 
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin - New Images</title>

      <!-- Bootstrap -->
      <link href="css/bootstrap.css" rel="stylesheet">
      <link href='http://fonts.googleapis.com/css?family=Overlock' rel='stylesheet' type='text/css'>

      <style type="text/css">
        body{
          font-family: 'Overlock', cursive;
          /*font-size: 50px;*/
        }
        #cen{
          position: relative;
          margin-top: 10%;
          width: 70%;
        }
      </style>      
  </head>

  <body>

    <h1 style = "margin-left:0.5cm;"> Add New Images </h1>
    <div style = "border:2px solid #a1a1a1; 
            padding:10px 40px; 
            background: white;    
            width:600px;
            border-radius:15px;
            margin-left:0.5cm;">
      <form action="upload_file.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="file">Filename:</label>
           <input type="file" id="file" name="files[]" multiple="multiple" accept="image/*" /><br>
        </div>
        <button type="submit" name="submit" value="Submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </body>
</html>
</html>