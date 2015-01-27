<?php
class Pedido_Model extends Model{
	
	public function __construct(){
		parent::__construct();
	}

    public function EnviarPedido($data){
        try {
                $id =  $this->db->insert('pedidos',
                    array(
                        'identificacion' => $data['identificacion'],
                        'subtotal' => $data['subtotal'],
                        'dto1' => $data['dto1'],
                        'vdcto1' => $data['vdcto1'],
                        'dto2' => $data['dto2'],
                        'vdcto2' => $data['vdcto2'],
                        'dto3' => $data['dto3'],
                        'vdcto3' => $data['vdcto3'],
                        'totaldescuento' => $data['totaldto'],
                        'iva' => $data['iva'],
                        'total' => $data['total'],
                        'tmuestra' => $data['tmuestra'],
                        'tunidades' => $data['tunidades'],
                        'observacion' => $data['observacion'],
                        'idvendedor' => $data['idvendedor'],
                        'geolocalizacion' => $data['geolocalizacion'],
                        'fechapedido' => date("Y-m-d H:i:s"),
                        'idvendedor' => $data['idvendedor'],
                        'estado' =>'1',
                        'geolocalizacion' => $data['geolocalizacion'],
                        'iva1' => $data['iva1'],
                        'valriva1' => $data['valriva1'],
                        'baseimp1' => $data['baseimp1'],
                        'iva2' => $data['iva2'],
                        'valriva2' => $data['valriva2'],
                        'baseimp2' => $data['baseimp2'],
                        'iva3' => $data['iva3'],
                        'valriva3' => $data['valriva3'],
                        'baseimp3' => $data['baseimp3']
                        )
                    );
        }
        catch(Exception $e) {
            echo $e->getMessage();
            die();
        }

        $this->agregarDetallepedido($data['productos'], $id);

        return $id;

    }

    private function agregarDetallepedido($data, $idpedido){
        foreach ($data as $value) {
            $this->db->insert('pedidodetalle',
                array(
                    'idpedido' =>$idpedido,
                    'idpro' => $value->id,
                    'cantidad' => $value->cantidad,
                    'iva' => $value->iva,
                    'descuento1' => $value->descuento1,
                    'descuento2' => $value->descuento2,
                    'descuento3' => $value->descuento3,
                    'subtotal' => $value->subtotal,
                    'referencia' => $value->referencia,
                    'precioventa' => $value->precioventa,
                    'descripcion' => $value->descripcion
                    )
                );
        }
    }

    function DetallePedido($data){
        return $this->db->select('select id, idpedido, idpro, referencia, cantidad, precioventa, iva, descuento1, descuento2, descuento3, descripcion, subtotal, precioventa * cantidad as total from pedidodetalle where idpedido = :idpedido', array(
                ':idpedido' => $data['idpedido']
            ));
    }

    function ObtenerPedidos($data){
        return $this->db->select('SELECT ped.idpedido,   est.descripcion, ped.geolocalizacion,  concat(cli.nombres," ",cli.apellidos) as nombrecompleto, ped.total, ped.fechapedido, ped.estado FROM pedidos AS ped INNER JOIN clientes AS cli INNER JOIN estadospedidos AS est WHERE ped.idvendedor = :idvendedor AND ped.identificacion = cli.identificacion AND ped.estado = est.id',
                array(':idvendedor' => $data['idvendedor'])
            );
    }

    function obtenerTodosLosPedidos($data){
        return $this->db->select('SELECT ped.idpedido,ped.observacion,  concat(cli2.nombres," ",cli2.apellidos) as vendedor, ped.tunidades,  est.descripcion, ped.geolocalizacion,  concat(cli.nombres," ",cli.apellidos) as nombrecompleto, ped.fechapedido, ped.idvendedor, ped.estado, ped.subtotal, ped.dto1, ped.vdcto1, ped.dto2, ped.vdcto2, ped.dto3, ped.vdcto3, ped.iva,ped.totaldescuento, ped.total, ped.iva1, ped.iva2, ped.iva3, ped.valriva1, ped.valriva2, ped.valriva3, baseimp1, baseimp2, baseimp3 FROM pedidos as ped INNER JOIN clientes as cli INNER JOIN clientes as cli2 INNER JOIN estadospedidos as est WHERE ped.identificacion = cli.identificacion and ped.estado = est.id and ped.idvendedor = cli2.identificacion '.$data);
    }

    function actualizarEstadoPedido($data){
        return $this->db->update('pedidos', array(
            'estado' => $data['estado']
                        ),
                'idpedido = '.$data['pedido']
            );
    }
}