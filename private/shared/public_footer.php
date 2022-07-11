<footer>
         <div class="footer-title">
           <h1 class="Marybe-blanc">MARYBÈ</h1>
         </div>

         <div class="nav-container-footer">
             <section class="heading-titles">
                 <p>SERVICES EN LIGNE</p>
                 <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Livraison</a></li>
                    <li><a href="#">Paiements</a></li>
                    <li><a href="#">Contact</a></li>
                 </ul>
             </section>



             <section class="heading-titles">
                  <p>À PROPOS</p>
                  <ul>
                    <li><a href="#">Qui-Sommes-Nous?</a></li>
                  </ul>
             </section>



             <section class="heading-titles">
                  <p>MENTIONS LÉGALES</p>
                  <ul>
                      <li><a href="#">Politique de confidentialité</a></li>
                      <li><a href="#">Politique relative aux cookies</a></li>
                      <li><a href="#">Conditions générales de vente</a></li>
                      <li><a href="#">Conditions générales d'utilisation</a></li>
                  </ul>
             </section>


         </div>

         <div class="contact-us">
             <ul>
                 <li>
                    <a href="https://www.instagram.com/marybe_paris/">
                        <img src="<?php echo url_for('images/instagram.png'); ?>">
                    </a>

                 </li>
                 <li>
                    <a href="#">
                        <img src="<?php echo url_for('images/facebook.png'); ?>">
                    </a>
                </li>
             </ul>
         </div>


     </footer>

  </body>
</html>

<?php
  db_disconnect($db);
?>
