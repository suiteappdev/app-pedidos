<?php

class Producto_Model extends Model{
	
	public function __construct(){
		parent::__construct();
	}

    //esta funcion no se esta utilizando.
    public function ObtenerListaDeProductos(){
        return $this->db->select('SELECT pro.id, pro.embalaje, f1.id as idfamilia1, f2.id as idfamilia2, f3.id as idfamilia3, f4.id as idfamilia4, f5.id as idfamilia5, f1.urlimg as imgf1, f2.urlimg as imgf2, f3.urlimg as imgf3, f4.urlimg as imgf4, f5.urlimg as imgf5, pro.descripcion , f1.descripcion as familia1, f2.descripcion as familia2, f3.descripcion as familia3, f4.descripcion as familia4, f5.descripcion as familia5, est.id as idestado,  est.descripcion as estado FROM productos as pro INNER JOIN familia1 as f1 INNER JOIN familia2 as f2 INNER JOIN familia3 as f3 INNER JOIN familia4 as f4 INNER JOIN familia5 as f5 INNER JOIN estadoproductos as est WHERE pro.familia1 = f1.id and pro.familia2 = f2.id and pro.familia3 = f3.id and pro.familia4 = f4.id and pro.familia5 = f5.id and pro.estado = est.id');
    }

    public function ObtenerProductosCategoria($data){
        return $this->db->select('SELECT pro.id, pro.descripcion, imp.descripcion as iva, pro.embalaje, pro.urlimg, prealt.precioventa, (precioventa * imp.descripcion) / 100 as pventa, prealt.descuento1, prealt.descuento2, prealt.descuento3, prealt.subtotal  from productos as pro inner join impuesto as imp inner join preciosalternos as prealt WHERE familia1 = :familia1 and familia2 = :familia2 and familia3 = :familia3 and familia4 = :familia4 and familia5 = :familia5 and prealt.lineadeprecio = :linea and prealt.idpro = pro.id and prealt.iva = imp.id',
         array(
                ':familia1' => $data['familia1'],
                ':familia2' => $data['familia2'],
                ':familia3' => $data['familia3'],
                ':familia4' => $data['familia4'],
                ':familia5' => $data['familia5'],
                ':linea' => $data['linea']
                )
            );  
    }
    
    public function ObtenerTodo($data){
        $Query = 'select productos.descripcion, productos.id, productos.embalaje, imp.descripcion as iva, productos.urlimg, pn1.subtotal, pn1.precioneto, pn1.precioventa, (pn1.precioneto * imp.descripcion) / 100 as pventa, pn1.descuento1, pn1.descuento2, pn1.descuento3, pn1.subtotal  FROM productos INNER JOIN preciosalternos AS pn1 INNER JOIN impuesto as imp WHERE productos.id = pn1.idpro and pn1.lineadeprecio =:lineadeprecio and pn1.iva = imp.id';
        $Query.= $data['familia1'] != 1 ? ' and familia1= :familia1' : ' and familia1 >= :familia1';
        $Query.= $data['familia2'] != 1 ? ' and familia2= :familia2' : ' and familia2 >= :familia2';
        $Query.= $data['familia3'] != 1 ? ' and familia3= :familia3' : ' and familia3 >= :familia3';
        $Query.= $data['familia4'] != 1 ? ' and familia4= :familia4' : ' and familia4 >= :familia4';
        $Query.= $data['familia5'] != 1 ? ' and familia5= :familia5' : ' and familia5 >= :familia5';
        return $this->db->select($Query, array(
                ':familia1' => $data['familia1'],
                ':familia2' => $data['familia2'],
                ':familia3' => $data['familia3'],
                ':familia4' => $data['familia4'],
                ':familia5' => $data['familia5'],
                ':lineadeprecio' => $data['linea']
            ));
        
    }

    public function ObtenerLineas($data){
        return $this->db->select('SELECT clidet.lineadeprecios, clidet.zona, lip.descripcion FROM clientes as cli inner join clienteslineasdeprecios as clidet inner join lineasdeprecio as lip WHERE cli.identificacion=clidet.identificacion and lip.id = clidet.lineadeprecios and  cli.identificacion= :identificacion',
            array(':identificacion' => $data)
            );  
    }

    public function ObtenerProducto($id){
    	return $this->db->select('SELECT productos.descripcion, productos.id, productos.referencia1, productos.embalaje, productos.urlimg, pn1.precioneto FROM productos INNER JOIN preciosalternos AS pn1 WHERE productos.referencia1=pn1.referencia and pn1.lineadeprecio = :linea and categoria =:id',
    		array(
                ':id' => $data['id'],
                ':linea' => $data['linea']
                )
    	);
    }

