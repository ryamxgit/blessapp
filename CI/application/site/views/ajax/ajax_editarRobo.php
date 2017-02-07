<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fileupload.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/redmond.datepick.css'); ?>">
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
					<h2>Editar Reporte de Robo</h2>
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
						<div style="clear: both;"></div>
						<?php if (!$esFiscal) { ?>
						<div style="float: right;">
							<button class="btn btn-success fileinput-button" type="button" data-toggle="modal" data-target="#modalAprueba">
							    <span>Aprobar / Finalizar</span>
							</button>
							<button class="btn btn-danger delete" type="button" data-toggle="modal" data-target="#modalReprueba">
							    <span>Rechazar</span>
							</button>
						</div>
						<?php } ?>
						<div style="clear: both;"></div>
						
						<form id="smart-form-register" class="form-horizontal">
						<input type="hidden" name="id_robo" id="id_robo" value="{id_robo}" />
						<input type="hidden" name="id_cliente" id="id_cliente" value="{id_cliente}" />
							<fieldset>
							<?php if ($esFiscal) { ?>
								<legend>Datos de Gestión</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Gesti&oacute;n</label>
									<div class="col-md-10">
										<div>
										<?php 
										$gestiones = array('SIN REPORTES' => 'SIN REPORTES',
												'EN OBSERVACION' => 'EN OBSERVACION',
												'PENDIENTE DE RECUPERO' => 'PENDIENTE DE RECUPERO',
												'SOLICITUD DE ANTECEDENTES' => 'SOLICITUD DE ANTECEDENTES',
												'RECUPERADO' => 'RECUPERADO'
												);
										echo form_dropdown('gestion',$gestiones,$gestion,' id="gestion" class="form-group" ');
										} ?>
										</div>
									</div>
								</div>
								<legend>Datos de Cliente</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">RUT</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Rut del cliente" id="rut" name="rut" type="text" value="{rut}" disabled="disabled" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Nombre</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el nombre del cliente" id="nombre" name="nombre" type="text" disabled="disabled" value="{nombre}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Paterno</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el apellido paterno del cliente" id="paterno" name="paterno" type="text" disabled="disabled" value="{paterno}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Materno</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el apellido materno del cliente" id="materno" name="materno" type="text" disabled="disabled" value="{materno}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Email</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Email del cliente" id="email" name="email" type="text" disabled="disabled" value="{email}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tel&eacute;fono Casa</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Telefono Fijo del cliente" id="telefono_casa" name="telefono_casa" type="text" disabled="disabled" value="{telefono_casa}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tel&eacute;fono M&oacute;vil</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Telefono Movil del cliente" id="telefono_movil" name="telefono_movil" type="text" disabled="disabled" value="{telefono_movil}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Direcci&oacute;n</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese la Direccion del cliente" id="direccion" name="direccion" type="text" disabled="disabled" value="{direccion}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Datos para Direcci&oacute;n</label>
									<div class="col-md-5">
										<div>
										<label for="region">Regi&oacute;n</label>	
										<?php echo form_dropdown("region",$arregloRegiones, $region, ' id="region" class="form-control" disabled="disabled"');?>
										</div>
									</div>
									<div class="col-md-5">
										<div>
										<label for="comuna">Comuna</label>
										<?php echo form_dropdown("comuna",$arregloComunas, $comuna, ' id="comuna" class="form-control" disabled="disabled"');?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Ciudad</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese la Ciudad" id="ciudad" name="ciudad" type="text" disabled="disabled" value="{ciudad}" />
										</div>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>Datos del Producto</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Folio</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Folio" id="folio" name="folio" type="text" disabled="disabled" value="{folio}" />
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
										<?php echo form_dropdown("marca",$arregloMarcas, $marca, ' id="marca" class="form-control" disabled="disabled"');?>
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
									<label class="col-md-2 control-label">Modelo</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Modelo" id="modelo" name="modelo" type="text" disabled="disabled" value="{modelo}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Serie del Fabricante</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Serie" id="serie" name="serie" type="text" disabled="disabled" value="{serie}" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Color</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Color" id="color" name="color" type="text" disabled="disabled" value="{color}" />
										</div>
									</div>
								</div>
							</fieldset>
							<?php 
							$disable = '';
							if ($esFiscal) { 
								$disable = 'disabled="disabled" ';
							}?>
							<fieldset>
								<legend>Datos del Robo</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Lugar</label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Ingrese el Lugar del Robo" id="lugar" name="lugar" type="text"  value="{lugar}" <?php echo $disable?>/>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Fecha del Robo</label>
									<div class="col-md-5">
										<div>
										<label for="dia">Fecha (dd-mm-aaaa)</label>										
										<input class="form-control" placeholder="Ingrese la fecha" id="dia" name="dia" type="text" value="<?php echo $arregloFecha[2]."-".$arregloFecha[1]."-".$arregloFecha[0];?>" <?php echo $disable?>/>
										</div>
									</div>
									<div class="col-md-5">
										<div>
										<label for="hora">Hora</label>
										<input class="form-control" placeholder="Ingrese la hora" id="hora" name="hora" type="text" value="{hora}" />
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					<fieldset>
						<legend>Subir Archivo</legend>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="<?php echo base_url('/fileupload/index'); ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="idPedido" id="idPedido" value="{id_robo}" />
	<input type="hidden" name="tipo_registro" id="tipo_registro" value="robo" />
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
					<!-- INGRESO DE COMENTARIOS -->
					<fieldset>
						<legend>Comentario</legend>
						<div class="summernote">
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
<div class="modal" id="modalAprueba">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Aprobaci&oacute;n</h4>
        </div>
        <div class="modal-body">
          Esta acci&oacute;n enviar&aacute; este reporte a la siguiente etapa. &iquest;Est&aacute; segura(o) que est&aacute;n todos los datos OK?
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Cancelar</a>
          <a href="#" class="btn btn-primary" onClick="aprobar();" >Aceptar</a>
        </div>
      </div>
    </div>
