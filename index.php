<?php require_once 'Config/Conexion.php'; 
require_once 'Home/Template_shieldGuard/head.php';
?>
    <style>
        #cont_form_login {
            margin-top: 200px;
            height: 300px;
            width: 300px;
        }

        body {
            height: 100vh;
            background-position: center center;
            background-image: url("<?php echo URL ?>/Template/dist/img/logo_form_inicio_2.jpg");
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="hold-transition login-page bg-dark">
    <marquee class="mb-5" style="font-family: 'Courier New', Courier, monospace; color:orange; font-size: large;" behavior="scroll" direction="left" scrollamount="10%">
        $ sudo apt-get update && sudo apt-get upgrade -y |
        $ sudo systemctl start apache2 |
        $ nmap -sP 192.168.1.0/24 |
        $ ssh user@remote_host |
        $ sudo systemctl start mysql |
        $ sudo ufw allow 22/tcp |
        $ sudo ufw allow 80/tcp |
        $ sudo ufw enable |
        $ sudo netstat -tuln |
        $ sudo lsof -i -P -n |
        $ sudo chkrootkit |
        $ sudo rkhunter --check |
        $ sudo lynis audit system |
        $ sudo fail2ban-client status |
        $ sudo fail2ban-client start |
        $ sudo auditctl -s |
        $ sudo auditctl -l |
        $ sudo apt-get install clamav |
        $ sudo freshclam |
        $ clamscan -r / |
        $ sudo apt-get install nikto |
        $ nikto -h http://example.com |
        $ sudo apt-get install nmap |
        $ nmap -sS -p- -T4 example.com |
        $ sudo apt-get install metasploit-framework |
        $ msfconsole |
        $ search exploit |
        $ sudo apt-get install openvas |
        $ sudo gvm-setup |
        $ gvm-start |
        $ sudo apt-get install wireshark |
        $ sudo tcpdump -i eth0 |
        $ sudo apt-get install aircrack-ng |
        $ sudo airodump-ng wlan0
    </marquee>
    <?php echo(password_hash(123,PASSWORD_DEFAULT)) ?>

    <div id="cont_form_login">
        <div class="card-body">
            <form action="Home/Controller/ctrLogin.php" method="post">
                <div class="input-group mb-3">
                    <input type="email" name="email_usuario_empresa" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                
                <div class="input-group mb-3">
                    <input type="password" name="password_usuario_empresa" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
               <button style="width: 100%;" type="submit" class="btn btn-sm bg-primary">Ingresar</button>
            </form>
            <p class="mb-1 mt-2">
                <a href="forgot-password.html">Setear password</a>
            </p>
            <p class="mb-0">
                <a href="register.html" class="text-center">Crear una cuenta</a>
            </p>
        </div>
    </div>
    <div style="height: 10px; margin-top: 100px;">
        <marquee style="font-family: 'Courier New', Courier, monospace; color:orange;  font-size: large;" behavior="scroll" direction="right" scrollamount="10%">
            $ sudo apt-get update && sudo apt-get upgrade -y |
            $ sudo systemctl start apache2 |
            $ nmap -sP 192.168.1.0/24 |
            $ ssh user@remote_host |
            $ sudo systemctl start mysql |
            $ sudo ufw allow 22/tcp |
            $ sudo ufw allow 80/tcp |
            $ sudo ufw enable |
            $ sudo netstat -tuln |
            $ sudo lsof -i -P -n |
            $ sudo chkrootkit |
            $ sudo rkhunter --check |
            $ sudo lynis audit system |
            $ sudo fail2ban-client status |
            $ sudo fail2ban-client start |
            $ sudo auditctl -s |
            $ sudo auditctl -l |
            $ sudo apt-get install clamav |
            $ sudo freshclam |
            $ clamscan -r / |
            $ sudo apt-get install nikto |
            $ nikto -h http://example.com |
            $ sudo apt-get install nmap |
            $ nmap -sS -p- -T4 example.com |
            $ sudo apt-get install metasploit-framework |
            $ msfconsole |
            $ search exploit |
            $ sudo apt-get install openvas |
            $ sudo gvm-setup |
            $ gvm-start |
            $ sudo apt-get install wireshark |
            $ sudo tcpdump -i eth0 |
            $ sudo apt-get install aircrack-ng |
            $ sudo airodump-ng wlan0
        </marquee>
    </div>
<?php require_once 'Home/Template_shieldGuard/js.php';?>
</body>
</html>