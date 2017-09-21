<main>
	<nav id="barra-secundaria" class="container-fluid">
		<div class="nav-wrapper left">
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="<?php echo base_url('cliente/crear'); ?>">Clientes<i class="material-icons right">face</i></a></li>
				<li><a href="<?php echo base_url('servicios'); ?>">Servicios<i class="material-icons right">apps</i></a></li>
				<li><a href="<?php echo base_url('tecnicos'); ?>">Técnicos<i class="material-icons right">account_circle</i></a></li>
				<li><a href="<?php echo base_url('vehiculo'); ?>">Vehículos<i class="material-icons right">directions_car</i></a></li>
				<li><a href="<?php echo base_url('orden/'); ?>">Orden<i class="material-icons right">content_paste</i></a></li>
				<?php if ($this->session->userdata('rol') == 1): ?>
				<li><a href="<?php echo base_url('configuracion'); ?>">Configuración<i class="material-icons right">build</i></a></li>					
				<?php endif ?>
				<li><a class="dropdown-button" href="<?php echo base_url('reportes'); ?>"><i class="material-icons right">insert_chart</i>Reportes</a></li>
			</ul>
		</div>
	</nav>
	<aside style="background-color: gray;">
		<ul id="slide-out" class="side-nav">
			<li><div class="user-view">
				<div class="background">
					<img src="<?php echo base_url('assets/img/banner_sidenav.jpg'); ?>">
				</div>
				<a href="#!user"><img class="circle" src="<?php echo base_url('assets/img/avatar_hombre.png');?>"></a>
				<a href="#!name"><span class="white-text name"><?php echo $this->session->userdata('usuario'); ?></span></a>
				<a href="#!email"><span class="white-text email"><?php echo $this->session->userdata('email'); ?></span></a>
			</div></li>
			<li><a href="<?php echo base_url(); ?>"><i class="material-icons">developer-dashboard</i>Menu principal</a></li>
			<li><a href="#!"><i class="material-icons">description</i>Reportes</a></li>
			<li><div class="divider"></div></li>
			<li><a class="subheader">Ayuda</a></li>
			<li><a class="waves-effect" href="#!">Manual</a></li>
			<?php if($this->session->userdata('rol') == 1): ?>
			<li><a class="waves-effect" href="<?php echo base_url('auth/registrar'); ?>">Registrar usuario</a></li>
			<li style="padding: 0 30px;">
				<?php 
					$opciones[''] = 'Seleccione la base de datos';
					foreach($bds as $bd){
						$opciones[$bd] = $bd;
					}
					echo form_dropdown('bd',$opciones,set_value('bd'),'id="comboBD"');
				 ?>
			</li>
			<?php endif; ?>
			<li><a class="waves-effect" href="<?php echo base_url('auth/logout'); ?>">Cerrar sesión</a></li>
		</ul>
	</aside>
	<!-- Boton para acciones rapidas -->
	<div class="fixed-action-btn click-to-toggle">
		<a class="btn-floating btn-large red" id="menu_acciones">
			<i class="large material-icons">add</i>
		</a>
		<ul>
			<li><a class="btn-floating brown tooltipped" data-position="left" data-tooltip="Crear Servicio" data-delay="50" href="<?php echo base_url('servicios/crear'); ?>"><i class="material-icons">settings</i></a></li>
			<li><a class="btn-floating yellow tooltipped" data-position="left" data-tooltip="Crear Vehículo" data-delay="50" href="<?php echo base_url('vehiculo/crear'); ?>"><i class="material-icons">directions_car</i></a></li>
			<li><a class="btn-floating black tooltipped" data-position="left" data-tooltip="Crear Marca" data-delay="50" href="<?php echo base_url('marcas/crear'); ?>"><i class="material-icons">airport_shuttle</i></a></li>
			<li><a class="btn-floating magenta tooltipped" data-position="left" data-tooltip="Crear Cliente" data-delay="50" href="<?php echo base_url('cliente/crear'); ?>"><i class="material-icons">group_add</i></a></li>
			<li><a class="btn-floating orange tooltipped" data-position="left" data-tooltip="Crear Orden de Servicio" data-delay="50" href="<?php echo base_url('orden/crear'); ?>"><i class="material-icons">content_paste</i></a></li>
		</ul>
		<!-- Tap Target Structure -->
		<div class="tap-target" data-activates="menu_acciones">
			<div class="tap-target-content">
				<h5 style="color: white">Menu de operaciones</h5>
				<p style="color: white">Aqui puedes realizar una acción rápida o ver las operaciones en ejecución.</p>
			</div>
		</div>
	</div>
	<!-- ./ -->
	<nav>
		<div class="nav-wrapper">
			<div class="col s12">
			<?php foreach($niveles as $nivel): ?>
				<a href="<?php echo $nivel['url']; ?>" class="breadcrumb"><?php echo $nivel['nombre']; ?></a>
			<?php endforeach; ?>
			</div>
		</div>
	</nav>