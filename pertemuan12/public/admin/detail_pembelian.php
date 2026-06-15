<?php
session_start();
require_once __DIR__ . '/../../app/classes/database.php';

// Function untuk mengambil data detail pembelian dengan JOIN
function getDetailPembelian() {
    $database = new Database();
    $conn = $database->getConnection();
    
    // Query JOIN untuk mengambil data detail pembelian beserta nama barang dan jenis
    $query = "SELECT 
                dp.no_item,
                dp.no_pembelian,
                dp.kd_barang,
                dp.kode_jenis,
                dp.jumlah_barang,
                dp.harga_barang,
                dp.total_harga,
                tb.nama_barang,
                tj.jenis
              FROM detail_pembelian dp
              LEFT JOIN tb_barang tb ON dp.kd_barang = tb.kd_barang
              LEFT JOIN tb_jenis tj ON dp.kode_jenis = tj.kode_jenis
              ORDER BY dp.no_pembelian DESC, dp.no_item ASC";
    
    $result = $conn->query($query);
    
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    $database->closeConnection();
    return $data;
}

$data_detail_pembelian = getDetailPembelian();

// Generate nomor faktur otomatis
$database = new Database();
$conn = $database->getConnection();
$query = "SELECT MAX(no_pembelian) as last_no FROM tb_pembelian";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$last_no = $row['last_no'];
if ($last_no) {
    $num = (int)substr($last_no, 4) + 1;
    $no_faktur = "FKP-" . date('Ymd') . "-" . str_pad($num, 3, '0', STR_PAD_LEFT);
} else {
    $no_faktur = "FKP-" . date('Ymd') . "-001";
}
$database->closeConnection();
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
  
  <!-- Tambahan CSS untuk modal lookup -->
  <style>
    .lookup-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }
    .lookup-modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        border-radius: 10px;
    }
    .lookup-close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    .lookup-close:hover {
        color: black;
    }
    .lookup-search {
        margin-bottom: 15px;
    }
    .lookup-table tbody tr {
        cursor: pointer;
    }
    .lookup-table tbody tr:hover {
        background-color: #f0f0f0;
    }
  </style>
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
                  <form class="forms-sample" id="formPembelian">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nomor Faktur Pembelian</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_faktur" name="no_faktur" value="<?= $no_faktur ?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="tanggal_pembelian" class="col-sm-3 col-form-label">Tanggal pembelian</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="<?= date('Y-m-d') ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="supplier" class="col-sm-3 col-form-label">Supplier</label>
                      <div class="col-sm-9">
                        <?php
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
                    
                    <hr>
                    <h5 class="mb-3">Detail Barang</h5>
                    
                    <div class="form-group row">
                      <label for="kd_barang" class="col-sm-3 col-form-label">Kode Barang</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" readonly placeholder="Pilih barang...">
                      </div>
                      <div class="col-sm-2">
                        <button type="button" class="btn btn-primary btn-sm" id="btnLookup" onclick="openLookupModal()">
                          <i class="mdi mdi-magnify"></i> Cari
                        </button>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="kode_jenis" class="col-sm-3 col-form-label">Kode Jenis Barang</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_jenis" name="kode_jenis" readonly>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="jumlah_barang" class="col-sm-3 col-form-label">Jumlah Barang</label>
                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="1" min="1" onchange="hitungTotal()">
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="stok_saat_ini" class="col-sm-3 col-form-label">Stok Saat Ini</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="stok_saat_ini" name="stok_saat_ini" readonly>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="harga_barang" class="col-sm-3 col-form-label">Harga Barang (Satuan)</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="harga_barang" name="harga_barang" readonly>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label for="total_harga" class="col-sm-3 col-form-label">Total Harga</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="total_harga" name="total_harga" readonly>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button type="button" class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
            
            <!-- Lookup Modal -->
            <div id="lookupModal" class="lookup-modal">
              <div class="lookup-modal-content">
                <span class="lookup-close" onclick="closeLookupModal()">&times;</span>
                <h4 class="mb-3">Pilih Barang</h4>
                <div class="lookup-search">
                  <input type="text" class="form-control" id="searchBarang" placeholder="Cari kode atau nama barang..." onkeyup="filterBarang()">
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                  <table class="table table-hover lookup-table">
                    <thead>
                      <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Stok</th>
                        <th>Harga</th>
                      </tr>
                    </thead>
                    <tbody id="lookupTableBody">
                      <!-- Data akan diisi via JavaScript dari database -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <!-- TABEL DETAIL PEMBELIAN -->
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tabel Detail Pembelian</h4>
                    <p class="card-description">
                        Daftar detail transaksi pembelian dari database
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Faktur Pembelian</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Jenis</th>
                                    <th>Jenis</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Total Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($data_detail_pembelian)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_detail_pembelian as $row): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($row['no_pembelian']); ?></td>
                                            <td><?= htmlspecialchars($row['kd_barang']); ?></td>
                                            <td><?= htmlspecialchars($row['nama_barang'] ?? '-'); ?></td>
                                            <td><?= htmlspecialchars($row['kode_jenis']); ?></td>
                                            <td><?= htmlspecialchars($row['jenis'] ?? '-'); ?></td>
                                            <td><?= number_format($row['jumlah_barang'], 0, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($row['harga_barang'], 2, ',', '.'); ?></td>
                                            <td>Rp <?= number_format($row['total_harga'], 2, ',', '.'); ?></td>
                                            <td>
                                                <a href="edit_detail.php?no_item=<?= urlencode($row['no_item']); ?>" 
                                                   class="btn btn-sm btn-warning">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a href="hapus_detail.php?no_item=<?= urlencode($row['no_item']); ?>" 
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="10" class="text-center">Tidak ada data detail pembelian</td>
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
  
  <!-- Script untuk lookup dan kalkulasi -->
  <script>
    // Data barang dari database
    let dataBarang = [];
    
    // Ambil data barang dari server
    function loadDataBarang() {
        fetch('../crud/admin/get_barang.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Server error:', data.error);
                    alert('Gagal memuat data barang: ' + data.error);
                    return;
                }
                dataBarang = data;
                renderLookupTable(dataBarang);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat data barang. Periksa koneksi database.');
            });
    }
    
    // Render tabel lookup
    function renderLookupTable(data) {
        const tbody = document.getElementById('lookupTableBody');
        if (!data || data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center">Tidak ada data barang</td></tr>';
            return;
        }
        
        tbody.innerHTML = '';
        data.forEach(item => {
            const tr = document.createElement('tr');
            tr.onclick = function() { pilihBarang(item); };
            tr.innerHTML = `
                <td>${item.kd_barang}</td>
                <td>${item.nama_barang}</td>
                <td>${item.jenis || '-'}</td>
                <td>${item.stok}</td>
                <td>Rp ${Number(item.harga).toLocaleString('id-ID')}</td>
            `;
            tbody.appendChild(tr);
        });
    }
    
    // Filter barang di lookup
    function filterBarang() {
        const keyword = document.getElementById('searchBarang').value.toLowerCase();
        const filtered = dataBarang.filter(item => 
            item.kd_barang.toLowerCase().includes(keyword) || 
            item.nama_barang.toLowerCase().includes(keyword) ||
            (item.jenis && item.jenis.toLowerCase().includes(keyword))
        );
        renderLookupTable(filtered);
    }
    
    // Pilih barang dari lookup
    function pilihBarang(item) {
        document.getElementById('kd_barang').value = item.kd_barang;
        document.getElementById('nama_barang').value = item.nama_barang;
        document.getElementById('kode_jenis').value = item.kode_jenis;
        document.getElementById('stok_saat_ini').value = item.stok;
        document.getElementById('harga_barang').value = 'Rp ' + Number(item.harga).toLocaleString('id-ID');
        document.getElementById('harga_barang').dataset.harga = item.harga;
        closeLookupModal();
        hitungTotal();
    }
    
    // Hitung total harga
    function hitungTotal() {
        const kodeBarang = document.getElementById('kd_barang').value;
        const jumlah = parseInt(document.getElementById('jumlah_barang').value) || 1;
        
        if (kodeBarang && dataBarang.length > 0) {
            const barang = dataBarang.find(item => item.kd_barang === kodeBarang);
            if (barang) {
                const total = barang.harga * jumlah;
                document.getElementById('total_harga').value = 'Rp ' + total.toLocaleString('id-ID');
                document.getElementById('total_harga').dataset.total = total;
            }
        } else {
            document.getElementById('total_harga').value = '';
        }
    }
    
    // Buka modal lookup
    function openLookupModal() {
        document.getElementById('lookupModal').style.display = 'block';
        document.getElementById('searchBarang').value = '';
        if (dataBarang.length === 0) {
            loadDataBarang();
        } else {
            renderLookupTable(dataBarang);
        }
    }
    
    // Tutup modal lookup
    function closeLookupModal() {
        document.getElementById('lookupModal').style.display = 'none';
    }
    
    // Tutup modal saat klik di luar
    window.onclick = function(event) {
        const modal = document.getElementById('lookupModal');
        if (event.target == modal) {
            closeLookupModal();
        }
    }
    
    // Tutup modal dengan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLookupModal();
        }
    });
    
    // Load data saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        loadDataBarang();
        // Set tanggal default ke hari ini
        document.getElementById('tanggal_pembelian').value = new Date().toISOString().split('T')[0];
    });
  </script>
</body>
</html>