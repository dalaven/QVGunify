<section class="portraitUse"></section>
		<section class="layaout__resetPassword">
			<article class="row text-center">
                <section class="small-12 medium-10 large-6 medium-centered columns">
				<figure class="layaout__resetPassword--logo">
					<img src="<?= base_url();?>assets/images/site/resetpasword/logo-unify.jpg" alt="Unify">
				</figure>
				<h1 class="title text__colour--2">
					¡HOLA!
				</h1>
				<p class="paragraph text__colour--2">
					Por favor ingresa a continuación tu email corporativo y te enviaremos un link de vuelta a tu email inscrito para cambiarla
				</p>
				<span class="errorResetPassword errorRegistro"><span></span></span>
                <?= form_open('/Login/validarEmail',array('class'=> '
                resetPassword--form','id'=>'formResetPassword','name'=>'formResetPassword'))?>
                
					<div class="small-12 medium-12 large-12 columns">
						<input type="email" name="email" id="email"  placeholder="Email Corporativo">
						<label class="errorform" for="email"><i class="fa icon-unify-14"></i></label>
                        <label for="email" class="showError"></label>
					</div>
					<div class="small-12 medium-12 large-12 columns">
						<input   type="submit" class="button button--1" value="RECORDAR CONTRASEÑA">
					</div>
                    <?=form_hidden('token',$token)?>
				</form>
				<a href="<?= base_url();?>" class="paragraph layaout__resetPassword--back">
					<i class="fa icon-unify-4"></i>
					Regresar al inicio de sesión
				</a>
                </section>
			</article>
		</section>
<script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>
<script type="text/javascript">
    
$(document).ready(function(){
			$("#formResetPassword").submit(function(e){
                e.preventDefault();
                //$(".errorRegistro").removeClass("errorRegistro");
                //$(".showError").text("");
				$.ajax({
					url: $(this).attr("action"),
					type: $(this).attr("method"),
					data: $(this).serialize(),
                    cache: false,
                    beforeSend:  function() {
                        showPrecarga();
                        },
                    success:function(data){
                       hidePrecarga();
                        if(data=="1"){
                            window.location.href="<?= base_url();?>Login/exito/2";
                        }
                        if(data!=""){
                             $(".errorResetPassword").css("display","inline-block");
                            $(".errorResetPassword span").text(data);
                        }
                         scrollFormularioErrorGenerico();
                    }
				});
 
			});
			return false;
		});
</script>
</body>
</html>
