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
					<h2>Crear nueva Activaci&oacute;n</h2>
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
						<input type="hidden" name="id_cliente" id="id_cliente" value="0" />
							<fieldset>
								<legend>Datos de Cliente</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">RUT</label>
									<div class="col-md-5">
										<div>
										<input class="form-control" placeholder="Ingrese el Rut del cliente" id="rut" name="rut" type="text" />
										</div>
									</div>
									<div class="col-md-2" style="display: inline;">
										<div>
										<input type="button" class="form-control" id="botonRut" name="botonRut" value="Buscar" onClick="buscaRut($('#rut').val());" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Nombre</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el nombre del cliente" id="nombre" name="nombre" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Paterno</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el apellido paterno del cliente" id="paterno" name="paterno" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Materno</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el apellido materno del cliente" id="materno" name="materno" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Email</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Email del cliente" id="email" name="email" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tel&eacute;fono Casa</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Telefono Fijo del cliente" id="telefono_casa" name="telefono_casa" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tel&eacute;fono M&oacute;vil</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Telefono Movil del cliente" id="telefono_movil" name="telefono_movil" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Direcci&oacute;n</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese la Direccion del cliente" id="direccion" name="direccion" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Datos para Direcci&oacute;n</label>
									<div class="col-md-5">
										<div>
										<label for="region">Regi&oacute;n</label>	
										<?php echo form_dropdown("region",$regiones, "", ' id="region" class="form-control" onChange="buscaComunas($(this).val());"');?>									
										<!--  input class="form-control" placeholder="Ingrese la Region" id="region" name="region" type="text" /-->
										</div>
									</div>
									<div class="col-md-5">
										<div>
										<label for="comuna">Comuna</label>
										<select name="comuna" id="comuna" class="form-control"></select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Ciudad</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese la Ciudad" id="ciudad" name="ciudad" type="text" />
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
										<input class="form-control" placeholder="Folio" id="folio" name="folio" type="text" />
										</div>
									</div>
									<div class="col-md-2" style="display: inline;">
										<div>
										<input type="button" class="form-control" id="botonFolio" name="botonFolio" value="Validar Folio" onClick="buscaFolio($('#folio').val());" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo de Producto</label>
									<div class="col-md-5">
										<div>
										<?php echo form_dropdown("tipo_producto",$categorias, "", ' id="tipo_producto" class="form-control" onChange="buscaMarca($(this).val());" disabled="disabled"');?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Marca</label>
									<div class="col-md-5">
										<div>
										<select name="marca" id="marca" class="form-control" disabled="disabled"></select>
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
										<textarea class="form-control" placeholder="Descripcion de Producto" id="descripcion" name="descripcion" disabled="disabled"></textarea>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Modelo</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Modelo" id="modelo" name="modelo" type="text" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Serie del Fabricante</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Serie" id="serie" name="serie" type="text" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Color</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Color" id="color" name="color" type="text" disabled="disabled" />
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
								<button class="btn btn-sm btn-success" type="button" id="botonGuardar" data-loading-text="Guardando..." onclick="save()" disabled="disabled">
									<i class="fa fa-check"></i> Guardar
								</button>	
							</div>
						</div>
					</div>
					<!-- end widget content -->
				</div>
</article>
<div class="modal" id="modalClave">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Ingreso Exitoso</h4>
        </div>
        <div class="modal-body">
        	Se ha enviado la clave de activaci&oacute;n al cliente <!--<br /><span id="claveActivacion"></span> -->
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-primary" onClick="salir();" >Cerrar</a>
        </div>
      </div>
    </div>
