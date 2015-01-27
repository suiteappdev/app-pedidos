<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="nav-bar" style="position:relative;">
	<div class="nav-bar-inner">
		<div class="form-title">
			<h3 class="board-title light">Mis Cliente</h3>
			<p class="board-legend animated fadeInLeft">Vista para informacion de Clientes, Usuarios, Roles , y altas...</p>
		</div>
			<!--shorcut-->
			<div class="shorcut">
				<div class="board-item icon-user2 animated bounceIn" data-cmdaction="Mostrar"  data-entity="Usuario">
					<h1 class="light menu-text board-item-text">Usuarios</h1>
				</div>
				<div class="board-item icon-address-book animated bounceIn" data-cmdaction="Mostrar"  data-entity="UsuarioZona">
					<h1 class="light menu-text board-item-text">Zonas de Vendedores</h1>
				</div>
				<div class="board-item icon-users animated bounceIn" data-cmdaction="Mostrar"  data-entity="tipoCliente">
					<h1 class="light menu-text board-item-text">Tipos de Usuarios</h1>
				</div>
				<div class="board-item icon-tree animated bounceIn" data-cmdaction="Mostrar"  data-entity="tipoIdentificacion">
					<h1 class="light menu-text board-item-text">Tipos de identificacion</h1>
				</div>

				<div class="board-item icon-powercord animated bounceIn" data-cmdaction="Mostrar"  data-entity="EstadoCliente">
					<h1 class="light menu-text board-item-text">Estados</h1>
				</div>
			</div>
			<!--end shorcut-->
	</div>
</div>