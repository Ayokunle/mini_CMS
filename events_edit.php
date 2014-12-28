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

      $event_id = 0;
      if(isset($_GET["id"]) && !empty($_GET["id"]) || $_GET['id'] == 0){
        $source = '../database/events.xml';
        $events = new SimpleXMLElement($source,null,true);
        $event_title = "";
        $event_id = $_GET["id"];
        foreach($events as $event) {
          //echo "Event: {$event['id']}: {$event->title} - {$event->location}\r\n";
        }
      }

      if(isset($_POST["title"]) && !empty($_POST["title"])){
        echo "<a href='../admin'><button style = 'margin-left:0.5cm;' class='btn btn-info'>Back to Admin</button> </a> ";
        echo "<a href='../admin/events_view.php'><button style = 'margin-left:0.5cm;' class='btn btn-primary'>View Events</button> </a> ";
        echo("<h3 style = 'margin-left:0.5cm;'>Event has been edited.</h3>");
        try{
          //echo $_POST['event_id'];
          $xmlDoc = new DOMDocument();
          $xmlDoc->load('../database/events.xml');
          $xpath = new DOMXpath($xmlDoc);
          $nodeList = $xpath->query('//event[@id="'.(int)$_POST['event_id'].'"]');
          if ($nodeList->length) {
            $node = $nodeList->item(0);
            $node->parentNode->removeChild($node);
          }
          $xmlDoc->save('../database/events.xml');

          $xml = new DOMDocument('1.0', 'utf-8');
          $xml->formatOutput = true;
          $xml->preserveWhiteSpace = false;
          $xml->load('../database/events.xml');
          $newItem = $xml->createElement('event');
          $newItem->setAttribute("id", $_POST['event_id']);
          $newItem->appendChild($xml->createElement('title', $_POST['title']));
          $newItem->appendChild($xml->createElement('date', $_POST['date']));
          $newItem->appendChild($xml->createElement('time', $_POST['start_time']. " to " .$_POST['end_time']));
          $newItem->appendChild($xml->createElement('location', $_POST['location']));
          $newItem->appendChild($xml->createElement('fee', $_POST['fee']));
          $newItem->appendChild($xml->createElement('extra', $_POST['extra']));
          $xml->getElementsByTagName('events')->item(0)->appendChild($newItem);
          $xml->save("../database/events.xml");


        }catch( Exception $e ){ 
          echo $e->getMessage(); 
        }
      }else{
        echo("<h3 style = 'margin-left:0.5cm;'>No event has been edited.</h3>");
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
      <form action="events_edit.php" method="post">
        <?php
          foreach($events as $event) {
            if( $event['id'] == $_GET['id']){
              $event_title = $event->title;
              $times = explode("to", $event->time);
        ?>
          <!-- echo "Event: {$event['id']}: {$event->title} - {$event->location}\r\n -->
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" placeholder="Enter event title" value = "<? echo $event_title ?>" >
        </div>
        <div class="form-group">
          <label for="title">Date</label>
          <input type="date" class="form-control" name="date" value = <? echo $event->date; ?> >
        </div>
        <div class="form-group">
          <label for="title">Start Time</label>
          <input type="time" class="form-control" name="start_time" value = <? echo $times[0] ?> >
        </div>
        <div class="form-group">
          <label for="title"> End Time</label>
          <input type="time" class="form-control" name="end_time" value = <? echo $times[1] ?>>
        </div>
        <div class="form-group">
          <label for="title"> Location </label>
          <input type="text" class="form-control" name="location" value = "<? echo $event->location; ?>">
        </div>
        <div class="form-group">
          <label for="title"> Entrance Fee </label>
          <input type="text" class="form-control" name="fee" value = "<? echo $event->fee; ?>">
        </div>
        <div class="form-group">
          <label for="title"> Extra Infomation </label>
          <input type="text" class="form-control" name="extra" value = "<? echo $event->extra; ?>">
          <input type="hidden" class="form-control" name="event_id" value = "<? echo $event['id']; ?>">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>

        <? }
          }
        ?>
      </form>
    </div>
  </body>
</html>