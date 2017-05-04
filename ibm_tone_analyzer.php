<?php

class IBMTone{
	private $api_URL;
	private $username;
	private $password;
	private $version;
	private $tone;
	private $tone_chat;
	
	public function __construct($username,$password) {
		
		
		$this->api_URL = 'https://gateway.watsonplatform.net/tone-analyzer/api';
		$this->version = '2016-05-19';
		$this->username = $username;
		$this->password = $password;
	}
	/*
	Analyzes the tone of a piece of text. The message is analyzed for several tones - social, emotional, and language. For each tone, various traits are derived. For example, conscientiousness, agreeableness, and openness.
	For detail: https://www.ibm.com/watson/developercloud/tone-analyzer/api/v3/#post-tone
	Parameters:	
		text: Text that contains the content to be analyzed. The Tone Analyzer Service supports up to 128KB of text, or about 1000 sentences. Sentences with less than three words cannot be analyzed.
		tones: Filter the results by a specific tone. Valid values: emotion, language, and social.
		sentences:Filter your response to remove the sentence level analysis. Valid values for sentences are true and false. This parameter defaults to true when it's not set, which means that a sentence level analysis is automatically provided. Change sentences=false to filter out the sentence level analysis.
	*/
	
	
	public function analyze_general_tone($text, $tones = null, $sentences = null){
		$URL = $this->url_generator('tone', $tones, $sentences);
		$data = json_encode(array('text' => $text));
		return $this->connect($URL,$data);		
	}
	
	/*
	Use the Tone Analyzer for Customer Engagement Endpoint to monitor customer service and customer support conversations.
	For detail: https://www.ibm.com/watson/developercloud/tone-analyzer/api/v3/#customer-tone
	Parameter:
		utterances: JSON that contains the content to be analyzed. 
	*/	
	
	public function analyze_customer_engagement_tone($pairs){
		echo $URL;
		$URL = $this->url_generator('chat');
		$data = json_encode(array('utterances' => $pairs));
		return $this->connect($URL,$data);
		
	}
	private function url_generator($type, $tones = null, $sentences = null){
		$URL = $this->api_URL;
		switch($type){
			case 'tone':
				$URL .= '/v3/tone?version='.$this->version;
				break;
			case 'chat':
				$URL .= '/v3/tone_chat?version='.$this->version;
				break;
		}

		if($tones){
			$URL .= '&tones='.$tones;
		}		
		if($sentences){
			$URL .= '&sentences='.$sentences;
		}
		return $URL;
		
	}
	private function connect($URL, $data){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_URL,$URL);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_USERPWD, $this->username.':'.$this->password);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result=curl_exec ($ch);
		$json = json_decode($result);
		curl_close ($ch);

		return $json;
	}
	
	
}



?>