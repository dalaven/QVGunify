<section class="portraitUse"></section>
    <section class="layaout__editPassword layaout__perfilAsistencia--1">
	   <article class="row text-center">
           <h2 class="title text__colour--2 text-center">
					¿COMO PODEMOS AYUDARTE?
				</h2>
				<p class="paragraph text-center">
					Describe a continuación detalladamente tus inquietudes, problemas o felicitaciones acerca del aplicativo.
				</p>
				<?= form_open('/Cliente/enviarasistencia',array('class'=> 'editPassword--form','name'=> 'formeditPassword','id'=> 'formeditPassword'))?>
					<section class="small-12 medium-8 large-6 medium-centered columns layaout__input--1">
						<article class="content--input" id="registroPassword">
							<textarea name="comentarios" rows="8" cols="80" id="comentarios"></textarea>
							<label for="comentarios" class="showError"></label>
						</article>
					</section>
					<div class="small-12 medium-12 large-12 columns">
						<input   type="submit" class="button button--1" value="ENVIAR">
                        
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
                        if(data=="1"){
                            window.location.href="<?= base_url();?>Cliente/exito/1";
                        }else{
                            $("#registroPassword").addClass("errorRegistro");
                            $(".showError[for='comentarios']").text(data);
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