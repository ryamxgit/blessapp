<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fileupload.css'); ?>">
<div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> Productos</span></h1>
        </div>
        {GRAFICASRIBBON}
</div>
<?php if ($puede_editar) {
	$disabled = "";
}
else{
	$disabled = " disabled=\"disabled\"";
}

                    if($tipo_kit == 'Kit Hogar'){
                    	$val_grupo_bienes = $cantidad_folios / 10;
                    	$muestra_div_grupo_bienes = 'display:block';
                    	$habilita_input_folios = 'disabled';
                    }
                    else{
                    	$val_grupo_bienes = '';
                    	$muestra_div_grupo_bienes = 'display:none';
                    	$habilita_input_folios = '';
                    }
                   // echo($val_grupo_bienes);exit();

?>
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
					<h2>Edici&oacute;n de Producto</h2>
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
						<div style="float: right;">
						<?php if ($finaliza) { ?>
							<button class="btn btn-success fileinput-button" type="button" data-toggle="modal" data-target="#modalAprueba">
							    <span>Finalizar</span>
							</button>
						<?php  } 
						else { ?>
							<button class="btn btn-success fileinput-button" type="button" data-toggle="modal" data-target="#modalAprueba">
							    <span>Continuar / Finalizar</span>
							</button>
							<button class="btn btn-danger delete" type="button" data-toggle="modal" data-target="#modalReprueba">
							    <span>Rechazar</span>
							</button>
						<?php } ?>
						</div>
						<div style="clear: both;"></div>
						<form id="smart-form-register" class="form-horizontal">	
						<input type="hidden" name="idProducto" id="idProducto" value="{id_producto}" />
							<fieldset>
								<legend>Detalles</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">Nombre</label>
									<div class="col-md-10">
										<textarea class="form-control" placeholder="Ingrese el nombre del producto" id="nombre" name="nombre" disabled="disabled">{nombre}</textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Observaci&oacute;n</label>
									<div class="col-md-10">
										<textarea class="form-control" placeholder="Observaciones y Consideraciones" id="observacion" name="observacion"<?php echo $disabled;?>>{observacion}</textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo de Kit</label>
									<div class="col-md-10">
										<select class="form-control" id="tipo_kit" name="tipo_kit" onchange="camposTipoKit()">
											<?php echo $sel_tipo_kits; ?> 
										</select> 																																
										<!--<input class="form-control" placeholder="Tipo de Kit" id="tipo_kit" name="tipo_kit" type="text" value="{tipo_kit}"<?php echo $disabled;?> />-->
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo de Etiqueta</label>
									<div class="col-md-10">
										<select class="form-control" id="tipo_kit" name="tipo_etiqueta">
											<?php echo $sel_tipo_etiqueta; ?> 
										</select> 																																
										<!--<input class="form-control" placeholder="Tipo de Etiqueta" id="tipo_etiqueta" name="tipo_etiqueta" type="text" value="{tipo_etiqueta}"<?php echo $disabled;?> />-->
									</div>
								</div>
								<div id="div_grupo_hogar" class="form-group" style="<?php echo $muestra_div_grupo_bienes;?>">
									<label class="col-md-2 control-label">Grupo Bienes </label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Grupo Bienes" id="grupo_bienes" name="grupo_bienes" type="text" value="<?php echo $val_grupo_bienes;?>" />
										<p class="help-block">Folios = 10 x Grupo de Bienes</p>
										</div>
									</div>
								</div>																
								<div class="form-group">
									<label class="col-md-2 control-label">Cantidad de Folios </label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Cantidad de Folios" id="cantidad_folios" name="cantidad_folios" type="text" value="{cantidad_folios}"<?php echo $disabled;?> <?php echo $habilita_input_folios;?>/>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Seguro Asociado </label>
									<div class="col-md-10">
									
										<select class="form-control" id="seguro_asociado" name="seguro_asociado">
											<?php echo $sel_seguros; ?> 
										</select> 																						
									
									</div>
								</div>								
							<?php if ($imprenta) { ?>
								<div class="form-group">
									<label class="col-md-2 control-label">Folios </label>
									<div class="col-md-2">
										<div>
										<label>Inicial</label>
										<input class="form-control" placeholder="Folio Inicial" id="folio_inicial" name="folio_inicial" type="text" value="{folio_inicial}"<?php echo $disabled;?> />
										</div>
									</div>
									<div class="col-md-2">
										<div><label>Final</label>
										<input class="form-control" placeholder="Folio final" id="folio_final" name="folio_final" type="text" value="{folio_final}"<?php echo $disabled;?> />
										</div>
									</div>
								</div>
							<?php } ?>
							<?php if ($aprueba) { ?>
								<div class="form-group">
									<label class="col-md-2 control-label">Empresa </label>
									<div class="col-md-5">
										<div>
										<?php echo form_dropdown('empresa',$empresas,'0','id="empresa" class="form-control valid"');?>
										</div>
									</div>
								</div>
							<?php } ?>
							</fieldset>
						</form>
					<fieldset>
						<legend><?php echo $puede_editar?"Subir":"Descargar";?> Archivo</legend>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="<?php echo base_url('/fileupload/index'); ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="tipo_registro" id="tipo_registro" value="producto" />
    	<?php if ($puede_editar) { ?>
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
        <?php } ?>
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
		<?php if ($puede_editar) { ?>
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
		<?php } ?>
    </tr>
{% } %}
</script>
					    <!-- The fileinput-button span is used to style the file input field as button -->
					</fieldset>
					<?php if ($finaliza) { ?>
							<fieldset>
								<legend>Productos Foliados Kit <?php echo $nombre;?></legend>
								<?php if (count($individuales) > 0) { ?>
									<form id="formFolios">
									<input type="hidden" name="idProducto" id="idProducto" value="{id_producto}" />
									<table style="width: 50%;" align="center">
										<tr>
											<th>Folio</th>
											<th>Aprobado</th>
											<th>Rechazado</th>
										</tr>
									<?php foreach ($individuales as $ind) {?>
										<tr>
											<td><?php echo $ind['folio'];?></td>
											<td><input type="checkbox" name="aprueba[]" value="<?php echo $ind['id'];?>" /></td>
											<td><input type="checkbox" name="rechaza[]" value="<?php echo $ind['id'];?>" /></td>
										</tr>
									<?php } ?>
									</table>
									</form>
									<div class="widget-footer smart-form">
										<div class="btn-group">
											<button class="btn btn-sm btn-primary" type="button" onclick="cancelar()">
												<i class="fa fa-times"></i> Cancelar
											</button>	
										</div>
										<div class="btn-group">
											<button class="btn btn-sm btn-success" type="button" data-loading-text="Guardando..." onclick="saveFolios()">
												<i class="fa fa-check"></i> Guardar
											</button>	
										</div>
									</div>
								<?php }
								else {
								?>
								No quedan Folios Disponibles
								<?php 
								}
								 ?>
							</fieldset>
							<?php } ?>
					<?php if ($puede_comentar) { ?>
					<!-- INGRESO DE COMENTARIOS  -->
					<fieldset>
						<legend>Comentario</legend>
						<div class="summernote">
						</div>
					</fieldset>
					<?php } ?>
					<?php if ($puede_editar){ ?>
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
					<?php } ?>
					</div>
					<!-- end widget content -->
				</div>
