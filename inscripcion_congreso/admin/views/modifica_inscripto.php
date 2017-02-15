
				<div class="page-header">
					<div class="pull-left">
						<h1>Inscriptos</h1>
					</div>
				</div>
			<div class="row">
					<div class="col-sm-12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="fa fa-edit"></i>Modificar</h3>
							</div>
							<div class="box-content">
								<form action="Cpanel.php?op=2" method="POST" class='form-horizontal'>
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Apellido</label>
										<div class="col-sm-10">
											<input type="text" name="last_name" id="textfield" class="form-control" value="<?php echo $registro->last_name; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="control-label col-sm-2">Nombre</label>
										<div class="col-sm-10">
											<input type="text" name="name" id="textfield" class="form-control" value="<?php echo $registro->name; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">DNI</label>
										<div class="col-sm-10">
											<input type="text" name="dni" id="textfield" class="form-control" value="<?php echo number_format($registro->dni,0,',','.'); ?>">
										</div>
									</div>
								<div class="form-group">
										<label for="email" class="control-label col-sm-2">Correo electrónico</label>
										<div class="col-sm-10">
											<div class="input-group">
												<span class="input-group-addon">@</span>
												<input type="text" placeholder="Correo electrónico" class='form-control' name="email" value="<?php echo $registro->email; ?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Celular</label>
										<div class="col-sm-10">
											<input type="text" name="cellphone" id="textfield" class="form-control" value="<?php echo $registro->cellphone; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="control-label col-sm-2">Teléfono</label>
										<div class="col-sm-10">
											<input type="text" name="phone" id="textfield" class="form-control" value="<?php echo $registro->phone; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="control-label col-sm-2">Cargo</label>
										<div class="col-sm-10">
											<select name="position" id="position">
												<?php
												$cargos = array('Maestro/a de Sección','Maestro/a Celador/a','Maestro/a de Grado','Maestro/a Bibliotecario/a','Profesor/a','Director/a','Vicedirector/a','Maestra/o Secretaria/o','Supervisor/a','Otro');
												foreach($cargos as $cargo){
												?>
												<option value="<?php echo $cargo; ?>"<?php if($cargo == $registro->position) echo ' selected="selected"'; ?>><?php echo $cargo; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="textfield" class="control-label col-sm-2">Escuela</label>
										<div class="col-sm-10">
											<input type="text" name="school" id="textfield" class="form-control" value="<?php echo $registro->school; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="control-label col-sm-2">Distrito Escolar</label>
										<div class="col-sm-10">
											<input type="number" name="district" id="district" min="1" max="21" oninvalid="this.setCustomValidity('El D.E. debe ser inferior o igual a 21')" oninput="setCustomValidity('')" required value="<?php echo $registro->district; ?>" class="form-control" />
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="control-label col-sm-2">Área</label>
										<div class="col-sm-10">
											<select name="area" id="area">
												<?php
												$areas = array('Inicial','Primaria','Curricular','Media','Artística','Especial','Adultos','Normales','Socio-Educativa');
												foreach($areas as $area){
												?>
												<option value="<?php echo $area; ?>"<?php if($area == $registro->area) echo ' selected="selected"'; ?>><?php echo $area; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="control-label col-sm-2">Abstract</label>
										<div class="col-sm-10">
											<select name="abstract" id="abstract">
												<?php
												$abstracts = array(1=>'Eje 1');
												foreach($abstracts as $key => $value){
													$selected = '';
													if($key == $registro->abstract) $selected = ' selected="selected"';
													echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
												} ?>
											</select>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-2">Afiliado</label>
										<div class="col-sm-10">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="affiliate" value="1"<?php if($registro->affiliate==1) echo ' checked="checked"'; ?>>
												</label>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-sm-2">Pagó</label>
										<div class="col-sm-10">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="payment" value="1"<?php if($registro->payment==1) echo ' checked="checked"'; ?>>
												</label>
											</div>
										</div>
									</div>
									
									<div class="form-actions">
										<input type="hidden" name="id" value="<?php echo $registro->id; ?>" />
										<button type="submit" class="btn btn-primary">Guardar</button>
										<a href="index.php?a=inscriptos" class="btn">Cancelar</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>