<?php

/**
 * _templates/event.php
 * Holds markdown for special event items like a release countdown or campain toast.
 */

require_once __DIR__ . '/../_backend/event.php';

$l10n->set_domain('layout');

if (event_active('odin 6.0 release')) { ?>
  <div class="overlay">
    <div class="overlay__content toast">
      <div class="toast__close"><i class="fas fa-times"></i></div>
      <span class="toast__text"><strong>Something new is coming.</strong> Check back Tuesday after 1600 UTC.</span>
    </div>
  </div>

<?php }

$l10n->set_domain($page['name']);
