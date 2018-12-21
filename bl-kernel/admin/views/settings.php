<?php defined('BLUDIT') or die('Bludit CMS.'); ?>

<?php echo Bootstrap::formOpen(array('id'=>'jsform', 'class'=>'tab-content')); ?>

<div class="align-middle">
	<div class="float-right mt-1">
		<button type="submit" class="btn btn-primary btn-sm" name="save"><?php $L->p('Save') ?></button>
		<a class="btn btn-secondary btn-sm" href="<?php echo HTML_PATH_ADMIN_ROOT.'dashboard' ?>" role="button"><?php $L->p('Cancel') ?></a>
	</div>
	<?php echo Bootstrap::pageTitle(array('title'=>$L->g('Settings'), 'icon'=>'cog')); ?>
</div>

<!-- TABS -->
<nav class="mb-3">
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="nav-general" aria-selected="false"><?php $L->p('General') ?></a>
		<a class="nav-item nav-link" id="nav-advanced-tab" data-toggle="tab" href="#advanced" role="tab" aria-controls="nav-advanced" aria-selected="false"><?php $L->p('Advanced') ?></a>
		<a class="nav-item nav-link" id="nav-seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="nav-seo" aria-selected="false"><?php $L->p('SEO') ?></a>
		<a class="nav-item nav-link" id="nav-social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="nav-social" aria-selected="false"><?php $L->p('Social Networks') ?></a>
		<a class="nav-item nav-link" id="nav-images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="nav-images" aria-selected="false"><?php $L->p('Images') ?></a>
		<a class="nav-item nav-link" id="nav-language-tab" data-toggle="tab" href="#language" role="tab" aria-controls="nav-language" aria-selected="false"><?php $L->p('Language') ?></a>
		<a class="nav-item nav-link" id="nav-language-tab" data-toggle="tab" href="#logo" role="tab" aria-controls="nav-logo" aria-selected="false"><?php $L->p('Logo') ?></a>
	</div>
</nav>

<?php
	// Token CSRF
	echo Bootstrap::formInputHidden(array(
		'name'=>'tokenCSRF',
		'value'=>$security->getTokenCSRF()
	));

	// Homepage
	echo Bootstrap::formInputHidden(array(
		'name'=>'homepage',
		'value'=>$site->homepage()
	));
