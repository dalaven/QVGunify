<?php
    $empresas=       array(''=> 'Seleccione uno','Nexsys' => 'Nexsys',      'Network1' => 'Network1',      'Unify' => 'Unify'  );
?>
<section class="portraitUse"></section>
        <section class="layaout__agregar--2 layaout__evento--1">
			<article class="row">
                <article class="layaout__agregar__2--content">
				<a href="#condiciones"  class="layaout__agregar__2--icono">
					<i class="fa icon-unify-20"  aria-hidden="true"></i>
					<span class="text">Condiciones</span>
				</a>
				<article class="layaout__agregar__2--contentText">
					<h3 class="title">ASISTENCIA A UN EVENTO</h3>
					<p class="paragraph">Registra tu asistencia a los eventos de nuestros mayoristas</p>
				</article>
                </article>
			</article>
			<span class="gradient"></span>
		</section>

		<section class="layaout__agregar--3">
			<article class="row">
                <section class="errorAgregar" ><span id="error"></span></section>
                <?= form_open('/Cliente/guardarEvento',array('class'=> 'agregar--form','id'=> 'formagregar','name'=> 'formagregar'))?>
					<div id="createSections"> <!--nuevo -->
						<section class="small-12 medium-12 large-12 columns table__orden--evento table--agregar" id="sectionCreate-0">
							<section class="small-12 medium-12 large-4 columns layaout__input--1"><!--nuevo -->
								<figure class="icon--input">
									<i class="fa icon-unify-22" aria-hidden="true"></i>
								</figure>
								<article class="content--input" id="formOrdenCompra">
									<label for="fecha">Fecha</label>
									<input name="fecha[]" type="date" id="fecha[]"  placeholder="dd/mm/aaaa">
									<label for="fecha" class="showError"></label>
								</article>
							</section>
							<section class="small-12 medium-12 large-4 columns layaout__input--1"><!--nuevo -->
								<figure class="icon--input">
									<i class="fa icon-unify-9" aria-hidden="true"></i>
								</figure>
								<article class="content--input" id="formMayorista">
									<label for="mayorista">Mayorista</label>
                                    <?= form_dropdown('mayorista[]',$empresas,'','class="" id="mayorista[]"')?>
									<label for="mayorista" class="showError"></label>
								</article>
							</section>
							<section class="small-12 medium-12 large-4 columns layaout__input--1"><!--nuevo -->
								<figure class="icon--input">
									<i class="fa icon-unify-23" aria-hidden="true"></i>
								</figure>
								<article class="content--input" id="formPreventa">
									<label for="evento">Nombre del evento</label>
									<input name="eventos[]" type="text" id="evento[]" >
									<label for="evento" class="showError"></label>
								</article>
							</section>
						</section>
					</div>
					<section class="small-12 medium-12 large-12 columns controls">
						<a href="#condiciones" class="control" id="condicionesBoton"><!--  nuevo -->
							<i class="fa icon-unify-20"></i>
							<span>Condiciones para aplicar</span>
						</a>
						<div href="#" class="control controlAddEvento" id="addSectionFormAgregar"><!--  nuevo -->
							<i class="fa icon-unify-13"></i>
							<span>Añadir uno más</span>
						</div>
						<div href="#" class="control controlAddEvento" id="removeSectionFormAgregar"><!--  nuevo -->
							<i class="fa icon-unify-14"></i>
							<span>Eliminar el último</span>
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
					<i class="fa icon-unify-32 "></i>
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
					<i class="fa icon-unify-34 activeLetra"></i>
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
			$("#formagregar").submit(function(e){
                e.preventDefault();
				$.ajax({
					url: $(this).attr("action"),
					type: $(this).attr("method"),
					data: $(this).serialize(),
                    cache: false,
                    beforeSend:  function() {
                        //showPrecarga();
                        },
                    success:function(data){
                       //hidePrecarga();
                        var obj = $.parseJSON(data);
                        if(obj=="1"){
                            window.location.href="<?= base_url();?>Cliente/exito/3";
                        }else{
                            $("#error").text(obj);
                           // $('.errorAgregar').css('display','inline-block');

                        }scrollAgregarError();
                    }
				});

			});
			return false;
		});
</script>
</body>
</html>
