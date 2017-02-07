<div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> Contenido Web</span></h1>
        </div>
        {GRAFICASRIBBON}
</div>
<div class="row">
	<article class="col-sm-12 col-md-12 col-lg-12">	
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blue" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-fullscreenbutton="false" data-widget-sortable="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-pencil"></i> </span>
					<h2>Editor de Contenido</h2>
				</header>
				<!-- widget div-->
				<div>
					<!-- widget edit box -->
					<div class="jarviswidget-editbox"></div>
					<!-- end widget edit box -->
					<!-- widget content -->
					<div class="widget-body">

						<form class="form-horizontal">		
							<fieldset>
								<legend>Elementos</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Nombre</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Seleccione el nombre" id="input_nombre" type="text" value="<? echo $nombre; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-2 control-label" for="select-1">Categor&iacute;a</label>
									<div class="col-md-10">
										<select class="form-control" id="select_categoria">
											<? echo $categorias; ?> 
										</select> 
									<p class="note"><strong>Nota:</strong> elegir una categor&iacute;a es oblicatorio.</p>
									</div>
								</div>
								<div id="ginput_imagen1" class="form-group" }>
									<label class="col-md-2 control-label">Imagen</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Imagen a mostrar" id="input_imagen1" type="text" value="<? echo $imagen1; ?>">
									</div>
								</div>
								<div id="ginput_video1" class="form-group" }>
									<label class="col-md-2 control-label">Link video YouTube</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Link del video" id="input_video1" type="text" value="<? echo $video1; ?>">
									</div>
								</div>
								<div id="ginput_valor1" class="form-group" }>
									<label class="col-md-2 control-label">Valor</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="valor del item" id="input_valor1" type="text" value="<? echo $valor1; ?>">
									</div>
								</div>
								<div id="glink_descarga" class="form-group" }>
									<label class="col-md-2 control-label">Link Descarga</label>
									<div class="col-md-10">
										<textarea class="form-control" placeholder="" id="link_descarga" type="text">
											<? echo $link_descarga; ?>
										</textarea>
										<!-- <input class="form-control" placeholder="" id="link_descarga" type="text" value="<? echo $link_descarga; ?>"> -->
									</div>
								</div>
								<div id="gcontenido" class="form-group">
									<label class="col-md-2 control-label">Contenido</label>
									<div class="col-md-10">
										<div class="summernote"><? echo $data; ?></div>
									</div>
								</div>
								

							</fieldset>
						</form>

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
</div>
<!-- PAGE RELATED PLUGIN(S) -->
		<script src="<?php echo base_url('assets/js/plugin/summernote/summernote.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/markdown/markdown.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/markdown/to-markdown.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/markdown/bootstrap-markdown.min.js'); ?>"></script>
		

		<script type="text/javascript">

				var save = function() {
					var aHTML = $('.summernote').code(); //save HTML If you need(aHTML: array).
					var dataform = 'data='+aHTML.trim() + '&nombre=' + $('#input_nombre').val() + '&categoria=' + $('#select_categoria :selected').val() + '&imagen1='+ $('#input_imagen1').val() + '&video1='+ $('#input_video1').val()  + '&valor1='+ $('#input_valor1').val() + '&link_descarga='+ encodeURIComponent($('#link_descarga').val());
					console.log(dataform);
					var url = "<?php echo base_url('dashboard/getAjax/saveEditedWebcontent') .'/'. $id ; ?>";
					var return_url = "<?php echo base_url('dashboard/getAjax/web'); ?>";
					saveWebContent(url, dataform,return_url); 
				};
				var cancelar = function() {
					var return_url = "<?php echo base_url('dashboard/getAjax/web'); ?>";
					loadURL(return_url,$('#content'));
				}
				function showhidefields(id){
					if (id == 1) { // Slides
				  		$("#ginput_valor1").fadeOut();
				  		$("#ginput_video1").fadeOut();
				  		$("#ginput_imagen1").fadeOut();
				  		$("#glink_descarga").fadeOut();
				  	};
				  	if (id == 5) { // productos
				  		$("#ginput_valor1").fadeOut();
				  		$("#ginput_video1").fadeIn();
				  		$("#ginput_imagen1").fadeIn();
				  		$("#glink_descarga").fadeIn();
				  	};
				  	if (id == 2 || id == 4 || id == 6 || id == 7 || id == 9) { // Footer, Redes sociales, Contacto, Contenido, menu normal, menu amarillo, 
				  		$("#ginput_valor1").fadeOut();
				  		$("#ginput_video1").fadeOut();
				  		$("#ginput_imagen1").fadeOut();
				  		$("#glink_descarga").fadeOut();
				  	};
				  	if (id == 3) { // Tienda
				  		$("#ginput_valor1").fadeIn();
				  		$("#ginput_video1").fadeOut();
				  		$("#ginput_imagen1").fadeOut();
				  		$("#glink_descarga").fadeOut();
				  	};
				  	if (id == 8) { // Redes sociales
				  		$("#ginput_valor1").fadeOut();
				  		$("#ginput_video1").fadeOut();
				  		$("#ginput_imagen1").fadeOut();
				  		$("#glink_descarga").fadeOut();
				  	};
				}
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			
			$(document).ready(function() {
				$("#link_descarga").text($("#link_descarga").text().trim());
				$(".summernote").html($(".summernote").html().trim());
				showhidefields({id_categoria});
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
				
				$( "#select_categoria" ).change(function() {	  	
				  	showhidefields(this.value);
				});
				
			});

		</script>
