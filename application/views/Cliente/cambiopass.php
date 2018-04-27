<section class="layaout__editPassword layaout__perfilEdicionPassword--1">
			<article class="row text-center">
				<h2 class="title text__colour--2 text-left">
					¡Cambia tu contraseña!
				</h2>
                <?= form_open('/Cliente/cambioPass',array('class'=> 'editPassword--form','name'=>'formeditPassword','id'=>'formeditPassword'))?>
					<section class="small-12 medium-12 large-12 columns layaout__input--1">
						<figure class="icon--input">
							<i class="fa icon-unify-10" aria-hidden="true"></i>
						</figure>
						<article class="content--input " id="registroPassword">
							<label for="password">Contraseña actual</label>
							<input name="password" type="password" id="password" >
							<label for="password" class="showError"></label>
						</article>
					</section>
					<section class="small-12 medium-12 large-6 columns layaout__input--1">
						<figure class="icon--input">
							<i class="fa icon-unify-10" aria-hidden="true"></i>
						</figure>
						<article class="content--input " id="registroNueva">
							<label for="password">Nueva contraseña</label>
							<input name="nueva" type="password" id="nueva" >
							<label for="nueva" class="showError"></label>
						</article>
					</section>
					<section class="small-12 medium-12 large-6 columns layaout__input--1">
						<figure class="icon--input">
							<i class="fa icon-unify-11" aria-hidden="true"></i>
						</figure>
						<article class="content--input" id="registroConfirma">
							<label for="confirma">Repite la contraseña</label>
							<input name="confirma" type="password" id="confirma"  onblur="validacion(this.form)">
							<label for="confirma" class="showError"></label>
						</article>
					</section>
					<div class="small-12 medium-12 large-12 columns text-center" >
						<input   type="submit" class="button button--1" value="Cambiar CONTRASEÑA">
					</div>
                    <?=form_hidden('token',$token)?>
				</form>
			</article>
		</section>

<script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
			$("#formeditPassword").submit(function(e){
                e.preventDefault();
				$.ajax({
					url: $(this).attr("action"),
					type: $(this).attr("method"),
					data: $(this).serialize(),
                    cache: false,
                    success:function(data){
                        var obj = $.parseJSON(data);
                        if(obj=="1"){
                            window.location.href="<?= base_url();?>Cliente/exito/2";
                        }
                        if(obj['password']!=""){
                            $("#registroPassword").addClass("errorRegistro");
                            $(".showError[for='password']").text(obj['password']);
                        }
                        if(obj['nueva']!=""){
                             $("#registroNueva").addClass("errorRegistro");
                            $(".showError[for='nueva']").text(obj['nueva']);
                        }
                        if(obj['confirma']!=""){
                            if(obj['confirma'] == " Las contraseñas no coinciden. "){
                                $("#registroPassword").addClass("errorRegistro");
                            }
                            $("#registroConfirma").addClass("errorRegistro");
                            $(".showError[for='confirma']").text(obj['confirma']);
                        }
                        scrollFormularioError();
                    }
				});
 
			});
			return false;
		});

    function validacion(formu){ 
   	    if (formu.password.value==formu.confirma.value){ 
      	 $("#registroNueva").removeClass("errorRegistro");
         $("#registroConfirma").removeClass("errorRegistro");
   	    }
    }
</script>
</body>
</html>