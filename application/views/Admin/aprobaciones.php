<section class="portraitUse"></section>
<section class="layaout__admin__aprobaciones--1">
			<section class="row">
                <?php 
                $suma=0;
                if($ordenes){
                    foreach($ordenes->result() as $orden){
                ?>
				<form action="" method="post" name="formAprobar" class="aprobar--form aprobarOrdenCompra" id="formOrden-<?=$orden->idOC?>">
					<section class="encabezado__aprobar">
						<section class="encabezado__avatar">
							<figure class="avatar" style="background-image: url('<?= base_url()?>documentos/fotos/<?= $orden->foto?>')">

							</figure>
						</section>
						<section class="encabezado__datos">
							<p class="paragraph">
								<strong>Orden de Compra</strong><br>
								<?= $orden->Nombre?> <br>
								<?= $orden->idEmpresas?>
							</p>
						</section>
					</section>
					<section class="datos__aprobar small-12 columns">
	<section class="small-12 medium-6 large-3 columns"><!--nuevo-->
							<label for="monto">Monto</label>
							<input type="text" name="monto" value="<?= $orden->Monto?>" readonly>
						</section>
						<section class="small-12 medium-6 large-3 columns"><!--nuevo-->
							<label for="ordendecompra">Orden de compra</label>
							<input type="text" name="ordendecompra" value="<?= $orden->numero?>" readonly>
						</section>
						<section class="small-12 medium-6 large-3 columns"><!--nuevo-->
							<label for="mayorista">Mayorista</label>
							<input type="text" name="mayorista" value="<?= $orden->Mayorista?>" readonly>
						</section>
						<section class="small-12 medium-6 large-3 columns"> <!--nuevo-->
							<label for="preventa">Preventa</label>
							<input type="text" name="preventa" value="<?= $orden->Preventa?>" readonly>
						</section>
						<article class="controls__aprobar">
							<divhref="#" onclick="cargarID(<?=$orden->idOC?>,1,'<?=$orden->Cedula?>','<?=$orden->numero?>')">
							<div id="aprobado"><i class="fa icon-unify-25"></i></div></div>
                            <div href="#" onclick="Cerrar(<?=$orden->idOC?>,1,'<?=$orden->Cedula?>','<?=$orden->numero?>')">
                            <div id="noAprobado"><i class="fa icon-unify-3"></i></div></div>
						</article>
					</section>
                    <?=form_hidden('id',$orden->idOC)?>
				</form>
                <?php  }}else{$suma=$suma+1;} ?>
                <?php if($oportunidades){
                    foreach($oportunidades->result() as $oportunidad){
                ?>
				<form action="" method="post" name="formAprobar" class="aprobar--form aprobarOportunidad" id="formLeads-<?=$oportunidad->idOpor?>">
					<section class="encabezado__aprobar">
						<section class="encabezado__avatar">
							<figure class="avatar"style="background-image: url('<?= base_url()?>documentos/fotos/<?= $oportunidad->foto?>')">

							</figure>
						</section>
						<section class="encabezado__datos">
							<p class="paragraph">
								<strong>OPORTUNIDAD</strong><br>
								<?= $oportunidad->Nombre?> <br>
								<?= $oportunidad->idEmpresas?>
							</p>
						</section>
					</section>
                    <section class="datos__aprobar small-12 columns"><!--nuevo-->
						<section class="small-12 medium-6 large-3 columns"><!--nuevo-->
							<label for="monto">Monto</label>
							<input type="text" name="monto"value="<?= $oportunidad->Monto?>" readonly>
						</section>

						<section class="small-12 medium-6 large-3 columns"><!--nuevo-->
							<label for="nombrecliente">Nombre de cliente</label>
							<input type="text" name="nombrecliente"value="<?= $oportunidad->Cliente?>" readonly>
						</section>

						<section class="small-12 medium-6 large-3 columns"><!--nuevo-->
							<label for="nombreoportunidad">Nombre de oportunidad</label>
							<input type="text" name="nombreoportunidad"value="<?= $oportunidad->Oportunidad?>" readonly>
						</section>

						<section class="small-12 medium-6 large-3 columns"><!--nuevo-->
							<label for="preventa">Preventa</label>
							<input type="text" name="preventa"value="<?= $oportunidad->Preventa?>" readonly>
						</section>
						<article class="controls__aprobar">
                            <?php if($oportunidad->Monto >=20000){?>
                            <div class="validar" href="#" onclick="cargarID(<?=$oportunidad->idOpor?>,2,'<?= $oportunidad->Cedula?>','<?= $oportunidad->Oportunidad?>')" ><div id="aprobado"><i class="fa icon-unify-25"></i></div></div>
                            <?php }?>
                            
                            <div class="validar" href="#" onclick="Cerrar(<?=$oportunidad->idOpor?>,2,'<?= $oportunidad->Cedula?>','<?= $oportunidad->Oportunidad?>')" ><div id="noAprobado"><i class="fa icon-unify-3"></i></div></div>
						</article>
					</section>
                    <?=form_hidden('id',$oportunidad->idOpor)?>
				</form> 
                <?php        
                }}else{$suma=$suma+1;}?>
                
                <?php if($eventos){
                    foreach($eventos->result() as $evento){
                ?>
				<form action="" method="post" name="formAprobar" class="aprobar--form aprobarEvento" id="formEvento-<?=$evento->idEvento?>">
					<section class="encabezado__aprobar">
						<section class="encabezado__avatar">
							<figure class="avatar" style="background-image: url('<?= base_url()?>documentos/fotos/<?= $evento->foto?>')">

							</figure>
						</section>
						<section class="encabezado__datos">
							<p class="paragraph">
								<strong>Evento</strong><br>
								<?= $evento->Nombre?><br>
                                <?= $evento->idEmpresas?>
							</p>
						</section>
					</section>
					<section class="datos__aprobar">
                        <section class="small-12 medium-4 large-4 columns"><!--nuevo-->
							<label for="fecha">Fecha</label>
							<input type="date" name="fecha" value="<?= $evento->Fecha?>" readonly>
						</section>

						<section class="small-12 medium-4 large-4 columns"><!--nuevo-->
							<label for="nombreevento">Nombre de evento</label>
							<input type="text" name="nombreevento" value="<?= $evento->Evento?>" readonly>
						</section>

						<section class="small-12 medium-4 large-4 columns"><!--nuevo-->
							<label for="mayorista">Mayorista</label>
							<input type="text" name="mayorista" value="<?= $evento->Mayorista?>" readonly>
						</section>
						<article class="controls__aprobar">
							
							
                            <div class="validar" href="#" onclick="cargarID(<?=$evento->idEvento?>,3,'<?=$evento->Cedula?>','<?=$evento->Evento?>')" ><div id="aprobado"><i class="fa icon-unify-25"></i></div></div>       
                            <div class="validar" href="#" onclick="Cerrar(<?=$evento->idEvento?>,3,'<?=$evento->Cedula?>','<?=$evento->Evento?>')" ><div id="noAprobado"><i class="fa icon-unify-3"></i></div></div>
    
						</article>
					</section>
				</form>
                <?php        
                    }}else{$suma=$suma+1;}?>
                <?php if($certificados){ 
                    foreach($certificados->result() as $certificado){
                ?>
                <form action="" method="post" name="formAprobar" class="aprobar--form aprobarCertificacion" id="formCerti-<?=$certificado->id_certificado?>">
					<section class="encabezado__aprobar">
						<section class="encabezado__avatar">
							<figure class="avatar"style="background-image: url('<?= base_url()?>documentos/fotos/<?= $certificado->foto?>')">

							</figure>
						</section>
						<section class="encabezado__datos">
                            
							<p class="paragraph">
								<strong>Certificacion</strong><br>
								<?= $certificado->Nombre?><br>
                                <?= $certificado->idEmpresas?>
							</p>
						</section>
					</section>
					<section class="datos__aprobar">
                        
                        <div class="label--icon">
							<i class="fa icon-unify-24"></i>
							<a href="<?=base_url();?>documentos/certificaciones/<?=$certificado->Ruta ?>" download><input type="text" name="monto" value="<?=$certificado->Ruta ?>" readonly></a>
						</div>
						<article class="controls__aprobar">
                            <div class="validar" href="#" onclick="cargarID(<?=$certificado->id_certificado?>,4,<?= $certificado->Cedula?>,'<?=$certificado->Ruta;?>')" ><div id="aprobado" ><i class="fa icon-unify-25"></i></div></div>
                            <div class="validar" href="#" onclick="Cerrar(<?=$certificado->id_certificado?>,4,<?= $certificado->Cedula?>,'<?=$certificado->Ruta?>')" ><div id="noAprobado"><i class="fa icon-unify-3"></i></div> </div>
						</article>
					</section>
				</form>
        <?php  }}else{$suma=$suma+1;};?>
                
                <section class="small-12 columns text-center aprobacionesCompletas">
					<p class="paragraph">
						Estás al día <i class="fa fa-smile-o" aria-hidden="true"></i>
					</p>
				</section>
			</section>
		</section>
