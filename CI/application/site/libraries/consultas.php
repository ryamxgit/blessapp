<?php
class Consultas {
   public function consultas()
   {
      $ci =& get_instance();
      $ci->sql = array();
      $ci->sql['s_topmenu'] = "SELECT titulo, link FROM topmenu ORDER BY 1;";
      $ci->sql['s_terapias'] = "SELECT idt as id,nombre,valor,duracion,link FROM terapias; ";
      $ci->sql['s_terapeuta'] = "SELECT id, nombre FROM terapeutas; ";
      $ci->sql['s_pivote'] = "SELECT * FROM nxm_pivote ORDER BY idt, prioridad; ";
      $ci->sql['i_cita'] = "INSERT INTO citas (nombre,mail,telefono,terapia,terapeuta,hora,comentario) VALUES (?,?,?,?,?,?,?); ";
      
   }

}
