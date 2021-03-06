<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>> <?php echo $nombrePerfil;?></span></h1>
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
			<h2>Robos ingresados</h2>
		</header>
		<!-- widget div-->
		<div>
		<?php if ($hayDatos) { ?>
			<!-- widget edit box -->
			<div class="jarviswidget-editbox">
				<!-- This area used as dropdown edit box -->
				<input class="form-control" type="text">	
			</div>
			<!-- end widget edit box -->
			<!-- widget content -->
			<div class="widget-body no-padding">
					<!-- this is what the user will see -->
					<table id="datatable_fixed_column"  class="table table-striped table-bordered table-hover" width="100%">
					<thead>
						<tr>
							<th class="hasinput" style="width:8%">
								<input type="text" class="form-control" placeholder="RUT" />
							</th>
							<th class="hasinput" style="width:14%">
								<input type="text" class="form-control" placeholder="Nombre" />
							</th>
							<th class="hasinput" style="width:14%">
								<input type="text" class="form-control" placeholder="Email" />
							</th>
							<th class="hasinput" style="width:14%">
								<input type="text" class="form-control" placeholder="Telefono" />
							</th>
							<th class="hasinput" style="width:14%">
								<input type="text" class="form-control" placeholder="Folio" />
							</th>
							<th class="hasinput" style="width:14%">
								<input type="text" class="form-control" placeholder="Fecha Robo" />
							</th>
							<th class="hasinput" style="width:14%">
								<input type="text" class="form-control" placeholder="Estado" />
							</th>
							<th></th>
						</tr>
				<!--  table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
					<thead -->
						<tr>
							<th>RUT</th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Nombre </th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Email</th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Tel&eacute;fono</th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Folio</th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Fecha Robo</th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Estado</th>
							<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Acci&oacute;n </th>
						</tr>
					</thead>
					<tbody id="tabloide">
						{datos}
					</tbody>
				</table>
			</div>
			<!-- end widget content -->
		</div>
		<!-- end widget div -->
		<?php }
		elseif (!$esFiscal) { 
		?>
		<div class="text-right"><nav><a href="<?php echo site_url('dashboard/getAjax/crearRobo');?>">Reportar nuevo Robo</a></nav></div>
		<?php } ?>
	</div>
	<!-- end widget -->

</article>
<!-- WIDGET END -->
<!-- PAGE RELATED PLUGIN(S) -->
</div>		
<div id="recargar"></div>
<?php if ($hayDatos) { ?>
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
			
			$('#dt_basic').dataTable({"bAutoWidth": false});
	
			
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
		    <?php if (!$esFiscal) { ?>
		    $("div.toolbar").html('<div class="text-right"><nav><a href="getAjax/crearRobo">Reportar nuevo Robo</a></nav></div>');
		    <?php } ?>
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
<?php } ?>
