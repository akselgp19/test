<div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>

                    <tr>
                      <th>Id Customer</th>
                      <th>Nama</th>
                      <th>No Hp</th>
                      <th>Tanggal Pemesanan</th>
                      <th>Paket</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th>Total Bayar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = mysqli_query($con,"SELECT * FROM input WHERE id_customer ='$_GET[id_customer]'");
                      while ($r=mysqli_fetch_array($sql)){  
                    ?>
                    <tr>
                      <td><?php echo $r['id_customer']?></td>
                      <td><?php echo $r['nama']?></td>
                      <td><?php echo $r['hp']?></td>
                      <td><?php echo $r['tglpesan']?></td>
                      <td><?php echo $r['paket']?></td>
                      <td><?php echo $r['jumlah']?></td>
                      <td><?php echo $r['harga']?></td>
                      <td><?php echo $r['jumlah'] * $r['harga']?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>