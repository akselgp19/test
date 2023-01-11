<?php
include "config/koneksi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con, "INSERT INTO input VALUES ('$_POST[id_customer]','$_POST[nama]','$_POST[hp]','$_POST[tglpesan]','$_POST[paket]','$_POST[jumlah]','$_POST[harga]')");
  echo "<script>alert('Berhasil tersimpan');document.location.href='?menu=input'</script>";
}
 // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM input WHERE id_customer = '$_GET[id_customer]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=input'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=input'</script>";
            }
        }

        if(isset($_GET['view'])){
            $sql = mysqli_query($con,"SELECT * FROM input WHERE id_customer ='$_GET[id_customer]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }

        if(isset($_GET['edit'])){
          $sql = mysqli_query($con,"SELECT * FROM input WHERE id_customer ='$_GET[id_customer]'");
          $row_edit = mysqli_fetch_array($sql);
        }else{
          $row_edit=null;
        }

         if(isset($_POST['update'])){

             $sql = mysqli_query($con,"UPDATE input SET hp = '$_POST[hp]', tglpesan = '$_POST[tglpesan]', paket = '$_POST[paket]', jumlah= '$_POST[jumlah]', harga= '$_POST[harga]' WHERE id_customer = '$_GET[id_customer]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=input'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=input'</script>";
            }
          }

          $paket = mysqli_query($con, "SELECT * from input");
          while ($row = mysqli_fetch_array($paket)){
          $Paket[] = $row['paket'];
          $query = mysqli_query($con, "SELECT jumlah FROM input where jumlah='".$row['jumlah']."'");
          $row = $query->fetch_array();
          $Jumlah[] = $row['jumlah'];
}
?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">AKAJI form input</h6>
            </div>
            <div class="card-body">
            <form method="post">
            <div class="form-group">
                <div class="row">
                    
                    <input type="date" name="tglpesan"  value="<?php echo isset($row_edit['tglpesan']) ? $row_edit['tglpesan'] : '';?>" class="form-control" placeholder="Tanggal Pemesanan">

                    <input type="text" name="nama"  value="<?php echo isset($row_edit['nama']) ? $row_edit['nama'] : '';?>" class="form-control" placeholder="Nama">
                    
                    <input type="number" name="hp"  value="<?php echo isset($row_edit['hp']) ? $row_edit['hp'] : '';?>" class="form-control" placeholder="No Hp">
                    
                    <select name="paket" class="form-control" class="form-control form-control-md" id="" onchange='changeValueNama(this.value)' required="required">
                      <option value="" disabled="disabled" selected="selected">- Pilih Paket -</option>
                        <?php
                                $con = mysqli_connect("localhost", "root","", "uas");
                                $query=mysqli_query($con, "select * from paket order by nama_paket asc");
                                $result = mysqli_query($con, "select * from paket");
                                $jsArrayNama = "var idTipe = new Array();\n";
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option name="nama_paket"  value="' . $row['nama_paket'] . '">' . $row['nama_paket'] . '</option>';
                                $jsArrayNama .= "idTipe['" . $row['nama_paket'] . "'] = 
                                {
                                harga:'".addslashes($row['harga'])."'};\n";
                                }
                            ?>

                    </select>
                    
                    <input type="number" id="harga" name="harga"  value="<?php echo isset($row_edit['harga']) ? $row_edit['harga'] : '';?>" class="form-control" placeholder="Harga">

                    <input type="number" name="jumlah"  value="<?php echo isset($row_edit['jumlah']) ? $row_edit['jumlah'] : '';?>" class="form-control" placeholder="Jumlah">
                    
                </div>
            </div>
            
          <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=input">Batal</a></td>
            <?php
          }else{
            ?>
            <td><input type="submit" name="simpan" value="simpan"></td>
            <?php
          }
        ?>
            </form>
            <br><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>

                    <tr>
                      <th>Id Customer</th>
                      <th>Tanggal Pemesanan</th>
                      <th>Nama</th>
                      <th>No Hp</th>
                      <th>Paket</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th>Total Bayar</th>
                      <th> </th>
                      <th> </th>
                      <!-- <th> </th> -->
                    </tr>
                  </thead>
                  <div> <canvas id="myChart" height=300px width=800px></canvas> </div>
                  <tbody>
                    <?php
                      $sql = mysqli_query($con,"SELECT * FROM input");
                      while ($r=mysqli_fetch_array($sql)){  
                    ?>
                    <tr>
                      <td><?php echo $r['id_customer']?></td>
                      <td><?php echo $r['tglpesan']?></td>
                      <td><?php echo $r['nama']?></td>
                      <td><?php echo $r['hp']?></td>
                      <td><?php echo $r['paket']?></td>
                      <td><?php echo $r['jumlah']?></td>
                      <td><?php echo $r['harga']?></td>
                      <td><?php echo $r['jumlah'] * $r['harga']?></td>
                      <td><a href="?menu=input&delete&id_customer=<?php echo $r['id_customer']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a></td>
                      <td><a href="?menu=input&edit&id_customer=<?php echo $r['id_customer']?>">EDIT</a></td>
                      <!-- <td><a href="?menu=view&id_customer=<?php echo $r['id_customer']?>">VIEW</a></td> -->
                    </tr>
                  <?php } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>


<script type="text/javascript">
        <?php echo $jsArrayNama; ?>
        function changeValueNama(nama_paket){
            console.log(nama_paket);
            console.log(idTipe);   
            document.getElementById('harga').value = idTipe[nama_paket].harga;
        }
        </script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($Paket); ?>,
      datasets: [{
        label: '# of Votes',
        data: <?php echo json_encode($Jumlah); ?>,
        borderWidth: 1
      }]
    },
    options: {
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>