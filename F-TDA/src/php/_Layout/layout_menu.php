<div class="navigation">
    <ul>
        <li class="lhome"><a href="home.php">Home</a></li>
        <li class="lForum"><a href="forums.php">Forum</a></li>

        <?php
            if(isset($_SESSION['namPseudo'])){
                ?>
                <li class="lMember"><a href="members.php">Membres</a></li>
                <li class="lProfile"><a href="myProfile.php">Profil</a></li>
                <li class="labout"><a href="#04">Messagerie</a></li>
                <li class="lpseudo"><a href="#06"><?php echo $_SESSION['namPseudo'] ?></a></li>
                <li class="lunconnect"><a href="logout.php">Déconnexion</a></li>
                <?php
            }else{
                ?>
                <li class="lregister"><a href="register.php">S'Enregistrer</a> </li>
                <form class="formConnection" method="post" action="loginProcess.php">
                    <li class="menuInput"><input type="text" name="userName" placeholder="Pseudo"></li>
                    <li class="menuInput" ><input type="password" name="userPassword" placeholder="Mot de passe"></li>
                    <li class="lcontact"><input type="submit"></li>
                </form>
                <?php
            }
        ?>



    </ul>
</div>