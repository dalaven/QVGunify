<header class="header--harmonize">
	<img src="<?= base_url();?>assets/images/site/header/logo__unify--harmonize.jpg" alt="Unify">
</header>

<section class="portraitUse"></section>
<section class="layaout__registroConfirma--bg"></section>
	<section class="layaout__registroConfirma">
		<article class="row text-center">
            <section class="small-12 medium-8 large-8 columns small-centered padding-no"> <!--nuevo-->
				<h1 class="title text__colour--1">
					¡LISTO! <?=$this->session->userdata('nombre')?>
				</h1>
				<p class="paragraph white">
					Gracias por crear tu nuevo usuario. Te enviamos un link a tu email inscrito para que puedas <strong class="text__colour--1">verificar tu cuenta creada antes de iniciar sesión puede tardar algunos minutos en llegarte el email.</strong> También puedes verificar tu carpeta de spam!
				</p>
				<a href="<?= base_url();?>" class="button button--1">VOLVER AL INICIO DE SESIÓN</a>
			</section>
		</article>
	</section>
<script type="text/javascript" src="<?= base_url();?>assets/js/core.min.js"></script>
<script>
</script>
</body>
</html>