</article>
<div id="infoMessage"><?php echo $message;?></div>
<div id="modalAprueba" class="modal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
          <h4 class="modal-title">Aprobación</h4>
        </div>
        <div class="modal-body">
          Esta acción enviará este pedido a la siguiente etapa. ¿Está segura(o) que están todos los datos OK?
        </div>
        <div class="modal-footer">
          <a class="btn" data-dismiss="modal" href="#">Cancelar</a>
          <?php if ($finaliza) { ?>
          <a onclick="finalizar();" class="btn btn-primary" href="#">Aceptar</a>
          <?php } 
          else { ?>
          <a onclick="aprobar();" class="btn btn-primary" href="#">Aceptar</a>
          <?php } ?>
        </div>
      </div>
    </div>
</div>
<div id="modalReprueba" class="modal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
          <h4 class="modal-title">Rechazo</h4>
        </div>
        <div class="modal-body">
          Para completar esta acción, es necesario que por favor ingrese el motivo del Rechazo en el siguiente cuadro:
          <br>&nbsp; <br>&nbsp;
          <textarea rows="6" cols="60" id="motivo" name="motivo"></textarea>
        </div>
        <div class="modal-footer">
          <a class="btn" data-dismiss="modal" href="#">Cancelar</a>
          <a onclick="rechazar();" class="btn btn-primary" href="#">Aceptar</a>
        </div>
      </div>
    </div>
