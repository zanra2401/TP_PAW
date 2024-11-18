    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <label for="surename">Surename</label>
        <input type="text" name="surename" id="surename" value="<?= (isset($_POST['surename'])) ? $_POST['surename'] : ''; ?>">
        <label for="email">EMAIL</label>
        <input type="email" name="email" id="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : ''; ?>">
        <label for="password">PASSWORD</label>
        <input type="password" name="password" id="password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : ''; ?>">
        <label for="street_address">STREET ADDRESS</label>
        <textarea name="street_address" id="street_address"><?= (isset($_POST['street_address'])) ? $_POST['street_address'] : ''; ?></textarea>
        <label for="state">STATE</label>
        <select name="state" id="state" >
            <option value="jawa-timur" selected="<?= (isset($_POST['state']) and $_POST['state'] == 'jawa-timur') ? 'selected' : ''; ?>">Jawa Timur</option>
            <option value="jawa-barat" selected="<?= (isset($_POST['state']) and $_POST['state'] == 'jawa-barat') ? 'selected' : ''; ?>">Jawa Barat</option>
            <option value="sumatera-barat" selected="<?= (isset($_POST['state']) and $_POST['state'] == 'sumatera-barat') ? 'selected' : ''; ?>">Sumatera Barat</option>
            <option value="kalimantan-barat" selected="<?= (isset($_POST['state']) and $_POST['state'] == 'kalimantan-barat') ? 'selected' : ''; ?>">Kalimantan Barat</option>
        </select>
        <input type="text" value="Indonesia" hidden>
        <div style="margin-top: 10px; margin-bottom: 10px;">
            <label>Jenis Kelamin</label> <br>
            <input type="radio" name="gender" id="laki-laki" value="laki-laki" <?= (isset($_POST['gender']) and $_POST['gender'] == 'laki-laki') ? 'checked' : ''; ?>>
            <label for="laki-laki" style="font-weight: 200;">Laki Laki</label>
            <input type="radio" id="perempuan" name="gender" value="perempuan" <?= (isset($_POST['gender']) and $_POST['gender'] == 'perempuan') ? 'cheked' : '' ?>>
            <label for="perempuan" style="font-weight: 200;">Perempuan</label><br>
            <label>Hobi </label> <br>
            <input type="checkbox" name="hobi[]" id="berenang" value="berenang" <?= ((isset($_POST['hobi']) and $_POST['hobi'] != null and in_array('berenang', $_POST['hobi'])) or !isset($_POST['submit'])) ? 'checked' : ''; ?>>
            <label for="berenang" style="font-weight: 200;">Berenang</label> <br>
            <input type="checkbox" id="berlari" name="hobi[]" style="align-self: self-start;" value="berlari" <?= (isset($_POST['hobi']) and $_POST['hobi'] != null and in_array('berlari', $_POST['hobi'])) ? 'checked' : ''; ?>>
            <label for="berlari" style="font-weight: 200;">Berlari</label>
        </div>
        <input type="submit" name="submit" value="SUBMIT" style="background-color: blueviolet; color: white; padding: 10px; border: none; border-radius: 4px;">
    </form>