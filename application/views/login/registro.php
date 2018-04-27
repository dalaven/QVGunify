<?php 
$empresas=       array('' => 'Seleccione una', 
'AP INGENIERIA'=>'AP INGENIERIA',
'BBC TELECOMUNICACIONES '=>'BBC TELECOMUNICACIONES ',
'BIDDA'=>'BIDDA',
'YEAPDATA SAS' =>'YEAPDATA SAS' ,
'DISTRIBUCIONES BOGOTA'=>'DISTRIBUCIONES BOGOTA',
'ELECTROCOM S.A.S.'=>'ELECTROCOM S.A.S.',
'GLOBAL TECHNOLOGY SERVICES GTS S.A.'=>'GLOBAL TECHNOLOGY SERVICES GTS S.A.',
'INTERGRUPO'=>'INTERGRUPO',
'INTELCOL'=>'INTELCOL',
'INTERNEXA'=>'INTERNEXA',
'JOBI TECHNOLOGY'=>'JOBI TECHNOLOGY',
'CELEC SOLUTIONS'=>'CELEC SOLUTIONS',
'OESIA COLOMBIA S.A.'=>'OESIA COLOMBIA S.A.',
'REPRESENTACTIONES DYM'=>'REPRESENTACTIONES DYM',
'KMALA NETWORKS'=>'KMALA NETWORKS',
'SERTEL'=>'SERTEL',
'TERASYS'=>'TERASYS',
'TIC & TIC'=>'TIC & TIC',
'TICBRIDGE'=>'TICBRIDGE',
'KAPTA TECNOLOGIA'=>'KAPTA TECNOLOGIA',
'Unify'=>'Unify',
'Quevisiongrafica'=>'Quevisiongrafica'); 
$attrib = array(
        '' => 'id="empresa-0"', 
        'AP INGENIERIA'=>'id="empresa-1"',
        'BBC TELECOMUNICACIONES '=>'id="empresa-2"',
        'BIDDA'=>'id="empresa-3"',
        'YEAPDATA SAS' =>'id="empresa-4"' ,
        'DISTRIBUCIONES BOGOTA'=>'id="empresa-5"',
        'ELECTROCOM S.A.S.'=>'id="empresa-6"',
        'GLOBAL TECHNOLOGY SERVICES GTS S.A.'=>'id="empresa-7"',
        'INTERGRUPO'=>'id="empresa-8"',
        'INTELCOL'=>'id="empresa-9"',
        'INTERNEXA'=>'id="empresa-10"',
        'JOBI TECHNOLOGY'=>'id="empresa-11"',
        'CELEC SOLUTIONS'=>'id="empresa-12"',
        'OESIA COLOMBIA S.A.'=>'id="empresa-13"',
        'REPRESENTACTIONES DYM'=>'id="empresa-14"',
        'KMALA NETWORKS'=>'id="empresa-15"',
        'SERTEL'=>'id="empresa-16"',     
        'TERASYS'=>'id="empresa-17"',
        'TIC & TIC'=>'id="empresa-18"',
        'TICBRIDGE'=>'id="empresa-19"',
        'KAPTA TECNOLOGIA'=>'id="empresa-20"',
        'Unify'=>'id="empresa-21"',
        'Quevisiongrafica'=>'id="empresa-22"'
);
$cargos=         array('' => 'Seleccione uno', 'Preventa' => 'Preventa',      'Venta' => 'Venta'  ); 
$prefijos=       array('+51' => '+51','+52' => '+52','+54' => '+54','+55' => '+55','+56' => '+56','+57' => '+57','+58' => '+58','+591' => '+591','+593' => '+593','+595' => '+595','+598' => '+598')
?>

<section class="portraitUse"></section>
<header class="header--harmonize">
	<img src="<?= base_url();?>assets/images/site/header/logo__unify--harmonize.jpg" alt="Unify">
