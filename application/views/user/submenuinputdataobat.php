<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash');     ?>"></div>
    <?php if ($this->session->flashdata('flash')) : ?>

        <!-- <div class="row mt-3">
			<div class="col-md-6">
				<div class="alert alert-primary alert-dismissible fade show" role="alert">Data Mahasiswa
					<strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div> -->
    <?php endif; ?>


    <div class="col row">
        <div class="col-lg">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <!-- untuk menampilkan swetalert harus memperhatikan file script.js dan controllers User dipesan flash data -->
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

            <div class="row">
                <!-- form pencarian dari name dan method sesuaikan dengan yang di controllers dan models. -->
                <form class="col-md-10" action="<?= base_url('user/submenuinputdataobat') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="keyword" placeholder="Masukan Kata Kunci...">
                        <span class="input-group-btn">
                            <button class="btn btn-outline-secondary" type="submit" name="submit"><i class="fa fa-search"></i> Search</button>
                        </span>
                    </div>
                </form>
                <a href="" class="btn btn-primary mb-3 col-md-1" data-toggle="modal" data-target="#newSupMenuModal"><i class="fa fa-plus"></i> Data</a>

            </div>


            <div class="table-responsive-lg">
                <table class="table">
                    <thead>
                        <tr class="bg-dark text-light">
                            <th scope="col">#</th>
                            <th scope="col">Kode Obat</th>
                            <th scope="col">Nama Obat</th>
                            <th scope="col">Jenis Obat</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Klasifikasi Obat</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Status</th>
                            <th scope="col">Persediaan</th>
                            <th scope="col">Expiret</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Harga Jual</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($subMenuInputDataObat as $User_model) : ?>
                            <tr>
                                <th scope="row"><?= ++$start; ?></th>
                                <td><?= $User_model['kode_obat']; ?></td>
                                <td><?= $User_model['nama_obat']; ?></td>
                                <td><?= $User_model['jenis_obat']; ?></td>
                                <td><?= $User_model['satuan']; ?></td>
                                <td><?= $User_model['klasifikasi_obat']; ?></td>
                                <td><?= $User_model['jumlah']; ?></td>
                                <td><?= $User_model['status']; ?></td>
                                <td><?= $User_model['persediaan']; ?></td>
                                <td><?= $User_model['expiret']; ?></td>
                                <td><?= $User_model['harga_beli']; ?></td>
                                <td><?= $User_model['harga_jual']; ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>user/ubah/<?= $User_model['id_data_obat']; ?>" class="badge bg-primary text-light" data-toggle="modal" data-target="#editmodal<?= $User_model['id_data_obat']; ?>"><i class="fa fa-edit"></i> Ubah</a>

                                    <a href="<?= base_url(); ?>user/hapus/<?= $User_model['id_data_obat']; ?>" class="badge bg-danger text-light tombol-hapus"><i class="fa fa-trash"></i>Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
                <?php if (empty($subMenuInputDataObat)) : ?>
                    <div class="alert alert-danger" role="alert">data Obat tidak ditemukan</div>
                <?php endif; ?>
            </div>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</div>

