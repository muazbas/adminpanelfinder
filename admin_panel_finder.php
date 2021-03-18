<?php
    set_time_limit(0);
?>
<html lang="en">
<head>
    <meta http-equiv="author" content="The Alchemist"/>
    <title>Admin Page Finder</title>
    <link rel="shortcut icon" href="https://png2.cleanpng.com/sh/02f0c1918ea66dfacd1a80278cdd7cce/L0KzQYm3UcMyN5R7iZH0aYP2gLBuTfFvd59AhdHAcz3sc7F1TfFvd59AhdHAcz3zfri0kPlkNWZmT6QDNULodYO4hsY6Nmo3TKsCMEmzQYa4V8Q2PGc4UKs7NkKxgLBu/kisspng-anonymous-icon-anonymous-png-pic-5a72852ee21f69.9249709015174546389262.png" type="image/png">
    <style type="text/css">
        body{
            background: #363841;
            color: #FFFFFF;
            font-family: Roboto, 'sans-serif';
        }
        table{
            width: 100%;
        }
        th{
            background: #222222;
            cursor: pointer;
        }
        tr:nth-child(even){background-color: #3B4652}
        tr:hover{background: #5E5E5E}
        td{border: 1px solid #212D39}
        .main{
            margin: 0 auto;
            width: 900px;
        }
        ._input{
            text-align: center;
        }
        .title{
            font-size: 25px;
            font-weight: bold;
            margin-bottom: -1px;
            margin-top: 25px;
        }
        ._col{color: #c0c0c0}
        .found{color: #DDFF55}
        .notfound{color: #E74B49};
        .error{
            color: #F8364C;
            font-size: 20px;
        }
    </style>
    <script>
        function SortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("_result");
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[n];
                    y = rows[i + 1].getElementsByTagName("td")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch= true;
                            break;
                        }
                    }else if(dir == "desc"){
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount ++;      
                }else{
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
    <!--
        Script Writer   : The Alchemist
        Script Source   : https://sinister.ly/Thread-The-Alchemist-s-Admin-Page-Finder-PHP
        Script Modified : Muaz Bin Abdus Sattar
    -->
</head>
<body>
    <div class="main">
        <div class="_input">
            <span class="title _col">Admin Page Finder</span>
            <form method="POST" action="<?php $PHP_SELF; ?>">
                <span class="_col">Enter Website URL : </span>
                <input type="text" name="url" placeholder="Enter Target URL Here (including http:// or https://)" style="width: 500px"> 
                <input type="submit" name="submit" value="Find Admin Page"/>
            </form><br>
        </div>
    <?php
        function xss_protect($data, $strip_tags = false, $allowed_tags = ""){
            if($strip_tags){
                $data = strip_tags($data, $allowed_tags . "<b>");
            }

            if(stripos($data, "script") !== false){
                $result = preg_replace("/script/i", "scr<b></b>ipt", htmlentities($data, ENT_QUOTES));
            }else{
                $result = htmlentities($data, ENT_QUOTES);
            }
            return $result;
        }

        function urlExist($url){
            $handle = curl_init($url);
            if ($handle === false){
                return false;
            }

            curl_setopt($handle, CURLOPT_HEADER, false);
            curl_setopt($handle, CURLOPT_FAILONERROR, true);
            curl_setopt($handle, CURLOPT_HTTPHEADER, Array(
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:85.0) Gecko/20100101 Firefox/85.0"
            )); // Request as if Firefox
            curl_setopt($handle, CURLOPT_NOBODY, true);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
            $connectable = curl_exec($handle);
            curl_close($handle);
            return $connectable;
        }
        if (isset($_POST['submit']) && isset($_POST['url'])){
            $url = htmlentities(xss_protect($_POST['url']));
            if (filter_var($url, FILTER_VALIDATE_URL)){
                $trying = array(
                    'acceso.php',
                    'account.html',
                    'account.php',
                    'adm.asp',
                    'adm.html',
                    'adm.php',
                    'adm/',
                    'adm/admloginuser.asp',
                    'adm/admloginuser.php',
                    'adm/index.asp',
                    'adm/index.html',
                    'adm/index.php',
                    'adm_auth.asp',
                    'adm_auth.php',
                    'admin.asp',
                    'admin.html',
                    'admin.php',
                    'admin/',
                    'admin/account.html',
                    'admin/account.php',
                    'admin/add_news.php',
                    'admin/add_notice.php',
                    'admin/add_product.php',
                    'admin/addnews.php',
                    'admin/addnotice.php',
                    'admin/add-notice.php',
                    'admin/addproduct.php',
                    'admin/admin.asp',
                    'admin/admin.html',
                    'admin/admin.php',
                    'admin/admin_login.asp',
                    'admin/admin_login.html',
                    'admin/admin_login.php',
                    'admin/adminLogin.asp',
                    'admin/admin-login.asp',
                    'admin/adminLogin.html',
                    'admin/admin-login.html',
                    'admin/adminLogin.php',
                    'admin/admin-login.php',
                    'admin/controlpanel.html',
                    'admin/controlpanel.php',
                    'admin/cp.html',
                    'admin/cp.php',
                    'admin/dashboard.php',
                    'admin/edit_gallery.php',
                    'admin/edit_product.php',
                    'admin/editgallery.php',
                    'admin/editproduct.php',
                    'admin/event.php',
                    'admin/gallery.php',
                    'admin/home.html',
                    'admin/home.php',
                    'admin/index.html',
                    'admin/index.php',
                    'admin/login.html',
                    'admin/login.php',
                    'admin/manage.php',
                    'admin/manage_product.php',
                    'admin/manage-product.php',
                    'admin/news.php',
                    'admin/notice.php',
                    'admin/product.php',
                    'admin/products.php',
                    'admin/profile.php',
                    'admin/upload.php',
                    'admin/user.php',
                    'admin/welcome.php',
                    'admin_area/',
                    'admin_area/admin.asp',
                    'admin_area/admin.html',
                    'admin_area/admin.php',
                    'admin_area/index.asp',
                    'admin_area/index.html',
                    'admin_area/index.php',
                    'admin_area/login.asp',
                    'admin_area/login.html',
                    'admin_area/login.php',
                    'admin_login.asp',
                    'admin_login.html',
                    'admin_login.php',
                    'admin1/',
                    'admin2.php',
                    'admin2/',
                    'admin2/index.asp',
                    'admin2/index.php',
                    'admin2/login.asp',
                    'admin2/login.php',
                    'admin3/',
                    'admin4/',
                    'admin5/',
                    'adminarea/',
                    'adminarea/admin.asp',
                    'adminarea/admin.html',
                    'adminarea/admin.php',
                    'adminarea/index.asp',
                    'adminarea/index.html',
                    'adminarea/index.php',
                    'adminarea/login.asp',
                    'adminarea/login.html',
                    'adminarea/login.php',
                    'admincontrol.html',
                    'admincontrol.php',
                    'admincontrol/login.asp',
                    'admincontrol/login.html',
                    'admincontrol/login.php',
                    'admincp/index.asp',
                    'admincp/index.html',
                    'admincp/login.asp',
                    'administrator.html',
                    'administrator.php',
                    'administrator/',
                    'administrator/',
                    'administrator/account.html',
                    'administrator/account.php',
                    'administrator/index.html',
                    'administrator/index.php',
                    'administrator/login.html',
                    'administrator/login.php',
                    'administrator/login/',
                    'administratorlogin.asp',
                    'administratorlogin.php',
                    'adminLogin.asp',
                    'admin-login.asp',
                    'adminLogin.html',
                    'admin-login.html',
                    'adminLogin.php',
                    'admin-login.php',
                    'adminLogin/',
                    'adminpanel.html',
                    'adminpanel.php',
                    'admloginuser.asp',
                    'admloginuser.php',
                    'affiliate.asp',
                    'affiliate.php',
                    'bb-admin/',
                    'bb-admin/admin.asp',
                    'bb-admin/admin.html',
                    'bb-admin/admin.php',
                    'bb-admin/index.asp',
                    'bb-admin/index.html',
                    'bb-admin/index.php',
                    'bb-admin/login.asp',
                    'bb-admin/login.html',
                    'bb-admin/login.php',
                    'controlpanel.html',
                    'controlpanel.php',
                    'cp.html',
                    'cp.php',
                    'home.asp',
                    'home.html',
                    'home.php',
                    'instadmin/',
                    'login.html',
                    'login.php',
                    'memberadmin.asp',
                    'memberadmin.php',
                    'memberadmin/',
                    'modelsearch/admin.asp',
                    'modelsearch/admin.html',
                    'modelsearch/admin.php',
                    'modelsearch/index.asp',
                    'modelsearch/index.html',
                    'modelsearch/index.php',
                    'modelsearch/login.html',
                    'modelsearch/login.php',
                    'moderator.html',
                    'moderator.php',
                    'moderator/',
                    'moderator/admin.html',
                    'moderator/admin.php',
                    'moderator/login.html',
                    'moderator/login.php',
                    'nsw/admin/login.php',
                    'pages/admin/admin-login.asp',
                    'pages/admin/admin-login.html',
                    'pages/admin/admin-login.php',
                    'panel-administracion/',
                    'panel-administracion/admin.asp',
                    'panel-administracion/admin.html',
                    'panel-administracion/admin.php',
                    'panel-administracion/index.asp',
                    'panel-administracion/index.html',
                    'panel-administracion/index.php',
                    'panel-administracion/login.asp',
                    'panel-administracion/login.html',
                    'panel-administracion/login.php',
                    'rcjakar/admin/login.php',
                    'siteadmin/index.asp',
                    'siteadmin/index.php',
                    'siteadmin/login.asp',
                    'siteadmin/login.html',
                    'siteadmin/login.php',
                    'user.asp',
                    'user.html',
                    'user.php',
                    'usuario/',
                    'usuarios/',
                    'usuarios/login.php',
                    'webadmin.html',
                    'webadmin.php',
                    'webadmin/',
                    'webadmin/admin.asp',
                    'webadmin/admin.html',
                    'webadmin/admin.php',
                    'webadmin/index.asp',
                    'webadmin/index.html',
                    'webadmin/index.php',
                    'webadmin/login.asp',
                    'webadmin/login.html',
                    'webadmin/login.php',
                    'wp-login.php'
                );

                echo "<table id='_result'><tr>
                    <th onclick='SortTable(0)'>Sl</th>
                    <th>URI</th>
                    <th onclick='SortTable(2)'>Result</th></tr>";
                $sl = 0; $found = 0;

                foreach ($trying as $sec){
                    $urll = $url . '/' . $sec;
                    if (urlExist($urll)){
                        echo '<tr class="found"><td align="center">'.($sl=$sl+1).'</td>
                        <td><a href='.$urll.' target="_blank" class="found">'.$urll.'</a></td>
                        <td align="center">Great! Match Found!!</td></tr>';
                        $found = $found + 1;
                    }else{
                        echo '<tr class="notfound"><td align="center">'.($sl=$sl+1).'</td>
                        <td>'.$urll.'</td>
                        <td align="center">Sorry! Doesn\'t Exist.</td></tr>';
                    }
                }
                echo "</table>";
                if($found < 1){
                    echo '<span class="error">Could not find any Admin Page.</span>';
                }
            }else{
                echo '<span class="error">Invalid URL Entered.</span>';
            }
        }
    ?>
    </div>
</body>
</html>