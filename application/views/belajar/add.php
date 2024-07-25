<div class="container">
    <div class="row mt-4">
        <div class="col">
            <?php echo $this->session->flashdata('message'); ?>
            <?php echo form_open_multipart('belajar/upload', ['id' => 'uploadForm']); ?>
                <div class="form-group">
                    <label for="creator">Select Kreator:</label>
                    <select class="form-control" id="creator" name="creator" required>
                        <option value="">Pilih Creator</option>
                        <?php foreach ($listuser as $u) { ?>
                            <option value="<?= $u->id ?>"><?= $u->first_name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="judul">Judul Pembelajaran</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Tulis Judul disini" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Tulis Deskripsi disini" required></textarea>
                </div>
                <div class="form-group">
                    <label for="thumbnail">Gambar</label>
                    <input type="file" id="thumbnail" name="thumbnail" required>
                    <p class="help-block">Hanya file gambar (jpg/jpeg/png) max 2 mb</p>
                </div>
                <div class="form-group">
                    <label for="video">Video Pembelajaran</label>
                    <div class="col-mg-9">
                        <input type="file" id="video" name="video" required>
                    </div>
                    <p class="help-block">Hanya file video (mp4) max 150 mb</p>
                </div>
                <button id="submit" class="btn btn-danger">Upload</button>
            </form>
            <div id="progressBar" style="width: 100%; background-color: #f3f3f3; margin-top: 20px;">
                <div id="progress" style="width: 0%; height: 30px; background-color: #4caf50; text-align: center; line-height: 30px; color: white;">0%</div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#uploadForm').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {
                            var percentComplete = Math.round((e.loaded / e.total) * 100);
                            $('#progress').css('width', percentComplete + '%');
                            $('#progress').text(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: '<?= site_url('belajar/upload') ?>',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Handle success response
                    alert('File uploaded successfully!');
                    location.reload();  // Reload the page or handle it as needed
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    alert('File upload failed!');
                }
            });
        });
    });
</script>
