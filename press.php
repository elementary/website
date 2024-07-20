<?php
require_once __DIR__.'/_backend/preload.php';

$page['title'] = 'Press &sdot; elementary';
$page['styles'] = array(
  'styles/press.css'
);

include $template['header'];
include $template['alert'];

?>

<div class="grid">
  <div class="two-thirds">
    <h1>Press Resources</h1>
    <p>We love working with press—both within the Linux world and the greater tech and culture beats—to share our story and what we are working on.</p>
  </div>
</div>

<section class="grid" id="the-press">
  <h2>In the Press</h2>
  <div>
    <div class="third">
      <a href="https://www.wired.com/2013/11/elementaryos/" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/wired.svg'; ?></a>
      &ldquo;elementary OS is different… a beautiful and powerful operating system.&rdquo;
    </div>
    <div class="third">
      <a href="https://arstechnica.com/gadgets/2018/12/a-tour-of-elementary-os-perhaps-the-linux-worlds-best-hope-for-the-mainstream/" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/ars.svg'; ?></a>
      &ldquo;Gets out of the way and lets you focus on what you need to get done.&rdquo;
    </div>
  </div>
  <div>
    <div class="third">
      <a href="https://www.forbes.com/sites/jasonevangelho/2019/01/29/linux-distro-spotlight-what-i-love-about-elementary-os/" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/forbes.svg'; ?></a>
      &ldquo;I've found myself more productive these past two weeks [using elementary OS] than in the last two months combined.&rdquo;
    </div>
    <div class="third">
      <a href="https://web.archive.org/web/20150312112222/http://www.maclife.com/article/columns/future_os_x_may_be_more_elementary_ios_7" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/maclife.svg'; ?></a>
      &ldquo;A fast, low-maintenance platform that can be installed virtually anywhere.&rdquo;
    </div>
    <div class="third">
      <a href="https://lifehacker.com/how-to-move-on-after-windows-xp-without-giving-up-your-1556573928" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/lifehacker.svg'; ?></a>
      &ldquo;Lightweight and fast… and has a real flair for design and appearances.&rdquo;
    </div>
  </div>
  <div>
    <div class="third">
      <a href="https://www.omgubuntu.co.uk/2021/08/elementary-os-6-odin-release" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/omgubuntu.svg'; ?></a>
      &ldquo;The best way to try elementary [OS] is to install it, and since the install wizard is beautifully simple… that’s fairly easy to do.&rdquo;
    </div>
    <div class="third">
      <a href="https://www.hostingadvice.com/blog/ethical-operating-systems-from-elementary/" target="_blank" rel="noopener"><?php include __DIR__.'/images/thirdparty-logos/hostingadvice.svg'; ?></a>
      &ldquo;Ethical and capable replacement for traditional systems such as Windows and macOS… easy to use and customizable to accommodate various workflows.&rdquo;
    </div>
  </div>
</section>

<div class="grid">
  <div class="two-thirds">
    <h2>Join Our Press List</h2>
    <p>Be the first to know about new releases and significant developments. We send early access to press releases and press kits, including high resolution screenshots. This is a <strong>very low volume</strong> list; we send you the biggest news around once a year.</p>

    <!-- Begin MailChimp Signup Form -->
    <div id="mc_embed_signup">
      <form action="https://elementary.us14.list-manage.com/subscribe/post?u=6815d99e5893b4e213cdb00d2&amp;id=142e260a91" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
          <div class="mc-field-group">
            <label for="mce-EMAIL">Email <span class="asterisk">*</span>
          </label>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
          </div>
          <div class="mc-field-group">
            <label for="mce-FNAME">First Name <span class="asterisk">*</span>
          </label>
            <input type="text" value="" name="FNAME" class="required" id="mce-FNAME">
          </div>
          <div class="mc-field-group">
            <label for="mce-LNAME">Last Name </label>
            <input type="text" value="" name="LNAME" id="mce-LNAME">
          </div>
          <div class="mc-field-group">
            <label for="mce-PUBNAME">Publication <span class="asterisk">*</span>
          </label>
            <input type="text" value="" name="PUBNAME" class="required" id="mce-PUBNAME">
          </div>
          <div id="mce-responses" class="clear">
            <div class="response" id="mce-error-response" style="display:none"></div>
            <div class="response" id="mce-success-response" style="display:none"></div>
          </div>
          <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups -->
          <div style="position: absolute; left: -5000px;" aria-hidden="true">
            <input type="text" name="b_6815d99e5893b4e213cdb00d2_142e260a91" tabindex="-1" value="">
          </div>
          <div class="clear">
            <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button suggested-action">
          </div>
        </div>
      </form>
    </div>
    <!-- End MailChimp Signup Form -->
  </div>
</div>

<div class="grey">
  <div class="grid">
    <div class="two-thirds">
      <h2>elementary OS 7.1</h2>
      <p>Made with care with you in mind. OS 7.1 provides new personalization options that make it more inclusive and accessible, protects your privacy and ensures apps always operate with your explicit consent, and addresses your feedback with over 200 bug fixes, design changes, and new features</p>
      <a class="button" href="https://blog.elementary.io/os-7-1-available-now/" target="_blank" rel="noopener" class="read-more">Read Announcement</a>
      <a class="button" href="https://github.com/elementary/press-kit/archive/7.1.zip" target="_blank" rel="noopener" class="read-more">Download Press Kit</a>
    </div>
  </div>
</div>

<div class="grid">
  <div class="third">
    <h3>News &amp; Announcements</h3>
    <p>We share frequent updates on development, major announcements, tips for developers, featured apps, and other new content via our official blog.</p>
    <a class="button" href="https://blog.elementary.io/" target="_blank" rel="noopener">Visit Our Blog</a>
  </div>

  <div class="third">
    <h3>Brand Resources</h3>
    <p>View the elementary logos, brand usage guidelines, color palette, and community logo. Plus download the official high-resolution and vector elementary logo assets.</p>
    <a class="button" href="brand">View Brand Resources</a>
  </div>

  <div class="third">
    <h3>Get in Touch</h3>
    <p>Talk directly with the team by emailing us at <a href="mailto:press@elementary.io">press@elementary.io</a>. We welcome requests for interviews, podcast appearances, or just general press inquiries.</p>
    <a class="button" href="mailto:press@elementary.io">Send an Email</a>
  </div>
</div>

<?php
  include $template['footer'];
?>
