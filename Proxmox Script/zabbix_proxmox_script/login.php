<?php 


function accept($method = "GET", $url="", $data = false, $verify = true, $headers = [], $verbose = false)
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

	// Executa a requisição;
	$output = curl_exec($curl);

	curl_close($curl);
	return $output;
}



$login_data = array (
	"username" => $argv[3],
	"password" => $argv[4]
);

$response = accept($method="POST",
	$url=$argv[2], 
	$data=http_build_query($login_data), $verify=false
);

print_r(json_decode($response));