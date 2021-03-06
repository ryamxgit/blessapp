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
					<h2>Detalle Folios</h2>
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
						<table id="datatable_fixed_column"  class="table table-striped table-bordered table-hover" width="100%">
							<thead>
								<tr>
									<th class="hasinput" style="width:6%">
										<input type="text" class="form-control" placeholder="Folio" />
									</th>
									<th class="hasinput" style="width:16%">
										<input type="text" class="form-control" placeholder="Tipo Producto" />
									</th>
									<th class="hasinput" style="width:16%">
										<input type="text" class="form-control" placeholder="Descripción" />
									</th>
									<th class="hasinput" style="width:16%">
										<input type="text" class="form-control" placeholder="Estado" />
									</th>
									<th class="hasinput" style="width:16%">
										<input type="text" class="form-control" placeholder="Rut Cliente" />
									</th>
									<th class="hasinput" style="width:16%">
										<input type="text" class="form-control" placeholder="Nombre Cliente" />
									</th>
								</tr>
								<!--  table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
							<thead -->
							<tr>
								<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Folio </th>
								<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Tipo Producto</th>
								<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Descripción </th>
								<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Estado </th>
								<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Rut Cliente</th>
								<th><i class="fa fa-fw text-muted hidden-md hidden-sm hidden-xs"></i> Nombre Cliente</th>
							</tr>
							</thead>
							<tbody id="tabloide">
								{datos}
							</tbody>
						</table>							
					</div>

</article>
<!-- PAGE RELATED PLUGIN(S) -->

		<script src="<?php echo base_url('assets/js/plugin/datatables/jquery.dataTables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.colVis.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.tableTools.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/plugin/datatables/dataTables.bootstrap.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/plugin/jquery-form/jquery-form.min.js'); ?>"></script>		
<script type="text/javascript">

$(document).ready(function() {
	pageSetUp();

	$('#dt_basic').dataTable();
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
});    	
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
