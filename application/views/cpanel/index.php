<?php
include APPPATH.'views/cpanel/header.php';
?>

  <div id="Home">
    <h3>Member List</h3>
    <div class="message" style="color: #ff0000; padding: 5px; font-size: 14px;">
      <span><?php echo $this->session->flashdata('message');?></span>
    </div>
    <form method="post" action="<?php echo base_url() . 'cpanel'; ?>">
    <div class="button">
      <input class="export" value="Export" type="submit" name="export">
      <?php if($draw_status == 0) : ?>
      <input class="draw" value="Draw" type="submit" name="draw">
      <?php else : ?>
        <input class="export" value="Export Winner" type="submit" name="draw_winner">
        <input class="export" value="Reset Winner(For Testing)" type="submit" name="reset" style="float: right;">
      <?php endif; ?>
    </div>
    </form>
    <?php echo $table; ?>
    <div id="pagination">
      <ul class="tsc_pagination">
      <?php foreach ($pagnation as $link) {
        echo "<li>". $link."</li>";
      } ?>
      </ul>
    </div>
  </div>
<?php
include APPPATH.'views/cpanel/footer.php';
?>