<div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> Pedidos Web</span></h1>
        </div>
        {GRAFICASRIBBON}
</div>
	<article class="col-sm-12 col-md-12 col-lg-12">
			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blue" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="false">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
					<h2>Crear nuevo Contenido</h2>
				</header>
				<!-- widget div-->
				<div>
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
					</div>
					<!-- end widget edit box -->
	<!-- widget content -->
					<div class="widget-body">

						<form id="smart-form-register" class="form-horizontal">	
							<fieldset>
								<legend>Detalles</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Nombre</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Ingrese el nombre del solicitante" id="nombre" name="nombre" type="text" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Correo</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Correo Electrónico" id="correo" name="correo" type="email" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Teléfono</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Número de Teléfono" id="telefono" name="telefono" type="text" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Dirección</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Dirección" id="direccion" name="direccion" type="text" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Precio</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Precio del Producto" id="precio" name="precio" type="text" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Tipo de Producto" id="tipo" name="tipo" type="text" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Cantidad</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Cantidad" id="cantidad" name="cantidad" type="number" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="select-1">Estado</label>
									<div class="col-md-10">
											<?php echo form_dropdown('estado',$estados,'1'); ?>
									</div>
								</div>
							</fieldset>
						</form>
					<!-- INGRESO DE COMENTARIOS 
					<fieldset>
						<legend>Comentario</legend>
						<div class="summernote">
						</div>
					</fieldset>
					-->
						<div class="widget-footer smart-form">
							<div class="btn-group">
								<button class="btn btn-sm btn-primary" type="button" onclick="cancelar()">
									<i class="fa fa-times"></i> Cancelar
								</button>	
							</div>
							<div class="btn-group">
								<button class="btn btn-sm btn-success" type="button" data-loading-text="Guardando..." onclick="save()">
									<i class="fa fa-check"></i> Guardar
								</button>	
							</div>
						</div>
					</div>
					<!-- end widget content -->
				</div>
</article>
<div id="infoMessage"><?php echo $message;?></div>
<!-- PAGE RELATED PLUGIN(S) -->
		<script src="<?php echo base_url('assets/js/plugin/summernote/summernote.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/markdown/markdown.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/markdown/to-markdown.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/markdown/bootstrap-markdown.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/plugin/jquery-form/jquery-form.min.js'); ?>"></script>		
<script type="text/javascript">
	pageSetUp();
	var $registerForm = $("#smart-form-register").validate({
				onsubmit: false,
				// Rules for form validation
				rules : {
					nombre : {
						required : true
					},
					correo : {
						required : true,
						email : true
					},
					telefono : {
						required : true,
						number : true
					},
					direccion : {
						required : true
					},
					precio : {
						required : true,
						number : true
					},
					tipo : {
						required : true
					},
					cantidad : {
						required : true,
						number : true,
						min : 1
					}
				},
	
				// Messages for form validation
				messages : {
					nombre : {
						required : 'Por favor ingrese el Nombre'
					},
					correo : {
						required : 'Por favor ingrese el Correo Electrónico',
						email : 'Por favor ingrese un Correo Electrónico Válido'
					},
					telefono : {
						required : 'Por favor ingrese el Teléfono',
						number : 'Ingrese sólo números en el Teléfono'
					},
					direccion : {
						required : 'Por favor ingrese la Dirección'
					},
					precio : {
						required : 'Por favor ingrese el Precio',
						number : 'Por favor ingrese sólo números en el Precio'
					},
					tipo : {
						required : 'Por favor ingrese el Tipo'
					},
					cantidad : {
						required : 'Por favor ingrese la Cantidad',
						number : 'Por favor ingrese sólo números en la Cantidad',
						min : 'La Cantidad debe ser mayor que Cero'
					}
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
	
				var save = function() {
					var dataform = $('#smart-form-register').serialize();
					var url = "<?php echo base_url('dashboard/getAjax/crearPedido'); ?>";
					var return_url = "<?php echo base_url('dashboard/getAjax/perfilCambio'); ?>";
					if($("#smart-form-register").validate().form()){
						saveWebContent(url, dataform,return_url);
					}
				};
				var cancelar = function() {
					var return_url = "<?php echo base_url('dashboard/getAjax/perfilCambio/'); ?>";
					loadURL(return_url,$('#content'));
				}


</script>		
<!-- 
		<script type="text/javascript">
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			
			$(document).ready(function() {
				
				pageSetUp();

				/*
				 * SUMMERNOTE EDITOR
				 */
				
				$('.summernote').summernote({
					height : 180,
					focus : false,
					tabsize : 2
				});
			
				/*
				 * MARKDOWN EDITOR
				 */

				$("#mymarkdown").markdown({
					autofocus:false,
					savable:true
				})
				

			
			})

		</script>
-->