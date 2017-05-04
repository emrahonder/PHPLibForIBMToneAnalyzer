<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

	</head>
	<body>
		<h2>Initialize</h2>
	<?php
		require 'ibm_tone_analyzer.php';
							
		$IBMTone = new IBMTone("25321bef-e768-4ac8-bb7f-175e04b7931e","FREbHcn226N7");
		echo '<pre>$IBMTone = new IBMTone("[USERNAME]","[PASSWORD]");</pre>';
	?>
		<h2>Sample for "Analyze general tone" </h2>
		<div>
			<?php
				echo '<h3>Request:</h3>';
				echo '<pre>$results = $IBMTone->analyze_general_tone("I lost my key, how can I take new one?");</pre>';
				$results = $IBMTone->analyze_general_tone('I lost my key, how can I take new one?');
				echo '<h3>Response:</h3>';
				echo '<pre>';
				print_r($results);
				echo '</pre>';
			?>
		</div>
		<h2>Sample for "Analyze customer engagement tone" </h2>
		<div>
			<?php
				echo '<h3>Request:</h3>';
				echo '<pre>$results = $IBMTone->analyze_customer_engagement_tone($pairs);</pre>';
				echo '<h3>Response:</h3>';
				$pairs = array();
				$pair['text'] = 'How are you?';
				$pair['user'] = 'agent';
				$pairs[] = $pair;
				$pair['text'] = 'Fine, thanks and you?';
				$pair['user'] = 'customer';
				$pairs[] = $pair;								
				$pair['text'] = 'Thanks, how can I help you?';
				$pair['user'] = 'agent';
				$pairs[] = $pair;								
				$pair['text'] = 'I lost my key, how can I take new one?';
				$pair['user'] = 'customer';
				$pairs[] = $pair;
				
				
				$results = $IBMTone->analyze_customer_engagement_tone($pairs);
				echo '<pre>';
				print_r($results);
				echo '</pre>';
			?>
		</div>
	</body>
</html>