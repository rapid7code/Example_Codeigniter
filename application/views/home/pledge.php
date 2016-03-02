<div class="container">
  <a href="#menu" class="button--menu" title="Menu">
    <span class="button--menu__bars"></span>
  </a>
  <a href="/" class="button--logo" title="Dove">
    <img src="<?php echo base_url(); ?>public/images/dove.png" alt="Dove Logo">
  </a>

  <div class="block--landing">
    <span class="block--name"><?php echo $fullname; ?></span>
    <img src="<?php echo base_url(); ?>public/images/text-1.png" alt="Beauty House of Orchid">

    <p>Đây là đóa lan xanh mang tên bạn, hãy đón nhận<br/>lời chúc cho vẻ đẹp luôn tỏa sắc từ Dove.<br/>Điền thông tin để có cơ hội<br/>nhận vé VIP bạn nhé!</p>
  </div>

  <div class="block--pledge">
    <h2>Cảm ơn bạn đã tham gia cùng Dove để vẻ đẹp tỏa sắc.<br/>Chỉ có 200 suất vé dự sự kiện với đặc quyền VIP:</h2>
    <div class="row">
      <div class="col-one-third">
        <div class="img-wrapper">
          <img src="<?php echo base_url(); ?>public/images/img-1.png" alt="">
        </div>
        <p>Tận hưởng đặc quyền làm đẹp tại Dove Spa:<br/><strong>chăm sóc tóc, tạo kiểu nhanh hoặc nhuộm hi&#8209;light, massage tay thư&nbsp;giãn</strong></p>
      </div>
      <div class="col-one-third">
        <div class="img-wrapper">
          <img src="<?php echo base_url(); ?>public/images/img-2.png" alt="">
        </div>
        <p>Giao lưu với hoa hậu <strong>Đặng Thu Thảo, diễn viên Chi Pu, Hari Won, ca sĩ Bảo Anh</strong></p>
      </div>
      <div class="col-one-third">
        <div class="img-wrapper">
          <img src="<?php echo base_url(); ?>public/images/img-3.png" alt="">
        </div>
        <p>Có cơ hội là một trong 200 cô gái may mắn nhận một <strong>đóa lan xanh mang tên chính mình</strong></p>
      </div>
      <!-- <div class="col-one-half">
        <p>Và đừng quên nhập số điện thoại để nhận thông báo khi bạn là khách mời may mắn từ chương trình!</p>
        <div class="input-text">
          <input type="text">
        </div>
        <a href="#0" class="button-equal">XÁC NHẬN</a>
        <p>Khoe với bạn bè đóa hoa của bạn để chia sẻ cơ hội này cùng mọi người</p>
        <a href="#0" class="button-equal">CHIA SẺ NGAY</a>

      </div>
      <div class="col-one-half">
        <div class="block-img">
          <div class="img-wrapper">
            <img src="images/img-1.png" alt="">
          </div>
          <p>Được chăm sóc<br/>sắc đẹp miễn phí<br/>tại Dove Spa</p>
        </div>
        <div class="block-img">
          <div class="img-wrapper">
            <img src="images/img-2.png" alt="">
          </div>
          <p>Giao lưu với hoa hậu<br/>Đặng Thu Thảo, diễn<br/>viên Chi Pu, Hari<br/>Won, ca sĩ Bảo Anh,..</p>
        </div>
        <div class="block-img">
          <div class="img-wrapper">
            <img src="images/img-3.png" alt="">
          </div>
          <p>Nhận một đoá lan<br/>xanh mang tên<br/>chính minh.</p>
        </div>
        <div class="block-img">
          <div class="img-wrapper img-dove">
            <img src="images/dove.png" alt="">
          </div>
          <p class="blue">Hẹn gặp bạn<br/>lúc 10:00 - 22:00,<br/>ngày 05 & 06/03/2016<br/>tại Hồ Bán Nguyệt,<br/>Crescent Mall</p>
        </div>
      </div> -->
    </div>
    <div class="row mt15 mb15">
      <div class="img-dove">
        <img src="<?php echo base_url(); ?>public/images/dove.png" alt="">
      </div>
      <div class="p-dove">
        <p>Hẹn gặp bạn lúc 10:00 - 22:00,ngày 05 & 06/03/2016<br/>tại Hồ Bán Nguyệt, Crescent Mall</p>
      </div>
    </div>
    <div class="row mt15 mb15">
      <p class="p-desc">
        Hãy nhập số điện thoại di động vào ô bên dưới và chia sẻ đóa lan mang tên bạn với hashtag <span class="hashtag">#dovehoalantoasac</span>. Nếu nhận được tin nhắn mã tham dự, bạn chính là khách mời sở hữu vé VIP tham dự chương trình đấy!

      </p>
    </div>

    <div class="button-wrapper">
      <div class="row">
        <div class="col-one-half phone-text">
          <div class="input-text">
            <input type="text" name="phone" id="phone" maxlength="11" onkeypress="FUNCTION.Global.allowInputPhone(event)">
          </div>
          <a href="#0" class="button-equal update-btn phone-text" onclick="ga('send', 'event', 'Pledge page','Click','Submission Button');">XÁC NHẬN</a>
        </div>
        <div class="col-one-half">
          <a href="#0" class="button-equal share-btn" onclick="ga('send', 'event', 'Pledge page','Click','Share Button');">CHIA SẺ NGAY</a>
        </div>
      </div>
    </div>
  </div>
</div>