</div>
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
<script src="<?php echo base_url('assets/js/plugin/jquery-validate/jquery.Rut.min.js'); ?>"></script>	
<script type="text/javascript">

	pageSetUp();

	$.validator.addMethod("rut", function(value, element) {
		return this.optional(element) || $.Rut.validar(value);
		}, "Revise el RUT"); 
	
	var $registerForm = $("#smart-form-register").validate({
				onsubmit: false,
				// Rules for form validation
				rules : {
					rut : {
						required : true,
						rut : true
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
						required : 'Por favor ingrese el RUT', 
						rut : 'Revise que esté bien escrito'
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
					var url = "<?php echo base_url('dashboard/getAjax/crearActivacion'); ?>";
					//var return_url = "<?php echo base_url('dashboard/getAjax/activaciones'); ?>";
					if($("#smart-form-register").validate().form()){
						$.ajax({
							url : url,
							data : dataform,
							type : 'post',
							success : function(response) {
								$('#claveActivacion').html(response);
								$('#modalClave').show();
							}
						});
						//saveWebContent(url, dataform,return_url);
					}
					else
						alert("Por favor llene los campos requeridos");
				};
				
				var cancelar = function() {
					var return_url = "<?php echo base_url('dashboard/getAjax/activaciones/'); ?>";
					loadURL(return_url,$('#content'));
				};

				function salir() {
					$('#modalClave').modal('hide');
					loadURL("<?php echo base_url('dashboard/getAjax/activaciones/'); ?>", $('#content'));
				}
				
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

	function buscaMarca(idCategoria) {
		$('#marca').empty();	
		if (idCategoria != "") {
			var parametros = {
					"idCategoria" : idCategoria
			};
			$.ajax({
				url: "<?php echo site_url('dashboard/getAjax/buscaMarca/');?>",
				data: parametros,
				type: 'post',
				success: function(response){
					var datos = jQuery.parseJSON(response);
					$.each(datos, function (indice, valor) {
						$('#marca').append($('<option>').val(indice).text(valor));						
					});
				},
				error: function (xhr, ajaxOptions, thrownError) {
		            alert(xhr.status + " "+ thrownError);
		          }
			});
		}
	}
	
	function buscaRut(rut){
		var parametros = {
				"rut" : rut
		};
		$.ajax({
			url: "<?php echo site_url('dashboard/getAjax/buscaRut/');?>",
			data: parametros,
			type: 'post',
			beforeSend: function() {
				$('#botonRut').val('...');
			},
			success: function(response){
				var datos = jQuery.parseJSON(response);				
				if (datos.length > 0) {
					$('#id_cliente').val(datos[0]['id']);
					$('#nombre').val(datos[0]['nombre']);
					$('#paterno').val(datos[0]['paterno']);
					$('#materno').val(datos[0]['materno']);
					$('#email').val(datos[0]['email']);
					$('#telefono_casa').val(datos[0]['telefono_casa']);
					$('#telefono_movil').val(datos[0]['telefono_movil']);
					$('#direccion').val(datos[0]['direccion']);
					$('#region').val(datos[0]['region']);
					buscaComunas(datos[0]['region']);
					$('#comuna').val(datos[0]['comuna']);
					$('#ciudad').val(datos[0]['ciudad']);
				}
				else
					alert(unescape("No se encontr%F3 el Rut en la Base de Datos. \nPor favor ingrese los datos"));
				$('#botonRut').val('Buscar');
			}
		});
	}

	function buscaFolio(folio){
		var parametros = {
				"folio" : folio,
				"tipo" : "activacion"
		};
		$.ajax({
			url: "<?php echo site_url('dashboard/getAjax/buscaFolio/');?>",
			data: parametros,
			type: 'post',
			beforeSend: function() {
				$('#botonFolio').val('...');
			},
			success: function(response){
				var datos = jQuery.parseJSON(response);		
				if (datos) {
					if (datos.resultado == 'OK')
					{
						$('#tipo_producto').prop('disabled',false);
						$('#descripcion').prop('disabled',false);
						$('#marca').prop('disabled',false);
						$('#serie').prop('disabled',false);
						$('#modelo').prop('disabled',false);
						$('#color').prop('disabled',false);
						$('#botonGuardar').prop('disabled',false);
					}
					else
					{
						alert(datos.resultado);
						$('#tipo_producto').prop('disabled',true);
						$('#descripcion').prop('disabled',true);
						$('#marca').prop('disabled',true);
						$('#serie').prop('disabled',true);
						$('#modelo').prop('disabled',true);
						$('#color').prop('disabled',true);
						$('#botonGuardar').prop('disabled',true);
					}
				}
				$('#botonFolio').val('Validar Folio');
			}
		});
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