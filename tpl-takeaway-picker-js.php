<?php
/**
 * Template Name: Takeaway Picker JS
 */

get_header();
?>

<style>

    .container {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
    }

    .takeaway-result {
        display: flex;
        justify-content: center;
        font-family: sans-serif;
        position: relative;
    }

    .takeaway-result h3 {
        text-align: center;
        margin: 0;
        font-size: 24px;
    }

    .takeaway-option {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 1 1 40px;
    }

    .takeaway-option label {
        padding: 1em 2em;
        border: solid 2px #555;
        border-radius: 5px;
        margin: 1em;
        width: 150px;
        max-height: 130px;
    }

    @media only screen and (min-width: 768px) {
        /* Prevent hover causing issues on mobile */
        .takeaway-option label:hover {
            cursor: pointer;
            background-color: #38afca;
            box-shadow: inset 0 0 10px -5px;
        }

    }

    .takeaway-option input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }

    .takeaway-option img {
        max-height: 70px;
    }

    .takeaway-option p {
        margin: 0.5em 0 0;
        white-space: nowrap;
    }

    .semi-active {
        background-color: #2f8fa5!important;
    }

    .active {
        background-color: #38afca;
        box-shadow: 0 0 15px -3px #338a4e;
    }

    .takeaway-form {
        text-align: center;
        font-family: sans-serif;
    }

    .takeaway-form button {
        width: 250px;
        padding: 1em;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-size: 13px;
        background-color: #53a04d;
        color: #fff;
    }

    @media only screen and (min-width: 768px) {

        .takeaway-form button:hover {
            box-shadow: inset 0 0 15px -5px #000;
        }

    }

    .img-loop {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: auto;
        height: 100px;
        box-shadow: inset 0 0 10px -5px;
        border-radius: 5px;
        padding: 1em;
        justify-content: center;
        overflow: hidden;
    }

    .img-loop img {
        margin: 1em;
        transform: translateY(-100px);
        animation: img-scroll 1s forwards;
        animation-timing-function: ease-out;
        animation-iteration-count: 5;
    }

    .winner {
        position: absolute;
        top: 13px;
    }

    .winner img {
        animation: winner-anim 1s forwards;
        animation-delay: 5s;
        animation-timing-function: cubic-bezier(0.48, 0.59, 0.48, 1.68);
        transform: scale(0);
        height: 75px;
    }

    @keyframes winner-anim {

        100% {
            transform: scale(1);
        }
    }

    @media only screen and (max-width: 768px) {
        
        .img-loop,
        .winner img {
            margin-top: 1em;
        }

    }

    @media only screen and (max-width: 500px) {
        
        .container {
            flex-direction: column-reverse;
        }

        .takeaway-option label {
            margin: 0.2em;
        }

    }


</style>

<style id="scroll-anim">

</style>

