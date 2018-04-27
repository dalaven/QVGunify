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

		<section class="layaout__perfil--1"></section>

		<section class="row content__layaout--perfil"> <!-- nueva -->
			<section class="layaout__perfil--2 small-12  medium-4 large-3 columns"><!-- nueva -->
				<section class="row">
					<figure class="layaout__perfil__2--avatar" style="background-image: url('<?= base_url()?>documentos/fotos/<?= $foto_perfil?>')">
						<i class="ranking" id="ranking"><?if(isset($ranking) )echo $ranking; else echo "00";?></i>
					</figure>
					<span class="ranking--text">Puesto en la competencia</span>
				</section>
				</section>

		<section class="layaout__perfil--3 small-12 medium-8 large-9 columns"><!-- nueva -->
				<section class="row">
					<h1 class="title text-center"><?=$this->session->userdata('username')?></h1>
				<h3 class="paragraph text-center"><?=$this->session->userdata('cargo')?></h3>
				<h4 class="text-center paragraph">
					<?=$this->session->userdata('correo')?><br>
					CC.<?=$this->session->userdata('documento')?>
				</h4>

				<ul class="layaout__perfil__3--navigation">
					<li><a href="settings"><i class="fa icon-unify-16"  aria-hidden="true"></i>Cambiar mis datos</a></li>
                    
					<li><a href="password"><i class="fa icon-unify-10"  aria-hidden="true"></i>Cambiar mi contraseña</a></li>
                    
					<li><a href="asistencia"><i class="fa fa-bug"  aria-hidden="true"></i>Obtener asistencia</a></li>
					<li><a href="politicas"><i class="fa icon-unify-18"  aria-hidden="true"></i>Políticas de tratamiento de datos</a></li>
                    <li><a href="faq"><i class="fa icon-unify-17"  aria-hidden="true"></i>FAQ</a></li>

				</ul>
				<div class="layaout__perfil__3--sesion">
					<a href="<?=base_url();?>Login/logout" class="button button--2">CERRAR SESIÓN</a>
					<h5 class="paragraph text-center">
							Unify Colombia 2017  <br>
							Versión 1.0.0<br>
							<a href="http://www.quevisiongrafica.com" target="_blank" class="qvg">Design by Que Vision Grafica Group</a>
						</h5>
				</div>
			</section>
		</section>
            
            <script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>
            <script>activeWebClip();</script>
</body>
</html>
