<!-- MAIN CONTENT -->
<div id="content">
	<div class="row">
		<!-- col -->
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
			<h1 class="page-title txt-color-blueDark">
				<i class="fa-fw fa fa-home"></i> 
					Inicio 
				<span>>  
					Usuarios
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
						<h2>Usuarios</h2>				
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
										<input type="text" class="form-control" placeholder="Apellido" />
									</th>
									<th class="hasinput" style="width:16%">
										<input type="text" class="form-control" placeholder="Correo" />
									</th>
									<th class="hasinput" style="width:16%">
										<input type="text" class="form-control" placeholder="Grupos" />
									</th>
									<th class="hasinput" style="width:16%">
										<input type="text" class="form-control" placeholder="Estado" />
									</th>
									<th class="hasinput" style="width:16%">
									</th>
								</tr>
								<tr>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Correo</th>
									<th>Grupos</th>
									<th>Estado</th>
									<th>Acci&oacute;n</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($users as $user):?>
								<tr>
									<td><?php echo $user->first_name;?></td>
									<td><?php echo $user->last_name;?></td>
									<td><?php echo $user->email;?></td>
									<td>
										<?php foreach ($user->groups as $group):?>
											<?php echo "<a href='getAjax/editGrupo/".$group->id."'> ". $group->name . "</a>" ;?><br />
						                <?php endforeach?>
									</td>
									<td>
										<input type="hidden" name="nombre_<?php echo $user->id;?>" id="nombre_<?php echo $user->id;?>" value="<?php echo $user->first_name.' '.$user->last_name;?>">
										<!--<?php //echo ($user->active) ? "<a href='getAjax/desactivarUsuario/".$user->id."'> Desactivar </a>" : "<a href='getAjax/activarUsuario/".$user->id."'> Activar </a>";?>-->
										<?php echo ($user->active) ? '<button class="btn btn-link" onclick="deactivateUsuario('.$user->id.');" type="button">Desactivar</button>' : '<button class="btn btn-link" onclick="activateUsuario('.$user->id.');" type="button">Activar</button>'?>
									</td>
									<td>
										<?php echo "<nav>";
										echo "<a href='getAjax/editarUsuario/".$user->id. "' style='float: left; padding-left: 20px;'> Editar </a>";
										echo "<a href='#' onclick=\"eliminarUsuario(".$user->id.");\" style='float: right; padding-right: 20px;'> Eliminar </a>";
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
<div id="dialog_deactivate" title="Desactivar Usuario" style="display:none;font-size: 13px;overflow-y:hidden">    
    <form id="frm_deactivate" name="frm_deactivate" action="<?php echo base_url('dashboard/getAjax/desactivarUsuario'); ?>" method="post">      
        <input type="hidden" name="id_user" id="id_user" value="">
        <br/><p id="msg_user" style="float:left"></p>&nbsp; será desactivado. Esta seguro?        
    </form>
</div>
<div id="dialog_error" title="Error en Proceso" style="display: none;font-size: 13px">
    <br />
    Intente nuevamente m&aacute;s tarde. 
</div>

<form id="frm_activate" name="frm_activate" action="<?php echo base_url('dashboard/getAjax/activarUsuario'); ?>" method="post">      
    <input type="hidden" name="id_user_activa" id="id_user_activa" value="">    
</form>    
<div id="dialog_error_activa" title="Error en Proceso" style="display: none;font-size: 13px">
	<br/>
	Intente nuevamente m&aacute;s tarde. 
</div>	

<!-- msg eliminar usuario -->
<div id="dialog_elimina_usuario" title="Eliminar Usuario" style="display:none;font-size: 13px;overflow-y:hidden">    
    <form id="frm_elimina" name="frm_elimina" action="<?php echo base_url('dashboard/getAjax/eliminarUsuario'); ?>" method="post">      
        <input type="hidden" name="id_user_elimina" id="id_user_elimina" value="">
        <br/><p id="msg_user_elimina" style="float:left"></p>&nbsp; será Eliminado. Esta seguro?        
    </form>
</div>
<div id="dialog_error_elimina" title="Error en Proceso" style="display: none;font-size: 13px">
    <br />
    Intente nuevamente m&aacute;s tarde. 
</div>
