<?php setlocale(LC_TIME, 'fr_FR.utf8', 'fra'); ?>
<div id="contentAll">
  <script>
  
    var events = [ <?php echo $all_date_calendar ?>
    ]; 

    /* var joursEvenement = <?php echo '[';
if (isset($all_date_calendar))
  echo $all_date_calendar; echo "]"
?> ;*/
  </script>

  <div id="breadcrumbs">
    <ul>
      <li><a href="#" title="#">Accueil</a></li>
    </ul>
  </div>

<?php if (isset($notification) && $notification != ''): ?>
    <div id="message-notification">
      <div class="ico-msg"></div>
      <p><?php print $notification ?></p>
    </div>
<?php endif; ?>

  <div id="coverflowContainer">
    <div id="coverflowRuban"></div>
    <div id="coverflow">
      <?php foreach ($coverflow_covers as $coverflow_cover): ?>
        <?php if (!empty($coverflow_cover)): ?>
          <?php // print_r($coverflow_cover); ?>
          <a href="<?php print site_url('home/' . $coverflow_cover[0]->idU); ?>"><img class="coverflow-img" src="<?php print $thumb = (!empty($coverflow_cover[0]->thumbU)) ? files('profiles/' . $coverflow_cover[0]->thumbU) : img_url('sidebar-right/default-photo-profil.png'); ?>"><span class="coverflow_artist"><?php print $coverflow_cover[0]->loginU; ?></span></a>
  <?php endif; ?>
<?php endforeach; ?>


