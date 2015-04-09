<?php if (!$page): ?>
  <article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix" <?php print $attributes; ?>>
<?php endif; ?>

  <?php if ($user_picture || $display_submitted || !$page): ?>
    <?php if (!$page): ?>
      <header>
  <?php endif; ?>

      <?php print $user_picture; ?>

      <?php print render($title_prefix); ?>
      <?php if (!$page): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
      <?php endif; ?>
      <?php print render($title_suffix); ?>

    <?php if (!$page): ?>
      </header>
  <?php endif; ?>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?> typeof="http://schema.org/Event">
    <?php
      // Hide comments, tags, and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_venue']);
      print render($content);
    ?>
    <div property="schema:performer" class ="rdf-meta element-hidden" typeof="http://schema.org/MusicGroup">
      <span property="schema:name" content="Well Seasoned Christ"></span>
      <span property="schema:sameAs" content="http://www.wellseasonedchrst.com"></span>
    </div>
  </div>

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
      <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

<?php if (!$page): ?>
  </article> <!-- /.node -->
<?php endif; ?>
