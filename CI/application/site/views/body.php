<input type="hidden" id="siteurl" value="{site_url}" />
<input type="hidden" id="uribase" value="{uribase}" />
<div id="topbody">
<div class="ViewHeader">
	<div class="ViewHeaderTitle">
		<div class="FormviewerHeaderTitle" dir="auto" role="heading" aria-level="1">
		&iexcl;Bienvenid@ a nuestro sistema unificado de toma de horas de Centro Bless!
		</div>
	</div>
	<div class="ViewHeaderDescription" dir="auto">
		Para solicitar una terapia con nosotros, por favor llena los campos solicitados y tu hora te ser&aacute; confirmada por tel&eacute;fono y/o e-mail.  Aseg&uacute;rate de que queden bien ingresados, porque es la &uacute;nica forma que tenemos para responderte.  
		<p>&iexcl;Te esperamos!</p>
		<p></p>
		<p></p>
	</div>
</div>
<br />
<br />
<form name="formdefault" method="post" action="/{uribase}/save">
	   {tabla_datos}
		<p>{text}</p>
		<p>{input}</p>
	   {/tabla_datos}
	</form>
</div> <!-- end topbody -->
<div id="ghostbox"></div>
<script language="javascript">
	var pivotes = {tabla_pivote};
	var personas = {tabla_terapeutas};
</script>
