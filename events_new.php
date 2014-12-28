<html>
  <head> 
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Admin - New Event</title>

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
      $file_id = fopen("id.txt", "r+");
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
        echo "<a href='../admin/events_view.php'><button style = 'margin-left:0.5cm;' class='btn btn-primary'>View Events</button> </a> ";
        echo("<h3 style = 'margin-left:0.5cm;'>Event has been added.</h3>");
        try{
          $xml = new DOMDocument('1.0', 'utf-8');
          $xml->formatOutput = true;
          $xml->preserveWhiteSpace = false;
          $xml->load('../database/events.xml');
          $newItem = $xml->createElement('event');
          $newItem->setAttribute("id", $event_id);
          $newItem->appendChild($xml->createElement('title', $_POST['title']));
          $newItem->appendChild($xml->createElement('date', $_POST['date']));
          $newItem->appendChild($xml->createElement('time', $_POST['start_time']. " to " .$_POST['end_time']));

          if(empty($_POST['location'])){
            $newItem->appendChild($xml->createElement('location',"Unspecified"));
          }else{
            $newItem->appendChild($xml->createElement('location', $_POST['location']));
          }
          
          if(empty($_POST['fee'])){
            $newItem->appendChild($xml->createElement('fee',"Unspecified"));
          }else{
            $newItem->appendChild($xml->createElement('fee', $_POST['fee']));
          }

          if(empty($_POST['extra'])){
            $newItem->appendChild($xml->createElement('extra',"None"));
          }else{
            $newItem->appendChild($xml->createElement('extra', $_POST['extra']));
          }
          $xml->getElementsByTagName('events')->item(0)->appendChild($newItem);
          $xml->save("../database/events.xml");

          $file_id = 'id.txt';
          file_put_contents($file_id, $x);

          $file_id = fopen("id.txt", "r+");
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
    <h1 style = "margin-left:0.5cm;"> Add New Event </h1>
    <div style = "border:2px solid #a1a1a1; 
            padding:10px 40px; 
            background: white;    
            width:600px;
            border-radius:15px;
            margin-left:0.5cm;">
      <form action="events_new.php" method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" placeholder="Enter event title">
        </div>
        <div class="form-group">
          <label for="title">Date</label>
          <input type="date" class="form-control" name="date" >
        </div>
        <div class="form-group">
          <label for="title">Start Time</label>
          <input type="time" class="form-control" name="start_time">
        </div>
        <div class="form-group">
          <label for="title"> End Time</label>
          <input type="time" class="form-control" name="end_time">
        </div>
        <div class="form-group">
          <label for="title"> Location </label>
          <input type="text" class="form-control" name="location">
        </div>
        <div class="form-group">
          <label for="title"> Entrance Fee </label>
          <input type="text" class="form-control" name="fee">
        </div>
        <div class="form-group">
          <label for="title"> Extra Infomation </label>
          <input type="text" class="form-control" name="extra">
          <input type="hidden" class="form-control" value =<? echo $event_id; ?> name="event_id">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </body>
</html>