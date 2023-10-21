<?php
  foreach ($dataPengguna as $dPengguna) {
    ?>
    <tr>
      <td><?php echo $dPengguna->first_name; ?></td>
      <td><?php echo $dPengguna->nama_wilayah; ?></td>
      <td><?php echo $dPengguna->nama_kecamatan; ?></td>
      <td><?php echo $dPengguna->nama_desa; ?></td>
      <td><?php echo $dPengguna->nama_rw; ?></td>
      <td><?php echo $dPengguna->nama_rt; ?></td>
      <td><?php echo $dPengguna->phone; ?></td>
      <td class="text-center"><?php echo $dPengguna->nama_role; ?></td>
      <td class="text-center"><?php echo $dPengguna->active; ?></td>

    <?php if($this->session->userdata('id_role') == 1 ){  ?>
      <td class="text-center" style="min-width: 80px">
        <button class="btn btn-xs btn-success update-dataPengguna" data-id="<?php echo $dPengguna->id; ?>" data-toggle="tooltip" title="Update"><i class="fa fa-pencil"></i></button>
      </td>

    <?php }  ?>
    </tr>
    <?php
  }
?>