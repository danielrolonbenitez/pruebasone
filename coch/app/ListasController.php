<?php

error_reporting(E_ALL);
ini_set( 'display_errors','1');

class ListasController extends AppController {
	public $uses = array('Client', 'Category', 'ProductVariant', 'Currency', 'List', 'ListItem', 'Product');
	
	public function beforeFilter() {
		if($this->params['action'] != 'login') {
			$client = $this->Session->read('login_client');
			if(empty($client)) $this->redirect('/');
			$this->set(compact('client'));
			$this->set('listas_panel', true);
			$this->client = $client;
		}
	}
	
	public function login() {
		$this->layout = 'panel';
		$client = $this->Client->find(
			'first',
			array(
				'conditions' => array(
					'Client.user' => $_POST['username'],
					'Client.password' => md5($_POST['password'])
				)
			)
		);
		if($client) {
			$this->Session->write('login_client', $client);
			$this->redirect('/listas/');
		}
		else $this->redirect('/');
	}
	public function logout() {
		$this->Session->write('login_client', NULL);
		$this->redirect('/');
	}
	
	public function index() {
		$dollar_value = $this->Currency->findById(2);
		$dollar_value = $dollar_value['Currency']['value'];
		
		$this->Category->unbindModel(array('belongsTo' => array('Parent')));
		$this->Category->recursive = 4;
		$categories = $this->Category->find('all', array('conditions' => array('Category.category_id' => NULL)));
		
		$lists_by_user = $this->List->find('all', array('conditions' => array('List.client_id' => $this->client['Client']['id'])));
		
		$this->set(compact('categories', 'dollar_value', 'lists_by_user'));
	}
	public function load_category() {
		$variants = $this->ProductVariant->find(
			'all',
			array(
				'conditions' => array(
					'Product.category_id' => $_POST['category']
				)
			)
		);
		echo json_encode($variants);
		die();
	}
	
	
	public function save() {
		$status = array();
		$this->List->begin();
		
		$elm = $this->List->findByClientId($_POST['client_id']);
		if(empty($elm)) $this->List->create();
		else $this->List->id = $elm['List']['id'];
		
		$list_data = array(
			'List' => array(
				'client_id' => $_POST['client_id'],
				'currency_id' => $_POST['currency_id'],
				'exchange_rate' => $_POST['exchange_rate']
			)
		);
		
		if(!empty($_POST['new_list'])) {
			$this->List->create();
			$list_data['List']['name'] = $_POST['new_list'];
		}
		else {
			if($_POST['list'] == -1) {
				$list_def = $this->List->findByName('Lista predeterminada');
				if(!empty($list_def)) $list_data['List']['id'] = $list_def['List']['id'];
				else {
					$this->List->create();
					$list_data['List']['name'] = 'Lista predeterminada';
				}
			}
		}
		
		if(!empty($list_data['List']['id']) || $this->List->id) {
			if(!empty($list_data['List']['id'])) $this->List->id = $list_data['List']['id'];
			$check = $this->List->read();
			if($check['List']['client_id'] != $this->client['Client']['id']) {
				$status['status'] = 'error';
				echo json_encode($status);
				die();
			}
		}
		
		$saved = $this->List->save($list_data);
		if(!$saved) {
			$this->Car->rollback();
			$status['status'] = 'error';
		}
		else {
			$this->ListItem->deleteAll(array('ListItem.list_id' => $this->List->id));
			$fail = false;
			foreach($_POST['items'] as $item) {
				$this->ListItem->create();
				$saved = $this->ListItem->save(array(
					'ListItem' => array(
						'list_id' => $this->List->id,
						'product_variant_id' => $item['variant'],
						'price_list' => $item['price_list'],
						'discount_1' => $item['discount_1'],
						'discount_2' => $item['discount_2'],
						'discount_3' => $item['discount_3']
					)
				));
				if(!$saved) {
					$this->List->rollback();
					$fail = true;
					$status['status'] = 'error';
					break;
				}
			}
			if(!$fail) {
				$this->List->commit();
				$status['status'] = 'success';
				$status['id'] = $this->List->id;
			}
		}
		echo json_encode($status);
		die();
	}
	
	
	
