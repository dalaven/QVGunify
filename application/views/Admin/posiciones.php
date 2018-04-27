<nav class="navigation__app">
	<section class="row">
		<ul>
			<li>
				<a href="<?=base_url();?>" id="botonProgreso" class="<?php if(isset($boton) && $boton=="posiciones") echo "boton-activo";?>">
					<i class="fa icon-unify-12"></i>
					<span>POSICIONES</span>
				</a>
			</li>
			<li>
				<a href="<?=base_url();?>Admin/aprobar" id="botonAgregar">
					<i class="fa icon-unify-25"></i>
					<span>APROBACIONES</span>
				</a>
			</li>
			<li>
				<a href="<?=base_url();?>Admin/perfil" class="" id="botonPerfil">
					<div class="content--perfil pic-active" >
						<i class="fa icon-unify-15" style="background-image: url('<?= base_url()?>documentos/fotos/<?= $foto_perfil?>')"></i>
					</div>
					<span>PERFIL</span>
				</a>
			</li>
		</ul>
	</section>
</nav>
<section class="portraitUse"></section>
<section class="layaout__admin__posiciones--1">
			<section class="row">
                <?php if($ranking){
                    foreach($ranking as $rank){
                ?>
				<section class="content__posicion">
					<section class="posicion__avatar" >
						<figure style="background-image: url('<?= base_url()?>documentos/fotos/<?= $rank->Ruta?>')"></figure>
					</section>
					<section class="content__informacion__posicion">
						<section class="datos__posicion">
							<p class="paragraph">
								<strong><?= $rank->Nombre?></strong><br>
								<?= $rank->Cargo?>, <?=$rank->idEmpresas?>
							</p>
							<figure class="ranking">
								<i><?= $rank->POSICION?></i>
							</figure>
						</section>
						<section class="letras__posicion">
                        <?php if(isset($rank->L_U) && $rank->L_U>0){?>
                            <i class="fa icon-unify-31 ok"  aria-hidden="true"></i>
					    <?php }else{?>
                            <i class="fa icon-unify-31"  aria-hidden="true"></i>
                        <?php }?>

                        <?php if(isset($rank->L_N) && $rank->L_N>0){?>
                            <i class="fa icon-unify-32 ok"  aria-hidden="true"></i>
                        <?php }else{?>
							<i class="fa icon-unify-32"  aria-hidden="true"></i>
                        <?php }?>

                        <?php if(isset($rank->L_I) && $rank->L_I>0){?>
                            <i class="fa icon-unify-33 ok"  aria-hidden="true"></i>
                        <?php }else{?>
							<i class="fa icon-unify-33"  aria-hidden="true"></i>
                        <?php }?>

                        <?php if(isset($rank->L_F) && $rank->L_F>0){?>
                            <i class="fa icon-unify-34 ok"  aria-hidden="true"></i>
                        <?php }else{?>
							<i class="fa icon-unify-34"  aria-hidden="true"></i>
                        <?php }?>

                        <?php if(isset($rank->L_Y) && $rank->L_Y>0){?>
                            <i class="fa icon-unify-35 ok"  aria-hidden="true"></i>
                        <?php }else{?>
							<i class="fa icon-unify-35"  aria-hidden="true"></i>
                        <?php }?>

                        <?php if(isset($rank->L_1) && $rank->L_1>0){?>
                            <i class="fa icon-unify-36 ok"  aria-hidden="true"></i>
                        <?php }else{?>
							<i class="fa icon-unify-36"  aria-hidden="true"></i>
                        <?php }?>

                        <?php if(isset($rank->L_7) && $rank->L_7>0){?>
                            <i class="fa icon-unify-37 ok"  aria-hidden="true"></i>
                        <?php }else{?>
							<i class="fa icon-unify-37"  aria-hidden="true"></i>
                        <?php }?>

						</section>
						<p class="paragraph datos__intentos">
							Ha completado el reto <?= $rank->palabra?> veces
						</p>
					</section>
				</section>
                <?php  }} ?>
                <article class="boton--reporte small-12 columns">
					<a href="<?=base_url()?>Admin/Reporte" class="button button--1">Reporte General</a>
				</article>
                <article class="boton--reporte small-12 columns">
					<a href="<?=base_url()?>Admin/Reporte_OC" class="button button--1">Reporte OC</a>
				</article>
                <article class="boton--reporte small-12 columns">
					<a href="<?=base_url()?>Admin/Reporte_LEAD" class="button button--1">Reporte LEADS</a>
				</article>
                <article class="boton--reporte small-12 columns">
					<a href="<?=base_url()?>Admin/Reporte_EVENTO" class="button button--1">Reporte EVENTOS</a>
				</article>
                <article class="boton--reporte small-12 columns">
					<a href="<?=base_url()?>Admin/Reporte_CERTI" class="button button--1">Reporte CERTIFICADOS</a>
				</article>
			</section>
		</section>
	<!-- End Contenido -->