<!--      <a href="#"><img class="coverflow-img" src="<?php echo img_url('portail/bh.png') ?>"><span class="coverflow_artist">Name Artist 1</span></a>
<a href="#" class="coverflow-img2"><img class="coverflow-img2" src="<?php echo img_url('portail/bandone.png') ?>"><span class="coverflow_artist">Name Artist 2</span></a>
<a href="#"><img class="coverflow-img" src="<?php echo img_url('portail/foals.png') ?>"><span class="coverflow_artist">Name Artist 3</span></a>
<a href="#" class="coverflow-img2"><img class="coverflow-img2" src="<?php echo img_url('portail/bh.png') ?>"><span class="coverflow_artist">Name Artist 4</span></a>
<a href="#"><img class="coverflow-img2" src="<?php echo img_url('portail/bandone.png') ?>"><span class="coverflow_artist">Name Artist 5</span></a>-->
    </div>
    <div id="paginationContainer">
      <div id="pagination-prev"></div>
      <div id="pagination"></div>
      <div id="pagination-next"></div>
    </div>
  </div>

  <div id="first-line">
    <div id="first-line-top-song">
      <div id="top-song-title">
        <span class="title-img"><img src="<?php echo img_url('portail/etoile.png') ?>"></span>
        <span class="title-color">Top 10</span> des écoutes
      </div>

      <div id="top-song-play-one">
        <div class="tab-top-song-line-white">
          <div class="tab-top-song-col-one">
            <div class="tab-top-song-col-number">1</div>
            <div class="tab-top-song-col-texte">
              <div class="tab-top-song-col-texte-img"><img  src="<?php echo img_url('sidebar-right/lecture.png'); ?>"></div>  				
              <div class="tab-top-song-col-texte-titre">
                Blowin The Wind</br>
                <span class="tab-top-song-col-texte-artiste">Bob Dylan
              </div>
            </div>
          </div>
        </div>

        <div class="tab-top-song-line-grey">
          <div class="tab-top-song-col-one">
            <div class="tab-top-song-col-number">2</div>
            <div class="tab-top-song-col-texte">
              <div class="tab-top-song-col-texte-img"><img  src="<?php echo img_url('sidebar-right/lecture.png'); ?>"></div>  				
              <div class="tab-top-song-col-texte-titre">
                Blowin The Wind</br>
                <span class="tab-top-song-col-texte-artiste">Bob Dylan
              </div>
            </div>
          </div>
        </div>

        <div class="tab-top-song-line-white">
          <div class="tab-top-song-col-one">
            <div class="tab-top-song-col-number">3</div>
            <div class="tab-top-song-col-texte">
              <div class="tab-top-song-col-texte-img"><img  src="<?php echo img_url('sidebar-right/lecture.png'); ?>"></div>  				
              <div class="tab-top-song-col-texte-titre">
                Blowin The Wind</br>
                <span class="tab-top-song-col-texte-artiste">Bob Dylan
              </div>
            </div>
          </div>
        </div>

        <div class="tab-top-song-line-grey">
          <div class="tab-top-song-col-one">
            <div class="tab-top-song-col-number">4</div>
            <div class="tab-top-song-col-texte">
              <div class="tab-top-song-col-texte-img"><img  src="<?php echo img_url('sidebar-right/lecture.png'); ?>"></div>  				
              <div class="tab-top-song-col-texte-titre">
                Blowin The Wind</br>
                <span class="tab-top-song-col-texte-artiste">Bob Dylan
              </div>
            </div>
          </div>
        </div>

        <div class="tab-top-song-line-white">
          <div class="tab-top-song-col-one">
            <div class="tab-top-song-col-number">5</div>
            <div class="tab-top-song-col-texte">
              <div class="tab-top-song-col-texte-img"><img  src="<?php echo img_url('sidebar-right/lecture.png'); ?>"></div>  				
              <div class="tab-top-song-col-texte-titre">
                Blowin The Wind</br>
                <span class="tab-top-song-col-texte-artiste">Bob Dylan
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="top-song-play-two">
        <div class="tab-top-song-line-white">
          <div class="tab-top-song-col-one">
            <div class="tab-top-song-col-number">6</div>
            <div class="tab-top-song-col-texte">
              <div class="tab-top-song-col-texte-img"><img  src="<?php echo img_url('sidebar-right/lecture.png'); ?>"></div>  				
              <div class="tab-top-song-col-texte-titre">
                Blowin The Wind</br>
                <span class="tab-top-song-col-texte-artiste">Bob Dylan
              </div>
            </div>
          </div>
        </div>

        <div class="tab-top-song-line-grey">
          <div class="tab-top-song-col-one">
            <div class="tab-top-song-col-number">7</div>
            <div class="tab-top-song-col-texte">
              <div class="tab-top-song-col-texte-img"><img  src="<?php echo img_url('sidebar-right/lecture.png'); ?>"></div>  				
              <div class="tab-top-song-col-texte-titre">
                Blowin The Wind</br>
                <span class="tab-top-song-col-texte-artiste">Bob Dylan
              </div>
            </div>
          </div>
        </div>

        <div class="tab-top-song-line-white">
          <div class="tab-top-song-col-one">
            <div class="tab-top-song-col-number">8</div>
            <div class="tab-top-song-col-texte">
              <div class="tab-top-song-col-texte-img"><img  src="<?php echo img_url('sidebar-right/lecture.png'); ?>"></div>  				
              <div class="tab-top-song-col-texte-titre">
                Blowin The Wind</br>
                <span class="tab-top-song-col-texte-artiste">Bob Dylan
              </div>
            </div>
          </div>
        </div>

        <div class="tab-top-song-line-grey">
          <div class="tab-top-song-col-one">
            <div class="tab-top-song-col-number">9</div>
            <div class="tab-top-song-col-texte">
              <div class="tab-top-song-col-texte-img"><img  src="<?php echo img_url('sidebar-right/lecture.png'); ?>"></div>  				
              <div class="tab-top-song-col-texte-titre">
                Blowin The Wind</br>
                <span class="tab-top-song-col-texte-artiste">Bob Dylan
              </div>
            </div>
          </div>
        </div>

        <div class="tab-top-song-line-white">
          <div class="tab-top-song-col-one">
            <div class="tab-top-song-col-number">10</div>
            <div class="tab-top-song-col-texte">
              <div class="tab-top-song-col-texte-img"><img  src="<?php echo img_url('sidebar-right/lecture.png'); ?>"></div>  				
              <div class="tab-top-song-col-texte-titre">
                Blowin The Wind</br>
                <span class="tab-top-song-col-texte-artiste">Bob Dylan
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="first-line-calendar">
        <div id="calendar-title">
          <span class="title-img"><img src="<?php echo img_url('portail/etoile.png') ?>"></span>
          L'agenda <span class="title-color"> concert</span>
        </div>

        <div id="calendar-content">
          <div id="calendar_alert">

          </div>
          <div id="datepicker"></div>

        </div>
      </div>

      <div id="first-line-newbies">
        <div id="newbies-title">
          <span class="title-img"><img src="<?php echo img_url('portail/etoile.png') ?>"></span>
          Les <span class="title-color">newbies</span>
        </div>

        <div id="newbies-content">
          <?php foreach ($newbies as $newbie): ?>
  <?php // print_r($newbie);
  ?>
            <div class="newbies-peoples">
              <p class="newbies-picture">
                <a href="<?php print site_url('actualite/' . $newbie->id); ?>">
                  <img src="<?php print $thumb = (!empty($newbie->thumb)) ? files('profiles/' . $newbie->thumb) : img_url('sidebar-right/defaultphoto-profil.png'); ?>" height="38px" alt="Photo Profil" />
                </a>
              </p>
              <div class="newbies-people">
                <a href="<?php print site_url('actualite/' . $newbie->id); ?>">
  <?php print $newbie->login; ?>
                </a>
                </br>
                <span class="newbies-people-type"><?php print $type = ($newbie->type == 1) ? 'Musicien' : 'Mélomane'; ?></span>
              </div>
            </div>
