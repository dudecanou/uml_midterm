<div class="row">
    <div class="col-md-3"></div>

    <div class="col-md-6">
        <form role="form" method="post" action="#">
            <div class="form-group">
                <label for="username">ID client:</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">PASSWORD:</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>

<?php
    if(isset($_POST['submit']))
    {
        $username =     (isset($_REQUEST['username']) ? $_REQUEST['username'] : null);
        $password =     (isset($_REQUEST['password']) ? $_REQUEST['password'] : null);
        $connect=mysql_connect('localhost', 'root','') or die("Erreur de connexion a mySql");
        mysql_select_db('beausejour',$connect) or die("Erreur de connexion a bd:beausejour");
        $query = mysql_query("SELECT * FROM client WHERE client_id='$username' AND client_password='$password'");
        $affected=mysql_num_rows($query);
        $result=mysql_fetch_array($query);

        if($affected>0)
        {
            session_unset();
            $_SESSION['client_id']        = $result['client_id'];
            $_SESSION['client_prenom']    = $result['client_prenom'];
            $_SESSION['client_nom']       = $result['client_nom'];
            $_SESSION['client_email']     = $result['client_email'];
            echo
            "<div class='alert alert-success alert-dismissible' role='alert'>
                <strong>Welcome ".$_SESSION['client_prenom']."</strong>
            <p><a href='index.php?page=cart'>click here</a> to reach the cart page
            </div>";
        }
        else
        {
            echo
            "<div class='alert alert-danger alert-dismissible' role='alert'>
                <strong>No account found!</strong>
            <p>If you do not have a account, <a href='index.php?page=cart'>click here</a> to create one.
            </div>";
        }
        }
?>
