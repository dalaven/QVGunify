<?php   
     $empresas=       array('1' => 'Nexsys',      '2' => 'Network1'  ); 
     $cargos=         array('Venta' => 'Venta',      'Preventa' => 'Preventa'  );  
    $prefijos=       array('+51' => '+51','+52' => '+52','+54' => '+54','+55' => '+55','+56' => '+56','+57' => '+57','+58' => '+58','+591' => '+591','+593' => '+593','+595' => '+595','+598' => '+598');
?>

                
<section class="portraitUse"></section>
<section class="layaout__edicionPerfil--1">
		<section class="row">
            <?=form_open_multipart('/Cliente/actualizacionDatos',array('class'=> 'edicionPerfil--form','id'=>'formregistro','name'=>'formRegistro'))?>
				<section class="small-12 medium-12 large-12 columns layaout__input--foto">
					<label for="foto" class="avatar">
						<div class="content__avatar" >
							<div class="content__avatar--dotted" id="contentVistaPrevia" style="background-image: url('<?= base_url()?>documentos/fotos/<?= $foto_perfil?>')">
                            </div>
							<i class="fa icon-unify-16" aria-hidden="true"></i>
							<label for="email" class="showError"></label>
						</div>
					</label>
					<input type="file" name="foto" id="foto" class="foto" value="Sube tu foto de perfil">
				</section>
            <span class="errorActualizacion errorRegistro"><span></span></span>
				<section class="small-12 medium-6   large-6 columns layaout__input--2">
					<article class="content--input" id="registroNombre">
						<label for="nombre">Nombre y Apellido</label>
						<input name="nombre" type="text" id="nombre" value="<?=$Nombre?>" required>
						<label for="nombre" class="showError"></label>
					</article>
				</section>
				<section class="small-12 medium-6 large-6 columns layaout__input--2">
					<article class="content--input" id="registroCedula">
						<label for="documento">Cédula</label>
						<input name="documento" type="tel" id="documento" value="<?=$Cedula?>" readonly>
						<label for="documento" class="showError"></label>
					</article>
				</section>
				<section class="small-12 medium-6 large-6 columns layaout__input--2">
					<article class="content--input" id="registroCumpleanos">
						<label for="birthday">Cumpleaños</label>
						<input name="birthday" type="date" id="birthday" required value="<?=$birthday?>" format="dd/mm/aaaa">
						<label for="birthday" class="showError"></label>
					</article>
				</section>
				<section class="small-12 medium-6 large-6 columns layaout__input--2">
					<article class="content--input" id="registroCelular">
						<label for="celular">Número Celular</label>
						<div class="group">
                            <?= form_dropdown('prefijos',$prefijos,'+57','class="prefijos" id="prefijos')?>
							<input name="celular" type="tel" id="celular" value="<?=$Celular?>" required>
						</div>
						<label for="celular" class="showError"></label>
					</article>
				</section>
				<section class="small-12 medium-6 large-6 columns layaout__input--2">
					<article class="content--input" id="registroEmpresa">
						<label for="empresa">Empresa</label>
                        <input name="empresa" type="tel" id="empresa" value="<?=$idEmpresas?>" readonly>
						<label for="empresa" class="showError"></label>
					</article>
				</section>
				<section class="small-12 medium-6 large-6 columns layaout__input--2">
					<article class="content--input " id="registroCargo">
						<label for="cargo">Cargo</label>
                        <?= form_dropdown('cargo',$cargos,$cargo,'class="" id="cargo"')?>
						<label for="cargo" class="showError"></label>
					</article>
				</section>
				<section class="small-12 medium-6 large-6 medium-centered columns layaout__input--2 end">
					<article class="content--input" id="registroPassword">
						<label for="password">Ingresa tú contraseña</label>
						<input name="password" type="password" id="password" >
						<label for="password" class="showError"></label>
					</article>
				</section>

				<section class="small-12 medium-6 large-6 medium-centered columns layaout__input--2 send">
					<input   type="submit" class="button button--1" value="¡EDITAR DATOS!">
				</section>
			</form>
		</section>
	</section>

<script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>
<script type="text/javascript">
    previewImagen();
        $(document).ready(function(){
			$("#formregistro").submit(function(e){
                e.preventDefault();
                   var fd = new FormData();
                    var file_data = $('input[type="file"]')[0].files;
                    fd.append("foto", file_data[0]);
                    var other_data = $('form').serializeArray();
                    $.each(other_data,function(key,input){
                        fd.append(input.name,input.value);
                    });
                
				$.ajax({
					url: $(this).attr("action"),
					type: $(this).attr("method"),
                    data: fd,
                    contentType: false,
                    processData: false,
                    cache: false,             
                    success:function(data){
                        $(".errorRegistro").removeClass("errorRegistro");
                        $(".showError").text("");
                        var obj = $.parseJSON(data);
                        if(obj=="1"){
                            window.location.href="<?= base_url();?>Cliente/exito/4";
                        }
                        if(obj['nombre']!=""){
                            $("#registroNombre").addClass("errorRegistro");
                            $(".showError[for='nombre']").text(obj['nombre']);
                        }
                        if(obj['birthday']!=""){
                             $("#registroCumpleanos").addClass("errorRegistro");
                            $(".showError[for='birthday']").text(obj['birthday']);
                        }
                        if(obj['cargo']!=""){
                             $("#registroCargo").addClass("errorRegistro");
                            $(".showError[for='cargo']").text(obj['cargo']);
                        }
                        if(obj['celular']!=""){
                             $("#registroCelular").addClass("errorRegistro");
                            $(".showError[for='celular']").text(obj['celular']);
                        }
                        if(obj['password']!=""){
                            $("#registroPassword").addClass("errorRegistro");
                            $(".showError[for='password']").text(obj['password']);
                        }
                        if(obj== "2"){
                             $("#registroPassword").addClass("errorRegistro");
                            $(".showError[for='password']").text("No hay cambios en los datos");
                        }
                         scrollFormularioError(); 
                    }
				});
			});
			return false;
		});
</script>

</body>
</html>