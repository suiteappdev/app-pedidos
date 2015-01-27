<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pedido extends Controller {

    function __construct() {
        parent::__construct(); 
	    $this->view->css = array('reports/css/pdfprint.css');
        //header('content-type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
    }

    function enviar(){
        $data = array(
                'identificacion' => $_POST['identificacion'],
                'subtotal' => $_POST['subtotal'],
                'dto1' => $_POST['dto1'],
                'vdcto1' => $_POST['vdcto1'],
                'dto2' => $_POST['dto2'],
                'vdcto2' => $_POST['vdcto2'],
                'dto3' => $_POST['dto3'],
                'vdcto3' => $_POST['vdcto3'],
                'totaldto' => $_POST['totaldto'],
                'iva' => $_POST['iva'],
                'total' => $_POST['total'],
                'tmuestra' => $_POST['tmuestra'],
                'tunidades' => $_POST['tunidades'],
                'observacion' => $_POST['observacion'],
                'idvendedor' => $_POST['idvendedor'],
                'geolocalizacion' => $_POST['geolocalizacion'],
                'iva1' => $_POST['iva1'],
                'valriva1' => $_POST['valriva1'],
                'baseimp1' => $_POST['baseimp1'],
                'iva2' => $_POST['iva2'],
                'valriva2' => $_POST['valriva2'],
                'baseimp2' => $_POST['baseimp2'],
                'iva3' => $_POST['iva3'],
                'valriva3' => $_POST['valriva3'],
                'baseimp3' => $_POST['baseimp3'],
                'productos' => json_decode(stripslashes($_POST['productos']))
            );

        $val = $this->model->EnviarPedido($data);

        $output = json_encode(array("status" => "true"));

 		echo isset($_GET['callback'])? "{$_GET['callback']}($output)" : $output;
    }

    function obtenerPedidos(){
        $output=null;

        $data = array(
            'idvendedor' => $_GET['idvendedor']
            );

        foreach ($this->model->ObtenerPedidos($data) as $value) {
            $output[]=array_map('utf8_encode', $value);
        }
        
        $pedidoList = json_encode($output);
        
	    echo isset($_GET['callback'])? "{$_GET['callback']}($pedidoList)" : $pedidoList;
    }
    
    function index() {
    	$this->obtenerPedidos();
    }

    function ObtenerTodosLosPedidos(){
	    	$data = '';
	    	$data .= isset($_POST['estado']) ? ' and ped.estado ='.$_POST['estado'] : '';
	    	$data .= isset($_POST['init']) && isset($_POST['post']) ?  ' and date(ped.fechapedido) between "'.$_POST['init'].'" and "'.$_POST['post'].'"' : '';
	    	$data .= isset($_POST['init']) && !isset($_POST['post']) ? ' and date(ped.fechapedido) = "'.$_POST['init'].'"' : '';
	    	$data .= $_POST['column'] == 1 ? ' and concat(cli2.nombres, " ", cli2.apellidos) like "%'.$_POST['criteria'].'%"' : ' and concat(cli.nombres," ",cli.apellidos) like "%'.$_POST['criteria'].'%"'; 
	    	echo json_encode($this->model->ObtenerTodosLosPedidos($data));	
    }

    function DetallePedido(){
    	$data['idpedido'] = $_POST['idpedido'];
    	echo json_encode($this->model->DetallePedido($data));
    }

    function actualizarEstadoPedido(){
    	$data['estado'] = $_POST['estado'];
    	$data['pedido'] = $_POST['pedido'];
    	$affectedRow = $this->model->actualizarEstadoPedido($data);
    	if($affectedRow){
    		echo json_encode(array(
    			'success' => 'estado cambiado correctamente'
    			));
    	}else{
    		echo json_encode(array(
    			'error' => 'no se pudo actualizar el pedido'
    			));
    	}
    }

    function pedidoPDF(){
	require_once('libs/dompdf/dompdf_config.inc.php');
		$detalle['idpedido'] = $_POST['idpedido'];
		$pedido = ' and ped.idpedido = '.$_POST['idpedido'];

    	ob_start();
    	$header = $this->view->render('reports/header');
    	
    	$this->view->pedido = $this->model->obtenerTodosLosPedidos($pedido);
    	$this->view->detalle = $this->model->DetallePedido($detalle);

        $body = $this->view->render('reports/pedido/index');
        $footer = $this->view->render('reports/footer');
        $htmlOutput = ob_get_contents();
        ob_clean();
    	ob_flush();

		$dompdf = new DOMPDF();
		$html = $htmlOutput;
		 
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream("pedido.pdf", array('Attachment'=>0));
    }

	function jsonp_decode($jsonp, $assoc = false) { // PHP 5.3 adds depth as third parameter to json_decode
	    if($jsonp[0] !== '[' && $jsonp[0] !== '{') { // we have JSONP
	       $jsonp = substr($jsonp, strpos($jsonp, '('));
	    }
	    return json_decode(trim($jsonp,'();'), $assoc);
	}

	public function vista(){
        echo $this->loadPartial($_POST['vista']);
    } 
}