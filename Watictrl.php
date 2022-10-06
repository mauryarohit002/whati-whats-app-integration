        public function get_data_for_whatsapp(){
              $form_data = $this->input->post();
                $frm_name = $form_data['rrm_firm_id_name'];
								$en_no = $form_data['rrm_entry_no'];
								// varriable does not blanck or empty if it is then set some value;
								$number1 = strlen($form_data['rrm_mobile1']);
							  	if($number1 == 10)
							  	{
							  		$phone1 = "91".$form_data['rrm_mobile1'];
							  	}
							  	else
							  	{
							  		$phone1 = $form_data['rrm_mobile1'];
							  	}

								if($form_data['rrm_l2_name'] != 0)
								{
									$mro = $form_data['rrm_l2_name'];
								}
								else
								{
									$mro = 'Administrator';
								}
								
								if($form_data['rrm_mobile2'] != '')
								{
									$mro_mobile = $form_data['rrm_mobile2'];
								}
								else
								{
									$mro_mobile = '02268637000/34/35';
								}
                
                //name set as variable which is given inside the template variable
								//template_name its template name in wati dashboard
                //broadcast_name its category name in wati dashboard
                $curl_postfield = "{
                  \"parameters\":[{\"name\":\"firm_name\",\"value\":\"$frm_name\"},
                    {\"name\":\"request_number\",\"value\":\"$en_no\"},
                    {\"name\":\"mro_name\",\"value\":\"$mro\"},      		
                    {\"name\":\"number\",\"value\":\"$mro_mobile\"}],
                    {\"name\":\"number\",\"value\":\"$mro_mobile\"}],
                  \"template_name\":\"jb_request_pending\",
                  \"broadcast_name\":\"Ticket Update\"
                }";
							    
								$sresult1 = $this->send_whatsup_sms($phone1,$curl_postfield);
          }      
//main function 
public function send_whatsup_sms($mob, $curl_postfield)
{
  	$curl = curl_init();

	$url = "https://live-server-5007.wati.io/api/v1/sendTemplateMessage?whatsappNumber=".$mob;
        // print_r($value);
  	curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $curl_postfield,
    CURLOPT_HTTPHEADER => [
      "Authorization: Bearer eyJhbGciOiJIUzsdsdsdI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiI4ZmZhNzc2Zi02MTE0LTRkZWMtYjJmYy0yYjgxMjIzNWYxZGQiLCJ1bmlxdWVfbmFtZSI6InZpa2FzQGthdGFyaWFpbnN1cmFuY2UuY29tIiwibmFtZWlkIjoidmlrYXNAa2F0YXJpYWluc3VyYW5jZS5jb20iLCJlbWFpbCI6InZpa2FzQGthdGFyaWFpbnN1cmFuY2UuY29tIiwiYXV0aF90aW1lIjoiMDkvMTEvMjAyMSAwNTo1MzoxOSIsImh0dHA6Ly9zY2hlbWFzLm1pY3Jvc29mdC5jb20vd3MvMjAwOC8wNi9pZGVudGl0eS9jbGFpbXMvcm9sZSI6IkFETUlOSVNUUkFUT1IiLCJleHAiOjI1MzQwMjMwMDgwMCwiaXNzIjoiQ2xhcmVfQUkiLCJhdWQiOiJDbGFyZV9BSSJ9.wnBNURFNR5BQ7mWnqbofiS-RPA5Adxc69-xkP6T6dAM",
      "Content-Type: application/json-patch+json"
        ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);


    curl_close($curl);
    
		if ($err) {
  		echo "cURL Error #:" . $err;
	} 
	else 
	{
    //   $response;
      	if(!empty($response))
      	{
        	return 1;
      	}else
      	{
        	return 0;
      	}
	}	

}	
