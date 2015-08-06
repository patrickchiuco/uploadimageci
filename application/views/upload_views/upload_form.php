<!DOCTYPE>
<html>
  <head>
    <title></title>
    <meta charset="utf-8">
  </head>
  <body>
    <main>
      <section>
        <h2>Upload Form</h2>
        <?php echo $error;?>
        <?php echo form_open_multipart('upload/upload_file');?>
          <h5>Username</h5>
          <input type="file" name="userfile" size="20"/>
          <div><input type="submit" value="Upload"/></div>
        </form>
      </section>
    </main>
  </body>
</html>
