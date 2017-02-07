<!-- MAIN CONTENT -->
<div id="content">
	<div class="row">
		<!-- col -->
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			<h1 class="page-title txt-color-blueDark">
				<i class="fa-fw fa fa-home"></i> 
					Inicio 
				<span>>  
					Perfiles
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
						<h2>Perfiles</h2>				
					</header>
					<div>
						<div class="jarviswidget-editbox">
							<input class="form-control" type="text">	
						</div>
						<div class="widget-body no-padding">
							<form id="smart-form-register" class="smart-form">
							<header>
								Registro de Nuevo Perfil
							</header>

							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input">
											<input type="text" name="name" placeholder="Nombre">
										</label>
									</section>
									<section class="col col-6">
										<label class="input">
											<input type="text" name="description" placeholder="Descripción">
										</label>
									</section>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-horizontal row">
									<div class="col-md-10" style="margin-left: 40px;">
											Acci&oacute;n asociada al Nuevo Perfil:
										<label class="checkbox-inline">
											<?php echo form_dropdown('accion', $acciones, 0);?>              
										</label>
									</div>
								</div>
							</fieldset>
							<footer>
								
								<button type="button" class="btn btn-primary" onclick="save()">
									Crear el perfil!
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
					name : {
						required : true
					},
					description : {
						required : true
					},
					'estados[]' : {
						required : true
					}
				},
	
				// Messages for form validation
				messages : {
					name : {
						required : 'Por favor ingresa el Nombre'
					},
					description : {
						required : 'Por favor ingresa una Descripcion'
					},
					'estados[]' : {
						required : 'Por favor elija al menos un estado'
					}
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
	
				var save = function() {
					var dataform = $('#smart-form-register').serialize();
					var url = "<?php echo base_url('dashboard/getAjax/crearPerfil'); ?>";
					var return_url = "<?php echo base_url('dashboard/getAjax/perfiles'); ?>";
					if($("#smart-form-register").validate().form()){
						saveWebContent(url, dataform,return_url);
					}
				};
				var cancelar = function() {
					var return_url = "<?php echo base_url('dashboard/getAjax/perfiles'); ?>";
					loadURL(return_url,$('#content'));
				}

</script>
<div id="infoMessage"><?php echo $message;?></div>

