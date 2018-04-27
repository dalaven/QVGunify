<section class="portraitUse"></section>

		<section class="layaout__agregar--2 layaout__certificacion--1">
			<article class="row">
                <article class="layaout__agregar__2--content">
				<a href="#condiciones"  class="layaout__agregar__2--icono">
					<i class="fa icon-unify-20"  aria-hidden="true"></i>
					<span class="text">Condiciones</span>
				</a>
				<article class="layaout__agregar__2--contentText">
					<h3 class="title">CERTIFICACIONES</h3>
					<p class="paragraph">Registra tus certificaciones vigentes en nuestros productos</p>
				</article>
                    </article>
                    </article>
			</article>
			<span class="gradient"></span>
		</section>

		<section class="layaout__agregar--3">
			<article class="row">
                <section class="errorAgregar" ><span id="error"></span></section>
                <?=form_open_multipart('/Cliente/subirCertificado',array('class'=> 'agregar--form','id'=>'formagregar','name'=>'formagregar'))?>
					<div id="createSections">
						<section class="small-12 medium-12 large-12 columns table__orden--certificacion table--agregar" id="sectionCreate-0">
							<section class="small-12 medium-12 large-12 columns layaout__input--1">
								<article class="content--input " id="formOrdenCompra">
									<input type="file" name="certificado[]" id="certificado[]" class="inputfile certificado-0" /><!--  nuevo -->

									<label for="certificado-0" class="label-upload"><!--  nuevo -->
										<i class="fa fa-file-pdf-o" aria-hidden="true"></i><!--  nuevo -->
										<span><!--  nuevo -->
											Selecciona un archivo .PDF
										</span>
									</label>
									<label for="certificado-0" class="showError"></label>
								</article>
							</section>
						</section>
					</div>
					<section class="small-12 medium-12 large-12 columns controls">
						 <a href="#condiciones" class="control" id="condicionesBoton"><!--  nuevo -->
							<i class="fa icon-unify-20"></i>
							<span>Condiciones para aplicar</span>
						</a>
						<div href="#" class="control controlAddCertificado" id="addSectionFormAgregar"><!--  nuevo -->
							<i class="fa icon-unify-13"></i>
							<span>Añadir una más</span>
						</div>
						<div href="#" class="control controlAddCertificado" id="removeSectionFormAgregar"><!--  nuevo -->
							<i class="fa icon-unify-14"></i>
							<span>Eliminar la última</span>
						</div>
					</section>
					<section class="small-12 medium-12 large-12 columns send">
						<input   type="submit" class="button button--1" value="¡enviar!">
					</section>
				</form>
				<h5 class="paragraph text-center condiciones">
					Al “ENVIAR” esta información entrará en revisión y luego de que se apruebe se verá reflejada en tu sección de “Progreso”
				</h5>
			</article>
		</section>

		<section class="layaout__agregar--4" id="condiciones">
			<article class="row">
				<h2 class="title">CONDICIONES PARA APLICAR</h2>
				<p class="paragrap">
                    	<i class="fa icon-unify-31"></i>
					<span>
						<?=$this->config->item('LetraU');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-32"></i>
					<span>
						<?=$this->config->item('LetraN');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-33"></i>
					<span>
						<?=$this->config->item('LetraI');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-34"></i>
					<span>
						<?=$this->config->item('LetraF');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-35"></i>
					<span>
						<?=$this->config->item('LetraY');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-36"></i>
					<span>
						<?=$this->config->item('Letra1');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-37 activeLetra" ></i>
					<span>
						<?=$this->config->item('Letra7');?>
					</span>
				</p>
			</article>
		</section>
<script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$("#formagregar").submit(function(e){
                e.preventDefault();
                var datafile = new FormData($("#formagregar")[0]);
                //jQuery.each(jQuery('#certificado').files, function(i, file) {
                  //  datafile.append('certificado[]', file);
                //});
				$.ajax({
					url: $(this).attr("action"),
					type: $(this).attr("method"),
					data: datafile,
					contentType: false,
                    processData: false,
                    cache: false,beforeSend:  function() {
                        showPrecarga();
                        },
                    success:function(data){
                       hidePrecarga();
                        $i=0;
                        var obj = $.parseJSON(data);
                        $("article").removeClass("errorRegistro");
                        $(".showError").text("");
                        if(obj['validacion']!=1){
                             window.location.href="<?= base_url();?>Cliente/exito/3";
                        }
                        for(section in obj) {
                            if($i==0){
                            }else{
                                $(section+" section article").addClass("errorRegistro");
                                $(section+" section article label.showError").text(obj[section]);
                            }
                             $i=1;
                        }scrollFormularioError();
                    }
				});

			});
			return false;
		});
    textoCertificado ();
</script>

</body>
</html>
