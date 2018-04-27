<header class="header--navigation">
	<a href="javascript:window.history.go(-1);" class="header__navigation--back">
		<i class="fa icon-unify-4" aria-hidden="true"></i>
		<span>VOLVER</span>
	</a>
	<img src="<?= base_url();?>assets/images/site/header/logo__unify.jpg" alt="Unify">
</header>
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
				<a href="<?=base_url();?>Cliente/agregar" id="botonAgregar" class="<?php if(isset($boton) && $boton=="agregar") echo "boton-activo";?>">
					<i class="fa icon-unify-13"></i>
					<span>AGREGAR</span>
				</a>
			</li>
			<li>
				<a href="<?=base_url();?>Cliente/perfil" id="botonPerfil" class="<?php if(isset($boton) && $boton=="perfil") echo "boton-activo";?>">
					<div class="content--perfil pic-active" >
						<i class="fa icon-unify-15" style="background-image: url('<?= base_url()?>documentos/fotos/<?= $foto_perfil?>')"></i>
					</div>
					<span>PERFIL</span>
				</a>
			</li>
		</ul>
	</section>
</nav>