</div>
<div class="modal" id="modalReprueba">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Rechazo</h4>
        </div>
        <div class="modal-body">
          Para completar esta acci&oacute;n, es necesario que por favor ingrese el motivo del Rechazo en el siguiente cuadro:
          <br />&nbsp; <br />&nbsp;
          <textarea name="motivo" id="motivo" cols="60" rows="6"></textarea>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Cancelar</a>
          <a href="#" class="btn btn-primary" onClick="rechazar();">Aceptar</a>
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
		<![endif]-->
		<!-- Librerias para el despliegue del calendario -->
		<script src="<?php echo base_url('assets/js/plugin/jquery-datepicker/jquery.plugin.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/jquery-datepicker/jquery.datepick.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/jquery-datepicker/jquery.datepick-es.js'); ?>"></script>
		
<script src="<?php echo base_url('assets/js/plugin/jquery-form/jquery-form.min.js'); ?>"></script>		
<script type="text/javascript">
	
	$(document).ready(function() {
<?php if (!$esFiscal) {?>
	$('#dia').datepick({dateFormat: 'dd-mm-yyyy', minDate: new Date(1965, 1 - 1, 1), defaultDate: new Date(<?php echo $arregloFecha[0];?>, <?php echo $arregloFecha[1];?> - 1, <?php echo $arregloFecha[2];?>), renderer: $.extend({}, $.datepick.defaultRenderer, {picker: $.datepick.defaultRenderer.picker.  replace(/\{link:today\}/, '')})});
<?php } ?>
		//pageSetUp();

		$('#modalAprueba').modal({
			show: false
		});
		$('#modalReprueba').modal({
			show: false
		});
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
				var save = function() {
		var aHTML = $('.summernote').code(); //save HTML If you need(aHTML: array).
		//var dataform = 'data='+aHTML.trim() + '&cantidad=' + $('#cantidad').val() + '&estado=' + $('#select_estado :selected').val();
		//console.log(dataform);
					var dataform = 'data='+aHTML.trim() + '&' + $('#smart-form-register').serialize();
					var url = "<?php echo base_url('dashboard/getAjax/editarRobo'); ?>";
					var return_url = "<?php echo base_url('dashboard/getAjax/robos'); ?>";
					if($("#smart-form-register").validate().form()){
						saveWebContent(url, dataform,return_url);
					}
				};
				var cancelar = function() {
					var return_url = "<?php echo base_url('dashboard/getAjax/robos/'); ?>";
					loadURL(return_url,$('#content'));
				}

			function aprobar() {
				$('#modalAprueba').modal('hide');
				loadURL("<?php echo base_url('dashboard/getAjax/apruebaRobo/'.$id_robo); ?>", $('#content'));
			}

			function rechazar() {
				var motivo = $('#motivo').val();
				if (motivo.length < 1){
					alert('Debe ingresar un Motivo antes de Continuar');
					$('#motivo').focus();
					return false;
				}
				var dataform = 'motivo='+motivo.trim();
				var url = "<?php echo base_url('dashboard/getAjax/rechazaRobo/'.$id_robo); ?>";
				var return_url = "<?php echo base_url('dashboard/getAjax/robos');?>";
				$('#modalReprueba').modal('hide');
				saveWebContent(url,dataform,return_url);
			}
			

</script>		
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