<?php endforeach; ?>

          <!--            <div class="newbies-peoples">
                          <p class="newbies-picture"><img src="<?php echo img_url('sidebar-left/photo-profil.png') ?>" height="38px" alt="Photo Profil" /></p>
                          <div class="newbies-people">
                              Skip the Use</br>
                              <span class="newbies-people-type">Musicien</span>
                          </div>
                      </div>
          
                      <div class="newbies-peoples">
                          <p class="newbies-picture"><img src="<?php echo img_url('sidebar-left/photo-profil.png') ?>"  height="38px" alt="Photo Profil" /></p>
                          <div class="newbies-people">
                              Yannis P</br>
                              <span class="newbies-people-type">Mélomane</span>
                          </div>
                      </div>
          
                      <div class="newbies-peoples">
                          <p class="newbies-picture"><img src="<?php echo img_url('sidebar-left/photo-profil.png') ?>"  height="38px" alt="Photo Profil" /></p>
                          <div class="newbies-people">
                              Alison Mosshart</br>
                              <span class="newbies-people-type">Mélomane</span>
                          </div>
                      </div>
          
                    <div class="newbies-peoples">
                        <p class="newbies-picture"><img src="<?php echo img_url('sidebar-left/photo-profil.png') ?>"  height="38px" alt="Photo Profil" /></p>
                        <div class="newbies-people">
                            Jack White</br>
                            <span class="newbies-people-type">Musicien</span>
                        </div>
                    </div>-->
        </div>
      </div>
    </div>


    <div id="wall-flux">
          <?php foreach ($articles as $article): ?>
        <div class="wall-flux-content" >
          <p class="wall-flux-content-title">
  <?php print $article->titre; ?>
          </p>

          <p class="wall-flux-content-subtitle">
            Publié par Slyset, le <?php echo strftime("%A %d %B %Y à %Hh%M ", strtotime($article->updated)); ?>
          </p>

          <div class="wall-flux-content-text">
        <?php print $article->article; ?>
          </div>
        </div>
