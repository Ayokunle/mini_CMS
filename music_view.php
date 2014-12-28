<html>
	<head> 
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Admin - View Music</title>

    	<!-- Bootstrap -->
    	<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
    <?
    echo "<a href='../admin/menu.php'><button style = 'margin-left:0.5cm;' class='btn btn-primary'>Menu</button> </a> ";
    ?>
    <?
    echo "<a href='../admin/music_new.php'><button style = 'margin-left:0.5cm;' class='btn btn-primary'>Add Music</button> </a> ";
    ?>
    <b> Delete not fully working so be careful!!! </b>
		<table class= 'table table-hover table-bordered'>
			<?
			echo "<tr>";
			echo '<th><b>Edit/Delete </b></th>';
            echo '<th><b>Track Name </b></th>';
            echo '<th><b>Track Link </b></th>';
            echo "</tr>";

			     $event_id = 0;
            try{
          	if( ! $xml = simplexml_load_file('../database/music.xml') ){ 
            	echo 'unable to load XML file'; 
          	}else { 

              $json = json_encode($xml);
              $array = json_decode($json,TRUE);
              //print_r($array);
              //print_r(array_keys($array));
              /*
              $keys = array_keys($array);
              echo $array[$keys[1]]."<- hello";*/
              // $source = '../database/events.xml';
              // $events = new SimpleXMLElement($source,null,true);
              // foreach($events as $event) {
              //   echo "Event: {$event['id']}: {$event->title} - {$event->location}\r\n";
              // }

	            foreach( $xml as $track ) { 
              	echo "<tr>";
              	echo "<td> 
              			<a href='music_delete.php?id=" .$track['id']. "'>
	              			<button class='btn btn-danger'> Delete </button> 
              			</a>
              		 </td>";
              	echo '<td>'.$track->track_name.'</td>'; 
              	echo '<td>'.$track->track_link.'</td>'; 
                echo "</tr>";
            	} 
          	}
          }catch(Exception $e ){
            echo $e->getMessage(); 
          }
        ?>
		</table>
	</body>
</html>