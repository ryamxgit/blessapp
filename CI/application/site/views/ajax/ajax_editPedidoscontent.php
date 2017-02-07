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
					<h2>Editor de Contenido</h2>
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

						<form class="form-horizontal">		
							<fieldset>
								<legend>Detalles</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Nombre</label>
									<div class="col-md-10">
										<input class="form-control" disabled="disabled" placeholder="Seleccione el nombre" id="input_nombre" type="text" value="<?php echo $nombre; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Correo</label>
									<div class="col-md-10">
										<input class="form-control" disabled="disabled" placeholder="Imagen a mostrar" id="input_imagen1" type="text" value="<?php echo $correo; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Teléfono</label>
									<div class="col-md-10">
										<input class="form-control" disabled="disabled" placeholder="Link del video" id="input_video1" type="text" value="<?php echo $telefono; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Dirección</label>
									<div class="col-md-10">
										<input class="form-control" disabled="disabled" placeholder="valor del item" id="input_valor1" type="text" value="<?php echo $direccion; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Precio</label>
									<div class="col-md-10">
										<input class="form-control" disabled="disabled" placeholder="valor del item" id="input_valor1" type="text" value="<?php echo $precio; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo</label>
									<div class="col-md-10">
										<input class="form-control" disabled="disabled" placeholder="valor del item" id="input_valor1" type="text" value="<?php echo $tipo; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Cantidad</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="valor del item" id="cantidad" type="number" value="<?php echo $cantidad; ?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label" for="select-1">Estado</label>
									<div class="col-md-10">
										<select class="form-control" id="select_estado">
											<?php echo $estados; ?> 
										</select> 
									<!-- <p class="note"><strong>Nota:</strong> elegir una categor&iacute;a es oblicatorio.</p> -->
									</div>
								</div>
							</fieldset>
						</form>
					<fieldset>
						<legend>Comentario</legend>
						<div class="summernote">
							<? echo $data; ?>
						</div>
					</fieldset>
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
					<!-- new widget -->
						<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false" data-widget-fullscreenbutton="false">
							<header>
								<span class="widget-icon"> <i class="fa fa-comments txt-color-white"></i> </span>
								<h2> Historial de la venta </h2>
							</header>
							<div>
								<div class="widget-body widget-hide-overflow no-padding">
									<!-- CHAT BODY -->
									<div id="chat-body" class="chat-body custom-scroll">
										<ul>
											{mensaje}
											<li class="message">
												<!-- <img src="{base_url}assets/img/avatars/5.png" class="online" alt=""> -->
												<i class="fa fa-user fa-3x"></i> 
												<div class="message-text">
													<time>{fecha_ing}</time> 
													<a href="javascript:void(0);" class="username">{username}</a> {log}
												</div>
											</li>
											{/mensaje}
										</ul>
									</div>
								</div>
							</div>
						</div>
					<!-- end widget div -->
				</div>
<INPUT type='hidden' id='id' value='<? echo $id; ?>'> 
</article>
<!-- PAGE RELATED PLUGIN(S) -->
		<script src="<?php echo base_url('assets/js/plugin/summernote/summernote.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/markdown/markdown.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/markdown/to-markdown.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/markdown/bootstrap-markdown.min.js'); ?>"></script>
		

		<script type="text/javascript">

				var save = function() {
					var aHTML = $('.summernote').code(); //save HTML If you need(aHTML: array).
					var dataform = 'data='+aHTML.trim() + '&cantidad=' + $('#cantidad').val() + '&estado=' + $('#select_estado :selected').val();
					console.log(dataform);
					var url = "<?php echo base_url('dashboard/getAjax/saveEditedPedidoscontent') .'/'. $id ; ?>";
					var return_url = "<?php echo base_url('dashboard/getAjax/pedidos'); ?>";
					saveWebContent(url, dataform,return_url); 
				};
				var cancelar = function() {
					var return_url = "<?php echo base_url('dashboard/getAjax/pedidos'); ?>";
					loadURL(return_url,$('#content'));
				}

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