<div id="primary" class="content-area">
  <main id="main" class="site-main">

      <div class="container">

        <div class="takeaway-result">

            <div class="img-loop">

                <h3>Choose two or more takeaway options and press 'Choose my takeaway' below to start!</h3>
    
            </div>

            <div class="winner"></div>

        </div>

        <?php if ($takeaway_type = get_field('takeaway_picker')): ?>

            <form class="takeaway-form" action="">

                <div class="form-options">

                    <?php foreach ($takeaway_type as $k => $t): ?>

                        <div class="takeaway-option">
                            <input type="checkbox" name="<?= $t['takeaway_name'] ?>" id="takeaway-checkbox-<?= $t['takeaway_name'] ?>">
                            <label for="<?= $t['takeaway_name'] ?>">
                                <img class="logo" src="<?= $t['takeaway_img'] ?>"/>
                                <p><?= $t['takeaway_name'] ?></p>
                            </label>
                        </div>

                    <?php endforeach; ?>

                </div>

                <button class="takeaway-submit">Choose my takeaway</button>
            
            </form>

        <?php endif; ?>

    </div>


      <?php if ($how_it_works = get_field('how_it_works')): ?>

        <section id="how-it-works">

          <div class="container">

            <div class="row">

              <div class="col">

                <div class="hiw-write-up">

                  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#hiw-text" aria-expanded="false" aria-controls="hiw-text">
                    Click here for more information
                  </button>

                  <?php while ( have_posts() ) : the_post(); ?>

                    <div class="collapse" id="hiw-text">
                      <?php the_content(); ?>

                      <?php if ($technologies = get_field('technologies')): ?>

                        <div class="tech-heading">
                          <h2>Technologies Used:</h2>
                        </div>

                          <?php foreach ($technologies as $t): ?>

                            <div class="row justify-content-center">

                              <?php if($t['html']): ?>
                                <div class="tech-item">
                                  <span class="fab fa-html5"></span>
                                  <p>HTML</p>
                                </div>
                              <?php endif; ?>

                              <?php if($t['css']): ?>
                                <div class="tech-item">
                                  <span class="fab fa-css3-alt"></span>
                                  <p>CSS</p>
                                </div>
                              <?php endif; ?>

                              <?php if($t['javascript']): ?>
                                <div class="tech-item">
                                  <span class="fab fa-js-square"></span>
                                  <p>JavaScript/jQuery</p>
                                </div>
                              <?php endif; ?>

                              <?php if($t['php']): ?>
                                <div class="tech-item">
                                  <span class="fab fa-php"></span>
                                  <p>PHP</p>
                                </div>
                              <?php endif; ?>

                            </div>

                          <?php endforeach; ?>

                      <?php endif; ?>

                    </div>

                  <?php endwhile; wp_reset_query(); ?>

                </div>

              </div>

            </div>

          </div>

        </section>

      <?php endif; ?>

      <script>

            let takeawayOption = document.querySelectorAll('.takeaway-option'),
                checkbox = document.querySelectorAll('.takeaway-option input'),
                label = document.querySelectorAll('.takeaway-option label'),
                takeawayArray = [],
                imgArray = [],
                submitBtn = document.querySelector('.takeaway-submit'),
                form = document.querySelector('.takeaway-form'),
                moreOptionsNeeded = document.querySelector('.takeaway-result h3'),
                imgWinner = document.querySelector('.winner'),
                imgLoop = document.querySelector('.img-loop'),
                scrollAnim = document.querySelector('#scroll-anim');

            let checked = function() {
                if (!this.previousElementSibling.checked) {
                    this.previousElementSibling.checked = true;
                    takeawayArray.push(this.innerText);
                    imgArray.push(this.firstElementChild.currentSrc);
                    this.classList.add('active');
                } else {
                    this.previousElementSibling.checked = false;
                    this.classList.remove('active');
                    let textIndex = takeawayArray.indexOf(this.innerText);
                    takeawayArray.splice(textIndex, 1)
                    let imgIndex = imgArray.indexOf(this.firstElementChild.currentSrc);
                    imgArray.splice(imgIndex, 1);
                }

            }

            let bgDark = function() {
                this.classList.add('semi-active');
            }

            let bgRevert = function() {
                this.classList.remove('semi-active');
            }


            label.forEach((label) => {

                label.addEventListener('mouseup', bgRevert);
                label.addEventListener('mousedown', bgDark);
                label.addEventListener('click', checked);

            })

            let formSubmitted = (e) => {
                e.preventDefault();

                let randIndex = Math.floor(Math.random() * Math.floor(takeawayArray.length));
                imgLoop.innerHTML = '';

                if (takeawayArray.length > 1) {

                    imgArray.forEach((img) => {
                        imgLoop.innerHTML += `<img src="${img}" width="50" />`;
                    })

                    imgLoop.style.justifyContent = "flex-end";

                    scrollAnim.innerHTML = `
                    @keyframes img-scroll {

                        100% {
                            transform: translateY(${imgArray.length}00px);
                        }

                    }`;
                    

                    imgWinner.innerHTML = `<img src="${imgArray[randIndex]}" />`;
                } else {
                    imgWinner.innerHTML = '';
                    imgLoop.style.justifyContent = "center";
                    imgLoop.innerHTML = '<h3>Please select at least two options!</h3>';
                }
            }

            form.addEventListener('submit', formSubmitted)

        </script>

  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
