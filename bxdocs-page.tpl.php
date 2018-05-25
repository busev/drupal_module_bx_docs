<?php
$path = 'http://alutech-group.com';
$pageStyle = 'col-xs-12 col-sm-6 col-md-4';
$ancorStyle = 'modal';
if($type == 'page_full_width')
{
	$pageStyle = 'col-xs-12 col-sm-4 col-lg-2';
	$ancorStyle = 'fancybox';
}
?>
<div class="container-fluid">
  <div class="row bx-docs">
		<?php foreach ($list as $elem)
		{
			switch ($elem['IBLOCK_ID']){
				case '35':
				  echo '<div class="' . $pageStyle . '">
      <div class="bx-docs-element">
        <div class="thumbnail photo-thumb">
          ' . (!empty($elem['DETAIL_PICTURE']) ? '<a href="' . $path . $elem['DETAIL_PICTURE'] . '" class="' . $ancorStyle . '">' : '') . '
            <img src="' . $path . $elem['PREVIEW_PICTURE'] . '" alt="' . $elem['NAME'] . '">
          ' . (!empty($elem['DETAIL_PICTURE']) ? '</a>' : '') . '
        </div>
      </div>
    </div>';
					break;
				case '36':
					$pathFile = $path . $elem['file']['VALUE'];
					$pathParts = pathinfo($pathFile);
					$tempDir = tempnam(file_directory_temp(),'tmp');
					$fileSize = file_put_contents($tempDir, file_get_contents($pathFile));
					$formatSize = format_size($fileSize);
					echo '<div class="' . $pageStyle . '">
      <div class="bx-docs-element">
        <div class="thumbnail doc-thumb">
        <a href="' . $path . $elem['DETAIL_PICTURE'] . '" class="' . $ancorStyle . ' thumbnail photo-thumb">
            <img src="' . $path . $elem['PREVIEW_PICTURE'] . '" alt="' . $elem['NAME'] . '">
            </a>
            <div class="shortText">
              <p>' . $elem['NAME'] . '</p>
            </div>
            <a href="' . $path . $elem['file']['VALUE'] . '" target="_blank">
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
					if(isset($elem['file']['VALUE']) && !empty($elem['file']['VALUE']))
						$path_parts = pathinfo($path . $elem['file']['VALUE']);
					$formatSize = FALSE;
					if($path_parts && !empty($elem['size']['VALUE']))
						$formatSize = format_size($elem['size']['VALUE']);
					echo '<div class="' . $pageStyle . '">
      <div class="bx-docs-element">
        <div class="thumbnail doc-thumb">' .
               ($formatSize ? '<a href="' . $path . $elem['file']['VALUE'] . '" target="_blank">' : '')
               . '<img src="' . $path . $elem['PREVIEW_PICTURE'] . '" alt="' . $elem['NAME'] . '">
            <div class="shortText">
              <span class="doc_type">' . t($elem['type']['VALUE']) . '</span>
              <p>' . $elem['DATE_ACTIVE_FROM'] . '<br>' . $elem['NAME'] . '</p>
              <p><b>' . $elem['article']['VALUE'] . '</b></p>
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
					echo '<div class="blog-post"><h2 class="blog-post-title">' . $elem['NAME'] . '</h2><p class="blog-post-meta">' . $elem['DATE_ACTIVE_FROM'] . '</p>' . $elem['DETAIL_TEXT'] . '</div>';
					break;
				case '42':
					$path_parts = FALSE;
				  if(isset($elem['file']['VALUE']) && !empty($elem['file']['VALUE']))
				    $path_parts = pathinfo($path . $elem['file']['VALUE']);
					$formatSize = FALSE;
					if($path_parts && !empty($elem['size']['VALUE']))
						$formatSize = format_size($elem['size']['VALUE']);
					echo '<div class="' . $pageStyle . '">
      <div class="bx-docs-element">
        <div class="thumbnail doc-thumb">' .
               ($formatSize ? '<a href="' . $path . $elem['file']['VALUE'] . '" target="_blank">' : '')
               . '<img src="' . $path . $elem['PREVIEW_PICTURE'] . '" alt="' . $elem['NAME'] . '">
            <div class="shortText">
              <span class="doc_type">' . t($elem['type']['VALUE']) . '</span>
              <p>' . $elem['DATE_ACTIVE_FROM'] . '<br>' . $elem['NAME'] . '</p>
              <p><b>' . $elem['article']['VALUE'] . '</b></p>
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
					$path_parts = pathinfo($path . $elem['URL']['VALUE']);
					echo '<div class="media">
	<a class="pull-left fancybox fancybox.iframe" href="' . $elem['YOUTUBE']['VALUE'] . '" data-toggle="' . $ancorStyle . '">
		<div class="video-border-embed-responsive">
			<div class="video-frame-embed-responsive">
				<img class="media-object" src="' . $path . $elem['PREVIEW_PICTURE'] . '" alt="' . $elem['NAME'] . '">
			</div>
		</div>
	</a>
	<div class="media-body">
		<h4 class="media-heading">' . $elem['NAME'] . '</h4>
		<p class="blog-post-meta">' . $elem['DATE_ACTIVE_FROM'] . '</p>
		<p>' . $elem['PREVIEW_TEXT'] . '</p>
		<div class="shortLink"><a href="' . $path . $elem['URL']['VALUE'] . '"><img src="' . $path . '/content/icons/' . drupal_strtolower($path_parts['extension']) . '.jpg"><span>' . t('Download') . '</span> (' . drupal_strtoupper($path_parts['extension']) . ' ' . $elem['SIZE']['VALUE'] . ' Mb)</a></div>
	</div>
</div>';
					break;
      }
    }?>
  </div>
</div>