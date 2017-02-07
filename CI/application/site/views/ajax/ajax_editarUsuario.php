<!-- MAIN CONTENT -->
<div id="content">
	<div class="row">
		<!-- col -->
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			<h1 class="page-title txt-color-blueDark">
				<i class="fa-fw fa fa-home"></i> 
					Inicio 
				<span>>  
					Editar Usuario
				</span>
			</h1>
		</div>
		{GRAFICASRIBBON}
	</div>
	<section id="widget-grid" class="">
		<div class="row">
			<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="jarviswidget" id="wid-id-02222" data-widget-colorbutton="false"	data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" >
					<header>
						<span class="widget-icon"> <i class="fa fa-comments"></i> </span>
						<h2>Usuarios</h2>				
					</header>
					<div>
						<div class="jarviswidget-editbox">
							<input class="form-control" type="text">	
						</div>
						<div class="widget-body no-padding">
							<form id="smart-form-register" class="smart-form">
							<header>
								Edici&oacute;n de Usuario
							</header>

							<fieldset>
								<section>
									Ingrese Contraseña si desea cambiarla
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="password" placeholder="Contraseña" id="password" value="">
										<b class="tooltip tooltip-bottom-right">No olvides la contraseña!</b> </label>
								</section>

								<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="passwordConfirm" placeholder="Confirmar contraseña" value="">
										<b class="tooltip tooltip-bottom-right">No olvides la contraseña!</b> </label>
								</section>
							</fieldset>

							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input">
											<input type="text" name="firstname" placeholder="Nombre" value="<?php echo $firstname; ?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="input">
											<input type="text" name="lastname" placeholder="Apellido" value="<?php echo $lastname; ?>">
										</label>
									</section>
								</div>
							</fieldset>
							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input">
											<input type="text" name="company" placeholder="Compañia" value="<?php echo $company; ?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="input">
											<input type="text" name="phone" placeholder="Telefono" value="<?php echo $phone; ?>">
										</label>
									</section>
								</div>

							</fieldset>
							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input">
											<input type="email" name="email" placeholder="Correo Electronico" value="<?php echo $email; ?>">
										</label>
									</section>
								</div>

							</fieldset>							
							<fieldset>
								<div class="form-horizontal row">
									<div class="col-md-10" style="margin-left: 40px;">
										Grupos<br>
										<?php foreach ($groups as $group):?>
								              <?php
								                  $gID=$group['id'];
								                  $checked = null;
								                  $item = null;
								                  foreach($currentGroups as $grp) {
								                      if ($gID == $grp->id) {
								                          $checked= ' checked="checked"';
								                      break;
								                      }
								                  }
								              ?>
							              	<label class="checkbox-inline">
												<input type="checkbox" name="groups[]" class="checkbox style-3" value="<?php echo $group['id'];?>"<?php echo $checked;?>> 
												 <span><?php echo $group['name'];?></span>
											</label>

							          	<?php endforeach?>
					          		</div>
				          		</div>
							</fieldset>
                                                        <fieldset>
                                                                <div class="form-horizontal row">
                                                                        <div class="col-md-10" style="margin-left: 40px;">
                                                                                Perfiles<br>
                                                                                <label class="checkbox-inline">
                                                                                        <?php echo form_dropdown('perfil', $perfiles, $perfil_id, 'class="form-control"'); ?>
                                                                                </label>
                                                                </div>
                                                        </div>
                                                        </fieldset>

							<br><br>
							<!--
							<div class="form-group ">
								<label class="col-md-2 control-label">Inline</label>
								<div class="col-md-10">
									<label class="checkbox-inline">
										  <input type="checkbox" class="checkbox style-3">
										  <span>Checkbox 1</span>
									</label>
									<label class="checkbox-inline">
										  <input type="checkbox" class="checkbox style-3">
										  <span>Checkbox 2</span>
									</label>
									<label class="checkbox-inline">
										  <input type="checkbox" class="checkbox style-3">
										  <span>Checkbox 3</span>
									</label>
								</div>
							</div>
							-->
							<footer>
								
								<button type="button" class="btn btn-primary" onclick="save()">
									Editar usuario!
								</button>
								<button type="button" class="btn btn-secondary" onclick="cancelar()">
									Cancelar
								</button>
							</footer>
						</form>	

						</div>
					</div>
				</div>
			</article>
		</div>
	</section>
	<!-- end widget grid -->
</div>
<!-- END MAIN CONTENT -->
<script src="<?php echo base_url('assets/js/plugin/jquery-form/jquery-form.min.js'); ?>"></script>		
<script type="text/javascript">
	pageSetUp();
	var $registerForm = $("#smart-form-register").validate({
				onsubmit: false,
				// Rules for form validation
				rules : {
					username : {
						required : true
					},
					email : {
						required : true,
						email : true
					},
					password : {
						required : false,
						minlength : 3,
						maxlength : 20
					},
					passwordConfirm : {
						required : false,
						minlength : 3,
						maxlength : 20,
						equalTo : '#password'
					},
					firstname : {
						required : true
					},
					lastname : {
						required : true
					},
					company : {
						required : true
					},
					phone : {
						required : true
					}
				},
	
				// Messages for form validation
				messages : {
					email : {
						required : 'Por favor ingresa el e-mail',
						email : 'Por favor ingresa un e-mail válido'
					},
					password : {
						required : 'Por favor ingresa la contraseña'
					},
					passwordConfirm : {
						required : 'Por favor ingresa la contraseña una ves más',
						equalTo : 'Por favor ingresa la misma contraseña de arriba'
					},
					firstname : {
						required : 'Por favor ingresa el Nombre'
					},
					lastname : {
						required : 'Por favor ingresa el Apellido'
					},
					company : {
						required : 'Por favor ingresa la Compañia'
					},
					phone : {
						required : 'Por favor ingresa el Telefono'
					}
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
	
				var save = function() {
					var dataform = $('#smart-form-register').serialize();
					var url = "<?php echo base_url('dashboard/getAjax/editarUsuario')."/".$user_id; ?>";
					var return_url = "<?php echo base_url('dashboard/getAjax/usuarios'); ?>";
					if($("#smart-form-register").validate().form()){
						saveWebContent(url, dataform,return_url);
					}
				};
				var cancelar = function() {
					var return_url = "<?php echo base_url('dashboard/getAjax/usuarios'); ?>";
					loadURL(return_url,$('#content'));
				}


</script>
<div id="infoMessage"><?php echo $message;?></div>

