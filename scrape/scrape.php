<?php 
	include '../modules/db/connection.php';
	//include 'scraper.php';
	
	class ScrapeAjax {
		
		private $html, $json, $data, $conn, $date, $shop, $vars = array();

		private $erste = array("Oznaka", "KupovniEfektiva", "Srednji", "ProdajniEfektiva");
		private $vip = array("rate_buy", "rate", "rate_sale", "curr_label", "curr_title");

		function __construct($html, $shop) {
			$this->html = $html;
			$this->shop = $shop;
		}
		function setData() {
			$json = $this->scrape($this->html);
			$this->data = json_decode($json);
		}
		function getData() {
			return $this->data;
		}
		function setConn($conn) {
			$this->conn = $conn;
		}
		function setDate() {
			$this->date = date("Y-m-d", time());
		}

		function scrape($url) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$output = curl_exec($ch);
			curl_close($ch);
			return $output;
		}

		function insertData($exchange_office_id) {
			
			if(!empty($this->data)) {
				if($this->shop == "vip") {
					$vars = $this->vip;
					$json = $this->data->list;
				} elseif($this->shop == "erste") {
					$vars = $this->erste;
					$json = $this->data;
				}
				
				foreach ($json as $key => $value) {
					
					if($this->shop == "vip"){
						$rate_sell = $value->rate_buy;
						$rate = $value->rate;
						$rate_buy = $value->rate_sale;
						$curr_label = $value->curr_label;
						$curr_title = $value-> curr_title;
						$numero = 17;
					} elseif ($this->shop == "erste") {
						$curr_label = $value->Oznaka;
						$rate_sell = $value->KupovniEfektiva;
						$rate = $value->Srednji;
						$rate_buy = $value->ProdajniEfektiva;
						$numero = 11;
					}

					$sql = "SELECT currency_id FROM currency WHERE currency_label = '$curr_label'";
					$result = $this->conn->query($sql);
					foreach ($result as $key => $value) {
						if(isset($value['currency_id'])) {
							$id = $value['currency_id'];	
						}
					}
					
					$stmt = $this->conn->prepare("SELECT * FROM currency_list WHERE exchange_office_id = ? ");
					$stmt->bind_param('d', $exchange_office_id);
					$stmt->execute();
					$result = $stmt->get_result();

					if($result->num_rows >= $numero) {
						foreach($result as $key => $value) {
							$stmt = $this->conn->prepare("UPDATE currency_list SET sell_rate = ?, avg_rate = ?, buy_rate = ?, `date` = ? WHERE exchange_office_id = ? AND currency_id = ?");
							$stmt->bind_param('dddsdd', $rate_sell, $rate, $rate_buy, $this->date, $exchange_office_id, $id);
							$stmt->execute();
						}
					} else {
						$stmt = $this->conn->prepare("INSERT INTO currency_list (exchange_office_id, currency_id, sell_rate, avg_rate, buy_rate, `date`) VALUES('$exchange_office_id', '$id', ?, ?, ?, '$this->date')");
						$stmt->bind_param('ddd', $rate_buy, $rate, $rate_sell);
						$stmt->execute();
					}
				}
			}
		}
	}
	
	$urls = array("http://www.vipsistem.rs/?ajax=exchange_list&method=get_list", "https://moduli.erstebank.rs//aspx/kursna_lista/datum.aspx?");
	$shops = array("vip", "erste");

	foreach ($urls as $key => $value) {
		$sc = new ScrapeAjax($value, $shops[$key]);
		$sc->setData();
		$sc->setDate();
		$sc->setConn($conn);
		$sc->insertData($key+1);
	}
	
	
	


	//$html = file_get_contents("http://www.vipsistem.rs/?ajax=exchange_list&method=get_list");
	//$data = json_decode($html);
//
//	//$v = array();
//	//foreach ($data as $key => $value) {
//	//	$valuta = $value->Oznaka;
//	//	$kupovni = $value->KupovniEfektiva;
//	//	$srednji = $value->Srednji;
//	//	$prod = $value->ProdajniEfektiva;
//
//	//	$niz = array($valuta, $kupovni, $srednji, $prod);
//	//	array_push($v, $niz);
//	//	//print_r($value);
	//}

	//$niz = array("Oznaka", "KupovniEfektiva", "Srednji", "ProdajniEfektiva", "rate_buy", "rate", "rate_sale", "curr_label", "curr_title");
	
	//function getValue($json, $array, $i) {
	//	foreach ($json as $key => $value) {
	//		$var = $value->$array[$key];
	//		$var1 = $value->$array[$key];
	//		$var2 = $value->$array[$key];
	//		$var3 = $value->$array[$key];
	//		$var4 = $value->$array[$key];
	//	}
	//	return $vars = array($var, $var1, $var2, $var3, $var4);
	//}

	

?>