<!-- Modal Add-->
<div class="modal fade" id="newSupMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSupMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSupMenuModalLabel">Tambah Data Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/tambahdataobat'); ?>" method="post">
                <div class="modal-body">
                    <!-- <input type="hidden" name="id" name="id" value="<?= $tbl_input_data_obat['id_data_obat']; ?>"> -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="kode_obat" name="kode_obat" placeholder="Kode Obat">
                        <small class="form-text text-danger"><?= form_error('kode_obat'); ?></small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_obat" name="nama_obat" placeholder="Nama Obat">
                        <small class="form-text text-danger"><?= form_error('nama_obat'); ?></small>
                    </div>
                    <div class="input-group mb-3">
                        <label for="">Select Jenis Obat</label>
                        <select class="custom-select ml-3" id="jenis_obat" name="jenis_obat">
                            <option selected></option>
                            <option value="Obat cair">Obat cair</option>
                            <option value="Obat cair">Obat tidur</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Obat oles">Obat oles</option>
                            <option value="Suppositoria">Suppositoria</option>
                            <option value="Obat tetes">Obat tetes</option>
                            <option value="Inhaler">Inhaler</option>
                            <option value="Obat suntik">Obat suntik</option>
                            <option value="Implan atau obat tempel">Implan atau obat tempel</option>
                            <option value="Antijamur">Antijamur</option>
                            <option value="Antivirus">Antivirus</option>
                            <option value="Anticemas">Anticemas</option>
                            <option value="Antiaritmia">Antiaritmia</option>
                            <option value="Antibiotik">Antibiotik</option>
                            <option value="Antikoagulan dan trombolitik">Antikoagulan dan trombolitik</option>
                        </select>
                        <small class="form-text text-danger"><?= form_error('jenis_obat'); ?></small>
                    </div>
                    <div class="input-group mb-3">
                        <label for="">Select Satuan....</label>
                        <select class="custom-select ml-4" id="satuan" name="satuan">
                            <option selected></option>
                            <option value="pcs">pcs</option>
                            <option value="box">box</option>
                            <option value="Tablet">Tablet</option>
                            <option value="Pulvis (serbuk)">Pulvis (serbuk)</option>
                            <option value="Pulveres">Pulveres</option>
                            <option value="Pil (pilulae)">Pil (pilulae)</option>
                            <option value="Kapsul (capsule)"> Kapsul (capsule)</option>
                            <option value="Kaplet (kapsul tablet)">Kaplet (kapsul tablet)</option>
                            <option value="Larutan (solutiones)">Larutan (solutiones) </option>
                            <option value="Suspensi (suspensiones)">Suspensi (suspensiones)</option>
                            <option value="Emulsi (elmusiones)">Emulsi (elmusiones)</option>
                            <option value="Galenik">Galenik</option>
                            <option value="Ekstrak (extractum)">Ekstrak (extractum)</option>
                            <option value="Infusa">Infusa</option>
                            <option value="Imunoserum (immunosera)">Imunoserum (immunosera)</option>
                            <option value="Suppositoria">Suppositoria</option>
                            <option value="Salep (unguenta)">Salep (unguenta)</option>
                            <option value="Obat tetes (guttae)">Obat tetes (guttae)</option>
                            <option value="Injeksi (injectiones)">Injeksi (injectiones)</option>
                        </select>
                        <small class="form-text text-danger"><?= form_error('satuan'); ?></small>
                    </div>
                    <div class="input-group mb-3">
                        <label for="">Select Golongan..</label>
                        <select class="custom-select ml-3" id="klasifikasi_obat" name="klasifikasi_obat">
                            <option selected></option>
                            <option value="Obat Bebas">Obat Bebas</option>
                            <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                            <option value="Obat Keras">Obat Keras</option>
                            <option value="Obat Golongan Narkotik">Obat Golongan Narkotik</option>
                            <option value="Obat Fitofarmaka">Obat Fitofarmaka</option>
                            <option value="Obat Herbal Terstandar (OHT)">Obat Herbal Terstandar (OHT)</option>
                            <option value="Obat Herbal (Jamu)"> Obat Herbal (Jamu)</option>
                        </select>
                        <small class="form-text text-danger"><?= form_error('klasifikasi_obat'); ?></small>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah">
                        <small class="form-text text-danger"><?= form_error('jumlah'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="">Select Status</label>
                        <select class="custom-select" id="status" name="status">
                            <option selected></option>
                            <option value="Baik">Baik</option>
                            <option value="Rusak">Rusak</option>
                        </select>
                        <small class="form-text text-danger"><?= form_error('status'); ?></small>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="persediaan" name="persediaan" placeholder="Persediaan">
                        <small class="form-text text-danger"><?= form_error('persediaan'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="expiret" id="expiret">Expiret</label>
                        <input type="date" class="form-control" id="expiret" name="expiret" placeholder="Expiret">
                        <small class="form-text text-danger"><?= form_error('expiret'); ?></small>

                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="harga_beli" id="harga_beli" placeholder="Harga Beli">
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                        <small class="form-text text-danger"><?= form_error('harga_beli'); ?></small>

                    </div>
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="harga_jual" id="harga_jual" placeholder="Harga Jual">
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                        <small class="form-text text-danger"><?= form_error('harga_jual'); ?></small>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-window-close"></i> Close</button>
                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal 2 -->
<!-- Modal Edit-->

<?php $no = 0;
foreach ($subMenuInputDataObat as $User_model) : $no++; ?>
    <div class="modal fade" id="editmodal<?= $User_model['id_data_obat']; ?>" tabindex="-1" role="dialog" aria-labelledby="newSupMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSupMenuModalLabel">Ubah Data Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/ubah'); ?>" method="post">
                    <div class="modal-body">
                        <?= form_open_multipart('user/ubah'); ?>

                        <input type="hidden" name="id_data_obat" value="<?= $User_model['id_data_obat']; ?>">
                        <div class="form-group">
                            <label for="kode_obat">Kode Obat</label>
                            <input type="text" class="form-control" placeholder="Kode Obat" name="kode_obat" id="kode_obat" value="<?php echo $User_model['kode_obat']; ?>">
                            <small class="form-text text-danger"><?= form_error('kode_obat'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="nama_obat" id="nama_obat">Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" placeholder="Nama Obat" value="<?php echo $User_model['nama_obat']; ?>">
                            <small class="form-text text-danger"><?= form_error('nama_obat'); ?></small>
                        </div>
                        <div class="input-group mb-3">
                            <label for="jenis_obat" id="jenis_obat">Select Jenis Obat...</label>
                            <select class="custom-select ml-4" id="jenis_obat" name="jenis_obat">
                                <option selected><?php echo $User_model['jenis_obat']; ?></option>
                                <option value="Obat cair">Obat cair</option>
                                <option value="Obat cair">Obat tidur</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Kapsul">Kapsul</option>
                                <option value="Obat oles">Obat oles</option>
                                <option value="Suppositoria">Suppositoria</option>
                                <option value="Obat tetes">Obat tetes</option>
                                <option value="Inhaler">Inhaler</option>
                                <option value="Obat suntik">Obat suntik</option>
                                <option value="Implan atau obat tempel">Implan atau obat tempel</option>
                                <option value="Antijamur">Antijamur</option>
                                <option value="Antivirus">Antivirus</option>
                                <option value="Anticemas">Anticemas</option>
                                <option value="Antiaritmia">Antiaritmia</option>
                                <option value="Antibiotik">Antibiotik</option>
                                <option value="Antikoagulan dan trombolitik">Antikoagulan dan trombolitik</option>
                            </select>
                            <small class="form-text text-danger"><?= form_error('jenis_obat'); ?></small>
                        </div>
                        <div class="input-group mb-3">
                            <label for="satuan" id="satuan">Select Satuan Obat</label>
                            <select class="custom-select ml-4" id="satuan" name="satuan">
                                <option selected><?php echo $User_model['satuan']; ?></option>
                                <option value="pcs">pcs</option>
                                <option value="box">box</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Pulvis (serbuk)">Pulvis (serbuk)</option>
                                <option value="Pulveres">Pulveres</option>
                                <option value="Pil (pilulae)">Pil (pilulae)</option>
                                <option value="Kapsul (capsule)"> Kapsul (capsule)</option>
                                <option value="Kaplet (kapsul tablet)">Kaplet (kapsul tablet)</option>
                                <option value="Larutan (solutiones)">Larutan (solutiones) </option>
                                <option value="Suspensi (suspensiones)">Suspensi (suspensiones)</option>
                                <option value="Emulsi (elmusiones)">Emulsi (elmusiones)</option>
                                <option value="Galenik">Galenik</option>
                                <option value="Ekstrak (extractum)">Ekstrak (extractum)</option>
                                <option value="Infusa">Infusa</option>
                                <option value="Imunoserum (immunosera)">Imunoserum (immunosera)</option>
                                <option value="Suppositoria">Suppositoria</option>
                                <option value="Salep (unguenta)">Salep (unguenta)</option>
                                <option value="Obat tetes (guttae)">Obat tetes (guttae)</option>
                                <option value="Injeksi (injectiones)">Injeksi (injectiones)</option>
                            </select>
                            <small class="form-text text-danger"><?= form_error('satuan'); ?></small>
                        </div>
                        <div class="input-group mb-3">
                            <label for="klasifikasi_obat" id="klasifikasi_obat">Select Golongan Obat</label>
                            <select class="custom-select ml-2" id="klasifikasi_obat" name="klasifikasi_obat" value="<?php echo $User_model['klasifikasi_obat']; ?>">
                                <option selected><?php echo $User_model['klasifikasi_obat']; ?></option>
                                <option value="Obat Bebas">Obat Bebas</option>
                                <option value="Obat Bebas Terbatas">Obat Bebas Terbatas</option>
                                <option value="Obat Keras">Obat Keras</option>
                                <option value="Obat Golongan Narkotik">Obat Golongan Narkotik</option>
                                <option value="Obat Fitofarmaka">Obat Fitofarmaka</option>
                                <option value="Obat Herbal Terstandar (OHT)">Obat Herbal Terstandar (OHT)</option>
                                <option value="Obat Herbal (Jamu)"> Obat Herbal (Jamu)</option>
                            </select>
                            <small class="form-text text-danger"><?= form_error('klasifikasi_obat'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" id="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" value="<?php echo $User_model['jumlah']; ?>">
                            <small class="form-text text-danger"><?= form_error('jumlah'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="status" id="status">Select Status</label>
                            <select class="custom-select" id="status" name="status" value="<?php echo $User_model['status']; ?>">
                                <option selected><?php echo $User_model['status']; ?></option>
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                            <small class="form-text text-danger"><?= form_error('status'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="persediaan" id="persediaan">Persediaan</label>
                            <input type="number" class="form-control" id="persediaan" name="persediaan" placeholder="Persediaan" value="<?php echo $User_model['persediaan']; ?>">
                            <small class="form-text text-danger"><?= form_error('persediaan'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="expiret" id="expiret">Expiret</label>
                            <label for="expiret" id="expiret">Expiret</label>
                            <input type="date" class="form-control" id="expiret" name="expiret" placeholder="Expiret" value="<?php echo $User_model['expiret']; ?>">
                            <small class="form-text text-danger"><?= form_error('expiret'); ?></small>
                        </div>
                        <div class="input-group">
                            <label for="harga_beli" id="harga_beli">Harga Beli</label>
                            <div class="input-group-prepend ml-3">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="harga_beli" id="harga_beli" placeholder="Harga Beli" value="<?php echo $User_model['harga_beli']; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            <small class="form-text text-danger"><?= form_error('harga_beli'); ?></small>
                        </div>
                        <div class="input-group mt-3">
                            <label for="harga_jual" id="harga_jual">Harga Jual</label>
                            <div class="input-group-prepend ml-3">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="harga_jual" id="harga_jual" placeholder="Harga Jual" value="<?php echo $User_model['harga_jual']; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            <small class="form-text text-danger"><?= form_error('harga_jual'); ?></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-window-close"></i> Close</button>
                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>