</header>

		<section class="layaout__registro--1"></section>
		<section class="layaout__registro--2">
            <section class="row">
            <?=form_open_multipart('/Login/registrarUsuario',array('class'=> 'registro--form','id'=>'formregistro','name'=>'formRegistro'))?>
			
				<section class="layaout__registro--white">
					<section class="small-12 medium-5 large-4 columns layaout__input--foto">
						<label for="foto" class="avatar">
							<div class="content__avatar" id="contentVistaPrevia" >
								<div class="content__avatar--dotted" id="vista_previa">
									Sube tu foto de perfil
								</div>
								<i class="fa icon-unify-5" aria-hidden="true"></i>
							</div>
						</label>
						<input type="file" name="foto" id="foto" class="foto" value="Sube tu foto de perfil">
                        <label for="foto" class="showError"></label>
					</section>
					<section class="small-12 medium-7 large-8 columns layaout__input--1 end">
						<figure class="icon--input">
							<i class="fa icon-unify-6" aria-hidden="true"></i>
						</figure>
						<article class="content--input " id="registroNombre">
							<label for="nombre">Nombre y Apellido</label>
							<input name="nombre" type="text" id="nombre" value="<?= set_value('nombre'); ?>">
							<label for="nombre" class="showError"></label>
						</article>
					</section>
					<section class="small-12 medium-7 large-8  columns layaout__input--1 end">
						<figure class="icon--input">
							<i class="fa icon-unify-7" aria-hidden="true"></i>
						</figure>
						<article class="content--input" id="registroCedula">
							<label for="documento">Cédula</label>
							<input name="documento" type="tel" id="documento" value="<?= set_value('documento'); ?>" >
							<label for="documento" class="showError"></label>
						</article>
					</section>
                    <section class="small-12 medium-7 large-8 medium-push-5 large-push-4  columns layaout__input--1 end">
							<figure class="icon--input">
								<i class="fa fa-university" aria-hidden="true"></i>
							</figure>
							<article class="content--input " id="registroEmpresa">
								<label for="empresa">Empresa</label>
								<?//= form_dropdown('empresa',$empresas,'','id="empresa"',$attrib)?>
                                <select name="empresa" id="empresa" >
