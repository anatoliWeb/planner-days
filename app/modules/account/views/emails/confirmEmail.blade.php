<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Complete registration</h2>

		<div>
			To complete registration, follow the link {{ URL::to('/confirm', array($hash)) }}.
		</div>
	</body>
</html>