<?php
include_once("key.php");
include_once("rivalsaFontV0.php");
$key = (isset($_GET["key"]) && is_string($_GET["key"])) ? $_GET["key"] : "";
$value = (isset($_GET["value"]) && is_string($_GET["value"])) ? $_GET["value"] : "";
if($value) {
    switch($key) {
        case "keyword":
            $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,"www");
            $conn -> query("set names 'utf8'");
            $sql = "SELECT `URL`,`op`,`denyText` FROM `link_url` WHERE `keyword`=?";
            $conn_stmt = $conn -> prepare($sql);
            $conn_stmt -> bind_param("s",$value);
            $conn_stmt -> bind_result($url,$op,$denyText);
            $conn_stmt -> execute();
            $conn_stmt -> fetch();
            $conn_stmt -> close();
            if($url) {
                if($op & 4) {
                    $out = array(
                        "code" => 1004,
                        "msg" => "您请求的内容已被删除",
                        "url" => "",
                        "warning" => false,
                        "prohibited" => false,
                        "sanction" => false,
                        "denyText" => ""
                    );
                } else {
                    $out = array(
                        "code" => 0,
                        "msg" => "",
                        "url" => ($op & 2) ? getRivalsaFontV0($url) : $url,
                        "warning" => ($op & 1) ? false : true,
                        "prohibited" => ($op & 2) ? true : false,
                        "sanction" => ($op & 8) ? true : false,
                        "denyText" => $denyText
                    );
                }
            } else {
                $out = array(
                    "code" => 1002,
                    "msg" => "您请求的内容不存在",
                    "url" => "",
                    "warning" => false,
                    "prohibited" => false,
                    "sanction" => false,
                    "denyText" => ""
                );
            }
            $conn -> close();
            break;
        case "ID":
            $conn = new mysqli(DB_HOST,DB_USER,DB_PASS,"www");
            $conn -> query("set names 'utf8'");
            $sql = "SELECT `URL`,`op`,`denyText` FROM `link_url` WHERE `ID`=?";
            $conn_stmt = $conn -> prepare($sql);
            $conn_stmt -> bind_param("i",$value);
            $conn_stmt -> bind_result($url,$op,$denyText);
            $conn_stmt -> execute();
            $conn_stmt -> fetch();
            $conn_stmt -> close();
            if($url) {
                if($op & 4) {
                    $out = array(
                        "code" => 1005,
                        "msg" => "您请求的内容已被删除",
                        "url" => "",
                        "warning" => false,
                        "prohibited" => false,
                        "sanction" => false,
                        "denyText" => ""
                    );
                } else {
                    $out = array(
                        "code" => 0,
                        "msg" => "",
                        "url" => ($op & 2) ? getRivalsaFontV0($url) : $url,
                        "warning" => ($op & 1) ? false : true,
                        "prohibited" => ($op & 2) ? true : false,
                        "sanction" => ($op & 8) ? true : false,
                        "denyText" => $denyText
                    );
                }
            } else {
                $out = array(
                    "code" => 1003,
                    "msg" => "您请求的内容不存在",
                    "url" => "",
                    "warning" => false,
                    "prohibited" => false,
                    "sanction" => false,
                    "denyText" => ""
                );
            }
            $conn -> close();
            break;
        default:
            $out = array(
                "code" => 1000,
                "msg" => "您请求的内容不存在",
                "url" => "",
                "warning" => false,
                "prohibited" => false,
                "sanction" => false,
                "denyText" => ""
            );
    }
} else {
    $out = array(
        "code" => 1001,
        "msg" => "您请求的内容不存在",
        "url" => "",
        "warning" => false,
        "prohibited" => false,
        "sanction" => false,
        "denyText" => ""
    );
}
?>
<!DOCTYPE html>
<html style="font-size:100px;" lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noarchive">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <noscript><meta http-equiv="refresh" content="0;URL=https://static.rivalsa.net/code/error/nojs.html"></noscript>
<?php
    if(!$out["code"] && !$out["sanction"] && !$out["warning"] && !$out["prohibited"]) {
?>
        <meta http-equiv="refresh" content="0; url=<?php echo $out["url"]; ?>">
<?php
    }
