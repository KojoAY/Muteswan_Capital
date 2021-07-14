<?php
set_time_limit(0);
ignore_user_abort(true);


// function to make GET request using cURL
function curlGet($url) {
	$headers = Array(
                "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5",
                "Cache-Control: max-age=0",
                "Connection: keep-alive",
                "Keep-Alive: 300",
                "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7",
                "Accept-Language: en-us,en;q=0.5",
                "Pragma: "
            );
    $config = Array(
	            CURLOPT_SSL_VERIFYPEER => true,
	            CURLOPT_SSL_VERIFYHOST => 2,
	            CURLOPT_RETURNTRANSFER => TRUE ,
	            CURLOPT_FOLLOWLOCATION => TRUE ,
	            CURLOPT_AUTOREFERER => TRUE ,
	            CURLOPT_CONNECTTIMEOUT => 120 ,
	            CURLOPT_TIMEOUT => 120 ,
	            CURLOPT_MAXREDIRS => 10 ,
	            CURLOPT_USERAGENT => "Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1a2pre) Gecko/2008073000 Shredder/3.0a2pre ThunderBrowse/3.2.1.8" ,
	            CURLOPT_URL => $url
	        );

    $handle = curl_init() ;
    curl_setopt_array($handle, $config) ;
    curl_setopt($handle, CURLOPT_HTTPHEADER, $headers) ;

    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);

	#curl_setopt($handle, CURLOPT_CAINFO, getcwd() . '\GoDaddyRootCertificateAuthority-G2.crt');
    
    //@$output->data = curl_exec($handle);
    @$output = curl_exec($handle);

    curl_close($handle) ;
    return $output;
}

$webPageData = array();	// declaring array to store scraped book data

// function to return XPath object
function returnXPathObject($item) {
	// instantiating a new DomDocument
	$xmlPageDom = new DomDocument();	

	// load the HTML from the downloaded page
	@$xmlPageDom->loadHTML($item);	
	
	// instantiating new XPath Dom object
	$xmlPageXPath = new DOMXPath($xmlPageDom);	

	// returning XPath object
	return $xmlPageXPath;	
}


//$data = "https://www.sikasem.org/treasury-bill-rates/";
$data = "http://www.bog.gov.gh/data/tbillrate.php";


$webPage = curlGet($data);

// instantiating new XPath Dom object
$webPageXpath = returnXPathObject($webPage);

$contentEntry = $webPageXpath->query('//h4');
@$webPageData["contentEntry"] = $contentEntry->item(0)->nodeValue;

echo '<h2>' . $webPageData["contentEntry"] . '</h2>';

echo '
<table>
	<tr>';
$tb_head = $webPageXpath->query('//th[@class="ht"]');
for($i=0; $i<$tb_head->length;$i++){
	
		$webPageData["tb_head"] = $tb_head->item($i)->nodeValue;
		echo '<th><strong>' . $webPageData["tb_head"] . '</strong></th>';
}
echo '
	</tr>';

$rateVal = $webPageXpath->query('//td');
for($t=0; $t < $rateVal->length-2; $t++){
	if($t == 0 || $t == 3 || $t == 6){
		echo '<tr>';
		echo '<td>' . $webPageData["rateVal"] = $rateVal->item($t)->nodeValue . '</td>';
	}

	if($t == 1 || $t == 4 || $t == 7) {
		echo '<td id="mid">' . $webPageData["rateVal"] = $rateVal->item($t)->nodeValue . '</td>';
	}

	if($t == 2 || $t == 5 || $t == 8){
		echo '<td>' . $webPageData["rateVal"] = $rateVal->item($t)->nodeValue . '</td>';
		echo '</tr>';
	}
}

echo '
	
</table>';
echo (!isset($webPageData["contentEntry"])) ? 'Treasury bills data not available at this time.' : '';
?>