<script type="text/javascript" src="<?=base_url();?>assets/js/core.min.js"></script>
<script type="text/javascript">
    sum="<?php echo $suma?>";
    if(sum=="4"){
        $('.aprobacionesCompletas').css("display","block");
    }
    function cargarID(id,tipo,cedula,nombre){
        
        if(tipo == "1")
        $('#formOrden-'+id+' .controls__aprobar').remove();
        if(tipo == "2")
        $('#formLeads-'+id+' .controls__aprobar').remove();
        if(tipo == "3")
        $('#formEvento-'+id+' .controls__aprobar').remove();
        if(tipo == "4")
        $('#formCerti-'+id+' .controls__aprobar').remove();
        if(id) {
            if(tipo) {
                var parametros = {
                    "id" : id,
                    "tipo" : tipo,
                    "cedula" : cedula,
                    "nombre" : nombre
                };
                //alert(parametros.id+" "+parametros.cedula+" "+parametros.nombre);
                $.ajax({
                        
                        type:'POST', 
                        data: parametros,
                        url:'<?php echo base_url().'Admin/aceptar';?>',
                    cache:false,
                        beforeSend: function () {
                             showPrecarga();
                        },
                        success:function(data){
                            hidePrecarga();
                            // alert(data);
                            if(tipo == "1")
                                $('#formOrden-'+id).animate({left: "-100%", "opacity" : "0"}, 1000,'easeInOutExpo', function(){$(this).remove();});
                            if(tipo == "2")
                                $('#formLeads-'+id).animate({left: "-100%", "opacity" : "0"}, 1000,'easeInOutExpo', function(){$(this).remove();});
                            if(tipo == "3")
                                $('#formEvento-'+id).animate({left: "-100%", "opacity" : "0"}, 1000,'easeInOutExpo', function(){$(this).remove();});
                            if(tipo == "4")
                                $('#formCerti-'+id).animate({left: "-100%", "opacity" : "0"}, 1000,'easeInOutExpo', function(){$(this).remove();});

                        }
                });
            }

        }
    }  
    function Cerrar(id,tipo,cedula,nombre){
        if(tipo == "1")
        $('#formOrden-'+id+' .controls__aprobar').remove();
        if(tipo == "2")
        $('#formLeads-'+id+' .controls__aprobar').remove();
        if(tipo == "3")
        $('#formEvento-'+id+' .controls__aprobar').remove();
        if(tipo == "4")
        $('#formCerti-'+id+' .controls__aprobar').remove();
        if(id) {
            if(tipo) {
                var parametros = {
                    "id" : id,
                    "tipo" : tipo,
                    "cedula" : cedula,
                    "nombre" : nombre
                };
                $.ajax({
                        url:'<?php echo base_url().'Admin/denegar';?>',
                        type:"POST",
                        data: parametros,
                    cache:false,
                        beforeSend: function () {
                             showPrecarga();
                        },
                        success:function(data){
                            hidePrecarga();
                            if(tipo == "1")
                                $('#formOrden-'+id).animate({left: "-100%", "opacity" : "0"}, 1000,'easeInOutExpo', function(){$(this).remove();});
                            if(tipo == "2")
                                $('#formLeads-'+id).animate({left: "-100%", "opacity" : "0"}, 1000,'easeInOutExpo', function(){$(this).remove();});
                            if(tipo == "3")
                                $('#formEvento-'+id).animate({left: "-100%", "opacity" : "0"}, 1000,'easeInOutExpo', function(){$(this).remove();});      
                            if(tipo == "4")
                                $('#formCerti-'+id).animate({left: "-100%", "opacity" : "0"}, 1000,'easeInOutExpo', function(){$(this).remove();});
                        }
                });
            }

        }
    } 
</script>