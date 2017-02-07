<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fileupload.css'); ?>">
<div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> Robos</span></h1>
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
					<h2>Ver Reporte de Robo</h2>
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
						<input type="hidden" name="id_robo" id="id_robo" value="{id_robo}" />
							<fieldset>
								<legend>Datos del Cliente</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">RUT</label>
									<div class="col-md-5">
										<div>
											<input class="form-control" placeholder="Ingrese el Rut del cliente" id="rut" name="rut" type="text" value="{rut}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Nombre</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el nombre del cliente" id="nombre" name="nombre" type="text" value="{nombre}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Paterno</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el apellido paterno del cliente" id="paterno" name="paterno" type="text" value="{paterno}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Materno</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el apellido paterno del cliente" id="materno" name="materno" type="text" value="{materno}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Email</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="email" id="email" name="email" type="text" value="{email}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tel&eacute;fono Casa</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Telefono Fijo del cliente" id="telefono_casa" name="telefono_casa" type="text" value="{telefono_casa}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tel&eacute;fono M&oacute;vil</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Telefono Movil del cliente" id="telefono_movil" name="telefono_movil" type="text" value="{telefono_movil}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Direcci&oacute;n</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese la Direccion del cliente" id="direccion" name="direccion" type="text" value="{direccion}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Datos para Direcci&oacute;n</label>
									<div class="col-md-5">
										<div>
										<label for="region">Regi&oacute;n</label>										
										<input class="form-control" placeholder="Ingrese la Region" id="region" name="region" type="text" value="{region}" disabled="disabled" />
										</div>
									</div>
									<div class="col-md-5">
										<div>
										<label for="region">Comuna</label>										
										<input class="form-control" placeholder="Ingrese la Comuna" id="comuna" name="comuna" type="text" value="{comuna}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Ciudad</label>
									<div class="col-md-10">
										<div>
										<label for="ciudad">Ciudad</label>
										<input class="form-control" placeholder="Ingrese la Ciudad" id="ciudad" name="ciudad" type="text" value="{ciudad}" disabled="disabled" />
										</div>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>Datos del Robo</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Lugar</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Lugar del Robo" id="lugar" name="lugar" type="text" value="{lugar}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Fecha del Robo</label>
									<div class="col-md-5">
										<div>
										<label for="fecha">Fecha</label>										
										<input class="form-control" placeholder="Ingrese la fecha" id="dia" name="dia" type="text" value="{dia}" disabled="disabled" />
										</div>
									</div>
									<div class="col-md-5">
										<div>
										<label for="hora">Hora</label>
										<input class="form-control" placeholder="Ingrese la hora" id="hora" name="hora" type="text" value="{hora}" disabled="disabled" />
										</div>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>Datos del Producto</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo de Producto</label>
									<div class="col-md-5">
										<div>
										<input class="form-control" placeholder="Tipo de Producto" id="tipo_producto" name="tipo_producto" type="text" value="{tipo_producto}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Descripci&oacute;n del Producto</label>
									<div class="col-md-10">
										<div>
										<textarea class="form-control" placeholder="Descripcion de Producto" id="descripcion" name="descripcion" disabled="disabled">{descripcion}</textarea>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Marca</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Marca" id="marca" name="marca" type="text" value="{marca}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Modelo</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Modelo" id="modelo" name="modelo" type="text" value="{modelo}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Serie del Fabricante</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Serie" id="serie" name="serie" type="text" value="{serie}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Color</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Color" id="color" name="color" type="text" value="{color}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Folio</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Folio" id="folio" name="folio" type="text" value="{folio}" disabled="disabled" />
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					<fieldset>
						<legend>Ver Archivos</legend>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="<?php echo base_url('/fileupload/index'); ?>" method="POST" enctype="multipart/form-data">
        <!-- The table listing the files available for upload/download -->
        <input type="hidden" name="tipo_registro" id="tipo_registro" value="robo" /> 
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
        <!-- td>
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
        </td -->
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
					</div>
					<!-- end widget content -->
					<!-- new widget -->
						<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false" data-widget-fullscreenbutton="false">
							<header>
								<span class="widget-icon"> <i class="fa fa-comments txt-color-white"></i> </span>
								<h2> Historial de la venta </h2>
							</header>
							
							<div>
							<?php if ($mensaje) { ?>
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
								<?php }
								else { 
								?>
								Sin Informaci&oacute;n
								<?php } ?>
							</div>
						</div>
					<!-- end widget div -->
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
	
	$(document).ready(function() {
		pageSetUp();
	});
	/*
	var $registerForm = $("#smart-form-register").validate({
				onsubmit: false,
				// Rules for form validation
				rules : {
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
						digits : true
					}
				},
	
				// Messages for form validation
				messages : {
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
						digits : 'Debe ingresar sólo números'
					} 
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
	*/

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