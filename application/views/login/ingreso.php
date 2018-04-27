<body class="login--bg">
<header class="header--harmonize">
	<img src="<?= base_url();?>assets/images/site/header/logo__unify--harmonize.jpg" alt="Unify">
</header>
<section class="portraitUse"></section>
    <section class="waypoint"></section>
<section class="layaout__login--1"></section>
		<section class="layaout__login--2">
			<section class="row">
				<article class="small-12 medium-7 large-8 columns layaout__login--bg">
                    <span class="bg"></span>
					<h1 class="title white">
						<?=$title?><?//=$navegador?>
					</h1>

				</article>
				<article class="small-12 medium-5 large-4 columns layaout__login--form left">
                    <span>
					<figure class="logo__login">
						<img src="<?= base_url();?>assets/images/site/resetpasword/logo-unify.jpg" alt="Unify">
					</figure>
					<span class="errorLogin  errorRegistro" id="error"><span> </span></span>
                    <div class="small-12 medium-12 large-12 columns" id ="reenvio" style="display:none;">
				        <a href="" onclick="" id="enlace"class="createAccount paragraph text-center button button--2">
						  Reenviar activación
						</a>
				    </div>
                    <?= form_open('/Login/validar',array('name'=>'formLogin','class'=> 'login--form','id'=>'formLogin'))?>

						<div class="small-12 medium-12 large-12 columns">
							<label for="usuario"><i class="fa icon-unify-1" aria-hidden="true"></i></label>
							<input type="text" name="usuario" placeholder="Cédula o Email Corporativo" value="<?php echo set_value('usuario'); ?>" id="usuario">
							<label class="errorform" for="usuario"><i class="fa icon-unify-14"></i></label>
						</div>
						<div class="small-12 medium-12 large-12 columns">
							<label for="password"><i class="fa icon-unify-2" aria-hidden="true"></i></label>
							<input type="password" name="password" placeholder="Contraseña" id="password">
							<a class="help" href="<?= base_url();?>Login/recuperacion">AYUDA</a>
						</div>
						<div class="small-12 medium-12 large-12 columns">
							<input   type="submit" class="button button--1" value="Ingresar">
							<a href="<?= base_url();?>registro" class="createAccount paragraph text-center">
								¡Créate una cuenta!
							</a>
						</div>
                    <?=form_hidden('token',$token)?>
					</form>
                    </span>
				</article>
			</section>
		</section>
<script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>

<script type="text/javascript">
 
    $(document).ready(function(){
        if (Cookies.get('ingresoUno')){
			}else {
				tutorialApp();
				Cookies.set('ingresoUno', 'tutorialApp');
			}
        $("#formLogin").submit(function(e){
            e.preventDefault();
                $.ajax({
					url: 'http://www.unifyandina.com/Login/validar',//$(this).attr("action"),
					type: $(this).attr("method"),
					data: $(this).serialize(),
                    //dataType : 'jsonp',
                    //contentType: false,
                    //processData: false,
                    cache: false,
            
                    beforeSend:  function() {
                        showPrecarga();
                        },
                    success:function(data){
                       hidePrecarga();
                        $("#error").css('display','none');
                        var obj = $.parseJSON(data);

                         if(obj['usuario']!=null){
                                $("#error span").text(obj['usuario']);
                                $("#error").css('display','inline-block');
                                if(obj['usuario'] == " CEDULA NO REGISTRADA "){
                                    $(".errorform").css('display','inline-block');
                                }
                                if(obj['usuario'] == " CORREO NO REGISTRADO "){
                                    $(".errorform").css('display','inline-block');
                                }
                            }
                            else{
                                if(obj['password']!=null){
                                    $("#error span").text(obj['password']);
                                    $("#error").css('display','inline-block');
                                }else{
                                    if(obj=="1"){
                                        window.location.href="<?= base_url();?>";
                                    }else{
                                        $("#error span").text(obj);
                                        $("#error").css('display','inline-block');
                                        if(obj == "CUENTA SIN ACTIVAR, REVISE SU CORREO"){
                                            $("#reenvio").css('display','inline-block');
                                        }
                                    }

                                }
                            }
                        scrollFormularioErrorGenerico();
                    }
				});

			});
			return false;
		});
    
    
    
        $("#enlace").click(function(e){
            e.preventDefault();
            var parametros = {
                    "user" : $("#usuario").val(),
                };
        $.ajax({
            url:'<?php echo base_url().'Login/reenvio';?>',
            type:"POST",
            data: parametros,
            cache: false,
            beforeSend: function () {
                $("#error").css('display','none');
                showPrecarga(); 
            },
            success:function(data){
                hidePrecarga();
                
                //alert(data);
                if(data=="1"){
                    //$("#error span").text("Se ha enviado el correo");
                    //$("#error").css('display','inline-block');
                    window.location.href="<?= base_url();?>Login/exito/4";
                }
                if(data!="1"){
                    $("#error span").text("No se ha podido recuperar, contacte al administrador");
                    $("#error").css('display','inline-block');
                }
                $("#reenvio").css('display','none');
               
            },
            error:function(){
            alert("ERROR");
        }
        });
            return false;
    } );
</script>
</body>
</html>