	public function exportar_lista($id) {
		$list = $this->ListItem->find(
			'first',
			array(
				'conditions' => array(
					'List.id' => $id,
					'List.client_id' => $this->client['Client']['id']
				),
			)
		);
		
		$items = $this->List->query(
			'SELECT  p.id AS p_id, p.name AS p_product, p.picture AS p_picture, p.is_offer AS p_is_offer, ' .
			'p.mini_spec AS p_mini_spec, v.code AS v_code, v.name AS v_name, v.packaging AS v_packaging, vi.price_list AS v_price_list, ' .
			'vi.discount_1 AS discount_1, vi.discount_2 AS discount_2, vi.discount_3 AS discount_3, ' .
			' c.id AS c_id, c.name AS category, c.title AS c_title, v.currency_id AS v_currency_id ' .
			' FROM list_items vi INNER JOIN product_variants AS v ON vi.product_variant_id = v.id ' .
			' INNER JOIN products p ON v.product_id = p.id ' . 
			' INNER JOIN categories c ON c.id = p.category_id' . 
			' WHERE vi.list_id = ' . $list['List']['id'] .
			' ORDER BY p.id'
		);
		$currency = $this->Currency->findById($list['List']['currency_id']);
		$pesos_value = $this->Currency->findById(2);
		$pesos_value = $pesos_value['Currency']['value'];
		
		error_reporting(0);
		include "../Vendor/tcpdf/tcpdf.php";
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('ADM Group');
		$pdf->SetTitle('Lista de precios');
		//$pdf->SetSubject('TCPDF Tutorial');
		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		/*$oxygen_bold = $pdf->addTTFfont('../Vendor/Fonts/Oxygen-Bold.ttf', '', '', 32);
		$oxygen_regular = $pdf->addTTFfont('../Vendor/Fonts/Oxygen-Regular.ttf', '', '', 32);
		//$numans_regular = $pdf->addTTFfont('../Vendor/Fonts/Numans-Regular.ttf', '', '', 32);
		$avenir = $pdf->addTTFfont('../Vendor/Fonts/AvenirLTStd-Medium.ttf', '', '', 32);*/
		
		
		$latest_category = 0;
		$latest_product = 0;
		$contents = '';
		foreach($items as $item) {
			if($latest_product != $item['p']['p_id']) {
				if($latest_product != 0) {
					$contents .= '<tr><td height="5" style="font-size: 3px"></td></tr>';
					$contents .= '<tr>';
					$contents .= '<td colspan="4" height="5" style="border-top: 1px solid #c3c5c5"></td>';
					$contents .= '</tr>';
					$contents .= '</table>';
					$contents .= '</td>';
					$contents .= '</tr>';
					$contents .= '</table>';
					$contents .= '<br>&nbsp;<br>';
				}
				if($latest_category != $item['c']['c_id']) {
					if($latest_category != 0) {
						$contents .= '</td></tr>';
					}
					
					
					if($latest_category == 0) {
						$contents .= '<tr><td height="20"></td></tr>';
					}
					
					$this->Category->unbindModel(array('hasMany' => array('Category')));
					$this->Category->recursive = 4;
					$category = $this->Category->findById($item['c']['c_id']);
					
					$c_list = array();
					while(!empty($category)) {
						if(!empty($category['Category'])) $c_list []= $category['Category']['name'];
						else $c_list []= $category['name'];
						$category = $category['Parent'];
					}
					$c_list = array_reverse($c_list);
					
					$contents .= '<tr><td colspan="2" style="line-height: 1.8; background-color: #EAEBEC; font-family: viga; font-size: 16px; color: #E65D24">';
					$contents .= '&nbsp;&nbsp;&nbsp;';
					
					for($i=0;$i<count($c_list);$i++) {
						$cat_name = strtoupper($c_list[$i]);
						$cat_name = str_replace('á', 'Á', $cat_name);
						$cat_name = str_replace('é', 'É', $cat_name);
						$cat_name = str_replace('í', 'Í', $cat_name);
						$cat_name = str_replace('ó', 'Ó', $cat_name);
						$cat_name = str_replace('ú', 'Ú', $cat_name);
						$cat_name = str_replace('ñ', 'Ñ', $cat_name);
						if($i + 1 == count($c_list)) $contents .= '<span style="color: #717E85">' . $cat_name . '</span>';
						else $contents .= h($cat_name) . ' | ';
					}
					
					/*$contents .= 'ILUMINACIÓN | ';
					$contents .= '<span style="color: #717E85">LÁMPARAS</span>';*/
					$contents .= '</td></tr>';
					$contents .= '<tr><td height="20"></td></tr>';
					
					$latest_category = $item['c']['c_id'];
					
					
					$contents .= '<tr>';
					$contents .= '<td colspan="2" height="20" style="background-color: #FFFFFF; font-family: Viga; font-size: 20px; color: #E65D24">';
					$contents .= '<img src="img/tip_h2_1_pdf.png" alt="" width="7" height="14" style="border: 10px solid #000000"> ' . h($item['c']['c_title']);
					$contents .= '</td></tr>';
					$contents .= '<tr><td height="20" style="background-color: #FFFFFF;"></td></tr>';
					$contents .= '<tr><td colspan="2">';
				}
				
				$contents .= '<table style="border: 1px solid #c3c5c5" cellspacing="0" cellpadding="3" border="0">';
				$contents .= '<tr>';
				$contents .= '<td rowspan="2" align="center" width="260"><img alt="" src="files/' . h($item['p']['p_picture']) . '" width="185" border="0"></td>';
				$contents .= '<td width="463" colspan="2">';
				if($item['p']['p_is_offer']) $contents .= '<div align="right"><img src="img/offer_pdf.png" alt="" width="114" height="28"></div>';
				$contents .= '</td>';
				$contents .= '</tr>';
				$contents .= '<tr>';
				$contents .= '<td width="413">';
				$contents .= '<span style="font-family: viga; color: #58585B; font-size: 27px">' . h($item['p']['p_product']) . '<br></span>';
				$contents .= '<span style="font-family: oxygenb; font-size: 14px; color: #939597"><!--';
				$contents .= '-->' . h($item['p']['p_mini_spec']) . '<br><br>';
				$contents .= '<img src="img/logo_sahen_color.png" alt="" width="76">';
				$contents .= '</span>';
				$contents .= '</td>';
				$contents .= '<td width="50"></td>';
				$contents .= '</tr>';
				$contents .= '<tr>';
				$contents .= '<td colspan="3" height="5"></td>';
				$contents .= '</tr>';
				$contents .= '<tr>';
				$contents .= '<td colspan="3">';
				$contents .= '&nbsp;';
				$contents .= '<table align="center">';
				$contents .= '<tr>';
				$contents .= '<td width="310" style="border-bottom: 1px solid #c3c5c5"><span style="font-family: viga; font-size: 13px; color: #58585B">Descripción</span></td>';
				$contents .= '<td width="150" style="text-align: center; border-bottom: 1px solid #c3c5c5; font-family: viga; font-size: 13px; color: #58585B">Código</td>';
				$contents .= '<td width="140" style="border-bottom: 1px solid #c3c5c5; text-align: center; font-family: viga; font-size: 13px; color: #58585B">Embalaje</td>';
				$contents .= '<td width="100" style="border-bottom: 1px solid #c3c5c5; text-align: center; font-family: viga; font-size: 13px; color: #58585B">Precio Unit.</td>';
				$contents .= '</tr>';
				$contents .= '<tr><td height="5" style="font-size: 3px"></td></tr>';
				
				
				$latest_product = $item['p']['p_id'];
			}
			
			$price = $item['vi']['v_price_list'];
			if($currency['Currency']['symbol'] == 'US$' && $item['v']['v_currency_id'] == 1) {
				$price = $price / $pesos_value;
			}
			elseif($currency['Currency']['symbol'] == '$' && $item['v']['v_currency_id'] == 2) {
				$price = $price * $pesos_value;
			}
			//var_dump($currency['Currency']['symbol']);die();
			
			$price = $price - ($item['vi']['discount_1'] * $price / 100);
			$price = $price - ($item['vi']['discount_2'] * $price / 100);
			$price = $price - ($item['vi']['discount_3'] * $price / 100);
			
			$price = $currency['Currency']['symbol'] . ' ' . number_format($price, 2, ',', '.');
			
			$contents .= '<tr>';
			$contents .= '<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">' . h($item['v']['v_name']) . '</td>';
			$contents .= '<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">' . h($item['v']['v_code']) . '</td>';
			$contents .= '<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">' . h($item['v']['v_packaging']) . '</td>';
			$contents .= '<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">' . h($price) . '</td>';
			$contents .= '</tr>';
		}
		
		//echo $contents;die();
		
		/*$html = <<<END
<table cellpadding="0" cellspacing="0" border="0" width="725">
	<tr>
		<td><img src="img/logo_adm_pdf.png" alt="ADM Group" width="180" height="75"></td>
		<td style="text-align: right; font-family: viga; font-size: 19px; color: #A7A9AB">
			<span style="font-size: 12px"><br><br><br><br></span>Lista de Precios:
			<span style="color: #717E85">{$client['Client']['name']}</span>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr><td colspan="2" style="line-height: 1.8; background-color: #EAEBEC; font-family: viga; font-size: 16px; color: #E65D24">
		&nbsp;&nbsp;&nbsp;
		ILUMINACIÓN |
		<span style="color: #717E85">LÁMPARAS</span>
	</td></tr>
	<tr><td height="20" style="background-color: #FFFFFF;"></td></tr>
	<tr><td colspan="2" height="20" style="background-color: #FFFFFF; font-family: Viga; font-size: 20px; color: #E65D24">
	<img src="img/tip_h2_1_pdf.png" alt="" width="7" height="14" style="border: 10px solid #000000"> Interruptores Termomagnéticos Modelo DZ47
	</td></tr>
	<tr><td height="20" style="background-color: #FFFFFF;"></td></tr>
	<tr>
		<td colspan="2">
		
			<table style="border: 1px solid #c3c5c5" cellspacing="0" cellpadding="3" border="0">
				<tr>
					<td rowspan="2" align="center" width="260"><img alt="" src="img/web_ofertas_03_1.png" width="185" border="0"></td>
					<td width="463" colspan="2">
						<div align="right"><img src="img/offer_pdf.png" alt="" width="114" height="28"></div>
					</td>
				</tr>
				<tr>
					<td width="413">
						<span style="font-family: viga; color: #58585B; font-size: 27px">Fusibles cilíndricos y portafusibles 8,5 x 31,5<br></span>
						<span style="font-family: oxygenb; font-size: 14px; color: #939597"><!--
							-->Tensión Nominal Un= 230/400 Vca<br><br>
							<img src="img/logo_sahen_color.png" alt="" width="76">
						</span>
					</td>
					<td width="50"></td>
				</tr>
				<tr>
					<td colspan="3" height="5"></td>
				</tr>
				<tr>
					<td colspan="3">
						&nbsp;
						<table align="center">
							<tr>
								<td width="310" style="border-bottom: 1px solid #c3c5c5"><span style="font-family: viga; font-size: 13px; color: #58585B">Descripción</span></td>
								<td width="150" style="text-align: center; border-bottom: 1px solid #c3c5c5; font-family: viga; font-size: 13px; color: #58585B">Código</td>
								<td width="140" style="border-bottom: 1px solid #c3c5c5; text-align: center; font-family: viga; font-size: 13px; color: #58585B">Embalaje</td>
								<td width="100" style="border-bottom: 1px solid #c3c5c5; text-align: center; font-family: viga; font-size: 13px; color: #58585B">Precio Unit.</td>
							</tr>
							<tr><td height="5" style="font-size: 3px"></td></tr>
							<tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr>
							<tr><td height="5" style="font-size: 3px"></td></tr>
							<tr>
								<td colspan="4" height="5" style="border-top: 1px solid #c3c5c5"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br>&nbsp;<br>
<table style="border: 1px solid #c3c5c5" cellspacing="0" cellpadding="3" border="0">
				<tr>
					<td rowspan="2" align="center" width="260"><img alt="" src="img/web_ofertas_03_1.png" width="185" border="0"></td>
					<td width="463" colspan="2">
						<div align="right"><img src="img/offer_pdf.png" alt="" width="114" height="28"></div>
					</td>
				</tr>
				<tr>
					<td width="413">
						<span style="font-family: viga; color: #58585B; font-size: 27px">Fusibles cilíndricos y portafusibles 8,5 x 31,5<br></span>
						<span style="font-family: oxygenb; font-size: 14px; color: #939597"><!--
							-->Tensión Nominal Un= 230/400 Vca<br><br>
							<img src="img/logo_sahen_color.png" alt="" width="76">
						</span>
					</td>
					<td width="50"></td>
				</tr>
				<tr>
					<td colspan="3" height="5"></td>
				</tr>
				<tr>
					<td colspan="3">
						&nbsp;
						<table align="center">
							<tr>
								<td width="310" style="border-bottom: 1px solid #c3c5c5"><span style="font-family: viga; font-size: 13px; color: #58585B">Descripción</span></td>
								<td width="150" style="text-align: center; border-bottom: 1px solid #c3c5c5; font-family: viga; font-size: 13px; color: #58585B">Código</td>
								<td width="140" style="border-bottom: 1px solid #c3c5c5; text-align: center; font-family: viga; font-size: 13px; color: #58585B">Embalaje</td>
								<td width="100" style="border-bottom: 1px solid #c3c5c5; text-align: center; font-family: viga; font-size: 13px; color: #58585B">Precio Unit.</td>
							</tr>
							<tr><td height="5" style="font-size: 3px"></td></tr>
							<tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr>
							<tr><td height="5" style="font-size: 3px"></td></tr>
							<tr>
								<td colspan="4" height="5" style="border-top: 1px solid #c3c5c5"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br>&nbsp;<br>
<table style="border: 1px solid #c3c5c5" cellspacing="0" cellpadding="3" border="0">
				<tr>
					<td rowspan="2" align="center" width="260"><img alt="" src="img/web_ofertas_03_1.png" width="185" border="0"></td>
					<td width="463" colspan="2">
						<div align="right"><img src="img/offer_pdf.png" alt="" width="114" height="28"></div>
					</td>
				</tr>
				<tr>
					<td width="413">
						<span style="font-family: viga; color: #58585B; font-size: 27px">Fusibles cilíndricos y portafusibles 8,5 x 31,5<br></span>
						<span style="font-family: oxygenb; font-size: 14px; color: #939597"><!--
							-->Tensión Nominal Un= 230/400 Vca<br><br>
							<img src="img/logo_sahen_color.png" alt="" width="76">
						</span>
					</td>
					<td width="50"></td>
				</tr>
				<tr>
					<td colspan="3" height="5"></td>
				</tr>
				<tr>
					<td colspan="3">
						&nbsp;
						<table align="center">
							<tr>
								<td width="310" style="border-bottom: 1px solid #c3c5c5"><span style="font-family: viga; font-size: 13px; color: #58585B">Descripción</span></td>
								<td width="150" style="text-align: center; border-bottom: 1px solid #c3c5c5; font-family: viga; font-size: 13px; color: #58585B">Código</td>
								<td width="140" style="border-bottom: 1px solid #c3c5c5; text-align: center; font-family: viga; font-size: 13px; color: #58585B">Embalaje</td>
								<td width="100" style="border-bottom: 1px solid #c3c5c5; text-align: center; font-family: viga; font-size: 13px; color: #58585B">Precio Unit.</td>
							</tr>
							<tr><td height="5" style="font-size: 3px"></td></tr>
							<tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr><tr>
								<td width="310" style="font-family: oxygenb; font-size: 14px; color: #939597">Cartucho fusible cilíndrico 8,5 x 31,5 1A 400V</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">GA-302015</td>
								<td style="text-align: center; font-family: oxygenb; font-size: 14px; color: #939597">20 unidades</td>
								<td style="text-align: center; font-family: viga; font-size: 17px; color: #E65D24">$ 123,50</td>
							</tr>
							<tr><td height="5" style="font-size: 3px"></td></tr>
							<tr>
								<td colspan="4" height="5" style="border-top: 1px solid #c3c5c5"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<div align="center" style="font-family: avenir; color: #555555; font-size: 12px">
	<br>
	G&uuml;emes 1456/58 - (1870) - Avellaneda - Bs. As. - Argentina<br>
	Tel/Fax: (54 11) 4204-0857 - info@admgroup.com.ar - www.admgroup.com.ar
	<br>
	<br><img src="img/bottom_pdf.png" alt="" width="725" height="18">
</div>
END;*/
			
			$html = <<<END
<table cellpadding="0" cellspacing="0" border="0" width="725">
	<tr>
		<td><img src="img/logo_adm_pdf.png" alt="ADM Group" width="180" height="75"></td>
		<td style="text-align: right; font-family: viga; font-size: 19px; color: #A7A9AB">
			<span style="font-size: 12px"><br><br><br><br></span>Lista de Precios:
			<span style="color: #717E85">{$this->client['Client']['name']} {$this->client['Client']['surname']}</span>
		</td>
	</tr>
	$contents	
						<tr><td height="5" style="font-size: 3px"></td></tr>
						<tr><td colspan="4" height="5" style="border-top: 1px solid #c3c5c5"></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<div align="center" style="font-family: avenir; color: #555555; font-size: 12px">
	<br>
	G&uuml;emes 1456/58 - (1870) - Avellaneda - Bs. As. - Argentina<br>
	Tel/Fax: (54 11) 4204-0857 - info@admgroup.com.ar - www.admgroup.com.ar
	<br>
	<br><img src="img/bottom_pdf.png" alt="" width="725" height="18">
</div>
END;
		//$pdf->SetFont('dejavusans', '', 14, '', true);
		
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->lastPage();
		
		// $pdf->AddPage();
		// $pdf->writeHTML($html, true, false, true, false, '');
		// $pdf->lastPage();
		
		if(!empty($this->get_contents)) {
			$name = 'pdf' . mt_rand();
			$pdf->Output($name, 'F');
			return $name;
		}
		else {
			$pdf->Output(null, 'I');
			die();
		}
	}
	