?>

	<!-- General tab -->
	<div class="tab-pane show active" id="general" role="tabpanel" aria-labelledby="general-tab">
	<?php
		echo Bootstrap::formTitle(array('title'=>$L->g('Site')));

		echo Bootstrap::formInputText(array(
			'name'=>'title',
			'label'=>$L->g('Site title'),
			'value'=>$site->title(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('use-this-field-to-name-your-site')
		));

		echo Bootstrap::formInputText(array(
			'name'=>'slogan',
			'label'=>$L->g('Site slogan'),
			'value'=>$site->slogan(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('use-this-field-to-add-a-catchy-phrase')
		));

		echo Bootstrap::formInputText(array(
			'name'=>'description',
			'label'=>$L->g('Site description'),
			'value'=>$site->description(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('you-can-add-a-site-description-to-provide')
		));

		echo Bootstrap::formInputText(array(
			'name'=>'footer',
			'label'=>$L->g('Footer text'),
			'value'=>$site->footer(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('you-can-add-a-small-text-on-the-bottom')
		));
	?>
	</div>

	<!-- Advanced tab -->
	<div class="tab-pane" id="advanced" role="tabpanel" aria-labelledby="advanced-tab">
	<?php
		echo Bootstrap::formTitle(array('title'=>$L->g('Content')));

		echo Bootstrap::formSelect(array(
			'name'=>'itemsPerPage',
			'label'=>$L->g('Items per page'),
			'options'=>array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8', '-1'=>$L->g('All content')),
			'selected'=>$site->itemsPerPage(),
			'class'=>'',
			'tip'=>$L->g('Number of items to show per page')
		));

		echo Bootstrap::formSelect(array(
			'name'=>'orderBy',
			'label'=>$L->g('Order content by'),
			'options'=>array('date'=>$L->g('Date'),'position'=>$L->g('Position')),
			'selected'=>$site->orderBy(),
			'class'=>'',
			'tip'=>$L->g('order-the-content-by-date-to-build-a-blog')
		));

		echo Bootstrap::formTitle(array('title'=>$L->g('Predefined pages')));

		// Homepage
		try {
			$homeKey = $site->homepage();
			$home = new Page($homeKey);
			$homeValue = $home->title();
		} catch (Exception $e) {
			$homeValue = '';
		}

		echo Bootstrap::formInputText(array(
			'name'=>'homepageTMP',
			'label'=>$L->g('Homepage'),
			'value'=>$homeValue,
			'class'=>'',
			'placeholder'=>$L->g('Start typing a page title to see a list of suggestions.'),
			'tip'=>$L->g('Returning page for the main page')
		));

		$homepageOptions[' '] = '- '.$L->g('Default message').' -';
		echo Bootstrap::formSelect(array(
			'name'=>'pageNotFound',
			'label'=>$L->g('Page not found'),
			'options'=>$homepageOptions,
			'selected'=>$site->pageNotFound(),
			'class'=>'',
			'tip'=>$L->g('Returning page when the page doesnt exist')
		));

		echo Bootstrap::formTitle(array('title'=>$L->g('Email account settings')));

		echo Bootstrap::formInputText(array(
			'name'=>'emailFrom',
			'label'=>$L->g('Sender email'),
			'value'=>$site->emailFrom(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('Emails will be sent from this address')
		));

		echo Bootstrap::formTitle(array('title'=>$L->g('Autosave')));

		echo Bootstrap::formInputText(array(
			'name'=>'autosaveInterval',
			'label'=>$L->g('Interval'),
			'value'=>$site->autosaveInterval(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('Number in minutes for every execution of autosave')
		));

		echo Bootstrap::formTitle(array('title'=>$L->g('Site URL')));

		echo Bootstrap::formInputText(array(
			'name'=>'url',
			'label'=>'URL',
			'value'=>$site->url(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('full-url-of-your-site'),
			'placeholder'=>'https://'
		));

		echo Bootstrap::formTitle(array('title'=>$L->g('URL Filters')));

		echo Bootstrap::formInputText(array(
			'name'=>'uriPage',
			'label'=>$L->g('Pages'),
			'value'=>$site->uriFilters('page'),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>DOMAIN_PAGES
		));

		echo Bootstrap::formInputText(array(
			'name'=>'uriTag',
			'label'=>$L->g('Tags'),
			'value'=>$site->uriFilters('tag'),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>DOMAIN_TAGS
		));

		echo Bootstrap::formInputText(array(
			'name'=>'uriCategory',
			'label'=>$L->g('Category'),
			'value'=>$site->uriFilters('category'),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>DOMAIN_CATEGORIES
		));

		echo Bootstrap::formInputText(array(
			'name'=>'uriBlog',
			'label'=>$L->g('Blog'),
			'value'=>$site->uriFilters('blog'),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>DOMAIN.$site->uriFilters('blog'),
			'disabled'=>Text::isEmpty($site->uriFilters('blog'))
		));
	?>
	</div>

	<!-- SEO tab -->
	<div class="tab-pane" id="seo" role="tabpanel" aria-labelledby="seo-tab">
	<?php
		echo Bootstrap::formTitle(array('title'=>$L->g('Extreme friendly URL')));

		echo Bootstrap::formSelect(array(
			'name'=>'extremeFriendly',
			'label'=>$L->g('Allow Unicode'),
			'options'=>array('true'=>$L->g('Enabled'), 'false'=>$L->g('Disabled')),
			'selected'=>($site->extremeFriendly()?'true':'false'),
			'class'=>'',
			'tip'=>$L->g('Allow unicode characters in the URL and some part of the system.')
		));

		echo Bootstrap::formTitle(array('title'=>$L->g('Title formats')));

		echo Bootstrap::formInputText(array(
			'name'=>'titleFormatHomepage',
			'label'=>$L->g('Homepage'),
			'value'=>$site->titleFormatHomepage(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('Variables allowed').' <code>{{site-title}}</code> <code>{{site-slogan}}</code> <code>{{site-description}}</code>',
			'placeholder'=>''
		));

		echo Bootstrap::formInputText(array(
			'name'=>'titleFormatPages',
			'label'=>$L->g('Pages'),
			'value'=>$site->titleFormatPages(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('Variables allowed').' <code>{{page-title}}</code> <code>{{page-description}}</code> <code>{{site-title}}</code> <code>{{site-slogan}}</code> <code>{{site-description}}</code>',
			'placeholder'=>''
		));

		echo Bootstrap::formInputText(array(
			'name'=>'titleFormatCategory',
			'label'=>$L->g('Category'),
			'value'=>$site->titleFormatCategory(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('Variables allowed').' <code>{{category-name}}</code> <code>{{site-title}}</code> <code>{{site-slogan}}</code> <code>{{site-description}}</code>',
			'placeholder'=>''
		));

		echo Bootstrap::formInputText(array(
			'name'=>'titleFormatTag',
			'label'=>$L->g('Tag'),
			'value'=>$site->titleFormatTag(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('Variables allowed').' <code>{{tag-name}}</code> <code>{{site-title}}</code> <code>{{site-slogan}}</code> <code>{{site-description}}</code>',
			'placeholder'=>''
		));
	?>
	</div>
	<script>
	$(document).ready(function() {

		// Parent autocomplete
		var homepageXHR;
		var homepageList; // Keep the parent list returned to get the key by the title page
		$("#jshomepageTMP").autoComplete({
			minChars: 1,
			source: function(term, response) {
				// Prevent call inmediatly another ajax request
				try { homepageXHR.abort(); } catch(e){}
				homepageXHR = $.getJSON(HTML_PATH_ADMIN_ROOT+"ajax/get-published", {query: term},
					function(data) {
						homepageList = data;
						term = term.toLowerCase();
						var matches = [];
						for (var title in data) {
							if (~title.toLowerCase().indexOf(term))
								matches.push(title);
						}
						response(matches);
				});
			},
			onSelect: function(e, term, item) {
				// homepageList = array( pageTitle => pageKey )
				var key = homepageList[term];
				$("#jshomepage").attr("value", key);
			}
		});

		$("#jshomepageTMP").change(function() {
			if ($(this).val()) {
				$("#jsuriBlog").removeAttr('disabled');
				$("#jsuriBlog").attr('value', '/blog/');
			} else {
				$("#jsuriBlog").attr('value', '');
				$("#jsuriBlog").attr('disabled', 'disabled');
				$("#jshomepage").attr("value", '');
			}
		});

	});
	</script>

	<!-- Social Network tab -->
	<div class="tab-pane" id="social" role="tabpanel" aria-labelledby="social-tab">
	<?php
		echo Bootstrap::formInputText(array(
			'name'=>'twitter',
			'label'=>'Twitter',
			'value'=>$site->twitter(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>''
		));

		echo Bootstrap::formInputText(array(
			'name'=>'facebook',
			'label'=>'Facebook',
			'value'=>$site->facebook(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>''
		));

		echo Bootstrap::formInputText(array(
			'name'=>'codepen',
			'label'=>'CodePen',
			'value'=>$site->codepen(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>''
		));

		echo Bootstrap::formInputText(array(
			'name'=>'instagram',
			'label'=>'Instagram',
			'value'=>$site->instagram(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>''
		));

		echo Bootstrap::formInputText(array(
			'name'=>'gitlab',
			'label'=>'GitLab',
			'value'=>$site->gitlab(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>''
		));

		echo Bootstrap::formInputText(array(
			'name'=>'github',
			'label'=>'GitHub',
			'value'=>$site->github(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>''
		));

		echo Bootstrap::formInputText(array(
			'name'=>'linkedin',
			'label'=>'LinkedIn',
			'value'=>$site->linkedin(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>''
		));

		echo Bootstrap::formInputText(array(
			'name'=>'mastodon',
			'label'=>'Mastodon',
			'value'=>$site->mastodon(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>''
		));
	?>
	</div>

	<!-- Images tab -->
	<div class="tab-pane" id="images" role="tabpanel" aria-labelledby="images-tab">
	<?php
		echo Bootstrap::formTitle(array('title'=>$L->g('Thumbnails')));

		echo Bootstrap::formInputText(array(
			'name'=>'thumbnailWidth',
			'label'=>$L->g('Width'),
			'value'=>$site->thumbnailWidth(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('Thumbnail width in pixels')
		));

		echo Bootstrap::formInputText(array(
			'name'=>'thumbnailHeight',
			'label'=>$L->g('Height'),
			'value'=>$site->thumbnailHeight(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('Thumbnail height in pixels')
		));

		echo Bootstrap::formInputText(array(
			'name'=>'thumbnailQuality',
			'label'=>$L->g('Quality'),
			'value'=>$site->thumbnailQuality(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('Thumbnail quality in percentage')
		));
	?>
	</div>

	<!-- Timezone and language tab -->
	<div class="tab-pane" id="language" role="tabpanel" aria-labelledby="language-tab">
	<?php
		echo Bootstrap::formTitle(array('title'=>$L->g('Language and timezone')));

		echo Bootstrap::formSelect(array(
			'name'=>'language',
			'label'=>$L->g('Language'),
			'options'=>$L->getLanguageList(),
			'selected'=>$site->language(),
			'class'=>'',
			'tip'=>$L->g('select-your-sites-language')
		));

		echo Bootstrap::formSelect(array(
			'name'=>'timezone',
			'label'=>$L->g('Timezone'),
			'options'=>Date::timezoneList(),
			'selected'=>$site->timezone(),
			'class'=>'',
			'tip'=>$L->g('select-a-timezone-for-a-correct')
		));

		echo Bootstrap::formInputText(array(
			'name'=>'locale',
			'label'=>$L->g('Locale'),
			'value'=>$site->locale(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('with-the-locales-you-can-set-the-regional-user-interface')
		));

		echo Bootstrap::formTitle(array('title'=>$L->g('Date and time formats')));

		echo Bootstrap::formInputText(array(
			'name'=>'dateFormat',
			'label'=>$L->g('Date format'),
			'value'=>$site->dateFormat(),
			'class'=>'',
			'placeholder'=>'',
			'tip'=>$L->g('Current format').': '.Date::current($site->dateFormat())
		));
	?>
	</div>

	<!-- Site logo tab -->
	<div class="tab-pane" id="logo" role="tabpanel" aria-labelledby="logo-tab">
	<?php
		echo Bootstrap::formTitle(array('title'=>$L->g('Site logo')));
	?>
		<div class="custom-file mb-2">
			<input type="file" class="custom-file-input" id="jssiteLogoInputFile" name="inputFile">
			<label class="custom-file-label" for="jssiteLogoInputFile"><?php $L->p('Choose images to upload'); ?></label>
		</div>
		<div>
			<img id="jssiteLogoPreview" class="img-fluid img-thumbnail" alt="Site logo preview" src="<?php echo (Sanitize::pathFile(PATH_UPLOADS.$site->logo(false))?DOMAIN_UPLOADS.$site->logo(false).'?version='.time():HTML_PATH_ADMIN_THEME_IMG.'default.svg') ?>" />
		</div>
		<script>
		$("#jssiteLogoInputFile").on("change", function() {
			var formData = new FormData();
			formData.append('tokenCSRF', tokenCSRF);
			formData.append('inputFile', $(this)[0].files[0]);
			$.ajax({
				url: HTML_PATH_ADMIN_ROOT+"ajax/upload-logo",
				type: "POST",
				data: formData,
				cache: false,
				contentType: false,
				processData: false
			}).done(function(json) {
				console.log(json);
				$("#jssiteLogoPreview").attr('src',json.absoluteURL+"?time="+Math.random());
			});
		});
		</script>
	</div>

<?php echo Bootstrap::formClose(); ?>
