<html>
	<head> 
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Admin - View Blogs</title>

    	<!-- Bootstrap -->
    	<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
    <?
    echo "<a href='../admin/menu.php'><button style = 'margin-left:0.5cm;' class='btn btn-primary'>Menu</button> </a> ";
    ?>
    <?
    echo "<a href='../admin/blogs_new.php'><button style = 'margin-left:0.5cm;' class='btn btn-primary'>Add new Blog</button> </a> ";
    ?>
    
    <b> Delete not fully working so be careful!!! </b>
    
    <table class= 'table table-hover table-bordered'>
			<?
			echo "<tr>";
			echo '<th><b>Edit/Delete </b></th>';
            echo '<th><b>Blog Title </b></th>'; 
            echo '<th><b>Blog Text </b></th>';
            echo "</tr>";

			     $event_id = 0;
            try{
          	if( ! $xml = simplexml_load_file('../database/blogs.xml') ){ 
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

	            foreach( $xml as $event ) { 
              	echo "<tr>";
              	echo "<td> 
              			<a href='blogs_edit.php?id=" .$event['id']. "'>
	              			<button class='btn btn-primary'> Edit</button> 
              			</a>
              			<a href='blogs_delete.php?id=" .$event['id']. "'>
	              			<button class='btn btn-danger'> Delete </button> 
              			</a>
              		 </td>";
              	echo '<td>'.$event->title.'</td>'; 
              	echo '<td>'.$event->text.'</td>';
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