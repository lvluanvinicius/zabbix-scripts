<?php 

function get_file_ticket()
{
    $ticket_file = fopen("ticket.json", "r");
    $test=fread($ticket_file, filesize("ticket.json"));

    $output=json_decode($test);

    foreach ($output as $d) {
        return $d->ticket;
    }
}


function accept($method = "GET", $url="", $data = [], $verify = true, $headers = [], $verbose = false)
{
    $curl = curl_init();
    
	curl_setopt_array($curl, [
        CURLOPT_URL => $url,
		CURLOPT_CUSTOMREQUEST   => $method, 
		CURLOPT_VERBOSE         => $verbose,
		CURLOPT_RETURNTRANSFER  => true,
		CURLOPT_SSL_VERIFYPEER  => $verify,
		CURLOPT_SSL_VERIFYHOST	=> false,
		CURLOPT_HTTPHEADER      => $headers,
		CURLOPT_POSTFIELDS      => $data
	]);
    
    $ticket=get_file_ticket();
    
    curl_setopt($curl, CURLOPT_COOKIE, "PVEAuthCookie=".$ticket);
    
	// Executa a requisição;
	$output = curl_exec($curl);
    
	curl_close($curl);
	return $output;
}

$response = accept($method="GET",
    $url=$argv[1], 
    $data=[],
    $verify=false
);

//http_build_query(array("PVEAuthCookie" => get_file_ticket())) 
print($response);