<html>
	<head>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css">
		<script src="js/bootstrap.min.js"></script>
		<title>Daljinec</title>
	</head>
	<body>

		<div class="container">


		<?php
			$doc = new DOMDocument();
			$doc->load('scenario.xml');

		   	$searchNode = $doc->getElementsByTagName( "slide" );

		   	foreach( $searchNode as $searchNode ) 
			{
				// get attribute NAME
				$valueName = $searchNode->getAttribute('name'); 
				// get ID of slide
				$valueId = $searchNode->getAttribute('id'); 
				// get element by tag name PERIOD
				$xmlPeriod = $searchNode->getElementsByTagName( "period" ); 
				$valuePeriod = $xmlPeriod->item(0)->nodeValue; 

				// convert to minutes and seconds
				$minutes = floor((intval($valuePeriod) / 60) % 60);
				$seconds = (intval($valuePeriod)) % 60;

				// get type of object
				$xmlObject = $searchNode->getElementsByTagName( "object" );
				$valueObject = $xmlObject->item(0)->getAttribute('type'); 

			?>
				<button type="button" class="btn btn-primary btn-lg btn-block" <?php  echo "id='" . $valueId . "'";  ?> >
				<div class="text"><span><?php echo $valueName; ?></span></div>
				<div class="icon">
					<?php 
					if($valueObject === "MULTIPART") {
						$class = "glyphicon glyphicon-th-large";
					}
					else if($valueObject === "VIDEO") {
						$class = "glyphicon glyphicon-facetime-video";
					}
					else if($valueObject === "WEB") {
						$class = "glyphicon glyphicon-link";
					}
					else if($valueObject === "IMAGE") {
						$class = "glyphicon glyphicon-picture";
					}
					echo "<span class='" . $class . "'></span>"; ?>
				</div>
				<div class="time"><span><?php 
					if($minutes != 0 && $seconds != 0)
						echo $minutes . "m " . $seconds . "s";
					else if($minutes == 0 && $seconds != 0)
						echo $seconds . "s";
					else if($minutes != 0 && $seconds == 0)
						echo $minutes . "m";
					else 
						echo "";
				?></span></div>
				</button>
			<?php } ?>
		</div>
	</body>
</html>