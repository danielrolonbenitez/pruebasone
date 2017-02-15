
				<div class="row">
							<div class="box-title">
								<h3>Abstract</h3>
							</div>
							<div class="box-content nopadding">
							
							<form action="index.php?a=l&t=usuarios" method="GET" class='form-horizontal'>
								<label>
								<span>Buscar por:</span>
								<select name="criterio">
									<option value="id"<?php if(isset($_GET['criterio']) && $_GET['criterio'] == 'id') echo ' selected'; ?>>Código</option>
									<option value="dni"<?php if(isset($_GET['criterio']) && $_GET['criterio'] == 'dni') echo ' selected'; ?>>DNI</option>
									<option value="name"<?php if(isset($_GET['criterio']) && $_GET['criterio'] == 'name') echo ' selected'; ?>>Nombre</option>
									<option value="last_name"<?php if(isset($_GET['criterio']) && $_GET['criterio'] == 'last_name') echo ' selected'; ?>>Apellido</option>
								</select>
								<input type="text" name="search" aria-controls="DataTables_Table_8" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>" >
								<input type="hidden" name="t" value="abstract" >
								<button type="submit" class="btn btn-primary">BUSCAR</button>
								</label>
							</form>
							
							</div>
					
					<form action="Cpanel.php?op=1" method="post">
					<div id="DataTables_Table_8_filter" class="dataTables_filter">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>Resultados</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered usertable">
									<thead>
										<tr>
											<th>Código</th>
											<th>DNI</th>
											<th>Apellido y Nombre</th>
											<th>Email</th>
											<th>Celular</th>
											<th>Cargo</th>
											<th>Escuela</th>
											<th>D.E.</th>
											<th>Abstract</th>
											<th class='hidden-350'>Afiliado</th>
											<th class='hidden-480'>Pagó</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$status = array(0=>'No','Si');
										$class = array(0=>'label-lightred','label-satgreen');
										
										//$abstracts = array(0=>'Seleccione..','Eje 1','Eje 2','Eje 3');
										 $abstracts = array(0 =>'Seleccione', 1=>'Eje 1');

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
											<td>
											<select name="datos[<?php echo $registro->id; ?>][abstract]">
											<?php 
											foreach($abstracts as $key => $value){


												$selected = '';
												if($key == $registro->abstract) $selected = ' selected="selected"';
												echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
											}
											?>
											</select>
											</td>
											<td class='hidden-350'>
													<select name="datos[<?php echo $registro->id; ?>][affiliate]">
													<?php 
													foreach($status as $key => $value){
														$selected = '';
														if($key == $registro->affiliate) $selected = ' selected="selected"';
														echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
													}
													?>
													</select>
											</td>
											<td class='hidden-350'>
													<select name="datos[<?php echo $registro->id; ?>][payment]">
													<?php 
													foreach($status as $key => $value){
														$selected = '';
														if($key == $registro->payment) $selected = ' selected="selected"';
														echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
													}
													?>
													</select>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<div class="submit" align="right">
					<button type="submit" value="GUARDAR CAMBIOS">GUARDAR CAMBIOS</button>
				</div>
					</form>
				</div>