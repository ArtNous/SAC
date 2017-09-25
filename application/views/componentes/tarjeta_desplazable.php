<div class="container">
	<div class="row">
		<?php foreach($servicios as $servicio):?>
		<div class="card col s12 m4 l4">
			<div class="card-image">
				<img src="<?php echo base_url('assets/img/playa.jpg');?>">
				<span class="card-title"><?php echo $servicio->nombre; ?></span>
				<a class="btnAbrirCarta btn-floating halfway-fab waves-effect waves-light red" id=""><i class="material-icons">create</i></a>
			</div>
			<div class="card-content">
				<p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
			</div>
			<div class="card-hidden">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima ratione ex soluta praesentium, delectus omnis at provident eius modi dolorem amet, rem ullam aperiam. Consectetur voluptas impedit doloremque, ratione quidem.</p>
			</div>
		</div>
	<?php endforeach;?>
	</div>
</div>
<!--
estilo necesario para la vista
.card{
	overflow: hidden;
}
.card-hidden{
	position: absolute;
	bottom: 0;
	top: 100%;
	padding: 4px 10px;
	margin: 0;
	background-color: white;
} -->