?>
    <title>Rivalsa短网址</title>
    <link href="https://static.rivalsa.net/code/css/init_v1.css" rel="stylesheet">
    <script async src="https://static.rivalsa.net/code/error/ie.js"></script>
    <style>
        main {
            box-sizing: border-box;
            margin: auto;
            padding: 10vh 0;
            max-width: 1000px;
            min-width: 350px;
            height: 100vh;
        }
        main > p {
            margin: .2rem auto;
            min-width: 350px;
            width: 80%;
        }
        main > .title {
            font-weight: 600;
            font-size: .26rem;
            text-align: center;
        }
        main.prohibited > .title {
            color: red;
        }
        @font-face {
            font-family: "rsenc";
            src: url("https://static-cors.rivalsa.net/font/rivalsaFontV0.ttf");
        }
        main > .url {
            font-weight: 600;
            font-size: .2rem;
            text-align: center;
            word-break: break-all;
            color: rgb(2, 74, 180);
        }
        main.prohibited > .url {
            font-family: "rsenc";
            user-select: none;
        }
        main > .text {
            margin-top: 0;
            margin-bottom: 0;
            font-size: .2rem;
        }
        main.prohibited > .text {
            color: #777;
        }
        main.prohibited > .text > span {
            color: red;
        }
        main.warning > .text {
            text-align: center;
        }
        main > .go {
            margin: 7vh auto 0;
            min-width: 350px;
            width: 80%;
            border-radius: .25rem;
            text-align: center;
            font-size: .24rem;
            line-height: .5rem;
            background-image: linear-gradient(to right,rgb(89, 147, 223), rgb(24, 122, 214));
        }
        main > .go:hover {
            background-image: linear-gradient(to left,rgb(89, 147, 223), rgb(24, 122, 214));
        }
        main > .go > a {
            display: block;
            width: 100%;
            height: 100%;
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body class="bg0" style="font-size:.16rem">
<?php
    if($out["code"]) {
        if($out["code"] === 1004 || $out["code"] === 1005) http_response_code(410); else http_response_code(404);
?>
        <main>
            <p class="title"><?php echo $out["msg"] ?></p>
            <p class="text">很抱歉，您请求的内容不存在，请核实您的URL是否有误。或者您可以尝试访问如下内容：</p>
            <p class="text"><a href="https://www.rivalsa.net">知识分享</a> | <a href="https://www.rivalsa.net/blog/index.php">网络日志</a> | <a href="https://www.rivalsa.net/workorder/index.php">工单系统</a> | <a rel="noopener nofollow" href="https://weibo.com/rivalsa">微博</a> | <a rel="noopener nofollow" href="https://i.youku.com/rivalsa">优酷</a> | <a rel="noopener nofollow" href="https://space.bilibili.com/518370537">bilibili</a> | <a rel="noopener nofollow" href="https://www.douyu.com/7103713">斗鱼</a> | <a rel="noopener nofollow" href="https://github.com/rivalsa">Github</a> | <a rel="noopener nofollow" href="https://gitee.com.rivalsa">码云</a></p>
        </main>
<?php
    } else {
        if($out["sanction"]) {
?>
        <main class="warning">
            <p class="title">您即将访问</p>
            <p class="url"><?php echo $out["url"]; ?></p>
            <p class="text">对方转跳本网站时显示中间页面，本网站也采取对等措施。</p>
            <p class="text">您即将访问的网站<span style="color:red;">安全性未知</span>，请您注意隐私及财产安全。</p>
            <div class="go"><a rel="nofollow noopener" href="<?php echo $out["url"]; ?>">继续访问</a></div>
        </main>
<?php
        } else {
            if($out["prohibited"]) {
?>
                <main class="prohibited">
                    <p class="title">警告：您即将访问</p>
                    <p class="url rsenc"><?php echo $out["url"]; ?></p>
                    <p class="text"><span><?php echo $out["denyText"]; ?></span>如果您希望继续访问，请您手动在浏览器地址栏中输入网址，并在访问时注意您的隐私和财产安全。如果您是此网站的站长，可以通过<a target="_blank" href="https://www.rivalsa.net/workorder/index.php">发起工单</a>申请解封。</p>
                    <p class="text">&nbsp;</p>
                    <p class="text">或者您可以尝试访问如下内容：</p>
                    <p class="text"><a href="https://www.rivalsa.net">知识分享</a> | <a href="https://www.rivalsa.net/blog/index.php">网络日志</a> | <a href="https://www.rivalsa.net/workorder/index.php">工单系统</a> | <a rel="noopener nofollow" href="https://weibo.com/rivalsa">微博</a> | <a rel="noopener nofollow" href="https://i.youku.com/rivalsa">优酷</a> | <a rel="noopener nofollow" href="https://space.bilibili.com/518370537">bilibili</a> | <a rel="noopener nofollow" href="https://www.douyu.com/7103713">斗鱼</a> | <a rel="noopener nofollow" href="https://github.com/rivalsa">Github</a> | <a rel="noopener nofollow" href="https://gitee.com.rivalsa">码云</a></p>
                </main>
<?php
            } else {
                if($out["warning"]) {
?>
                    <main class="warning">
                        <p class="title">您即将访问</p>
                        <p class="url"><?php echo $out["url"]; ?></p>
                        <p class="text">此页面未经本网站主办方审核，其安全性未知，请谨慎访问。</p>
                        <p class="text">如果您希望继续访问，请您注意隐私及财产安全。</p>
                        <div class="go"><a rel="nofollow noopener" href="<?php echo $out["url"]; ?>">继续访问</a></div>
                    </main>
<?php
                }
            }
        }
    }
?>
    <script>
        'use strict';
        const resizeFun = () => {
            const nowHTMLOffsetWidth = document.documentElement.offsetWidth;
            if(nowHTMLOffsetWidth < 350) {
                document.documentElement.style.fontSize = '51.47px'; 
            } else if(nowHTMLOffsetWidth < 680) {
                document.documentElement.style.fontSize = nowHTMLOffsetWidth / 6.8 + 'px'; 
            } else {
                document.documentElement.style.fontSize = '100px'; 
            }
            return resizeFun;
        };
        window.addEventListener('resize', resizeFun());
    </script>
</body>
</html>