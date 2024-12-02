<h2 class="text-center text-pink mb-4">Daftar SIG</h2>
<p class="text-center text-muted mb-4">Silahkan daftarkan diri anda:</p>

<form action="<?=BASEURL;?>/Login/daftar" method="post" enctype="multipart/form-data" class="form-container">
    <div class="form-group">
        <label for="name" class="form-label">Nama</label>
        <input type="text" id="name" name="name" value="<?= isset($_SESSION['pengguna']['name']) ? $_SESSION['pengguna']['name'] : '' ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" value="<?= isset($_SESSION['pengguna']['email']) ? $_SESSION['pengguna']['email'] : '' ?>" required class="form-control">
    </div>

    <div class="form-group">
        <label for="telp" class="form-label">Nomor HP</label>
        <div class="input-group">
            <span class="input-group-text">+62</span>
            <input type="tel" id="telp" name="telp" required value="<?= isset($_SESSION['pengguna']['telp']) ? $_SESSION['pengguna']['telp'] : '' ?>" pattern="[1-9]{10,12}" minlength="10" maxlength="12" oninput="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control">
        </div>
    </div>

    <div class="form-group">
        <label for="pin" class="form-label">PIN anda</label>
        <input type="text" id="pin" name="pin" required value="<?= isset($_SESSION['pengguna']['pin']) ? $_SESSION['pengguna']['pin'] : '' ?>" minlength="6" maxlength="6" class="form-control" size="6">
    </div>

    <div class="text-center">
        <button type="submit" name="daftar" class="btn btn-pink rounded-pill px-5 py-2 mt-3">Daftar</button>
    </div>
</form>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }

    .form-container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: 50px auto;
    }

    h2 {
        font-size: 2rem;
        color: #f7a9c7; /* Soft pink */
        font-weight: bold;
    }

    .text-pink {
        color: #f7a9c7;
    }

    .text-muted {
        color: #6c757d;
    }

    .form-label {
        font-size: 1rem;
        font-weight: bold;
        color: #6f42c1; /* Soft purple */
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 25px; /* Rounded corners for input fields */
        border: 1px solid #e1e1e1;
        padding: 12px 20px;
        font-size: 1rem;
        background-color: #fafafa;
    }

    .form-control:focus {
        border-color: #f7a9c7; /* Soft pink border on focus */
        box-shadow: 0 0 5px rgba(247, 169, 199, 0.5);
    }

    .input-group-text {
        background-color: #f7a9c7;
        color: white;
        font-weight: bold;
        border-radius: 25px 0 0 25px; /* Rounded left corner */
    }

    .btn-pink {
        background-color: #f7a9c7; /* Soft pink */
        color: white;
        font-weight: bold;
        border-radius: 25px;
        padding: 12px 30px;
        transition: background-color 0.3s ease;
    }

    .btn-pink:hover {
        background-color: #f1a0c5; /* Lighter pink on hover */
    }

    @media (max-width: 576px) {
        .form-container {
            padding: 20px;
            margin: 20px;
        }

        .form-control {
            padding: 10px;
        }

        .btn-pink {
            padding: 10px 25px;
        }

        h2 {
            font-size: 1.5rem;
        }
    }
</style>
