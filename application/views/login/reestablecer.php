<section class="portraitUse"></section>
<section class="layaout__editPassword">
    <article class="row text-center">
	   <figure class="layaout__editPassword--logo">
			<img src="<?= base_url();?>assets/images/site/resetpasword/logo-unify.jpg" alt="Unify">
        </figure>
				<h2 class="title text__colour--2 text-left">
					¡Cambia tu contraseña!
				</h2>
                <?= form_open('/Login/cambioPass',array('class'=> 'editPassword--form','id'=> 'formeditPassword','name'=> 'formeditPassword'))?>
					<section class="small-12 medium-12 large-6 columns layaout__input--1">
						<figure class="icon--input">
							<i class="fa icon-unify-10" aria-hidden="true"></i>
						</figure>
						<article class="content--input " id="registroPassword">
							<label for="password">Contraseña</label>
							<input name="password" type="password" id="password" >
							<label for="password" class="showError"></label>
						</article>
					</section>
					<section class="small-12 medium-12 large-6 columns layaout__input--1">
						<figure class="icon--input">
							<i class="fa icon-unify-11" aria-hidden="true"></i>
						</figure>
						<article class="content--input" id="registroConfirma">
							<label for="confirma">Repite la contraseña</label>
							<input name="confirma" type="password" id="confirma" >
							<label for="confirma" class="showError"></label>
						</article>
					</section>
					<div class="small-12 medium-12 large-12 columns text-center">
						<input   type="submit" class="button button--1" value="Cambiar CONTRASEÑA">
					</div>
                    <?=form_hidden('token',$token)?>
				    <?=form_hidden('id',$idusuario)?>
				</form>
				<a href="<?= base_url();?>" class="paragraph layaout__editPassword--back">
					<i class="fa icon-unify-4"></i>
					Regresar al inicio de sesión
				</a>
			</article>
		</section>

<script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
			$("#formeditPassword").submit(function(e){
                e.preventDefault();
                $(".errorRegistro").removeClass("errorRegistro");
                $(".showError").text("");
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
                        var obj = $.parseJSON(data);
                        if(obj=="1"){
                            window.location.href="<?= base_url();?>Login/exito/3";
                        }
                        if(obj['password']!=""){
                             $("#registroPassword").addClass("errorRegistro");
                            $(".showError[for='password']").text(obj['password']);
                        }
                        if(obj['confirma']!=""){
                             $("#registroConfirma").addClass("errorRegistro");
                            $(".showError[for='confirma']").text(obj['confirma']);
                        }
                    }
				});
 
			});
			return false;
		});
</script>
</body>
</html>
