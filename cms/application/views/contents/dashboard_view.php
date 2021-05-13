<section class="content-header">
    <h1>
    Beranda
    <small>page</small>
    </h1>
</section>

<div class="row">
    <section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo number_format($total_product) ?></h3>

              <p>Produk</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('product') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo number_format($total_member_verified) ?></h3>

              <p>Anggota Verified</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="<?php echo base_url('member?status=VERIFIED') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo number_format($total_member_pending) ?></h3>

              <p>Anggota Pending</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="<?php echo base_url('member?status=PENDING') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo number_format($total_member_banned) ?></h3>

              <p>Anggota Banned</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="<?php echo base_url('member?status=BANNED') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </section>
</div>