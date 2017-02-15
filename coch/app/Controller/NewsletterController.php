<?php

App::uses("PanelController", "Controller");

class NewsletterController extends PanelController {
	public $uses = array('Product', 'Article', 'NewsletterSubscription');
	
	public function name() {
		
	}
	public function index() {
		$this->paginate = array('Product' => array(
			'conditions' => array('Product.is_offer' => 1),
			'limit' => 10,
			'order' => array('Product.id' => 'DESC')
		));
		$this->set('data', $this->paginate('Product'));
	}
	public function step2() {
		$this->paginate = array('Article' => array(
			'limit' => 10,
			'order' => array('Article.id' => 'DESC')
		));
		$this->set('data', $this->paginate('Article'));
	}
	public function step3() {
		$newsletter_base = <<<END
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
	<body bgcolor="#FFFFFF" style="color: #000000; font-family: Calibri, sans-serif; font-size: 14px">
		<table cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td colspan="3" height="190" width="618"><img valign="top" src="{base}img/top_newsletter.png" alt="ADM Group" width="618" height="190"></td>
			</tr>
			<tr>
				<td valign="bottom" height="166" width="23"><img style="display: inline-block; vertical-align: middle" src="{base}img/bottom_left_newsletter.png" alt="" width="23" height="166"></td>
				<td style="border: 1px solid #babcbc; border-top: none" width="570" valign="top">
					<table cellspacing="0" cellpadding="0" width="528" align="center" style="margin-top: 25px; border-top: 1px solid #4f4c4d">
						<tr><td height="5"></td></tr>
						<tr>
							<td colspan="3" bgcolor="#F1F2F2">
								<span style="font-family: Calibri, sans-serif; font-size: 22px; color: #808285; line-height: 35px">
									<img src="{base}img/title_newsletter.png" alt="Newsletter" width="109" height="18" valign="baseline" hspace="15">
									{ns_name}
								</span>
							</td>
						</tr>
						<tr><td height="4"></td></tr>
						<tr>
							<td bgcolor="#8A9298" width="105">
								<div style="line-height: 35px; margin-left: 15px; font-family: Calibri, sans-serif; font-size: 14px; font-weight: bold; color: #FFF">
									<a href="{base}adm/contacto" target="_blank" style="color: #FFF; text-decoration: none">
										<img src="{base}img/mailbox_newsletter.png" alt="" width="25" height="14" style="vertical-align: middle" border="0">
										Consultas
									</a>
								</div>
							</td>
							<td bgcolor="#8A9298">
								<div style="line-height: 35px; margin-left: 15px; font-family: Calibri, sans-serif; font-size: 14px; font-weight: bold; color: #FFF">
									<a href="{base}" target="_blank" style="color: #FFF; text-decoration: none">
										<img src="{base}img/globe_newsletter.png" alt="" width="24" height="19" style="vertical-align: middle" border="0">
										Sitio Web
									</a>
								</div>
							</td>
							<td bgcolor="#8A9298">
								<div style="text-align: right; line-height: 35px; margin-right: 15px; font-family: Calibri, sans-serif; font-size: 14px; font-weight: bold; color: #FFF">
									<a href="{base}" target="_blank" style="color: #FFF; text-decoration: none">
										Ver todos los Productos >>
									</a>
								</div>
							</td>
						</tr>
					</table>
					<br>
					{contenido}
					
					<img src="{base}img/pictures_newsletter.png" alt="Venta mayoritaria de iluminación, led, timbres inalámbricos, productos industriales y tv/audio." width="560" height="145">
				</td>
				<td valign="bottom" height="166" width="23"><img style="display: inline-block; vertical-align: middle" src="{base}img/bottom_right_newsletter.png" alt="" width="23" height="166"></td>
			</tr>
			<tr>
				<td colspan="3"><img src="{base}img/bottom_newsletter.png" alt="" width="618" height="53" style="display: inline-block; vertical-align: middle" ></td>
			</tr>
			<tr>
				<td colspan="3" height="4"></td>
			</tr>
			<tr>
				<td colspan="3" bgcolor="#E35926">
					<table cellpadding="0" cellspacing="0">
						<tr>
								<td height="20"></td>
						</tr>
						<tr>
							<td width="40"></td>
							<td><img alt="" src="{base}img/logo_newsletter.png" width="113" height="50"></td>
							<td width="35"></td>
							<td style="font-family: Calibri, sans-serif; font-size: 14px; color: #FFFFFF">
							Güemes 1456 - Avellaneda (1870) - Pcia. de Buenos Aires - Argentina<br>
							Tel.: 011-4204-0857 (Rotativas)<br>
							info@admelectricos.com.ar - www.admelectricos.com.ar
							</td>
						</tr>
						<tr>
								<td height="20"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
 
END;
		$title_offers = "<img src=\"{base}img/special_offers_newsletter.png\" alt=\"Ofertas ADM\" width=\"114\" height=\"13\" hspace=\"21\" vspace=\"10\">\n";
		$base_offers = <<<END
     <table cellpadding="0" cellspacing="5" style="border: 1px solid #babcbc" align="center" width="528">
						<tr>
							<td valign="middle"><a href="{base}{link_producto}"><img src="{base}files/{imagen}" width="205" border="0"></a></td>
							<td valign="top" align="right" style="font-family: Calibri, sans-serif">
								<img src="{base}img/offer_newsletter.png" alt="Oferta" width="80" height="19">
								<h1 style="color: #626366; font-size: 24px; line-height: 24px; margin-right: 20px; margin-bottom: 5px">{titulo}</h1>
								<div style="font-size: 14px; color: #727F85; margin-right: 20px">{spec}</div>
								
								<table cellspacing="0" cellpadding="0" align="right" border="0">
									<tr>
										<td rowspan="2" style="font-family: Calibri, sans-serif; font-size: 36px; color: #E65E25; font-weight: bold" valign="middle">{moneda}</td>
										<td rowspan="2" style="font-family: Calibri, sans-serif; font-size: 80px; color: #E65E25; font-weight: bold" valign="middle">{precio_entero}</td>
										<td height="9"><td>
										<td width="20"></td>
									</tr>
									<tr>
										<td style="font-family: Calibri, sans-serif; font-size: 40px; color: #E65E25; font-weight: bold" valign="top">{precio_centavos}</td>
									</tr>
									<tr>
										<td colspan="5" align="right">
											<a href="{base}{link_producto}"><img border="0" hspace="3" vspace="3" src="{base}img/plus_info_newsletter.png" alt="+ info" width="40" height="10"></a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<br>

END;
		$title_products = "<img src=\"{base}img/products_newsletter.png\" alt=\"Productos ADM\" width=\"135\" height=\"13\" hspace=\"21\" vspace=\"10\">\n";
		$base_products = <<<END
				<table cellpadding="0" cellspacing="5" style="border: 1px solid #babcbc" align="center" width="528">
						<tr>
							<td valign="middle"><a href="{base}{link_producto}"><img src="{base}files/{imagen}" width="180" border="0"></a></td>
							<td valign="top" align="right" style="font-family: Calibri, sans-serif">
								<h1 style="color: #626366; font-size: 20px; line-height: 20px; margin-right: 20px; margin-bottom: 5px">{titulo}</h1>
								<div style="font-size: 14px; color: #727F85; margin-right: 20px">{spec}</div>
								
								<table cellspacing="0" cellpadding="0" align="right" border="0" style="font-family: Calibri, sans-serif">
									<tr>
										<td rowspan="2" style="font-family: Calibri, sans-serif; font-size: 21px; color: #E65E25; font-weight: bold" valign="middle">{moneda}</td>
										<td rowspan="2" style="font-family: Calibri, sans-serif; font-size: 46px; color: #E65E25; font-weight: bold" valign="middle">{precio_entero}</td>
										<td height="6"><td>
										<td width="20"></td>
									</tr>
									<tr>
										<td style="font-family: Calibri, sans-serif; font-size: 23px; color: #E65E25; font-weight: bold" valign="top">{precio_centavos}</td>
									</tr>
									<tr>
										<td colspan="5" align="right">
											<a href="{base}{link_producto}"><img border="0" hspace="3" vspace="3" src="{base}img/plus_info_small_newsletter.png" alt="+ info" width="33" height="9"></a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<br>
			
END;
		$title_articles = "<img src=\"{base}img/news_newsletter.png\" alt=\"Noticias ADM\" width=\"115\" height=\"13\" hspace=\"21\" vspace=\"10\">";
		$base_articles = <<<END
					<table style="font-family: Calibri, sans-serif" align="center" width="528" cellspacing="0" cellpadding="0">
						<tr>
							<td width="223"><a href="{base}{link_noticia}" target="_blank"><img style="display: inline-block; vertical-align: middle" border="0" src="{base}files/{imagen}" alt="" width="223" height="147"></a></td>
							<td bgcolor="#EA8824" valign="top" style="font-family: Calibri, sans-serif">
								<div style="margin: 15px; margin-bottom: 5px">
									<a href="{base}{link_noticia}" target="_blank" style="text-decoration: none; font-weight: bold; color: #FFF; font-size: 18px">{titulo}</a>
								</div>
								<div style="font-size: 14px; margin: 15px; margin-top: 0px; margin-bottom: 0px; color: #FFFDE8">
									{lead}
									<div style="text-align: right; margin-top: 10px">
									<a href="{base}{link_noticia}" target="_blank"><img src="{base}img/plus_info_white_newsletter.png" width="41" height="11" border="0"></a>
									</div>
								</div>
								
							</td>
						</tr>
					</table>
					<br>
					
END;
		$contents = '';
		$offers = $this->Product->find('all', array('conditions' => array('Product.id' => explode(',', $_GET['ofr']))));
		
		if(count($offers) > 0) {
			$contents .= $title_offers;
			foreach($offers as $offer) {
				if(strpos($offer['Product']['price'], '.') !== false) {
					$cents = preg_replace('/^[0-9]+\./', '', $offer['Product']['price']);
					$cents = sprintf('%02d', $cents);
					$cents = substr($cents, 0, 2);
				}
				else $cents = '00';
				
				$links = 'adm/producto/' . Inflector::slug($offer['Product']['name']) . '-' . $offer['Product']['id'] . '.html';
				
				$c_offer = $base_offers;
				$c_offer = str_replace('{imagen}', h($offer['Product']['picture']), $c_offer);
				$c_offer = str_replace('{titulo}', h($offer['Product']['name']), $c_offer);
				$c_offer = str_replace('{spec}', h($offer['Product']['mini_spec']), $c_offer);
				$c_offer = str_replace('{moneda}', h($offer['Currency']['symbol']), $c_offer);
				$c_offer = str_replace('{precio_entero}', floor($offer['Product']['price']), $c_offer);
				$c_offer = str_replace('{precio_centavos}', $cents, $c_offer);
				$c_offer = str_replace('{link_producto}', $links, $c_offer);
				$contents .= $c_offer;
			}
		}
		
		$products = $this->Product->find('all', array('conditions' => array('Product.id' => explode(',', $_GET['ids']))));
		if(count($products) > 0) {
			$contents .= $title_products;
			foreach($products as $product) {
				if(strpos($product['Product']['price'], '.') !== false) {
					$cents = preg_replace('/^[0-9]+\./', '', $product['Product']['price']);
					$cents = sprintf('%02d', $cents);
					$cents = substr($cents, 0, 2);
				}
				else $cents = '00';
				
				$links = 'adm/producto/' . Inflector::slug($product['Product']['name']) . '-' . $product['Product']['id'] . '.html';
				
				$c_product = $base_products;
				$c_product = str_replace('{imagen}', h($product['Product']['picture']), $c_product);
				$c_product = str_replace('{titulo}', h($product['Product']['name']), $c_product);
				$c_product = str_replace('{spec}', h($product['Product']['mini_spec']), $c_product);
				$c_product = str_replace('{moneda}', h($product['Currency']['symbol']), $c_product);
				$c_product = str_replace('{precio_entero}', floor($product['Product']['price']), $c_product);
				$c_product = str_replace('{precio_centavos}', $cents, $c_product);
				$c_product = str_replace('{link_producto}', $links, $c_product);
				$contents .= $c_product;
			}
		}
		
		$articles = $this->Article->find('all', array('conditions' => array('Article.id' => explode(',', $_GET['art']))));
		if(count($articles) > 0) {
			$contents .= $title_articles;
			foreach($articles as $article) {
				
				$links = 'novedades/ver/' . Inflector::slug($article['Article']['title']) . '-' . $article['Article']['id'] . '.html';
				
				$lead = $article['Article']['lead'];
				if(strlen($lead) > 90) $lead = substr($lead, 0, 90) . '...';
				
				$c_article = $base_articles;
				$c_article = str_replace('{imagen}', h($article['Article']['picture']), $c_article);
				$c_article = str_replace('{titulo}', h($article['Article']['title']), $c_article);
				$c_article = str_replace('{lead}', h($lead), $c_article);
				$c_article = str_replace('{link_noticia}', $links, $c_article);
				$contents .= $c_article;
			}
		}
		$newsletter_base = str_replace('{ns_name}', h($_GET['name']), $newsletter_base);
		$newsletter_base = str_replace('{contenido}', $contents, $newsletter_base);
		$newsletter_base = str_replace('{base}', h(Router::url('/', true)), $newsletter_base);
		
		$this->set('newsletter', $newsletter_base);
	}
	
	public function step4() {
		$this->layout = 'ajax';
		$newsletter = str_replace('>&nbsp;<', '><', $_POST['newsletter']);
		$this->set(compact('newsletter'));
	}
	public function step5() {
		if(!empty($_POST)) {
			mail(
				$_POST['email'],
				'Prueba de newsletter ADM Group',
				$_POST['newsletter'],
				"Content-Type: text/html; charset=UTF-8\r\nFrom: ADM Group <noreply@admelectricos.com.ar>"
			);
			echo '<script>alert("Mail enviado exitosamente");location.replace("step5");</script>';
		}
		die();
	}
	public function csv() {
		$list = $this->NewsletterSubscription->find('all');
		
		header("Content-Type: text/csv");
		header("Content-Disposition: attachment;filename=suscripciones.csv");
		foreach($list as $item) echo $item['NewsletterSubscription']['email'] . "\r\n";
		die();
	}
}