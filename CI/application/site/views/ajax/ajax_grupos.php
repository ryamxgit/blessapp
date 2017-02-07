<!-- MAIN CONTENT -->
<div id="content">
	<div class="row">
		<!-- col -->
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			<h1 class="page-title txt-color-blueDark">
				<i class="fa-fw fa fa-home"></i> 
					Inicio 
				<span>>  
					Grupos
				</span>
			</h1>
		</div>
		{GRAFICASRIBBON}
	</div>
	<section id="widget-grid" class="">
		<div class="row">
			<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="jarviswidget" id="wid-id-02222" data-widget-colorbutton="false"	data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false" >
					<header>
						<span class="widget-icon"> <i class="fa fa-comments"></i> </span>
						<h2>Grupos</h2>				
					</header>
					<div>
						<div class="jarviswidget-editbox">
							<input class="form-control" type="text">	
						</div>
						<div class="widget-body no-padding">
							<!-- this is what the user will see -->
							<table id="datatable_fixed_column"  class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th class="hasinput" style="width:16%">
										<input type="text" class="form-control" placeholder="Nombre" />
									</th>
									<th class="hasinput" style="width:16%">
										<input type="text" class="form-control" placeholder="Descripción" />
									</th>
									<th class="hasinput" style="width:16%">
									</th>
								</tr>
								<tr>
									<th>Nombre</th>
									<th>Descripci&oacute;n</th>
									<th>Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($groups as $gr):?>		
							   <tr>
								<?php echo "<td>" . $gr['name'] . "</td><td>". $gr['description'] . "</td>"; ?>
								 <td>
									<input type="hidden" name="nombre_<?php echo $gr['id'];?>" id="nombre_<?php echo $gr['id'];?>" value="<?php echo $gr['name'];?>">
									<?php echo "<nav>";
                                                                                echo "<a href='getAjax/editarGrupo/".$gr['id']. "' style='float: left; padding-left: 30px;'> Editar </a>";
                                                                                echo "<a href='#' onclick=\"eliminarGrupo(".$gr['id'].");\" style='float: right; padding-right: 30px;'> Eliminar </a>";
                                                                                echo "</nav>";?> 
								</td>
							   </tr>
							<?php endforeach;?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</article>
		</div>
	</section>
	<!-- end widget grid -->
</div>
<!-- END MAIN CONTENT -->
		<script src="<?php echo base_url('assets/js/plugin/datatables/jquery.dataTables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.colVis.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.tableTools.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	pageSetUp();
	/* BASIC ;*/
	$('#dt_basic').dataTable();
	/* END BASIC */
	
	/* COLUMN FILTER  */
    var otable = $('#datatable_fixed_column').DataTable({
    	//"bFilter": false,
    	//"bInfo": false,
    	//"bLengthChange": false
    	//"bAutoWidth": false,
    	//"bPaginate": false,
    	//"bStateSave": true // saves sort state using localStorage
		"sDom": "<'dt-toolbar'<'col-xs-6'f><'col-xs-6'<'toolbar'>>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-xs-6'i><'col-xs-6'p>>"
    });
    // custom toolbar
    $("div.toolbar").html('<div class="text-right"><nav><a href="getAjax/crearUsuario">Crear nuevo usuario</a> | <a href="getAjax/crearGrupo">Crear nuevo grupo</a></nav></div>');
    	   
    // Apply the filter
    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
    	
        otable
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
            
    } );

    /* END COLUMN FILTER */   

	/* COLUMN SHOW - HIDE */
	$('#datatable_col_reorder').dataTable({
		"sDom": "<'dt-toolbar'<'col-xs-6'f><'col-xs-6'C>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-xs-6'i><'col-xs-6'p>>"
	});
	
	/* END COLUMN SHOW - HIDE */

	/* TABLETOOLS */
	$('#datatable_tabletools').dataTable({
		
		// Tabletools options: 
		//   https://datatables.net/extensions/tabletools/button_options
		"sDom": "<'dt-toolbar'<'col-xs-6'f><'col-xs-6'T>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-xs-6'i><'col-xs-6'p>>",
        "oTableTools": {
        	 "aButtons": [
             "copy",
             "csv",
             "xls",
                {
                    "sExtends": "pdf",
                    "sTitle": "SmartAdmin_PDF",
                    "sPdfMessage": "GQTech PDF Export",
                    "sPdfSize": "letter"
                },
             	{
                	"sExtends": "print",
                	"sMessage": "Generated by GQTech <i>(press Esc to close)</i>"
            	}
             ],
            "sSwfPath": "assests/js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
        }
	});
	/* END TABLETOOLS */
</script>
<div id="infoMessage"><?php echo $message;?></div>
<!-- msg eliminar usuario -->
<div id="dialog_elimina_grupo" title="Eliminar Grupo" style="display:none;font-size: 13px;overflow-y:hidden">
    <form id="frm_elimina" name="frm_elimina" action="<?php echo base_url('dashboard/getAjax/eliminarGrupo'); ?>" method="post">
        <input type="hidden" name="id_group_elimina" id="id_group_elimina" value="">
        <br/><p id="msg_group_elimina" style="float:left"></p>&nbsp; será Eliminado. Esta seguro?
    </form>
</div>
<div id="dialog_error_elimina" title="Error en Proceso" style="display: none;font-size: 13px">
    <br />
    Intente nuevamente m&aacute;s tarde.
</div>
