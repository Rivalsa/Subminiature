<!DOCTYPE html>
<html style="font-size:100px;" lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noarchive">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <noscript><meta http-equiv="refresh" content="0;URL=https://www.rivalsa.net/error/noscript.php"></noscript>
    <title>rivalsa.net</title>
    <link href="https://static.rivalsa.net/code/css/init_v1.css" rel="stylesheet">
    <style>
        body {
            background-image:url(https://static.rivalsa.net/img/bg/0.jpg);
        }
        #error-msg {
            display: none;
            margin: 2rem auto;
            min-width: 3.5rem;
            max-width: 5rem;
            width: 90%;
        }
        p {
            margin: .1rem 0;
        }
        p:first-child {
            font-size: .2rem;
            font-weight: 600;
        }
        p:first-child > span {
            color: red;
        }
        p:last-child {
            margin-top: .5rem
        }
        @media all and (max-width:450px) {
            p:last-child {
                font-size: .12rem;
            }
        }
    </style>
</head>
<body>
    <div id="error-msg">
        <p>很抱歉：<span></span></p>
        <p>错误代码：<span></span></p>
        <p>由于出现以上错误，本站无法为您显示页面，请您核实输入的网址是否正确。</p>
        <p>版权所有 &copy; 2017-<?php echo date("Y"); ?> rivalsa.net 保留所有权利.<br>
		Copyright &copy; 2017-<?php echo date("Y"); ?> rivalsa.net All rights reserved.</p>
    </div>
    <script>
        'use strict'
        const goToURL = ({code, msg, url}) => {
            const aSpan = document.getElementsByTagName('span'),
                oErrorMsg = document.getElementById('error-msg');
            if(code) {
                oErrorMsg.style.display = 'block';
                aSpan[0].innerText = msg;
                aSpan[1].innerText = code;
                return;
            }
            if(!url) {
                oErrorMsg.style.display = 'block';
                aSpan[0].innerText = '此页面已经停止访问';
                aSpan[1].innerText = 'STOP';
                return;
            }
            location.href = url;
        };
    </script>
    <script src="https://api.rivalsa.net/link_url.php?linkid=<?php echo (isset($_GET["linkid"]) && is_numeric($_GET["linkid"])) ? $_GET["linkid"] : 0; ?>"></script>
</body>
</html>