<!-- MAIN CONTENT -->
<div id="content">
	<div class="row">
		<!-- col -->
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			<h1 class="page-title txt-color-blueDark">
				<i class="fa-fw fa fa-home"></i> 
					Inicio 
				<span>>  
					Usuarios
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
								Registro de Nuevo Usuario
							</header>

							<fieldset>
								<section>
									<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
										<input type="email" name="email" placeholder="Correo Electronico">
										<b class="tooltip tooltip-bottom-right">Necesario para ingresar al sitio</b> </label>
								</section>

								<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="password" placeholder="Contraseña" id="password">
										<b class="tooltip tooltip-bottom-right">No olvides la contraseña!</b> </label>
								</section>

								<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="passwordConfirm" placeholder="Confirmar contraseña">
										<b class="tooltip tooltip-bottom-right">No olvides la contraseña!</b> </label>
								</section>
							</fieldset>

							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input">
											<input type="text" name="firstname" placeholder="Nombre">
										</label>
									</section>
									<section class="col col-6">
										<label class="input">
											<input type="text" name="lastname" placeholder="Apellido">
										</label>
									</section>
								</div>
							</fieldset>
							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input">
											<input type="text" name="company" placeholder="Compañia">
										</label>
									</section>
									<section class="col col-6">
										<label class="input">
											<input type="text" name="phone" placeholder="Telefono">
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
                                                                              ?>
                                                                        <label class="checkbox-inline">
                                                                                                <input type="checkbox" name="groups[]" class="checkbox style-3" value="<?php echo $group['id'];?>">  
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
											<?php echo form_dropdown('perfil', $perfiles, '0', 'class="form-control"'); ?>
										</label>
                                                                </div>
                                                        </div>
                                                        </fieldset>
							<footer>
								
								<button type="button" class="btn btn-primary" onclick="save()">
									Crear el usuario!
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
						required : true,
						minlength : 3,
						maxlength : 20
					},
					passwordConfirm : {
						required : true,
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
					var url = "<?php echo base_url('dashboard/getAjax/crearUsuario'); ?>";
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

