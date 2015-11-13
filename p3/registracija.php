<?php include "head.php"; ?>

    <body class="bodyIndex">
        <div class="container">
            <div class="rowIndex">
                <div class="col-md-6">

<?php include "facebook_login_graph_api/facebookRegistracija.php"; ?>
<a href="https://www.facebook.com/dialog/oauth?client_id=<?php echo $config['App_ID']; ?>&redirect_uri=<?php echo $config['callback_url']; ?>&scope=email">Sign up using Facebook</a>
 <p>
<p><?php if(isset($_GET['fbTrue']))
{
  echo "Uspješno ste se registrirali.";
  } ?></p>
<?php include "scripts.php" ?>
        <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>

    </body>

</html>
