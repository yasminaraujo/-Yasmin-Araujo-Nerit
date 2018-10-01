<div class="container">
		<input class="form-control" id="myInput" type="text" placeholder="Search..">
		<br>
		
		<table class= "table table-dark">
				
				<thead>
						<th scope="col">Nome</th>
						<th scope="col">Email</th>
						<th scope="col">Tags</th>
				</thead>
				
				<tbody id="myTable">
						<?php 

						$people = simplexml_load_file('Database/database.xml'); //acesso aos dados
            $i = 0;
            //Imprime os dados em lista
						foreach($people as $people) { 
              $i = $i + 1;// contador para ID
              ?>
						<tr>
								<td><?php echo $people->name; ?></td>
								<td><?php echo $people->email; ?></td>
								<td>
										<span class="badge badge-pill badge-dark"> <?php echo $people->tag1; ?> </span>
										<span class="badge badge-pill badge-dark"> <?php echo $people->tag2; ?> </span>
										<span class="badge badge-pill badge-dark"> <?php echo $people->tag3; ?> </span>
								</td>

								<td>
										<button type="button" class="btn btn-dark"> 
										<a href="edit.php?id=<?php echo $people->ID; ?>">Editar</button></a> 
										<button type="button" class="btn btn-dark"><a href = "delete.php?id=<?php echo $people->ID; ?>" > Excluir</a></button>
										<button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="right" 
										data-content="
										<?php 
										echo "Endereço:"; 
										echo $people->address; 
										echo " |Telefone:";
										echo $people->phone;
										?>"> 
										Expandir</button>
								</td>
						</tr>
						<?php } ?>
				</tbody>
		</table>


		<script>
    //Script popover do botão Expandir
				$(function () {
						$('[data-toggle="popover"]').popover()
				})

				$(document).ready(function(){
								$("#myInput").on("keyup", function() {
								var value = $(this).val().toLowerCase();
										$("#myTable tr").filter(function() {
										$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
								});
						});
				});
		</script>
</div>

