<?php include 'template/header.php' ?>

<!-- Home Banner -->
    <section class="section section-search">
        <div class="container-fluid">
          <div class="banner-wrapper">
            <div class="banner-header text-center">
              <h1>Cari Tempat Karantina Covid-19</h1>
              <p>Temukan tempat serta layanan untuk isolasi mandiri selama pandemi covid-19</p>
            </div>
                         
            <!-- Search -->
            <div class="search-box">
              <form action="cari.php">
                <div class="form-group search-location">
                  <?php 
                    $lokasi = mysqli_query($koneksi, 'SELECT * FROM lokasi ORDER BY nama_lokasi ASC');
                  ?>

                  <select class="form-control" name="lokasi_id" required="">
                    <option value="all">Semua</option>
                    <?php 
                      while ($data = mysqli_fetch_array($lokasi)) { 
                        $id = isset($_GET['lokasi_id']) ? $_GET['lokasi_id'] : '';
                    ?>
                        <option <?= $data['id'] == $id ? 'selected="selected"' : '' ?> value="<?= $data['id'] ?>"><?= $data['nama_lokasi'] ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group search-info">
                  <input type="text" class="form-control" placeholder="Cari nama tempat karantina" name="nama">
                </div>
                <button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>
              </form>
            </div>
            <!-- /Search -->
            
          </div>
        </div>
      </section>
      <!-- /Home Banner -->

      
      <!-- Popular Section -->
      <section class="section section-doctor">
        <div class="container-fluid">
           <div class="row">
            <div class="col-lg-4">
              <div class="section-header ">
                <h2>Pesan Sekarang</h2>
                <p>Tempat isolasi / karantina terbaru</p>
              </div>
              <div class="about-content">      
                <a href="cari.php">Lihat Semua</a>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="doctor-slider slider">
                
                <?php 

                  $query = 'SELECT *, 
                              tempat.nama AS nama_tempat, tempat.foto AS foto_tempat,
                              tempat.id AS tempat_id

                            FROM tempat 
                            
                            JOIN kategori ON kategori.id = tempat.kategori_id
                            JOIN lokasi ON lokasi.id = tempat.lokasi_id 

                            ORDER BY tempat.id DESC LIMIT 5';

                  $tempat = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

                ?>
                <!-- Doctor Widget -->

                <?php while ($data = mysqli_fetch_array($tempat)) { ?>
                    <div class="profile-widget">
                      <div class="doc-img">
                        <a href="detail.php?id=<?= $data['tempat_id'] ?>">
                          <img class="img-fluid" alt="User Image" src="assets/foto/<?= $data['foto'] ?>">
                        </a>
                      </div>
                      <div class="pro-content">
                        <h3 class="title">
                          <a href="doctor-profile.html"><?= $data['nama_tempat'] ?></a> 
                          <i class="fas fa-check-circle verified"></i>
                        </h3>
                        <ul class="available-info mt-3">
                          <li>
                            <i class="fas fa-map-marker-alt"></i> <?= $data['nama_lokasi'] ?>
                          </li>
                          <li>
                            <i class="far fa-money-bill-alt"></i> Rp. <?= number_format($data['harga']) ?>
                          </li>
                        </ul>
                        <div class="row row-sm">
                          <div class="col-12">
                            <a href="detail.php?id=<?= $data['tempat_id'] ?>" class="btn view-btn">Lihat</a>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php } ?>
                <!-- /Doctor Widget -->
            
                
              </div>
            </div>
           </div>
        </div>
      </section>
      <!-- /Popular Section -->
       
       <!-- Availabe Features -->
       <section class="section section-features">
        <div class="container-fluid">
           <div class="row">
            <div class="col-md-5 features-img">
              <img src="assets/frontend/img/features/feature.png" class="img-fluid" alt="Feature">
            </div>
            <div class="col-md-7">
              <div class="section-header">  
                <h2 class="mt-2">Fasilitas Tempat Isolasi</h2>
                <p>Kami menyediakan fasilitas lengkap untuk kenyamanan isolasi mandiri kamu</p>
              </div>  
              <div class="features-slider slider">
                <!-- Slider Item -->
                <div class="feature-item text-center">
                  <img src="assets/frontend/img/features/feature-01.jpg" class="img-fluid" alt="Feature">
                  <p>Patient Ward</p>
                </div>
                <!-- /Slider Item -->
                
                <!-- Slider Item -->
                <div class="feature-item text-center">
                  <img src="assets/frontend/img/features/feature-02.jpg" class="img-fluid" alt="Feature">
                  <p>Test Room</p>
                </div>
                <!-- /Slider Item -->
                
                <!-- Slider Item -->
                <div class="feature-item text-center">
                  <img src="assets/frontend/img/features/feature-03.jpg" class="img-fluid" alt="Feature">
                  <p>ICU</p>
                </div>
                <!-- /Slider Item -->
                
                <!-- Slider Item -->
                <div class="feature-item text-center">
                  <img src="assets/frontend/img/features/feature-04.jpg" class="img-fluid" alt="Feature">
                  <p>Laboratory</p>
                </div>
                <!-- /Slider Item -->
                
                <!-- Slider Item -->
                <div class="feature-item text-center">
                  <img src="assets/frontend/img/features/feature-05.jpg" class="img-fluid" alt="Feature">
                  <p>Operation</p>
                </div>
                <!-- /Slider Item -->
                
                <!-- Slider Item -->
                <div class="feature-item text-center">
                  <img src="assets/frontend/img/features/feature-06.jpg" class="img-fluid" alt="Feature">
                  <p>Medical</p>
                </div>
                <!-- /Slider Item -->
              </div>
            </div>
           </div>
        </div>
      </section>    
      <!-- /Availabe Features -->
      
      </div>
     <!-- Footer -->
 

<?php include 'template/footer.php' ?>
