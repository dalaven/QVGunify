<?php
    $empresas=       array('' => 'Seleccione...', 'Nexsys' => 'Nexsys',      'Network1' => 'Network1'  );
?>

<section class="portraitUse"></section>
<section class="layaout__agregar--2 layaout__orderDeCompra--1">
			<article class="row">
                <article class="layaout__agregar__2--content">
				<a href="#condiciones"  class="layaout__agregar__2--icono">
					<i class="fa icon-unify-20"  aria-hidden="true"></i>
					<span class="text">Condiciones</span>
				</a>
				<article class="layaout__agregar__2--contentText">
					<h3 class="title">ORDEN DE COMPRA</h3>
					<p class="paragraph">Registra tus nuevas ventas</p>
				</article>
                </article>
			</article>
			<span class="gradient"></span>
		</section>

		<section class="layaout__agregar--3">
			<article class="row">
<section class="errorAgregar" ><span id="error"></span></section>
                <?=form_open('/Cliente/ordenCompras',array('class'=> 'agregar--form','name'=>'formAgregar','id'=>'formAgregar'))?>
					<div id="createSections">
						<section class="small-12 medium-12 large-12 columns table__orden--compra table--agregar" id="sectionCreate-0">
							<section class="small-12 medium-12 large-12 columns layaout__input--precio">
								<label class="signo" for="monto">$</label>
								<input class="monto" name="monto[]" type="tel" id="monto[]"  value="0">
								<label class="divisa" for="monto">
									USD
									<span>
										Antes de impuestos
									</span>
								</label>
							</section>
							<section class="small-12 medium-12 large-4 columns layaout__input--1">
								<figure class="icon--input">
									<i class="fa icon-unify-19" aria-hidden="true"></i>
								</figure>
								<article class="content--input" id="formOrdenCompra">
									<label for="ordenCompra">Orden de compra</label>
									<input name="ordencompra[]" type="text" id="ordencompra[]"  >
									<label for="ordenCompra" class="showError"></label>
								</article>
							</section>
							<section class="small-12 medium-12 large-4 columns layaout__input--1">
								<figure class="icon--input">
									<i class="fa icon-unify-9" aria-hidden="true"></i>
								</figure>
								<article class="content--input" id="formMayorista">
									<label for="mayorista">Mayorista</label>
									 <?= form_dropdown('mayorista[]',$empresas,'','class="" id="mayorista[]"')?>
									<label for="mayorista" class="showError"></label>
								</article>
							</section>
							<section class="small-12 medium-12 large-4 columns layaout__input--1">
								<figure class="icon--input">
									<i class="fa icon-unify-6" aria-hidden="true"></i>
								</figure>
								<article class="content--input" id="formPreventa">
									<label for="preventa">Preventa</label>
									<input name="preventa[]" type="text" id="preventa[]"   >
									<label for="preventa" class="showError"></label>
								</article>
							</section>
						</section>
					</div>
					<section class="small-12 medium-12 large-12 columns controls">
                        <a href="#condiciones" class="control" id="condicionesBoton">
							<i class="fa icon-unify-20"></i>
							<span>Condiciones para aplicar</span>
						</a>
						<div href="#" class="control controlAddOrdenCompra" id="addSectionFormAgregar">
							<i class="fa icon-unify-13"></i>
							<span>Añadir una más</span>
						</div>
						<div href="#" class="control controlAddOrdenCompra" id="removeSectionFormAgregar">
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
                    	<i class="fa icon-unify-31 activeLetra"></i>
					<span>
						<?=$this->config->item('LetraU');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-32 "></i>
					<span>
						<?=$this->config->item('LetraN');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-33 activeLetra"></i>
					<span>
						<?=$this->config->item('LetraI');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-34 "></i>
					<span>
						<?=$this->config->item('LetraF');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-35 activeLetra"></i>
					<span>
						<?=$this->config->item('LetraY');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-36 activeLetra"></i>
					<span>
						<?=$this->config->item('Letra1');?>
					</span>
				</p>
				<p class="paragrap">
					<i class="fa icon-unify-37 " ></i>
					<span>
						<?=$this->config->item('Letra7');?>
					</span>
				</p>
			</article>
		</section>


<script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
			$("#formAgregar").submit(function(e){
                e.preventDefault();
				$.ajax({
					url: $(this).attr("action"),
					type: $(this).attr("method"),
					data: $(this).serialize(),
                    cache: false,
                    success:function(data){
                        var obj = $.parseJSON(data);
                        if(obj=="1"){
                            window.location.href="<?= base_url();?>Cliente/exito/3";
                        }else{
                            $("#error").text(obj);
                            //$('.errorAgregar').css('display','inline-block');

                        }scrollAgregarError();
                    }
				});

			});
			return false;
		});
</script>
</body>
</html>
