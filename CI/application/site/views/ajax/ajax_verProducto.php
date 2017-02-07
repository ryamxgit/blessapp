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
					<h2>Producto</h2>
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
										<textarea class="form-control" placeholder="Observaciones y Consideraciones" id="observacion" name="observacion" disabled="disabled">{observacion}</textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo de Kit</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Tipo de Kit" id="tipo_kit" name="tipo_kit" type="text" value="{tipo_kit}" disabled="disabled" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Tipo de Etiqueta</label>
									<div class="col-md-10">
										<input class="form-control" placeholder="Tipo de Etiqueta" id="tipo_etiqueta" name="tipo_etiqueta" type="text" value="{tipo_etiqueta}" disabled="disabled" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Cantidad de Folios </label>
									<div class="col-md-10">
										<div>
										<input class="form-control" placeholder="Cantidad de Folios" id="cantidad_folios" name="cantidad_folios" type="text" value="{cantidad_folios}" disabled="disabled" />
										</div>
									</div>
								</div>
							</fieldset>
						</form>
						<div style="clear:both;"></div>
						<!-- Aprobados -->
						<div class="panel panel-success" style="width:22%;float:left;margin-left:44px">
		                    <div class="panel-heading">
		                        <div class="row">
		                            <div class="text-right">
		                                <p class="announcement-heading" style="margin-right:10px">                                   
		                                    {aprobado}
		                                </p>
		                                <p class="announcement-text" style="margin-right:10px">Aprobados</p>
		                            </div>
		                        </div>
		                    </div>
		                    <nav>
		                    <a href="<?php echo base_url();?>dashboard/getAjax/detalleFolios/{id_producto}_aprobado">
		                        <div class="panel-footer announcement-bottom">
		                            <div class="row">
		                                <div class="col-xs-6">
		                                    Ver detalles
		                                </div>
		                                <div class="col-xs-6 text-right">
		                                    <i class="fa fa-arrow-circle-right"></i>
		                                </div>
		                            </div>
		                        </div>
		                    </a>
		                	</nav>
		                </div>
						<div class="panel panel-danger" style="width:22%;float:left;margin-left:20px">
		                    <div class="panel-heading">
		                        <div class="row">
		                            <div class="text-right">
		                                <p class="announcement-heading" style="margin-right:10px">                                   
		                                    {rechazado}
		                                </p>
		                                <p class="announcement-text" style="margin-right:10px">Rechazados</p>
		                            </div>
		                        </div>
		                    </div>
		                    <nav>
		                    <a href="<?php echo base_url();?>dashboard/getAjax/detalleFolios/{id_producto}_rechazado">
		                        <div class="panel-footer announcement-bottom">
		                            <div class="row">
		                                <div class="col-xs-6">
		                                    Ver detalles
		                                </div>
		                                <div class="col-xs-6 text-right">
		                                    <i class="fa fa-arrow-circle-right"></i>
		                                </div>
		                            </div>
		                        </div>
		                    </a>
		                </nav>
		                </div>
						<div class="panel panel-warning" style="width:22%;float:left;margin-left:20px">
		                    <div class="panel-heading">
		                        <div class="row">
		                            <div class="text-right">
		                                <p class="announcement-heading" style="margin-right:10px">                                   
		                                    {disponible}
		                                </p>
		                                <p class="announcement-text" style="margin-right:10px">Disponibles</p>
		                            </div>
		                        </div>
		                    </div>
		                    <nav>
		                    <a href="<?php echo base_url();?>dashboard/getAjax/detalleFolios/{id_producto}_disponible">
		                        <div class="panel-footer announcement-bottom">
		                            <div class="row">
		                                <div class="col-xs-6">
		                                    Ver detalles
		                                </div>
		                                <div class="col-xs-6 text-right">
		                                    <i class="fa fa-arrow-circle-right"></i>
		                                </div>
		                            </div>
		                        </div>
		                    </a>
		                	</nav>
		                </div>
						<div class="panel panel-info" style="width:22%;float:left;margin-left:20px">
		                    <div class="panel-heading">
		                        <div class="row">
		                            <div class="text-right">
		                                <p class="announcement-heading" style="margin-right:10px">                                   
		                                    {gestionado}
		                                </p>
		                                <p class="announcement-text" style="margin-right:10px">Gestionados</p>
		                            </div>
		                        </div>
		                    </div>
		                    <nav>
		                    <a href="<?php echo base_url();?>dashboard/getAjax/detalleFolios/{id_producto}_gestionado">
		                        <div class="panel-footer announcement-bottom">
		                            <div class="row">
		                                <div class="col-xs-6">
		                                    Ver detalles
		                                </div>
		                                <div class="col-xs-6 text-right">
		                                    <i class="fa fa-arrow-circle-right"></i>
		                                </div>
		                            </div>
		                        </div>
		                    </a>
		                	</nav>
		                </div>		                
		                <div style="clear:both;"></div>
					<fieldset>
						<legend>Descargar Archivo</legend>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="<?php echo base_url('/fileupload/index'); ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="tipo_registro" id="tipo_registro" value="producto" />
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
