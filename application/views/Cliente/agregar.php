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
<section class="portraitUse"></section>
<section class="layaout__agregar--1">
		<section class="row">
			<article class="small-12 medium-12 large-12 columns">
				<h1 class="title">
					¿QUE TE GUSTARÍA REGISTRAR?
				</h1>
			</article>
			<article class="small-6 medium-6 large-6 columns">
				<a href="<?=base_url()?>Cliente/oCompras" class="layaout__agregar--boton">
					<figure class="layaout__agregar--min layaout__agregar--min-1"></figure>
					<span class="layaout__agregar--txt">ORDEN DE COMPRA</span>
				</a>
			</article>
			<article class="small-6 medium-6 large-6 columns">
				<a href="<?=base_url()?>Cliente/oportunidad" class="layaout__agregar--boton">
					<figure class="layaout__agregar--min layaout__agregar--min-2"></figure>
					<span class="layaout__agregar--txt">NUEVOS LEADS</span>
				</a>
			</article>
			<article class="small-6 medium-6 large-6 columns">
				<a href="<?=base_url()?>Cliente/evento" class="layaout__agregar--boton">
					<figure class="layaout__agregar--min layaout__agregar--min-3"></figure>
					<span class="layaout__agregar--txt">EVENTO</span>
				</a>
			</article>
			<article class="small-6 medium-6 large-6 columns"> 
				<a href="<?=base_url()?>Cliente/certificacion" class="layaout__agregar--boton">
					<figure class="layaout__agregar--min layaout__agregar--min-4"></figure>
					<span class="layaout__agregar--txt">CERTIFICACIONES</span>
				</a>
			</article>
		</section>
	</section>
<script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>
<script>activeWebClip();</script>
</body>
</html>