    public function crearProducto($data){
        if(isset($data['image'])){
            $productId =  $this->db->insert('productos', array(
                'descripcion' => $data['descripcion'],
                'embalaje' => $data['embalaje'],
                'estado' => $data['estado'],
                'familia1' => $data['familia1'] == "null" ? 1 : $data['familia1'],
                'familia2' => $data['familia2'] == "null" ? 1 : $data['familia2'],
                'familia3' => $data['familia3'] == "null" ? 1 : $data['familia3'],
                'familia4' => $data['familia4'] == "null" ? 1 : $data['familia4'],
                'familia5' => $data['familia5'] == "null" ? 1 : $data['familia5'],
                'urlimg' => $data['image']
            ));
        }else{
            $productId =  $this->db->insert('productos', array(
                'descripcion' => $data['descripcion'],
                'embalaje' => $data['embalaje'],
                'estado' => $data['estado'],
                'familia1' => $data['familia1'],
                'familia2' => $data['familia2'],
                'familia3' => $data['familia3'],
                'familia4' => $data['familia4'],
                'familia5' => $data['familia5']
            ));
        }

        try {
            foreach ($data['ListaReferencias'] as $value) {
                $sth = $this->db->prepare('INSERT INTO referenciasalterna (idproducto, referencia) VALUES ( :idproducto, :referencia)');
                $sth->bindValue(':idproducto', $productId, PDO::PARAM_INT);
                $sth->bindValue(':referencia', empty($value->Referencia) ? null : $value->Referencia, PDO::PARAM_INT);

                $sth->execute();
            }            
        } catch (Exception $e) {
            return array(
                'error' => 'ya existe un producto con esta referencia'.$value->Referencia,
                'sqle' => json_encode($e)
                );
        }
            
        foreach ($data['ProductoPrecio'] as $value) {
            $this->db->insert('preciosalternos', array(
                    'precioneto' => $value->Base,
                    'iva' => $value->Iva,
                    'utilidad' => $value->Utilidad,
                    'totalutilidad' => $value->UtilidadTotal,
                    'descuento1' => $value->Descuento1,
                    'descuento2' => $value->Descuento2,
                    'descuento3' => $value->Descuento3,
                    'subtotal' => $value->Subtotal,
                    'precioventa' => $value->PrecioVenta,
                    'lineadeprecio'=> $value->LineaPrecio,
                    'idpro' => $productId
                ));                 
        }            

        if($productId){
            return array(
                    'success' => 'se ha creado correctamente.'
                );
        }else{
            return array(
                    'error' => 'ocurrio un error al guardar.'
                );
        }
    }

    public function obtenerPreciosProducto($data){
        return $this->db->select('SELECT * FROM preciosalternos WHERE idpro=:idproducto', array(
                ':idproducto' =>$data['idproducto']
            ));
    }

    public function ObtenerProductoReferencia($data){
        return $this->db->select('SELECT * FROM referenciasalterna WHERE idproducto=:idproducto', array(
                ':idproducto' =>$data['idproducto']
            ));
    }

    public function actualizarProducto($data){
        if(isset($data['image'])){
            $productId =  $this->db->update('productos', array(
                'descripcion' => $data['descripcion'],
                'embalaje' => $data['embalaje'],
                'estado' => $data['estado'],
                'familia1' => $data['familia1'] == "null" ? 1 : $data['familia1'],
                'familia2' => $data['familia2'] == "null" ? 1 : $data['familia2'],
                'familia3' => $data['familia3'] == "null" ? 1 : $data['familia3'],
                'familia4' => $data['familia4'] == "null" ? 1 : $data['familia4'],
                'familia5' => $data['familia5'] == "null" ? 1 : $data['familia5'],
                'urlimg' => $data['image']
            ), 'id='.$data['idproducto']);
        }else{
            $this->db->update('productos', array(
                'descripcion' => $data['descripcion'],
                'embalaje' => $data['embalaje'],
                'estado' => $data['estado'],
                'familia1' => $data['familia1'] == "null" ? 1 : $data['familia1'],
                'familia2' => $data['familia2'] == "null" ? 1 : $data['familia2'],
                'familia3' => $data['familia3'] == "null" ? 1 : $data['familia3'],
                'familia4' => $data['familia4'] == "null" ? 1 : $data['familia4'],
                'familia5' => $data['familia5'] == "null" ? 1 : $data['familia5']
            ), 'id='.$data['idproducto']);
        }

        try {
            foreach ($data['ListaReferencias'] as $value) {
                $sth = $this->db->prepare('UPDATE referenciasalterna SET referencia = :referencia WHERE id = :id');
                $sth->bindValue(':referencia', empty($value->Referencia) ? null : $value->Referencia, PDO::PARAM_INT);
                $sth->bindValue(':id', $value->id, PDO::PARAM_INT);
                $sth->execute();
            }            
        } catch (Exception $e) {
            return array(
                'error' => $e
                );
        }
        
        foreach ($data['ProductoPrecio'] as $value) {
            $affectedRow = $this->db->update('preciosalternos', array(
                    'precioneto' => $value->Base,
                    'iva' => $value->Iva,
                    'descuento1' => $value->Descuento1,
                    'descuento2' => $value->Descuento2,
                    'descuento3' => $value->Descuento3,
                    'utilidad' => $value->Utilidad,
                    'totalutilidad' => $value->UtilidadTotal,
                    'subtotal' => $value->Subtotal,
                    'precioventa' => $value->PrecioVenta
                ), 'idpro='.$data['idproducto'].' and lineadeprecio='.$value->LineaPrecio);

            if($affectedRow->rowCount() == 0){
                $this->db->insert('preciosalternos', 
                    array(
                        'precioneto' => $value->Base,
                        'idpro' => $value->idproducto,
                        'lineadeprecio' => $value->LineaPrecio,
                        'iva' => $value->Iva,
                        'descuento1' => $value->Descuento1,
                        'descuento2' => $value->Descuento2,
                        'descuento3' => $value->Descuento3,
                        'utilidad' => $value->Utilidad,
                        'totalutilidad' => $value->UtilidadTotal,
                        'subtotal' => $value->Subtotal,
                        'precioventa' => $value->PrecioVenta
                        )
                    );
            }

        }
    }

