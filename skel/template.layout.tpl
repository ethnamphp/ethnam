<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="{$config.url}css/ethna.css" type="text/css" />
<title>{$project_id}</title>
</head>
<body>
<div id="header">
    <h1>{$project_id}</h1>
</div>

<div id="main">
{$content}
</div>

<div id="footer">
    Powered By <a href="http://ethna.jp">Ethna</a>-{$smarty.const.ETHNA_VERSION}.
</div>
</body>
</html>
