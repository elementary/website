<?php
    require_once __DIR__.'/_backend/preload.php';
    $page['title'] = 'Thank You for downloading';
    $page['theme-color'] = '#3E4E54';   
    
    include $template['header'];
    include $template['alert'];
?>

<section class="hero">
    <div class="grid">
        <img src="<?php echo $sitewide['lang-root'];?>images/brand/logomark.png" alt="logomark">
        <h1>Thank you for downloading!</sup></h1>
        <h4>For help and more info, please see the installation guide</h4>
        <a class="button suggested-action" href="<?php echo $sitewide['lang-root'];?>/docs/installation#installation">Read the installation guide</a>
    </div>
</section>

<?php
    include $template['footer'];
?>