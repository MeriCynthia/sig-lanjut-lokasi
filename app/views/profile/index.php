<form action="<?= BASEURL; ?>/login" method="post">
    <button class="btn btn-pink m-2" name="logout">LOGOUT</button>
</form>

<h1 class="text-center text-pink">Selamat datang</h1>
<ul class="list-group">
    <li class="list-group-item">
        <strong>Nama:</strong> <?= $_SESSION['pengguna']['name']; ?>
    </li>
    <li class="list-group-item">
        <strong>Email:</strong> <?= $_SESSION['pengguna']['email']; ?>
    </li>
    <li class="list-group-item">
        <strong>No HP:</strong> <?= $_SESSION['pengguna']['telp']; ?>
    </li>
    <li class="list-group-item">
        <strong>PIN:</strong> <?= $_SESSION['pengguna']['pin']; ?>
    </li>
</ul>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        color: #333;
        margin: 0;
        padding: 0;
    }

    h1 {
        font-size: 2rem;
        color: #f7a9c7; /* Soft pink color */
        margin-top: 20px;
        font-weight: bold;
    }

    .text-pink {
        color: #f7a9c7;
    }

    .btn-pink {
        background-color: #f7a9c7; /* Soft pink */
        color: white;
        border-radius: 25px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
        font-weight: bold;
    }

    .btn-pink:hover {
        background-color: #f1a0c5; /* Lighter pink on hover */
    }

    .list-group-item {
        background-color: #ffffff;
        border: 1px solid #e1e1e1;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .list-group-item strong {
        color: #6f42c1; /* Soft purple */
    }

    /* Responsive styling */
    @media (max-width: 576px) {
        h1 {
            font-size: 1.5rem;
        }

        .btn-pink {
            font-size: 1rem;
            padding: 8px 16px;
        }

        .list-group-item {
            font-size: 0.9rem;
        }
    }
</style>