    public function actualizarPrecios($values){
        $this->db->insert('preciosalternos', 
            array(
                'precioneto' => $value->Base,
                'idpro' => $value->idproducto,
                'lineadeprecio' => $value->LineaPrecio,
                'iva' => $value->Iva,
                'descuento1' => $value->Descuento1,
                'descuento2' => $value->Descuento2,
                'descuento3' => $value->Descuento3,
                'utilidad' => $value->Utilidad,
                'totalutilidad' => $value->UtilidadTotal,
                'subtotal' => $value->Subtotal,
                'precioventa' => $value->PrecioVenta
                )
            );
    }

    public function buscarProductoPorColumna($data){
        if($data['col'] == 'referencia'){
            $val = $data['val'];
                return $this->db->select('SELECT pro.id,pro.urlimg, pro.embalaje, f1.id as idfamilia1, f2.id as idfamilia2, f3.id as idfamilia3, f4.id as idfamilia4, f5.id as idfamilia5, f1.urlimg as imgf1, f2.urlimg as imgf2, f3.urlimg as imgf3, f4.urlimg as imgf4, f5.urlimg as imgf5, pro.descripcion , f1.descripcion as familia1, f2.descripcion as familia2, f3.descripcion as familia3, f4.descripcion as familia4, f5.descripcion as familia5, est.id as idestado,  est.descripcion as estado FROM productos as pro INNER JOIN familia1 as f1 INNER JOIN familia2 as f2 INNER JOIN familia3 as f3 INNER JOIN familia4 as f4 INNER JOIN familia5 as f5 INNER JOIN estadoproductos as est inner join referenciasalterna as ref WHERE pro.familia1 = f1.id and pro.familia2 = f2.id and pro.familia3 = f3.id and pro.familia4 = f4.id and pro.familia5 = f5.id and pro.estado = est.id and ref.referencia = :val and pro.id = ref.idproducto',
                array(
                        ':val' => $val
                    )
                );
        }else{
            $val = $data['val'];
                return $this->db->select('SELECT pro.id, pro.urlimg, pro.embalaje, f1.id as idfamilia1, f2.id as idfamilia2, f3.id as idfamilia3, f4.id as idfamilia4, f5.id as idfamilia5, f1.urlimg as imgf1, f2.urlimg as imgf2, f3.urlimg as imgf3, f4.urlimg as imgf4, f5.urlimg as imgf5, pro.descripcion , f1.descripcion as familia1, f2.descripcion as familia2, f3.descripcion as familia3, f4.descripcion as familia4, f5.descripcion as familia5, est.id as idestado,  est.descripcion as estado FROM productos as pro INNER JOIN familia1 as f1 INNER JOIN familia2 as f2 INNER JOIN familia3 as f3 INNER JOIN familia4 as f4 INNER JOIN familia5 as f5 INNER JOIN estadoproductos as est WHERE pro.familia1 = f1.id and pro.familia2 = f2.id and pro.familia3 = f3.id and pro.familia4 = f4.id and pro.familia5 = f5.id and pro.estado = est.id and  pro.descripcion like :val ',
                array(
                        ':val' => "%$val%"
                    )
                );
        }
    }
}