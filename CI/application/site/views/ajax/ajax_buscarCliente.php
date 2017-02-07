<div class="row">
<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="widget-body no-padding">
					<!-- this is what the user will see -->
					<table id="datatable_fixed_column"  class="table table-striped table-bordered table-hover" width="100%">
					<thead>
						<tr>
							<th class="hasinput" style="width:8%">
								<input type="text" class="form-control" placeholder="RUT" />
							</th>
							<th class="hasinput" style="width:24%">
								<input type="text" class="form-control" placeholder="Nombre" />
							</th>
							<th class="hasinput" style="width:24%">
								<input type="text" class="form-control" placeholder="Paterno" />
							</th>
							<th class="hasinput" style="width:24%">
								<input type="text" class="form-control" placeholder="Email" />
							</th>
							<th></th>
						</tr>
				<!--  table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
					<thead -->
						<tr>
							<th>RUT</th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Nombre </th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Paterno</th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Email</th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Ver Productos </th>
						</tr>
					</thead>
					<tbody id="tabloide">
					<?php foreach ($clientes as $c) { ?>
						<tr>
							<td><?php echo $c['rut'];?></td>
							<td><?php echo $c['nombre'];?></td>
							<td><?php echo $c['paterno'];?></td>
							<td><?php echo $c['email'];?></td>
							<?php if ($c['sin_producto']) { ?>
								<td align="center">- Sin Productos -</td>								
							<?php }
							else { 
							?>
								<td align="center"><button class="btn fileinput-button" type="button" data-toggle="modal" data-target="#modal<?php echo $c['rut'];?>"><i class='fa fa-fw fa-eye '></i></button></td>
							<?php } ?>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
</article>
<!-- WIDGET END -->
<!-- PAGE RELATED PLUGIN(S) -->
</div>
<?php foreach ($productos as $rut => $p) { ?>
<div class="modal" style="display: none;" id="modal<?php echo $rut;?>">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Productos</h4>
        </div>
        <div class="modal-body">
        	<table class="table table-striped table-bordered table-hover" width="100%">
        		<tr>
	        		<th>Nombre Kit</th>
	        		<th>Folio</th>
	        		<th>Clave Activaci&oacute;n</th>
	        	</tr>
	        	<?php foreach ($p as $detalle) { ?>
	        	<tr>
	        		<td><?php echo $detalle['nombre_kit'];?></td>
	        		<td><?php echo $detalle['folio'];?></td>
	        		<td><?php echo $detalle['clave_activacion'];?></td>
	        	</tr>
	        	<?php } ?>
        	</table>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
        </div>
      </div>
    </div>
</div>
<?php } ?>
		<script src="<?php echo base_url('assets/js/plugin/datatables/jquery.dataTables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.colVis.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.tableTools.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.bootstrap.min.js'); ?>"></script>
		<script type="text/javascript">

		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();
			
			/* // DOM Position key index //
			
				l - Length changing (dropdown)
				f - Filtering input (search)
				t - The Table! (datatable)
				i - Information (records)
				p - Pagination (paging)
				r - pRocessing 
				< and > - div elements
				<"#id" and > - div with an id
				<"class" and > - div with a class
				<"#id.class" and > - div with an id and class
				
				Also see: http://legacy.datatables.net/usage/features
			*/	
	
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
		    //$("div.toolbar").html('<div class="text-right"><nav><a href="getAjax/crearRobo">Reportar nuevo Robo</a></nav></div>');
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

		})

		</script>