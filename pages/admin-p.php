<div class="container my-5">
    <h3>Kategorier</h3>

    <div class="row py-3">
        <div class="col col-lg col-12 bg-white p-3 m-3">
            <h5>Tilføj kategori</h5>

            <form method="post" action="handlers/insert_p.php" enctype="multipart/form-data">
                <label for="name">Navn på kategori</label>
                <input type="text" name="p_name" class="form-control" required>
                <br><br>
                <div class="form-group">
                    <label for="img">Upload kategori foto</label><br>
                    <input type="file" id="img" name="img">
                </div>
                <br>
                <input type="submit" name="insert" class="btn btn-primary" style="width:100%" value="Tilføj">
            </form>
            <br>
            <?php echo($smi_output) ?>
        </div><!-- col -->

        <div class="col col-lg col-12 bg-white p-3 m-3">
            <h5>Tilret kategori</h5>

            <label for="name">Vælg</label>
            <select ng-model="searchPractice.practice_id" class="form-control selectpicker">
                <option value="">Alle</option>
                <?php echo $practices; ?>
            </select>
            <br><br>
            <form method="post" action="handlers/insert_p.php" enctype="multipart/form-data">
                <label for="name">Navn på kategori</label>
                <input type="text" name="p_name" class="form-control" required value="<?php echo($name) ?>">
                <br><br>
                <div class="form-group">
                    <label for="img">Upload kategori foto</label><br>
                    <input type="file" id="img" name="img">
                </div>
                <br>
                <input type="submit" name="insert" class="btn btn-primary" style="width:100%" value="Ret">
            </form>

            <br>
            <?php echo($smu_output) ?>
        </div><!-- col -->

    </div><!-- row -->
</div><!-- container -->