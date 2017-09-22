<?php
    require_once __DIR__.'/_backend/preload.php';

    $page['description'] = 'One elementary, different apps.';
    $page['title'] = 'Projects &sdot; elementary';

    $page['styles'] = array(
        'styles/projects.css'
    );

    include $template['header'];
    include $template['alert'];

    const STORE_FILE = __DIR__.'/data/projects.json';

    $fileContent = json_decode(file_get_contents(STORE_FILE), true);
?>

<section class="grid">
    <div class="two-thirds">
        <h2>Applications</h2>
    </div>
    <div class="whole">
        <div class="projects">

            <?php
                foreach( $fileContent['applications'] as $application ) {
            ?>

            <div class="project">
                <a href="<?=$application['url']?>">
                    <div class="project_icon" style="background-image:url(images/<?=$application['icon']?>)"></div>
                    <h5 class="project_name"><?=$application['title']?></h5>
                </a>
            </div>

            <?php
                }
            ?>

        </div>
    </div>
</section>

<section class="grid">
    <div class="two-thirds">
        <h2>Libraries</h2>
    </div>
    <div class="whole">
        <div class="projects">

            <?php
                foreach( $fileContent['libraries'] as $application ) {
            ?>

            <div class="project">
                <a href="<?=$application['url']?>">
                    <div class="project_icon" style="background-image:url(images/<?=$application['icon']?>)"></div>
                    <h5 class="project_name"><?=$application['title']?></h5>
                </a>
            </div>

            <?php
                }
            ?>

        </div>
    </div>
</section>

<section class="grid">
    <div class="two-thirds">
        <h2>Switchboard Plugs</h2>
    </div>
    <div class="whole">
        <div class="projects">

            <?php
                foreach( $fileContent['plugs'] as $application ) {
            ?>

            <div class="project">
                <a href="<?=$application['url']?>">
                    <div class="project_icon" style="background-image:url(images/<?=$application['icon']?>)"></div>
                    <h5 class="project_name"><?=$application['title']?></h5>
                </a>
            </div>

            <?php
                }
            ?>

        </div>
    </div>
</section>

<section class="grid">
    <div class="two-thirds">
        <h2>Wingpanel Indicators</h2>
    </div>
    <div class="whole">
        <div class="projects">

            <?php
                foreach( $fileContent['indicators'] as $application ) {
            ?>

            <div class="project">
                <a href="<?=$application['url']?>">
                    <div class="project_icon" style="background-image:url(images/<?=$application['icon']?>)"></div>
                    <h5 class="project_name"><?=$application['title']?></h5>
                </a>
            </div>

            <?php
                }
            ?>

        </div>
    </div>
</section>

<section class="grid">
    <div class="two-thirds">
        <h2>Utilities</h2>
    </div>
    <div class="whole">
        <div class="projects">

            <?php
                foreach( $fileContent['utilities'] as $application ) {
            ?>

            <div class="project">
                <a href="<?=$application['url']?>">
                    <div class="project_icon" style="background-image:url(images/<?=$application['icon']?>)"></div>
                    <h5 class="project_name"><?=$application['title']?></h5>
                </a>
            </div>

            <?php
                }
            ?>

        </div>
    </div>
</section>

<section class="grid">
    <div class="two-thirds">
        <h2>Web</h2>
    </div>
    <div class="whole">
        <div class="projects">

            <?php
                foreach( $fileContent['web'] as $application ) {
            ?>

            <div class="project">
                <a href="<?=$application['url']?>">
                    <div class="project_icon" style="background-image:url(images/<?=$application['icon']?>)"></div>
                    <h5 class="project_name"><?=$application['title']?></h5>
                </a>
            </div>

            <?php
                }
            ?>

        </div>
    </div>
</section>

<section class="grid">
    <div class="two-thirds">
        <h2>Design</h2>
    </div>
    <div class="whole">
        <div class="projects">

            <?php
                foreach( $fileContent['design'] as $application ) {
            ?>

            <div class="project">
                <a href="<?=$application['url']?>">
                    <div class="project_icon" style="background-image:url(images/<?=$application['icon']?>)"></div>
                    <h5 class="project_name"><?=$application['title']?></h5>
                </a>
            </div>

            <?php
                }
            ?>

        </div>
    </div>
</section>

<?php
    include $template['footer'];
?>
