<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fileupload.css'); ?>">
<div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> Activaciones</span></h1>
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
					<h2>Editar Activaci&oacute;n</h2>
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
						<input type="hidden" name="id_producto_individual" id="id_producto_individual" value="{id_producto_individual}" />	
						<input type="hidden" name="id_cliente" id="id_cliente" value="{id_cliente}" />
							<fieldset>
								<legend>Datos de Cliente</legend>
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
										<input class="form-control" placeholder="Ingrese el nombre del cliente" id="nombre" name="nombre" type="text" value="{nombre}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Paterno</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el apellido paterno del cliente" id="paterno" name="paterno" type="text" value="{paterno}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Materno</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el apellido materno del cliente" id="materno" name="materno" type="text" value="{materno}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Email</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Email del cliente" id="email" name="email" type="text" value="{email}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tel&eacute;fono Casa</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Telefono Fijo del cliente" id="telefono_casa" name="telefono_casa" value="{telefono_casa}" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tel&eacute;fono M&oacute;vil</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Telefono Movil del cliente" id="telefono_movil" name="telefono_movil" value="{telefono_movil}" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Direcci&oacute;n</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese la Direccion del cliente" id="direccion" name="direccion" type="text" value="{direccion}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Datos para Direcci&oacute;n</label>
									<div class="col-md-5">
										<div>
										<label for="region">Regi&oacute;n</label>	
										<?php echo form_dropdown("region",$arregloRegiones, $region, ' id="region" class="form-control" onChange="buscaComunas($(this).val());"');?>									
										</div>
									</div>
									<div class="col-md-5">
										<div>
										<label for="comuna">Comuna</label>
										<?php echo form_dropdown("comuna",$arregloComunas, $comuna, ' id="comuna" class="form-control"');?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Ciudad</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese la Ciudad" id="ciudad" name="ciudad" type="text" value="{ciudad}" />
										</div>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>Datos del Producto</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Folio</label>
									<div class="col-md-5">
										<div>
										<input class="form-control" placeholder="Folio" id="folio_fijo" name="folio_fijo" type="text" value="{folio}" disabled="disabled" />
										<input id="folio" name="folio" type="hidden" value="{folio}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo de Producto</label>
									<div class="col-md-5">
										<div>
										<?php echo form_dropdown("tipo_producto",$categorias, $tipo_producto, ' id="tipo_producto" class="form-control" disabled="disabled"');?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Marca</label>
									<div class="col-md-5">
										<div>
										<?php echo form_dropdown("marca",$arregloMarcas, $marca, ' id="marca" class="form-control"');?>
										</div>
									</div>
								</div>
								<div class="form-group" id="otraDescripcion" style="display: none;">
									<label class="col-md-2 control-label">Detalle del 'Otro' Tipo de Producto</label>
									<div class="col-md-5">										
										<div>
											<input class="form-control" placeholder="Detalle del 'Otro' Tipo de Producto" id="otro_tipo_producto" name="otro_tipo_producto" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Descripci&oacute;n del Producto</label>
									<div class="col-md-10">
										<div>
										<textarea class="form-control" placeholder="Descripcion de Producto" id="descripcion" name="descripcion">{descripcion}</textarea>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Modelo</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Modelo" id="modelo" name="modelo" type="text" value="{modelo}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Serie del Fabricante</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Serie" id="serie" name="serie" type="text" value="{serie}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Color</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Color" id="color" name="color" type="text" value="{color}" />
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					<fieldset>
						<legend>Subir Archivo</legend>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="<?php echo base_url('/fileupload/index'); ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="idPedido" id="idPedido" value="{id_producto_individual}" />
	<input type="hidden" name="tipo_registro" id="tipo_registro" value="activacion" />
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
								<button class="btn btn-sm btn-success" type="button" id="botonGuardar" data-loading-text="Guardando..." onclick="save()" >
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
		<![endif] -->
<script src="<?php echo base_url('assets/js/plugin/jquery-form/jquery-form.min.js'); ?>"></script>		
<script type="text/javascript">

	//pageSetUp();
	var $registerForm = $("#smart-form-register").validate({
				onsubmit: false,
				// Rules for form validation
				rules : {
					rut : {
						required : true
					},
					nombre : {
						required : true
					},
					email : {
						required : true,
						email : true
					},
					folio : {
						required : true
					},
					tipo_producto : {
						required : true
					}
				},
	
				// Messages for form validation
				messages : {
					rut : {
						required : 'Por favor ingrese el RUT'
					},
					nombre : {
						required : 'Por favor ingrese el Nombre'
					},
					email : {
						required : 'Por favor ingrese el Email',
						email : 'Por favor ingrese un Correo Electrónico Válido'
					},
					folio : {
						required : 'Por favor ingrese y valide el Folio'
					},
					tipo_producto : {
						required : 'Por favor seleccione el Tipo de Producto'
					}
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
	
				var save = function() {
					var dataform = $('#smart-form-register').serialize();
					var url = "<?php echo base_url('dashboard/getAjax/editarActivacion'); ?>";
					var return_url = "<?php echo base_url('dashboard/getAjax/activaciones'); ?>";
					if($("#smart-form-register").validate().form()){
						saveWebContent(url, dataform,return_url);
					}
				};
				
				var cancelar = function() {
					var return_url = "<?php echo base_url('dashboard/getAjax/activaciones/'); ?>";
					loadURL(return_url,$('#content'));
				};
				
	function buscaComunas(idRegion) {
		$('#comuna').empty();	
		if (idRegion != "0") {
			var parametros = {
					"idRegion" : idRegion
			};
			$.ajax({
				url: "<?php echo site_url('dashboard/getAjax/buscaComuna/');?>",
				data: parametros,
				type: 'post',
				success: function(response){
					var datos = jQuery.parseJSON(response);
					$.each(datos, function (indice, valor) {
						$('#comuna').append($('<option>').val(indice).text(valor));						
					});
				},
				error: function (xhr, ajaxOptions, thrownError) {
		            alert(xhr.status + " "+ thrownError);
		          }
			});
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