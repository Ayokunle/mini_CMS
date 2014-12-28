<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Admin - Delete Events</title>

      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">

      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
      <link rel="stylesheet" href="/resources/demos/style.css">
      <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">

      <script>
        $(function() {
          $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:160,
            modal: true,
            buttons: {
              "Delete": function() {
              $( this ).dialog( "close" );
              <?
              //Load XML from file (or it could come from a POST, etc.)
              $xml = simplexml_load_file('../database/events.xml');

              //Use XPath to find target node for removal
              $uniqueIdToDelete = $_GET['id'];
              $target = $xml->xpath("//event[@id=$uniqueIdToDelete]");

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
              $dom->save('../database/events.xml');
              ?>    
            window.location="http://jonnymazmusic.com/admin/events_view.php";
          },
          Cancel: function() {
            $( this ).dialog( "close" );
            window.location="http://jonnymazmusic.com/admin/events_view.php";
          }
        }
      });
    });
  </script>

</head>
<body>
  <div id="dialog-confirm" title="Empty the recycle bin?">
    <p>
      <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;">
      </span>
      This item will be permanently deleted and cannot be recovered. Are you sure?
    </p>
  </div>
</body>

</html>