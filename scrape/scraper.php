<?php 
	include '../modules/db/connection.php';
	
	class Scraper {
		private $doc, $xpath, $html, $exchange_office_name;

		function __construct($exchange_office_name, $url)
		{
			$this->exchange_office_name = $exchange_office_name;
			$this->url = $url;
			$this->doc = new DOMDocument();
		}

		function getDoc(){
			return $this->doc;
		}
		function getXpath(){
			return $this->xpath;
		}
		function setDoc($doc) {
			$this->doc = $doc;
		}
		function setXpath($doc) {
			$this->xpath = new DOMXPath($doc);
		}
		function setConn($conn) {
			$this->conn = $conn;
		}
		function getName() {
			return $this->exchange_office_name;
		}
		function setName($name) {
			$this->exchange_office_name = $name;
		}

		function scrape($url) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$output = curl_exec($ch);
			curl_close($ch);
			return $output;
		}

		//ABSTRACT 
		function get_table($url, $table_query) {
			
			@$this->doc->loadHTML($this->scrape($url));
			$this->xpath = new DOMXPath($this->doc);
			$res = $this->xpath->query($table_query);
			print_r($res);
			for ($i = 1; $i <= $res->length; $i++) {
				if($this->exchange_office_name == "trange frange") {
					$exchange_office_id = 1000;
					$numero = 18;	//KORIGOVATI
					$niz = array("//*[@id='t3-content']/div[2]/article/section/div/div/div[$i]/div[2]/div/div[1]", "//*[@id='t3-content']/div[2]/article/section/div/div/div[$i]/div[2]/div/div[2]", "//*[@id='t3-content']/div[2]/article/section/div/div/div[$i]/div[7]/div/div", "//*[@id='t3-content']/div[2]/article/section/div/div/div[$i]/div[4]/div/div", "//*[@id='t3-content']/div[2]/article/section/div/div/div[$i]/div[5]/div/div", "//*[@id='t3-content']/div[2]/article/section/div/div/div[$i]/div[6]/div/div");
				} elseif($this->exchange_office_name == "dok") {
					$exchange_office_id = 1001;
					$numero = 11;
					$niz = array("//*[@id='intro-right']/table/tbody[2]/tr[$i]/td[3]", "//*[@id='intro-right']/table/tbody[2]/tr[$i]/td[2]", "//*[@id='intro-right']/table/tbody[2]/tr[$i]/td[7]", "//*[@id='intro-right']/table/tbody[2]/tr[$i]/td[5]", "//*[@id='intro-right']/table/tbody[2]/tr[$i]/td[6]", "//*[@id='intro-right']/table/tbody[2]/tr[$i]/td[6]");
				} elseif($this->exchange_office_name == "raiffeisen") {
					$exchange_office_id = 1002;
					$numero = 11;
					$niz = array("//*[@id='kursnalista_velika']/div[3]/table/tbody/tr[$i]/td[3]", "//*[@id='kursnalista_velika']/div[3]/table/tbody/tr[$i]/td[1]", "//*[@id='kursnalista_velika']/div[3]/table/tbody/tr[$i]/td[2]", "//*[@id='kursnalista_velika']/div[3]/table/tbody/tr[$i]/td[5]", "//*[@id='kursnalista_velika']/div[3]/table/tbody/tr[$i]/td[6]", "//*[@id='kursnalista_velika']/div[3]/table/tbody/tr[$i]/td[7]", );
				} elseif($this->exchange_office_name == "paris") {
					$exchange_office_id = 1003;
					$numero = 12;
					$niz = array("//*[@id='kursna-lista']/div[$i]/div[1]", "//*[@id='kursna-lista']/div[$i]/div[2]", "//*[@id='kursna-lista']/div[$i]/div[2]", "//*[@id='kursna-lista']/div[$i]/div[3]", "//*[@id='kursna-lista']/div[$i]/div[4]", "//*[@id='kursna-lista']/div[$i]/div[5]");
				} elseif($this->exchange_office_name == "komercijalna") {
					$exchange_office_id = 1004;
					$numero = 15;
					$niz = array("//*[@id='kurs-table']/tbody/tr[$i]/td[2]", "//*[@id='kurs-table']/tbody/tr[$i]/td[6]", "//*[@id='kurs-table']/tbody/tr[$i]/td[2]", "//*[@id='kurs-table']/tbody/tr[$i]/td[9]", "//*[@id='kurs-table']/tbody/tr[$i]/td[6]", "//*[@id='kurs-table']/tbody/tr[$i]/td[10]");
				} elseif($this->exchange_office_name == "aik") {
					$exchange_office_id = 1005;
					$numero = 4;
					$niz = array("//*[@id='exchangeRates']/div[2]/table/tbody/tr[$i]/td[3]", "//*[@id='exchangeRates']/div[2]/table/tbody/tr[$i]/td[1]", "//*[@id='exchangeRates']/div[2]/table/tbody/tr[$i]/td[2]", "//*[@id='exchangeRates']/div[2]/table/tbody/tr[$i]/td[5]", "//*[@id='exchangeRates']/div[2]/table/tbody/tr[$i]/td[6]", "//*[@id='exchangeRates']/div[2]/table/tbody/tr[$i]/td[7]"); 
				}
				
				
				$curr_label_query = $niz[0];
				$curr_code_query = $niz[1];
				$curr_title_query = $niz[2];
				$rate_sell_query = $niz[3];
				$avg_rate_query = $niz[4];
				$rate_buy_query = $niz[5];

				$this->get_table_row($exchange_office_id, $curr_label_query, $curr_code_query, $curr_title_query, $rate_sell_query, $avg_rate_query, $rate_buy_query, $numero);
			}
		}
		
		function get_table_row($exchange_office_id, $curr_label_query, $curr_code_query, $curr_title_query, $rate_sell_query, $avg_rate_query, $rate_buy_query, $numero) {
			$date = date("Y-m-d", time());

			$result = $this->xpath->query($curr_label_query);
			foreach ($result as $key => $value) {
				$curr_label = $value->nodeValue;
			}
			$result = $this->xpath->query($rate_sell_query);
			foreach ($result as $key => $value) {
				$rate_sell = $value->nodeValue;
			}
			$result = $this->xpath->query($avg_rate_query);
			foreach ($result as $key => $value) {
				$avg_rate = $value->nodeValue;
			}
			$result = $this->xpath->query($rate_buy_query);
			foreach ($result as $key => $value) {
				$rate_buy = $value->nodeValue;
			}
			if(isset($curr_label) && isset($rate_buy)) {
				$rate_buy = str_replace(",", ".", $rate_buy);
				$avg_rate = str_replace(",", ".", $avg_rate);
				$rate_sell = str_replace(",", ".", $rate_sell);

				$rate_buy = (double)$rate_buy;
				$avg_rate = (double)$avg_rate;
				$rate_sell = (double)$rate_sell;
				$curr_label = trim($curr_label);
				
				echo $curr_label . " ";
				echo $rate_buy . " ";
				echo $rate_sell;
				//echo $exchange_office_id . " " . $curr_label . " " . $rate_sell . " " . $avg_rate . " " . $rate_buy . "<br>";

				$sql = "SELECT currency_id FROM currency WHERE currency_label = '$curr_label'";
				$result = $this->conn->query($sql);
				foreach ($result as $key => $value) {
					if(isset($value['currency_id'])) {
						$id = $value['currency_id'];	
					}
				}
				if($curr_label == "GPB") {
					$id = 11;
				}

				$sql = "SELECT * FROM currency_list WHERE exchange_office_id = '$exchange_office_id'";
				$result = $this->conn->query($sql);
				

				//Ili radi insert ili update, numero treba korigovati
				// if($result->num_rows >= $numero) {
				// 	if($rate_buy != 0) {
						foreach($result as $key => $value) {
							$stmt = $this->conn->prepare("UPDATE currency_list SET sell_rate = ?, avg_rate = ?, buy_rate = ?, `date` = ? WHERE exchange_office_id = ? AND currency_id = ?");
							$stmt->bind_param('dddsdd', $rate_sell, $avg_rate, $rate_buy, $date, $exchange_office_id, $id);
							$stmt->execute();
						}
				// 	} 
				// } else {
				// 	if($rate_buy != 0) {
				// 		$stmt = $this->conn->prepare("INSERT INTO currency_list (exchange_office_id, currency_id, sell_rate, avg_rate, buy_rate, date) VALUES ('$exchange_office_id', '$id', ?, ?, ?, ?)");
				// 		$stmt->bind_param('ddds', $rate_sell, $avg_rate, $rate_buy, $date);
				// 		$stmt->execute();
				// 		echo "done";

				// 	}
				// }
			}
		}
		
	}
	
	$sc = new Scraper("trange frange", "http://www.kursnalista.biz/index.php/kursna-lista");
	
	$sc->setConn($conn);
	$sc->get_table("http://www.kursnalista.biz/index.php/kursna-lista", "//*[@id='t3-content']/div[2]/article/section/div/div/div");
	$sc->setName("raiffeisen");
	$sc->get_table("https://www.raiffeisenbank.rs/stanovnistvo/racuni/placanja/prilivi/kursna-lista.992.html", "//*[@id='kursnalista_velika']/div[3]/table/tbody/tr");
	$sc->setName("paris");
	$sc->get_table("http://www.paris.rs/kursna-lista", "//*[@id='kursna-lista']/div");
	$sc->setName("dok");
	$sc->get_table("http://www.menjacnicedok.rs/kursna_lista.html", "//*[@id='intro-right']/table/tbody[2]/tr");
	$sc->setName("komercijalna");
	$sc->get_table("https://www.kombank.com/kursna-kompletna.php", "//*[@id='kurs-table']/tbody/tr");
	$sc->setName("aik");
	$sc->get_table("https://www.aikbanka.rs/kursna-lista", "//*[@id='exchangeRates']/div[2]/table/tbody/tr");

?>