<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Admin - Delete Blogs</title>

    	<!-- Bootstrap -->
    	<link href="css/bootstrap.min.css" rel="stylesheet">
    	<script type="text/javascript">
	
		    if(confirm('Are you sure you want to delete this blog?')) {
          <?

          //Load XML from file (or it could come from a POST, etc.)
          $xml = simplexml_load_file('../database/blogs.xml');

          //Use XPath to find target node for removal
          $uniqueIdToDelete = $_GET['id'];
          $target = $xml->xpath("//blog[@id=$uniqueIdToDelete]");

          //If target does not exist (already deleted by someone/thing else), halt
          if(!$target)
          return; //Returns null

          //Import simpleXml reference into Dom & do removal (removal occurs in simpleXML object)
          $domRef = dom_import_simplexml($target[0]); //Select position 0 in XPath array
          $domRef->parentNode->removeChild($domRef);

          //Format XML to save indented tree rather than one line and save
          $dom = new DOMDocument('1.0');
          $dom->preserveWhiteSpace = false;
          $dom->formatOutput = true;
          $dom->loadXML($xml->asXML());
          $dom->save('../database/blogs.xml');
          ?>    
          window.location="http://jonnymazmusic.com/admin/blogs_view.php";
        }else {
          window.location="http://jonnymazmusic.com/admin/blogs_view.php";
        }
		</script>
	</head>
	<body>
	</body>
</html>