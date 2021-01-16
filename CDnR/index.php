<?php
switch($_SERVER["SERVER_NAME"]) {
    // 博客.卅卅.我爱你
    case "xn--9krq6q.xn--okra.xn--6qq986b3xl":
        $returnURL = "https://www.rivalsa.net/blog/index.php";
        break;
    // 工单.卅卅.我爱你
    case "xn--4krr9v.xn--okra.xn--6qq986b3xl":
        $returnURL = "https://www.rivalsa.net/workorder/index.php";
        break;
    // 碎碎念.卅卅.我爱你
    // case "xn--h7t906ca.xn--okra.xn--6qq986b3xl":
    //     $returnURL = "https://www.rivalsa.net/blog/daily/index.php";
    //     break;
    // 愿望单.卅卅.我爱你
    case "xn--4krr73auqe.xn--okra.xn--6qq986b3xl":
        $returnURL = "https://www.rivalsa.net/blog/index.php?a=43";
        break;
    // 歌单.卅卅.我爱你
    case "xn--4krp17c.xn--okra.xn--6qq986b3xl":
        $returnURL = "https://www.rivalsa.net/blog/index.php?a=39";
        break;
    default:
        $returnURL = "https://xn--okra.xn--6qq986b3xl";
}
header("location:$returnURL",true,301);
?>