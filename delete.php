<?php
	include("head.html");

	$people = simplexml_load_file('Database/database.xml');

	$id =$_GET['id'];
	$cont =0;

	foreach($people->person as $person) {
		if ($person->ID == $id) {
			break;
		}
		$cont = $cont + 1;
	}

	unset ($people->person[$cont]);
	$bd = file_put_contents('Database/database.xml' , $people->asXML());

		if($bd == 1){
			echo '<script>
				alert("Erro.Exclusão não realizada.");
				window.location.replace("index.php");
			</script>';
		}
		else{
			echo '<script>
				alert("Exclusão feita com sucesso");
				window.location.replace("index.php");
			</script>';
		}
	
?>
