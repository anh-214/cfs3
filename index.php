<?php 
$conn = mysqli_connect('localhost','root','','thpthhcf_love');
if ($conn->connect_error){
    die('lỗi '.$conn->connect_error);
}
function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if (isset($_POST['content'])){
        while (true)
        {   
            $createCode = generateRandomString();
            // $code = '123';
            if ($conn->query("SELECT * FROM `love` WHERE `love`.`code` = '$createCode'")->fetch_assoc() == null){

                $conn->query("INSERT INTO `love`(`id`, `code`, `content`) VALUES ('','$createCode','{$_POST['content']}')");
                $status = 1;
                $link =  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'sendlove-'.$createCode;
                $html = '
                <button onclick="myFunction()" style="padding: 6px 12px;
                border-radius: 6px;
                border: none;
                background: #ff9800;
                color: white;
                cursor: pointer;
                ">Copy Link</button>
                <p>Hãy nhấp vào nút "copy link" ở trên và gửi cho người bạn thương ngay nhé 💖💖💖</p>
                <p>Hoặc đường link dưới đây:</p>
                <a id="copytoclipboard" href="'.$link.'">'.$link.'</a>
                ';
            } else {
                $status = 0;
                $html = '
                <p>Hãy thử lại một lần nữa bạn nhé 💖💖💖</p>
                ';
            }
            header('Content-Type: application/json');
            echo json_encode(array('status'=> $status,'html' => $html));
            exit;
        }

}
if (isset($_GET['code'])){
    $code = $conn->query("SELECT * FROM `love` WHERE `love`.`code` = '{$_GET['code']}'")->fetch_assoc();
    if ($code == null){
        echo '<script>while (true) { alert("=))") }</script>';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Meta Tags-->
    <meta name="keywords" content="Đăng Confessions lên THPTHaHoaConfession3" />
    <meta name="description" content="Nơi những điều bí mật được bật mí" />
    <meta name="author" content="THPTHaHoaConfession3" />

    <!--SEO-->
    <meta property="og:type" content="website">
    <meta name="description" content="Đăng Confessions">
    <meta property="og:title" content="THPT Hạ Hoà Confessions 3">
    <meta property="og:description" content="Đăng Confessions lên THPT Hạ Hoà Confessions 3">
    <meta property="og:url" content="https://thpthahoacfs3.xyz/">
    <meta property="og:site_name" content="Đăng CFS ngay nào">
    <meta property="og:image" content="./assets/image/bgr.jpg">
    <meta property="og:image:alt" content="Logo">
    <title><?php echo !isset($code) ? 'THPT Hạ Hòa Confession3' : 'Nhắn gửi yêu thương ❤️❤️❤️'  ?>  </title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./assets/image/logo2.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/resetcss.css">
    <link rel="stylesheet" href="./css/plugin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">

<?php if(!isset($code)) { ?>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body style="background-color: rgb(255, 230, 234);">
<div class="tab menu_top container">
    <div class="dad">
        <nav class="navbar navbar-expand-md ">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://www.facebook.com/THPTHaHoaConfession3"><button
                        class="bttn-fill bttn-md bttn-success">THPT Hạ Hòa Confessions 3</button></a>
                <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link nav-item"><button class="tablinks bttn-fill bttn-md bttn-success"
                                    onclick="openCity(event, 'Home')" id="defaultOpen">Home</button></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-item"><button class="tablinks bttn-fill bttn-md bttn-success"
                                    onclick="openCity(event, 'Love')" id="defaultOpen">Nhắn gửi yêu thương</button></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-item"><button class="tablinks bttn-fill bttn-md bttn-success "
                                    onclick="openCity(event, 'Rules')">Nội Quy</button></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-item "><button class="tablinks bttn-fill bttn-md bttn-success"
                                    onclick="openCity(event, 'About')">Về Chúng Tôi</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<div id="Home" class="tabcontent">
    <div class="container">
        <!-- <br> -->
        <div class="row">
            <div class="col-md-12">
                <h1 id="title">THPT HẠ HOÀ CONFESSIONS 3</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Thông báo!</strong>
                    <p class="mb-0">Vui lòng đọc<button class="tablinks" id="noiquy"
                            onclick="openCity(event, 'Rules')">nội quy</button>trước khi đăng confessions.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>

        <div class="filter">
            <form method="POST" id="foo">
                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="form-group space">
                            <br>
                            <label for="content">Tên của bạn là gì vậy ? <i style="font-size: smaller; color:rgb(24, 0, 0);">*Không bắt buộc</i></label>
                            <textarea rows="1" class="form-control" id="ten" name="ten" type="text"></textarea>
                        </div>
                        <div class="form-group space">
                            <br>
                            <label for="content">Nhập Confessions dưới đây</label>
                            <textarea rows="5" class="form-control" id="noidung" name="noidung"
                                type="text"></textarea>
                            <textarea rows="1" class="form-control" id="ip" name="ip" hidden></textarea>
                        </div>
                        <br>
                        <div class="col-12 space">
                            <button id="submit" type="submit" name="action" class="btn btn-success">Submit</button>
                        </div>
                        </br />
                    </div>

                </div>
            </form>
        </div>

    </div>
        <!-- nutlike  -->
     <div class="nutlike">
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="IkmpkNYi"></script>
        <div class="fb-like" data-href="https://www.facebook.com/THPTHaHoaConfession3" data-width="" data-layout="box_count" data-action="like" data-size="small" data-share="true"></div>
    </div>
</div>
<!-- love -->
<div id="Love" class="tabcontent container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card col-lg-5" style="margin:auto;margin-top:100px;" >
                <div class="card-header" style="background-color: pink;">
                    <h2>Gửi lời yêu thương ❤️❤️❤️</h2>
                </div>
                <div class="card-body py-5">
                <form class="needs-validation" style="width:80%;margin:auto">
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="content" rows="5"></textarea>
                        <div class="invalid-feedback" id="errorContent">
                        </div>
                    </div>
                    <button class="btn mt-2" type="button" id="send" style="color: white;background-color:pink">Gửi</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--rules-->
<div id="Rules" class="tabcontent container">
    <br><br>
    <div class="bgrtext">
    </br>
        <div class="covertext">
        <h2>NỘI QUY CỦA TRANG</br>THPT Hạ Hoà Confessions 3</h3>
        <p>
            <br>
            1. Không chống phá nhà nước, xuyên tạc. <br>
            2. Mọi confessions, và mọi bình luận mang hàm ý nói xấu, xúc phạm, kích động lẫn nhau vượt quá giới hạn
            cho
            phép sẽ bị xóa không thông báo trước.<br>
            3. Ngoài ra, để tôn trọng ngôn ngữ Việt và đảm bảo mọi người có thể hiểu được CFS của bạn có những nội
            dung
            gì. Các bạn vui lòng không sử dụng teencode ( ngôn ngữ teen )<br>
            4. Các bạn không ghi nội dung CFS vào tin nhắn của page, nếu bạn làm như vậy, đồng nghĩa với bạn vừa
            nhắn
            tin trực tiếp cho page, mọi thông tin danh tính của bạn người khác có thể xem và biết bạn là ai. Bạn chỉ
            ghi
            nội dung CFS vào đường link dưới đây, chúng tôi cam kết bảo mật mọi thông tin về bạn.<br>
            5. Mọi hình ảnh, video, bài viết hoàn toàn không đại diện cho chủ trương, đường lối của Trường Trung Học
            Phổ
            Thông
        </p>
        </div>   
    </div>
</div>
<!-- about -->
<div id="About" class="tabcontent container">
    <br><br>
        <div class="bgrtext">
                <br>
            <div class="covertext">
                <h2>VỀ CHÚNG TÔI</h2>
                <p>
                            <br>
                            THPT Hạ Hoà CFS 3 được hành lập vào ngày 2/7/2017 <br><br>
                        
                            Confessions là 1 từ tiếng Anh và dịch ra tiếng Việt nó có nghĩa là ”sự thú nhận, lời thú nhận, tự bạch” về 1 câu chuyện, vấn đề nào đó đã và đang xảy ra trong cuộc sống của bản thân, đây là trào lưu đã và đang vẫn còn thịnh hành đặc biệt đối với giới trẻ.<br>
                            <br>

                            Các trang Confessions là nơi mà người kể có thể trút bầu tâm sự, thể hiện tâm tư, tình cảm, những điều thầm kín khó nói mà không cần bật mí danh tính hay bất cứ thông tin cá nhân nào, chỉ cần gửi những tâm sự của họ lên biểu mẫu đã được lập sẵn là xong. Nội dung liên quan đến tình yêu, ngôn tình, học hành, thầy cô, bạn bè, cuộc sống, gia đình … .<br>
                            <br>
                            Đây là nơi mà những điều khó nói nhất giảm được stress. Người viết chủ yếu là học sinh, sinh viên, lứa tuổi mới lớn, tâm trạng hồn nhiên trong sáng tác, suy nghĩ vô định, hoang mang như những mối tình gà bông, quán net, thích bạn cùng lớp, … Mỗi người được nói ra những bí mật của mình giúp họ nhẹ lòng hơn.<br>
                            <br>
                            Ký ức lồng ghép trong Confessions đẹp có, xấu có, buồn có, vui có, phẫn nộ có, chúng chính là phần đời của mỗi chúng ta. Mỗi người đọc confessions luôn cố tìm được chính mình trong câu chuyện, hay đôi khi chỉ là đọc những câu chuyện để giải toả sự mệt mỏi sau một ngày làm việc, lao động mệt mỏi.<br>
                            <br>
                            Điểm hay của Confessions chính là yếu tố bí mật, bản thân những Admin Fanpage, Forum phần lớn (95%) không hề biết người viết Confessions trên trang mình quản trị chính xác là ai do đó bạn cứ tự “vạch áo” thoải mái mà không lo việc viết Confessions bị lộ danh tính. Trừ những trường hợp người viết tự lộ danh tính, hoặc dùng một tài khoản có thực nào đó gửi cho inbox của fanpage,... Giống như trào lưu làm vlog, Confessions xuất xứ từ nước ngoài vào Việt Nam năm 2013 tạo điều kiện cho nhiều người trút bầu tâm sự thầm kín nhất. Đây là 1 kiểu “vạch áo cho người xem lưng” một cách đường đường chính chính dưới sự chứng kiến gián tiếp của cộng đồng. Confessions thường được chia sẻ công khai trên MXH, Forum – diễn đàn, Fanpage, đôi khi là viết ra giấy treo ở nơi công cộng.<br>
                            <br>
                            Confessions - nơi thổ lộ những tâm tư, ưu phiền cũng như niềm vui của mỗi người để nhận được sự đồng cảm từ cộng đồng mạng xã hội. Đồng thời để giải toả để lòng mình được nhẹ nhàng hơn .<br>
                            Nguồn : <b style="color: blue;">KHTN_Confession</b>
                                </p>
            </div>
        </div>


</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
<script src="./js/love.js"></script>
<!-- footer  -->
<footer class="container">
    <div>
        Copyright &copy;
        <script>document.write(new Date().getFullYear())</script>
        <a href="index.html">THPTHaHoaConfession3</a>
    </div>
</footer>
<!-- Compiled and minified JavaScript -->
<!-- active -->
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="./js/true.js"> </script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v10.0'
        });
    };
    (function (d, s, id) {  
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
    crossorigin="anonymous"></script>


<!-- trang sendlove -->
<?php } else { ?>
    <link rel="stylesheet" href="./css/love.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js" integrity="sha512-cyAbuGborsD25bhT/uz++wPqrh5cqPh1ULJz4NSpN9ktWcA6Hnh9g+CWKeNx2R0fgQt+ybRXdabSBgYXkQTTmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="container">
        <div class="dog">
            <img src="./assets/image/dog.png" alt="">
        </div>
        <div class="open-tab"></div>
        <div id="heart" class="heart">
        </div>
        <div class="text-info ">
            Nhấp vào đây nè 
        </div>

        <div class="letter">
            <div>
                <p><?php echo $code['content'] ?></p>    
                <img src="./assets/image/love.gif" width="200px" alt="">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('.text-info').click(function(event) {
                $(this).fadeOut(1500);
                $('#heart').addClass('zommer');
                $('.letter div').fadeIn(3000);  
            });
        });
    </script>
<?php } ?>
</body>
</html>
