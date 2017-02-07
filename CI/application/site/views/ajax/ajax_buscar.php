<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> B&uacute;squeda Avanzada</span></h1>
    </div>
    {GRAFICASRIBBON}
</div>
<div class="row">
<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<!-- Widget ID (each widget will need unique ID)-->
	<div class="jarviswidget jarviswidget-color-darken" id="wid-id-001" data-widget-editbutton="false" data-widget-fullscreenbutton="true">
		<header>
			<span class="widget-icon"> <i class="fa fa-table"></i> </span>
			<h2>Buscar:</h2>
		</header>
		<!-- widget div-->
		<div class="widget-body" id="receptor">
					<form id="smart-form-register" class="form-horizontal">	
							<fieldset>
								<legend>B&uacute;squeda de Clientes</legend>
								<div class="form-group">
									<label class="col-md-2 control-label">RUT</label>
									<div class="col-md-5">
										<div>
											<input class="form-control" placeholder="Ingrese el Rut del cliente" id="rut" name="rut" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Nombre</label>
									<div class="col-md-10">
										<div>
											<input class="form-control" placeholder="Ingrese el Nombre del cliente" id="nombre" name="nombre" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-3" style="display: inline; left: 35%;">
										<div>
										<input type="button" class="form-control boton-cambio" id="botonBuscarC" name="botonBuscarC" value="Buscar Cliente" data-loading-text="Guardando..."  onClick="buscar('cliente');" />
										</div>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>B&uacute;squeda de Productos</legend>							
								<div class="form-group">
									<label class="col-md-2 control-label">Folio</label>
									<div class="col-md-10">
										<div>
											<input class="form-control" placeholder="Ingrese el Folio del producto" id="folio" name="folio" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-3" style="display: inline; left: 35%;">
										<div>
										<input type="button" class="form-control boton-cambio" id="botonBuscarP" name="botonBuscarP" value="Buscar Producto"  onClick="buscar('producto');"/>
										</div>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>B&uacute;squeda de Robos</legend>							
								<div class="form-group">
									<label class="col-md-2 control-label">Fechas<br /><span style="font-size: 8pt;">(usar formato dia/mes/año)</span></label>
									<div class="col-md-3">
										<label for="fecha_desde">Desde</label>
										<div>
											<input class="datepicker form-control" placeholder="Ingrese la Fecha Inicial" id="fecha_desde" name="fecha_desde" type="text" />
										</div>
									</div>
									<div class="col-md-3">
										<label for="fecha_hasta">Hasta</label>
										<div>
											<input class="datepicker form-control" placeholder="Ingrese la Fecha Final" id="fecha_hasta" name="fecha_hasta" type="text" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-3" style="display: inline; left: 35%;">
										<div>
										<input type="button" class="form-control boton-cambio" id="botonBuscarR" name="botonBuscarR" value="Buscar Robo" onClick="buscar('robo');"/>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
		</div>
	</div>
	<!-- end widget -->

</article>
<!-- WIDGET END -->
<!-- PAGE RELATED PLUGIN(S) -->
</div>		
<div id="recargar"></div>
<script src="<?php echo base_url('assets/js/plugin/jquery-form/jquery-form.min.js'); ?>"></script>		
<script type="text/javascript">

function buscar(tipo){
	var parametros = $('#smart-form-register').serialize();
	$.ajax({
		url: "<?php echo site_url('dashboard/getAjax/buscar/');?>" + "/" + tipo,
		data: parametros,
		type: 'post',
		beforeSend: function() {
			$('#botonRut').val('...');
		},
		success: function (response) {
			$('#receptor').html(response);
		}
	});
}
</script>
