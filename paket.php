<?php
include "config/koneksi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con, "INSERT INTO paket VALUES ('$_POST[id_paket]','$_POST[nama_paket]','$_POST[harga]')");
  echo "<script>alert('Berhasil tersimpan');document.location.href='?menu=paket'</script>";
}
 // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM paket WHERE id_paket = '$_GET[id_paket]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=paket'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=paket'</script>";
            }
        }

        if(isset($_GET['view'])){
            $sql = mysqli_query($con,"SELECT * FROM paket WHERE id_paket ='$_GET[id_paket]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }

        if(isset($_GET['edit'])){
          $sql = mysqli_query($con,"SELECT * FROM paket WHERE id_paket ='$_GET[id_paket]'");
          $row_edit = mysqli_fetch_array($sql);
        }else{
          $row_edit=null;
        }

         if(isset($_POST['update'])){

             $sql = mysqli_query($con,"UPDATE paket SET id_paket = '$_POST[id_paket]', nama_paket = '$_POST[nama_paket]', harga = '$_POST[harga]' WHERE id_paket = '$_GET[id_paket]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=paket'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=paket'</script>";
            }
          }
?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">AKAJI Paket</h6>
            </div>
            <div class="card-body">
            <form method="post">
            <div class="form-group">
                <div class="row">
                    
                    <input type="text" name="nama_paket"  value="<?php echo isset($row_edit['nama_paket']) ? $row_edit['nama_paket'] : '';?>" class="form-control" placeholder="Nama Paket">
                    
                    <input type="number" name="harga"  value="<?php echo isset($row_edit['harga']) ? $row_edit['harga'] : '';?>" class="form-control" placeholder="Harga Paket">
                    
                </div>
            </div>
            
          <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=paket">Batal</a></td>
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
                      <th>Id Paket</th>
                      <th>Nama Paket</th>
                      <th>Harga Paket</th>
                      <th> </th>
                      <th> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = mysqli_query($con,"SELECT * FROM paket");
                      while ($r=mysqli_fetch_array($sql)){  
                    ?>
                    <tr>
                      <td><?php echo $r['id_paket']?></td>
                      <td><?php echo $r['nama_paket']?></td>
                      <td><?php echo $r['harga']?></td>
                      <td><a href="?menu=paket&delete&id_paket=<?php echo $r['id_paket']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a></td>
                      <td><a href="?menu=paket&edit&id_paket=<?php echo $r['id_paket']?>">EDIT</a></td>
                    </tr>
                  <?php } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>