</div>
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
<script src="<?php echo base_url('assets/js/plugin/jquery-validate/jquery.Rut.js'); ?>"></script>	
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
					rut : {
						required:'Escriba el rut', 
						rut:'Revise que esté bien escrito'
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
						digits : 'Debe ingresar sólo números'
					}
				},
	
				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});

	$(':checkbox').on('change', function () {
		if ($(this).is(':checked')){
			var valor = $(this).val();
			if ($(this).prop('name') == 'aprueba[]'){
				$("input[name='rechaza[]'][value='" + valor + "']").prop('checked',false);
			}
			else{
				$("input[name='aprueba[]'][value='" + valor + "']").prop('checked',false);
			}
		}
	});
	
	$('#modalAprueba').modal({
		show: false
	});
	$('#modalReprueba').modal({
		show: false
	});

	function aprobar() {
		<?php if ($puede_editar) { ?>
		if (($('#cantidad_folios').val() == '') || (isNaN($('#cantidad_folios').val()))){
			alert('Debe ingresar la cantidad de folios');
			$('#cantidad_folios').focus();
			return false;
		}
		var dataform = $('#smart-form-register').serialize();
		var url = "<?php echo base_url('dashboard/getAjax/editarProducto'); ?>";
		if($("#smart-form-register").validate().form()){
			saveWebContent(url, dataform,null);
		}
		<?php } ?>
		$('#modalAprueba').modal('hide');
		loadURL("<?php echo base_url('dashboard/getAjax/apruebaProducto') .'/'. $id ; ?>", $('#content'));
	}
	function rechazar() {
		var motivo = $('#motivo').val();
		if (motivo.length < 1){
			alert('Debe ingresar un Motivo antes de Continuar');
			$('#motivo').focus();
			return false;
		}
		var dataform = 'motivo='+motivo.trim();
		var url = "<?php echo base_url('dashboard/getAjax/rechazaProducto') .'/'. $id ; ?>";
		var return_url = "<?php echo base_url('dashboard/getAjax/perfilProducto'); ?>";
		$('#modalReprueba').modal('hide');
		saveWebContent(url,dataform,return_url);
	}
	function finalizar() {
		$('#modalAprueba').modal('hide');
		var dataform = $('#smart-form-register').serialize();
		var url = "<?php echo base_url('dashboard/getAjax/finalizarProducto'); ?>";
		var return_url = "<?php echo base_url('dashboard/getAjax/perfilProducto'); ?>";
		saveWebContent(url, dataform,return_url);
	}
			
				var save = function() {
					var dataform = $('#smart-form-register').serialize();
					var url = "<?php echo base_url('dashboard/getAjax/editarProducto'); ?>";
					var return_url = "<?php echo base_url('dashboard/getAjax/perfilProducto'); ?>";
					if($("#smart-form-register").validate().form()){
						saveWebContent(url, dataform,return_url);
					}
				};
				var cancelar = function() {
					var return_url = "<?php echo base_url('dashboard/getAjax/perfilProducto/'); ?>";
					loadURL(return_url,$('#content'));
				}
				
				var saveFolios = function() {
					var dataform = $('#formFolios').serialize();
					var url = "<?php echo base_url('dashboard/getAjax/editarFolios'); ?>";
					var return_url = "<?php echo base_url('dashboard/getAjax/perfilProducto'); ?>";
					saveWebContent(url, dataform,return_url);
				};

	function camposTipoKit(){
		var t_kit = $("#tipo_kit").val();
		if(t_kit == 6){
			$("#div_grupo_hogar").css("display", "block");
			$("#cantidad_folios").attr('disabled','disabled');
		}	
		else{
			$("#div_grupo_hogar").css("display", "none");
			$("#cantidad_folios").attr('disabled',false);
		}	
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