<div class="container">
    <h2>Login GIS</h2>
    <p>Masukkan data login anda:</p>
    <form action="<?=BASEURL;?>/login/verifikasi" method="post">
        <div class="form-group">
            <label for="email">Email</label><br>
            <input type="email" value="a@a.a" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="pin">PIN anda</label><br>
            <input type="text" value="123456" id="pin" name="pin" required minlength="6" maxlength="6" size="6">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>
        <button type="submit" name="login" class="btn btn-submit">Log-in</button>
    </form>
    <p>atau <a href="<?=BASEURL;?>/login/daftar">daftarkan</a> diri anda</p>
</div>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 400px;
        margin: 50px auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #f7a9c7; /* Soft pink */
        font-size: 1.8rem;
        margin-bottom: 15px;
    }

    p {
        text-align: center;
        font-size: 1rem;
        color: #555;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    label {
        display: block;
        font-size: 1rem;
        font-weight: bold;
        color: #6f42c1; /* Soft purple */
        margin-bottom: 0.5rem;
    }

    input[type="email"], input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border: 2px solid #e1e1e1;
        border-radius: 10px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    input[type="email"]:focus, input[type="text"]:focus {
        outline: none;
        border-color: #f7a9c7; /* Soft pink */
        box-shadow: 0 0 5px rgba(247, 169, 199, 0.6);
    }

    .form-check {
        font-size: 0.9rem;
    }

    .form-check input[type="checkbox"] {
        margin-right: 10px;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background-color: #f7a9c7; /* Soft pink */
        color: white;
        font-size: 1.1rem;
        font-weight: bold;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #f1a0c5; /* Lighter pink on hover */
    }

    a {
        color: #6f42c1; /* Soft purple */
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    @media (max-width: 576px) {
        .container {
            padding: 15px;
            margin-top: 30px;
        }

        h2 {
            font-size: 1.5rem;
        }

        .btn-submit {
            font-size: 1rem;
        }

        input[type="email"], input[type="text"] {
            font-size: 0.9rem;
            padding: 8px;
        }
    }
</style>
