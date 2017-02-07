<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fileupload.css'); ?>">
<div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> Productos</span></h1>
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
										<div>
										<textarea class="form-control" placeholder="Ingrese el nombre del producto" id="nombre" name="nombre"></textarea>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Observaci&oacute;n</label>
									<div class="col-md-10">
										<div>
										<textarea class="form-control" placeholder="Observaciones y Consideraciones" id="observacion" name="observacion"></textarea>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo de Kit</label>
									<div class="col-md-10">
										<div>
										<select class="form-control" id="tipo_kit" name="tipo_kit" onchange="camposTipoKit()">
											<?php echo $sel_tipo_kits; ?> 
										</select> 																						
										<!--<input class="form-control" placeholder="Tipo de Kit" id="tipo_kit" name="tipo_kit" type="text" />-->
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo de Etiqueta</label>
									<div class="col-md-10">
										<div>
											<select class="form-control" id="tipo_etiqueta" name="tipo_etiqueta">
  												<option value="Alfanumerico">Alfanumerico</option> 
  												<option value="Numerico" selected>Numerico</option>
											</select>											
											<!--<input class="form-control" placeholder="Tipo de Etiqueta" id="tipo_etiqueta" name="tipo_etiqueta" type="text" />-->
										</div>
									</div>
								</div>
								<div id="div_grupo_hogar" class="form-group" style="display:none">
									<label class="col-md-2 control-label">Cantidad de kits</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Cantidad de kits" id="grupo_bienes" name="grupo_bienes" type="text" />
										<p class="help-block">Folios = 10 x Cantidad de kits</p>
										</div>
									</div>
								</div>								
								<div id="div_grupo_hogar2" class="form-group" style="display:none">
									<label class="col-md-2 control-label">Cantidad de Seriales </label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Cantidad de Seriales" id="cantidad_folios2" name="cantidad_folios2" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group" id="div_folios">
									<label class="col-md-2 control-label">Cantidad de Folios </label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Cantidad de Folios" id="cantidad_folios" name="cantidad_folios" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Seguro Asociado </label>
									<div class="col-md-10">
										<!--<div>
										<input class="form-control" placeholder="Seguro Asociado" id="seguro_asociado" name="seguro_asociado" type="text" />
										</div>-->
										<div>
										<select class="form-control" id="seguro_asociado" name="seguro_asociado" onchange="camposTipoKit()">
											<?php echo $sel_seguros; ?> 
										</select> 																						
										<!--<input class="form-control" placeholder="Tipo de Kit" id="tipo_kit" name="tipo_kit" type="text" />-->
										</div>										
									</div>
								</div>								
							</fieldset>
						</form>
					<fieldset>
						<legend>Subir Archivo</legend>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="<?php echo base_url('/fileupload/index'); ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="idPedido" id="idPedido" value="0" />
	<input type="hidden" name="tipo_registro" id="tipo_registro" value="producto" />
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="<?php echo base_url(); ?>"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Agregar Archivo...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <!-- button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Comenzar Subidas</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button -->
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Borrar</span>
                </button>
                <input type="checkbox" class="toggle">
		<span>Seleccionar todos los archivos</span>
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>
    <br>
</div>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Procesando...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Comenzar</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}">{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            <span class="name">{%=file.nombreUsuario%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Borrar</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
					    <!-- The fileinput-button span is used to style the file input field as button -->
					</fieldset>
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
		<!-- File Upload -->
		<script src="<?php echo base_url('assets/js/plugin/jquery-fileupload/tmpl.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/jquery-fileupload/jquery.fileupload.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/jquery-fileupload/jquery.fileupload-image.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/jquery-fileupload/jquery.fileupload-process.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/jquery-fileupload/jquery.fileupload-validate.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/jquery-fileupload/jquery.fileupload-ui.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/jquery-fileupload/jquery.iframe-transport.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/jquery-fileupload/mainProducto.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/jquery-ui/jquery.ui.widget.js'); ?>"></script>
		<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
		<!--[if (gte IE 8)&(lt IE 10)]>
		<script src="<?php echo base_url('assets/js/plugin/jquery-fileupload/xdr/jquery.xdr-transport.js'); ?>"></script>
		<![endif]-->
		
<script src="<?php echo base_url('assets/js/plugin/jquery-form/jquery-form.min.js'); ?>"></script>		
<script type="text/javascript">
	pageSetUp();
	var $registerForm = $("#smart-form-register").validate({
				onsubmit: false,
				// Rules for form validation
				rules : {
					nombre: {
						required : true
					},
					observacion : {
						required : true
					},
					tipo_kit : {
						required : true
					},
					tipo_etiqueta : {
						required : true
					},
					cantidad_folios : {
						required : true,
						digits : true
					}
				},
	
				// Messages for form validation
				messages : {
					nombre: {
						required : 'Por favor ingrese el nombre del producto'
					},
					observacion : {
						required : 'Por favor ingrese la Observación'
					},
					tipo_kit : {
						required : 'Por favor ingrese el Tipo de Kit'
					},
					tipo_etiqueta : {
						required : 'Por favor ingrese el Tipo de Etiqueta'
					},
					cantidad_folios : {
						required : 'Debe ingresar cantidad de folios',
						digits : 'Debe ingresar sólo números'
					} 
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
	
			var save = function() {
					var dataform = $('#smart-form-register').serialize();
					var url = "<?php echo base_url('dashboard/getAjax/crearProducto'); ?>";
					var return_url = "<?php echo base_url('dashboard/getAjax/perfilProducto'); ?>";
					if($("#smart-form-register").validate().form()){
						saveWebContent(url, dataform,return_url);
					}
			};
			var cancelar = function() {
					var return_url = "<?php echo base_url('dashboard/getAjax/perfilProducto/'); ?>";
					loadURL(return_url,$('#content'));
			}

			$(function() {
				$('#grupo_bienes').on('keyup', function(event) {
					if(parseInt($('#grupo_bienes').val()) > 0) 
						$('#cantidad_folios2').val(parseInt($('#grupo_bienes').val()) * 10);
					else
						$('#cantidad_folios2').val('');
				});
			});
</script>		

<script type="text/javascript">
	function camposTipoKit(){
		var t_kit = $("#tipo_kit").val();
		if(t_kit == 6){
			$("#div_grupo_hogar").css("display", "block");
			$("#div_grupo_hogar2").css("display", "block");
			$("#div_folios").css("display", "none");
			$("#cantidad_folios").attr('disabled','disabled');
		}	
		else{
			$("#div_grupo_hogar").css("display", "none");
			$("#div_grupo_hogar2").css("display", "none");
			$("#div_folios").css("display", "block");
			$("#cantidad_folios").attr('disabled',false);
		}	
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
