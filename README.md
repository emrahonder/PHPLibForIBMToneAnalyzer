# PHP Lib For IBM Tone Analyzer
The IBM Watson™ Tone Analyzer service uses linguistic analysis to detect communication tones in written text. Use the Tone Analyzer service to understand conversations and communications, 
and then respond to customers appropriately at scale. To get details, visit offical documentation:
https://www.ibm.com/watson/developercloud/tone-analyzer/api/v3/#introduction

This library allows to connect this service easily.

# Usage
Firstly from IBM Bluemix panel, username and password should be taken. Then ibm_tone_analyzer.php file should be imported to your PHP lib.

```php
require 'ibm_tone_analyzer.php';
```

## Initialize
```php
$IBMTone = new IBMTone("[USERNAME]","[PASSWORD]");
```
## Sample for "Analyze general tone"

```php
$results = $IBMTone->analyze_general_tone("I lost my key, how can I take new one?");
```

## Sample for "Analyze customer engagement tone"
### Request:
```php
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
```
