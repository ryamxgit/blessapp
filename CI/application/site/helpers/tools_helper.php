<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Forzar guion en RUT 
 *
 * @access	public
 * @return	bool
 */
if ( ! function_exists('forzarGuionRUT'))
{
	function forzarGuionRUT($rut_string)
	{
 		$rut = str_replace( array(".","-"), "", $rut_string ); 
		$rut = substr( $rut, 0, -1 ) . '-' . substr( $rut, -1 );
		return $rut; 
	}
}


/* End of file tools.php */
/* Location: ./application/dashboard/helpers/tools_helper.php */
?>
