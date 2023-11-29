<?php

/**
 * _templates/event.php
 * Holds markdown for special event items like a release countdown or campain toast.
 */

require_once __DIR__ . '/../_backend/event.php';

$l10n->setDomain('layout');

const EVENT_NAME = 'odin 6.0 release';

if (event_active(EVENT_NAME)) { ?>
  <div class="overlay">
    <div class="overlay__content toast">
      <div class="toast__close"><i class="fas fa-times"></i></div>
      <span class="toast__text"><strong>Something new is coming.</strong> Check back <time id="odin-day">Tues</time> after <time id="odin-time">1600 UTC</time>.</span>
    </div>
  </div>
  <script>
    const utcDate = new Date("<?php echo date(DATE_ISO8601, date_timestamp_get($event_expires[EVENT_NAME][1])) ?>");
    const lang = "<?php echo $page['lang']; ?>";

    document.getElementById("odin-day").innerHTML = new Intl.DateTimeFormat(lang, {weekday: "long"}).format(utcDate);
    document.getElementById("odin-time").innerHTML = new Intl.DateTimeFormat(lang, {hour: "numeric", minute: "numeric"}).format(utcDate);
  </script>

<?php }

$l10n->setDomain($page['name']);