<?php endforeach; ?>






      <div class="wall-flux-content" >
        <p class="wall-flux-content-title">Le rock de Foals investit l’Hôtel de Ville de Paris
        </p>

        <p class="wall-flux-content-subtitle"> Publié par Yves, le 20 Septembre 2013
        </p>

        <img class="img-blog" src="<?php echo img_url('portail/foals-blog.png') ?>">

        <p class = "wall-flux-content-text"><span class="wall-flux-content-text-chapeau">Dans une vidéo filmée par le blog parisien La Blogothèque, le groupe de rock anglais Foals investit la bibliothèque de l’Hôtel de Ville et joue (fort) deux morceaux de son nouvel album. Une drôle d'expérience à découvrir en vidéo sur Paris.fr.</span>

        <p class = "wall-flux-content-text">Les couloirs de l’Hôtel de Ville ont davantage l’habitude d‘entendre résonner le pas pressé des élus du conseil de Paris ou ceux du personnel des cabinets des adjoints au Maire. Ce samedi 20 septembre pourtant, c’est une toute autre ambiance sonore qui a fait vibrer l’enceinte majestueuse du lieu.</p>

        <p class = "wall-flux-content-text">Au programme ce jour-là, la réalisation du premier épisode de la série « Empty Space » réalisée par la Blogothèque, ce blog parisien qui fait la pluie et le beau temps chez les amateurs de rock, ici comme de l’autre côté de l’Atlantique. Déjà connu pour ses « Concerts à emporter », des vidéos de concerts « unplugged » tourné à l’arrache dans les rues de la capitale, la Blogothèque passe ce jour-ci à la vitesse supérieure avec ce nouveau programme.</p>
        <p/>

        <p class = "wall-flux-content-text">Partager cet article</p>
      </div>

      <div class="wall-flux-content">
        <p class="wall-flux-content-titre-artiste">Bob Dylan a ajouté une photo à <span class="title-color-bold">son album “Good old times”</span>
        </p>

        <img class="img-blog-artiste" src="<?php echo img_url('portail/bobd.png') ?>">
      </div>

      <div class="wall-flux-content">
        <div class="wall-flux-content-left-picture">
          <img class="img-blog-artiste-carre" src="<?php echo img_url('portail/grandville.png') ?>">
        </div>

        <div class="wall-flux-content-right-text">
          <p class="wall-flux-content-title">Les internautes ont aimé...</p>
          <p class="wall-flux-content-subtitle">Granville - Jersey</p>
          <p class="wall-flux-content-text">Granville, groupe de pop naïve en français basé à Caen, chante une adolescence tantôt sauvage et souvent rêveuse. Rappelant aussi bien le yéyé français des années soixante (France Gall, Françoise Hardy…) que la pop garage américaine (Best Coast, Tennis..).
          </p>
          <p class="wall-flux-content-goto-profile">L’espace de Granville &rarr;</p>
        </div>
      </div>

      <div class="wall-flux-content">
        <div class="wall-flux-content-left-picture">
          <img class="img-blog-artiste-carre" src="<?php echo img_url('portail/bob-carre.png') ?>">

        </div>
        <div class="wall-flux-content-right-text">
          <p class="wall-flux-content-title">L’évènement à ne pas rater</p>
          <p class="wall-flux-content-subtitle">Bob Dylan à l’Aéronef, le 28/11/2013</p>
          <p class="wall-flux-content-text">Chaque année depuis trois ans, Lille Métropole organise une course sur le Grand Boulevard, suivie d’un concert gratuit en plein air. Cette fois, l’Aéronef, le Grand Mix et La Cave aux Poètes ont conjointement pensé la programmation du plateau Place Mitterrand.
          </p>
          <p class="wall-flux-content-goto-profile">Voir le concert &rarr;</p>
        </div>
      </div>

    </div>
    <div class="pagination">
      <a href="#" id="precedent"><span><</span></a>
      <a href="#" class="page">1</a>
      <a href="#" class="page">2</a>
      <a href="#" class="page">3</a>
      <a href="#" class="page">4</a>
      <a href="#" class="page">5</a>
      <a href="#" id="suivant"><span>></span></a>
    </div>

  </div>
</div>