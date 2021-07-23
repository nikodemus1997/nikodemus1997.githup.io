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

            <h4 class="alert alert-danger" role="alert">Pastikan data yang didalam inputan tidak ada yang kosong</h4>
        </div>
    </div>
    <a href="<?= base_url('user/submenuinputdataobat') ?>" class="btn btn-primary float-right mr-4">Input Ulang</a>
</div>