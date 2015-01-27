<div class="wrap">
	<div class="colset-1">
		<div id="logo">

		</div>
		<div id="info">
			<h3 class="centered">COSMETICOS JOHNVERY S.A.S.</h3>
			<p class="centered text">www.johnvery.com</p>
			<p class="centered text">NIT: 900136121</p>
		</div>
	</div>
	<div class="colset-1" style="height:130px;">
		<div class="colset-3">
			<table>
				<tr><td><h4>ORDEN DE PEDIDO</h4></td><td><h4><?php echo $this->pedido[0]['idpedido']?></h4></td></tr>
				<tr><td>Estado</td><td><?php echo strtolower($this->pedido[0]['descripcion'])?></td></tr>
				<tr><td>Fecha del pedido:</td><td><?php echo $this->pedido[0]['fechapedido']?></td></tr>
				<tr><td>No. Cajas:</td><td> </td></tr>
				<tr><td>Peso:</td><td> </td></tr>
				<tr><td>Volumen:</td><td> </td></tr>
			</table>
		</div>
		<div class="colset-3">
			<table>
				<tr><td colspan="2"><h4>INFORMACION DEL CLIENTE</h4></td></tr>
				<tr><td>Vendedor:</td><td><?php echo strtolower($this->pedido[0]['vendedor']) ?></td></tr>
				<tr><td>Cliente:</td><td><?php echo strtolower($this->pedido[0]['nombrecompleto']) ?></td></tr>
				<tr><td>Identificacion:</td><td><?php echo $this->pedido[0]['idvendedor'] ?></td></tr>
				<tr><td>Ubicacion:</td><td><?php echo strtolower($this->pedido[0]['geolocalizacion']) ?></td></tr>
				<tr><td>Telefono:</td><td>301 333 178</td></tr>
			</table>
		</div>
		<div class="colset-3">
			<table>
				<tr><td colspan="2"><h4>INFORMACION DEL VENDEDOR</h4></td></tr>
				<tr><td>Vendedor:</td><td><?php echo strtolower($this->pedido[0]['vendedor']) ?></td></tr>
				<tr><td>Cliente:</td><td><?php echo strtolower($this->pedido[0]['nombrecompleto']) ?></td></tr>
				<tr><td>Identificacion:</td><td><?php echo $this->pedido[0]['idvendedor'] ?></td></tr>
				<tr><td>Ubicacion:</td><td><?php echo strtolower($this->pedido[0]['geolocalizacion']) ?></td></tr>
				<tr><td>Telefono:</td><td>301 333 178</td></tr>
			</table>
		</div>
	</div>
	<div class="colset-1">
		<h3 class="text">Observacion:</h3>
		<p class="text"><?php echo strtolower($this->pedido[0]['observacion']) ?></p>
	</div>
	<div class="colset-1">
		<table style="width:100%;" class="datatable">
			<thead>
				<tr>
					<td>CODIGO</td>
					<td>DESCRIPCION</td>
					<td>CANTIDAD</td>
					<td>DESPACHO</td>
					<td>%DTO 1</td>
					<td>%DTO 2</td>
					<td>%DTO 3</td>
					<td>IVA</td>
					<td>SUBTOTAL</td>
					<td>VLR UNITARIO</td>
					<td>TOTAL</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->detalle as $value) : ?>
					<tr><td><?php echo $value['referencia']?></td><td><?php echo $value['descripcion']?></td><td><?php echo $value['cantidad']?></td><td></td><td><?php echo $value['descuento1'].'%'?></td><td><?php echo $value['descuento2'].'%'?></td><td><?php echo $value['descuento3'].'%'?></td><td><?php echo $value['iva'].'%'?></td><td><?php echo $value['subtotal']?></td><td><?php echo $value['precioventa']?></td><td><?php echo $value['total']?></td></tr>
				<?php endforeach?>
			</tbody>
			<tfoot>
				<thead>
					<tr><td>Tipo</td><td>Base/Imp</td><td>Valor Iva</td></tr>
				</thead>
				<tbody>
					<tr><td><?php echo $this->pedido[0]['iva1']?></td><td><?php echo $this->pedido[0]['baseimp1']?></td><td><?php echo $this->pedido[0]['valriva1']?></td></tr>
					<tr><td><?php echo $this->pedido[0]['iva2']?></td><td><?php echo $this->pedido[0]['baseimp2']?></td><td><?php echo $this->pedido[0]['valriva2']?></td></tr>
					<tr><td><?php echo $this->pedido[0]['iva3']?></td><td><?php echo $this->pedido[0]['baseimp3']?></td><td><?php echo $this->pedido[0]['valriva3']?></td></tr>
				</tbody>
				<tr><td colspan="10" style="text-align:right;">SubTotal</td><td><?php echo $this->pedido[0]['subtotal']?></td></tr>
				<tr><td colspan="10" style="text-align:right;">Descuento</td><td><?php echo $this->pedido[0]['vdcto1']?></td></tr>
				<tr><td colspan="10" style="text-align:right;">Descuento</td><td><?php echo $this->pedido[0]['vdcto2']?></td></tr>
				<tr><td colspan="10" style="text-align:right;">Descuento</td><td><?php echo $this->pedido[0]['vdcto3']?></td></tr>
				<tr><td colspan="10" style="text-align:right;">Iva</td><td><?php echo $this->pedido[0]['iva']?></td></tr>
				<tr><td colspan="10" style="text-align:right;">Total Documento</td><td><?php echo $this->pedido[0]['total']?></td></tr>
			</tfoot>
		</table>
	</div>
</div>