<html>
  <head> 
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin - New Blog</title>

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
    <?php
      $file_id = fopen("id_blog.txt", "r+");
      $x = 0;
      $event_id = 0;
      while(!feof($file_id)){
          $line = fgets($file_id);
          $x =  (int)$line;
          $event_id = $x;
          $x = $x + 1;
      }
      fclose($file_id);
    ?>
    <?php
      if(isset($_POST["title"]) && !empty($_POST["title"])){
        echo "<a href='../admin'><button style = 'margin-left:0.5cm;' class='btn btn-info'>Back to Admin</button> </a> ";
        echo "<a href='../admin/blogs_view.php'><button style = 'margin-left:0.5cm;' class='btn btn-primary'>View Blogs</button> </a> ";
        echo("<h3 style = 'margin-left:0.5cm;'>Blog has been added.</h3>");
        try{
          $xml = new DOMDocument('1.0', 'utf-8');
          $xml->formatOutput = true;
          $xml->preserveWhiteSpace = false;
          $xml->load('../database/blogs.xml');
          $newItem = $xml->createElement('blog');
          $newItem->setAttribute("id", $event_id);
          $newItem->appendChild($xml->createElement('title', $_POST['title']));
          $newItem->appendChild($xml->createElement('text', $_POST['text']));
          $xml->getElementsByTagName('blogs')->item(0)->appendChild($newItem);
          $xml->save("../database/blogs.xml");

          $file_id = 'id_blog.txt';
          file_put_contents($file_id, $x);

          $file_id = fopen("id_blog.txt", "r+");
          fclose($file_id);

        }catch( Exception $e ){ 
          echo $e->getMessage(); 
        }
      }else{
      }
    ?>
    <?
    echo "<a href='../admin/menu.php'><button style = 'margin-left:0.5cm;' class='btn btn-primary'>Menu</button> </a> ";
    ?>
    <h1 style = "margin-left:0.5cm;"> Add New Blog </h1>
    <div style = "border:2px solid #a1a1a1; 
            padding:10px 40px; 
            background: white;    
            width:600px;
            border-radius:15px;
            margin-left:0.5cm;">
      <form action="blogs_new.php" method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" placeholder="Enter event title">
        </div>
        <div class="form-group">
          <label for="title"> Blog Text </label>
          <textarea rows="5" cols="50" class="form-control" name="text"> </textarea>
          <input type="hidden" class="form-control" value =<? echo $event_id; ?> name="event_id">
          Please note that you'll need to add "\n" to the end of a sentence to indicate a new line or new paragraph.</br>
          Like this:</br>
          <textarea readonly rows="2" cols="50" class="form-control" name="text1">
Lorem ipsum dolor sit amet, his eu fugit detraxit, habeo aeterno nusquam sit ex. \n 
Aliquam eleifend his an. Justo mazim tractatos ne sea, sea veri nemore cu, in ludus congue epicurei pro.
          </textarea >
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </body>
</html>