				@switch(pathinfo(asset("storage/" . $path), PATHINFO_EXTENSION))
					@case('pdf')
					@case('epub')
					@case('mobi')
					@case('prc')
						<img class='review_img' src='{{asset("images/pdf_icon.png")}}'></img>
					@break
					@case('mp4')
						<video controls class='review_img'>
							<source src="{{asset('storage/' . $path)}}">
						</video>
					@break
					@case('mp3')
						<img class='review_img' src='{{asset("images/note_icon.png")}}'></img>
					@break
					@default
						<img class='review_img' src='{{asset("storage/" . $path)}}'></img>
				@endswitch