<option value="" selected="selected" id="empresa-0">Seleccione una</option>
<option value="AP INGENIERIA" id="empresa-1">AP INGENIERIA</option>
<option value="BBC TELECOMUNICACIONES "id="empresa-2">BBC TELECOMUNICACIONES </option>
<option value="BIDDA" id="empresa-3">BIDDA</option>
<option value="YEAPDATA SAS" id="empresa-4">YEAPDATA SAS</option>
<option value="DISTRIBUCIONES BOGOTA" id="empresa-5">DISTRIBUCIONES BOGOTA</option>
<option value="ELECTROCOM S.A.S." id="empresa-6">ELECTROCOM S.A.S.</option>
<option value="GLOBAL TECHNOLOGY SERVICES GTS S.A." id="empresa-7">GLOBAL TECHNOLOGY SERVICES GTS S.A.</option>
<option value="INTERGRUPO" id="empresa-8">INTERGRUPO</option>
<option value="INTELCOL" id="empresa-9">INTELCOL</option>
<option value="JOBI TECHNOLOGY" id="empresa-10">JOBI TECHNOLOGY</option>
<option value="CELEC SOLUTIONS" id="empresa-11">CELEC SOLUTIONS</option>
<option value="OESIA COLOMBIA S.A." id="empresa-12">OESIA COLOMBIA S.A.</option>
<option value="REPRESENTACTIONES DYM" id="empresa-13">REPRESENTACTIONES DYM</option>
<option value="KMALA NETWORKS" id="empresa-14">KMALA NETWORKS</option>
<option value="SERTEL" id="empresa-15">SERTEL</option>
<option value="TERASYS" id="empresa-16">TERASYS</option>
<option value="TIC &amp; TIC" id="empresa-17">TIC &amp; TIC</option>
<option value="TICBRIDGE" id="empresa-18">TICBRIDGE</option>
<option value="KAPTA TECNOLOGIA" id="empresa-19">KAPTA TECNOLOGIA</option>
<option value="UNIFY" id="empresa-20">UNIFY</option>
<option value="Que Vision Grafica" id="empresa-21">Que Vision Grafica</option>
</select>
                                
                                
                                
                                
								<label for="empresa" class="showError"></label>
							</article>
						</section>
				</section>
				<section class="layaout__registro--dark">
					<i class="fa icon-unify-9 icono--cofee" aria-hidden="true"></i>
					<section class="small-12 medium-6 large-6 columns layaout__input--2">
						<article class="content--input" id="registroCumpleanos">
							<label for="birthday">Cumpleaños</label>
							<input name="birthday" type="date" id="birthday"  format="dd/MM/YYYY" placeholder="dd/mm/aaaa" value="<?= set_value('birthday'); ?>">
							<label for="birthday" class="showError"></label>
						</article>
					</section>
					<section class="small-12 medium-6 large-6 columns layaout__input--2">
						<article class="content--input" id="registroCelular">
							<label for="celular">Número Celular</label>
							<div class="group">
                                <?= form_dropdown('prefijos',$prefijos,'+57','class="prefijos" id="prefijos"')?>
								<input name="celular" type="tel" id="celular" value="<?= set_value('celular'); ?>" >
							</div>
							<label for="celular" class="showError"></label>
						</article>
					</section>
					<section class="small-12 medium-6 large-6 columns layaout__input--2">
                        <article class="content--input" id="registroEmail">
								<label for="email">Email Corporativo <em>sin extensión de dominio</em></label>
								<div class="input-group">
									<input name="email" type="text" id="email" >
									<span class="input-group-label" id="domain">@unify.com</span>
								</div>
								<label for="email" class="showError"></label>
							</article>
					</section>
					<section class="small-12 medium-6 large-6 columns layaout__input--2">
						<article class="content--input " id="registroCargo">
							<label for="cargo">Cargo</label>
                            <?= form_dropdown('cargo',$cargos,'','class=""id="cargo"')?>
							<label for="cargo" class="showError"></label>
						</article>
					</section>
                        <span class="bg"></span>
				</section>
				<section class="layaout__registro--white">
					<section class="small-12 medium-12 large-6 large-offset-3 columns layaout__input--1">
						<figure class="icon--input">
							<i class="fa icon-unify-10" aria-hidden="true"></i>
						</figure>
						<article class="content--input" id="registroPassword">
							<label for="password">Contraseña</label>
							<input name="password" type="password" id="password" value="<?= set_value('password'); ?>" >
							<label for="password" class="showError"></label>
						</article>
					</section>
					<section class="small-12 medium-12 large-6 large-offset-3 columns layaout__input--1">
						<figure class="icon--input">
							<i class="fa icon-unify-11" aria-hidden="true"></i>
						</figure>
						<article class="content--input" id="registroConfirma">
							<label for="confirma">Repite la contraseña</label>
							<input name="confirma" type="password" id="confirma" onblur="validacion(this.form)">
							<label for="confirma" class="showError"></label>
						</article>
					</section>
					<section class="small-12 columns text-center">
						<input   type="submit" class="button button--1" value="¡CREAR MI CUENTA!">
					</section>
				</section>
			</form>
			<p class="politicas paragraph text-center">
				Al clickear “CREAR MI CUENTA” tú estas aceptando las <a href="<?= base_url();?>politicas">políticas de tratamiento de datos</a> de Unify
			</p>
			<a href="<?= base_url();?>" class="paragraph layaout__registro--back">
				<i class="fa icon-unify-4"></i>
				Regresar al inicio de sesión
                <img src="" alt=""> 
			</a>
		</section>
