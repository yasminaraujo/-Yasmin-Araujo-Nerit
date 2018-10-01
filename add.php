<?php
		include("head.html");

		if(isset($_POST['send'])) {
				$people = simplexml_load_file('Database/database.xml');
        $id = $_GET['i'];
				$name = $_POST['name'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$address = $_POST['address'];

				$person = $people->addChild('person');
        
        $person->ID = $id;
				$person->addChild('name', $name);
				$person->addChild('email', $email);
				$person->addChild('phone',$phone);
				$person->addChild('address',$address);

        if(isset($_POST['tag1'])){
          $person->addChild('tag1', 'CEO');
        }
        if(isset($_POST['tag2'])){
          $person->addChild('tag2', "Management");
        }
        if(isset($_POST['tag3'])){
          $person->addChild('tag1', 'Developer'); 
        }

				$bd = file_put_contents('Database/database.xml' , $people->asXML());

        if($bd == 1){
        echo '<script>
          alert("Erro.Não adicionado");
          window.location.replace("index.php");
          </script>';
        }
        else{
          echo '<script>
            alert("Adicionado com sucesso");
            window.location.replace("index.php");
          </script>';
        }
		}
?>
<center>
<form method="POST">
		<div class="form-group col-md-6">
				<label for="exampleInputPassword1">Nome</label>
				<input type="name" class="form-control" id="name" name="name"placeholder="Nome Completo">
		</div>
    <div class="form-group col-md-6">
				<label for="exampleInputEmail1">Email</label>
				<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="E-mail">
		</div>
		<div class="form-group col-md-6">
				<label for="exampleInputPassword1">Endereço</label>
				<input type="address" class="form-control" id="address" name="address"placeholder="Endereço">
		</div>
		<div class="form-group col-md-6">
				<label for="exampleInputPassword1">Telefone</label>
				<input type="phone" class="form-control" id="phone" name="phone" placeholder="(xx) 9 xxxx - xxxx">
		</div>

		<div class="form-check form-check-inline">
				<input type="checkbox" class="form-check-input" id="exampleCheck1" name="tag1">
				<label class="form-check-label" for="exampleCheck1">CEO</label>
		</div>
		<div class="form-check form-check-inline ">
				<input type="checkbox" class="form-check-input" id="exampleCheck1" name="tag2">
				<label class="form-check-label" for="exampleCheck1">Management</label>
		</div>
		<div class="form-check form-check-inline">
				<input type="checkbox" class="form-check-input" id="exampleCheck1" name="tag3">
				<label class="form-check-label" for="exampleCheck1" >Developer</label>
		</div>
		<button type="submit" class="btn btn-dark" name="send" >Enviar</button>   
</form>
</center>
