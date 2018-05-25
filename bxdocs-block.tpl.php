<?php
$arType = array(
	35 => t('Photo Gallery'),
	36 => t('Certificates'),
	37 => t('Technical documentation'),
	38 => t('Question - answer'),
	42 => t('Promotional materials'),
	57 => t('Video'),
);
$path = 'http://alutech-group.com';
?>
<div class="container-fluid"><?php
	 foreach ($entries as $entry):
     $elements = drupal_json_decode($entry->bx_short_response);
		 ?>
   <?php if($entry->bx_type == '36' || $entry->bx_type == '37' || $entry->bx_type == '42'): ?><h2><?php print $arType[$entry->bx_type]; ?></h2><?php endif; ?>
    <div class="row bx-block-docs<?php if($entry->bx_type == '38'): ?> view<?php endif; ?>"><?php
	     foreach ($elements as $key => $element)
      {
	      switch ($element['IBLOCK_ID']){
		      case '35':
			      echo '<div class="col-xs-12 col-sm-6 col-md-3">
      <div class="bx-docs-element">
        <div class="thumbnail photo-thumb">
          ' . (!empty($element['DETAIL_PICTURE']) ? '<a href="' . $path . $element['DETAIL_PICTURE'] . '" class="fancybox">' : '') . '
            <img src="' . $path . $element['PREVIEW_PICTURE'] . '" alt="' . $element['NAME'] . '">
          ' . (!empty($element['DETAIL_PICTURE']) ? '</a>' : '') . '
        </div>
      </div>
    </div>';
			      break;
		      case '36':
			      $pathFile = $path . $element['file']['VALUE'];
			      $pathParts = pathinfo($pathFile);
			      $tempDir = tempnam(file_directory_temp(),'tmp');
			      $fileSize = file_put_contents($tempDir, file_get_contents($pathFile));
			      $formatSize = format_size($fileSize);
			      echo '<div class="col-xs-12 col-sm-4 col-lg-2">
      <div class="bx-docs-element">
        <div class="thumbnail doc-thumb">
        <a href="' . $path . $element['DETAIL_PICTURE'] . '" class="fancybox thumbnail photo-thumb">
            <img src="' . $path . $element['PREVIEW_PICTURE'] . '" alt="' . $element['NAME'] . '">
            </a>
            <div class="shortText">
              <p>' . $element['NAME'] . '</p>
            </div>
            <a href="' . $path . $element['file']['VALUE'] . '" target="_blank">
            <div class="shortLink">
              <img src="' . $path . '/content/icons/' . drupal_strtolower($pathParts['extension']) . '.jpg">
              <span>' . t('Download') . '</span> (' . drupal_strtoupper($pathParts['extension']) . ' ' . $formatSize . ')
            </div>
          </a>
          </div>
      </div>
    </div>';
			      break;
		      case '37':
			      $path_parts = FALSE;
			      if(isset($element['file']['VALUE']) && !empty($element['file']['VALUE']))
			        $path_parts = pathinfo($path . $element['file']['VALUE']);
			      $formatSize = FALSE;
			      if($path_parts && !empty($element['size']['VALUE']))
				      $formatSize = format_size($element['size']['VALUE']);
			      echo '<div class="col-xs-12 col-sm-4 col-lg-2">
      <div class="bx-docs-element">
        <div class="thumbnail doc-thumb">' .
			           ($formatSize ? '<a href="' . $path . $element['file']['VALUE'] . '" target="_blank">' : '')
			           . '<img src="' . $path . $element['PREVIEW_PICTURE'] . '" alt="' . $element['NAME'] . '">
            <div class="shortText">
              <span class="doc_type">' . t($element['type']['VALUE']) . '</span>
              <p>' . $element['DATE_ACTIVE_FROM'] . '<br>' . $element['NAME'] . '</p>
              <p><b>' . $element['article']['VALUE'] . '</b></p>
            </div>' . (
			           $formatSize
				           ?
				           '<div class="shortLink"><img src="' . $path . '/content/icons/' . drupal_strtolower($path_parts['extension']) . '.jpg"><span>' . t('Download') . '</span> (' . drupal_strtoupper($path_parts['extension']) . ' ' . $formatSize . ')</div>'
				           :
				           ''
			           ) . ($formatSize ? '</a>' : '') . '
        </div>
      </div>
    </div>';
			      break;
		      case '38':
		        $idFaq = 'show-faq-' . $key;
			      echo '<div class="news-item"><a href="#" class="block_news_title" onclick="Drupal.alutechBxDocs.toggle(\'' . $idFaq . '\', event);">' . $element['NAME'] . '</a><div id="' . $idFaq . '" style="display: none;" ><p class="blog-post-meta">' . $element['DATE_ACTIVE_FROM'] . '</p>' . $element['DETAIL_TEXT'] . '</div></div>';
			      break;
		      case '42':
			      $path_parts = FALSE;
			      if(isset($element['file']['VALUE']) && !empty($element['file']['VALUE']))
				      $path_parts = pathinfo($path . $element['file']['VALUE']);
			      $formatSize = FALSE;
			      if($path_parts && !empty($element['size']['VALUE']))
				      $formatSize = format_size($element['size']['VALUE']);
			      echo '<div class="col-xs-12 col-sm-4 col-lg-2">
      <div class="bx-docs-element">
        <div class="thumbnail doc-thumb">' .
			           ($formatSize ? '<a href="' . $path . $element['file']['VALUE'] . '" target="_blank">' : '')
			           . '<img src="' . $path . $element['PREVIEW_PICTURE'] . '" alt="' . $element['NAME'] . '">
            <div class="shortText">
              <span class="doc_type">' . t($element['type']['VALUE']) . '</span>
              <p>' . $element['DATE_ACTIVE_FROM'] . '<br>' . $element['NAME'] . '</p>
              <p><b>' . $element['article']['VALUE'] . '</b></p>
            </div>' . (
			           $formatSize
				           ?
				           '<div class="shortLink"><img src="' . $path . '/content/icons/' . drupal_strtolower($path_parts['extension']) . '.jpg"><span>' . t('Download') . '</span> (' . drupal_strtoupper($path_parts['extension']) . ' ' . $formatSize . ')</div>'
				           :
				           ''
			           ) . ($formatSize ? '</a>' : '') . '
        </div>
      </div>
    </div>';
			      break;
		      case '57':
			      echo '<div class="col-xs-12 col-sm-6 col-md-3 videos-item">
	<a class="fancybox fancybox.iframe" href="' . $element['YOUTUBE']['VALUE'] . '" data-toggle="fancybox">
		<div class="video-block">
			<div class="video-hover"></div>
			<img src="' . $path . $element['PREVIEW_PICTURE'] . '" class="img-responsive" alt="' . $element['NAME'] . '">
		</div>
		<div class="video-caption">
			<p class="title">' . $element['NAME'] . '</p>
			<p class="date">' . $element['DATE_ACTIVE_FROM'] . '</p>
			<p>' . $element['PREVIEW_TEXT'] . '</p>
		</div>
	</a>
</div>';
			      break;
	      }
      }
	  ?></div>
    <a class="link" href="<?php print $entry->drp_path; ?>"><?php print t('View full list'); ?></a><?php
	 endforeach;
?></div>