</section>
<script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>
<script type="text/javascript">
    //showPrecarga();hidePrecarga();
    previewImagen ();
    scrollFormularioError(); 
$(document).ready(function(){
			$("#formregistro").submit(function(e){
                e.preventDefault();
                
                   var fd = new FormData();
                    var file_data = $('input[type="file"]')[0].files;
                    fd.append("foto", file_data[0]);
                    var other_data = $('form').serializeArray();
                    $.each(other_data,function(key,input){
                        if(input.name =="email"){
                            if(input.value != ""){
                                fd.append(input.name,trim(input.value)+$("#domain").text());
                            }else{
                                fd.append(input.name,"");
                            }
                        }else{
                            fd.append(input.name,input.value);
                        }
                    });
				$.ajax({
					url: $(this).attr("action"),
					type: $(this).attr("method"),
                    data: fd,
                    contentType: false,
                    processData: false,
                    cache: false,
                    beforeSend:  function() {
                        showPrecarga();
                        },
                    success:function(data){
                       hidePrecarga();
                        
                        $(".errorRegistro").removeClass("errorRegistro");
                        $(".showError").text("");
                        
                        var obj = $.parseJSON(data);
                        if(obj['nombre']!=""){                               
                            $("#registroNombre").addClass("errorRegistro");
                            $(".showError[for='nombre']").text(obj['nombre']);
                        }
                        if(obj['documento']!=""){   
                            $("#registroCedula").addClass("errorRegistro");
                            $(".showError[for='documento']").text(obj['documento']);
                        }
                        if(obj['empresa']!=""){   
                            $("#registroEmpresa").addClass(" errorRegistro");
                            $(".showError[for='empresa']").text(obj['empresa']);
                        }
                        if(obj['birthday']!=""){   
                            $("#registroCumpleanos").addClass("errorRegistro");
                            $(".showError[for='birthday']").text(obj['birthday']);
                        }
                         if(obj['cargo']!=""){   
                            $("#registroCargo").addClass("errorRegistro");
                            $(".showError[for='cargo']").text(obj['cargo']);        
                        }
                        if(obj['email']!=""){   
                            $("#registroEmail").addClass("errorRegistro");
                            $(".showError[for='email']").text(obj['email']);
                        }
                        if(obj['prefijos']!=""){
                            $("#registroCelular").addClass("errorRegistro");
                            $(".showError[for='celular']").text(obj['prefijos']);
                        }
                        if(obj['celular']!=""){   
                            $("#registroCelular").addClass("errorRegistro");
                            $(".showError[for='celular']").text(obj['celular']);
                        }
                        if(obj['password']!=""){   
                            $("#registroPassword").addClass("errorRegistro");
                            $(".showError[for='password']").text(obj['password']);
                        }
                        if(obj['confirma']!=""){  
                            if(obj['confirma'] == " Las contraseñas no coinciden. "){
                                $("#registroPassword").addClass("errorRegistro");
                            }
                            $("#registroConfirma").addClass("errorRegistro");
                            $(".showError[for='confirma']").text(obj['confirma']);
                        }
                       // if(obj=="2"){
                         //   $(".showError[for='foto']").text("Error al subir la foto, intente mas tarde");
                        //}
                        //if(obj=="3"){
                          //  $(".showError[for='foto']").text("Formato no valido");
                        //}
                        if(obj['val']=="1"){
                            window.location.href="<?= base_url();?>Login/exito/1";
                        }
                        scrollFormularioError(); 
                         
                    }
				});
 
			});
			return false;
		});
        
function trim(texto){ 
return texto.split(" ").join(""); 
} 
    function validacion(formu){ 
   	    if (formu.password.value==formu.confirma.value){ 
      	 $("#registroPassword").removeClass("errorRegistro");
         $("#registroConfirma").removeClass("errorRegistro");
   	    }
    }
</script>
</body>
</html>

	
