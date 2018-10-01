<?php
	include("head.html");

	$people = simplexml_load_file('Database/database.xml');
	$id = $_GET['id'];

	if(isset($_POST['submitSave'])) {

		$cont =0;

		foreach($people->person as $person) {
			if ($person->ID == $id) {
				break;
			}
			$cont = $cont + 1;
		}

		$editperson = $people->person[$cont];

		//Deixa os checkboxes marcados nas tags referentes ao usuário
		if(isset($_POST['tag1'])){
        	$editperson->tag1 = 'CEO';
        }
        else{
        	$editperson->tag1 ='';
        }
        if(isset($_POST['tag2'])){
        	$editperson->tag2 = 'Management';
        }
        else{
        	$editperson->tag2='';
        }
        if(isset($_POST['tag3'])){
        	$editperson->tag3 = 'Developer';
        }
        else{
        	$editperson->tag3='';
        }

		$editperson->name = $_POST['name'];
		$editperson->email = $_POST['email'];
		$editperson->phone = $_POST['phone'];
		$editperson->address = $_POST['address'];

		$bd = file_put_contents('Database/database.xml' , $people->asXML());

		if($bd == 1){
			echo '<script>
				alert("Erro.Edição não realizada.");
				window.location.replace("index.php");
			</script>';
		}
		else{
			echo '<script>
				alert("Alteração feita com sucesso");
				window.location.replace("index.php");
			</script>';
		}

	}

	foreach ($people->person as $person){
		if($person->ID == $id){
			$name = $person->name;
			$email = $person->email;
			$phone = $person->phone;
			$address = $person->address;
			$tag1 = $person->tag1;
			$tag2 = $person->tag2;
			$tag3 = $person->tag3;
		}
	}


?>
<center>
	<form method="POST">
		<div class="form-group">
			<div class="form-group col-md-6">
				<label>Nome</label>
				<input type="text" class="form-control" id="name"name="name" value="<?php echo $name?>">
			</div>
		<div class="form-group col-md-6">
			<label>Email</label>
			<input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?php echo $email?>">
		</div>
		<div class="form-group col-md-6">
			<label>Endereço</label>
			<input type="text" class="form-control" id="address" name="address" value="<?php echo $address?>">
		</div>
		<div class="form-group col-md-6">
			<label>Telefone</label>
			<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone?>">
		</div>
		<div class="form-check form-check-inline">
			<input type="checkbox" class="form-check-input" id="exampleCheck1" name="tag1" <?php echo ($tag1=='' ? '' : 'checked');?> >
			<label class="form-check-label">CEO</label>
		</div>
		<div class="form-check form-check-inline ">
			<input type="checkbox" class="form-check-input" id="exampleCheck1" name="tag2" <?php echo ($tag2=='' ? '' : 'checked');?> >
			<label class="form-check-label">Management</label>
		</div>
		<div class="form-check form-check-inline">
			<input type="checkbox" class="form-check-input" id="exampleCheck1" name="tag3"<?php echo ($tag3=='' ? '' : 'checked');?>>
			<label class="form-check-label">Developer</label>
		</div>
		
		<button type="submit" value="Save" class="btn btn-dark" name="submitSave" data-toggle="modal" data-target="#exampleModal">Enviar</button>
</center>