	public function send_mail() {
		$result = array('status' => false);
		$message = $this->client['Client']['name'] . ' ' . $this->client['Client']['surname'];
		$message .= " le ha mandado su lista de precios de ADM Group como archivo adjunto.";
		
		App::uses('CakeEmail', 'Network/Email');
		$Email = new CakeEmail();
		
		$this->get_contents = true;
		$lista_precios = $this->exportar_lista($_POST['list_id']);
		
		$Email->attachments(array(
			'lista_de_precios.pdf' => array(
				'file' => $lista_precios,
				'mimetype' => 'application/pdf',
				'contentId' => 'lista-precios'
			)
		));
		
		foreach($_POST['email'] as $mail) {
			$Email->from(array('noreply@admelectricos.com.ar' => 'ADM Group'));
			$Email->to($mail);
			$Email->subject('ADM Group: Lista de precios de ' . $this->client['Client']['name'] . ' ' . $this->client['Client']['surname']);
			$status = $Email->send($message);
			if($status) $result['status'] = true;
		}

		echo json_encode($result);
		die();
	}
	
	public function cargar_lista($id) {
		$categories = array();
		$products = array();
		$items = $this->ListItem->find(
			'all',
			array(
				'conditions' => array(
					'ListItem.list_id' => $id,
					'List.client_id' => $this->client['Client']['id']
				),
			)
		);
		foreach($items as $item) {
			$product = $this->Product->findById($item['ProductVariant']['product_id']);
			$currency = $this->Currency->findById($item['ProductVariant']['currency_id']);
			$products []= array(
				'item' => $item['ListItem'],
				'variant' => $item['ProductVariant'],
				'category' => $product['Product']['category_id'],
				'currency' => $currency['Currency']['symbol']
			);
			
			
			$this->Product->recursive = 0;
			$category = $this->Category->findById($product['Product']['category_id']);
			
			//if(!in_array($category['Category']['id'], $categories)) $categories[] = $category['Category']['id'];
			do {
				if(!in_array($category['Category']['id'], $categories)) $categories[] = $category['Category']['id'];
				$category = $this->Category->findById($category['Category']['category_id']);
			}
			while($category['Category']['category_id'] != NULL);
			if(!in_array($category['Category']['id'], $categories)) $categories[] = $category['Category']['id'];
		}
		
		$other_products = array();
		$products_gral = $this->ProductVariant->find(
			'all',
			array('conditions' => array('Product.category_id' => $categories))
		);
		foreach($products_gral as $vp) {
			$vp_id = $vp['ProductVariant']['id'];
			$ok = true;
			foreach($products as $prod) {
				if($prod['variant']['id'] == $vp_id) {
					$ok = false;
					break;
				}
			}
			if($ok) {
				$curr = $this->Currency->findById($vp['ProductVariant']['currency_id']);
				$other_products[] = array(
					'variant' => $vp['ProductVariant'],
					'category' => $vp['Product']['category_id'],
					'currency' => $curr['Currency']['symbol']
				);
			}
		}
		
		
		//debug($other_products);die();
		
		$result = array(
			'categories' => $categories,
			'products' => $products,
			'other_products' => $other_products
		);
		echo json_encode($result);
		die();
	}
}