<?php

?>
<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="de" xml:lang="de">
<head>
<title>Mein Templatesystem:: {$title}</title>
<meta http-equiv="Content-Type" content="text/xhtml; charset=ISO-8859-1" />
</head>
<body>
<h1>Test</h1>
Hallo {$name}. Der Aktuelle Timestamp lautet: {$time}
{* Ein Template einbinden *}
{include file="othertemplate.tpl"}
</body>
</html>
