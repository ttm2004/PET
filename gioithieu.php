<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/lienhe.css">
    <link rel="stylesheet" href="../css/gioithieu.css">
    <link rel="shortcut icon" href="../Image/Logo.png" type="image/x-icon" />
    <script src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script
      src="https://kit.fontawesome.com/54e4f189c9.js"
      crossorigin="anonymous"
    ></script>
    <title>Trang Chủ</title>
  </head>
  <body>
    <div class="header">
      <div class="head">
        <div class="info adr">
          <i class="fa-solid fa-house-chimney " style="--fa-primary-color: dodgerblue; --fa-secondary-color: gold; --fa-secondary-opacity: 1.0;"></i>
          <span>Vì Sức Khỏe Thú Cưng</span>
        </div>
        <div class="info timer">
          <i class="fa-solid fa-clock"></i>
          <span>Open Mon-Fri: 6:30AM to 7PM, Sat: 8AM to 5PM</span>
        </div>
        <div class="info mail">
          <i class="fa-solid fa-envelope"></i>
          <span>info@themerex.ne</span>
        </div>
      </div>
      <nav class="menu">
        <div class="logo">
          <a href="../Home/index.php">
            <img src="./Image/Logo.png" alt="Trang chủ" />
          </a>
        </div>
        <ul id="main-menu">
          <li class="list"><a href="../Home/index.php">Trang Chủ</a></li>
          <li class="list"><a href="gioithieu.php">Giới thiệu</a></li>
          <li class="list list-3">
            <a href=""
              >Cửa Hàng<i class="fa-sharp fa-solid fa-chevron-down"></i
            ></a>
            <ul class="menu-gio-hang">
              <li><a href="">Giỏ hàng</a></li>
              <li><a href="">Thanh toán</a></li>
              <li><a href="">Kiểm tra đơn hàng</a></li>
            </ul>
          </li>
          <li class="list"><a href="Tin-tuc/">Tin tức</a></li>
          <li class="list"><a href="../contact/contact.php">Liên hệ</a></li>
          <li class="list">
            <div class="icon-search">
              <input type="text" placeholder="Tìm kiếm...">
              <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
          </li>
        </ul>
      </nav>
    </div>
    <main class="intro-container">
      <div class="container">
        <h2 style="text-align: center;">
          Axiom yêu khách hàng của họ
        </h2>
        <p style="text-align: center; margin: 20px">
          Đó là lý do tại sao chúng tôi tạo ra các thiết kế sáng sủa, bắt mắt và
          làm cao cấp mã chất lượng để bạn quá hài lòng với các sản phẩm của
          chúng tôi.
        </p>
      </div>
      <div class="intro-pet-care">
        <h1>Vài nét về Pet Care</h1>
        <p>Mua sản phẩm từ Axiom có nghĩa là giao phó danh tiếng của bạn đến một trong những studio web tốt nhất.</p>
        <div class="cnt-intr">
          <div class="intr-left">
            <p><i class="fa-solid fa-right-to-bracket fa-3x"></i></p>
            <h3>Phù hợp cho bất kỳ mục đích nào</h3>
            <p>Công ty Axiom thực hiện công việc của mình với một khách hàng, chúng tôi đảm bảo rằng chủ đề Thú cưng sẽ là bất kỳ loại trang web nào bạn muốn.</p>
          </div>
          <div class="intr-cent">
            <p><i class="fa-sharp fa-solid fa-tv fa-3x"></i></p>
            <h3>Đáp ứng 100%</h3>
            <p>Thú cưng sẽ tự động được điều chỉnh theo bất kỳ độ phân giải nào mà bạn không phải lo lắng về việc tạo phiên bản cho mỗi màn hình.</p>
          </div>
          <div class="intr-">
            <p><i class="fa-regular fa-paper-plane fa-3x"></i></p>
            <h3>Cập nhật và hỗ trợ miễn phí</h3>
            <p>Chúng tôi tạo ra các chủ đề của chúng tôi với suy nghĩ của khách hàng, do đó nhóm của chúng tôi làm việc chăm chỉ để cung cấp cho bạn sự hỗ trợ kỹ thuật tốt nhất trên thế giới.</p>
          </div>
        </div>
      </div>
      <div class="end-container">
        <div class="end-lefy">
          <p>CHÚNG TÔI LÀ AI,CHÚNG TÔI LÀM GÌ</p>
          <h1>chúng tôi là ai</h1>
          <p style="font-family: Arial, Helvetica, sans-serif;padding:20px 110px;">Mua sản phẩm web từ công ty Axiom có nghĩa là giao phó danh tiếng của bạn cho một trong những studio web tốt nhất trong lĩnh vực này. Nhóm của chúng tôi tạo ra các chủ 
            đề của chúng tôi với suy nghĩ của khách hàng, do đó bộ óc sáng tạo của chúng tôi làm việc chăm chỉ để cung cấp cho bạn sự hỗ trợ kỹ thuật tốt nhất trên toàn thế giới.</p>
          <a href="tintuc.html">Nhiều hơn</a>
        </div>
        <div class="end-rhgt">
          <img src="https://static.chotot.com/storage/chotot-kinhnghiem/c2c/2018/10/cach-cham-soc-cho-con-moi-sinh.jpg" style="transform: translateY(-20.5px);">
        </div>
      </div>
    </main>
    <footer>
      <div class="information-ct">
          <div class="footer-logo-note">
              <div class="logo-footer">
                  <a href="../Home/index.php"><img src="./Image/Logo.png"></a>
              </div>
              <div class="note">
                  <p width=10px style="overflow-y: auto;">Thú cưng của bạn đang ở trong tay tốt với đội ngũ bác sĩ thú y, chú rể và huấn 
                      luyện viên chuyên nghiệp của chúng tôi. Chúng tôi cung cấp động vật của bạn chỉ là một dịch vụ chất lượng hàng đầu.</p>
                  <ul>
                      <li class="note-list1"><a href="https://www.facebook.com/zuck"><i class="fa-brands fa-facebook-f fa-1x" style="color:#fff;" title="Follow on Facebook"></i></a></li>
                      <li class="note-list2"><a href=""><i class="fa-brands fa-instagram fa-1x" style="color:#fff;" title="Follow on Instagram"></i></i></a></li>
                      <li class="note-list3"><a href=""><i class="fa-brands fa-twitter" style="color:#fff;" title="Follow on Twitter"></i></a></li>
                      <li class="note-list4"><a href=""><i class="fa-brands fa-flickr" style="color:#07f21b;" title="Follow on Facebook"></i></a></li>
                  </ul>
              </div>
          </div>
          <div class="contact">
              <h2>Liên hệ</h2>
              <ul class="main-adr">
                  <li class="cpr-list">
                      <img src="./Image/pin.png">
                      <a href="https://goo.gl/maps/NTwx9nRC73ZsRojv5">Số 06, Trần Văn Ơn, Phú Hòa, Thủ Dầu Một, Bình Dương</a>
                  </li>
                  <li class="cpr-list">
                      <img src="./Image/phone-call.png">
                      <a href="tel:094584395">094584395</a>
                  </li>
                  <li class="cpr-list">
                      <img src="./Image/mail.png">
                      <a href="Mailto:tricker2017@fb.com">Tricker2017@fb.com</a>
                  </li>
              </ul>
          </div>
          <div class="support">
              <h2>Hỗ trợ</h2>
              <ul class="main-adr">
                  <li class="sp-list">
                      <a href="">FAQ</a>
                  </li>
                  <li class="sp-list">
                      <a href="../Home/index.php">Chăm sóc khách khàng</a>
                  </li>
                  <li class="sp-list">
                      <a href="../Home/index.php">Vận chuyển và đổi trả hàng</a>
                  </li>
                  <li class="sp-list">
                      <a href="../contact/contact.php">Liên hệ</a>
                  </li>
              </ul>
          </div>
          <div class="news">
              <h2>Tin tức</h2>
              <div class="new-content">
                  <a href="/" class="new-post new-post1">
                      <img src="./Image/pets3-1170x965.jpg">
                      <div class="post1-content">
                          <h5>Chăm sóc mắt cho chó</h5>
                          <span style="display: block;
                          background-color: var(--cl-head);
                          width:2em;
                          height:2px; margin:0.5em 0;"></span>
                          <p>Chăm sóc mắt cho chó...</p>
                      </div>
                  </a>
                  <a href="/" class="new-post new-post2">
                      <img src="./Image/parrot.jpg">
                      <div class="post2-content">
                          <h5>Chăm sóc mỏ chim...</h5>
                          <span style="display: block;
                          background-color: var(--cl-head);
                          width:2em;
                          height:2px; margin:0.5em 0;box-sizing:border-box;"></span>
                          <p>Qua nhiều năm, tôi sẽ ...</p>
                      </div>
                  </a>
              </div>
          </div>
      </div>
      <div class="copyright">
          <p style="padding: 5px 0 0 0;">Bản quyền thuộc về  d    .. Thiết kế website</p>
          <span id="oclock"></span>
      </div>  
  </footer>
    <div class="back-to-top">
      <i class="fa-solid fa-arrow-up fa-xs"></i>
    </div>
    <script src="/Js/app.js"></script>  
  </body>
</html>
