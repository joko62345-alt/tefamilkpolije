<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= isset($title) ? $title : 'TEFA MILK'; ?></title>

    <!-- 1. Bootstrap 5 (Framework Dasar) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- 2. Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- 3. Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">

    <!-- 4. CSS Halaman Spesifik (Dipanggil DULUAN agar bisa di-override) -->
    <?php if (isset($extra_css)): ?>
        <?php foreach ($extra_css as $css): ?>
            <link rel="stylesheet" href="<?= BASEURL; ?>/css/<?= $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- 5. Base Styles (Footer) -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/footer.css">

    <!-- 6. CSS CUSTOM (HARUS PALING AKHIR agar bisa override semua!) -->
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/navbar.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/theme.css">
</head>
<body>