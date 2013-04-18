$ = jQuery
a = audiojs
m = Modernizr

$ ->
	$('audio').each ->
		if m.audio
			a.create this

		else
			$audio = $ this
			src = $audio.find('source').attr 'src'
			basename = src.substr src.lastIndexOf('/') + 1

			$audio.replaceWith '<a href="' + src + '">' + basename + '</a>'