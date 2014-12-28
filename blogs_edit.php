<html>
  <head> 
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin - Edit Blog</title>

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

      $event_id = 0;
      if(isset($_GET["id"]) && !empty($_GET["id"]) || $_GET['id'] == 0){
        $source = '../database/blogs.xml';
        $events = new SimpleXMLElement($source,null,true);
        $event_title = "";
        $event_id = $_GET["id"];
        foreach($events as $event) {
          //echo "Event: {$event['id']}: {$event->title} - {$event->location}\r\n";
        }
      }

      if(isset($_POST["title"]) && !empty($_POST["title"])){
        echo "<a href='../admin'><button style = 'margin-left:0.5cm;' class='btn btn-info'>Back to Admin</button> </a> ";
        echo "<a href='../admin/blogs_view.php'><button style = 'margin-left:0.5cm;' class='btn btn-primary'>View Blogs</button> </a> ";
        echo("<h3 style = 'margin-left:0.5cm;'>Blog has been edited.</h3>");
        try{
          //echo $_POST['event_id'];
          $xmlDoc = new DOMDocument();
          $xmlDoc->load('../database/blogs.xml');
          $xpath = new DOMXpath($xmlDoc);
          $nodeList = $xpath->query('//blog[@id="'.(int)$_POST['event_id'].'"]');
          if ($nodeList->length) {
            $node = $nodeList->item(0);
            $node->parentNode->removeChild($node);
          }
          $xmlDoc->save('../database/blogs.xml');

          $xml = new DOMDocument('1.0', 'utf-8');
          $xml->formatOutput = true;
          $xml->preserveWhiteSpace = false;
          $xml->load('../database/blogs.xml');
          $newItem = $xml->createElement('blog');
          $newItem->setAttribute("id", $_POST['event_id']);
          $newItem->appendChild($xml->createElement('title', $_POST['title']));
          $newItem->appendChild($xml->createElement('text', $_POST['text']));
          $xml->getElementsByTagName('blogs')->item(0)->appendChild($newItem);
          $xml->save("../database/blogs.xml");


        }catch( Exception $e ){ 
          echo $e->getMessage(); 
        }
      }else{
        echo("<h3 style = 'margin-left:0.5cm;'>No blog has been edited.</h3>");
      }
    ?>
    <?
    echo "<a href='../admin/menu.php'><button style = 'margin-left:0.5cm;' class='btn btn-primary'>Menu</button> </a> ";
    ?>
    <h1 style = "margin-left:0.5cm;"> Edit Event </h1>
    <div style = "border:2px solid #a1a1a1; 
            padding:10px 40px; 
            background: white;    
            width:600px;
            border-radius:15px;
            margin-left:0.5cm;">
      <form action="blogs_edit.php" method="post">
        <?php
          foreach($events as $event) {
            if( $event['id'] == $_GET['id']){
              $event_title = $event->title;
              //$times = explode("to", $event->time);
        ?>
          <!-- echo "Event: {$event['id']}: {$event->title} - {$event->location}\r\n -->
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" placeholder="Enter blog title" value = "<? echo $event_title ?>" >
        </div>
        <div class="form-group">
          <label for="title"> Blog Text </label>
          <textarea rows="5" cols="50" type="text" class="form-control" name="text"><? $str = nl2br($event->text);  $str = str_replace("<br />", "", $str); echo $str; ?> </textarea>
          <input type="hidden" class="form-control" name="event_id" value = "<? echo $event['id']; ?>">
          Please note that you'll need to add "\n" to the end of a sentence to indicate a new line or new paragraph.</br>
          Like this:</br>
          <textarea readonly rows="2" cols="50" class="form-control" name="text1">
Lorem ipsum dolor sit amet, his eu fugit detraxit, habeo aeterno nusquam sit ex. \n 
Aliquam eleifend his an. Justo mazim tractatos ne sea, sea veri nemore cu, in ludus congue epicurei pro.
          </textarea >
        </div>
        <button type="submit" class="btn btn-success">Submit</button>

        <? }
          }
        ?>
      </form>
    </div>
  </body>
</html>