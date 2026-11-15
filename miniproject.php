<?php
$data = null;
$error = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");
    $nim = trim($_POST["nim"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");
    $semesterInput = $_POST["semester"] ?? "";
    $email = trim($_POST["email"] ?? "");

    if ($nama === "") $error[] = "Nama wajib diisi.";
    if ($nim === "") $error[] = "NIM wajib diisi.";
    if ($prodi === "") $error[] = "Program studi wajib diisi.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Format email tidak valid.";
    }
    if (!ctype_digit((string)$semesterInput) || (int)$semesterInput < 1 || (int)$semesterInput > 14) {
        $error[] = "Semester harus berupa angka 1-14.";
    }

    if (empty($error)) {
        $data = compact("nama", "nim", "prodi", "email");
        $data["semester"] = (int)$semesterInput;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Mini Project - Data Mahasiswa</title>
</head>
<body>
    <h2>Formulir Input Data Mahasiswa</h2>
    
    <?php if (!empty($error)): ?>
        <ul style="color: red;">
            <?php foreach ($error as $err): ?>
                <li><?php echo htmlspecialchars($err, ENT_QUOTES, "UTF-8"); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nama: <br><input type="text" name="nama" value="<?php echo htmlspecialchars($_POST['nama'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required></label><br><br>
        <label>NIM: <br><input type="text" name="nim" value="<?php echo htmlspecialchars($_POST['nim'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required></label><br><br>
        <label>Program Studi: <br><input type="text" name="prodi" value="<?php echo htmlspecialchars($_POST['prodi'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required></label><br><br>
        <label>Semester (1-14): <br><input type="number" name="semester" min="1" max="14" value="<?php echo htmlspecialchars($_POST['semester'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required></label><br><br>
        <label>Email: <br><input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required></label><br><br>
        <button type="submit">Kirim Data</button>
    </form>

    <?php if ($data): ?>
        <hr>
        <h3>Ringkasan Data Mahasiswa</h3>
        <p>Nama: <?php echo htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p>NIM: <?php echo htmlspecialchars($data['nim'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p>Program Studi: <?php echo htmlspecialchars($data['prodi'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p>Semester: <?php echo $data['semester']; ?></p>
        <p>Email: <?php echo htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
</body>
</html>