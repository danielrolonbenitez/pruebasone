
				<div class="row">
					<div class="col-sm-12">
					<div id="DataTables_Table_8_filter" class="dataTables_filter">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>Asistentes en Falta</h3>
							</div>
							<div class="box-content nopadding ">
								<table class="table table-hover table-responsive table-nomargin table-bordered usertable">
									<thead>
										<tr>
											<th>C&oacute;digo</th>
											<th>DNI</th>
											<th>Apellido y Nombre</th>
											<th>Email</th>
											<th>Celular</th>
											<th>Cargo</th>
											<th>Escuela</th>
											<th>D.E.</th>
											<th>Abstract</th>
											<th class='hidden-350'>Afiliado</th>
											<th class='hidden-480'>Pag&oacute;</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$status = array(0=>'NO','SI');
										$class = array(0=>'label-lightred','label-satgreen');
										
										foreach($registros as $registro){
										?>
										<tr>
											<td><?php echo $registro->id; ?></td>
											<td><?php echo number_format($registro->dni,0,',','.'); ?></td>
											<td class="capitalize"><?php echo '<span class="uppercase">'.$registro->last_name.'</span>, '.strtolower($registro->name); ?></td>
											<td><?php echo $registro->email; ?></td>
											<td><?php echo $registro->cellphone; ?></td>
											<td class="capitalize"><?php echo $registro->position; ?></td>
											<td class="uppercase"><?php echo $registro->school; ?></td>
											<td><?php echo $registro->district; ?></td>
											<td><?php 
											if($registro->abstract > 0){
												echo '<span class="label label-lightgrey">Eje '.$registro->abstract.'</span>'; 
											}else{
												echo '<span class="label label-lightred">NO</span>'; 
											}
											?></td>
											<td class='hidden-350'>
												<span class="label <?php echo $class[$registro->affiliate]; ?>"><?php echo $status[$registro->affiliate]; ?></span>
											</td>
											<td class='hidden-350'>
												<span class="label <?php echo $class[$registro->payment]; ?>"><?php echo $status[$registro->payment]; ?></span>
											</td>
											<td>
												<a href="javascript:borrar('<?php echo $registro->id; ?>')" class="btn" rel="tooltip" title="Eliminar">
													<i class="fa fa-times"></i>
												</a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			<script>
				function borrar(id){
					if(!confirm("Esta seguro que desea borrar el registro?. Esta accion NO se puede deshacer")){
						return false;
					}
					else {
						$.post('background.php',{id:id,op:'borrar_inscripcion'},function(data){
							if(data == 'borrado!'){
								alert("Registro borrado!");
								window.location.reload();
							}
							else {
								alert("No fue posible borrar el registro");
							}
						})
					}
				}
			</script>