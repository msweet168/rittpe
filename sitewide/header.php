
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/navstyles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/memberstyles.css">
    <link rel="shortcut icon" href="favicon.png">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
</head>
<body>
	
<?php
	function thisPage($page){
        $this_page = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);
        if($this_page == $page){
            echo "current";
        }
    }

    function thisStr($page){
        $this_page = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);
        if($this_page == $page){
            return "current";
        }
    }
?>