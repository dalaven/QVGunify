<nav class="navigation__app">
	<section class="row">
		<ul>
			<li>
				<a href="<?=base_url();?>" id="botonProgreso" class="<?php if(isset($boton) && $boton=="progreso") echo "boton-activo";?>">
					<i class="fa icon-unify-12"></i>
					<span>PROGRESO</span>
				</a>
			</li>
			<li>
				<a href="<?=base_url();?>Cliente/agregar" id="botonAgregar">
					<i class="fa icon-unify-13"></i>
					<span>AGREGAR</span>
				</a>
			</li>
			<li>
				<a href="<?=base_url();?>Cliente/perfil" class="" id="botonPerfil">
					<div class="content--perfil pic-active" >
						<i class="fa icon-unify-15" style="background-image: url('<?= base_url()?>documentos/fotos/<?= $foto_perfil?>')"></i>
					</div>

					<span>PERFIL</span>
				</a>
			</li>
		</ul>
	</section>
</nav>
<!-- Contenido -->
		<section class="portraitUse"></section>
		<section class="waypoint"></section>
		<section class="layaout__progreso--1">
			<section class="row">
				<div id="containerProgress_1" class="gradient"></div>
				<div id="containerProgress_2" class="gradient"></div>
				<div id="containerProgress_3" class="gradient"></div>
			</section>
			<span class="degrade"></span>
		</section>
		<section class="layaout__progreso--2">
			<section class="row">
				<article class="layaout__progreso__2--letras-1">

                    <?php if(isset($letras->L_U) && $letras->L_U>0){?>
					   <i class="fa icon-unify-31 ok"  aria-hidden="true" id="letra-1">
					<?php }else{?>
                        <i class="fa icon-unify-31 letra"  aria-hidden="true" id="letra-1">
                    <?php }?>
                        <a href="<?=base_url()?>Cliente/oCompras" class="tool-tip">
							<p class="paragraph"><?=$this->config->item('LetraU');?></p>
							<section class="content--precio">
								<section class="icono_premio">
									<figure></figure>
								</section>
								<p class="content--text">
                                    <?php if($Cargo=="Venta"){?>
									<strong>Vendedor: </strong><?=$this->config->item('VendedorOC1');?><br>
									<?php }
                                    if($Cargo=="Preventa"){?>
                                    <strong>Preventa: </strong><?=$this->config->item('PreventaOC1');?>
                                    <?php }?>
								</p>
							</section>
						</a>
					</i>
                    <?php if(isset($letras->L_N) && $letras->L_N>0){?>
					   <i class="fa icon-unify-32 ok"  aria-hidden="true" id="letra-2">
					<?php }else{?>
                        <i class="fa icon-unify-32 letra"  aria-hidden="true" id="letra-2">
                    <?php }?>
						<a href="<?=base_url()?>Cliente/oportunidad" class="tool-tip">
							<p class="paragraph"><?=$this->config->item('LetraN');?></p>
							<section class="content--precio">
								<section class="icono_premio">
									<figure></figure>
								</section>
								<p class="content--text">
                                    <?php if($Cargo=="Venta"){?>
									<strong>Vendedor: </strong> <?=$this->config->item('VendedorLeads');?> <br>
									<?php }
                                    if($Cargo=="Preventa"){?>
                                    <strong>Preventa: </strong> <?=$this->config->item('PreventaLeads');?>
                                    <?php }?>
								</p>
							</section>
						</a>
					</i>
				            <?php if(isset($letras->L_I)&& $letras->L_I>0){?>
                    <i class="fa icon-unify-33 ok"  aria-hidden="true" id="letra-3">
                           <?php }else{?>
                    <i class="fa icon-unify-33 letra"  aria-hidden="true" id="letra-3">
                           <?php }?>
						<a href="<?=base_url()?>Cliente/oCompras" class="tool-tip">
							<p class="paragraph"><?=$this->config->item('LetraI');?></p>
							<section class="content--precio">
								<section class="icono_premio">
									<figure></figure>
								</section>
								<p class="content--text">
                                    <?php if($Cargo=="Venta"){?>
									<strong>Vendedor: </strong><?=$this->config->item('VendedorOC2');?> <br>
									<?php }
                                    if($Cargo=="Preventa"){?>
                                    <strong>Preventa: </strong><?=$this->config->item('PreventaOC2');?>
                                    <?php }?>
								</p>
							</section>
						</a>
					</i>
                        <?php if(isset($letras->L_F)&& $letras->L_F>0){?>
                        <i class="fa icon-unify-34 ok"  aria-hidden="true" id="letra-4">
                        <?php }else{?>
                        <i class="fa icon-unify-34 letra"  aria-hidden="true" id="letra-4">
                        <?php }?>

						<a href="<?=base_url()?>Cliente/evento" class="tool-tip">
							<p class="paragraph"><?=$this->config->item('LetraF');?></p>

						</a>
					</i>
                    <?php if(isset($letras->L_Y)&& $letras->L_Y>0){?>
                    <i class="fa icon-unify-35 ok"  aria-hidden="true" id="letra-5">
                            <?php }else{?>
                    <i class="fa icon-unify-35 letra"  aria-hidden="true" id="letra-5">
                            <?php }?>

						<a href="<?=base_url()?>Cliente/oCompras" class="tool-tip">
							<p class="paragraph"><?=$this->config->item('LetraY');?></p>
                            <section class="content--precio">
								<section class="icono_premio">
									<figure></figure>
								</section>
								<p class="content--text">
                                    <?php if($Cargo=="Venta"){?>
									<strong>Vendedor: </strong><?=$this->config->item('VendedorOC2');?> <br>
									<?php }
                                    if($Cargo=="Preventa"){?>
                                    <strong>Preventa: </strong><?=$this->config->item('PreventaOC2');?>
                                    <?php }?>
								</p>
							</section>
						</a>
					</i>
				</article>
				<article class="layaout__progreso__2--letras-2">
                    <?php if(isset($letras->L_1)&& $letras->L_1>0){?>
                    <i class="fa icon-unify-36 ok"  aria-hidden="true" id="letra-6" data-options="tipLocation:top;">
                        <?php }else{?>
                    <i class="fa icon-unify-36 letra"  aria-hidden="true" id="letra-6" data-options="tipLocation:top;">
                        <?php }?>

						<a href="<?=base_url()?>Cliente/oCompras" class="tool-tip">
							<p class="paragraph"><?=$this->config->item('Letra1');?></p>
							<section class="content--precio">
								<section class="icono_premio">
									<figure></figure>
								</section>
								<p class="content--text">
                                    <?php if($Cargo=="Venta"){?>
									<strong>Vendedor: </strong> <?=$this->config->item('VendedorOC2');?> <br>
									<?php }
                                    if($Cargo=="Preventa"){?>
                                    <strong>Preventa: </strong> <?=$this->config->item('PreventaOC2');?>
                                    <?php }?>
								</p>
							</section>
						</a>
					</i>
                    <?php if(isset($letras->L_7)&& $letras->L_7>0){?>
                        <i class="fa icon-unify-37 ok"  aria-hidden="true" id="letra-7" data-options="tipLocation:top;">
                    <?php }else{?>
                        <i class="fa icon-unify-37 letra"  aria-hidden="true" id="letra-7" data-options="tipLocation:top;">
                    <?php }?>
						<a href="<?=base_url()?>Cliente/certificacion" class="tool-tip">
							<p class="paragraph"><?=$this->config->item('Letra7');?></p>
						</a>
					</i>
				</article>
			</section>
		</section>


		<div class="win">
			<article class="row"> <!-- nuevo-->
				<h1 class="title">¡FELICIDADES! <?php $nombre = explode(" ", $this->session->userdata('username')); echo $nombre[0];?></h1>
				<a href="#" onclick="reset()" class="button button--1">VUELVE A INICIAR EL RETO</a>
				<h4 class="title">¡Así podrás aumentar tus premios!</h4>
			</article>
		</div>

		<!-- Inicia Trivia -->
		<section class="layaout__progreso--trivia" style="display:none" >
			<article class="layaout__progreso__trivia--header">
				<article class="row">
					<article class="trivia__enunciado small-12 medium-6 large-4 columns">
						<h3 class="paragraph"><strong>Gana</strong> una tarjeta <strong>Cine Colombia</strong> por <strong>$60.000.oo COP</strong> contestando esta trivia</h3>
						<p>(Ganan las 3 primeras personas en enviar sus respuestas correctas)</p>
					</article>
				</article>
				<figure class="bg__trivia"></figure>
				<figure class="bg__icons">
					<figure class="premio__cine"></figure>
					<figure class="premio__cine"></figure>
					<figure class="premio__cine"></figure>
				</figure>
			</article>
			<article class="row">
				<?= form_open('/Cliente/enviarTrivia',array('name'=>'formTrivia','class'=> 'form--trivia','id'=>'formTrivia'))?>
                    <section class="errorAgregar title text-center text__colour--3" style="display:none">
                        <span id="error">No has respondido las 3 preguntas</span>
                        <br>
                        <br>
                </section>
					<div class="small-12 medium-12 large-12 columns content__pregunta">
						<h3 class="paragraph">
							<span>1.</span>
							<span>Cuáles son las 5 lineas de negocio que maneja Network1 en Colombia:</span>
						</h3>
						<ul>
							<li>
								<input type="radio" id="trivia__1--1" name="trivia__1" value="Data Center y Virtualizacion, Productividad, comunicación y colaboración, seguridad de la Informacion, Seguridad Fisica, Networking y Performance">
								<label for="trivia__1--1" >Data Center y Virtualizacion, Productividad, comunicación y colaboración, seguridad de la Informacion, Seguridad Fisica, Networking y Performance</label>
								<label for="trivia__1--1"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
							<li>
								<input type="radio" id="trivia__1--2" name="trivia__1" value="Productividad, comunicación y colaboración, seguridad de la Informacion, Seguridad Perimetral, Bases de datos y analitica">
								<label for="trivia__1--2">Productividad, comunicación y colaboración, seguridad de la Informacion, Seguridad Perimetral, Bases de datos y analitica</label>
								<label for="trivia__1--2"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
							<li>
								<input type="radio" id="trivia__1--3" name="trivia__1" value="Data Center y Virtualizacion, Productividad, comunicación y colaboración, seguridad de la Informacion, Analisis forense e integracion, logística y logística Inversa">
								<label for="trivia__1--3">Data Center y Virtualizacion, Productividad, comunicación y colaboración, seguridad de la Informacion, Analisis forense e integracion, logística y logística Inversa</label>
								<label for="trivia__1--3"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
							<li>
								<input type="radio" id="trivia__1--4" name="trivia__1" value="Productividad, comunicación y transformación de procesos, seguridad de la Informacion, Analisis forense e integracion, logística y logística Inversa">
								<label for="trivia__1--4">Productividad, comunicación y transformación de procesos, seguridad de la Informacion, Analisis forense e integracion, logística y logística Inversa</label>
								<label for="trivia__1--4"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
						</ul>
					</div>

					<div class="small-12 medium-12 large-12 columns content__pregunta">
						<h3 class="paragraph">
							<span>2.</span>
							<span>¿Qué solución de Unify  para verticales ayuda a suplir las necesidades de comunicaciones de trading y dispatching?</span>
						</h3>
						<ul>
							<li>
								<input type="radio" id="trivia__2--1" name="trivia__2" value="OpenScape Xpert">
								<label for="trivia__2--1">OpenScape Xpert</label>
								<label for="trivia__2--1"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
							<li>
								<input type="radio" id="trivia__2--2" name="trivia__2" value="OpenScape Alarm Response">
								<label for="trivia__2--2">OpenScape Alarm Response</label>
								<label for="trivia__2--2"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
							<li>
								<input type="radio" id="trivia__2--3" name="trivia__2" value="OpenScape Health Station (Himed)">
								<label for="trivia__2--3">OpenScape Health Station (Himed)</label>
								<label for="trivia__2--3"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
						</ul>
					</div>

					<div class="small-12 medium-12 large-12 columns content__pregunta">
						<h3 class="paragraph">
							<span>3.</span>
							<span>¿Cuál de las siguientes promociones está vigente?</span>
						</h3>
						<ul>
							<li>
								<input type="radio" id="trivia__3--1" name="trivia__3" value ="A. Open Scape Business UC (Ventaja de precios hasta 25%)">
								<label for="trivia__3--1">A. Open Scape Business UC (Ventaja de precios hasta 25%)</label>
								<label for="trivia__3--1"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
							<li>
								<input type="radio" id="trivia__3--2" name="trivia__3" value="B. Sustitución competitiva Trade-In! Now">
								<label for="trivia__3--2">B. Sustitución competitiva Trade-In! Now</label>
								<label for="trivia__3--2"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
							<li>
								<input type="radio" id="trivia__3--3" name="trivia__3" value="C. Campaign Director Attack">
								<label for="trivia__3--3"> C. Campaign Director Attack</label>
								<label for="trivia__3--3"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
							<li>
								<input type="radio" id="trivia__3--4" name="trivia__3" value="D. (A) y (B)">
								<label for="trivia__3--4">D. (A) y (B)</label>
								<label for="trivia__3--4"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
							<li>
								<input type="radio" id="trivia__3--5" name="trivia__3" value="E. Todas las anteriores">
								<label for="trivia__3--5">E. Todas las anteriores</label>
								<label for="trivia__3--5"class="check"><i class="fa icon-unify-25"></i></label>
							</li>
						</ul>
					</div>
						       <div class="small-12 medium-12 large-12 columns">
							       <input   type="submit" class="button button--1" value="ENVIAR">
					</div>
				</form>
			</article>
		</section>

		<!-- Fin Trivia -->
		<section class="layaout__progreso--3">
            <article class="row"><!-- Nueva -->
				<section class="small-12 medium-10 large-8 columns medium-centered large-centered"> <!-- Nueva -->
					<h5 class="intentos paragraph">Haz completado el reto <span id="retoNivel">
                        <?php if(isset($palabra->Palabra)&& $palabra->Palabra>0){?>
                            <?=$palabra->Palabra?>
                    <?php }else{?>
                        0
                    <?php }?></span> veces</h5>
					<h1 class="title">
						¡Hola! <?php $nombre = explode(" ", $this->session->userdata('username')); echo $nombre[0];?>
					</h1>
					<p class="paragraph" id="texto-aleatorio">

					</p>
					<a href="<?=base_url()?>Cliente/detalles" class="button button--1">DETALLES DEL CONCURSO</a>
					<figure class="nivel">
						<i class="fa icon-unify-26"></i>
						<div class="content--nivel">
							Nivel:
							<span id="nivelActualTxt"></span>
						</div>
					</figure>
				</section>
			</article>
		</section>


	<!-- End Contenido -->


	<script type="text/javascript" src="<?=base_url();?>assets/js/core.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function(){
        
        $("#formTrivia").submit(function(e){
            e.preventDefault();
                $.ajax({
					url: 'http://www.unifyandina.com/Cliente/enviarTrivia',//$(this).attr("action"),
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
                        if(data=="1"){
                            window.location.href="<?= base_url();?>Cliente/exito/5";
                        }
                        if(data=="2"){
                            $(".errorAgregar").addClass("errorRegistro");
                            $(".errorAgregar").css("display","block");
                        }
                        scrollFormularioErrorGenerico();
                        scrollAgregarError();
                    }
				});

			});
			return false;
		});

progresoDeUsuario ();
        activeWebClip();
        function reset(){
            $.ajax({
                    url:'<?php echo base_url().'Cliente/resetreto';?>',
                    type:"POST",
                    beforeSend: function () {
                         showPrecarga();
                    },
                    success:function(){
                        hidePrecarga();
                        window.location.href="<?= base_url();?>/Cliente";
                    }
                });
    }
	</script>
</body>
</html>
