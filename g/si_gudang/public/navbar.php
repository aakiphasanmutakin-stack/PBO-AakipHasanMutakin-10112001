    <?php
session_start();
?>
    
    
    <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Beranda<br></a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#features">Fitur</a></li>
          <li><a href="#services">Layanan</a></li>
          <li><a href="#team">Tim</a></li>
          <li><a href="#recent-posts">Berita</a></li>
          <li class="dropdown"><a href="#"><span>Modul</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="barang.php">Data Barang</a></li>
              <li class="dropdown"><a href="#"><span>Transaksi</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="barang-masuk.php">Barang Masuk</a></li>
                  <li><a href="barang-keluar.php">Barang Keluar</a></li>
                  <li><a href="retur.php">Retur Barang</a></li>
                  <li><a href="transfer.php">Transfer Gudang</a></li>
                  <li><a href="opname.php">Stok Opname</a></li>
                </ul>
              </li>
              <li><a href="supplier.php">Data Supplier</a></li>
              <li><a href="kategori.php">Kategori Barang</a></li>
              <li><a href="lokasi.php">Lokasi Rak</a></li>
            </ul>
          </li>
          <li class="listing-dropdown"><a href="#"><span>Laporan</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li>
                <a href="laporan-stok.php">Laporan Stok</a>
                <a href="laporan-masuk.php">Laporan Masuk</a>
                <a href="laporan-keluar.php">Laporan Keluar</a>
              </li>
              <li>
                <a href="laporan-mutasi.php">Mutasi Barang</a>
                <a href="laporan-opname.php">Hasil Opname</a>
                <a href="laporan-nilai.php">Nilai Inventaris</a>
              </li>
              <li>
                <a href="laporan-supplier.php">Per Supplier</a>
                <a href="laporan-kategori.php">Per Kategori</a>
                <a href="laporan-bulanan.php">Rekap Bulanan</a>
              </li>
              <li>
                <a href="laporan-tahunan.php">Rekap Tahunan</a>
                <a href="laporan-kritis.php">Stok Kritis</a>
                <a href="laporan-expired.php">Hampir Kadaluarsa</a>
              </li>
              <li>
                <a href="export-excel.php">Export Excel</a>
                <a href="export-pdf.php">Export PDF</a>
                <a href="grafik.php">Grafik & Analitik</a>
              </li>
            </ul>
          </li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>