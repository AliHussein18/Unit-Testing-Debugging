<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>

    <?= form_open_multipart('user/upload') ?>
        <input type="file" name="avatar" required>
        <button type="submit">Upload</button>
    <?= form_close() ?>

    <hr>

    <table>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><img src="<?= base_url('uploads/' . $user['avatar']) ?>" width="100"></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?= $pager->links() ?>

</body>
</html>