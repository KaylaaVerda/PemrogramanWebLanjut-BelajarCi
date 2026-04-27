<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-12">
        <h2 class="mb-4">Profil Pengguna</h2>
        <ul>
            <li><strong>Username:</strong> <?= session()->get('username') ?></li>
            <li><strong>Role:</strong> <?= session()->get('role') ?></li>
            <li><strong>Email:</strong> <?= session()->get('email') ?></li>
            <li><strong>Waktu Login:</strong> <?= session()->get('waktu_login') ?></li>
            <li><strong>Status Login:</strong> <?= session()->get('isLoggedIn') ? 'Sudah Login' : 'Belum Login' ?></li>
        </ul>
    </div>
</div>

<?= $this->endSection() ?>
