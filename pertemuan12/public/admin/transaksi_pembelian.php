<?php
session_start();
require_once __DIR__ . '/../../app/classes/database.php';
require_once '../crud/admin/get_pembelian.php';
$data_pembelian = getDataPembelian();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../assets/template/spica/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/template/spica/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/template/spica/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../assets/template/spica/images/favicon.png" />
</head>
<body>
  <div class="container-scroller d-flex">
    <div class="row p-0 m-0 proBanner" id="proBanner">
      <div class="col-md-12 p-0 m-0">
        <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
          <div class="ps-lg-1">
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
              <a href="https://www.bootstrapdash.com/product/spica-admin/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <a href="https://www.bootstrapdash.com/product/spica-admin/"><i class="mdi mdi-home me-3 text-white"></i></a>
            <button id="bannerClose" class="btn border-0 p-0">
              <i class="mdi mdi-close text-white mr-0"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- partial:./partials/_sidebar.html -->
      <?php
      include('navbar.php');
      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Transaksi Pembelian (Barang Masuk)</h4>
                  <!-- <p class="card-description">
                    Horizontal form layout
                  </p> -->
                  <form class="forms-sample">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nomor Faktur Pembelian</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_faktur" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="tanggal_pembelian" class="col-sm-3 col-form-label">Tanggal pembelian</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="supplier" class="col-sm-3 col-form-label">Supplier</label>
                      <div class="col-sm-9">
                        <?php
                            require_once('../../app/classes/database.php');

                            $db = new Database();
                            $suppliers = $db->getSuppliers();
                            ?>

                            <select name="supplier" id="supplier" class="form-control">
                                <option value="">-- Pilih Supplier --</option>
                                <?php foreach($suppliers as $supplier): ?>
                                    <option value="<?php echo $supplier['id_supplier']; ?>">
                                        <?php echo $supplier['kode_supplier'] . ' - ' . $supplier['nama_supplier']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <?php
                            $db->closeConnection();
                            ?>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tabel Pembelian</h4>
                    <p class="card-description">
                        Daftar transaksi pembelian dari database
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Faktur Pembelian</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>ID Supplier</th>
                                    <th>Nama Supplier</th>
                                    <th>Total Barang</th>
                                    <th>Total Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data_pembelian)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_pembelian as $row): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($row['no_pembelian']); ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['tanggal_pembelian'])); ?></td>
                                            <td><?= htmlspecialchars($row['id_supplier']); ?></td>
                                            <td><?= htmlspecialchars($row['nama_supplier']); ?></td>
                                            <td><?= number_format($row['total_barangall'], 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($row['total_hargaall'], 2, ',', '.'); ?></td>
                                            <td>
                                                <a href="../crud/admin/detail_transaksi.php?no_pembelian=<?= urlencode($row['no_pembelian']); ?>" 
                                                   class="btn btn-sm btn-primary">
                                                    <i class="mdi mdi-information-outline"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data pembelian</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
        <footer class="footer">
          <div class="card">
            <div class="card-body">
              <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>
              </div>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="../assets/template/spica/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="../assets/template/spica/vendors/chart.js/Chart.min.js"></script>
  <script src="../assets/template/spica/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../assets/template/spica/js/off-canvas.js"></script>
  <script src="../assets/template/spica/js/hoverable-collapse.js"></script>
  <script src="../assets/template/spica/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
    <script src="../assets/template/spica/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../assets/template/spica/js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>
</html>