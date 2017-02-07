	<article class="col-sm-12 col-md-12 col-lg-12">
	<!-- widget content -->
					<div class="widget-body">

						<form id="smart-form-register" class="form-horizontal">
							<fieldset>
								<legend>Datos de Producto Encontrado</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Folio</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Folio" id="folio" name="folio" type="text" value="{folio}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Nombre de Kit</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Nombre Kit" id="nombre_kit" name="nombre_kit" type="text" value="{nombre_kit}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo de Producto</label>
									<div class="col-md-5">
										<div>
										<?php
										$datos = array(
														"" 				=> " - Sin Informaci&oacute;n - ",
														"electronica"	=> "Electr&oacute;nica",
														"telefonia"		=> "Telefon&iacute;a",
														"linea_blanca"	=> "Linea Blanca",
														"otros"			=> "Otros"
												);
										echo form_dropdown("tipo_producto",$datos,$tipo_producto,' class="form-control" onChange="if (this.value == \'otros\'){$(\'#otraDescripcion\').show(\'slow\');}else{$(\'#otraDescripcion\').hide(\'slow\');}" disabled="disabled"')
										?>
										</div>
									</div>
								</div>
								<?php if ($otro_tipo_producto != '') { ?>
								<div class="form-group" id="otraDescripcion">
									<label class="col-md-2 control-label">Detalle del 'Otro' Tipo de Producto</label>
									<div class="col-md-5">										
										<div>
											<input class="form-control" placeholder=" - Sin Informaci&oacute;n - " id="otro_producto" name="otro_producto" type="text" value="{otro_tipo_producto}" disabled="disabled" />
										</div>
									</div>
								</div>
								<?php } ?>
								<div class="form-group">
									<label class="col-md-2 control-label">Descripci&oacute;n del Producto</label>
									<div class="col-md-10">
										<div>
										<textarea class="form-control" placeholder=" - Sin Informaci&oacute;n - " id="descripcion" name="descripcion" disabled="disabled">{descripcion}</textarea>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Modelo</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder=" - Sin Informaci&oacute;n - " id="modelo" name="modelo" type="text" value="{modelo}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Serie del Fabricante</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder=" - Sin Informaci&oacute;n - " id="serie" name="serie" type="text" value="{serie}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Color</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder=" - Sin Informaci&oacute;n - " id="color" name="color" type="text" value="{color}" disabled="disabled" />
										</div>
									</div>
								</div>
							</fieldset>
						<?php if ($rut != '') { ?>	
							<fieldset>
								<legend>Datos de Cliente</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">RUT</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder=" - Sin Informaci&oacute;n - " id="rut" name="rut" type="text" value="{rut}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Nombre</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder=" - Sin Informaci&oacute;n - " id="nombre" name="nombre" type="text" value="{nombre_cliente}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Email</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder=" - Sin Informaci&oacute;n - " id="email" name="email" type="text" value="{email}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tel&eacute;fono</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder=" - Sin Informaci&oacute;n - " id="telefono" name="telefono" type="text" value="{telefono}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Direcci&oacute;n</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder=" - Sin Informaci&oacute;n - " id="direccion" name="direccion" type="text" value="{direccion}" disabled="disabled" />
										</div>
									</div>
								</div>
							</fieldset>
						<?php } 
						else {?>
							<fieldset>
								<legend>Datos de Cliente</legend>
								No existe informaci&oacute;n de Clientes asociados a este producto.
							</fieldset>
						<?php } ?>
						</form>
					</div>
</article>
<script src="<?php echo base_url('assets/js/plugin/jquery-form/jquery-form.min.js'); ?>"></script>